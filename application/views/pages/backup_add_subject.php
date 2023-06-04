
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> Add Courses </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form action="" id="add_subject" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> CATEGORY NAME </div>
                <div class="profile-info-value">
                  <?php
                  if($this->uri->segment(3)!= ''){
                      ?>
                      <input type="hidden" name="course_id" value=" <?php echo $this->uri->segment(3); ?>">
                      <?php
                  }
                  ?>
                    <input type="hidden" name="status" value="course" >
                  	<select class="col-sm-12 col-xs-12" name="category" required="">
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
                <div class="profile-info-name"> SELECT YEAR </div>
                <div class="profile-info-value">
                    <select class="col-sm-12 col-xs-12 course_type" name="year">
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
                <div class="profile-info-value theory_marks" style="display:none" >
                    <input type="number" min="0" class="form-control" name="max_marks" required="" placeholder="Enter Subject Max Marks">
    		        <input type="number" min="0" class="form-control" name="min_marks" required="" placeholder="Enter Subject Min Marks">
    				
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> PRACTICAL </div>
                <div class="profile-info-value practical_marks"  style="display:none">
                    <input type="number" min="0" class="form-control" name="practical_max_marks"  placeholder="Enter Subject Max Marks">
    		        <input type="number" min="0" class="form-control" name="practical_min_marks"  placeholder="Enter Subject Min Marks">
    				
                </div>
              </div>
                <div class="profile-info-name">  </div>
                  
                </div>
                
                
                
                
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                ADD CATEGORY
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
          
        <table class="table table-bordered table-striped table-condensed" id="course_list">
          <thead>
            <tr>
              <th>SR NO.</th>
              <th>IMAGE </th>
              <th>CATEGORY </th>
              <th>COURSE NAME </th>
              <th>COURSE TYPE </th>
              <th>COURSE DURATION </th>
              <th>COURSE CODE </th>
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
  







	<div class="box-footer">
		<!--<h2>List Subjects</h2>-->
		<form id="add_subject_marks">
			<div class="form-group col-md-6">
				<label>Select Course</label>
				<select class="form-control get_subject_list" name="course_id" id="get_subject_list" required="">
					<option value="">--Select--</option>
					<?
							$course = $this->db->query("SELECT * FROM courses")->result();
							foreach($course as $c){
						
								echo '<option value="'.$c->id.'">'.$c->course_name.'</option>';
							}
						?>
				</select>
			</div>
			<div id="subject_list" class="form-group col-md-12 "></div>
		</form>
		
		
	</div>
</div>