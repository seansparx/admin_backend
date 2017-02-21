<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class to manage logistic employees.
 * 
 * @author Sean Rock <sean@sparxitsolutions.com>
 * @version 1.0
 * @dated 5/02/2017
 */
class Employee extends MY_Controller 
{
    
    function __construct()
    {
        parent::__construct();
        
        has_access('manage_employees');
        
        $this->load->model('admin/employee_model');
    }
    
    
    
    /**
     * Display employee listing page
     * 
     * @return void
     */
    public function manage() 
    {
        $this->data['content_datas']     = $this->employee_model->fetch_row();
                        
        $this->render('employee/manage');
    }
    
    
    
    /**
     * Add employee
     * 
     * @return void
     */
    public function add()
    {        
        if($this->input->post()){
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|min_length[2]|max_length[50]|is_unique[employees.emp_name]');
            $this->form_validation->set_rules('state', 'State', 'required|max_length[50]');
            $this->form_validation->set_rules('contract', 'Contract', 'required|max_length[100]');
            $this->form_validation->set_rules('category', 'Category', 'required|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                
                $this->employee_model->add_employee();
                redirect('admin/employee/manage');
            } 
         }
         
        $this->render('employee/add');		
   }
    
   
   
    /**
     * Delete employee
     * 
     * @param $id int
     * @return void
     */
    public function delete($id) 
    {        
        $this->employee_model->deleteRecord($id);
    }
    
    
    
    /**
     * Edit employee
     * 
     * @param $id int
     * @return void
     */
    public function edit($id)
    {
        $data=null;
        
        if($this->input->post()) {
           
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('emp_name', 'Employee Name', 'required|min_length[2]|max_length[50]|callback_unique_employee[employees.emp_name.'.$id.']');
            $this->form_validation->set_rules('state', 'State', 'required|max_length[50]');
            $this->form_validation->set_rules('contract', 'Contract', 'required|max_length[100]');
            $this->form_validation->set_rules('category', 'Category', 'required|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'required');
           
            if (($this->form_validation->run() === TRUE)){
                $this->employee_model->update_employee($id);
                redirect("admin/employee/manage");
            }

            $data['id'] = $id;
        }
        
        $data['details'] = $this->employee_model->getEditRecord($id);
        
        $this->data = $data;
        $this->render('employee/edit');
    }
    
    
    
    /**
     * Validation rule for unique employees
     * 
     * @param $value int
     * @param $params array
     * @return bool
     */
    public function unique_employee($value, $params)
    {   
        $this->form_validation->set_message('unique_employee', 'The %s "'.$value.'" is already being used.');
        
        list($table, $field, $id) = explode(".", $params, 3);

        $query = $this->db->select($field)->from($table)->where($field, $value)->where('id !=', $id)->limit(1)->get();        
        
        if ($query->num_rows() > 0) {
            return false;
        } 
        else {
            return true;
        }
    }
    
    
    
    /**
     * Datatable AJAX Call for employee list
     * 
     * @return json
     */
    public function employee_ajax()
    {
            if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                
                $ids = array_filter($_REQUEST['id']);
                
                switch($_REQUEST['customActionName']) {
                    case 'delete_all' : $this->employee_model->deleteAll($ids); 
                        break;
                }
                
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }
            
            $iTotalRecords  = $this->employee_model->count_row();
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $filter = array();
            
            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'filter') {
                
                if(isset($_REQUEST['filter_id']) && ($_REQUEST['filter_id'] != '')){
                    $filter['id'] = intval(str_replace("#", "", $_REQUEST['filter_id']));
                }
                
                if(isset($_REQUEST['filter_emp_name']) && ($_REQUEST['filter_emp_name'] != '')){
                    $filter['emp_name'] = $_REQUEST['filter_emp_name'];
                }
                
                if(isset($_REQUEST['filter_state']) && ($_REQUEST['filter_state'] != '')){
                    $filter['state'] = $_REQUEST['filter_state'];
                }
                
                if(isset($_REQUEST['filter_contract']) && ($_REQUEST['filter_contract'] != '')){
                    $filter['contract'] = $_REQUEST['filter_contract'];
                }
                
                if(isset($_REQUEST['filter_category']) && ($_REQUEST['filter_category'] != '')){
                    $filter['category'] = $_REQUEST['filter_category'];
                }
                
                if(isset($_REQUEST['filter_status']) && ($_REQUEST['filter_status'] != '')){
                    $filter['status'] = $_REQUEST['filter_status'];
                }
                
                if(isset($_REQUEST['filter_date_from']) && ($_REQUEST['filter_date_from'] != '')){
                    $filter['created_at'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['filter_date_from'])));
                }
                
            }
            
            
            $records = array();
            $records["data"] = array(); 

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $services = $this->employee_model->fetch_employees($iDisplayStart, $iDisplayLength, $_REQUEST['order'][0], $filter);

            if(is_array($services)) {
                
                foreach ($services as $row){
                    
                    $nos = $this->employee_model->get_nos($row->id);
                    
                    if($nos > 0){
                        $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input disabled="disabled" type="checkbox" class="checkboxes" value="0" />
                                        <span></span>
                                    </label>';
                    }
                    else{
                        $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" name="ids" class="checkboxes" value="'.$row->id.'" />
                                        <span></span>
                                    </label>';
                    }
                    
                    $actions  = '<a class="btn btn-outline btn-circle btn-sm purple" href="' . site_url('admin/employee/edit/' . $row->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                    
                    if($nos > 0){
                        $actions .= '<a title="Delete Not Allowed" class="btn btn-outline btn-circle dark btn-sm red disabled" onClick="alert(\'Delete operation is not allowed, because employee using '.$nos.' service.\');" href="javascript:;"><i class="fa fa fa-trash"></i> '.$nos.' Used</a>';
                    }
                    else{
                        $actions .= '<a title="Delete" class="btn btn-outline btn-circle dark btn-sm red" onClick="if(confirm(\'Do you want to delete this reocrd ?\')){window.location.href=\'' . site_url('admin/employee/delete/' . $row->id . '') . '\';}" href="javascript:;"><i class="fa fa fa-trash"></i> Delete</a>';
                    }
                    
                    $records["data"][] = array($chkbox, emp_code($row->id), $row->emp_name, $row->state, $row->contract, $row->category, $row->status, display_datetime($row->created_at), $actions);
                }
            }
            
            

            $records["draw"]            = $sEcho;
            $records["recordsTotal"]    = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
    }
  
}


