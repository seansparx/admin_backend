<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Timesheet_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_row() {
		
        return $this->db->where('deleted_at',NULL)->from('ld_timesheet')->count_all_results();
    }

    /*
     * Function for get all landing page details
     * @access public
     * @param $query_data (string)
     * @return array
     */
    public function fetch_services($offset = 0, $limit = null, $order = null, $filter = null)
    {
       $this->db->select(array('b.*', 'c.emp_name'))
                ->from('ld_timesheet'.' AS b')                
                ->join('ld_employees'.' AS c', 'c.id = b.emp_id', 'left')
                ->where(array('b.deleted_at' => NULL));
 
        if(is_array($filter)){
            
            foreach ($filter as $column => $keyword){
                
                $this->db->like($column, $keyword);
            }
        }
        
        if($limit){
            $this->db->limit($limit, $offset);
        }
                
        if(isset($order['column'])) {
            
            switch ($order['column']) {
                
                case 1: $this->db->order_by('entry_date', $order['dir']); break;
                case 2: $this->db->order_by('in_time', $order['dir']); break;
                case 3: $this->db->order_by('out_time', $order['dir']); break;
                case 4: $this->db->order_by('emp_id', $order['dir']); break;
                case 5: $this->db->order_by('remarks', $order['dir']); break;
                case 6: $this->db->order_by('ut', $order['dir']); break;
            }
        }
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            return $department->result();
        }
        
        
    }

    /*
     * Function for add new entry
     * @access public
     * @param array ($data)
     * @return true/false
     */


	public function add_timesheet_data($total_hour){
		
		$post=$this->input->post();
		$data=array(
				"entry_date"=>$post['entry_date'],
				"in_time"=>date("H:i:s", strtotime($post['start_time'])),
				"out_time"=>date("H:i:s", strtotime($post['end_time'])),
				"emp_id"=>$post['employees'],
				"remarks"=>$post['remark'],
				"total_hours"=>$total_hour,
				"extra_hour"=>$post['extra_hour']
				);
		$this->db->insert('ld_timesheet', $data);
		$this->session->set_flashdata('success', 'Timesheet has been added successfully!');
	
		}
		
		public function check_unique_add_time_model()
        {
			$this->db->select("*")->from("ld_timesheet");
			$this->db->where(array('emp_id'=>$this->input->post('employees'),'entry_date'=>$this->input->post('entry_date'),'deleted_at'=>NULL));
			return $count=$this->db->get()->num_rows();
				
		}
		
		public function check_unique_edit_time_model()
        {
			$this->db->select("*")->from("ld_timesheet");
			$this->db->where(array('emp_id'=>$this->input->post('employees'),'entry_date'=>$this->input->post('entry_date'),'id !=' => $this->input->post('id'),'deleted_at'=>NULL));
			return $count=$this->db->get()->num_rows();	
		}



    /*
     * Function for get data for edit
     * @access public
     * @param int ($id)
     * @return array
     */

    public function getEditRecord($id) {
        
        $result = array();
        $query = $this->db->where('id', $id)->get('ld_timesheet');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        
    }

    
    /*
     * Function for Delete Landing page information
     * @access public
     * @param int ($id)
     * @return void
     */

    public function deleteRecord($timesheet_id) 
    {
        if ($this->db->where('id', $timesheet_id)->update('ld_timesheet', array('deleted_at' => GMT_DATE_TIME))) {

            $this->session->set_flashdata('success', 'Record has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
        
        redirect("admin/timesheet/manage");
    }
 
    
	public function updatetTimesheet($edit_id,$total_hour) 
        {
		
		$post=$this->input->post();

		$data=array("in_time"=>date("H:i:s", strtotime($post['start_time'])),
				"out_time"=>date("H:i:s", strtotime($post['end_time'])),
				"remarks"=>$post['remark'],
				"total_hours"=>$total_hour,
				"extra_hour"=>$post['extra_hour']
				);
				
				
		$this->db->where(array('id' => $edit_id))->update('ld_timesheet', $data);
		
		$this->session->set_flashdata('success', 'Timesheet has been updated successfully!');

	}
    
    
    public function deleteAll($ids) 
    {
        $ids = array_filter($ids);
        
        if ($this->db->where_in('id', $ids)->update('ld_timesheet', array('deleted_at' => GMT_DATE_TIME))) {
        
            $this->session->set_flashdata('success', 'Record has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
    }
    
     public function delete_All_Details($ids) 
    {
		
        if ($this->db->where_in('service_id', $ids)->update(TBL_SERVICE_DETAILS, array('deleted_at' => GMT_DATE_TIME))){
                          
             $this->db->where_in('id', $ids)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME));
                    
            $this->session->set_flashdata('success', 'Services has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
    }

    
    public function get_emp_assigned_hour($emp_id, $service_date)
    {
            $this->db->select(array("a.*"));
            $this->db->from(TBL_SERVICE_DETAILS." AS a");
            $this->db->join(TBL_SERVICE." AS b", "b.id = a.service_id", "left");
            $this->db->where(array("a.service_date" => $service_date, "a.deleted_at" => null, "b.deleted_at" => null));
            $this->db->where("FIND_IN_SET(".$emp_id.", a.employee_id)");
            $sql = $this->db->get();

            if($sql->num_rows() > 0) {
                
                $result = $sql->row();
                
                $start_time =  isset($result->start_time)?$result->start_time:'';	
                $end_time   =  isset($result->end_time)?$result->end_time:'';
                $datetime1  =  new DateTime($start_time);
                $datetime2  =  new DateTime($end_time);
                $interval   =  $datetime1->diff($datetime2);
                
                return $interval->format('%h').".".$interval->format('%i');
            }
    }

}

?>
