
              <!-- BASIC FORM ELELEMNTS -->
            <!-- INPUT MESSAGES -->
            <div class="row mt">
              <div class="col-lg-12">
                <div class="form-panel"> 
                          <form class="form-horizontal tasi-form" id="profile" enctype="multipart/form-data">

                           
                           
                              <h4 class="mb"><i class="fa fa-angle-right"></i> PROFILE </h4>  
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">OWNER NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="owner_name" class="form-control" id="inputSuccess" placeholder="TITLE NAME" value="<?php echo $profile[0]->OWNER_NAME; ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">ORGANIZATION NAME</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="org_name" class="form-control" id="inputSuccess" placeholder="TITLE NAME" value="<?php echo $profile[0]->ORG_NAME; ?>">
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">EMAIL </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="email" class="form-control" placeholder="EMAIL" value="<?php echo $profile[0]->ORG_EMAIL; ?>">
                                     
                                        
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">ALTERNATE EMAIL </label>
                                  <div class="col-lg-10">
                                     <input type="text" name="alt_email" class="form-control" placeholder="ALTERNATE EMAIL" value="<?php echo $profile[0]->ORG_ALT_EMAIL; ?>">
                                        
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">PHONE </label>
                                  <div class="col-lg-10">
                                     <input type="text" name="phone" class="form-control" placeholder="PHONE " value="<?php echo $profile[0]->ORG_PHONE; ?>">
                                        
                                      
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">ALTERNATE PHONE </label>
                                  <div class="col-lg-10">
                                     <input type="text" name="alt_phone" class="form-control" placeholder="ALTERNATE PHONE " value="<?php echo $profile[0]->ORG_ALT_PHONE; ?>">
                                        
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">APP URL</label>
                                  <div class="col-lg-10">
                                     <input type="text" name="app_url" class="form-control" placeholder="APP URL " value="<?php echo $profile[0]->APP_URL; ?>">
                                        
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">ADDRESS </label>
                                  <div class="col-lg-10">
                                      <textarea name="address" class="form-control" placeholder="ENTER DESCRIPTION HERE !" >
                                        <?php echo $profile[0]->ORG_ADDRESS; ?>
                                      </textarea>
                                  </div>
                              </div>
                              <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">MAP LOCATION </label>
                                  <div class="col-lg-10">
                                      <textarea name="google_map" class="form-control" placeholder="ENTER embed code HERE !">
                                        <?php echo $profile[0]->MAP_LOCATION; ?>
                                      </textarea>
                                  </div>
                              </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">EMAIL REDIRECT </label>
                                  <div class="col-lg-10">
                                      <textarea name="email_redirect" class="form-control" placeholder="ENTER DESCRIPTION HERE !">
                                        <?php echo $profile[0]->EMAIL_REDIRECTION; ?>
                                      </textarea>
                                  </div>
                                </div>
                                
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">CENTER PREFIX </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="center_prefix" class="form-control" placeholder="PHONE " value="<?php echo $profile[0]->CENTER_PREFIX; ?>">
                                      
                                      
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">STUDENT PREFIX </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="student_prefix" class="form-control" placeholder="PHONE " value="<?php echo $profile[0]->STUDENT_PREFIX; ?>">
                                      
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">FACEBOOK </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="facebook" class="form-control" placeholder="FACEBOOK " value="<?php echo $profile[0]->facebook; ?>">
                                      
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">TWITTER </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="twitter" class="form-control" placeholder="TWITTER " value="<?php echo $profile[0]->twitter; ?>">
                                      
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">YOUTUBE </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="youtube" class="form-control" placeholder="YOUTUBE " value="<?php echo $profile[0]->youtube; ?>">
                                      
                                  </div>
                                </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">GOOGLE </label>
                                  <div class="col-lg-10">
                                      <input type="text" name="google" class="form-control" placeholder="TWITTER " value="<?php echo $profile[0]->google; ?>">
                                      
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
            
            <!-- INPUT MESSAGES -->
            <div class="row mt">
              
              
            <!-- CUSTOM TOGGLES -->
              
            </div><!-- /row -->
            
        
