<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Project_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_row() {
        return $this->db->where(array('deleted_at' => NULL))->count_all_results(TBL_PROJECT);
    }
    
    
    public function get_noe($project_id)
    {
        $count = 0; 
        $query = $this->db->query("SELECT b.employee_id FROM ".TBL_SERVICE." AS a LEFT JOIN ".TBL_SERVICE_DETAILS." AS b ON(b.service_id = a.id) WHERE a.project_id='".$project_id."'");
        
        if($query->num_rows() > 0){
           
            foreach ($query->result() as $row){
                
            }
            $count += count(explode(",", $row->employee_id));
        }
        
        return $count;
    }
    
    
    public function get_nov($project_id)
    {
        $count = 0; 
        $query = $this->db->query("SELECT b.vehicle_id FROM ".TBL_SERVICE." AS a LEFT JOIN ".TBL_SERVICE_DETAILS." AS b ON(b.service_id = a.id) WHERE a.project_id='".$project_id."'");
        
        if($query->num_rows() > 0){
           
            foreach ($query->result() as $row){
                
            }
            $count += count(explode(",", $row->vehicle_id));
        }
        
        return $count;
    }
    

    /*
     * Function for get all landing page details
     * @access public
     * @param $query_data (string)
     * @return array
     */

    public function fetch_row()
    {
        $this->db->select('*')->from(TBL_PROJECT)->where(array('deleted_at' => NULL));
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            
            return $department->result();
        }

    }
    
    
    public function fetch_projects($offset = 0, $limit = null, $order = null, $filter = null)
    {
        $this->db->select('*')->from(TBL_PROJECT)->where(array('deleted_at' => NULL));
        
        if(is_array($filter)){
            
            foreach ($filter as $column => $keyword){
                $this->db->like($column, $keyword);
                
                if($column == 'status'){
                    $this->db->where($column, $keyword);
                }
            }
        }
        
        if($limit){
            $this->db->limit($limit, $offset);
        }
                
        if(isset($order['column'])) {
            
            switch ($order['column']) {
                case 1: $this->db->order_by('id', $order['dir']); break;
                case 2: $this->db->order_by('emp_name', $order['dir']); break;
                case 3: $this->db->order_by('state', $order['dir']); break;
                case 4: $this->db->order_by('contract', $order['dir']); break;
                case 5: $this->db->order_by('category', $order['dir']); break;
                case 6: $this->db->order_by('created_at', $order['dir']); break;
                default: $this->db->order_by('id', 'desc'); break;
            }
        }
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            return $department->result();
        }
    }

    /*
     * Function for add Department page information
     * @access public
     * @param array ($data)
     * @return true/false
     */

    public function add_vehicle() 
    {
        $post = $this->input->post();
        
        $data = array(
            "code" => $post['code'],
            "customer_name" => $post['cust_name'],
            "description" => $post['description'],
            "status" => $post['status'],
            "added_by"   => $this->session->userdata(SITE_SESSION_NAME . 'ADMINID'),
            "created_at" => GMT_DATE_TIME,
            "updated_at" => GMT_DATE_TIME
        );
        
        $flag = $this->db->insert(TBL_PROJECT, $data);

        if($flag){
            $this->session->set_flashdata('success', 'Project has been added successfully!');        
            return $flag;
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
            "code" => $post['code'],
            "customer_name" => $post['cust_name'],
            "description" => $post['description'],
            "status" => $post['status'],
            "updated_at" => GMT_DATE_TIME
        );
        
        $this->db->where('id', $id)->update(TBL_PROJECT, $data);
        $this->session->set_flashdata('success', 'Project has been updated successfully!');
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
        $query = $this->db->where('id', $id)->get(TBL_PROJECT);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $result = $value;
            }
        }
        return $result;
    }

    /*
     * Function for Delete Landing page information
     * @access public
     * @param int ($id)
     * @return void
     */

    public function deleteRecord($id) 
    {
        if ($this->db->where('project_id', $id)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME))) {
            
            $this->db->where('id', $id)->update(TBL_PROJECT, array('deleted_at' => GMT_DATE_TIME));
            $this->session->set_flashdata('success', 'Project has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
        
        redirect("admin/project/manage");
    }
    
    
    public function deleteAll($ids) 
    {
        $ids = array_filter($ids);
        
        if ($this->db->where_in('project_id', $ids)->update(TBL_SERVICE, array('deleted_at' => GMT_DATE_TIME))) {
            
            $this->db->where_in('id', $ids)->update(TBL_PROJECT, array('deleted_at' => GMT_DATE_TIME));
            $this->session->set_flashdata('success', 'Your data has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
    }

}//end class

?>
