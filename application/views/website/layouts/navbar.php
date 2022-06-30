<body>
        <nav class="navbar-fixed">
            <div class="container">
                <div class="navigation navigation-top">
                    <ul>
                        <li><a href="https://www.facebook.com/GenteelHomePH" target="_blank"><i class="fa fa-facebook"></i></a></li>
        				<!-- <li><a href="finance@genteelhome.com"  target="_blank"><i class="fa fa-google-plus"></i></a></li> -->
				        <li><a href="https://www.instagram.com/home_genteel/?hl=en"  target="_blank"><i class="fa fa-instagram"></i></a></li>
                       <!--  <li><a id="youtube"  target="_blank"><i class="fa fa-youtube"></i></a></li> -->
                        <li><a href="javascript:void(0);" class="open-login"><i class="icon icon-user"></i></a></li>
                              <?php if(!$this->session->userdata('userId')){
                               }else{
                                    echo '<li><a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span class="count_cart"></span></a></li>';
                               }
                           ?>
                    </ul>
                </div>
                <div class="navigation navigation-main">
                    <!-- Setup your logo here-->
                    <a href="javascript:;" class="logo"><img src="<?php echo base_url('assets/images/logo/logo2.png') ?>" alt=""  style=""></a>
                    <!-- Mobile toggle menu -->
                    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>

                    <!-- Convertible menu (mobile/desktop)-->

                    <div class="floating-menu">

                        <!-- Mobile toggle menu trigger-->

                        <div class="close-menu-wrapper">
                            <span class="close-menu"><i class="icon icon-cross"></i></span>
                        </div>

                        <ul>
                            <li><a href="<?php echo base_url()."gh/app/index";?>">Home</a></li>
                             <li>
                                <a href="#">FURNITURE <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                                <div class="navbar-dropdown">
                                    <div class="navbar-box">
                                        <div class="box-2">
                                            <div class="box clearfix">
                                                <div class="row" id="category_nav">
                                                </div>
                                            </div> <!--/box-->
                                        </div> <!--/box-2-->
                                    </div> <!--/navbar-box-->
                                </div> <!--/navbar-dropdown-->
                            </li>
                            <li><a href="<?php echo base_url()."gh/app/interior";?>">INTERIOR DESIGN</a></li>
                            <li><a href="<?php echo base_url()."gh/app/blogs";?>">BLOGS</a></li>
                            <li><a href="<?php echo base_url()."gh/app/contact";?>">CONTACT</a></li>
                            <!-- Multi-content dropdown -->
                            <!-- <li>
                                <a >Features <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                                <div class="navbar-dropdown navbar-dropdown-single">
                                    <div class="navbar-box">


                                        <div class="box-2">
                                            <div class="box clearfix">
                                                        <ul>
                                                            <li class="label">Features</li>
                                                            <li><a href="<?php echo base_url()."gh/app/new-arrival";?>">New Arrivals</a></li>
                                                            <li><a href="<?php echo base_url()."gh/app/in-stocks";?>">In Stocks</a></li>
                                                        </ul>
                                            </div>
                                        </div> 
                                    </div> 
                                </div> 
                            </li>-->
                            <li><a href="<?php echo base_url()."gh/app/about";?>">ABOUT</a></li>
                        </ul>
                    </div> <!--/floating-menu-->
                </div> <!--/navigation-main-->


                <!-- ==========  Login wrapper ========== -->

                      <!-- ==========  Login wrapper ========== -->
               <?php if(!$this->session->userdata('userId')){
                      echo '<div class="login-wrapper">
                            <div class="h4">Sign in</div>
                            <div class="form-group">
                                <input type="email" class="form-control email1" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control password1" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <a href="'.base_url().'gh/app/forgot-password" class="open-popup">Forgot password?</a>
                                <a href="'.base_url().'gh/app/registration" class="open-popup">Don t have an account?</a>
                            </div>
                            <button type="click" id="kt_signin" class="btn btn-block btn-clean-dark">Login</button>
                         </div>';
                   }else{
                        echo '<div class="login-wrapper">
                            <div class="h4">'.$this->session->userdata('name').'</div>
                            <div class="form-group">
                                <a href="'.base_url().'gh/app/account" class="open-popup">My Account</a>
                                <a href="'.base_url().'gh/app/cart" class="open-popup">My Cart</a>
                                <a href="'.base_url().'gh/app/collection" class="open-popup">My Collection</a>
                                <a href="'.base_url().'gh/app/checkout" class="open-popup">My Check Out</a>
                                <a href="'.base_url().'gh/app/payment-deposit" class="open-popup">Payment Deposit Form</a>
                                <a href="'.base_url().'gh/app/service" class="open-popup">Customer Service</a>
                            </div>
                            <a type="click" href="'.base_url().'gh/app_logout" class="btn btn-block btn-clean-dark">Logout</a>
                         </div>';
                   }
               ?>

                <!-- ==========  Cart wrapper ========== -->

                <div class="cart-wrapper">
                    <div class="checkout">
                        <div class="clearfix">

                            <!--cart item-->

                            <div class="row">
                                <table class="table table-bordered" id="product_table">
                                 
                                </table>
                            </div>

                            <hr>



                            <!--cart navigation -->

                             <div class="cart-block-buttons clearfix">
                                <div class="row">
                                    <div class="col-xs-6">
                                       <!--  <a href="products-grid.html" class="btn btn-clean-dark">Continue shopping</a> -->
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <a href="<?php echo base_url() ?>gh/app/cart" class="btn btn-clean-dark"><span class="icon icon-cart"></span> View Cart</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!--/checkout-->
                </div> <!--/cart-wrapper-->
            </div> <!--/container-->
        </nav>
    </div>
<div class="scroll-top"><i class="icon icon-chevron-up"></i></div></div>
