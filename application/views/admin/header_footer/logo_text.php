 
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
                                    <a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Edit Logo Text</span>
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
                                            <span class="caption-subject font-dark sbold uppercase">Edit Logo Text</span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo site_url('admin/systemconfiguration/logoText');?>" id="text_code_form" method="post" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                               <input type="hidden" name="id" id="id" value="<?php echo $logo_text->id; ?>">
                                               
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Logo Text1
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <textarea rows="3" class="form-control" name="logo_text1" id="body_code"><?php echo $logo_text->logo_text1; ?></textarea>
                                                        <?php echo form_error("logo_text1"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Logo Text2
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <textarea rows="3" class="form-control" name="logo_text2" id="logo_text2"><?php echo $logo_text->logo_text2; ?></textarea>
                                                        <?php echo form_error("logo_text2"); ?>
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
