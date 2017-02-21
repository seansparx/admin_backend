 
<div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                       
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo site_url();?>">Dashboard</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Manage Tracking Code</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                      
                        <div class="row">
                            <div class="col-md-12">
                                 <?php if ($this->session->flashdata('success') != "") { ?>
                                        <div class="alert alert-success ">
                                                    <button class="close" data-close="alert"></button> <?= $this->session->flashdata('success') ?> </div>
                                    <?php } ?>
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject font-dark sbold uppercase">Manage Tracking Code</span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo site_url('admin/systemconfiguration/trackingCode');?>" id="tracking_form" method="post" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                               <input type="hidden" name="id" id="id" value="<?php echo $tracking_code->id; ?>">
                                               
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tracking code for body
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <textarea rows="3" class="form-control" name="body_code" id="body_code"><?php echo $tracking_code->body_code; ?></textarea>
                                                        <?php echo form_error("body_code"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tracking code for head
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <textarea rows="3" class="form-control" name="head_code" id="head_code"><?php echo $tracking_code->head_code; ?></textarea>
                                                        <?php echo form_error("head_code"); ?>
                                                    </div>
                                                </div>
                                                
                                             </div>
                                              
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                             
                                        </form>
                                        <!-- END FORM-->
                                    
                                    
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
