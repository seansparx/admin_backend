<!-- Content -->
<div id="content">
   
    <!-- Top navbar END -->
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('admin/adminarea'); ?>" class="glyphicons dashboard"><i></i> Dashboard</a></li>
        <li class="divider"><i class="icon-caret-right"></i></li>
        <li>Manage Header Footer</li>
    </ul>
 <h1>Manage Header Footer<div class="" style="float: right;"><a href="<?php echo site_url('admin/systemconfiguration/add'); ?>"><i class="icon-plus-sign"></i></a></div></h1>
    <?php if ($this->session->flashdata('success') != "") { ?>
        <ul id="notyfy_container_top" class="notyfy_container"><li class="notyfy_wrapper notyfy_success" style="cursor: pointer;"></li><li class="notyfy_wrapper notyfy_error" style="cursor: pointer;"></li><li class="notyfy_wrapper notyfy_success" style="cursor: pointer;"><div id="notyfy_207629937018548450" class="notyfy_bar"><div class="notyfy_message"><span class="notyfy_text"><strong><?= $this->session->flashdata('success') ?></strong></span></div></div></li></ul>
    <?php } ?> <?php if ($this->session->flashdata('errordata') != "") { ?>
        <ul id="notyfy_container_top" class="notyfy_container i-am-new"><li class="notyfy_wrapper notyfy_error" style="cursor: pointer;"><div id="notyfy_153907699986679550" class="notyfy_bar"><div class="notyfy_message"><span class="notyfy_text"><strong><?= $this->session->flashdata('errordata'); ?></strong> </span></div></div></li></ul>
    <?php } ?>
            
        <div class='Search-form'>
        <?php $js = 'name="pages-search" id="validateSubmitForm"  class="form-horizontal margin-none"'; ?>
        <?php echo form_open('admin/test/manage', $js); ?>
        <fieldset>
             <legend>Search</legend>
             <table>
                 <tr>
                    <td><?php echo form_label('Test name', 'search'); ?></td>
                    <td>                      
                    <?php
                        $data = array(
                                'name'        => 'search',
                                'value'       => $search,
                              );

                   echo form_input($data);
                   ?>
                    </td>
                    <td>
                        <?php echo form_submit('search_button', 'search'); ?>
                    </td>
                    <td>
                        <?php if(isset($search)){
                        echo anchor('admin/test/manage','Reset',array('class'=>'search_reset')); } ?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
    <div class="innerLR">
        <!-- Widget -->
        <div class="widget widget-heading-simple widget-body-gray">
            <div class="widget-body">
                <!-- Table -->
                <table id ="adminmanager" class="dynamicTable colVis table table-striped table-bordered table-condensed table-white">
                    <!-- Table heading -->
                    <thead>
                        <tr>
                           
                            <th>Logo Text1</th>
                            <th>Logo Text2</th>
                            <th>Created_at</th>
                            
                         <!--   <th>Delete</th> -->
                           
                        </tr>
                    </thead>
                    <!-- // Table heading END -->
                    <!-- Table body -->
                    <tbody>
                       <?php
                       if(  is_array($content_datas)) {
                       $i=(($page-1)*$per_page)+1;
                       foreach ($content_datas as $content_data) { ?>
                        <tr class="gradeX">

                           
                           <td align="left" valign="middle" style="padding-left:10px;"><?php echo $content_data->logo_text1 ?></td>
                           <td align="left" valign="middle" style="padding-left:10px;"><?php echo $content_data->logo_text2 ?></td>
                           <td align="left" valign="middle" style="padding-left:10px;"><?php echo date('d-M-Y', $content_data->created_at) ?></td>
                            
                      
                        </tr>
                       <?php $i++;
                       
                       } }
                       ?>
                    </tbody>
                </table>
                <div class="pagination-wrapper clearfix">
                        <span class="total-results">Total Results: <strong><?php echo $total_rows; ?></strong></span>
                        <?php
                        $options = $this->general_model->perPageURL('admin/test/manage',array('select','1','2','5','10','20','All'), $total_rows);
                        $selected = array('select');       
                        $attributes_other= 'id="page_limit" onChange="window.location.href=$(this).val();"';
                        echo form_dropdown('page_limit', $options, $selected, $attributes_other);
                        echo $pagination_links;
                    ?>	
                </div>
            </div>
        </div>
    </div><?php echo form_close(); ?>		
</div>