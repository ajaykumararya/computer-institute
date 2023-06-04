<?php
$logo=$this->db->get('site_setting')->row();
?>
 <?php 
$header_4nd = $this->db->get_where('color_setting',['CS_ID'=>4])->row();
$header_5nd = $this->db->get_where('color_setting',['CS_ID'=>5])->row();
$header_6nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
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
 function make_slidder(){
     
 
 
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
            <div style="background-color:#d3890e;">
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
            <!---
            <div>
                <img data-u="image" data-src="img/px-apartment-chairs-contemporary-2015560-1600.jpg" />
                <div data-ts="flat" data-p="540" data-po="40% 50%" style="left:0px;top:0px;width:1600px;height:560px;position:absolute;">
                    <div data-to="50% 50%" data-ts="preserve-3d" data-t="6" style="left:350px;top:360px;width:900px;height:500px;position:absolute;">
                        <svg viewbox="0 0 800 60" data-to="50% 50%" width="800" height="60" data-t="7" style="left:0px;top:-70px;display:block;position:absolute;opacity:0;font-family:'Roboto Condensed',sans-serif;font-size:60px;font-weight:700;letter-spacing:0.05em;overflow:visible;">
                            <text fill="#454447" stroke="#ff9500" stroke-width="2" text-anchor="middle" x="400" y="60">INTERIOR DESIGN
                            </text>
                        </svg>
                        <div data-to="50% 50%" data-t="8" style="filter:url('#jssor_1_flt_1');left:200px;top:0px;width:600px;height:60px;position:absolute;opacity:0;color:#C49D8F;font-family:Roboto Condensed, sans-serif;font-size:48px;line-height:1.2;letter-spacing:0.1em;text-align:center;">FOR STYLISH LIFE</div>
                        <svg viewbox="0 0 800 100" width="800" height="100" data-t="9" style="left:40px;top:250px;display:block;position:absolute;opacity:0;font-family:'Roboto Condensed',sans-serif;font-size:100px;font-weight:900;letter-spacing:0.5em;overflow:visible;">
                            <text fill="rgba(255,255,255,0.7)" stroke="#ff9500" text-anchor="middle" x="400" y="100">BRAND NAME
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
            <div style="background-color:#000000;">
                <img data-u="image" style="opacity:0.8;" data-src="img/px-back-view-boats-couple-2612852-1600.jpg" />
                <div data-ts="flat" data-p="1080" style="left:0px;top:0px;width:1600px;height:560px;position:absolute;">
                    <svg viewbox="0 0 600 400" data-ts="preserve-3d" width="600" height="400" data-tchd="jssor_1_msk_3" style="left:255px;top:0px;display:block;position:absolute;overflow:visible;">
                        <g mask="url(#jssor_1_msk_3)">
                            <path data-to="300px -180px" fill="none" stroke="rgba(250,251,252,0.5)" stroke-width="20" d="M410-350L410-10L190-10L190-350Z" x="190" y="-350" data-t="10" style="position:absolute;overflow:visible;"></path>
                        </g>
                    </svg>
                    <svg viewbox="0 0 800 72" data-to="50% 50%" width="800" height="72" data-t="11" style="left:-800px;top:78px;display:block;position:absolute;font-family:'Roboto Condensed',sans-serif;font-size:84px;font-weight:900;overflow:visible;">
                        <text fill="#fafbfc" text-anchor="middle" x="400" y="72">GULF MEXICO
                        </text>
                    </svg>
                    <svg viewbox="0 0 800 72" data-to="50% 50%" width="800" height="72" data-t="12" style="left:1600px;top:153px;display:block;position:absolute;font-family:'Roboto Condensed',sans-serif;font-size:60px;font-weight:900;overflow:visible;">
                        <text fill="#fafbfc" text-anchor="middle" x="400" y="72">ENJOY SAILBOAT
                        </text>
                    </svg>
                </div>
            </div>
            <div>
                <img data-u="image" data-src="img/yamamoto.jpg" />
                <div data-ts="flat" data-p="1080" style="left:0px;top:0px;width:1600px;height:560px;position:absolute;">
                    <div data-to="50% 50%" data-t="13" style="left:100px;top:-20px;width:800px;height:200px;position:absolute;opacity:0;">
                        <div style="left:94px;top:35px;width:480px;height:90px;position:absolute;color:rgba(74,217,205,0.5);font-family:'Roboto Condensed',sans-serif;font-size:72px;line-height:1.2;">CREATION</div>
                        <div style="left:307px;top:115px;width:400px;height:50px;position:absolute;color:rgba(74,217,205,0.5);font-family:'Roboto Condensed',sans-serif;font-size:42px;line-height:1.1;text-align:center;background-color:rgba(72,77,76,0.5);">for creative peoples</div>
                    </div>
                </div>
            </div>
            <div>
                <img data-u="image" data-src="img/wine-1600.jpg" />
                <div data-ts="flat" data-p="1080" style="left:0px;top:0px;width:1600px;height:560px;position:absolute;">
                    <div data-to="50% 50%" data-t="14" style="left:690px;top:140px;width:600px;height:150px;position:absolute;opacity:0;color:#ffffff;font-family:Georgia,'Times New Roman',Times,serif;font-size:60px;line-height:1.2;letter-spacing:0.1em;">European Royal<br />Has a long history.</div>
                    <img data-to="50% 50%" data-t="15" style="left:780px;top:350px;width:344px;height:157px;position:absolute;opacity:0;max-width:344px;" data-src="img/wine-atlantic-ocean.png" />
                    <img data-to="50% 50%" data-t="16" style="left:1330px;top:8px;width:172px;height:131px;position:absolute;opacity:0;max-width:172px;" data-src="img/wine-badge.png" />
                </div>
            </div>
            ---->
            
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


<?php
}
?>
















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

