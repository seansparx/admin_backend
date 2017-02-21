<style>
    ul{ list-style: none; margin: 0; padding: 0}
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Reports</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Weekly Report</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"></h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold uppercase">Weekly Report</span>
                        </div>
                        <div class="actions">
                            <?php echo form_open('', array("id" => "filter_form")); ?>
                            <div class="btn-group">                                                    
                                <?php
                                    $options = array("employee" => "Employees", "vehicle" => "Vehicles");

                                    echo form_dropdown('report_type', $options, $report_type, "class='bs-select form-control input-small' data-style='btn-primary'");
                                ?>                                                    
                            </div>
                            
                            <div class="btn-group">
                                <div class="input-group input-medium">
                                    <input type="text" id="report_date" name="report_date" value="<?php echo $from_date ? $from_date : date("Y-m-d"); ?>" class="form-control" readonly>
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
                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <center><h3>Week - <?php echo idate("W", strtotime($from_date)); ?></h3><small>( <?php echo display_date($from_date); ?> - <?php echo display_date($to_date); ?> )</small></center>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> <?php echo ($report_type == 'vehicle') ? 'Vehicle' : 'Employee'?> Name </th>
                                        <?php
                                        for ($d = $from_date; $d <= $to_date; $d = date("Y-m-d", strtotime($d . " +1 day"))) {

                                            echo '<th><b>' . display_date($d) . '</b> ( ' . date("l", strtotime($d)) . ' )</th>';
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($reports) && count($reports) > 0) {
                                        $i = 1;
                                        foreach ($reports as $emp_id => $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $reports[$emp_id]['emp_name'] . ' (' . $reports[$emp_id]['emp_code'] . ')'; ?></td>
                                                <?php
                                                for ($d = $from_date; $d <= $to_date; $d = date("Y-m-d", strtotime($d . " +1 day"))) {
                                                    ?>
                                                    <td>
                                                        <ul>
                                                            <?php
                                                            if (isset($reports[$emp_id][$d]->project_name)) {

                                                                echo '<li><b>' . $reports[$emp_id][$d]->project_name . '</b></li>';
                                                                echo '<li>Start Time : ' . display_time($reports[$emp_id][$d]->start_time) . '</li>';
                                                                echo '<li>End Time : ' . display_time($reports[$emp_id][$d]->end_time) . '</li>';
                                                            } else {
                                                                echo '<li>---</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>    
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr><td colspan="9">No report found</td></tr>    
                                        <?php
                                    }
                                    ?>  
                                </tbody>
                            </table>

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

    $(document).ready(function () {

        // with date only.
        $("#report_date").datetimepicker({
            format: 'yyyy-mm-dd',
            endDate: '+6m',
            minView: 2, // this forces the picker to not go any further than days view
            pickerPosition: "bottom-left"

        }).on('changeDate', function (selected) {

        });

    });

</script>