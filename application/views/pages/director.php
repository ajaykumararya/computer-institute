
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form  id="add_subject_marks" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> CATEGORY NAME </div>
                <div class="profile-info-value">
                  <?php
                  if($this->uri->segment(3)!= ''){
                      ?>
                      <input type="hidden" name="id" value=" <?php echo $this->uri->segment(3); ?>">
                      <?php
                  }
                  ?>
                    <input type="hidden" name="status" value="course" >
                  	<select class="col-sm-12 col-xs-12 get_course_type selectpicker" data-live-search="true" name="course_id" required="">
    					<option value="">--Select--</option>
    					<?
    						$course = $this->db->query("SELECT * FROM courses")->result();
    						foreach($course as $c){
    						
    							echo '<option value="'.$c->id.'">'.$c->course_name.'</option>';
    						}
    					?>
    				</select>
    				
    				
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> MONTH/YEAR </div>
                <div class="profile-info-value">
                    <select class="col-sm-12 col-xs-12 course_type selectpicker" data-live-search="true" name="year">
    				</select>
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> SUBJECT NAME </div>
                <div class="profile-info-value">
                  <input type="text" class="col-sm-12 col-xs-12" name="subject_name" required="" placeholder="Enter Subject Name">
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> MONTHLY / YEARLY </div>
                <div class="profile-info-value">
                    
                    <input type="radio" id="theory" name="practical" value="0">
                    <label for="css">THEORY</label>
                    <input type="radio" id="practical" name="practical" value="1">
                    <label for="html">PRACTICAL</label>
                    
                    <input type="radio" id="both" name="practical" value="2">
                    <label for="javascript">BOTH </label>
               
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> THEORY </div>
                <div class="profile-info-value theory_marks"  >
                    
    				
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> PRACTICAL </div>
                <div class="profile-info-value practical_marks" >
                    
    				
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> SUBJECT CODE </div>
                <div class="profile-info-value " >
                    
    		        <input type="text"  class="form-control" name="subject_code"  placeholder="SUBJECT CODE">
    				
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
  