
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form  id="add_chairman" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> TITLE </div>
                <div class="profile-info-value">
                    <input type="text" class="col-sm-12 col-xs-12 " name="title_name" placeholder="ENTER TITLE NAME" >
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> NAME </div>
                <div class="profile-info-value">
                    <input type="text" class="col-sm-12 col-xs-12 " name="name" placeholder="ENTER NAME" >
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> EMAIL </div>
                <div class="profile-info-value">
                    <input type="text" class="col-sm-12 col-xs-12"  name="email" placeholder="ENTER EMAIL ID ">
    			</div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> MOBILE </div>
                <div class="profile-info-value">
                  <input type="text" class="col-sm-12 col-xs-12" name="mobile" required="" placeholder="Enter MOBILE NO ">
                </div>
              </div>
              
                <div class="profile-info-name">  </div>
                  
                </div>
                
                
                
                
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                ADD 
                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>       
</div>                   
        










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
        <table class="table table-bordered table-striped table-condensed" id="director_list">
          <thead>
            <tr>
              <th>NAME </th>
              <th>EMAIL </th>
              <th>PHONE </th>
              <th>TITLE</th>
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
  