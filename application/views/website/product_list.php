<div id="kt_content" data-table="data-product-list">
<!-- ======================== Main header ======================== -->
<section class="main-header">
    <header>
        <div class="container">
            <h1 class="h2 title">Shop</h1>
            <ol class="breadcrumb breadcrumb-inverted categories-list">
                <li><span class="icon icon-home"></span></li>
                <li><span class="cat-name"></span></li>
                <li><a class="active"><span class="sub-name"></span></a></li>

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
        <div id="filters" class="filters filters-top">
            <div class="container">
                <div class="row">
                   <!--  <div class="col-md-3 col-xs-12">
                        <div class="filter-box">
                            <div class="title">
                                Availability
                            <span></span></div>
                            <div class="filter-content" style="display: none;">
                                <span class="checkbox">
                                    <input type="radio" id="available-yes" name="group-available" checked="checked" value="">
                                    <label for="available-yes">All</label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="available-instock" name="group-available" value=".available-instock">
                                    <label for="available-instock">In stock</label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="available-oneweek" name="group-available" value=".available-oneweek">
                                    <label for="available-oneweek">1 Week</label>
                                </span>
                            </div>
                            <div class="filter-update">
                                Close
                            </div>
                        </div> 
                    </div> -->
                  <!--   <div class="col-md-3 col-xs-12">
                        <div class="filter-box">
                            <div class="title">
                                Discount
                            <span>Discount price</span></div>
                            <div class="filter-content" style="display: none;">
                                <span class="checkbox">
                                    <input type="radio" id="price-all" name="group-dicount" value="" checked="checked">
                                    <label for="price-all">All</label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="price-discount" name="group-dicount" value=".price-discount">
                                    <label for="price-discount">Discount price</label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="price-regular" name="group-dicount" value=".price-regular">
                                    <label for="price-regular">Regular price</label>
                                </span>
                            </div>
                            <div class="filter-update">
                                Close
                            </div>
                        </div>
                    </div> -->
                   <!--  <div class="col-md-3 col-xs-12">
                        <div class="filter-box">
                            <div class="title">
                                Type
                            <span></span></div>
                            <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" name="group-type" id="category-all" value="" checked="checked">
                                    <label for="category-all">All <i>(1200)</i></label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" name="group-type" id="category-sofa" value=".category-sofa">
                                    <label for="category-sofa">Sofa <i>(1200)</i></label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" name="group-type" id="category-armchair" value=".category-armchair">
                                    <label for="category-armchair">Armchairs <i>(12)</i></label>
                                </span>
                            </div>
                            <div class="filter-update">
                                Close
                            </div>
                        </div> 
                    </div> -->
                    <!-- <div class="col-md-3 col-xs-12">
                        <div class="filter-box">
                            <div class="title">
                                Material
                            <span></span></div>
                            <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" id="material-all" name="group-material" value="" checked="checked">
                                    <label for="material-all">All <i>(12)</i></label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="material-leather" name="group-material" value=".material-leather">
                                    <label for="material-leather">Leather <i>(12)</i></label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="material-wood" name="group-material" value=".material-wood">
                                    <label for="material-wood">Wood <i>(80)</i></label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" id="material-metal" name="group-material" value=".material-metal">
                                    <label for="material-metal">Metal <i>(80)</i></label>
                                </span>
                            </div>
                            <div class="filter-update">
                                Close
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="toggle-filters-close btn btn-main visible-sm visible-xs">
                Close search
            </div>
        </div> 

        <section class="products">

            <div class="container">

                <header class="hidden">
                    <h3 class="h3 title">Product category with topbar</h3>
                </header>

                <div class="row">

                    <!-- === product-items === -->

                    <div class="col-md-12 col-xs-12">

                        <div class="sort-bar clearfix">
                            <div class="sort-results pull-left">
                                <!--Showing result per page-->
                                <select>
                                    <option value="1">10</option>
                                    <option value="2">50</option>
                                    <option value="3">100</option>
                                    <option value="4">All</option>
                                </select>
                                <!--Items counter-->
                                <span>Showing all <strong>50</strong> of <strong>3,250</strong> items</span>
                            </div>
                            <div class="sort-options pull-right">
                                <span>Sort by</span>
                                <!--Sort options-->
                                <select id="sort-price">
                                    <option data-option-value="asc">Price: lowest</option>
                                    <option data-option-value="desc">Price: highest</option>
                                </select>
                                <!--Grid-list view-->
                                <span class="grid-list">
                                    <a href="javascript:void(0);" class="toggle-filters-mobile"><i class="fa fa-search"></i></a>
                                    <a  href="#productid1" id="btn_modal" class="mfp-open" style="display:none;"></a>
                                </span>
                            </div>
                        </div>

                        <div id="products" class="row" style="position: relative; height: 299.987px;">
                            <div class="product_list alignwides wp-block-covers"></div>
                        </div><!--/row-->


                    </div> <!--/product items-->


                </div><!--/row-->
              <?php $this->load->view('website/product_modal.php'); ?>

            </div><!--/container-->
        </section>