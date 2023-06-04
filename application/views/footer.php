<?php
$profile=$this->db->get('profile')->row();
?>

  <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      <div class="footer">
        <div class="footer-inner">
          <div class="footer-content">
            <span class="bigger-120 white">
              <span class="white bolder"><?php echo $profile->ORG_NAME; ?></span>
                &copy; 2021-2022
            </span>

            &nbsp; &nbsp;
            <span class="action-buttons">
              <a href="#">
                <i class="ace-icon fa fa-twitter-square white bigger-150"></i>
              </a>

              <a href="#">
                <i class="ace-icon fa fa-facebook-square text-primary white bigger-150"></i>
              </a>

              <a href="#">
                <i class="ace-icon fa fa-rss-square white bigger-150"></i>
              </a>
            </span>
          </div>
        </div>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->



    <!-- page specific plugin scripts -->

    <!-- ace scripts -->
    
    <script>
      $(document).ready(function() {
        $('.selectpicker').select2({
          height: 'resolve'
        });
      });
     </script>
    <!-- inline scripts related to this page -->
  </body>
</html>
 <script type="text/javascript">
      jQuery(function($){
      


// $('ol.sortable').nestedSortable({

  
//   update : function () {
//     var orderNew = $(this).nestedSortable('serialize', {startDepthCount: 0});
//  // var x= $('ol.sortable').nestedSortable('serialize');
//     alert(orderNew);
//     alert(x);
//   }
// });



        $('.dd').nestable();
      
        $('.dd-list').on('mousedown', function(e){
         //alert('kk');
          
          //e.stopPropagation();




        });
        
        $('[data-rel="tooltip"]').tooltip();
      
      });
    </script>


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme_assets/vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
    <script src="<?php echo base_url(); ?>assets/theme_assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>



<script src="<?php echo base_url(); ?>assets/backend_assets/js/jquery.mjs.nestedSortable.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/backend_assets/js/menu.js"></script> -->

<script src="<?php echo base_url(); ?>assets/backend_assets/js/backend.js"></script>
 <script src="<?php echo base_url(); ?>assets/backend_assets/js/get.js"></script>
 <script src="<?php echo base_url(); ?>assets/backend_assets/js/post.js"></script>
 
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
 
 
 
  
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