                 
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
                    <span>Manage Timesheet</span>
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
                
                <?php if ($this->session->flashdata('error') != "") { ?>
                    <div class="alert alert-danger ">
                        <button class="close" data-close="alert"></button> <?= $this->session->flashdata('error') ?> </div>
                <?php } ?>

                <!-- Begin: Demo Datatable 1 -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Manage Timesheet</span>
                        </div>
                        <div class="actions">
                            
                            <div class="btn-group">
                                <button onClick="location.href = '<?php echo site_url('admin/timesheet/add'); ?>'" id="sample_editable_1_new" class="btn sbold green"> Add New Entry
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span> </span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">- Select Action -</option>
                                    <option value="delete_all">Delete All</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit">
                                    <i class="fa fa-check"></i> Submit</button>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_services">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="20">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                       
                                        <th width="130">Entry Date</th>
                                        <th width="115">Emp. Code</th>
                                        <th width="115">Emp. Name</th>
                                        <th width="115">Initial Time</th>
                                        <th width="115">Ending Time</th> 
                                        <th width="115">Total Hours</th>   
                                        <th width="115">Extra Hours</th>                                     
                                        <th width="145">Remark</th>
                                        <!--<th width="145">Created On</th>-->
                                        <th width="250">Actions</th>
                                    </tr>
                                    <tr class="filter" role="row">
                                        <td rowspan="1" colspan="1"> </td>
                                        
                                         <td rowspan="1" colspan="1">
                                            <div data-date-format="dd/mm/yyyy" class="input-group date date-picker margin-bottom-5">
                                                <input type="text" placeholder="Date" name="filter_entry_date" readonly="" class="form-control form-filter input-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-sm default">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        
                                           <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5">
                                               <input type="text" placeholder="Emp Code" name="filter_employee_code" class="form-control form-filter input-sm"> </div>
                                        </td>
										
										  <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5">
                                                <input type="text" placeholder="Emp Name" name="filter_employee_name" class="form-control form-filter input-sm"> </div>
                                        </td>
                                        
                                       
                                      
                                      
                                       
                                        <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5 input-icon">
                                                <i class="fa fa-clock-o"></i>
                                                <input type="text" placeholder="Time" name="filter_start_time" class="form-control timepicker form-filter filter_timepicker input-sm"> </div>
                                        </td>
                                        <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5 input-icon">
                                                <i class="fa fa-clock-o"></i>
                                                <input type="text" placeholder="Time" name="filter_end_time" class="form-control timepicker form-filter filter_timepicker input-sm"> </div>
                                        </td>
                                        
                                        <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5 input-icon">
                                              
                                                <input type="text" placeholder="Hour" name="filter_total_hours" class="form-control  form-filter input-sm"> </div>
                                        </td>
                                        
                                         <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5 input-icon">
                                              
                                                <input type="text" placeholder="Hour" name="filter_extra_hours" class="form-control  form-filter input-sm"> </div>
                                        </td>
                                      
                                       
                                        
                                          
										
										  <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5">
                                                <input type="text" placeholder="Remark" name="filter_remark" class="form-control form-filter input-sm"> </div>
                                        </td>
                                        
										<!--
                                         <td rowspan="1" colspan="1">
                                            <div data-date-format="dd/mm/yyyy" class="input-group date date-picker margin-bottom-5">
                                                <input type="text" placeholder="Date" name="filter_date_created" readonly="" class="form-control form-filter input-sm">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-sm default">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>-->
												
                                        </td>
                                        
                                        <td rowspan="1" colspan="1">
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                    <i class="fa fa-search"></i> Search</button>
                                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i> Reset</button>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: Demo Datatable 1 -->




            </div>
        </div>


    </div>
</div>
<!-- END CONTENT BODY -->

<script>
    var ServiceDatatablesAjax = function () {

        var handleDemo = function () {

            var grid = new Datatable();

            grid.init({
                src: $("#datatable_services"),
                onSuccess: function (grid, response) {
                    // grid:        grid object
                    // response:    json object of server side ajax response
                    // execute some code after table records loaded
                },
                onError: function (grid) {
                    // execute some code on network or other general error  
                },
                onDataLoad: function (grid) {
                    // execute some code on ajax data load
                },
                loadingMessage: 'Loading...',
                dataTable: {
                    // save datatable state(pagination, sort, etc) in cookie.
                    "bStateSave": true,
                    destroy: true,
                    "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                    // save custom filters to the state
                    "fnStateSaveParams": function (oSettings, sValue) {
                        $("#datatable_services tr.filter .form-control").each(function () {
                            sValue[$(this).attr('name')] = $(this).val();
                        });

                        return sValue;
                    },
                    // read the custom filters from saved state and populate the filter inputs
                    "fnStateLoadParams": function (oSettings, oData) {
                        //Load custom filters
                        $("#datatable_services tr.filter .form-control").each(function () {
                            var element = $(this);
                            if (oData[element.attr('name')]) {
                                element.val(oData[element.attr('name')]);
                            }
                        });

                        return true;
                    },
                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 10, // default record count per page
                    "ajax": {
                        "url": "<?php echo site_url('admin/timesheet/timesheet_ajax'); ?>", // ajax source
                    },
                    "order": [
                        [1, "asc"]
                    ]// set first column as a default sort by asc
                }
            });

            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {

                e.preventDefault();

                var action = $(".table-group-action-input", grid.getTableWrapper());

                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                    grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                }
                else if (action.val() == "") {
                    App.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'Please select an action',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
                else if (grid.getSelectedRowsCount() === 0) {
                    App.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'No record selected',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });

            //grid.setAjaxParam("customActionType", "group_action");
            //grid.getDataTable().ajax.reload();
            //grid.clearAjaxParams();
        }


        return {
            //main function to initiate the module
            init: function () {
                
                handleDemo();
            }

        };

    }();

    jQuery(document).ready(function () {
        ServiceDatatablesAjax.init();
    });


                $(".filter_timepicker").timepicker({
                    defaultTime:'',
                    minuteStep: 1,
                    secondStep: 1,
                    showInputs: true,
                    disableFocus: true
                });
</script>
