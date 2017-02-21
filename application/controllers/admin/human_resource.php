<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Variants Class
 * @author Rajesh Kumar Yadav
 * @version 1.0
 * @dated 20/01/2017
 */
class Human_resource extends MY_Controller {
    
      function __construct() 
    {        
        parent::__construct();

        has_access('reports');

        $this->load->model('admin/reports_model');        
    }


      /**
     * Display weekly report
     * 
     * @return void
     */
    public function weekly()
    {
            $this->data['from_date'] = $this->input->post('report_date') ? $this->input->post('report_date') : date("Y-m-d", strtotime("-6 days"));
            $this->data['to_date']   = date("Y-m-d", strtotime($this->data['from_date']." +6 days"));

            $this->data['from_date']="2017-02-01";
            $this->data['to_date']="2017-02-28";


            if($this->input->post('report_type')) {

                $this->data['report_type'] = $this->input->post('report_type');

                // switch ($this->input->post('report_type')) {

                //     case 'employee' : $this->data['reports'] = $this->reports_model->human_weekly_report($this->data['from_date'], $this->data['to_date'], 'employee'); break;
                //     case 'vehicle'  : $this->data['reports'] = $this->reports_model->get_weekly_report($this->data['from_date'], $this->data['to_date'], 'vehicle'); break;
                //     default         : $this->data['reports'] = $this->reports_model->get_weekly_report($this->data['from_date'], $this->data['to_date'], 'employee');
                // }


                $this->data['reports']=$this->reports_model->human_weekly_report_model($this->data['from_date'], $this->data['to_date']);
            }

            $this->render('reports/human_weekly_report');
    }


}




