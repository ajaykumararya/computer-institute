<div class="panel-heading">
    <div class="pull-left">
        <h5><i class="fa fa-tasks"></i> <?php echo $title; ?></h5>
    </div>
    
    <br>
</div>
<?php

$brand = $this->db->get_where('brand',['id'=>@$this->uri->segment(3) ])->row();

?>




              <!-- BASIC FORM ELELEMNTS -->

            <!-- INPUT MESSAGES -->

            <div class="row mt">

              <div class="col-lg-12">

                <div class="form-panel"> 

                          <form class="form-horizontal tasi-form" id="add_page3" enctype="multipart/form-data">



                           <input type="hidden" name="categoryid" value="<?php echo @$this->uri->segment(3); ?>">

                           

                              <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $title; ?></h4> 

                              

                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">TITLE</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="title_name" class="form-control" id="inputSuccess" placeholder="TITLE NAME" value="<?php echo @$brand->brand_name; ?>">
                                  </div>
                                </div>

                                <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">DESCRIPTION</label>

                                  <div class="col-lg-10">

                                      <textarea name="content" class="form-control" placeholder="ENTER DESCRIPTION HERE !">

                                        <?php echo @$brand->description; ?>

                                      </textarea>
                                        <script>
                                                CKEDITOR.replace( 'content' );
                                        </script>
                                  </div>

                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">FILE UPLOAD </label>
                                  <div class="col-lg-10">
                                    
                                    <input type="file" name="fileToUpload" >
                                    
                                    
                                  </div>
                                </div>
                                
                                
                                
                               
                                
                                
                               

                             

                              <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputError"> </label>

                                  <div class="col-lg-10">

                                      <button type="submit" class="btn btn-theme">Submit</button>

                                  </div>

                              </div>

                          </form>

                </div><!-- /form-panel -->

              </div><!-- /col-lg-12 -->

            </div><!-- /row -->

            

            

            

        

