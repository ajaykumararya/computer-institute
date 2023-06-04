<div class="row mt mb">
    
    <!-------- start customer feed back ------------------->
    
                  <div class="col-xs-12 col-sm-12">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title"> Add New <?php echo $title; ?> </h4>

                         
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                            <form action="" method="post" id="add_customer_feedback"  class="form-inline">
                             

                    <div class="profile-user-info profile-user-info-striped">
                        
                        

                        <div class="profile-info-row">
                          <div class="profile-info-name">TITLE   </div>
                          <div class="profile-info-value">
                            <input type="text" name="feedback_title"  class="col-sm-3 col-xs-12">
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name"> NAME </div>

                          <div class="profile-info-value">
                              <input type="text" name="feedback_name"  class="col-sm-3 col-xs-12" required="required" >
                          </div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> DESC </div>

                          <div class="profile-info-value">
                              <textarea name="feedback_comment" class="col-sm-3 col-xs-12"> </textarea>
                          </div>
                        </div>
                        <div class="profile-info-row">
                          <div class="profile-info-name"> FILE </div>

                          <div class="profile-info-value">
                              <input type="file" name="fileToUpload" >
                          </div>
                        </div>

                      </div>
                      <div class="form-actions center">
                              <button type="submit" class="btn btn-sm btn-success">
                               Click To Add <?php echo $title; ?>
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                              </button>
                      </div>

                  </div>


                           

                </form>
                  </div>
                          </div>
                        </div>
                      </div>  
    
    
    
    
    <!------------- end customer feedback --------------------->
    







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
        <table class="table table-bordered table-striped table-condensed"id="feedback_list">
          <thead>
            <tr>
              <th>SR NO.</th>
              <th>NAME </th>
              <th>MESSAGE </th>
              <th>STATUS</th>
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
  