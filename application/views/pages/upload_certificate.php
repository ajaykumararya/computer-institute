
<script src="https://ilikenwf.github.io/jquery.mjs.nestedSortable.js"></script>
    




 
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-sm-6">
                <div class="dd" id="nestable">
                   <div class="widget-box">
                      <div class="widget-header">
                        <h4 class="widget-title"> <?php echo $title; ?> </h4>
                      </div>
                      <div class="widget-body">
                        <div class="widget-main">
                          <form action="" id="upload_certificate" method="post" class="form-inline" enctype="multipart/form-data">
                            <div class="profile-user-info profile-user-info-striped">
                              <div class="profile-info-row">
                                <div class="profile-info-name"> ROLLNO </div>
                                <div class="profile-info-value">
                                  <?php 
                                  echo form_input(array('id'=>'roll_no','name'=>'roll_no','Placeholder'=>'Roll No','class'=>'col-sm-12 col-xs-12','style' =>'', 'value'=>set_value('roll_no')));
                                  ?>
                                </div>
                              </div>

                             


                            <div class="profile-info-name"> UPLOAD FILE </div>
                              <div class="profile-info-value">
                                <input type="file" name="fileToUpload" class="col-sm-6 col-xs-12" >
                              </div>
                            </div>





                            <div class="form-actions center">
                              <button type="submit" class="btn btn-sm btn-success">
                                Click To Upload 
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> 
                </div>
            </div>

            <div class="vspace-16-sm"></div>

            <div class="col-sm-6">
                <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('menu_item_list'); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo site_url('admin/front/menus/update') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <div class="mailbox-controls">
                                <div class="pull-right">
                                </div><!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <div class="download_label"><?php echo $this->lang->line('menu_item_list'); ?></div>

                                <div class="menu-box">

                                    


                                    
                                    
                                </div>
                            </div><!-- /.mail-box-messages -->
                        </div><!-- /.box-body -->

                    </form>
            </div>
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>





<!--------------------------------------------------------------------->

<div class="row mt mb">
  <div class="col-md-12">
    <section class="task-panel tasks-widget">
      <div class="panel-heading">
        <div class="pull-left">
          <h5><i class="fa fa-tasks"></i> <?php echo $title; ?></h5>
        </div>
         
        <br>
      </div>
     
      <div class="panel-body">
        <div style="overflow-x:auto;">
          
        <table class="table table-bordered table-striped table-condensed" id="uploaded_certificate_list">
          <thead>
            <tr>
              <th>SR NO.</th>
              <th>IMAGE </th>
              <th>ROLL NO </th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>                            
          </tbody>
         
        </table>
        </div>  
      </div>
    </section>
  </div><!--/col-md-12 -->
</div><!-- /row -->              
  





