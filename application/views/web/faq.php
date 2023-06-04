
           <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="<?php echo base_url('webpages/');  ?>images/bg/bg6.jpg">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title text-white">FAQ</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-theme-colored">Page Title</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

   
  </div>
  <!-- end main-content -->   
  
  
  
  
  

<?php
$question = '';
$answer = '';
 $i=1;
  $faq_list = $this->db->get('fquestion')->result();
 foreach ($faq_list as $faq) {

  $title2 = '<a href="#section-'.$i.'" class="list-group-item smooth-scroll-to-target">'.@$faq->FQUESTION.' </a>';
  $question.= $title2;

  $answer2 = '<div id="section-one" class="mb-50">
              <h3>'.@$faq->FQUESTION.'?</h3>
              <hr>
              <p class="mb-20">'.@$faq->FANSWER.'.</p>
            </div>';
  $answer.= $answer2;          
 ?>           

   
    

<?php
$i = $i+1;
 }
 ?>

<section class="position-inherit">
      <div class="container">
        <div class="row">
          <div class="col-md-3 scrolltofixed-container">
            <div class="list-group scrolltofixed z-index-0">
              
              <?php echo $question; ?>



              
            </div>
          </div>
          <div class="col-md-9">
            <?PHP echo $answer ?>
            


          </div>
        </div>
      </div>
    </section>

            