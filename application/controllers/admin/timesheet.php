<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Timesheet extends MY_Controller {
    
    function __construct() 
    {
		parent::__construct();
        
        has_access('book_service');
        
        $this->load->model('admin/timesheet_model');
        $this->load->model('admin/employee_model');
        $this->load->model('admin/project_model');
        $this->load->model('admin/vehicle_model');
        $this->load->model('admin/department_model');
         $this->load->model('admin/systemconfig_model');
        
        $this->load->library('parser');
        $this->data['sys_config'] = $this->systemconfig_model->getSystemConfigurations();
    }


    /*
     * function manage():-To display brand list 
     */
    public function manage() 
    {      
        $this->render('timesheet/index');
    }


    /**
     * function For Create Landing page
     */
    public function add() 
    {
		$this->data['errors'] = '';
		if($this->input->post()) {
			$post = $this->input->post();
			if ($this->validate_form() == TRUE) {
				$total_hour=$this->total_hours($this->input->post('start_time'),$this->input->post('end_time'));
				$this->timesheet_model->add_timesheet_data($total_hour);
				$this->render('timesheet/index');
			}else{
				$this->data['employees'] = $this->employee_model->fetch_row();
				$this->render('timesheet/add');
			}
		}else{
			$this->data['employees'] = $this->employee_model->fetch_row();
			$this->render('timesheet/add');
		}
		
    }
    

   /**
    * Edit Timesheet
    * 
    * @parm $edit_id
    * @return void   
    */
    public function edit($edit_id) 
    {
			
			$post = $this->input->post();	

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('start_time', 'Initial Time', 'required|max_length[15]|callback_time_checker');
			$this->form_validation->set_rules('end_time', 'Ending Time', 'required|max_length[15]');
			$this->form_validation->set_rules('extra_hour', 'Extra Hour', 'required|numeric|max_length[3]|callback_maximumCheck');
			$this->form_validation->set_rules('remark', 'Remark', 'max_length[500]');


             if($this->form_validation->run() === TRUE) {
				
			   $total_hour = $this->total_hours($this->input->post('start_time'), $this->input->post('end_time'));
                           $this->timesheet_model->updatetTimesheet($edit_id, $total_hour);
   
				redirect('admin/timesheet/manage');
	
            }
            else{
               $this->data['detail'] = $this->timesheet_model->getEditRecord($edit_id);
               $this->data['employees'] = $this->employee_model->fetch_row();
               $this->render('timesheet/edit');             
            }
 		      
    }
    
     public function total_hours($start_time,$end_time){
			$time1 = strtotime($start_time);
			$time2 = strtotime($end_time);
			return $total_hour = round(abs($time2 - $time1) / 3600,2);	
		}
    

    private function validate_form()
    {
       if ($this->input->post()) {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('entry_date', 'Entry Date', 'required|max_length[15]');
			$this->form_validation->set_rules('employees', 'Employee', 'required|max_length[50]|callback_check_unique_add_time');
			$this->form_validation->set_rules('start_time', 'Initial Time', 'required|max_length[15]|callback_time_checker');
			$this->form_validation->set_rules('end_time', 'Ending Time', 'required|max_length[15]');
			$this->form_validation->set_rules('extra_hour', 'Extra Hour', 'required|numeric|max_length[3]|callback_maximumCheck');
			$this->form_validation->set_rules('remark', 'Remark', 'max_length[500]');
            return ($this->form_validation->run() === TRUE);
        }
    }
    
    function maximumCheck($num){
		if ($num > 12)
		{
			$this->form_validation->set_message('maximumCheck',"The extra hour $num  must be less than or equal to 12 Hour");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

    
    public function check_unique_add_time(){
		$count=$this->timesheet_model->check_unique_add_time_model();
		if($count>0){
			$this->form_validation->set_message('check_unique_add_time', "Employee already exist on entered entry date");
			return false;
		}else{
			return true;
		}	
	}
	
	public function check_unique_edit_time()
	{		
		$count = $this->timesheet_model->check_unique_edit_time_model();
		if($count >= 1){
			$this->form_validation->set_message('check_unique_edit_time', "Employee already exist on entered entry date");
			return false;
		}else{
			return true;
		}		
	}

    
    /*
     * Function for delete
     * @param int $id
     */
    public function delete($service_id) {
        $this->timesheet_model->deleteRecord($service_id);
    }
    
    
    public function deleteDetail($id, $service_id) {
        
        $this->timesheet_model->deleteServiceDetail($service_id, $id);
    }

  
    public function timesheet_ajax()
    {
            if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
                
                $ids = array_filter($_REQUEST['id']);
                
                switch($_REQUEST['customActionName']) {
                    case 'delete_all' : $this->timesheet_model->deleteAll($ids); 
                        break;
                }
                
                $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }
            
            $iTotalRecords  = $this->timesheet_model->count_row();
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $filter = array();
            
            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'filter') {
                
                if(isset($_REQUEST['filter_entry_date']) && ($_REQUEST['filter_entry_date'] != '')){
                    $filter['entry_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['filter_entry_date'])));
                }
                
                if(isset($_REQUEST['filter_start_time']) && ($_REQUEST['filter_start_time'] != '')){
                    $filter['in_time'] = date("H:i:s", strtotime($_REQUEST['filter_start_time']));
                }
                
                if(isset($_REQUEST['filter_end_time']) && ($_REQUEST['filter_end_time'] != '')){
                    $filter['out_time'] = date("H:i:s", strtotime($_REQUEST['filter_end_time']));
                }
                
                if(isset($_REQUEST['filter_total_hours']) && ($_REQUEST['filter_total_hours'] != '')){
                    $filter['total_hours'] = $_REQUEST['filter_total_hours'];
                }
                
                if(isset($_REQUEST['filter_extra_hours']) && ($_REQUEST['filter_extra_hours'] != '')){
                    $filter['extra_hour'] = $_REQUEST['filter_extra_hours'];
                }
                
                
                
                
                if(isset($_REQUEST['filter_employee_name']) && ($_REQUEST['filter_employee_name'] != '')){
                    $filter['emp_name'] = $_REQUEST['filter_employee_name'];
                }
                
                 if(isset($_REQUEST['filter_employee_code']) && ($_REQUEST['filter_employee_code'] != '')){
                    $filter['emp_id'] = intval(str_replace("#", "", $_REQUEST['filter_employee_code']));
                }
                
                if(isset($_REQUEST['filter_date_created']) && ($_REQUEST['filter_date_created'] != '')){
                    $filter['ut'] = date("Y-m-d", strtotime(str_replace('/', '-', $_REQUEST['filter_date_created'])));
                }
                
                    
                if(isset($_REQUEST['filter_remark']) && ($_REQUEST['filter_remark'] != '')){
                    $filter['remarks'] = $_REQUEST['filter_remark'];
                }
  
            }
            
            
            $records = array();
            $records["data"] = array(); 

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $services = $this->timesheet_model->fetch_services($iDisplayStart, $iDisplayLength, $_REQUEST['order'][0], $filter);
            
            if(is_array($services)) {
                
                foreach ($services as $row){
                    
                    $chkbox = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="checkboxes" value="'.$row->id.'" />
                                                    <span></span>
                                                </label>';
                    
                    $actions = '<a class="btn btn-outline btn-circle btn-sm purple" href="' . site_url('admin/timesheet/edit/' . $row->id) . '"><i class="fa fa-edit"></i> Edit</a>';
                    $actions .= '<a title="Delete" class="btn btn-outline btn-circle dark btn-sm red" onClick="if(confirm(\'Do you want to delete this reocrd ?\')){window.location.href=\'' . site_url('admin/timesheet/delete/' . $row->id . '') . '\';}" href="javascript:;"><i class="fa fa fa-trash"></i> Delete</a>';
                    
                    $records["data"][] = array($chkbox, display_date($row->entry_date), emp_code($row->emp_id) ,$row->emp_name , display_time($row->in_time), display_time($row->out_time),$row->total_hours,$row->extra_hour,$row->remarks ,$actions);
                }
            }
            
            $records["draw"]            = $sEcho;
            $records["recordsTotal"]    = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
    }
    
     /*
     * Function for time validation
     * @param start time and end time
     */
    
	public function time_checker()
    {

			$start_time=$this->input->post('start_time');
			$end_time=$this->input->post('end_time');
			

			$in_time = new DateTime(date("H:i:s", strtotime("$start_time")));
			$out_time = new DateTime(date("H:i:s", strtotime("$end_time")));

			if($in_time > $out_time){
				 $this->form_validation->set_message('time_checker', "Start time $start_time can not be greater than end time ");
				return false;
			}else{
				return true;
			}

		}
		
	
		
		public function calculate_extra_hr()
        {
                    
			$assigned_hr = $this->timesheet_model->get_emp_assigned_hour($this->input->post('employees'),$this->input->post('entry_date'));
	
			$datetime1 = new DateTime(date("H:i:s", strtotime($this->input->post('start_time'))));
			$datetime2 = new DateTime(date("H:i:s", strtotime($this->input->post('end_time'))));
                        
			$interval = $datetime1->diff($datetime2);
			
			$totalhr = $interval->format('%h').".".$interval->format('%i');
			
			$extra_hr= $totalhr - $assigned_hr;

			if($extra_hr<=0 || $assigned_hr<=0){
				$extra_hr=0;
			}
			
			$output=json_encode(array('extra_hr'=>"$extra_hr",'status'=>'success'));
			die($output);
				
		}
}


