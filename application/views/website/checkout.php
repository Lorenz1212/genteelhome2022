<div id="kt_content" data-table="data-checkout">   
<div class="form"  data-link="Update_Cart_Checkout"></div> 
  <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(<?php echo base_url() ?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">Check Out</h2>
                </div>
            </header>
        </section>

        <!-- ========================  Checkout ======================== -->

        <div class="step-wrapper">
            <div class="container">

                <div class="stepper">
                    <ul class="row">
                        <li class="col-md-4 active" id="cart_active">
                            <span data-text="Cart items"></span>
                        </li>
                        <li class="col-md-4" id="delivery_active">
                            <span data-text="Delivery"></span>
                        </li>
                        <li class="col-md-4" id="payment_active">
                            <span data-text="Receipt"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <section class="checkout">

            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Checkout - Step 1</h3>
                </header>


                 <!-- ========================  Delivery ======================== -->

                <div class="cart-wrapper" id="delivery_hide" style="display:none;">

                    <div class="note-block">
                        <div class="row">

                            <!-- === left content === -->

                            <div class="col-md-6">

                                <!-- === login-wrapper === -->

                                <div class="login-wrapper">

                                    <div class="white-block">

                                        <!--signup-->

                                        <div class="login-block login-block-signup">

                                            <div class="h4">Billing Address </div>

                                            <hr>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="b_address" value="" class="form-control" placeholder="Bld/Blk & Lot/Street/Subdivision/Barangay" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="b_city" class="form-control" placeholder="City: *">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <input type="text" name="b_province" class="form-control" placeholder="Province: *">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="h4">Shipping Address</div>
                                            <span class="checkbox"><input type="checkbox" id="checkcopy" ><label for="checkcopy">Copy Billing Address</label></span>

                                            <hr>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="s_address" value="" class="form-control" placeholder="Bld/Blk & Lot/Street/Subdivision/Barangay" required="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="s_city" class="form-control" placeholder="City: *">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <input type="text" name="s_province" class="form-control" placeholder="Province: *">
                                                    </div>
                                                </div>

                                            </div>

                                        </div> <!--/signup-->
                                    </div>
                                </div> <!--/login-wrapper-->
                            </div> <!--/col-md-6-->

                            <!-- === right content === -->

                            <div class="col-md-6">

                                <div class="white-block">
                                   <!--  <div class="form-group">
                                         <label for="deliveryId1">Region</label>
                                        <select type="text" id="region" name="region" class="form-control">
                                            <option value="" disabled="" selected="">SELECT REGION</option>
                                        </select>
                                     </div> -->
                                    <hr>
                                        <ul>
                                       <!--      <li>Shipping Fee: <span id="shipping"></span></li> -->
                                            <li>Shipping Arrival : 15 - 30 days</li>
                                        </ul>
                                    <hr>

                                    <div class="h4">Choose delivery</div>

                                    <hr>

                                    <span class="checkbox">
                                        <input type="radio" id="deliveryId1" name="deliveryOption" value="delivery" checked="">
                                        <label for="deliveryId1">Delivery</label>
                                    </span>

                                    <span class="checkbox">
                                        <input type="radio" id="deliveryId3" name="deliveryOption" value="pick-up">
                                        <label for="deliveryId3">Pick up in the store</label>
                                    </span>

                                    <hr>

                                    <div class="clearfix">
                                        <p>A frequently overlooked, powerful fulfillment option is offering local pick-up. If you have a physical location and can allow your customers to forgo paying shipping costs altogether, you should!</p>                            <p><strong>Benefits:</strong></p>
                                        <ul>
                                            <li>Avoid both shipping and packaging costs</li>
                                            <li>Develop a face-to-face relationship with your customers</li>
                                            <li>Potential for additional purchases while customers are at your store</li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- ========================  Payment ======================== -->

                <div class="cart-wrapper" id="payment_hide" style="display:none;">
                    <div class="note-block">

                        <div class="row">
                            <!-- === left content === -->

                            <div class="col-md-6">

                                <div class="white-block">

                                    <div class="h4">Billing info</div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Address</strong> <br>
                                                <span id="b_address"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>City</strong><br>
                                                <span id="b_city"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Province</strong><br>
                                                <span id="b_province"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="h4">Shipping info</div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>Address</strong> <br>
                                                <span id="s_address"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>City</strong><br>
                                                <span id="s_city"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Province</strong><br>
                                                <span id="s_province"></span>
                                            </div>
                                        </div>

                                    </div>

                                </div> <!--/col-md-6-->

                            </div>

                            <!-- === right content === -->

                            <div class="col-md-6">
                                <div class="white-block">

                                    <div class="h4">Order details</div>

                                    <hr>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order no.</strong> <br>
                                                <span id="order_no"></span>
                                            </div>
                                        </div>

                                 <!--        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Shipping Fee</strong> <br>
                                                <span id="region_name"></span></br>
                                                <span id="shipping_fee"></span>
                                            </div>
                                        </div>
 -->


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order date</strong> <br>
                                                <span id="order_date"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Shipping arrival</strong> <br>
                                                <span>15 - 30 days</span>
                                            </div>
                                        </div>

                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- ========================  Cart wrapper ======================== -->

                <div class="cart-wrapper" id="cart_hide">
                    <!--cart header -->

                    <!--cart items-->

                   <div class="panel panel-default" id="tables">
                            <div class="panel-body">
                                <table class="table table-striped table-condensed table-hover" id="table-cart-list">
                                <thead>
                                    <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th style="text-align:center;">Qty</th>
                                    <th style="text-align:center;">Price</th>
                                    <th style="text-align:center;">Remove</th>
                                     </tr>
                                     </thead><tbody>
                                     </tbody>
                                 </table>
                            </div>
                    </div>

                    <!--cart prices -->

                    <div class="clearfix">
                        
                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                               
                            </div>
                            <div>
                                <strong>GRAND TOTAL : </strong>
                                <span id="subtotal"></span>
                            </div>
                        </div>
                        <!--  <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Discount</strong>
                            </div>
                            <div>
                                <span id="discount">0%</span>
                            </div>
                        </div> -->
                    </div>

                    <!--cart final price -->

                    <!-- <div class="clearfix">
                        <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                            <div>
                                <span class="checkbox" id="coupon">
                                    <a  href="#productid1" id="btn_modal" class="mfp-open" style="display:none;"></a>
                                    <input type="checkbox" id="couponCodeID">
                                    <label for="couponCodeID">Promo code</label>
                                    <input type="text" class="form-control form-coupon" id="coupons" data-promo="0" value="" placeholder="Enter your coupon code" style="display: none;" readonly>
                                </span>
                            </div>
                            <div>
                                <div class="h2 title"><span id="total"></span></div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <!-- ========================  Cart navigation ======================== -->

                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" id="back" class="btn btn-clean-dark" data-back="delivery"><span class="icon icon-chevron-left"></span><span id="back_name" >Back</span></button>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="button" id="next" data-action="delivery" class="btn btn-main">Next</button>
                        </div>
                    </div>
                </div>

            </div> <!--/container-->

                <div class="popup-main mfp-hide" id="productid1">
                                      <!-- === product popup === -->

                    <div class="product">
                            
                        <!-- === product-popup-info === -->

                        <div class="popup-content">
                            <div class="product-info-wrapper">
                                <div class="row">
                                    <!-- === left-column === -->
                                    <div class="col-sm-12">
                                       <div id="coupon_table"></div>
                                    </div>
                                    <!-- === right-column === -->
                                </div><!--/row-->
                            </div> <!--/product-info-wrapper-->
                        </div><!--/popup-content-->
                        <!-- === product-popup-footer === -->

                    </div> <!--/product-->
                </div> <!--popup-main-->

        </section>