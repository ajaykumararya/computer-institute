<?php
$logo=$this->db->get('site_setting')->row();
$profile=$this->db->get('profile')->row();

?>
 <?php 
$header_4nd = $this->db->get_where('color_setting',['CS_ID'=>4])->row();
$header_5nd = $this->db->get_where('color_setting',['CS_ID'=>5])->row();
$header_6nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
$header_8nd = $this->db->get_where('color_setting',['CS_ID'=>8])->row();
$header_10nd = $this->db->get_where('color_setting',['CS_ID'=>10])->row();
?>
<style>
    .bg-theme-header4-background{
        background-color:<?php echo $header_4nd->CS_CODE;  ?>;
    }
    .text-header4-color{
        color:<?php echo $header_4nd->CS_COLOR; ?>;
    }
    .bg-theme-header5-background{
        background-color:<?php echo $header_5nd->CS_CODE;  ?>;
    }
    .text-header5-color{
        color:<?php echo $header_5nd->CS_COLOR; ?>;
    }
     .bg-theme-header6-background{
        background-color:<?php echo $header_6nd->CS_CODE;  ?>;
    }
    .text-header6-color{
        color:<?php echo $header_6nd->CS_COLOR; ?>;
    }
   
</style>
<?php
$page = $this->db->query('SELECT * FROM `front_setting` WHERE `FB_SHOW_HIDE` = 0 ORDER BY `FB_ORDER` ASC')->result();
foreach($page as $page_order){

?>
<?php
if($page_order->FB_ID == 4){
?>
 
    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Composer -->
    <!-- Source: https://www.jssor.com/demos/full-width-slider.slider/=edit -->
    <script src="js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
              [{b:0,d:2000,y:30,e:{y:3}}],
              [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
              [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
              [{b:500,d:1500,o:1}],
              [{b:0,d:1000,y:380,e:{y:6}}],
              [{b:300,d:1000,x:80,e:{x:6}}],
              [{b:300,d:1000,x:330,e:{x:6}}],
              [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
              [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
              [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
              [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $LazyLoading: 1,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 20,
                $SpacingY: 20
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1600;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        /*jssor slider bullet skin 132 css*/
        .jssorb132 {position:absolute;}
        .jssorb132 .i {position:absolute;cursor:pointer;}
        .jssorb132 .i .b {fill:#fff;fill-opacity:0.8;stroke:#000;stroke-width:1600;stroke-miterlimit:10;stroke-opacity:0.7;}
        .jssorb132 .i:hover .b {fill:#000;fill-opacity:.7;stroke:#fff;stroke-width:2000;stroke-opacity:0.8;}
        .jssorb132 .iav .b {fill:#000;stroke:#fff;stroke-width:2400;fill-opacity:0.8;stroke-opacity:1;}
        .jssorb132 .i.idn {opacity:0.3;}

        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
    <svg viewbox="0 0 0 0" width="0" height="0" style="display:block;position:relative;left:0px;top:0px;">
        <defs>
            <filter id="jssor_1_flt_1" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stddeviation="4"></feGaussianBlur>
            </filter>
            <radialGradient id="jssor_1_grd_2">
                <stop offset="0" stop-color="#fff"></stop>
                <stop offset="1" stop-color="#000"></stop>
            </radialGradient>
            <mask id="jssor_1_msk_3">
                <path fill="url(#jssor_1_grd_2)" d="M600,0L600,400L0,400L0,0Z" x="0" y="0" style="position:absolute;overflow:visible;"></path>
            </mask>
        </defs>
    </svg>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;">
              <?php 
                $query=$this->db->get('slider_details')->result();
                foreach ($query as $row ) {
                 
              ?>
            <div >
                <img data-u="image" style="opacity:0.8;" data-src="<?php echo base_url('uploads/').$row->slider_image;?>" />
                <div data-ts="flat" data-p="275" data-po="40% 50%" style="left:150px;top:40px;width:800px;height:300px;position:absolute;">
                    <!--
                    <div data-to="50% 50%" data-t="0" style="left:50px;top:520px;width:400px;height:100px;position:absolute;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">BEER</div>
                    <div data-to="50% 50%" data-t="1" style="left:50px;top:540px;width:400px;height:100px;position:absolute;opacity:0.5;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">BEER</div>
                    <div data-to="50% 50%" data-t="2" style="left:50px;top:560px;width:400px;height:100px;position:absolute;opacity:0.25;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">BEER</div>
                    <div data-to="50% 50%" data-t="3" style="left:50px;top:580px;width:400px;height:100px;position:absolute;opacity:0.125;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">BEER</div>
                    <div data-to="50% 50%" data-t="4" style="left:50px;top:600px;width:400px;height:100px;position:absolute;opacity:0.06;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">BEER</div>
                    <div data-to="50% 50%" data-t="5" style="left:50px;top:710px;width:700px;height:100px;position:absolute;color:#f0a329;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;letter-spacing:0.5em;">MACHINE</div>
                    -->
               </div>
            </div>
            <?php
            }
            ?>
            
        </div>
        
        <a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">slider html</a>
        
        
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb132" style="position:absolute;bottom:24px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:12px;height:12px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
        
        
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>


























     <!-- Start main-content -->
            <div class="main-content bg-theme-header5-background text-header5-color">
                <!-- Section: home 
<section id="home">
      <div class="container-fluid p-0">
        
        <!-- START REVOLUTION SLIDER 5.0.7 
        <div id="rev_slider_home_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34" style="margin:0px auto; background-color:#ffffff; padding:0px; margin-top:0px; margin-bottom:0px;">
         
          <div id="rev_slider_home" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
            <ul>
                <?php 
                $query=$this->db->get('slider_details')->result();
                foreach ($query as $row ) {
                 
               ?>
            
              <li data-index="rs-<?php echo $row->id;?>" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?php echo base_url('uploads/').$row->slider_image;?>" data-rotate="0"  data-fstransition="fade" data-saveperformance="off" data-title="Web Show" data-description="">
               
                <img src="<?php echo base_url('uploads/').$row->slider_image;?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                
                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0 bg-theme-colored-transparent-4" 
                  id="slide-<?php echo $row->id;?>-layer-1" 
                  data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                  data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                  data-width="full"
                  data-height="full"
                  data-whitespace="normal"
                  data-transform_idle="o:1;"
                  data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="opacity:0;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
                  data-start="500" 
                  data-basealign="slide" 
                  data-responsive_offset="on" 
                  style="z-index: 5;background-color:rgba(0, 0, 0, 0.35);border-color:rgba(0, 0, 0, 1.00);"> 
                </div>
               
                <div class="tp-caption tp-resizeme rs-parallaxlevel-0 text-white text-uppercase font-roboto-slab font-weight-700" 
                  id="slide-<?php echo $row->id;?>-layer-2" 
                  data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                  data-y="['top','top','top','top']" data-voffset="['195','195','160','170']" 
                  data-fontsize="['50','48','42','36']"
                  data-lineheight="['70','60','50','45']"
                  data-fontweight="['800','700','700','700']"
                  data-textalign="['center','center','center','center']"
                  data-width="['700','650','600','420']"
                  data-height="none"
                  data-whitespace="normal"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                  data-mask_out="x:0;y:0;s:inherit;e:inherit;" 
                  data-start="600" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on" 
                  style="z-index: 5; white-space: nowrap; font-weight:400;"> <span class="text-theme-colored2"><?php echo $row->title;?></span>
                </div>
               
                <div class="tp-caption tp-resizeme text-white rs-parallaxlevel-0" 
                  id="slide-<?php echo $row->id;?>-layer-3" 
                  data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                  data-y="['top','top','top','top']" data-voffset="['275','260','220','220']"
                  data-fontsize="['16','16',18',16']"
                  data-lineheight="['24','24','24','24']"
                  data-fontweight="['400','400','400','400']"
                  data-textalign="['center','center','center','center']"
                  data-width="['800','650','600','460']"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                  data-mask_out="x:0;y:0;s:inherit;e:inherit;" 
                  data-start="700" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on" 
                  style="z-index: 5; white-space: nowrap;">     <?php echo $row->discription1;?>      </div>
               
                <div class="tp-caption rs-parallaxlevel-0" 
                  id="slide-<?php echo $row->id;?>-layer-4" 
                  data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                  data-y="['top','top','top','top']" data-voffset="['350','330','290','290']" 
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 
                  data-mask_in="x:0px;y:0px;" 
                  data-mask_out="x:0;y:0;" 
                  data-start="800"
                  data-splitin="none" 
                  data-splitout="none" 
                  data-responsive_offset="on" 
                  data-responsive="off"
                  style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-theme-colored2 btn-lg btn-flat text-white font-weight-600 pl-30 pr-30 mr-15" href="Programmes.aspx">Our Courses</a><a class="btn btn-default btn-transparent btn-bordered btn-lg btn-flat font-weight-600 pl-30 pr-30" href="ContactUs.aspx">Enquire Us</a>
                </div>
              </li>
            <?php } ?>
             
            </ul>
            <div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: rgba(255, 255, 255, 0.2);"></div>
          </div>
        </div>

       
        <script type="text/javascript">
            var tpj = jQuery;
            var revapi34;
            tpj(document).ready(function () {
                if (tpj("#rev_slider_home").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_home");
                } else {
                    revapi34 = tpj("#rev_slider_home").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "js/revolution-slider/js/",
                        sliderLayout: "fullwidth",
                        dottedOverlay: "none",
                        delay: 5000,
                        navigation: {
                            keyboardNavigation: "on",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation: "off",
                            onHoverStop: "on",
                            touch: {
                                touchenabled: "on",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            }
                          ,
                            arrows: {
                                style: "zeus",
                                enable: true,
                                hide_onmobile: true,
                                hide_under: 600,
                                hide_onleave: true,
                                hide_delay: 200,
                                hide_delay_mobile: 1200,
                                tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 30,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 30,
                                    v_offset: 0
                                }
                            },
                            bullets: {
                                enable: true,
                                hide_onmobile: true,
                                hide_under: 600,
                                style: "metis",
                                hide_onleave: true,
                                hide_delay: 200,
                                hide_delay_mobile: 1200,
                                direction: "horizontal",
                                h_align: "center",
                                v_align: "bottom",
                                h_offset: 0,
                                v_offset: 30,
                                space: 5,
                                tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span>'
                            }
                        },
                        viewPort: {
                            enable: true,
                            outof: "pause",
                            visible_area: "80%"
                        },
                        responsiveLevels: [1240, 1024, 778, 480],
                        gridwidth: [1240, 1024, 778, 480],
                        gridheight: [500, 500, 500, 250],
                        lazyType: "none",
                        parallax: {
                            type: "scroll",
                            origo: "enterpoint",
                            speed: 400,
                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
                        },
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            nextSlideOnWindowFocus: "off",
                            disableFocusListener: false,
                        }
                    });
                }
            }); /*ready*/
        </script>
      

      </div>
    </section>
    
--->
    
    
                

    <div class="col-xs-12">
        <div class="row bg-theme-header4-background text-header4-color" style=" padding: 5px; box-sizing: border-box">
        <marquee behavior="scroll" scrollamount="3" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
            <ul class="marquee">
                <li><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                <?php
                $news_letter = $this->db->get('news_letter_list')->result();
                foreach($news_letter as $news_letter_list){
                ?>
                    <a href="<?php 
                    
                    if($news_letter_list->NEWS_LINK!= ''){
                        echo $news_letter_list->NEWS_LINK;
                    }else{
                        echo 'javascript:void(0);';
                    }
                    
                    
                    ?>" target="_blank"><?php echo $news_letter_list->NEWS_DESC; ?></a> &nbsp;|&nbsp; 
                <?php
                }
                ?>
                </li>
            </ul>
        </marquee>
        </div>
    </div>
                
                
                <!-- Divider: Features -->
    
<?php
}

?>

<?php
if($page_order->FB_ID == 10){
?>
<?php
	$why_us=$this->db->get('whyus');
	$whyus = $why_us->row();
	$why_us_num = $why_us->num_rows();
	
	
?>
    <!-- about-2 section -->
    <section class="w3l-about-2 pb-1" style="background: wheat;">
        <div class="container  ">
            <div class="row align-items-center justify-content-between" style="padding-top: 5px;">
                <div class="col-lg-5 about-2-secs-right  text-center" style="background: bisque;">
                    <img src="<?php echo base_url('uploads/'.$whyus->WHYUS_IMAGE); ?>" alt="" class="img-fluid img-responsive m-auto" />
                </div>
                <div class="col-lg-7 about-2-secs-left pr-lg-5">
                    <h3 class="title-style mb-sm-3 mb-2">
                      <?php echo $whyus->WHYUS_TITLE; ?> </h3>
                    <p> <?php echo $whyus->WHYUS_DESC; ?> </p>
                    <div class="mt-4">
                        <a class="btn btn-style btn-style-secondary mt-3" href="<?php echo base_url('contact');?>">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //about-2 section -->
<?php
}
?>
<?php
if($page_order->FB_ID == 11){
?>

                <!-- Divider: Important Link -->
    <section id="reservation"  style="padding: 10px;background-image: url(<?php echo base_url('uploads/'.$logo->SS_HOME_BANNER2); ?>);no-repeat fixed center" data-parallax-ratio="0.4">
      <div class="container">
        <div class="row">
          <div class="col-md-8 sm-text-center">
              
            
          
            <div class="row mt-0 sm-text-center">
              <div class="col-xs-12 col-sm-12 col-md-12 hvr-float-shadow mb-sm-30">
              <div class="pricing-table bg-silver-deep text-center maxwidth400 pt-10">
                <h2 class="package-type text-uppercase line-bottom-centered mb-50 text-header6-color" style="background: black;padding: 7px;">
                    <?php echo  get_title_name('information_board')->BACK_END_TITLE; ?></h2>
                
                <ul class="list price-list text-header6-color text-left flip check-circle mt-0 mb-20">
                 <?php
					        $board=$this->db->get_where('information_board',array('status',1))->result();
					        foreach($board as $row){
		            ?>
                   <li><a href="<?php echo $row->link_url;?>" class="text-header6-color">  <?php echo $row->link_name;?> </a></li>
                   <?php } ?>
                 
                </ul>
               
              </div>
            </div>
            </div>
          </div>
          <div class="col-md-4" style="background: antiquewhite;padding: 15px;">
             <div class="p-30 mt-0 bg-dark-transparent-2">
                <h3 class="title-pattern mt-0" style="padding: 7px;background: black;margin-bottom: 5px;">
                  <span class="text-header6-color">Query about <span class="text-header6-color">Course</span></span>
                </h3>
              <!-- Appilication Form Start-->
            <form id="add_enquiry">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      
                         <input name="name" type="text"  class="form-control" placeholder="Enter Name" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <input name="email" type="text"  class="form-control" placeholder="Enter Email" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <input name="mobile" type="text" maxlength="10"  class="form-control" placeholder="Enter Phone" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                     <div class="col-sm-12">
                    <div class="form-group mb-20">
                      
                            <input name="subject" type="text"  class="form-control" placeholder="Enter Subject" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
               
                 
                  <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="message" rows="2" cols="20" id="txtMessage" class="form-control" placeholder="Enter Message">
                    </textarea>
                     <span  style="color:Red;visibility:hidden;">Required</span>
              
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group mb-0 mt-10">

                      
                   <input type="submit"  value="Submit"   class="btn btn-colored btn-theme-colored2 text-white btn-lg btn-block" />
                    </div>
                  </div>
                </div>
                </form>
            
              <!-- Application Form End-->

              </div>
           </div>
        </div>
      </div>
    </section>

<?php
}
?>
 <?php
if($page_order->FB_ID == 12){
?>
<div class="w3l-cutomer-main-cont">
        <div class="testimonials py-5">
            <div class="container py-md-5 py-4">
                <div class="title-heading-w3 text-center mx-auto mb-5 pb-lg-5">
                    <h3 class="title-main"><?php echo  get_title_name('feedback')->BACK_END_TITLE; ?> </h3>
                </div>
                <div class="row content-sec mt-md-5">
                    <?php
                
                    $feedback = $this->db->get('feedback')->result();
                    foreach($feedback as $feedback_list){
                    ?>                   
                    <div class="col-lg-4 col-md-6 testi-sections">
                        <div class="testimonials_grid">
                            <p class="sub-test"><q>
                                   <?php echo $feedback_list->FB_COMMENT; ?></q>
                            </p>
                            <div class="d-grid sub-author-con">
                                <div class="testi-img-res">
                                    <img src="<?php echo base_url('uploads/'.@$feedback_list->FB_PERSON_IMAGE.''); ?>" alt="" class="img-fluid">
                                </div>
                                <div class="testi_grid text-left">
                                    <h5><?php echo $feedback_list->FB_PER_NAME; ?></h5>
                                    <p><?php echo $feedback_list->FB_TITLE; ?>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }?>
                    
                </div>
            </div>
        </div>
    </div>

<?php
}
?>


<!--blog end-->

<!--------------- START SINGLE NOTICE ---------------------------->

<?php
if($page_order->FB_ID == 13){
?>





    <!-- divider: Emergency Services -->

    <section class="divider parallax layer-overlay overlay-dark-9" data-stellar-background-ratio="0.2"  data-bg-img="<?php echo base_url('uploads/'.$logo->SS_HOME_BANNER1); ?>">

      <div class="container">

        <div class="section-content text-center">

          <div class="row">

            <div class="col-md-12">
                
              <h2 class="mt-0 text-white center"><?php echo @$profile->SINGLE_NOTICE; ?></h2>
<!--
              <h2 class="text-white"> Just call at <span class="text-white"><?php echo @$profile->ORG_PHONE; ?></span> </h2>
-->
            </div>

          </div>

        </div>

      </div>      

    </section>

<?php
}
?>


<!----------------- END SINGLE NOTICE------------------------------------------------------>



<?php
if($page_order->FB_ID == 16){
?>

    <!-- courses section -->
    <div class="w3l-grids-block-5 py-5">
        <div class="container py-md-5 py-4">
            <div class="title-heading-w3 text-center mx-auto mb-5 pb-sm-4">
                <h3 class="title-main">Pick a Course to <span>Get Started</span></h3>
            </div>
            <div class="row">
            <?php 
            $query=$this->db->get('our_services');
            $count_service = $query->num_rows();
                
            foreach($query->result() as $row){
           ?>
            
            
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card-single">
                        <div class="grids5-info position-relative">
                            <img style="height: 188px;" src="<?php echo base_url('uploads/').$row->image; ?>" alt="" class="img-fluid" />
                            
                        </div>
                        <div class="content-main-top">
                            <!--
                            <div class="content-top mb-4 mt-3">
                                <ul class="list-unstyled d-flex align-items-center justify-content-between">
                                    <li> <i class="fa fa-signal" aria-hidden="true"></i> Intermediate</li>
                                    <li> <i class="fa fa-clock-o" aria-hidden="true"></i> 10 week</li>
                                </ul>
                            </div>
                            --->
                            <h4><a href="#"><?php echo $row->title; ?></a></h4>
                          
                            <div class="top-content-border d-flex align-items-center justify-content-between mt-5 pt-4">
                                <ul class="rating-list">
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                </ul>
                                <a class="btn btn-style btn-style-primary" href="<?php echo base_url('course-detail/').$row->id;?>">Know Details<i
                                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            
        </div>
    </div>
    <!-- //courses section -->
<?php
}
?>




<!------------------ START GALLERY-------------------------->


<?php
if($page_order->FB_ID == 18){
?>

         <!-- Section: Gallery -->

<?php
 $blogs=$this->db->get_where('blogs',array('PAGE_NAME'=> 3,'BLOG_STATUS'=>1));
$blog = $blogs->result();
$blog_num = $blogs->num_rows();
?>


<!-- courses section -->
    <div class="w3l-grids-block-5 py-5">
        <div class="container py-md-5 py-4">
            <div class="title-heading-w3 text-center mx-auto mb-5 pb-sm-4">
                <h3 class="title-main"> <?php echo  get_title_name('gallery_list')->BACK_END_TITLE; ?> </h3>
            </div>
            <div class="row">
            <?php
					       
		        foreach($blog as $row){
					  $date=$row->BLOG_TT;
                $convert_date = strtotime($date);
                $month = date('F',$convert_date);
                $day = date('d',$convert_date);
                $date = date('d-F-Y',$convert_date);

	        ?>
            
            
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card-single">
                    <!--<a class="fancybox" href="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>">-->
                        <div class="grids5-info position-relative ">
                            
                            <div class="overlay"> 
                                <img style="height: 252px;" src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt="" class="img-fluid" />
                            </div>
                            
                        </div>
                    <!--</a>-->
                     <!--<a class="fancybox" href="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>">-->
                     <!--   <div class="pic">-->
                     <!--    <div class="overlay"><img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt="jain monk" /></div>-->
                     <!--        <img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt="jain monk">-->
                     <!--   </div>                  -->
                     <!--</a>  -->
                        <div class="content-main-top">
                            
                            <h4><a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>"><?php echo $row->BLOG_TITLE; ?></a></h4>
                            <!--<div class="top-content-border d-flex align-items-center justify-content-between mt-5 pt-4">-->
                            <!--    <ul class="rating-list">-->
                            <!--        <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>-->
                            <!--            </a></li>-->
                            <!--        <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>-->
                            <!--            </a></li>-->
                            <!--        <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>-->
                            <!--            </a></li>-->
                            <!--        <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>-->
                            <!--            </a></li>-->
                            <!--        <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>-->
                            <!--            </a></li>-->
                            <!--    </ul>-->
                                <!--<a class="btn btn-style btn-style-primary" href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>">Know Details<i-->
                                <!--        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>-->
                            <!--</div>-->
                            
                        </div>
                    </div>
                </div>
                
                
            <?php } ?>
            </div>
            
        </div>
    </div>




  
      <?php
}
?>


<?php
if($page_order->FB_ID == 15){
?>
    
    
    <!-- courses section -->
    <div class="w3l-grids-block-5 py-5">
        <div class="container py-md-5 py-4">
            <div class="title-heading-w3 text-center mx-auto mb-5 pb-sm-4">
                <h3 class="title-main"> <?php echo  get_title_name('blog_list')->BACK_END_TITLE; ?> </h3>
            </div>
            <div class="row">
            <?php 
                $num=1;
                 $form_key = $this->db->get_where('blogs', array('PAGE_NAME' => $num));
                 foreach ($form_key->result() as $row) {
            ?>
            
            
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card-single">
                        <div class="grids5-info position-relative">
                            <img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt="" class="img-fluid" />
                            
                        </div>
                        <div class="content-main-top">
                            
                            <h4><a href="#"><?php echo $row->BLOG_TITLE; ?></a></h4>
                            <div class="top-content-border d-flex align-items-center justify-content-between mt-5 pt-4">
                                <ul class="rating-list">
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                </ul>
                                <a class="btn btn-style btn-style-primary" href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>">Know Details<i
                                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
            <?php } ?>
            </div>
            
        </div>
    </div>



   
    
    <!-- grids section -->
    <section class="w3l-homeblock1">
        <div class="w3-services-ab py-5">
            <div class="container py-md-5 py-4">
                <div class="w3-services-grids pb-sm-5 mb-sm-4">
                    <div class="row w3-services-right-grid">
                        <div class="col-xl-4">

                        </div>
                        <div class="col-xl-8">
                            <div class="fea-gd-vv row">
                                 <?php 
                                    $num=2;
                                    $form_key2 = $this->db->get_where('blogs', array('PAGE_NAME' => $num));
                                    foreach ($form_key2->result() as $row2) {
                                ?>
                                
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center feature-gd ">
                                        <div class="icon">
                                            <img style="height:50px;width: 50px;border-radius: 250px;" src="<?php echo base_url('uploads/').$row2->BLOG_IMAGE; ?>" alt="" class="img-fluid" />
                                        </div>
                                        <div class="icon-info">
                                            <h5> <?php echo @$row2->BLOG_TITLE; ?> </h5>
                                            <p> <?php echo @$row2->BLOG_DESC; ?> </p>

                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                                }
                                ?>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //grids section -->
    
    
<?php
}
?>


<!-------------------- END GALLERY ------------------------->

<?php
}
?>
 


    

   

    <!-- team section -->
    
    <section class="w3l-team py-sm-5 pb-sm-0 pb-5">
        <div class="container py-md-5 py-4">
            <div class="title-heading-w3 text-center mx-auto mb-5 pb-sm-4">
                <h3 class="title-main">World Class <span>Instructors</span></h3>
            </div>
            <div class="row text-center">
                <?php 
                    $member=$this->db->get_where('member_list',['MEMBER_STATUS'=>1])->result();
                    foreach($member as $row){
                ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="team-block-single">
                        <div class="team-grids">
                            <a href="#team-single">
                                <img src="<?php echo base_url('uploads/').$row->MEMBER_PHOTO?>" class="img-fluid" alt="">
                                <div class="team-info">
                                    <div class="social-icons-section">
                                        <a class="fac" href="#facebook">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                        <a class="twitter mx-2" href="#twitter">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                        <a class="google" href="#google-plus">
                                            <span class="fa fa-google-plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="team-bottom-block p-4">
                            <h5 class="member mb-1"><a href="#team"><?php echo $row->MEMBER_NAME?></a></h5>
                            <small><?php echo $row->MEMBER_POST?></small>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </section>
    <!-- //team setion -->









<!--
<section>
     <div class="container">
         <div class="row">
             <div class="col-md-4">
                 <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/sakhaesociety&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                     
                 </iframe>
             </div>
             <div class="col-md-4">
               <iframe src="https://www.facebook.com/plugins/video.php?height=300&href=https%3A%2F%2Fwww.facebook.com%2Fsakhaesociety%2Fvideos%2F576568383510864%2F&show_text=false&width=357&t=0" width="357" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>     
             </div>
             <div class="col-md-4">
                 <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/sakhaesociety&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                     
                 </iframe>
                 
                 
                 
             </div>
         </div>
     </div>
 </section>
--->
 
 

 
 
 