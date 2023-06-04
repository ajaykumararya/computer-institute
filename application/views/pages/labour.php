





<div class="row">
  <div class="col-xs-12 col-sm-12">
                      <div class="widget-box">
                        <div class="widget-header">
                          <h4 class="widget-title"> Add New Labour </h4>

                         
                        </div>

                        <div class="widget-body">
                          <div class="widget-main">
                            <form action="" method="post" class="form-inline">
                             

<div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> Labour Name </div>

                          <div class="profile-info-value">
                            <?php 
                        echo form_input(array('id'=>'labour_name','name'=>'labour_name','Placeholder'=>'Enter Labour Name','class'=>'col-sm-3 col-xs-12','style' =>'', 'value'=>set_value('labour_name')));
                                                ?>
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name"> Mobile No </div>

                          <div class="profile-info-value">
                            <?php 
        echo form_input(array('id'=>'labour_mobile','name'=>'labour_mobile','Placeholder'=>'Mobile No','class'=>'col-sm-3 col-xs-12', 'value'=>set_value('labour_mobile')));
        ?>
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name"> Address </div>

                          <div class="profile-info-value">
                            
                            <textarea name="labour_address" class="col-sm-3 col-xs-12" ></textarea>
                           
                           
                          </div>
                        </div>

                        

                        
                      </div>

                      <div class="form-actions center">
                              <button type="submit" class="btn btn-sm btn-success">
                               Click To Add Labour
                                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                              </button>
                      </div>

                  </div>


                           

                </form>
                  </div>
                          </div>
                        </div>
                      </div>
                   
                    

