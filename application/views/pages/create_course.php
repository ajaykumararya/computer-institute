
<?php
$type = '';
if(!empty($this->uri->segment(3))){
    $get_course = $this->db->query("SELECT * FROM courses where id = '".$this->uri->segment(3)."'")->row();
    $type = $get_course->type;
    if(@$get_course->type==1 OR $get_course->type==3){
        $duration=@$get_course->duration.'';
        
    }
    elseif(@$get_course->type==2){
        $duration=@$get_course->years.'';
    }
    
}
?>
    



<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> Add Courses </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form action="" id="add_courses" method="post" class="form-inline" enctype="multipart/form-data">
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
                      
                      <select class="col-sm-12 col-xs-12 " name="category" required="required">
    				    <option value=""> SELECT CATEGORY </option>
                        <?php
                        $category=$this->db->get('brand')->result();
                        foreach($category as $row){
                            if(@$get_course->category==$row->id){
                            ?>
                                <option value="<?php echo $row->id;?>" selected><?php echo $row->brand_name;?></option>
                            <?php  }else{ ?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->brand_name;?></option> 
                            <?php } ?>
                        <?php
                        }
                        ?>
    				</select>
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> COURSE NAME </div>
                <div class="profile-info-value">
                  <input type="text" name="course_name" class="col-sm-12 col-xs-12" placeholder="Enter Course Name" value="<?php echo @$get_course->course_name;?>" required="">
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> COURSE CODE </div>
                <div class="profile-info-value">
                  <input type="text" name="course_code" class="col-sm-12 col-xs-12" placeholder="Enter Course Code" value="<?php echo @$get_course->course_code;?>" required="">
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> MONTHLY / YEARLY </div>
                <div class="profile-info-value">
                    <input type="radio"  name="yearly" value="1" class="yearly1 month1" <?php echo ($type == 1 ? 'checked' : '') ?> >
    	                <label for="vehicle1">Monthly</label>
    	            <input type="radio"  name="yearly" value="2" class="yearly1 year2" <?php echo ($type == 2 ? 'checked' : '') ?> >
                        <label for="vehicle2">Yearly</label>
                    <input type="radio"  name="yearly" value="3" class="yearly1 semester3" <?php echo ($type == 3 ? 'checked' : '') ?> >
                        <label for="vehicle2">Semester</label>
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> DURATION </div>
                <div class="profile-info-value" >
                    <input type="number" name="duration" class="col-sm-12 col-xs-12 duration1" placeholder="Enter Course in Months/Year/Semester" value="<?php echo @$duration;?>" required="">
                </div>
              </div>
              
                <div class="profile-info-row">
                    <div class="profile-info-name"> Amount </div>
                    <div class="profile-info-value" >
                        <input type="text" name="fees" class="col-sm-12 col-xs-12 amount1" placeholder="Enter Amount" value="<?php echo @$get_course->fees;?>" required="">
                        <small id="amountText" class="form-text text-muted text-danger" style="font-size: 100%;"></small>
                    </div>
                </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> MIN-QUALIFICATION </div>
                <div class="profile-info-value" >
                    <input type="text" name="min_qualification" class="col-sm-12 col-xs-12" placeholder="MIN-QUALIFICATION" value="<?php echo @$get_course->MIN_QUALIFICATION;?>" required="">
                </div>
              </div>
              
                <div class="profile-info-name"> FILE </div>
                  <div class="profile-info-value">
                        <input type="file"  name="image" class="col-sm-12 col-xs-12" placeholder="Enter Course in years"  >
                  </div>
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
              <th>MIN QUALIFICATION</th>
              <th>FEES</th>
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

<script>


    $('.duration1,.amount1,.yearly1').on('keyup change',function(){
        var yeartype = $('.yearly1:checked').val(),
            amount = $('.amount1').val(),
            duration = $('.duration1').val();
        // console.log(yeartype +' ,'+amount+' ,'+duration);
        
        if(yeartype != 1){
            duration = duration ? duration : 1;
            var total = Number( duration * amount );
             $("#amountText").text("Total amount of this course " + total);
        }
        else{
            $('#amountText').text('');
        }
    });
    // $(".yearly1").click(function(){
    //     var value =  $(this).val();
    //     if(value == 2 || value == 3){
    //         var dur = $(".duration1");
    //         var amt = $(".amount1");
            
    //         amt.keyup(function(){
    //             var total = amt.val()*dur.val();
    //             if(dur.val() != "" && amt.val() != ""){
    //                 $("#amountText").text("Total amount of this course " + total);
    //             }
    //         });
            
    //         dur.keyup(function(){
    //             var total = amt.val()*dur.val();
    //             if(dur.val() != "" && amt.val() != ""){
    //                 $("#amountText").text("Total amount of this course " + total);
    //             }
    //         });
    //     }else{
    //         $("#amountText").text("");
    //     }
    // })
</script>
  







