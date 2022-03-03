<div id="kt_content" data-table="data-forgotpassword">
        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">Forgot Password</span></h2>
                </div>
            </header>
        </section>
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
                               <form class="form" enctype="multipart/form-data" accept-charset="utf-8">
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
                                            <button type="button" class="btn btn-clean-dark btn-block verify_code">Submit</button>
                                        </div>
                                    </div>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            
            <div class="container card-center">
                <div class="cart-wrapper">
                        <div class="row">
                            <!-- === left content === -->
                            <div class="col-md-12" >
                                <!-- === login-wrapper === -->
                                <div class="login-wrapper">
                                    <div class="white-block">
                                        <!--signup-->
                                        <div class="login-block login-block-signup">
                                            <div class="h4 col-lg-10 text-data">Enter Your Email Address</div>
                                            <div class="row">
                                               <div class="col-md-12">
                                                   <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <input type="email" class="form-control email" name="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                	<hr>
                                                    <button type="button" class="btn btn-clean-dark btn-block btn_email">Send Code</button>
                                                </div>
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
