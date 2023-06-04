<?php 
$profile=$this->db->get('profile')->row();
$logo=$this->db->get('site_setting')->row();
$header_7nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
$header_8nd = $this->db->get_where('color_setting',['CS_ID'=>7])->row();
?>





    <!-- footer -->
    <footer class="w3l-footer-22 position-relative ">
        <div class="footer-sub">
            <div class="container">
                <div class="text-txt">
                     <!---
                    <div class="right-side">
                        
                        
                       
                        <div class="row align-items-center w3l-forms-9">
                            <div class="main-midd col-md-6">
                                <h4 class="title-head mb-lg-2">Subscribe Us to join our Community </h4>
                                <p>Newsletter</p>
                            </div>
                            <div class="main-midd-2 col-md-6 mt-md-0 mt-4">
                                <form id="subscription"  class="rightside-form">
                                
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter your email">
                                    <button class="btn" type="submit">Send</button>
                                </form>
                            </div>
                        </div>
                        
                        
                        
                       
                    </div>
                    -->
                    <div class="row sub-columns">
                        <div class="col-lg-2 col-sm-6 sub-two-right">
                            <h6>Quick links</h6>
                            
                            
                            <ul>
                                <?php 
                                  $links=$this->db->get('important_link');
                                  foreach($links->result() as $row){
                                ?>
                                 <li><a href="<?php echo $row->LINK_URL;?>" target="_blank">
                                     <i class="fa fa-link text-theme-colored2 mr-5" aria-hidden="true"></i> 
                                     <?php echo $row->LINK_NAME;?></a></li>
                                <?php } ?>
                                <!--<li><a href="index-2.html"><span class="fa fa-angle-double-right mr-2"></span>Home</a>-->
                                <!--</li>-->
                                <!--<li><a href="about.html"><span class="fa fa-angle-double-right mr-2"></span>About</a>-->
                                <!--</li>-->
                                <!--<li><a href="courses.html"><span-->
                                <!--            class="fa fa-angle-double-right mr-2"></span>Courses</a></li>-->
                                <!--<li><a href="contact.html"><span-->
                                <!--            class="fa fa-angle-double-right mr-2"></span>Contact</a></li>-->
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-6 sub-two-right pl-lg-5 mt-sm-0 mt-4">
                            <h6>Help & Support</h6>
                            <ul>
                            <?php
                                $link=$this->db->get('social_links')->result();
                                $profile=$this->db->get('profile')->row();
                                foreach($link as $row){
                            ?>
                                <li><a href="<?php echo $row->LINK_URL;?>"><span class="fa fa-angle-double-right mr-2"></span><?php echo $row->LINK_NAME;?></a></li>
                            <?php
                                }
                            ?>
                                        
                            </ul>
                        </div>
                        <div class="col-lg-3 col-sm-6 sub-one-left mt-lg-0 mt-sm-5 mt-4">
                            <h6>Contact </h6>
                            <div class="column2">
                                
                                <div class="href1"><span class="fa fa-envelope-o" aria-hidden="true"></span><a
                                        href="#"><?php echo $profile->ORG_EMAIL;?></a>
                                </div>
                                <div class="href2"><span class="fa fa-phone" aria-hidden="true"></span><a
                                        href="#"><?php echo $profile->ORG_PHONE;?></a>
                                </div>
                                <div>
                                    <p class="contact-para"><span class="fa fa-map-marker"
                                            aria-hidden="true"></span><?php echo $profile->ORG_ADDRESS;?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 sub-one-left ab-right-cont pl-lg-5 mt-lg-0 mt-sm-5 mt-4">
                            <h6>About </h6>
                            <p><?php echo $profile->ORG_ABOUT;?>.</p>
                            <div class="columns-2">
                                <ul class="social">
                                    <li><a href="#facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
                                    </li>
                                    <li><a href="#linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
                                    </li>
                                    <li><a href="#twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
                                    </li>
                                    <li><a href="#google"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
                                    </li>
                                    <li><a href="#github"><span class="fa fa-github" aria-hidden="true"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright -->
        <div class="copyright-footer text-center">
            <div class="container">
                <div class="columns">
                    <p>@2021 Vhtechindia. All rights reserved.
                     </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- //copyright -->
    </footer>
    <!-- //footer -->

    <!-- Js scripts -->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-level-up" aria-hidden="true"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->

    <!-- common jquery plugin -->
    <script src="<?php echo base_url('websitecss/'); ?>assets/js/jquery-3.3.1.min.js"></script>
    <!-- //common jquery plugin -->

    <!-- banner slider -->
    <script src="<?php echo base_url('webassets/'); ?>js/owl.carousel.js"></script>
    <script>
        $(document).ready(function () {
            $('.owl-one').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    480: {
                        items: 1,
                        nav: false
                    },
                    667: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 1,
                        nav: false
                    }
                }
            })
        })
    </script>
    <!-- //banner slider -->

    <!-- counter for stats -->
    <script src="<?php echo base_url('websitecss/'); ?>assets/js/counter.js"></script>
    <!-- //counter for stats -->

    <!-- theme switch js (light and dark)-->
    <!--<script src="<?php echo base_url('websitecss/'); ?>assets/js/theme-change.js"></script>-->
    <script type="text/javascript" src="https://jainsanskriti.com/webassets/resources/fancybox/bc-jquery.fancybox.min.js"></script>
    <script>
        function autoType(elementClass, typingSpeed) {
            var thhis = $(elementClass);
            thhis.css({
                "position": "relative",
                "display": "inline-block"
            });
            thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
            thhis = thhis.find(".text-js");
            var text = thhis.text().trim().split('');
            var amntOfChars = text.length;
            var newString = "";
            thhis.text("|");
            setTimeout(function () {
                thhis.css("opacity", 1);
                thhis.prev().removeAttr("style");
                thhis.text("");
                for (var i = 0; i < amntOfChars; i++) {
                    (function (i, char) {
                        setTimeout(function () {
                            newString += char;
                            thhis.text(newString);
                        }, i * typingSpeed);
                    })(i + 1, text[i]);
                }
            }, 1500);
        }

        $(document).ready(function () {
            // Now to start autoTyping just call the autoType function with the 
            // class of outer div
            // The second paramter is the speed between each letter is typed.   
            autoType(".type-js", 200);
        });
    </script>
    <!-- //theme switch js (light and dark)-->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!--bootstrap-->
    <script src="<?php echo base_url('websitecss/'); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/web.js"></script>
    <!-- //bootstrap-->
    <!-- //Js scripts -->
</body>


<!-- Mirrored from vhtecs.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Sep 2021 11:30:47 GMT -->
</html>


















