<div id="kt_content" data-table="data-cart">   
<div class="form"  data-link="Update_Cart_Process"></div>
  <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(<?php echo base_url()?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container text-center">
                    <h2 class="h2 title">My Cart</h2>
                </div>
            </header>
        </section>

        <!-- ========================  Checkout ======================== -->
   
    
         <section class="checkout">

            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Checkout - Step 1</h3>
                </header>

                <!-- ========================  Cart wrapper ======================== -->

                <div class="cart-wrapper">
                     <!--cart header -->


                    <!--cart items-->


                    <div class="panel panel-default" id="tables">
                            <div class="panel-body">
                                <div id="cart"></div>
                            </div>
                    </div>

                <!-- ========================  Cart navigation ======================== -->
                <div class="clearfix">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="<?php echo base_url()?>gh/app/product-list/<?php echo base64_encode('all')?>/<?php echo base64_encode('dasxasdas2342')?> " class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Shop more</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="button" class="btn btn-main" id="Update_Cart_Process"><span class="icon icon-cart"></span> Check Out</button>
                        </div>
                    </div>
                </div>

            </div> <!--/container-->
  </section>
