<div id="kt_content" data-table="data-registration">
 <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">Registration</span></h2>
                </div>
            </header>
        </section>
        <!-- ========================  Checkout ======================== -->
        <section class="checkout">
             <!-- Modal-->
            <div class="modal fade" id="exampleModal" tabindex="-1" style="padding-top:300px" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                     <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Enter Verification Code</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                     </div>
                                    <div class="modal-body">
                                       <form enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="row">
                                                <div class="col-md-12">
                                                      <div class="form-group">
                                                           <div class="col-lg-12">
                                                               <input type="text" class="form-control" style="text-align: center;" data-code="" name="code" placeholder="Enter Verification Code">
                                                           </div>
                                                       </div>
                                                   </div>
                                                    <div class="col-md-12">
                                                    <hr>
                                                    <button type="button" class="btn btn-clean-dark btn-block kt_signup">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                     </div>
                                </div>
                            </div>
                        </div>
            <div class="container card-center">
                <!-- ========================  Delivery ======================== -->
                <div class="cart-wrapper">
                        <div class="row" >
                            <!-- === left content === -->
                            <div class="col-md-12" >

                                <!-- === login-wrapper === -->

                                <div class="login-wrapper">

                                    <div class="white-block">

                                        <!--signin-->
                                        <div class="login-block login-block-signin">
                                            <div class="h4">Sign in <a href="javascript:void(0);" id="btn_registration" data-name="Registration" class="btn btn-clean-dark btn-xs btn-register pull-right">create an account</a></div>
                                            <hr>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="email"  id="email" class="form-control" placeholder="Email" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" id="password" class="form-control" placeholder="Password" required="">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="checkBoxId3">
                                                        <label for="checkBoxId3">Remember me</label>
                                                    </span>
                                                </div>

                                                <div class="col-xs-6 text-right">
                                                    <button type="button" id="kt_signin1" class="btn btn-clean-dark">Login</button>
                                                </div>
                                            </div>
                                        </div> <!--/signin-->
                                        <!--signup-->

                                        <div class="login-block login-block-signup">

                                            <div class="h4">Register now <a href="javascript:void(0);" id="btn_login" data-name="Sign In" class="btn btn-clean-dark btn-xs btn-login pull-right">Log in</a></div>

                                            <hr>
                                            <form id="registration-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" id="firstname" class="form-control" name="firstname" placeholder="First name: *" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Last name: *" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <input type="email" id="email" name="email" class="form-control email" name="email" placeholder="Email Address:" required=""><span class="message_email"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <input type="email" id="confirm_email" class="form-control" placeholder="Confirm Email Address:" required=""><span class="confirm_email"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="password" id="password" name="password" class="form-control password" placeholder="Password" required=""><span class="password_message"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required=""><span class="confirm_password_message"></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <hr>
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="checkBoxId1">
                                                        <label for="checkBoxId1">I have read and accepted the terms, as well as read and understood our terms of <a target="_blank" href="<?php echo base_url()."gh/app/terms-conditions";?>">business contidions</a></label>
                                                    </span>
                                                    <hr>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-clean-dark btn-block kt_signup">Create account</button>
                                                </div>
                                                </form>
                                            </div>
                                    </div> <!--/signup-->
                                </div>
                            </div> <!--/login-wrapper-->
                        </div> <!--/col-md-6-->
                        <!-- === right content === -->
                    </div>
                </div>
            </div>
        </div> <!--/container-->
 </section>