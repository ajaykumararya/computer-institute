</div>
            
</div>
      
</section> 
</section><!-- /MAIN CONTENT -->
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2020- PRTECH-TEAM
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script> -->
    <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/get.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/post.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/backend.js"></script>
   <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    
    <!--common script for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url(); ?>assets/js/sparkline-chart.js"></script>    
  <script src="<?php echo base_url(); ?>assets/js/zabuto_calendar.js"></script>  
    <!--script for this page-->
    
    <script src="<?php echo base_url(); ?>assets/library/bootstrap-select.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/library/bootstrap-select.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/library/font-awesome.min.css">


   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme_assets/vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/library/responsive.dataTables.min.css">
    <script src="<?php echo base_url(); ?>assets/theme_assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/library/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/library/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/library/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/library/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/library/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/library/buttons.print.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.js" data-modules="effect effect-bounce effect-blind effect-bounce effect-clip effect-drop effect-fold effect-slide"></script> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui.css" />
<link href="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>  
 <script>
 $( ".startdate" ).datepicker({
  dateFormat: 'dd-mm-yy',//check change
  changeMonth: true,
  changeYear: true
});
 </script>
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
  
<div class="cover" align="center">
  <center><div class="loader"></div></center>
</div>
<style type="text/css">
  .cover
  {
    height: 100%; 
    width: 100%;
    position: fixed;
    z-index: 9089898989;
    background: rgba(0,0,0,0.4);
    top:0;
    left: 0;
    display: none;
    padding-top: 5%; text-align: center
  }
  .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid blue;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

