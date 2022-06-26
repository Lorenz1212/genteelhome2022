<div id="kt_content" data-table="data-product-details"></div>
<div class="form"  data-link="Create_Product_Cart"></div>
        <!-- ========================  Product ======================== -->
   <div class="wrapper">

        <!-- ========================  Main header ======================== -->

        <section class="main-header" style="background-image:url(<?php echo base_url() ?>assets_website/images/gallery-2.jpg)">
            <header>
                <div class="container">
                    <h1 class="h2 title">Product Details  </h1>
                    <ol class="breadcrumb breadcrumb-inverted" id="btn_cat"></ol>
                </div>
            </header>
        </section>

        <section class="product">
            <div class="main">
                <div class="container">
                    <div class="row product-flex">

                        <!-- product flex is used only for mobile order -->
                        <!-- on mobile 'product-flex-info' goes bellow gallery 'product-flex-gallery' -->

                        <div class="col-md-4 col-sm-12 product-flex-info">
                            <div class="clearfix">

                                <!-- === product-title === -->

                                <h1 class="title"><span class="title"></span></h1>

                                <div class="clearfix">

                                    <!-- === price wrapper === -->

                                    <div class="price">
                                        <span class="h3 pallet-price" ></span>
                                    </div>
                                    <hr />


                                    <!-- === info-box === -->

                                    <div class="info-box">
                                        <strong>Color</strong>
                                        <span class="pallet-name"></span>
                                    </div>

                                    <!-- === info-box === -->

                                    <div class="info-box">
                                         <strong>Availability</strong>
                                         <span class="product-availability"></span>
                                    </div>

                                    <hr />

                                    <div class="info-box info-box-addto">
                                        <span><strong>Collection</strong></span>
                                        <?php if(!$this->session->userdata('userId')){
                                                echo '<span><i id="alert_collection"><i class="fa fa-star-o"></i> Add to Collection</i></span>';
                                              }else{
                                                echo '<span>
                                                        <i class="add add_collection"><i class="fa fa-star-o"></i> Add to Collection</i>
                                                        <i class="added add_collection"><i class="fa fa-star"></i> Remove from Collection</i>
                                                    </span>';
                                           }
                                       ?>
                                    </div>
                                   
                                    <hr />

                                    <!-- === info-box === -->

                                    <div class="info-box">
                                        <span><strong>In Stock</strong></span>
                                        <div class="product-on-stocks clearfix"></div>
                                    </div>

                                    <!-- === info-box === -->

                                    <div class="info-box">
                                        <span><strong>Pre Order</strong></span>
                                       <div class="product-pre-stocks clearfix"></div>
                                    </div>

                                    <div class="info-box">
                                    	<div class="row">
                                    		<div class="col-md-4 col-sm-4 col-xs-4">
                                    			 <input type="number" min="1" value="1" name="qty" id="qty" class="form-control" placeholder="0"  />
                                    		</div>
                                    		<div class="col-md-4 col-sm-4">
                                    			 <?php if(!$this->session->userdata('userId')){
                                                           echo '<button type="button" title="Add to Cart" id="alert_cart" value="Add to Cart" class="btn btn-clean-dark">Add to Cart</button>';
                                                       }else{
                                                            echo '<button type="button" title="Add to Cart"  value="Add to Cart" class="btn btn-clean-dark add_cart">Add to Cart</button>';
                                                       }
                                                ?>
                                    		</div>
                                    	</div>
                                    </div>
                                   

                                </div> <!--/clearfix-->
                            </div> <!--/product-info-wrapper-->
                        </div> <!--/col-md-4-->
                        <!-- === product item gallery === -->

                        <div class="col-md-8 col-sm-12 product-flex-gallery" style="padding-bottom: 50px;">

                            <!-- === add to cart === -->
                           
                            <!-- === product gallery === -->
                            <div class="modal_image1">
                               <!--  <a id="aimage1"><img id="image1" alt="" height="500" /></a>
                                <a id="aimage2"><img id="image2" alt="" height="500" /></a>
                                <a id="aimage3"><img id="image3" alt="" height="500" /></a>
                                <a id="aimage4"><img id="image4" alt="" height="500" /></a>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>

            <!-- === product-info === -->

            <div class="info">
                <div class="container">
                    <div class="row">


                        <div class="col-md-8">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#designer" aria-controls="designer" role="tab" data-toggle="tab">
                                        <i class="icon icon-picture"></i>
                                        <span>Gallery</span>
                                    </a>
                                </li>
                                <!-- <li role="presentation">
                                    <a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">
                                        <i class="icon icon-book"></i>
                                        <span>Specification</span>
                                    </a>
                                </li> -->
                                <li role="presentation">
                                    <a href="javascript:;" class="tearsheet" target="_blank">
                                        <i class="icon icon-book"></i>
                                        <span>Tearsheet</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- === tab-panes === -->

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="designer">
                                    <div class="content">
                                        <!-- === designer collection title === -->
                                        <h3>Photo of <span class="title"></span></h3>

                                        <div class="products">
                                            <div class="row view-gallery" >

                                            </div> <!--/row-->
                                        </div> <!--/products-->
                                    </div> <!--/content-->
                                </div> <!--/tab-pane-->
                                <!-- ============ tab #2 ============ -->

                                <div role="tabpanel" class="tab-pane" id="specification">
                                    <div class="content">
                                        <!-- === designer collection title === -->
                                        <h3>Specification of Item</h3>
                                        <div class="products">
                                            <div class="row" >
                                            </div> <!--/row-->
                                        </div> <!--/products-->
                                    </div> <!--/content-->
                                </div> <!--/tab-pane-->
                                <!-- ============ tab #2 ============ -->
                           

                                        </div> <!--/row-->
                                    </div> <!--/content-->
                                </div> <!--/tab-pane-->
                            </div> <!--/tab-content-->
                        </div>
                    </div> <!--/row-->
                </div> <!--/container-->
            </div> <!--/info-->
        </section>
