<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_row() {
        return $this->db->where(array('deleted_at' => NULL))->count_all_results(TBL_EMPLOYEE);
    }

    /*
     * Function for get all landing page details
     * @access public
     * @param $query_data (string)
     * @return array
     */

    public function fetch_row($ids = null)
    {
        $this->db->select('*')->from(TBL_EMPLOYEE)->where(array('deleted_at' => NULL));
        
        if(is_array($ids) && (count($ids) > 0)){
            $this->db->where_in('id', $ids);
        }
        
        $query = $this->db->order_by('emp_name', 'asc')->get();

        if ($query->num_rows() > 0) {
            
            return $query->result();
        }
    }
    
    
    public function fetch_employees($offset = 0, $limit = null, $order = null, $filter = null)
    {
        $this->db->select('*')->from(TBL_EMPLOYEE)->where(array('deleted_at' => NULL));
        
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

    public function add_employee() 
    {
        $post = $this->input->post();
        
        $data = array(
            "emp_name" => $post['emp_name'],
            "state" => $post['state'],
            "contract" => $post['contract'],
            "category" => $post['category'],
            "status" => $post['status'],
            "added_by"   => $this->session->userdata(SITE_SESSION_NAME . 'ADMINID'),
            "created_at" => GMT_DATE_TIME,
            "updated_at" => GMT_DATE_TIME
        );
        
        $flag = $this->db->insert(TBL_EMPLOYEE, $data);

        if($flag){
            $this->session->set_flashdata('success', 'Employee has been added successfully!');        
            return $flag;
        }
    }

    /*
     * Function for update department information
     * @access public
     * @param array ($data)
     * @return true/false
     */

    public function update_employee($id) 
    {
        $post = $this->input->post();
        
        $data = array(
            "emp_name" => $post['emp_name'],
            "state" => $post['state'],
            "contract" => $post['contract'],
            "category" => $post['category'],
            "status" => $post['status'],
            "updated_at" => GMT_DATE_TIME
        );
        
        $this->db->where('id', $id)->update(TBL_EMPLOYEE, $data);
        $this->session->set_flashdata('success', 'Employee has been updated successfully!');
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
        $query = $this->db->where('id', $id)->get(TBL_EMPLOYEE);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $result = $value;
            }
        }
        return $result;
    }
    
    
    public function get_nos($employee_id)
    {
        $query = $this->db->query("SELECT a.service_id FROM ".TBL_SERVICE_DETAILS." AS a LEFT JOIN ".TBL_SERVICE." AS b ON(b.id = a.service_id) WHERE b.deleted_at IS NULL AND find_in_set(".$employee_id.",employee_id) GROUP BY service_id");
        return $query->num_rows();
    }
    
    
    public function get_name($emp_id) 
    {
        $result = array();
        $query = $this->db->select('emp_name')->where('id', $emp_id)->get(TBL_EMPLOYEE);
        
        if ($query->num_rows() > 0) {
            return $query->row()->emp_name;
        }
    }

    /*
     * Function for Delete Landing page information
     * @access public
     * @param int ($id)
     * @return void
     */

    public function deleteRecord($id) 
    {
        if ($this->db->where('id', $id)->update(TBL_EMPLOYEE, array("deleted_at" => GMT_DATE_TIME))){
            
            $this->session->set_flashdata('success', 'Employee has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
        
        redirect("admin/employee/manage");
    }
    
    
    public function deleteAll($ids) 
    {
        $ids = array_filter($ids);
        
        if ($this->db->where_in('id', $ids)->update(TBL_EMPLOYEE, array("deleted_at" => GMT_DATE_TIME))) {
            $this->session->set_flashdata('success', 'Your data has been deleted successfully!!!');
        } 
        else {
            $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
        }
    }

}//end class

?>
