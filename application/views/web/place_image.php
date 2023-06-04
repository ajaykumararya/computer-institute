<section class="fullrow" id="homePhotos" style="background:#F0F8FF">
  <div class="container" style="width:100%;">

    <div class="titlewithLink">
      <h2 class="style1"><i class="fa fa-quote-left"></i> Place Image</h2>
      <!--<div class="viewAllLink"><a href="https://jainsanskriti.com/multi-blog/13">View All <i class="fa fa-angle-right"></i></a></div>-->
      <div class="clear"></div>
    </div>
    <div class="owl-homePhotos owl-carousel owl-theme owl-loaded owl-drag">
        <div class="owl-stage-outer">
            <div class="owl-stage" style="transform: translate3d(-1349px, 0px, 0px); transition: all 0s ease 0s; width: 3036px;">
            <?php
            $image=$this->db->get_where('jain_place_image',['JPI_JAIN_PLACE_ID'=>$this->uri->segment(3)])->result();
            foreach($image as $row){
            ?>
                <div class="owl-item cloned" style="width: 307.25px; margin-right: 30px;">
                    <div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">
                      <a class="fancybox" href="<?php echo base_url('uploads/').$row->JPI_IMAGE_URL;?>">
              <div class="pic">
                <div class="overlay"><img src="<?php echo base_url('uploads/').$row->JPI_IMAGE_URL;?>" alt="Ann ka Man par Pravav"></div>
                <img src="<?php echo base_url('uploads/').$row->JPI_IMAGE_URL;?>" alt="Ann ka Man par Pravav">
              </div>                  
            </a>
                      <div class="lower-content text-center">
                        <div class="videoDate"><?php echo date('Y-m-d' ,strtotime($row->JPI_TT));?></div>
                            <div class="videoDesc">
                                <div class="buttonGroup">
                                    <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download">
                                        <i class="fa fa-file"></i>Get Detail
                                    </a> 
                                </div>
                            </div>
                        </div>
                    <p style="background: bisque;padding: 10px;"> <?php echo $row->JP_DESC;?> </p>
                    </div>
                
                </div>
            <?php
            }
            ?>
        <!--<div class="owl-item cloned" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item active" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned active" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned active" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned active" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        <!--<div class="owl-item cloned" style="width: 307.25px; margin-right: 30px;"><div class="carouselBox wow fadeInUp" style="border: 1px solid black; border-radius: 5px; visibility: visible;">-->
        <!--    <a class="fancybox" href="https://jainsanskriti.com/uploads/617d05582cd4b.jpg">-->
        <!--      <div class="pic">-->
        <!--        <div class="overlay"><img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav"></div>-->
        <!--        <img src="https://jainsanskriti.com/uploads/617d05582cd4b.jpg" alt="Ann ka Man par Pravav">-->
        <!--      </div>                  -->
        <!--    </a>-->
        <!--    <div class="lower-content text-center">-->
        <!--                <div class="videoDate">30-October-2021</div>-->
        <!--                    <div class="videoDesc">-->
        <!--                        <div class="buttonGroup">-->
        <!--                            <a href="https://jainsanskriti.com/multi-blog-detail/39" style="cursor: pointer;" class="btn-download"><i class="fa fa-file"></i>Get Detail</a> -->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
                        
        <!--    <p style="background: bisque;padding: 10px;"> Ann ka Man par Pravav </p>-->
        <!--</div></div>-->
        </div>
        </div>
        <div class="owl-nav disabled">
            <button type="button" role="presentation" class="owl-prev">
                <i class="fa fa-long-arrow-left"></i>
            </button>
            <button type="button" role="presentation" class="owl-next">
                <i class="fa  fa-long-arrow-right"></i>
            </button>
        </div>
        <div class="owl-dots disabled"></div>
    </div>
  </div>
</section>