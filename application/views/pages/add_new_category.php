<div class="row">
  <div class="col-xs-12 col-sm-12">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title"> Add New <?php echo $title; ?> </h4>
                        </div>
                        <div class="widget-body">
                          <div class="widget-main">
                            <form action="" method="post" class="form-inline">
                      <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> SELECT BRAND   </div>

                          <div class="profile-info-value">
                            <select name="brand" class="col-sm-3 col-xs-12">
                              <?php  
                              $brands = get_all_brands();
                              foreach ($brands as $brands_list) {
                                echo '<option value="'.$brands_list->id.'">'.$brands_list->brand_name.'</option>';                              }

                              ?>
                            </select>
                          &nbsp;&nbsp;&nbsp;<i class=" btn btn-primary fa fa-plus pull"></i></div>
                        </div>


                        <div class="profile-info-row">
                          <div class="profile-info-name">  <?php echo $title; ?>  </div>
                          <div class="profile-info-value">
                            <select class="col-sm-3 col-xs-12" name="category">
                              <option>-- Select Category ---</option>
                              
                            </select>

                          &nbsp;&nbsp;&nbsp;<i class=" btn btn-primary fa fa-plus pull"></i></div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name"> SUB <?php echo $title; ?> </div>

                          <div class="profile-info-value">
                            <?php 
        echo form_input(array('id'=>'labour_mobile','name'=>'labour_mobile','Placeholder'=>'ENTER SUB-'.$title.'','class'=>'col-sm-3 col-xs-12', 'value'=>set_value('labour_mobile')));
        ?>
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
                   
                    

