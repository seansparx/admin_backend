<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class to manage logistic reports.
 * 
 * @author Sean Rock <sean@sparxitsolutions.com>
 * @version 1.0
 * @dated 17/02/2017
 */
class Reports extends MY_Controller 
{
    function __construct() 
    {        
        parent::__construct();

        has_access('reports');

        $this->load->model('admin/reports_model');        
    }

    
    /**
     * Display daily report
     * 
     * @return void
     */
    public function daily() 
    {
            switch ($this->input->post('report_type')) {

                case 'project'  : $this->data['reports'] = $this->reports_model->project_report();  break;
                case 'employee' : $this->data['reports'] = $this->reports_model->employee_report(); break;
                case 'vehicle'  : $this->data['reports'] = $this->reports_model->vehicle_report();  break;
                default         : $this->data['reports'] = $this->reports_model->project_report();
            }

            if($this->input->post('report_type')) {

                $this->data['report_type'] = $this->input->post('report_type');
            }

            if($this->input->post('report_date')) {

                $this->data['report_date'] = $this->input->post('report_date');
            }

            $this->render('reports/daily_report');
    }
    
    
    /**
     * Display weekly report
     * 
     * @return void
     */
    public function weekly()
    {
            $report_type = '';
            
            $this->data['from_date'] = $this->input->post('report_date') ? $this->input->post('report_date') : date("Y-m-d", strtotime("-6 days"));
            $this->data['to_date']   = date("Y-m-d", strtotime($this->data['from_date']." +6 days"));

            if($this->input->post('report_type')) {

                $report_type = $this->input->post('report_type');

                switch ($report_type) {

                    case 'employee' : $this->data['reports'] = $this->reports_model->get_weekly_report($this->data['from_date'], $this->data['to_date'], 'employee'); break;
                    case 'vehicle'  : $this->data['reports'] = $this->reports_model->get_weekly_report($this->data['from_date'], $this->data['to_date'], 'vehicle'); break;
                    default         : $this->data['reports'] = $this->reports_model->get_weekly_report($this->data['from_date'], $this->data['to_date'], 'employee');
                }
            }
            
            $this->data['report_type'] = $report_type;

            $this->render('reports/weekly_report');
    }
}
