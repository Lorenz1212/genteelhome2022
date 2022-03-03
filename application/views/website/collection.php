<div id="kt_content" data-table="data-product-collection"></div>
<!-- ======================== Main header ======================== -->
<section class="main-header" style="background-image:url(<?php echo base_url() ?>assets_website/images/gallery-3.jpg)">
    <header>
        <div class="container">
            <h1 class="h2 title">MY COLLECTIONS</h1>
            <ol class="breadcrumb breadcrumb-inverted">

            </ol>
        </div>
    </header>
</section>
 <!-- ========================  Icons slider ======================== -->
<section class="owl-icons-wrapper">
    <!-- === header === -->
    <header class="hidden">
        <h2>Product categories</h2>
    </header>
</section>
 <!-- === product filters === -->

        <!-- ======================== Products ======================== -->

        <section class="products">

            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Product category with topbar</h3>
                </header>

                <div class="row">

                    <!-- === product-items === -->

                    <div class="col-md-12 col-xs-12">

                        <div id="products" class="row" style="position: relative; height: 299.987px;">
                            <a  href="#productid1" id="btn_modal" class="mfp-open" style="display:none;"></a>
                            <div class="product_list alignwides wp-block-covers"></div>
                        </div><!--/row-->


                    </div> <!--/product items-->


                </div><!--/row-->
              <?php $this->load->view('website/product_modal.php'); ?>

            </div><!--/container-->
        </section>