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
    
    function __construct() {
        parent::__construct();
        
        has_access('manage_timesheet');
        
        $this->load->model('admin/project_model');
    }
    
    /*
     * function manage():-To display brand list 
     */
    public function manage() 
    {
        //$this->data['content_datas']     = $this->project_model->fetch_row();
                
        //$this->render('timesheet/manage');
        
         $this->render('timesheet/index');
    }
    
    
    /*
     * function For Create Landing page
     */
    public function add() {
        
        if($this->input->post()){
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('code', 'Project Code', 'required');
            $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            
            if ($this->form_validation->run() === TRUE) {
                
                $this->project_model->add_vehicle();
                redirect('admin/timesheet/manage');
            } 
         }
         
        $this->render('timesheet/add');		
   }
    
   
         
    
    
    /*
     * Function for delete
     * @param int $id
     */
    public function delete($id) {
                
        $this->project_model->deleteRecord($id);
    }
    
     /*
      * Function for create duplicate landing page
      * @access public
      * @param int $id
     */
    public function edit($id)
    {      
        $data=null;
        if($this->input->post()) {
           
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('code', 'Project Code', 'required');
            $this->form_validation->set_rules('cust_name', 'Customer Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
           
            if (($this->form_validation->run() === TRUE)){
                $this->project_model->update_vehicle($id);
                redirect("admin/timesheet/manage");
            }

            $data['id'] = $id;
        }
        
        $data['details'] = $this->project_model->getEditRecord($id);
        
        $this->data = $data;
        $this->render('timesheet/edit');
    }
  
}


