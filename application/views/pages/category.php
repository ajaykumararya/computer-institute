





<div class="row">
  <div class="col-xs-12 col-sm-12">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title"> Add New <?php echo $title; ?> </h4>

                         
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                            <form action=""  id="add_category" class="form-inline">
                             

<div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> SELECT COURSE   </div>

                          <div class="profile-info-value">
                            <select name="brand" class="col-sm-3 col-xs-12 ">
                              <?php  
                              $brands = get_all_brands();
                              foreach ($brands as $brands_list) {
                                echo '<option value="'.$brands_list->id.'">'.$brands_list->brand_name.'</option>';                              }

                              ?>
                            </select>
                          &nbsp;&nbsp;&nbsp;</div>
                        </div>
                       <div class="profile-info-row">
                          <div class="profile-info-name">  <?php echo $title; ?> </div>

                          <div class="profile-info-value">
                              <input type="text" name="category" class="col-sm-3 col-xs-12" >
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name">  Image </div>

                          <div class="profile-info-value">
                              <input type="file" name="fileToUpload" class="col-sm-3 col-xs-12" >
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
                   
                    

