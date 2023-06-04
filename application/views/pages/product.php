





<div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="widget-box">
      <div class="widget-header">
      <h4 class="widget-title"> Add New <?php echo $title; ?> </h4>
      </div>
       <div class="widget-body">
          <div class="widget-main">
            <form action="" method="post" id="add_product" class="form-inline">
              <div class="profile-user-info profile-user-info-striped">
                

                <div class="profile-info-row">
                  <div class="profile-info-name"> COURSE   </div>
                    <div class="profile-info-value">
                      <select name="brand" class="col-sm-3 col-xs-12 get_category">
                        <?php  
                        $brands = get_all_brands();
                        foreach ($brands as $brands_list) {
                          echo '<option value="'.$brands_list->id.'">'.$brands_list->brand_name.'</option>';                              }

                        ?>
                      </select>
                    &nbsp;&nbsp;&nbsp;</div>
                  </div>

                <div class="profile-info-row">
                  <div class="profile-info-name"> CLASSES  </div>
                  <div class="profile-info-value">
                    <select name="category" class="selectpicker col-xs-12 col-sm-3 category get_sub_category">
                      
                    </select>
                    &nbsp;&nbsp;&nbsp;
                  </div>
                </div>

                  

                

                <div class="profile-info-row">
                  <div class="profile-info-name"> SUBJECT </div>

                  <div class="profile-info-value">
                    <select name="child_category" class="selectpicker col-xs-12 col-sm-3 sub_category">
                      
                    </select>
                    &nbsp;&nbsp;&nbsp;
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT NAME </div>

                  <div class="profile-info-value">
                    <input type="text" name="product_name" class="col-sm-3 col-xs-12" placeholder="PRODUCT NAME">
                  </div>
                </div>
                <!--
                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT PRICE </div>

                  <div class="profile-info-value">
                    <input type="text" name="price1" class="col-sm-3 col-xs-12" placeholder=" PRODUCT PRICE ">
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"> OFFER PRICE </div>

                  <div class="profile-info-value">
                    <input type="text" name="offer_price" class="col-sm-3 col-xs-12" placeholder="OFFER PRICE ">
                  </div>
                </div>
                --->

                <div class="profile-info-row">
                  <div class="profile-info-name"> UPLOAD PRODUCT </div>

                  <div class="profile-info-value">
                    <input type="file" name="fileToUpload1" class="col-sm-3 col-xs-12" required="required">
                  </div>
                </div>
                <!--
                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT IMAGE2 </div>

                  <div class="profile-info-value">
                     <input type="file" name="fileToUpload2" class="col-sm-3 col-xs-12">
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT IMAGE3 </div>

                  <div class="profile-info-value">
                    <input type="file" name="fileToUpload3" class="col-sm-3 col-xs-12">
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT IMAGE4 </div>

                  <div class="profile-info-value">
                    <input type="file" name="fileToUpload4" class="col-sm-3 col-xs-12">
                  </div>
                </div>
                <div class="profile-info-row">
                  <div class="profile-info-name"> PRODUCT IMAGE5 </div>

                  <div class="profile-info-value">
                    <input type="file" name="fileToUpload5" class="col-sm-3 col-xs-12">
                  </div>
                </div>
                
                <div class="profile-info-row">
                  <div class="profile-info-name"> PINCODE AVAILABLE </div>

                  <div class="profile-info-value">
                    <input type="text" name="pincode" class="col-sm-3 col-xs-12" required="required">
                  </div>
                </div>
                -->
                <div class="profile-info-row">
                  <!--
                  <div class="profile-info-name">  DESCRIPTION </div>

                  <div class="profile-info-value">
                   <textarea class="col-sm-3 col-xs-12" name="description"></textarea>
                  </div>
                  --->
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
                   
                    

