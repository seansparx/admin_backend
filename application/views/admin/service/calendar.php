 
<?php
if ($data_type == 'vehicle') {
    $page_title = '<span>Vehicles Availability</span>';
} else if ($data_type == 'employee') {
    $page_title = '<span>Employees Availability</span>';
}
?>
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
                    <?php echo $page_title; ?>                    
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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"> <?php echo $page_title; ?></span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">

                                <?php
                                if ($data_type == 'vehicle') {
                                    ?>
                                    <button onClick="location.href = '<?php echo site_url('admin/service/calendar/employee'); ?>'" id="sample_editable_1_new" class="btn sbold green"> <i class="fa fa-user"></i> Employees Availability</button>
                                    <?php
                                } else if ($data_type == 'employee') {
                                    ?>
                                    <button onClick="location.href = '<?php echo site_url('admin/service/calendar/vehicle'); ?>'" id="sample_editable_1_new" class="btn sbold green"> <i class="fa fa-car"></i> Vehicles Availability</button>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="btn-group">
                                <button onClick="location.href = '<?php echo site_url('admin/service/manage'); ?>'" id="sample_editable_1_new" class="btn sbold blue"> < Go Back</button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id='service_calendar'></div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>


    </div>
</div>
<!-- END CONTENT BODY -->

<script>

    $(document).ready(function () {

        load_cal_data();
    });

    function load_cal_data(d)
    {
        $.getJSON("<?php echo site_url('admin/service/get_services') ?>", {"data_type": '<?php echo $data_type; ?>', "month": d}, function (data) {

            $('#service_calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: false,
                eventLimit: true, // for all non-agenda views
                viewRender: function (view, element) {

                    if (view.intervalStart.format()) {

                        load_cal_data(view.intervalStart.format());

                    }
                }
            });

            $('#service_calendar').fullCalendar('removeEvents');
            $('#service_calendar').fullCalendar('addEventSource', data, true);

        });



    }

</script>


