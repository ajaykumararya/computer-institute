<?php
$query=$this->db->query("select * from `page` left join `link_page` link on page.id=link.pagename where link.pagename='".$this->uri->segment(2)."'");
$row=$query->row();

print_r($row);
?>
<section class="inner-header divider layer-overlay overlay-theme-colored-7" data-bg-img="images/bg/bg1.jpg" style="background-image: url(&quot;images/bg/bg1.jpg&quot;);">
  <div class="container pt-20 pb-40">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row"> 
        <div class="col-md-6">
          <h2 class="text-theme-colored2 font-36"> SCHEDULE & SYLLABUS </h2>
          <ol class="breadcrumb text-left mt-10 white">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
           
            <li class="active">SCHEDULE & SYLLABUS</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>


<style>
    .vertical-tab .nav-tabs > li:first-child > a {
    border-left: 1px solid #d3d3d3 !important;
    padding-right: 15px;
}
.vertical-tab .nav-tabs > li > a {
     border-left: 1px solid #d3d3d3 !important;
     padding-right: 15px;
}

    
}
</style>



<section>
      <div class="container pt-20 pb-20">
       
        <div class="row">
             <form action="" method="get"> 
          <div class="col-md-3">
            <div class="vertical-tab">
              <ul class="nav nav-tabs">

              <li><a href="<?php echo site_url(); ?>">SCHEDULE & SYLLABUS </a></li>
                 
                <li ><a href="javascript:void(0);">
                        <select name="brand" class="form-control get_category" required="required">
        		    		<option value="0"> SELECT ALL COURSE </option>
        		    		<?php
        		    		$brand = $this->db->get('brand')->result();
        		    		foreach($brand as $brand_list){
        		    		  echo '<option value="'.$brand_list->id.'">'.$brand_list->brand_name.'</option>';  
        		    		}
        		    		?>
        		    		
        		    		
    	                </select>     
                      </a>
                </li>
                 <li><a href="javascript:void(0);">
                    <select name="category" class="form-control get_sub_category" id="category" required="required">
                        <option value="0"> SELECT ALL CLASS </option>
    		    		<?php
        		    		$category = $this->db->get('categorylist')->result();
        		    		foreach($category as $category_list){
        		    		  echo '<option value="'.$category_list->CAT_ID.'">'.$category_list->CATEGORY_NAME.'</option>';  
        		    		}
        		    		?>
	                </select> 
                    </a>
                </li>
                 <li><a href="javascript:void(0);">
                    <select name="sub_category" class="form-control sub_category" required="required">
                        
	                </select> 
                    </a>
                 </li>
                
                <li>
                    <div class="col-sm-12">
                    <div class="form-group mb-0 mt-10">

                      
                   <input type="submit" value="Search" class="btn btn-colored btn-theme-colored2 text-white btn-lg btn-block">
                    </div>
                  </div>
                </li>
                  
                
              </ul>
            </div>
            </form> 
          </div>
          <div class="col-md-9">
            <div class="tab-content">
                 <!--
                  <h3>Ph D Programme Full Time/Part Time </h3>
                --> 
                  <table cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped">
      <tbody>
        <!--
          <tr>
            <td colspan="9"><p align="center"><strong>PROGRAMME ELIGIBILITY AND DURATION</strong></p></td>
        </tr>
        -->
  <tr>
    <td colspan="8"><p style="text-align:center;"><strong>DOWNLOAD STUDY MATERIALS &amp;    </strong></p></td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>Sr.    No.</strong></p></td>
    <td colspan="2"><p><strong>COURSE</strong></p></td>
    <td colspan="2"><p><strong>CLASS</strong></p></td>
    <td><p><strong>SUBJECT</strong></p></td>
    <td><p><strong>CLICK TO DOWNLOAD PDF <i class="fa fa-download"></i></strong></p></td>
   
  </tr>
  <?php
  
 // print_r($this->session->all_userdata());
  
  
  $x= 1;
 // $product = $this->db->query("SELECT * FROM `product` p LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID ORDER BY p.PRODUCT_ID DESC ")->result();
  
  foreach($product as $pr_list){
  
    ?>
    <tr>
    <td colspan="2"><?php echo $x; ?>.</td>
    <td colspan="2"><p><?php echo $pr_list->brand_name; ?></p></td>
    <td colspan="2"><p style="text-align:center;"><?php echo $pr_list->CATEGORY_NAME; ?></p></td>
    <td><?php echo $pr_list->SUB_CAT_NAME; ?></td>
   
    <td>
    <?php
    if(@$_SESSION['userid']!='')
    {
      ?>
        <a href="<?php echo site_url('download/'.$pr_list->IMG_1.'');  ?>">    <i class="fa fa-file-pdf-o" style="font-size:48px;"></i> </a>
      <?php
    }else{
        
    
    ?>
       <a href="javascript:void(0)" data-toggle="modal" data-target="#customer_login"> <i class="fa fa-file-pdf-o" style="font-size:48px;"  ></i> </a>
    <?php
    }
    ?>
    </td>
 <!--  
    <td><i class="fa fa-shopping-cart" style="font-size:48px;"></i></td>
 -->
  </tr>
    
    <?php
    $x = $x+1;
  }
  ?>
  
  



</tbody></table>
            </div>
          </div>
           
        </div>
  
      </div>
    </section>