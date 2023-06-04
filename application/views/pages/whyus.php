<?php
		$whyus=$this->db->get('whyus')->row();
	
	?>

              <!-- BASIC FORM ELELEMNTS -->

            <!-- INPUT MESSAGES -->

            <div class="row mt">

              <div class="col-lg-12">

                <div class="form-panel"> 

                          <form class="form-horizontal tasi-form" id="whyus" enctype="multipart/form-data">

                              <h4 class="mb"><i class="fa fa-angle-right"></i> WHY US ?</h4>  

                              <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">TITLE</label>

                                  <div class="col-lg-10">

                                      <input type="text" name="title_name" class="form-control" id="inputSuccess" placeholder="TITLE NAME"  value="<?php echo $whyus->WHYUS_TITLE; ?>">

                                  </div>

                              </div>

                              <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">DESCRIPTION</label>

                                  <div class="col-lg-10">

                                      <textarea name="desc" class="form-control ckeditor"  placeholder="ENTER DESCRIPTION HERE !">
                                            <?php echo $whyus->WHYUS_DESC; ?>
                                      

                                      </textarea>

                                  </div>

                              </div>

                              <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">IMAGE  </label>

                                  <div class="col-lg-6">

                                    <input type="file" name="image" class="form-control startdate" id="inputError"  >

                                  </div>

                                  

                              </div>

<!--                               <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">VIew IMAGE  </label>

                                  <div class="col-lg-6">

                                    <img style="height: 100px; width: 100px;" src="<?php echo base_url('uploads/'.$whyus->WHYUS_IMAGE.''); ?>">

                                  </div>

                              </div>
 -->
                             

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

            

            <!-- INPUT MESSAGES -->

            <div class="row mt">

              

              

            <!-- CUSTOM TOGGLES -->

              

            </div><!-- /row -->

            

        

