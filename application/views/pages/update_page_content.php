<div class="panel-heading">
    <div class="pull-left">
        <h5><i class="fa fa-tasks"></i> <?php echo $title; ?></h5>
    </div>
    
    <br>
</div>
<?php
$page_data = $this->db->query("SELECT * FROM `page` WHERE `page_menu_code` LIKE '".@$this->uri->segment(3)."'")->row();


$menu = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `menu_code` LIKE '".@$this->uri->segment(3)."'")->row();

//print_r($menu);

if(@$menu->PAGE_TYPE == 3)
{
  ?>
  <section class="wrapper">
            
            <!-- INLINE FORM ELELEMNTS -->
            <div class="row pt">
              <div class="col-lg-12">
                <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i>  <?php echo $title; ?></h4>
                      <form class="form-inline" id="question_answer" >
                         
       
                          <div class="form-group">
                              <label class="sr-only" for="exampleInputEmail2">QUESTION</label>
                              <textarea name="title" class="col-sm-12 form-control" placeholder="QUESTION ?"></textarea>
                          </div>
                          <div class="form-group">
                              <label class="sr-only" for="exampleInputPassword2">DESCRIPTION</label>
                              <textarea name="desc" class="form-control col-sm-12" placeholder="ANSWER "></textarea>
                          </div>
                         
                         
                          <button type="submit" class="btn btn-theme btn_creat_company">Submit</button>
                      </form>
                </div><!-- /form-panel -->
              </div><!-- /col-lg-12 -->
            </div><!-- /row -->
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

  
  
  
  <?php
}else{
    

?>




              <!-- BASIC FORM ELELEMNTS -->

            <!-- INPUT MESSAGES -->

            <div class="row mt">

              <div class="col-lg-12">

                <div class="form-panel"> 

                          <form class="form-horizontal tasi-form" id="add_page2" enctype="multipart/form-data">



                           <input type="hidden" name="menu_code" value="<?php echo @$this->uri->segment(3); ?>">

                           

                              <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $title; ?></h4> 

                              

                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">TITLE</label>
                                  <div class="col-lg-10">
                                      <input type="text" name="title_name" class="form-control" id="inputSuccess" placeholder="TITLE NAME" value="<?php echo @$page_data->title; ?>">
                                  </div>
                                </div>

                              <div class="form-group ">

                                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">DESCRIPTION</label>

                                  <div class="col-lg-10">

                                      <textarea name="content" class="form-control" placeholder="ENTER DESCRIPTION HERE !">

                                        <?php echo @$page_data->description; ?>

                                      </textarea>
                                        <script>
                                                CKEDITOR.replace( 'content' );
                                        </script>
                                  </div>

                              </div>
                                <div class="form-group ">
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError">SELECT CONTENT TYPE  </label>
                                  <div class="col-lg-10">
                                    <select class="form-control" name="content_type" onchange="myFunction(this.value)" >
                                        <option> -- Select Content Type -- </option>
                                        <option value="0"> Image </option>
                                        <option value="1"> Video </option>
                                    </select>
                                  </div>
                                </div>
                                
                                
                                
                                <div class="form-group "  >
                                  <label class="col-sm-2 control-label col-lg-2" for="inputError" id="content_type_title">  </label>
                                  <div class="col-lg-10" id="content_type">
                                    
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

<?php
}
?>

            

            

        

