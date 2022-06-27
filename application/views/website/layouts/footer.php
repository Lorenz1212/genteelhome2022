    
            </div> <!--/wrapper-->
        <div>        <!-- ================== Footer  ================== -->
<div id="myModal" class="modal-image">
  <span class="close-image">&times;</span>
  <img class="modal-content-image" id="img01">
  <div id="caption"></div>
</div>
        <footer>
            <div class="container">
                <!--footer showroom-->
                <div class="footer-showroom">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Visit our showroom</h2>
                            <p>LOCATION: <span id="address"></span></p>
                            <p><span id="storeopen"></span></p>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a href="#" class="btn btn-clean"><span class="icon icon-map-marker"></span> Get directions</a>
                            <div class="call-us h4"><span class="icon icon-phone-handset"></span> <span id="mobile"></span></div>
                        </div>
                    </div>
                </div>

                <!--footer links-->
                <div class="footer-links">
                    <div class="row">
                        <div class="col-sm-4 col-md-2">
                            <h5>ABOUT</h5>
                            <ul>
                                <li><a href="<?php echo base_url()."gh/app/about";?>">About Us</a></li>
                                <li><a href="<?php echo base_url()."gh/app/interior";?>">Interiors & Architecture</a></li>
                             <!--    <li><a href="#">Partnership & Collaboration</a></li>
                                <li><a href="#">Press</a></li> -->
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <h5>CONCIERGE</h5>
                            <ul>
                                <li><a href="<?php echo base_url()?>gh/app/contact">Contact Us</a></li>
                                <li><a href="<?php echo base_url()."gh/app/returns-exchange-policy";?>">Returns & Exchanges</a></li>
                                <li><a href="<?php echo base_url()."gh/app/shipping";?>">Shipping</a></li>
                                <li><a href="<?php echo base_url()."gh/app/privacy-policy";?>">Privacy Policy</a></li>
                                <li><a href="<?php echo base_url()."gh/app/terms-conditions";?>">Terms & Conditions</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <h5>MY ACCOUNT</h5>
                            <ul>
                                 <?php if(!$this->session->userdata('userId')){
                                    echo'<li><a href="'.base_url().'gh/app/registration">Create An Account</a></li>';
                                    echo '<li><a href="'.base_url().'gh/app/forgot-password" class="open-popup">Forgot Password</a></li>';
                                   }else{
                                    echo '<li><a href="'.base_url().'gh/app/account" class="open-popup">My Account</a></li>';
                                   }
                               ?>
                                <a href="<?php echo base_url()."gh/app/service"?>" class="open-popup">Customer Service</a>
                            </ul>
                        </div>
                        <!-- <div class="col-sm-12 col-md-6">
                            <h5>Sign up for our newsletter</h5>
                            <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                            <div class="form-group form-newsletter">
                                <input class="form-control" type="text" name="email" value="" placeholder="Email address">
                                <input type="submit" class="btn btn-clean btn-sm" value="Subscribe">
                            </div>
                        </div> -->
                    </div>
                </div>
                <!--footer social-->
                <div class="footer-social">
                    <div class="row">
                       <!--  <div class="col-sm-6">
                             <a>CREATED BY: LORENZ CABREROS & RICHARD ORENDAIN</a>
                        </div> -->
                        <div class="col-sm-6 links">
                            <ul>
                                <li><a href="https://www.facebook.com/GenteelHomePH" target="_blank"><i class="fa fa-facebook"></i></a></li>
<!--                                 <li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
                                <li><a href="finance@genteelhome.com"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"  target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com/home_genteel/?hl=en"  target="_blank"><i class="fa fa-instagram"></i></a></li>
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
    
    <script src="<?php echo base_url(); ?>assets_website/js/my-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_website/js/login-script.js"></script>
    <script src="<?php echo base_url(); ?>assets_website/js/formscript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" 
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" 
        crossorigin="anonymous"></script>



    <script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"  type='text/javascript'></script>
     <script src="<?php echo base_url(); ?>assets_website/script.js"></script>
</body>
<!-- Mirrored from www.elathemes.com/themes/mobel/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Sep 2021 15:33:39 GMT -->
</html>
