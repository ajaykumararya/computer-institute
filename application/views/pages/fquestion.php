
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
        <?php
        if($this->uri->segment('4')!= ''){
        ?>
          <form action="" id="update_fquestion" method="post" class="form-inline" enctype="multipart/form-data">
              <input type="hidden" name="code" value="<?php echo @$this->uri->segment(3);  ?>" >
              
              <input type="hidden" name="updatefquestionid" value="<?php echo @$this->uri->segment(4);  ?>" >
              
        <?php    
        }else{
        ?>
          <form action="" id="question_answer" method="post" class="form-inline" enctype="multipart/form-data">
              <input type="hidden" name="code" value="<?php echo @$this->uri->segment(3);  ?>" >
        <?php
        }
        
        
       $fq =  $this->db->query("SELECT * FROM `fquestion` WHERE `FQUESTION_ID` = '".@$this->uri->segment(4)."' ")->row();
        
        ?>
          
        
            <div class="profile-user-info profile-user-info-striped">
                
              
              <div class="profile-info-row">
                <div class="profile-info-name"> PDF TITLE </div>
                <div class="profile-info-value">
                  <input type="text" name="pdf_title" class="col-sm-12 col-xs-12" placeholder="Enter PDF TITLE" value="<?php echo @$fq->F_TITLE;?>" required="">
                </div>
              </div>
              
                <div class="profile-info-row">
                    <div class="profile-info-name"> QUESTION ? </div>
                    <div class="profile-info-value">
                      <input type="text" name="title" class="col-sm-12 col-xs-12" placeholder="QUESTION ?" value="<?php echo @$fq->FQUESTION;?>" required="">
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> ANSWER  </div>
                    <div class="profile-info-value">
                         <input type="text" name="desc" class="col-sm-12 col-xs-12" placeholder="Enter ANSWER" value="<?php echo @$fq->FANSWER;?>" required="">
                    </div>
                </div>
                <div class="profile-info-name"> FILE </div>
                  <div class="profile-info-value">
                        <input type="file"  name="image" class="col-sm-12 col-xs-12"  >
                  </div>
                </div>
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                SUBMIT
                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>       
</div>                   
                    






<section class="wrapper">
            
            <!-- INLINE FORM ELELEMNTS 
            <div class="row pt">
              <div class="col-lg-12">
                <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>  <?php echo $title; ?></h4>
                      <form class="form-inline" id="question_answer" >
                            
                            <input type="hidden" name="code" value="<?php //echo @$this->uri->segment(3);  ?>" >                 
                            <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail2">TITLE</label>
                              <input type="text" name="pdf_title" class="form-control col-md-12 col-xs-12" placeholder="PDF TITLE " >
                              
                          </div>
                          
                          <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail2">QUESTION</label>
                              <textarea name="title" class="form-control col-md-12 col-xs-12" placeholder="QUESTION ?"></textarea>
                          </div>
                          <div class="form-group">
                              <label class="sr-only" for="exampleInputPassword2">DESCRIPTION</label>
                              <textarea name="desc" class="form-control" placeholder="ANSWER "></textarea>
                          </div>
                          <div class="form-group">
                              <label class="sr-only" for="exampleInputPassword2">File</label>
                              <input type="file" name="image" >
                          </div>
                         
                         
                          <button type="submit" class="btn btn-theme ">Submit</button>
                      </form>
                </div>
              </div>
            </div>
            ---->
             <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $title; ?> LIST</h4>
                    <table class="table table-bordered table-striped table-condensed" id="fquestion_list">
                          <thead>
                            <tr>
                              <th>SR No.</th>
                              <th>QUESTION </th>
                              <th>ANSWER</th>
                              <th>STATUS</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>  
                </div><!-- /form-panel -->
              </div><!-- /col-lg-12 -->
            </div><!-- /row -->
    </section>
