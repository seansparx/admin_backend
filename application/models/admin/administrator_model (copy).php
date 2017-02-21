<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
    }
    
    
    public function count_row(){
        return $this->db->count_all_results(TBL_ROLE);
    }
    
    
    public function fetch_row($ids = null)
    {
        $this->db->select('*')->from(TBL_ROLE)->where(array('deleted_at' => NULL));
        
        if(is_array($ids) && (count($ids) > 0)) {
            $this->db->where_in('id', $ids);
        }
        
        $department = $this->db->order_by('id', 'desc')->get();

        if ($department->num_rows() > 0) {
            
            return $department->result();
        }
    }
        
    
    public function fetch_roles($offset = 0, $limit = null, $order = null, $filter = null)
    {
        $this->db->select('*')->from(TBL_ROLE)->where(array('deleted_at' => NULL));
        
        if(is_array($filter)){
            
            foreach ($filter as $column => $keyword){
                $this->db->like($column, $keyword);
                
                if($column == 'status') {
                    $this->db->where($column, $keyword);
                }
            }
        }
        
        if($limit){
            $this->db->limit($limit, $offset);
        }
                
        if(isset($order['column'])) {
            
            switch ($order['column']) {
                
                case 2:  $this->db->order_by('title', $order['dir']); break;
                case 3:  $this->db->order_by('description',  $order['dir']); break;
                case 5:  $this->db->order_by('created_at',  $order['dir']); break;
                default: $this->db->order_by('id', 'desc'); break;
            }
        }
        
        $department = $this->db->get();

        if ($department->num_rows() > 0) {
            return $department->result();
        }
    }
    
    
    public function fetch_modules()
    {
        $main_menus = $this->db->select("*")->from(TBL_PERMISSION)->where(array("parent_id" => 0))->order_by('sort', 'asc')->get()->result();
                
        if(is_array($main_menus)){
            
            foreach($main_menus as $main) {

                $main->sub_menus = $this->db->select("*")->from(TBL_PERMISSION)->where(array("parent_id" => $main->id))->order_by('sort', 'asc')->get()->result();
                
            }
        }
        
        return $main_menus;
    }
}

?>
