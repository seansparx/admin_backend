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
                    <a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo site_url('admin/settings/manage_role'); ?>">System Configuration</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Edit</span>
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
                            <span class="caption-subject font-dark sbold uppercase">Edit Settings</span>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->

                        <?php echo form_open('', array("id" => "system_config_form", "name" => "system_config_form", "class" => "form-horizontal"));?>
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                
                                <div class="form-group  margin-top-20">
                                    <label class="control-label col-md-3">Shift Start
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-2">
                                        <div class="input-icon">
                                        <i class="fa fa-clock-o"></i>
                                        <input type="text" name="SHIFT_START_TIME" id="start_time" value="<?php echo $sys_config['SHIFT_START_TIME']; ?>" class="form-control timepicker"> </div>
                                        <span class="help-block error"> <?php echo form_error("SHIFT_START_TIME"); ?> </span>
                                    </div>
                                </div>
                                <div class="form-group  margin-top-20">
                                    <label class="control-label col-md-3">Shift End
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-2">
                                        <div class="input-icon">
                                        <i class="fa fa-clock-o"></i>
                                        <input type="text" name="SHIFT_END_TIME" id="end_time" value="<?php echo $sys_config['SHIFT_END_TIME']; ?>" class="form-control timepicker"> </div>
                                        <span class="help-block error"> <?php echo form_error("SHIFT_END_TIME"); ?> </span>
                                    </div>
                                </div>
                                
                                <div class="form-group  margin-top-20">
                                    <label class="control-label col-md-3">Timezone
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-3">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <?php
                                                echo form_dropdown('TIMEZONE', $timezones, $sys_config['TIMEZONE'], 'class="form-control" id="status" data-required="1"');
                                            ?>
                                            <span class="help-block error"> <?php echo form_error("TIMEZONE"); ?> </span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Update</button>
                                        <button type="button" onclick="location.href = '<?php echo site_url('admin/'); ?>'" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <script>
        
        // with time only.
        $('#start_time').timepicker({
            defaultTime:'09:00',
            minuteStep: 1,
            secondStep: 1,
            showInputs: true,
            disableFocus: true
        });
        
        $('#end_time').timepicker({
            defaultTime:'18:00',
            minuteStep: 1,
            secondStep: 1,
            showInputs: true,
            disableFocus: true
        });

        $('#role_modules').jstree({
            "plugins" : [ "checkbox" ],
            "core": {
                "themes":{
                    "icons":false
                }
            }
        });

        $('#role_modules').on('changed.jstree', function (e, data) {

              var i, j, r = [];

              for(i = 0, j = data.selected.length; i < j; i++) {
                  r.push(data.instance.get_node(data.selected[i]).state.module_id);
              }


              $('#event_result').val(r.join(','));

        }).jstree();

    </script>
    