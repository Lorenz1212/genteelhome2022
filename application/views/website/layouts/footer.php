    
            </div> <!--/wrapper-->
        <div>        <!-- ================== Footer  ================== -->
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
                        <div class="col-sm-6">
                             <a>CREATED BY: LORENZ CABREROS & RICHARD ORENDAIN</a>
                        </div>
                        <div class="col-sm-6 links">
                            <ul>
                                <li><a href="https://www.facebook.com/GenteelHomePH" target="_blank"><i class="fa fa-facebook"></i></a></li>
<!--                                 <li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
                                <li><a href="finance@genteelhome.com"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"  target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com/home_genteel/"  target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<!-- <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-105330313-1"></script> -->
<!-- <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-105330313-1');
</script> -->
</div>
    <script type='text/javascript'>
        var baseURL = "<?php echo base_url();?>";
    </script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets_website/js/bundle.js"></script>
    <!--JS bundle -->
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
</body>
<!-- Mirrored from www.elathemes.com/themes/mobel/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Sep 2021 15:33:39 GMT -->
</html>
