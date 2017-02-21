<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Tables</span>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Daily Report</h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            
                            <div class="col-md-12">
                                <!-- BEGIN BORDERED TABLE PORTLET-->
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-bubble font-dark"></i>
                                            <span class="caption-subject font-dark bold uppercase">Daily Report <small><?php echo display_date($report_date); ?></small></span>
                                        </div>
                                        <div class="actions">
                                            <?php echo form_open('', array("id" => "filter_form")); ?>
                                                <div class="btn-group">                                                    
                                                    <?php
                                                        $options = array("project" => "Project Daily Report", "employee" => "Employee Daily Report", "vehicle" => "Vehicle Daily Report");
                                                        
                                                        echo form_dropdown('report_type', $options, $report_type, "class='bs-select form-control input-medium' data-style='btn-primary'");
                                                    ?>                                                    
                                                </div>
                                                <div class="btn-group">
                                                    <div class="input-group input-medium">
                                                        <input type="text" id="report_date" name="report_date" value="<?php echo $report_date ? $report_date : date("Y-m-d"); ?>" class="form-control" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="btn-group">
                                                    <div class="input-group input-medium">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary" type="submit">Go</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable">
                                            
                                            <?php

                                                if(count($reports) > 0){

                                                    $i = 1;

                                                    if($report_type == 'vehicle') {

                                                        ?>
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th> # </th>
                                                                    <th> Vehicle Model </th>
                                                                    <th> Vehicle Registration Number </th>
                                                                    <th> Project Title </th>
                                                                    <th> Service Title </th>
                                                                    <th> Department </th>
                                                                    <th> Starting Time</th>
                                                                    <th> Ending Time </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    foreach($reports as $emp_id => $arr) {

                                                                            foreach ($arr as $obj) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $i++;?></td>
                                                                                        <td><?php echo $obj->model_no; ?></td>
                                                                                        <td><?php echo $obj->regn_number; ?></td>                                                                                        
                                                                                        <td><?php echo $obj->project_name; ?> </td>
                                                                                        <td><?php echo $obj->service_title; ?></td>
                                                                                        <td><?php echo $obj->department_name; ?></td>
                                                                                        <td><?php echo display_time($obj->start_time); ?></td>
                                                                                        <td><?php echo display_time($obj->end_time); ?></td>
                                                                                    </tr>    
                                                                                <?php
                                                                            }
                                                                    }                                                            
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                    
                                                    else if($report_type == 'employee') {

                                                        ?>
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th> #ID </th>
                                                                    <th> Employee Name </th>
                                                                    <th> Project Title </th>
                                                                    <th> Service Title </th>
                                                                    <th> Department </th>
                                                                    <th> Starting Time</th>
                                                                    <th> Ending Time </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    foreach($reports as $emp_id => $arr) {

                                                                            foreach ($arr as $obj) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo emp_code($emp_id);?></td>
                                                                                        <td>
                                                                                            <span class="label label-sm label-success"> <?php echo $obj->emp_name; ?> </span>
                                                                                        </td>
                                                                                        <td><?php echo $obj->project_name; ?> </td>
                                                                                        <td><?php echo $obj->service_title; ?></td>
                                                                                        <td><?php echo $obj->department_name; ?></td>
                                                                                        <td><?php echo display_time($obj->start_time); ?></td>
                                                                                        <td><?php echo display_time($obj->end_time); ?></td>
                                                                                    </tr>    
                                                                                <?php
                                                                            }
                                                                    }                                                            
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                    
                                                    else{

                                                        ?>
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th> # </th>
                                                                    <th> Project Title </th>
                                                                    <th> Service Title </th>
                                                                    <th> Department </th>
                                                                    <th> Assigned Staff </th>
                                                                    <th> Assigned Vehicle </th>
                                                                    <th> Starting Time</th>
                                                                    <th> Ending Time </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    foreach ($reports as $obj) {

                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $i++;?></td>
                                                                                <td><?php echo $obj->project; ?></td>
                                                                                <td><?php echo $obj->service_title; ?></td>
                                                                                <td><?php echo $obj->department_name; ?></td>

                                                                                <td>
                                                                                    <?php echo emp_name_from_ids($obj->employee_id); ?>
                                                                                </td>
                                                                                <td>
                                                                                 <?php echo vehicle_name_from_ids($obj->vehicle_id); ?> 
                                                                                </td>
                                                                                <td><?php echo display_time($obj->start_time); ?></td>
                                                                                <td><?php echo display_time($obj->end_time); ?></td>
                                                                            </tr>    
                                                                        <?php
                                                                    }                                                                
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                    <p>No report found</p>
                                                    <?php
                                                }

                                                ?>
                                                                        
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- END BORDERED TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
</div>
<!-- END CONTENT BODY -->
    <script>

	$(document).ready(function() {
            
                // with date only.
                $("#report_date").datetimepicker({
                    format: 'yyyy-mm-dd',
                    endDate: '+6m',
                    minView: 2, // this forces the picker to not go any further than days view
                    pickerPosition: "bottom-left"
                    
                }).on('changeDate', function(selected){
                    
                });
                
	});
        
    </script>