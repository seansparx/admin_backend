<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class to manage logistic projects.
 * 
 * @author Sean Rock <sean@sparxitsolutions.com>
 * @version 1.0
 * @dated 10/02/2017
 */
class Project extends MY_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        
        has_access('manage_projects');
        
        $this->load->model('admin/project_model');
    }
    
    
    
    /**
     * Display project listing page
     * 
     * @return void
     */
    public function manage() 
    {
        $this->data['content_datas']     = $this->project_model->fetch_row();
                
        $this->render('project/manage');
    }
    
    
    /**
     * Add project
     * 
     * @return void
     */
    public function add() 
    {
        if($this->input->post()) {

                if ($this->validate_form()) {

                    $this->project_model->add_vehicle();
                    redirect('admin/project/manage');
                }
         }

        $this->render('project/add');
   }
   
   
   /**
     * Validate project form
     * 
     * @return bool
     */
    private function validate_form()
    {
         $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         $this->form_validation->set_rules('code', 'Project Code', 'required|min_length[2]|max_length[100]');
         $this->form_validation->set_rules('cust_name', 'Customer Name', 'required|min_length[2]|max_length[100]');
         $this->form_validation->set_rules('description', 'Description', 'required|min_length[5]|max_length[500]');
         $this->form_validation->set_rules('status', 'Status', 'required');

         return ($this->form_validation->run() === TRUE);
    }
    
   
   
   
    /**
     * Delete project
     * 
     * @param $id int
     * @return void
     */
    public function delete($id) {
        
        $this->project_model->deleteRecord($id);
    }
    
    
    
    /**
     * Edit project
     * 
     * @param $id int
     * @return void
     */
    public function edit($id)
    {
        $data=null;
        if($this->input->post()) {

            if ($this->validate_form()) {
                
                $this->project_model->update_vehicle($id);
                redirect("admin/project/manage");
            }

            $data['id'] = $id;
        }
        
        $data['details'] = $this->project_model->getEditRecord($id);
        
        $this->data = $data;
        $this->render('project/edit');
    }
    
    
    
    /**
     * Datatable AJAX Call for project listing
     * 
     * @return void
     */
    public function project_ajax()
    {
            if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                
                $ids = array_filter($_REQUEST['id']);
                
                switch($_REQUEST['customActionName']) {
                    case 'delete_all' : $this->project_model->deleteAll($ids); 
                        break;
                }
                
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }
            
            $iTotalRecords  = $this->project_model->count_row();
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $filter = array();
            
            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'filter') {
                
                if(isset($_REQUEST['filter_id']) && ($_REQUEST['filter_id'] != '')){
                    $filter['id'] = intval(str_replace("#", "", $_REQUEST['filter_id']));
                }
                
                if(isset($_REQUEST['filter_code']) && ($_REQUEST['filter_code'] != '')){
                    $filter['code'] = $_REQUEST['filter_code'];
                }
                
                if(isset($_REQUEST['filter_customer_name']) && ($_REQUEST['filter_customer_name'] != '')){
                    $filter['customer_name'] = $_REQUEST['filter_customer_name'];
                }
                
                if(isset($_REQUEST['filter_description']) && ($_REQUEST['filter_description'] != '')){
                    $filter['description'] = $_REQUEST['filter_description'];
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

            $services = $this->project_model->fetch_projects($iDisplayStart, $iDisplayLength, $_REQUEST['order'][0], $filter);

            if(is_array($services)) {
                
                foreach ($services as $row){
                    
                    $noe = $this->project_model->get_noe($row->id); // Total number of assigned employee.
                    $nov = $this->project_model->get_nov($row->id); // Total number of assigned vehicle.
                    
                    $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" name="ids" class="checkboxes" value="'.$row->id.'" />
                                    <span></span>
                                </label>';
                    
                    $actions  = '<a class="btn btn-outline btn-circle btn-sm purple" href="' . site_url('admin/project/edit/' . $row->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                    
                    $actions .= '<a title="Delete" class="btn btn-outline btn-circle dark btn-sm red" onClick="if(confirm(\'Do you want to delete this reocrd ?\')){window.location.href=\'' . site_url('admin/project/delete/' . $row->id . '') . '\';}" href="javascript:;"><i class="fa fa fa-trash"></i> Delete</a>';                    
                    
                    $records["data"][] = array($chkbox, code($row->id), $row->code, $row->customer_name, $row->description, $row->status, display_datetime($row->created_at), $actions);
                }
            }
            
            

            $records["draw"]            = $sEcho;
            $records["recordsTotal"]    = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
    }
  
}


