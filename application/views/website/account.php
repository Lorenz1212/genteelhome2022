<div id="kt_content" data-table="data-account">
<div class="form"  data-link="Update_Account"></div> 
 <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title"><span id="title">My Account</span></h2>
                </div>
            </header>
        </section>



        <!-- ========================  Checkout ======================== -->

        <section class="checkout">
            <div class="container" >


                <!-- ========================  Delivery ======================== -->

                <div class="cart-wrapper" >

                
                        <div class="row">

                            <!-- === left content === -->

                            <div class="col-md-12">

                                <!-- === login-wrapper === -->

                                <div class="login-wrapper">

                                    <div class="white-block">
                                        <!--signin-->
                                        <div class="login-block login-block-signin">
                                            <div class="h4">My Password <Ma href="javascript:void(0);" id="btn_registration" data-name="Registration" class="btn btn-clean-dark btn-xs btn-register pull-right">My Profile</a></div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="password"  id="password" name="password" class="form-control" placeholder="New Password" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" id="con_password" name="con_password" class="form-control" placeholder="Confirmation Password" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" id="Update_Account_Password" class="btn btn-clean-dark btn-block">SAVE</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                            
                                        </div> <!--/signin-->
                                        <!--signup-->
                                        <div class="login-block login-block-signup">
                                            <div class="h4">Profile<a href="javascript:void(0);" id="btn_login" data-name="Sign In" class="btn btn-clean-dark btn-xs btn-login pull-right">My Password</a></div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Firstname</label>
                                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name: *" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                         <label>Lastname</label>
                                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name: *" required="">
                                                    </div>
                                                </div>
                                                 <div class="col-md-4">
                                                    <div class="form-group">
                                                         <label>Mobile No.</label>
                                                        <input type="text" id="mobile" name="mobile" class="form-control" required="">
                                                    </div>
                                                </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" id="address" name="address" class="form-control" placeholder="BlK Lot/Street/Village/Barangay:" required="">
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                         <label>City</label>
                                                        <input type="text" id="city" name="city" class="form-control" placeholder="City: *" required="">
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <label>Province</label>
                                                        <input type="text" id="province" name="province" class="form-control" placeholder="Province: *" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                     <label for="deliveryId1">Region</label>
                                                    <select type="text" id="region" name="region" class="form-control" required="">
                                                        <option value="" disabled="" selected="">SELECT REGION</option>
                                                    </select>
                                                 </div>
                                            </div>


                                                <div class="col-md-12">
                                                    <button type="button" id="Update_Account_Profile" class="btn btn-clean-dark btn-block">SAVE</button>
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