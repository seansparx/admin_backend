 
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
                                    <a href="<?php echo site_url('admin/department/manage');?>">Department Management</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Edit Brand</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                      
                        <div class="row">
                            <div class="col-md-12">
                                 
                                <!-- BEGIN VALIDATION STATES-->
                                <div class="portlet light portlet-fit portlet-form bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject font-dark sbold uppercase">Edit Department</span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="portlet-body">
                                        <!-- BEGIN FORM-->
                                        
                                        <form action="<?php echo site_url('admin/department/edit/'.$details['id']);?>"  method="post" id="department_form"  class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                                <div class="alert alert-success display-hide">
                                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Department Name
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" class="form-control" name="name" id="name" data-required="1" value='<?php echo $details['name']; ?>' />
                                                            <?php echo form_error("name"); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Description</label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <textarea class="form-control" name="description" id="description" data-required="1" rows="4" cols="50"><?php echo $details['description']; ?> </textarea>
                                                            <?php echo form_error("description"); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group  margin-top-20">
                                                    <label class="control-label col-md-3">Status
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <?php
                                                                $options = array(
                                                                    '' => '-- Select Status --',
                                                                    'active' => 'Active',
                                                                    'inactive' => 'Inactive');
                                                                echo form_dropdown('status', $options, $details['status'], 'class="form-control" id="status" data-required="1"');
                                                            ?>
                                                            <span class="help-block error"> <?php echo form_error("status"); ?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>
                
              </div>
                                               
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Submit</button>
                                                        <button type="button" onclick="location.href='<?php echo site_url('admin/department/manage');?>'" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <!-- END VALIDATION STATES-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
