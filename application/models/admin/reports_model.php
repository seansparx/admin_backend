<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Reports_model extends CI_Model 
{

    public function __construct() 
    {
        parent::__construct();
    }

    
    
    public function count_row() 
    {
        return $this->db->where(array('deleted_at' => NULL))->count_all_results(TBL_SERVICE);
    }

    
    
    public function project_report() 
    {
        $report_date = date("Y-m-d");
        
        if($this->input->post('report_date')) {
            
            $report_date = $this->input->post('report_date');
        }
        
        $this->db->select(array('a.*', 'b.service_title', 'd.code AS project', 'c.name AS department_name'))
                ->from(TBL_SERVICE_DETAILS . ' AS a')
                ->join(TBL_SERVICE . ' AS b', 'b.id = a.service_id', 'left')
                ->join(TBL_DEPARTMENT . ' AS c', 'c.id = b.department_id', 'left')
                ->join(TBL_PROJECT . ' AS d', 'd.id = b.project_id', 'left')
                ->where(array('a.deleted_at' => NULL));
        
        $this->db->where('a.service_date', $report_date);
        
        $report = $this->db->order_by('b.project_id')->get();

        if ($report->num_rows() > 0) {
            
            return $report->result();
        }
    }
    
    
    public function employee_report() 
    {
        $report_date = date("Y-m-d");
        
        if($this->input->post('report_date')) {
            
            $report_date = $this->input->post('report_date');
        }
        
        /** Get list of employees */
        
        $result = $this->db->select(array("GROUP_CONCAT(employee_id) AS employees"))->get_where(TBL_SERVICE_DETAILS, array( 'service_date' => $report_date, "deleted_at" => null));

        if ($result->num_rows() > 0) {

            $records = array();
            
            $employees = array_unique(explode(",", $result->row()->employees));
            
            sort($employees);
            
            /** Get report of each employee */
            
            foreach($employees as $emp_id) {
                
                $report = $this->db->select(array('a.id', 'a.service_date', 'a.start_time', 'a.end_time', 'a.employee_id', 'b.service_title', 'd.code AS project_name', 'c.name AS department_name'))
                            ->from(TBL_SERVICE_DETAILS . ' AS a')
                            ->join(TBL_SERVICE . ' AS b', 'b.id = a.service_id', 'left')
                            ->join(TBL_DEPARTMENT . ' AS c', 'c.id = b.department_id', 'left')
                            ->join(TBL_PROJECT . ' AS d', 'd.id = b.project_id', 'left')
                            ->where(array("FIND_IN_SET('$emp_id',a.employee_id) !=" => 0, 'a.service_date' => $report_date, 'a.deleted_at' => NULL))
                            ->order_by("id")->get();

                if($report->num_rows() > 0) {
                    
                    foreach($report->result() as $row){
                        
                        $row->emp_name = $this->db->select("emp_name")->get_where(TBL_EMPLOYEE, array("id" => $emp_id))->row()->emp_name;
                        $records[$emp_id][] = $row;
                    }
                }
                
            }

            return $records;
        }
    }
    
    
    
    public function get_weekly_report($from, $to, $type = 'employee')
    {
            if($type == 'employee') {
                
                return $this->employee_weekly_report($from, $to);
            }
            
            if($type == 'vehicle') {
                
                return $this->vehicle_weekly_report($from, $to);
            }

    }
        
    
    
    private function vehicle_weekly_report($from, $to)
    {
            $report = array();

            /** Get list of employees */
            $result = $this->db->select(array("id", "regn_number", "model"))->get_where(TBL_VEHICLE, array("status" => 'active', "deleted_at" => null));

            if ($result->num_rows() > 0) {

                    /** Get report of each employee */
                    foreach($result->result() as $obj)
                    {
                        $veh_id = $obj->id;

                        $report[$veh_id]['emp_name'] = $obj->regn_number;
                        $report[$veh_id]['emp_code'] = $obj->model;

                        /** Get weekly data */
                        for($d = $from; $d <= $to; $d = date("Y-m-d", strtotime($d." +1 day"))) {

                            $report[$veh_id][$d] = $this->get_vehicle_report($veh_id, $d);
                        }
                    }

            }

            return $report;
    }
    
    
    
    private function employee_weekly_report($from, $to)
    {
            $report = array();
            
            /** Get list of employees */
            $result = $this->db->select(array("id","emp_name"))->get_where(TBL_EMPLOYEE, array("status" => 'active', "deleted_at" => null));

            if ($result->num_rows() > 0) {
                
                    /** Get report of each employee */
                    foreach($result->result() as $obj)
                    {
                        $emp_id = $obj->id;
                        
                        $report[$emp_id]['emp_name'] = $obj->emp_name;
                        $report[$emp_id]['emp_code'] = emp_code($emp_id);
                        
                        /** Get weekly data */
                        for($d = $from; $d <= $to; $d = date("Y-m-d", strtotime($d." +1 day"))) {
                            
                            $report[$emp_id][$d] = $this->get_employee_report($emp_id, $d);
                        }
                    }

            }

            return $report;
    }


    public function human_weekly_report_model($from, $to)
    {

            $report = array();
            
            /** Get list of employees */
            $result = $this->db->select(array("GROUP_CONCAT(employee_id) AS employees"))
                    ->where('service_date >=', $from)
                    ->where('service_date <=', $to)                
                    ->get_where(TBL_SERVICE_DETAILS, array("deleted_at" => null));

            if ($result->num_rows() > 0) {

                $employees = array_unique(explode(",", $result->row()->employees));

                sort($employees);

                    /** Get report of each employee */
                    foreach($employees as $emp_id)
                    {

                        //$emp_name = $this->db->select("emp_name")->get_where(TBL_EMPLOYEE, array("id" => $emp_id))->row()->emp_name;
                        $emp_obj = $this->db->select("id, emp_name")->get_where(TBL_EMPLOYEE, array("id" => $emp_id))->row();
                        
                        $report[$emp_id]['emp_name'] = $emp_obj->emp_name;
                        $report[$emp_id]['emp_code'] = emp_code($emp_obj->id);
                        
                        /** Get monthly data */
                        for($d = $from; $d <= $to; $d = date("Y-m-d", strtotime($d." +1 day"))) {
                            
                            $report[$emp_id][$d] = $this->get_employee_data($emp_id, $d);
                        }
                    }

            }

            return $report;

            // echo "<pre>";
            // print_r($report);
            // die;


    }

    private function get_employee_data($emp_id, $report_date)
    {

                $report = $this->db->select("*")
                            ->from('ld_timesheet')
                            ->where(array("FIND_IN_SET('$emp_id',emp_id) !=" => 0, 'deleted_at' => NULL,'entry_date'=>$report_date))
                            ->order_by("id")->get();
                if($report->num_rows() > 0) {
                  return $report->row();
                }


    }
    
        
    private function get_employee_report($emp_id, $report_date)
    {
                $report = $this->db->select(array('a.id', 'a.start_time', 'a.end_time', 'b.service_title', 'd.code AS project_name'))
                            ->from(TBL_SERVICE_DETAILS . ' AS a')
                            ->join(TBL_SERVICE . ' AS b', 'b.id = a.service_id', 'left')
                            ->join(TBL_DEPARTMENT . ' AS c', 'c.id = b.department_id', 'left')
                            ->join(TBL_PROJECT . ' AS d', 'd.id = b.project_id', 'left')
                            ->where(array("FIND_IN_SET('$emp_id',a.employee_id) !=" => 0, 'a.service_date' => $report_date, 'a.deleted_at' => NULL, 'b.deleted_at' => NULL))
                            ->order_by("id")->get();

                if($report->num_rows() > 0) {
                    
                    return $report->row();
                }
    }
    
    
    private function get_vehicle_report($veh_id, $report_date)
    {
            $report = $this->db->select(array('a.id', 'a.start_time', 'a.end_time', 'b.service_title', 'd.code AS project_name'))
                        ->from(TBL_SERVICE_DETAILS . ' AS a')
                        ->join(TBL_SERVICE . ' AS b', 'b.id = a.service_id', 'left')
                        ->join(TBL_DEPARTMENT . ' AS c', 'c.id = b.department_id', 'left')
                        ->join(TBL_PROJECT . ' AS d', 'd.id = b.project_id', 'left')
                        ->where(array("FIND_IN_SET('$veh_id',a.vehicle_id) !=" => 0, 'a.service_date' => $report_date, 'a.deleted_at' => NULL, 'b.deleted_at' => NULL))
                        ->order_by("id")->get();

            if($report->num_rows() > 0) {

                return $report->row();
            }
    }
    
        
    public function vehicle_report() 
    {
        $report_date = date("Y-m-d");
        
        if($this->input->post('report_date')) {
            
            $report_date = $this->input->post('report_date');
        }
        
        /** Get list of employees */
        
        $result = $this->db->select(array("GROUP_CONCAT(vehicle_id) AS vehicles"))->get_where(TBL_SERVICE_DETAILS, array( 'service_date' => $report_date, "deleted_at" => null));

        if ($result->num_rows() > 0) {

            $records = array();
            
            $vehicles = array_unique(explode(",", $result->row()->vehicles));
            
            /** Get report of each employee */
            
            foreach($vehicles as $vehicle_id) {
                
                $report = $this->db->select(array('a.id', 'a.service_date', 'a.start_time', 'a.end_time', 'a.vehicle_id', 'b.service_title', 'd.code AS project_name', 'c.name AS department_name'))
                            ->from(TBL_SERVICE_DETAILS . ' AS a')
                            ->join(TBL_SERVICE . ' AS b', 'b.id = a.service_id', 'left')
                            ->join(TBL_DEPARTMENT . ' AS c', 'c.id = b.department_id', 'left')
                            ->join(TBL_PROJECT . ' AS d', 'd.id = b.project_id', 'left')
                            ->where(array("FIND_IN_SET('$vehicle_id',a.vehicle_id) !=" => 0, 'a.service_date' => $report_date, 'a.deleted_at' => NULL))
                            ->order_by("id")->get();

                if($report->num_rows() > 0) {
                    
                    foreach($report->result() as $row){
                        
                        $obj = $this->db->select("regn_number, model")->get_where(TBL_VEHICLE, array("id" => $vehicle_id))->row();
                        
                        $row->regn_number = $obj->regn_number;
                        $row->model_no    = $obj->model;
                        
                        $records[$vehicle_id][] = $row;
                    }
                }
                
            }

            return $records;
        }
    }

}

//end class
?>
