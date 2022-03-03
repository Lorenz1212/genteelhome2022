<div id="kt_content" data-table="data-forgotpassword">
        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">New Password</span></h2>
                </div>
            </header>
        </section>
<section class="checkout">
    <!-- Modal-->
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
                                            <div class="h4 col-lg-10 text-data">Enter Your New Password</div>
                                          <form class="form" data-link="Newpassword" enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="row">
	                                               <div class="col-md-12">
	                                                   <div class="form-group">
	                                                          <input type="password" class="form-control password" name="password" placeholder="New Password">
	                                                    </div>
	                                                </div>
	                                            </div>
                                              <div class="row">
                                                <div class="col-md-12">
                                                   <div class="form-group">
                                                   	<?php 
                                                   		$last = $this->uri->total_segments();
														$record_num = $this->uri->segment($last);
                                                   	?>
                                                          <input type="password" class="form-control" name="con_password" data-code="<?php echo $record_num ?>" placeholder="Confirmation Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                	<hr>
                                                    <button type="button" class="btn btn-clean-dark btn-block new_password">Submit</button>
                                                </div>
                                            </div>
                                    	</form>
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
