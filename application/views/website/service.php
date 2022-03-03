<div id="kt_content" data-table="data-deposit"></div>
        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">Customer Service</span></h2>
                </div>
            </header>
        </section>
        <section class="checkout">
            <div class="container" >
                <div class="cart-wrapper" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-wrapper">
                                	  <div class="white-block">
                                        <div class="login-block login-block-signup">
                                            <div class="h4">Fill Up the Form for your Item Concern</div>
                                            <hr>
                                     	 <form class="form" data-link="Create_Service" enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name: *" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label>Lastname</label>
                                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name: *" required="">
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label>Email Address</label>
                                                        <input type="email" id="email" name="email" class="form-control" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label>Mobile Number</label>
                                                        <input type="text" id="mobile" name="mobile" class="form-control" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                         <label>Tracking Number</label>
                                                        <input type="text" id="order_no" name="order_no" class="form-control" required="" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                         <label>Serial Number of Item</label>
                                                        <input type="text" id="production_no" name="production_no" class="form-control" required="" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                         <label>Detailed Explanation of Service Request</label>
                                                       <textarea id="comment" name="comment" class="form-control" placeholder="Your message" rows="10"></textarea>
                                                    </div>
                                                </div>
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                 <label>Picture of your Receipt*</label>
	                                                <input type="file" id="receipt" name="receipt" class="form-control" required="">
	                                             </div>
	                                        </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Picture of item to be services*</label>
                                                    <input type="file" id="service" name="service" class="form-control" required="">
                                                 </div>
                                            </div>
                                                <div class="col-md-12">
                                                    <button type="button" id="Create_Service" class="btn btn-clean-dark btn-block">SUBMIT</button>
                                                </div>
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
        </section>