<?php
function make_marquee(){
    


?>

    
    
                <div class="row bg-theme-header4-background text-header4-color" style=" padding: 5px; box-sizing: border-box">

                    <div class="col-xs-12">

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

function make_notice1(){
    

?>
    
                
    <section class="divider bg-silver-deep">
      <div class="container pt-50 pb-60">
        
        <div class="row">

       <?php 
        $query=$this->db->get('our_services');
        $count_service = $query->num_rows();
            
        foreach($query->result() as $row){
       ?>
          <div class="col-xs-12 col-sm-6 col-md-4">
                <a href="Admissions.aspx" >
            <div class="feature-box text-center">
              <div class="feature-icon">
                <img src="<?php echo base_url('uploads/').$row->image; ?>" alt="">
              </div>
              <div class="feature-title">
                <h3>Admissions</h3>
             
                <a href="javascript:void(0);" target="_blank"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    Disclaimer
                </a>
              </div>
            </div>
           </a>
          </div>
          <?php } ?>
                     </div>
      </div>
    </section>
    
    
   
   

   
    
    <section>
      <div class="container pb-50">
        <div class="section-content">
          <div class="row">
            <div class="col-md-4 ">
              <h3 class="text-uppercase line-bottom-theme-colored-2 mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i>University <span class="text-theme-colored2">News</span><a href="News.aspx" class="btn btn-flat btn-dark btn-theme-colored btn-xs pull-right">View All</a></h3>
                
                <?php 
                
                      $query=$this->db->get_where('news',array('status'=>1))->result();
                            foreach($query as $row){
                      
                                          
                            $date=$row->date;
                            $convert_date = strtotime($date);
                            $month = date('F',$convert_date);
                            $day = date('d',$convert_date);
                            $date = date('d-F-Y',$convert_date);


                  ?>
                <article>
                 
                <div class="event-block pr-40">
                  <div class="event-date text-center">
                    <ul class="text-white font-18 font-weight-600">
                      <li class="border-bottom"> <?php echo $day;?> </li>
                      <li class=""><?php echo $month;?></li>
                    </ul>
                  </div>
                  <div class="event-meta border-1px pl-40 pb-40 pt-10" style="width:100%" id="news" data-news_id="<?php  echo $row->image;?>" data-news_title="<?php echo $row->title;?>" data-news_desc="<?php echo $row->description;?>">
                    <div class="event-content pull-left flip">
                      <h5 class="event-title media-heading font-roboto-slab font-weight-400 "><a  style="cursor:pointer"><?php echo $row->title;?></a></h5>
                     
                     
                    
                    </div>
                         <a href="<?php echo base_url('welcome/download/').$row->image;?>" style='display:inline'    class="btn btn-flat btn-dark btn-theme-colored btn-xs pull-right" >Download <i class="fa fa-download"></i> </a>
                  </div>
                </div>
              </article>
            <?php } ?>
              <div id="NewsModal150" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

            
            <div class="modal-content">
              <div class="modal-header">
               
                <h4 class="modal-title">
                        <span id="news-model-title"></span>
                        <a href="#" id="news-model-href" style='display:inline'  class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-right" >Download <i class="fa fa-download"></i> </a>
                </h4>
              </div>
              <div class="modal-body">
                 <div style="text-align:justify" class="news_title"><span id="news-model-desc"></span></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        </div>
            <div class="col-md-4">
              <h3 class="text-uppercase line-bottom-theme-colored-2 line-height-1 mt-0 mt-sm-30"><i class="fa fa-question-circle-o mr-10"></i>Notice<span class="text-theme-colored2"> Board</span> <a href="Notice.aspx" class="btn btn-flat btn-dark btn-theme-colored btn-xs pull-right">View All</a></h3>
              <div class="panel-group accordion-stylished-left-border accordion-icon-filled accordion-no-border accordion-icon-left accordion-icon-filled-theme-colored2" id="accordion6" role="tablist" aria-multiselectable="true">
                 <?php
					$notice=$this->db->get_where('notice_board',array('status',1))->result();
					foreach($notice as $row){
				 ?>
                  <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headin1">
                    <h6 class="panel-title" style="height:55px;overflow:hidden">
                      <a role="button" data-toggle="collapse" data-parent="#accordion6" href="#collaps1147" aria-expanded="true" aria-controls="collaps1">
                        <?php echo $row->title;?>
                      </a>
                    </h6>
                  </div>
                  <div id="collaps1147" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headin1">
                    <div class="panel-body">
                    <div style="height:80px;overflow:hidden"> <p><?php echo $row->description;?></p>
                    </div>
                        <a  href="<?php echo base_url('welcome/download/').$row->image;?>" style='display:inline'  class="btn btn-flat btn-dark btn-theme-colored btn-xs pull-right" >Download <i class="fa fa-download"></i> </a>
                    </div>
                  </div>
                </div>
					<?php } ?>
 
                
                  
              </div>
            </div>
              <div class="col-md-4">              
              <h3 class="text-uppercase line-bottom-theme-colored-2 mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i>Events<span class="text-theme-colored2"></span><a href="Events.aspx" class="btn btn-flat btn-dark btn-theme-colored btn-xs pull-right">View All</a></h3>
              <div class="owl-carousel-1col owl-nav-top" data-nav="true">
                <?php 
                   $event=$this->db->get_where('blogs', array('page_name' => '2'));
                   foreach ($event->result() as $row) {
                 
                ?>
                    <div class="item">
                  <article class="post clearfix mb-30">
                    <div class="entry-header">
                      <div class="post-thumb thumb"> 
                        <img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" style="height:250px;" alt="adesh nursing college bathinda events" class="img-responsive img-fullwidth"> 
                      </div>                    
                      <div class="entry-date media-left text-center flip bg-theme-colored border-top-theme-colored2-3px pt-5 pr-15 pb-5 pl-15">
                          <?php
                             $date= $row->BLOG_TT;

                             $convert_date = strtotime($date);
                             $month = date('F',$convert_date);
                             $day = date('d',$convert_date);
                             $date = date('d-f-Y',$convert_date);


                    ?>
                        <ul>
                          <li class="font-16 text-white font-weight-600"><?php echo $day;?></li>
                          <li class="font-12 text-white text-uppercase"><?php echo $month;?></li>
                        </ul>
                      </div>
                    </div>
                    <div class="entry-content p-15">
                      <div class="entry-meta media no-bg no-border mt-0 mb-10">
                        <div class="media-body pl-0">
                          <div class="event-content pull-left flip">
                            <h4 class="entry-title  text-uppercase font-weight-600 m-0 mt-5"> <?php //echo $row->BLOG_TITLE;?>  </h4>
                            <ul class="list-inline">
                              <li><i class="fa fa-calendar mr-5 text-theme-colored2"></i><?php //echo $date;?></li>
                            
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="mt-5" style="height:50px;overflow:hidden"><p style="margin-left:0in; margin-right:0in; text-align:justify">&nbsp;</p>

<p style="margin-left:0in; margin-right:0in; text-align:justify"><span style="font-size:11pt"><span style="font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;"><?php echo $row->BLOG_DESC;?></span></span></p>


</div>
                    </div>
                  </article>
                </div>
              <?php } ?>
                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
  
    
    
                <!-- Section: About -->

    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row ">
          <?php
          $notice_x = $this->db->get_where('latest_news',array('status',1));
          $notice = $notice_x->result();
          $count_notice = $notice_x->num_rows();
         
          ?>
          
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
               <div class="widget">
                <h3 class="text-uppercase mt-0 mt-sm-30">Top <span class="text-theme-colored2">LATEST NEWS</span></h3>
              <div class="double-line-bottom-theme-colored-2"></div>
                <ul class="nav nav-pills nav-stacked list-divider list-border list check" >
                    <?php
        				$notice=$this->db->get_where('latest_news',array('status',1))->result();
        				foreach($notice as $row){
        			?>
                        <li  class="active"><a  href="javascript:void(0);"><img style="height:30px; width:30px;" src="<?php echo base_url('uploads/'.$row->image.''); ?>"> <?php echo $row->title; ?> </a> 
                        <p><?php echo $row->description; ?></p>
                        </li>
                    <?php } ?> 
                </ul>
              </div>
            
            </div>
          </div>
          <?php
          
           $admission_x=$this->db->get_where('admission_notice',array('status',1));
           $admission = $admission_x->result();
           $count_admission = $admission_x->num_rows();
          
               
           
          ?>
         
          <div class="col-sm-12 col-md-6">
              <h3 class="text-uppercase mt-0 mt-sm-30">Notice <span class="text-theme-colored2"><?php echo date('Y'); ?></span> <a href="javascript:void(0)" class="btn btn-danger pull-right btn-xs">View All</a></h3>
              <div class="double-line-bottom-theme-colored-2"></div>
             
              <div id="accordion1" class="panel-group accordion">
                <div class="panel">
                 
                  <div id="accordion11" class="panel-collapse collapse in" role="tablist" aria-expanded="true">
                    <div class="panel-content">
                     <ul class="list theme-colored angle-double-right admissions">
                         
                         <?php
					       
					        foreach($admission as $row){
				        ?>

                        <li><a href="<?php echo $row->link_url?>" target="_blank"><img src="<?php echo base_url(); ?>webcss/images/new2_e0.gif" class="newicon" /><?php echo $row->link_name?></a></li>
                      <?php } ?>
                             
                     
                        </ul>

                    </div>
                      
                  </div>
                </div>
         
          
              </div>
            </div>
            <?php
           
           $advance_x=$this->db->get_where('advance_notice',array('status',1));
           $advance = $advance_x->result();
            $count_advance = $advance_x->num_rows();
            
                
            
           ?>
          <div class="col-sm-12 col-md-3">
           <div class="sidebar sidebar-right mt-sm-30">
                <div class="widget">
                         <h3 class="text-uppercase mt-0 mt-sm-30">Advance Notice <?php echo date('Y'); ?> <span class="text-theme-colored2"> </span></h3>
              <div class="double-line-bottom-theme-colored-2"></div>
                    
               <div class="owl-carousel-1col dots-left" data-dots="true">
                   <?php
					        
					        foreach($advance as $row){
				        ?>  
                   <div class="item">
                       
                    
                   <img alt="" src="<?php echo base_url('uploads/').$row->image; ?>" style="height:180px;" class="img-responsive img-thumbnail img-fullwidth">
                    <h4 class="title"><?php echo $row->title;?></h4>
                    <p><?php echo $row->description;?></p>
                            
                  </div>
                  <?php } ?>
                 
                 
                </div>
              </div>
        
           </div>
          </div>
          <?php
            
            ?>
        </div>
      </div>
    </section>
    
    <section id="pricing">
      <div class="container pt-70">
   
        <div class="section-content">
          <div class="row">
            
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
              <div class="pricing-table bg-silver-deep text-center maxwidth400 pt-10">
                <h2 class="package-type text-uppercase line-bottom-centered mb-50">Examination</h2>
              
                <ul class="list price-list theme-colored text-left flip check-circle mt-0 mb-20">
                   <?php
					        $blog=$this->db->get_where('blogs',array('PAGE_NAME'=> 4,'BLOG_STATUS'=>1))->result();
					        foreach($blog as $row){
				        ?>  
                
                  <li><?php echo $row->BLOG_TITLE; ?></li>
                  <?php } ?>
                                   
                </ul>
               
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
              <div class="pricing-table bg-silver-deep text-center maxwidth400 pt-10">
                <h2 class="package-type text-uppercase line-bottom-centered mb-50 " >Advertisement</h2>
               
                <ul class="list price-list theme-colored text-left flip check-circle mt-0 mb-20">
                   <?php
					        $blog=$this->db->get_where('blogs',array('PAGE_NAME'=> 5,'BLOG_STATUS'=>1))->result();
					        foreach($blog as $row){
				        ?>  
                
                    
                  <li><?php echo $row->BLOG_TITLE; ?></li>
                  
                  <?php } ?>
                  
                </ul>
                <a class="btn btn-lg btn-theme-colored text-uppercase btn-block pt-20 pb-20 btn-flat" href="Advertisement.aspx">View All</a>
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
              <div class="pricing-table bg-silver-deep text-center maxwidth400 pt-10">
                <h2 class="package-type text-uppercase line-bottom-centered mb-50 ">Student Corner </h2>
                
                <ul class="list price-list theme-colored text-left flip check-circle mt-0 mb-20">
                 <?php
					        $blog=$this->db->get_where('blogs',array('PAGE_NAME'=> 6,'BLOG_STATUS'=>1))->result();
					        foreach($blog as $row){
				        ?>  
                                  <li><?php echo $row->BLOG_TITLE; ?></li>

                  <?php } ?>
                 
                </ul>
               
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    
    <?php
		$why_us=$this->db->get('whyus');
		$whyus = $why_us->row();
		$why_us_num = $why_us->num_rows();
		
		if($why_us_num > 0){
	?>
    <section>
      <div class="container pt-30 pb-0">
        <div class="row">
          <div class="col-md-5">
            <img class="img-fullwidth" src="<?php echo base_url('uploads/'.$whyus->WHYUS_IMAGE); ?>" alt="">
          </div>
          <div class="col-md-7 pt-20">
            <div class="row mtli-row-clearfix">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2><?php echo $whyus->WHYUS_TITLE; ?> <span class="text-theme-colored2"></span> </h2>
                <div class="double-line-bottom-theme-colored-2 mb-30"></div>
              </div>
                 
              
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="icon-box left media p-0 mb-40"> 
                  <a class="media-left pull-left flip mr-20" href="#" target="_blank"><i class="pe-7s-global text-theme-colored2 font-weight-600"></i></a>
                  <div class="media-body">
                    <h4 class="media-heading heading mb-10"><?php echo $whyus->WHYUS_TITLE; ?></h4>
                    <p>
                        <?php echo $whyus->WHYUS_DESC; ?>
                    </p>
                  </div>
                </div>
              </div>
			  
                   
            </div>
          </div>
        </div>
      </div>
    </section>

                <!-- Section: Courses -->
    <?php
		}
     $college=$this->db->get_where('our_branches',array('status',1));
     $colleges = $college->result();
     $num_college = $college->num_rows();
         
     
     ?>
    
    
    <section id="courses" class="bg-silver-deep">
      <div class="container pb-40">
        <div class="section-title">
          <div class="row">
            <div class="col-md-12">
              <h2 class="text-uppercase title">Our <span class="text-theme-colored2">BLOGS</span></h2>              
             
              <div class="double-line-bottom-theme-colored-2"></div>
            </div>
          </div>
        </div>
        <div class="row mtli-row-clearfix">
          <div class="owl-carousel-3col" data-nav="true">
          <?php
					       
					        foreach($colleges as $row){
		 ?> 
            <div class="item">
              <div class="course-single-item bg-white border-1px clearfix mb-30">
                <div class="course-thumb">
                  <img class="img-fullwidth" alt="" src="<?php echo base_url('uploads/').$row->image; ?>">
                  <div class="price-tag">College</div>
                </div>
                <div class="course-details clearfix p-20 pt-15">
                  <div class="course-top-part pull-left mr-40">
                    <a href="#"><h4 class="mt-0 mb-5"><?php echo $row->title;?></h4></a>
                    <ul class="list-inline">
                      <li class="review-stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </li>
                     
                    </ul>
                  </div>
                 
                  <div class="clearfix"></div>
                  <p class="course-description mt-20"><?php echo $row->description;?></p>
                  <ul class="list-inline course-meta mt-15">
                  
                    <li>
                      <a href="<?php echo $row->url;?>" class="btn btn-success">Visit Website</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            <?php } ?>
          
          
          </div>
        </div>
      </div>
    </section>
    
                <!-- Divider: Important Link -->
    <section id="reservation" class="parallax layer-overlay bg-theme-header6-background" data-bg-img="images/bg/bg1.jpg" data-parallax-ratio="0.4">
      <div class="container">
        <div class="row">
          <div class="col-md-8 sm-text-center">
              
            
          
            <div class="row mt-0 sm-text-center">
              <div class="col-xs-12 col-sm-12 col-md-12 hvr-float-shadow mb-sm-30">
              <div class="pricing-table bg-silver-deep text-center maxwidth400 pt-10">
                <h2 class="package-type text-uppercase line-bottom-centered mb-50 text-header6-color">Information Board</h2>
                
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
          <div class="col-md-4">
             <div class="p-30 mt-0 bg-dark-transparent-2">
              <h3 class="title-pattern mt-0"><span class="text-header6-color">Query about <span class="text-header6-color">Course</span></span></h3>
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
                      <textarea name="comment" rows="2" cols="20" id="txtMessage" class="form-control" placeholder="Enter Message">
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







           <!-- Section: Gallery -->
                


<?php
 $blogs=$this->db->get_where('blogs',array('PAGE_NAME'=> 3,'BLOG_STATUS'=>1));
$blog = $blogs->result();
$blog_num = $blogs->num_rows();


?>
<section id="blog">
    <div class="container pb-40">
        <div class="section-title">
          <div class="row">
            <div class="col-md-12">
              <h2 class="text-uppercase title">Latest <span class="text-theme-colored2">Gallery </span><a href="javascript:void(0);" class="btn btn-colored btn-theme-colored2 text-white pull-right btn-sm pl-40 pr-40 mt-15">View All</a></h2>              
              <!--
              <p class="text-uppercase mb-0">Life at Adesh University</p>
              -->
              <div class="double-line-bottom-theme-colored-2"></div>
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">

                  <?php
					       
					        foreach($blog as $row){
								  $date=$row->BLOG_TT;
                            $convert_date = strtotime($date);
                            $month = date('F',$convert_date);
                            $day = date('d',$convert_date);
                            $date = date('d-F-Y',$convert_date);

				        ?>  
                

            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                 <a id="RptGallery_ctl00_LnkGallery" href="<?php echo site_url(); ?>">
            <div class="course-single-item style2 text-center mb-40">
              <div class="course-thumb">
                <img class="img-fullwidth" alt=""src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" style="width:100%;height:200px;">
                
              </div>
              <div class="course-details border-1px clearfix p-15 pt-15">
                <div class="course-top-part">
                 <h4 class="line-bottom-centered mt-20 mb-30" style="height:55px;overflow:hidden"><?php echo $row->BLOG_TITLE;?></h4>
                </div>
                <div class="author-thumb">
                  <img src="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" width="54" alt="" class="img-circle img-thumbnail">
                </div>
             
              </div>
              <div class="course-meta bg-silver-deep">

                <ul class="list-inline">
                  <li><i class="fa fa-calendar text-theme-colored2 mr-5"></i><?php echo $date;?></li>
                  <li><center><p class="btn btn-default btn-xs">View</p></center></li>
                 
                </ul>
              </div>
            </div>
                     </a>
          </div>
							<?php } ?>
 

          </div>
        </div>
    </div>
</section>    
      <?php
?>
    



                <!-- end main-content -->
            </div>
            <!-- Footer -->

            <!-- end wrapper -->
            
            
    <!-- Section: Causes -->

    <section id="causes" class="bg-silver-light">

      <div class="container">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-10 col-md-offset-1">

              <h2 class="text-uppercase line-bottom-center mt-0">Our <span class="text-theme-colored font-weight-600">Causes</span></h2>

              <div class="title-icon">

                <i class="flaticon-charity-hand-holding-a-heart"></i>

              </div>

              <?php 

                       $causes_desc = $this->db->query("select * from causes");                

                      $row = $causes_desc->row();

                      



              ?>
<!---
              <p><?php echo $row->causes; ?></p>
---->
            </div>

          </div>

        </div>

        <div class="row multi-row-clearfix">

          <div class="owl-carousel-3col">

          <?php 

                $causes = $this->db->get('causes');

                foreach($causes->result() as $row){

              ?> 

            <div class="item">

              <div class="causes bg-white maxwidth500 mb-30">

                <div class="thumb">

                  <img src="<?php echo base_url('uploads/').$row->image_url ?>" alt="" class="img-fullwidth">

                </div>

                <div class="causes-details clearfix border-bottom p-15 pt-15 pb-15">

                <ul class="list-inline font-20 font-weight-600 clearfix mb-5">

                  <li class="pull-left font-weight-400 text-black-333 pr-0">Raised: <span class="text-theme-colored font-weight-700">$<?php echo $row->raised; ?></span></li>

                  <li class="pull-right font-weight-400 text-black-333 pr-0">Goal: <span class="text-theme-colored font-weight-700">$<?php echo $row->goal; ?></span></li>

                </ul>

                <h4 class="text-uppercase"><a href="<?php echo base_url(); ?>webpages/page-single-cause.html"><?php echo $row->cause_title; ?></a></h4>

                  <!-- <div class="progress-item mt-0">

                    <div class="progress mb-0">

                      <div data-percent="84" class="progress-bar"><span class="percent">0</span></div>

                    </div>

                  </div>
 -->
                <p class="mt-20"><?php echo $row->cause_desc; ?></p>

                <a href="<?php echo base_url(); ?>webpages/page-donate.html" class="btn btn-default btn-theme-colored btn-xs font-16 mt-10"><i class="flaticon-charity-make-a-donation font-16 ml-5"></i> <?php echo $row->button_name; ?> <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>

                </div>

              </div>

            </div>

            <?php }?>

        

          </div>

        </div>

      </div>

    </section>
            
  
  
  
  
  
  
    <!-- Divider: Funfact -->

    <section class="divider parallax layer-overlay overlay-dark-9" data-bg-img="<?php echo base_url(); ?>webpages/images/bg/bg4.jpg" data-parallax-ratio="0.7">

      <div class="container pt-80 pb-80">

        <div class="row">

          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">

            <div class="funfact text-center">

              <i class="pe-7s-smile mt-5 text-white"></i>

              <h2 data-animation-duration="2000" data-value="1054" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

              <h5 class="text-white text-uppercase font-weight-600">Happy Donators</h5>

            </div>

          </div>

          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">

            <div class="funfact text-center">

              <i class="pe-7s-rocket mt-5 text-white"></i>

              <h2 data-animation-duration="2000" data-value="875" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

              <h5 class="text-white text-uppercase font-weight-600">Success Mission</h5>

            </div>

          </div>

          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">

            <div class="funfact text-center">

              <i class="pe-7s-add-user mt-5 text-white"></i>

              <h2 data-animation-duration="2000" data-value="1248" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

              <h5 class="text-white text-uppercase font-weight-600">Volunteer Reached</h5>

            </div>

          </div>

          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">

            <div class="funfact text-center">

              <i class="pe-7s-global mt-5 text-white"></i>

              <h2 data-animation-duration="2000" data-value="54" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

              <h5 class="text-white text-uppercase font-weight-600">Globalization Work</h5>

            </div>

          </div>

        </div>

      </div>

    </section>












    <!-- divider: Emergency Services -->

    <section class="divider parallax layer-overlay overlay-dark-9" data-stellar-background-ratio="0.2"  data-bg-img="<?php echo base_url(); ?>webpages/images/bg/bg2.jpg">

      <div class="container">

        <div class="section-content text-center">

          <div class="row">

            <div class="col-md-12">

              <h2 class="mt-0 text-white">How you can help us</h2>

              <h2 class="text-white">Just call at <span class="text-theme-colored"><?php echo @$row_profile->ORG_PHONE; ?></span> to make a donation</h2>

            </div>

          </div>

        </div>

      </div>      

    </section>






    <!-- Section: Testimonials -->

    <section class="divider parallax layer-overlay overlay-dark-9" data-bg-img="<?php echo base_url(); ?>webpages/images/bg/bg23.jpg" data-parallax-ratio="0.7">

      <div class="container pt-60 pb-60">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h2 class="text-white mt-0">Happy Donors Say</h2>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-12">

            <div class="pt-20">

              <div class="testimonial style1 owl-carousel-2col">

                <div class="item">

                  <div class="comment border-radius-15px">

                    <p>Lorem ipsum dolor sit ametconse ctetur adipisicing elitvolup tatem error sit qui dolorem facilis. adipisicing elitvolup tatem error</p>

                  </div>

                  <div class="content mt-20">

                    <div class="thumb pull-right">

                      <img class="img-circle" alt="" src="<?php echo base_url(); ?>webpages/images/testimonials/s1.jpg">

                    </div>

                    <div class="patient-details text-right pull-right mr-20 mt-10">

                      <h5 class="text-theme-colored">Jonathan Smith</h5>

                      <h6 class="title">kode inc.</h6>

                    </div>

                  </div>

                </div>

                <div class="item">

                  <div class="comment border-radius-15px">

                    <p>Lorem ipsum dolor sit ametconse ctetur adipisicing elitvolup tatem error sit qui dolorem facilis. adipisicing elitvolup tatem error</p>

                  </div>

                  <div class="content mt-20">

                    <div class="thumb pull-right">

                      <img class="img-circle" alt="" src="<?php echo base_url(); ?>webpages/images/testimonials/s2.jpg">

                    </div>

                    <div class="patient-details text-right pull-right mr-20 mt-10">

                      <h5 class="text-theme-colored">Jonathan Smith</h5>

                      <h6 class="title">kode inc.</h6>

                    </div>

                  </div>

                </div>

                <div class="item">

                  <div class="comment border-radius-15px">

                    <p>Lorem ipsum dolor sit ametconse ctetur adipisicing elitvolup tatem error sit qui dolorem facilis. adipisicing elitvolup tatem error</p>

                  </div>

                  <div class="content mt-20">

                    <div class="thumb pull-right">

                      <img class="img-circle" alt="" src="<?php echo base_url(); ?>webpages/images/testimonials/s3.jpg">

                    </div>

                    <div class="patient-details text-right pull-right mr-20 mt-10">

                      <h5 class="text-theme-colored">Jonathan Smith</h5>

                      <h6 class="title">kode inc.</h6>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

<?php
}
?>

            
            
            
                                                                                                                                                                                         