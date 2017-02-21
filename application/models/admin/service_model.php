<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Service_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_row() {
        return $this->db->where(array('deleted_at' => NULL))->count_all_results(TBL_SERVICE);
    }

    /*
     * Function for get all landing page details
     * @access public
     * @param $query_data (string)
     * @return array
     */
    public function fetch_services($offset = 0, $limit = null, $order = null, $filter = null)
    {
        $this->db->select(array('b.*', 'c.name AS department', 'd.code AS project'))
                ->from(TBL_SERVICE.' AS b')                
                ->join(TBL_DEPARTMENT.' AS c', 'c.id = b.department_id', 'left')
                ->join(TBL_PROJECT.' AS d', 'd.id = b.project_id', 'left')
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
                
                case 1: $this->db->order_by('b.service_title', $order['dir']); break;
                case 2: $this->db->order_by('project', $order['dir']); break;
                case 3: $this->db->order_by('b.start_date', $order['dir']); break;
                case 4: $this->db->order_by('b.end_date', $order['dir']); break;
                case 5: $this->db->order_by('b.start_time', $order['dir']); break;
                case 6: $this->db->order_by('department', $order['dir']); break;
                case 7: $this->db->order_by('b.created_at', $order['dir']); break;
            }
        }
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            return $department->result();
        }
    }
    
    
    
    public function fetch_row($offset = 0, $limit = null, $order = null, $service_id = null, $filter = null)
    {
        $this->db->select(array('a.*', 'b.service_title','d.code AS project'))
                ->from(TBL_SERVICE_DETAILS.' AS a')
                ->join(TBL_SERVICE.' AS b', 'b.id = a.service_id', 'left')
                ->join(TBL_DEPARTMENT.' AS c', 'c.id = b.department_id', 'left')
                ->join(TBL_PROJECT.' AS d', 'd.id = b.project_id', 'left')
                ->where(array('a.deleted_at' => NULL));
        
        if(is_array($filter)){
            
            foreach ($filter as $column => $keyword){
                
                $this->db->like($column, $keyword);
            }
        }
        
        if($service_id > 0){
            $this->db->where('a.service_id', $service_id);
        }
        
        if($limit){
            $this->db->limit($limit, $offset);
        }
                
        if(isset($order['column'])) {
            
            switch ($order['column']) {
                
                case 1: $this->db->order_by('a.service_date', $order['dir']); break;
                case 2: $this->db->order_by('a.start_time', $order['dir']); break;
                case 3: $this->db->order_by('a.end_time', $order['dir']); break;
                case 4: $this->db->order_by('d.code', $order['dir']); break;
                case 7: $this->db->order_by('a.ut', $order['dir']); break;
            }
        }
        
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            return $department->result();
        }

    }
    
    
    public function row_count($service_id = null)
    {
        $this->db->select(array('a.*', 'b.service_title', 'b.start_date', 'b.end_date', 'c.name AS department', 'd.code AS project', 'b.service_desc'))
                ->from(TBL_SERVICE_DETAILS.' AS a')
                ->join(TBL_SERVICE.' AS b', 'b.id = a.service_id', 'left')
                ->join(TBL_DEPARTMENT.' AS c', 'c.id = b.department_id', 'left')
                ->join(TBL_PROJECT.' AS d', 'd.id = b.project_id', 'left')
                ->where(array('a.deleted_at' => NULL));
        
        if($service_id > 0){
            $this->db->where('a.service_id', $service_id);
        }
        
        $department = $this->db->get();
        
        return $department->num_rows();
    }

    /*
     * Function for add Department page information
     * @access public
     * @param array ($data)
     * @return true/false
     */

    public function add_service() 
    {
        $post = $this->input->post();
        
        $start_date = date("Y-m-d", strtotime($post['start_date']));
        $end_date   = date("Y-m-d", strtotime($post['end_date']));
        
        $data = array(
            "service_title" => $post['service_title'],
            "start_date"    => $start_date,
            "end_date"      => $end_date,
            "start_time"    => date("H:i:s", strtotime($post['start_time'])),
            "end_time"      => date("H:i:s", strtotime($post['end_time'])),
            "department_id" => $post['department'],
            "project_id"    => $post['project'],
            "service_desc"  => $post['service_desc'],
            "added_by"      => $this->session->userdata(SITE_SESSION_NAME . 'ADMINID'),
            "created_at"    => GMT_DATE_TIME,
            "updated_at"    => GMT_DATE_TIME
        );
     
        if($this->db->insert(TBL_SERVICE, $data)) {
            
            $service_id = $this->db->insert_id();
            
            $service_date = strtotime($post['start_date']);
            
            $i = 0;
            
            if(strtotime($post['start_date']) == strtotime($post['end_date'])){
                
                $service_date = strtotime($post['start_date']);
                
                $service_data = array(
                    "service_id"   => $service_id, 
                    "service_date" => date("Y-m-d", $service_date), 
                    "start_time"   => date("H:i:s", strtotime($post['start_time'])),
                    "end_time"     => date("H:i:s", strtotime($post['end_time'])),
                    "employee_id"  => implode(",", $post['employees']), 
                    "vehicle_id"   => implode(",", $post['vehicles'])
                );
                
                $this->db->insert(TBL_SERVICE_DETAILS, $service_data);
            }
            else if(strtotime($post['end_date']) > strtotime($post['start_date'])) {
                
                while ($service_date < strtotime($post['end_date'])) {

                    $service_date = strtotime($post['start_date']." +".$i." days");

                    $service_data = array(
                        "service_id"   => $service_id, 
                        "service_date" => date("Y-m-d", $service_date), 
                        "start_time"   => date("H:i:s", strtotime($post['start_time'])),
                        "end_time"     => date("H:i:s", strtotime($post['end_time'])),
                        "employee_id"  => implode(",", $post['employees']), 
                        "vehicle_id"   => implode(",", $post['vehicles'])
                    );

                    $this->db->insert(TBL_SERVICE_DETAILS, $service_data);

                    $i++;
                }
            }
            
            
            $this->session->set_flashdata('success', 'Service has been added successfully!');        
            
        }
    }

    /*
     * Function for update department information
     * @access public
     * @param array ($data)
     * @return true/false
     */

    public function update_vehicle($id) 
    {
        $post = $this->input->post();
        
        $data = array(
            "emp_name" => $post['emp_name'],
            "state" => $post['state'],
            "contract" => $post['contract'],
            "category" => $post['category'],
            "updated_at" => GMT_DATE_TIME
        );
        
        $this->db->where('id', $id)->update(TBL_SERVICE, $data);
        $this->session->set_flashdata('success', 'Service has been updated successfully!');
        return TRUE;
    }

    /*
     * Function for get Department for edit
     * @access public
     * @param int ($id)
     * @return array
     */

    public function getEditRecord($id) {
        
        $result = array();
        $query = $this->db->where('id', $id)->get(TBL_SERVICE);
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }
    
    
    public function getServiceDetail($id)
    {
        $result = array();
        $query = $this->db->where(array('id' => $id))->get(TBL_SERVICE_DETAILS);
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }
    
    
    public function getEmployeeServices($emp_id, $service_date = null)
    {
        $result = array();
        
        $dateClause = '';
        
        if($service_date){
            $dateClause = " AND a.service_date = '".$service_date."' ";
        }
        
        $query = $this->db->query("SELECT a.service_id, a.service_date, a.start_time, a.end_time, b.service_title FROM ".TBL_SERVICE_DETAILS." AS a "
                . "RIGHT JOIN ".TBL_SERVICE." AS b "
                . "ON(b.id = a.service_id) WHERE FIND_IN_SET(".$emp_id.", a.employee_id) ".$dateClause." AND b.deleted_at IS NULL ");
        
        if ($query->num_rows() > 0) {
            
            return $query->row();
        }
    }
    
    public function getVehicleServices($emp_id, $service_date = null)
    {
        $result = array();
        
        $dateClause = '';
        
        if($service_date){
            $dateClause = " AND a.service_date = '".$service_date."' ";
        }
        
        $query = $this->db->query("SELECT a.service_id, a.service_date, a.start_time, a.end_time, b.service_title FROM ".TBL_SERVICE_DETAILS." AS a "
                . "RIGHT JOIN ".TBL_SERVICE." AS b "
                . "ON(b.id = a.service_id) WHERE FIND_IN_SET(".$emp_id.", a.vehicle_id) ".$dateClause." AND b.deleted_at IS NULL");
        
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

    public function deleteRecord($service_id) 
    {
        if ($this->db->where('id', $service_id)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME))) {

            $this->session->set_flashdata('success', 'Service has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
        
        redirect("admin/service/manage");
    }
 
	public function updateService($service_id){
		
		$array=array(
            "start_time"    =>date("H:i:s", strtotime($this->input->post('start_time'))),
            "end_time"      =>date("H:i:s", strtotime($this->input->post('end_time'))),
            "service_title" =>$this->input->post('service_title'),
            "service_desc"  =>$this->input->post('service_desc')
        );
		
        $this->db->where('id',"$service_id");
        $this->db->update('ld_services',$array);
        unset($array['service_title']);
        unset($array['service_desc']);
        $this->db->where('service_id',"$service_id");
        $this->db->update('ld_services_detail',$array);
        
        $this->session->set_flashdata('success', 'Services has been updated successfully!!!');

	}
    
    
    public function deleteAll($ids) 
    {
        $ids = array_filter($ids);
        
        if ($this->db->where_in('id', $ids)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME))) {
            
            $this->db->where_in('service_id', $ids)->update(TBL_SERVICE_DETAILS, array('deleted_at' => GMT_DATE_TIME));
                    
            $this->session->set_flashdata('success', 'Services has been deleted successfully!!!');
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
    
    
        
    
    
    public function addServiceEmployee() 
    {
        $assign_id = $this->input->post('assign_id'); 
        $new_emps  = $this->input->post('employees');
        
        $employees = $this->db->get_where(TBL_SERVICE_DETAILS, array('id' => $assign_id))->row()->employee_id;
        
        $emp_array = explode(",", $employees);
        
        if(count($new_emps) > 0){
            
            foreach ($new_emps as $emp){
                
                if(intval($emp) > 0){
                    $emp_array[] = $emp;
                }
                
            }
        }
        
        $all_emp = '';
        
        $emp_array = array_unique(array_filter($emp_array));
        
        if(is_array($emp_array)){
            
            $all_emp = implode(",", $emp_array);
        }
                
        if($this->db->where(array('id' => $assign_id))->update(TBL_SERVICE_DETAILS, array("employee_id" => $all_emp))) {

            return $all_emp;
        }
    }
    
    
    
    public function addServiceVehicle() 
    {
        $assign_id    = $this->input->post('assign_id'); 
        $new_vehicles = $this->input->post('vehicles');
        
        $vehicles = $this->db->get_where(TBL_SERVICE_DETAILS, array('id' => $assign_id))->row()->vehicle_id;
        
        $vhcl_array = explode(",", $vehicles);
        
        if(count($new_vehicles) > 0){
            
            foreach ($new_vehicles as $veh){
                
                if(intval($veh) > 0){
                    $vhcl_array[] = $veh;
                }
            }
        }
        
        $all_veh = '';
        
        $vhcl_array = array_unique(array_filter($vhcl_array));
        
        if(is_array($vhcl_array)){
            
            $all_veh = implode(",", $vhcl_array);
        }
         
        if($this->db->where(array('id' => $assign_id))->update(TBL_SERVICE_DETAILS, array("vehicle_id" => $all_veh))) {

            return $all_veh;
        }
    }
    
    
    
    public function removeServiceEmployee() 
    {
        $assign_id = $this->input->post('assign_id'); 
        $emp_id = $this->input->post('emp_id');
        
        $employees = $this->db->get_where(TBL_SERVICE_DETAILS, array('id' => $assign_id))->row()->employee_id;
        
        $emp_array = explode(",", $employees);
        
        $left_emp = array_diff($emp_array, array($emp_id));
        
        if(is_array($left_emp)) {
            
            $left_emp = implode(",", $left_emp);
        }
                
        if($this->db->where(array('id' => $assign_id))->update(TBL_SERVICE_DETAILS, array("employee_id" => $left_emp))) {

            return $left_emp;
        }
    }
    
    
    public function removeServiceVehicle() 
    {
        $assign_id = $this->input->post('assign_id'); 
        $vh_id = $this->input->post('vh_id');
        
        $vehicles = $this->db->get_where(TBL_SERVICE_DETAILS, array('id' => $assign_id))->row()->vehicle_id;
        
        $vh_array = explode(",", $vehicles);
        
        $left_vehicles = array_diff($vh_array, array($vh_id));
        
        if(is_array($left_vehicles)){
            
            $left_vehicles = implode(",", $left_vehicles);
        }
                
        if($this->db->where(array('id' => $assign_id))->update(TBL_SERVICE_DETAILS, array("vehicle_id" => $left_vehicles))) {

            return $left_vehicles;
        }
    }
    
    
    public function deleteServiceDetail($service_id, $id) 
    {
		
		
        if ($this->db->where(array("service_id" => $service_id, "id" => $id))->delete(TBL_SERVICE_DETAILS)) {
			
			
			$count=$this->db->select("*")->from(TBL_SERVICE_DETAILS)->where(array('service_id'=>$service_id,'deleted_at'=>NULL))->get()->num_rows();
              
             if($count==0){
				 $this->db->where_in('id', $service_id)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME));
				 } 
			
            $this->session->set_flashdata('success', 'Entry has been deleted successfully!!!');
        }
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
        
        redirect("admin/service/view_more/".$service_id);
    }
    
    
    public function get_available_employees($from_date, $to_date = null)
    {
        $emp_ids = array();
        
        $start_date = date("Ymd", strtotime(str_replace("/", "-", $from_date)));
        
        if($to_date){
            $end_date   = date("Ymd", strtotime(str_replace("/", "-", $to_date)));
        }
        else{
            $end_date   = $start_date;
        }
        
        $query = $this->db->query('SELECT GROUP_CONCAT(employee_id) AS ids FROM '.TBL_SERVICE_DETAILS.' AS a LEFT JOIN '.TBL_SERVICE.' AS b ON(b.id = a.service_id) WHERE a.service_date BETWEEN "'.$start_date.'" AND "'.$end_date.'" AND b.deleted_at IS NULL');
        
        if($query->num_rows() > 0){
            $emp_ids = explode(",", $query->row()->ids);
            return $this->db->select(array('GROUP_CONCAT(id) AS ids'))->from(TBL_EMPLOYEE)->where(array('status' => 'active','deleted_at' => NULL))->where_not_in('id', array_unique($emp_ids))->get()->row()->ids;
        }       
    }
    
    
    public function get_available_vehicles($from_date, $to_date = null)
    {
            $vehicle_ids = array();

            $start_date = date("Ymd", strtotime($from_date));

            if($to_date) {
                $end_date   = date("Ymd", strtotime($to_date));
            }
            else {
                $end_date   = $start_date;
            }

            $query = $this->db->query('SELECT GROUP_CONCAT(vehicle_id) AS ids FROM '.TBL_SERVICE_DETAILS.' AS a LEFT JOIN '.TBL_SERVICE.' AS b ON(b.id = a.service_id) WHERE a.service_date BETWEEN "'.$start_date.'" AND "'.$end_date.'" AND b.deleted_at IS NULL');

            if($query->num_rows() > 0) {

                $vehicle_ids = explode(",", $query->row()->ids);
                return $this->db->select(array('GROUP_CONCAT(id) AS ids'))->from(TBL_VEHICLE)->where(array('status' => 'active', 'deleted_at' => NULL))->where_not_in('id', array_unique($vehicle_ids))->get()->row()->ids;
            }
    }    

}//end class

?>
