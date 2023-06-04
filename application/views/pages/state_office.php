
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form  id="add_stateoffice" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> STATE NAME </div>
                <div class="profile-info-value">
                  
                  	<select class="col-sm-12 col-xs-12  state" data-live-search="true" name="stateid" required="">
    					<option value="">--Select--</option>
    					<?
    						$course = $this->db->query("SELECT * FROM state")->result();
    						foreach($course as $c){
    						
    							echo '<option value="'.$c->STATE_ID.'">'.$c->STATE_NAME.'</option>';
    						}
    					?>
    				</select>
    				
    				
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> DISTRICT </div>
                <div class="profile-info-value">
                    <select class="col-sm-12 col-xs-12 city selectpicker" data-live-search="true" name="districtid">
    				</select>
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name">  NAME </div>
                <div class="profile-info-value">
                  <input type="text" class="col-sm-12 col-xs-12" name="name" required="" placeholder="Enter Name">
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> EMAIL </div>
                <div class="profile-info-value">
                    
                    <input type="text" class="col-sm-12 col-xs-12" name="email" required="" placeholder="Enter Email ">
               
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> MOBILE </div>
                <div class="profile-info-value ">
                    <input type="text" class="col-sm-12 col-xs-12" name="mobile" required="" placeholder="Enter Mobile ">
    				
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> ADDRESS </div>
                <div class="profile-info-value ">
                    <input type="text" class="col-sm-12 col-xs-12" name="address" required="" placeholder="Enter Address ">
    				
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
        <table class="table table-bordered table-striped table-condensed" id="state_office_list">
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
  