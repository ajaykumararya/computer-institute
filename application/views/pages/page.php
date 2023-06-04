<style>
.row{
  min-height:auto;
}
</style>

<?php 
@$row = $this->db->get_where('page',['page_menu_code'=>@$this->uri->segment(3)])->row();
?>


<div class="row mt">
<section class="wrapper form-panel">
  <!-- <h3><i class="fa fa-angle-right"></i> <?php echo @$title; ?></h3> -->
    <!-- INLINE FORM ELELEMNTS -->
    <div class="row mt">
      
      <div class="col-xs-12"><!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="text-center">
              <h1 class="panel-title txt-dark"><?php echo $title; ?></h1>
              <hr class="reddish">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form id="add_page">
           <input type="hidden" name="loginid" value="<?php echo $_SESSION['loginid']; ?>">
           
           <input type="hidden" name="id" value="<?php echo @$this->uri->segment(3); ?>">
           
            <div class="box-body">
                <div class="row">
                    
                        <div class="form-group col-md-6">
                          <label>TITLE <span class="star">*</span></label>
                          <input type="text" name="title" class="form-control" id="inputSuccess" placeholder="ENTER PAGE TITLE" value="<?php echo @$row->title; ?>"  required>                              
                        </div>
                    </div>
                    
                    
                        <div class="form-group">
                          <label>DESCRIPTION <span class="star">*</span></label>
                          <textarea name="content"> <?php echo @$row->description; ?> </textarea>
                <script>
                        CKEDITOR.replace( 'content' );
                </script>
                        </div>
                
                    <div class=" text-center">
                        <div class="form-group">
					
                            <button type="submit" class="btn btn-primary add_page">Submit</button>
                        </div>
                        </div>
						
                                                  
                </div>
                
                       
             <div class="box-footer">
                
            </div>         
                                            
            
            </form>
        </div>
    </div>
  </div><!-- /row -->
</section>
</div>



           