    </div> 
<div> 
<div id="myModal" class="modal-image">
  <span class="close-image">&times;</span>
  <img class="modal-content-image" id="img01">
  <div id="caption"></div>
</div>
        <footer>
            <div class="container">
                <div class="footer-showroom">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 style="color: #000;font-family: 'Helvetica Neue';">Visit our showroom</h2>
                            <p style="color: #000;font-family: 'Helvetica Neue';">LOCATION: <span style="color: #000;font-family: 'Helvetica';" id="address"></span></p>
                            <!-- <p style="color: #000;font-family: 'Helvetica Neue';"><span id="storeopen"></span></p> -->
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2290.2640867277623!2d120.60011037159116!3d15.117116401403987!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdc131cb15dffd580!2sGenteel%20Home%20Furniture%20and%20Objects!5e0!3m2!1sen!2sph!4v1656837292016!5m2!1sen!2sph" height="400" style="width: 100%;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="contact-form-wrapper">
                                            <div class="row">
                                                 <div class="col-sm-12 text-center">
                                                    <span class="h4" style="color:#000;font-family: 'Helvetica Neue';">Contact us via form</span>
                                                 </div>
                                                  <div class="col-sm-12">
                                                      <div class="contact-form clearfix" style="margin-top: 10px;">
                                               <form class="form" data-link="Create_Email" enctype="multipart/form-data" accept-charset="utf-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input id="name" name="name" type="text" value="" class="form-control" placeholder="Your name" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input id="email" name="email" type="email" value="" class="form-control" placeholder="Your email" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input id="Subject" name="subject" type="text" value="" class="form-control" placeholder="Subject" autocomplete="off">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea id="comment" name="comment" class="form-control" placeholder="Your message" rows="10"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <button type="button" id="Create_Email" class="btn btn-clean-dark" >Send Message</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                </div>
                            </div> 
                        </div>

                     <!--    <div class="col-sm-4 text-center">
                            <a href="#" class="btn btn-clean"><span class="icon icon-map-marker"></span> Get directions</a>
                            <div class="call-us h4"><span class="icon icon-phone-handset"></span> <span id="mobile"></span></div>
                        </div> -->
                    </div>
                </div>

                <!--footer links-->
                <div class="footer-links">
                    <div class="row">
                    <!--  <div class="col-sm-4 col-md-2">
                            <h5>CONCIERGE</h5>
                            <ul>
                                <li><a href="<?php echo base_url()?>gh/app/contact">Contact Us</a></li>
                                <li><a href="<?php echo base_url()."gh/app/returns-exchange-policy";?>">Returns & Exchanges</a></li>
                                <li><a href="<?php echo base_url()."gh/app/shipping";?>">Shipping</a></li>
                                <li><a href="<?php echo base_url()."gh/app/privacy-policy";?>">Privacy Policy</a></li>
                                <li><a href="<?php echo base_url()."gh/app/terms-conditions";?>">Terms & Conditions</a></li>
                            </ul>
                        </div>  -->
                        <div class="col-sm-4 col-md-2">
                            <h5 style="color:#000">MY ACCOUNT</h5>
                            <ul>
<!--                                  <?php if(!$this->session->userdata('userId')){
                                    echo'<li><a href="'.base_url().'gh/app/registration">Create An Account</a></li>';
                                    echo '<li><a href="'.base_url().'gh/app/forgot-password" class="open-popup">Forgot Password</a></li>';
                                   }else{
                                    echo '<li><a href="'.base_url().'gh/app/account" class="open-popup">My Account</a></li>';
                                   }
                               ?>
 -->                                <a href="<?php echo base_url()."gh/app/service"?>" class="open-popup">Customer Service</a>
                            </ul>
                        </div> 
                      <!--    <div class="col-sm-12 col-md-6">
                            <h5>Sign up for our newsletter</h5>
                            <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                            <div class="form-group form-newsletter">
                                <input class="form-control" type="text" name="email" value="" placeholder="Email address">
                                <input type="submit" class="btn btn-clean btn-sm" value="Subscribe">
                            </div>
                        </div>  -->
                    </div>
                </div>
                <!--footer social-->
                <div class="footer-social">
                    <div class="row">
                        <div class="col-sm-6">
                            <p style="color: #000;font-family: 'Helvetica Neue';">©  GenteelHome (All Rights reserved)</p>
                        </div>
                        <div class="col-sm-6 links">
                            <ul>
                                <li><a href="https://www.facebook.com/GenteelHomePH" target="_blank" style="font-family: 'Helvetica Neue';">Facebook</a></li>
                                <li><a href="https://www.instagram.com/home_genteel/?hl=en"  target="_blank" style="font-family: 'Helvetica Neue';">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
        <script type='text/javascript'>
            var baseURL = "<?php echo base_url();?>";
        </script>
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <script src="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.js"  type='text/javascript'></script>
        <script src="<?php echo base_url(); ?>assets/plugins/custom/prismjs/prismjs.bundle.js"  type='text/javascript'></script>
        <script src="<?php echo base_url(); ?>assets_website/js/bundle.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="<?php echo base_url(); ?>assets_website/js/nav-script.js"></script>
        <script src="<?php echo base_url(); ?>assets_website/js/login-script.js"></script>
 <!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets_website/js/formscript.js"></script>
<!--         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" 
            integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" 
            crossorigin="anonymous"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"  type='text/javascript'></script>
        <script src="<?php echo base_url(); ?>assets_website/script.js"></script>
        <script src = "https://maps.googleapis.com/maps/api/js"></script>
     
    </body>
</html>
