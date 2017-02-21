<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class to manage vehicles
 * 
 * @author Sean Rock <sean@sparxitsolutions.com>
 * @version 1.0
 * @dated 30/01/2017
 */
class Vehicle extends MY_Controller 
{
    
    function __construct() 
    {
        parent::__construct();
        
        has_access('manage_vehicles');
        
        $this->load->model('admin/vehicle_model');
    }
    
    
    /**
     * Display vehicle listing page
     * 
     * @return void
     */
    public function manage() 
    {
        $this->data['content_datas'] = $this->vehicle_model->fetch_row();
        $this->render('vehicle/manage');
    }
    
    
    /**
     * Add vehicles
     * 
     * @return void
     */
    public function add() 
    {
        if($this->input->post()) {
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('regn_number', 'Registration Number', 'required|min_length[2]|max_length[100]|is_unique[vehicles.regn_number]');
            $this->form_validation->set_rules('model', 'Vehicle Model', 'required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'required|max_length[50]');
            
            if ($this->form_validation->run() === TRUE) {
                
                $this->vehicle_model->add_vehicle();
                redirect('admin/vehicle/manage');
            } 
         }
         
        $this->render('vehicle/add');		
    }
    
    
    /**
     * Delete vehicles
     * 
     * @param $id int
     * @return void
     */
    public function delete($id) 
    {
        $this->vehicle_model->deleteRecord($id);
    }
    
    
    /**
     * Edit vehicles
     * 
     * @param $id int
     * @return void
     */
    public function edit($id)
    {                
        if($this->input->post()) {
           
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('regn_number', 'Registration Number', 'required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('model', 'Vehicle Model', 'required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('status', 'Status', 'required|max_length[50]');
           
            if (($this->form_validation->run() === TRUE)){
                $this->vehicle_model->update_vehicle($id);
                redirect("admin/vehicle/manage");
            }

            $this->data['id'] = $id;
        }
        
        $this->data['details'] = $this->vehicle_model->getEditRecord($id);
        $this->render('vehicle/edit');
    }
    
    
    /**
     * Vehicle datatable AJAX call
     * 
     * @return json
     */
    public function vehicle_ajax()
    {
        
            if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                
                $ids = array_filter($_REQUEST['id']);
                
                switch($_REQUEST['customActionName']) {
                    case 'delete_all' : $this->vehicle_model->deleteAll($ids); 
                        break;
                }
                
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }
            
            $iTotalRecords  = $this->vehicle_model->count_row();
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $filter = array();
            
            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'filter') {
                
                if(isset($_REQUEST['filter_id']) && ($_REQUEST['filter_id'] != '')){
                    $filter['id'] = intval(str_replace("#", "", $_REQUEST['filter_id']));
                }
                
                if(isset($_REQUEST['filter_regn']) && ($_REQUEST['filter_regn'] != '')){
                    $filter['regn_number'] = $_REQUEST['filter_regn'];
                }
                
                if(isset($_REQUEST['filter_model']) && ($_REQUEST['filter_model'] != '')){
                    $filter['model'] = $_REQUEST['filter_model'];
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

            $services = $this->vehicle_model->fetch_vehicles($iDisplayStart, $iDisplayLength, $_REQUEST['order'][0], $filter);

            if(is_array($services)) {
                
                foreach ($services as $row){
                    
                    $nos = $this->vehicle_model->get_nos($row->id);
                    
                    if($nos > 0){
                        $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" name="keys" class="checkboxes" disabled="disabled" value="0" />
                                    <span></span>
                                </label>';
                    }
                    else{
                        $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" name="keys" class="checkboxes" value="'.$row->id.'" />
                                    <span></span>
                                </label>';
                    }
                    
                    $actions  = '<a class="btn btn-outline btn-circle btn-sm purple" href="' . site_url('admin/vehicle/edit/' . $row->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                    
                    if($nos > 0){
                        $actions .= '<a title="Delete Not Allowed" class="btn btn-outline btn-circle dark btn-sm red disabled" onClick="alert(\'Delete operation is not allowed, because vehicle using '.$nos.' service.\');" href="javascript:void(0);"><i class="fa fa fa-trash"></i> '.$nos.' Used</a>';
                    }
                    else{
                        $actions .= '<a title="Delete" class="btn btn-outline btn-circle dark btn-sm red" onClick="if(confirm(\'Do you want to delete this reocrd ?\')){window.location.href=\'' . site_url('admin/vehicle/delete/' . $row->id . '') . '\';}" href="javascript:;"><i class="fa fa fa-trash"></i> Delete</a>';
                    }
                    
                    $records["data"][] = array($chkbox, code($row->id), $row->regn_number, $row->model, $row->status, display_datetime($row->created_at), $actions);
                }
            }
            
            

            $records["draw"]            = $sEcho;
            $records["recordsTotal"]    = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
    }
  
}


