<div id="kt_content" data-table="data-deposit"></div>
        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">Form</span></h2>
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
                                            <div class="h4">Payment Deposit Form</div>
                                            <hr>
                                     	<form class="form" data-link="Create_Deposit" enctype="multipart/form-data" accept-charset="utf-8">
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
                                                        <input type="text" id="order_no" name="order_no" class="form-control" required="">
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <label>Deposite Date</label>
                                                        <input type="date" id="date_deposite" name="date_deposite" class="form-control"  required="">
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <label>Amount Deposite</label>
                                                        <input type="text" name="amount" id="amount" class="form-control" required="">
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label for="deliveryId1">Deposited/ Transfered Bank</label>
	                                                    <select type="text" name="bank" class="form-control" required="">
	                                                        <option value="" disabled="" selected="">SELECT OPTION</option>
	                                                        <option value="BPI">BPI</option>
	                                                        <option value="BDO">BDO</option>
	                                                        <option value="PSBANK">PSBANK</option>
	                                                        <option value="METRO BANK">METRO BANK</option>
	                                                        <option value="CITI BANK">CITI BANK</option>
	                                                        <option value="CHINA BANK">CHINA BANK</option>
	                                                        <option value="PAYMAYA">PAYMAYA</option>
	                                                        <option value="GCASH">GCASH</option>
	                                                    </select>
                                                 </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label>Upload Deposit Slip*</label>
                                                    <input type="file" id="image" name="image" class="form-control" required="">
                                                 </div>
                                            </div>
                                                <div class="col-md-12">
                                                    <button type="button" id="Create_Deposit" class="btn btn-clean-dark btn-block">SUBMIT</button>
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