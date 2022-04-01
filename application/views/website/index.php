<div id="kt_content" data-table="data-index"></div>
        <section class="header-content">
        <div class="owl-slider owl-carousel owl-theme wp-block-cover alignwide" style="opacity: 1; display: block; width: 100%;">
            <?php 
                 $query = $this->db->select('*')->from('tbl_website_banner')->where('type !=','none')->order_by('type','ASC')->get();
                  if($query !== FALSE && $query->num_rows() > 0){
                   foreach($query->result() as $row)
                    {
                          echo '<div class="item wp-block-cover-image" style="background-image:url('.base_url().'assets/images/banner/'.$row->image.'); object-fit: cover;">
                                 <div class="box">
                                   <div class="container">
                                    <h2 class="title animated h1" data-animation="fadeInDown">'.$row->title.'</h2>
                                      <div class="animated" data-animation="fadeInUp">'.$row->sub_title.'
                                   </div>
                                  </div>
                                </div>
                              </div>';
                    }      
                 }
            ?>      
            </div> 
</section>


        <section class="products">

            <div class="container">

                <!-- === header title === -->
                <header>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="title">Popular products</h2>
                            <div class="text">
                                <p>Check out our latest popular product</p>
                            </div>
                        </div>
                    </div>
                </header>
                 <a  href="#productid1" id="btn_modal" class="mfp-open" style="display:none;"></a>
                <div class="row ">
                    <div class="product_index alignwides wp-block-covers"></div>
                </div> <!--/row-->
                <!-- === button more === -->

                <div class="wrapper-more">
                     <a href="<?php echo base_url()?>gh/app/product-list/<?php echo base64_encode('all')?>/<?php echo base64_encode('dasxasdas2342')?> " class="btn btn-clean-dark" id="btn_view">View All</a>
                </div>
                <?php $this->load->view('website/product_modal.php');?>
            </div> <!--/container-->
        </section>

        <!-- ========================  Stretcher widget ======================== -->
    <section class="banner" style="background-image:url(<?php echo base_url() ?>assets/images/static/bg2.jpg)">
    </section>
    <section class="instagram">
            <!-- === instagram header === -->
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="h2 title">Follow us <i class="fa fa-instagram fa-2x"></i></h2>
                            <div class="text">
                                <p><a href="https://www.instagram.com/home_genteel/?hl=en">@home_genteel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- === instagram gallery === -->
            <div class="gallery clearfix">
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-1.jpg" alt="Alternate Text" />
                </a>
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-2.jpg" alt="Alternate Text" />
                </a>
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-3.jpg" alt="Alternate Text" />
                </a>
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-4.jpg" alt="Alternate Text" />
                </a>
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-5.jpg" alt="Alternate Text" />
                </a>
                <a class="item" >
                    <img src="<?php echo base_url() ?>assets_website/images/square-6.jpg" alt="Alternate Text" />
                </a>
            </div> <!--/gallery-->
        </section>
        <!-- ========================  Blog Block ======================== -->
        <section class="blog blog-block">
            <div class="container">
               <!--  <header>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="title">EVENT</h2>
                            <div class="text">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <div id="events"></div>
                </div>

                <div class="wrapper-more">
                    <a href="<?php echo base_url()."gh/app/events";?>"  class="btn btn-clean-dark">View all posts</a>
                </div> -->
                 <header>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h1 class="h2 title">Where there is love, there is QUALITY</h1>
                            <div class="text">
                                <p>Great furnishings start from the smallest piece and detail. We make sure that everything is finely made for our beloved clients.</p>
                                <p>Your house deserves a Genteel masterpiece.</p>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="main">
                      <div class="slider slider-for forr">
                        <div> <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload" src="<?php echo base_url() ?>assets/images/video/video6.mp4"></video></div>
                        <div>
                            <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload"  preload="metadata"  src="<?php echo base_url() ?>assets/images/video/video1.mp4"></video>
                        </div>
                        <div> <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload" src="<?php echo base_url() ?>assets/images/video/video3.mp4"></video></div>
                        <div>
                            <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload" src="<?php echo base_url() ?>assets/images/video/video2.mp4"></video>
                        </div>
                        <div> <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload" src="<?php echo base_url() ?>assets/images/video/video4.mp4"></video></div>
                        <div> <video class="video" autoplay="true" loop="true" muted="true" controls controlsList="nodownload" src="<?php echo base_url() ?>assets/images/video/video5.mp4"></video></div>
                      </div>
                      <div class="slider slider-nav sliderss" style="padding-top:10px;">
                         <div ><video  class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video6.mp4" type="video/mp4">
                            </video></div>
                        <div ><video  class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video1.mp4" type="video/mp4">
                            </video></div>
                        <div ><video class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video3.mp4" type="video/mp4">
                            </video></div>
                        <div ><video  class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video2.mp4" type="video/mp4">
                            </video></div>
                        <div ><video  class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video4.mp4" type="video/mp4">
                            </video></div>
                        <div ><video class="video-hover video-size">
                              <source src="<?php echo base_url() ?>assets/images/video/video5.mp4" type="video/mp4">
                            </video></div>
                      </div>
                    </div>
            </div> 
        </section>

        <section class="instagram">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="h2 title">Testimonial</h2>
                        </div>
                    </div>
                </div>
            </header>
        </section>

        <section class="quotes quotes-slider" style="background-image:url(<?php echo base_url() ?>assets/images/static/bg1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="quote-carousel">
                        <?php 
                           $query = $this->db->select('*')->from('tbl_customer_testimony')->order_by('id','DESC')->get();
                           foreach($query->result() as $row){
                            echo'  <div class="quote quotes-style">
                                     <div class="image">
                                        <img src="'.base_url().'assets/images/testimony/'.$row->image.'" alt="" />
                                    </div>
                                    <div class="text">
                                        <h4>'.$row->name.'</h4>
                                        <div class="text-break sc1">
                                        <p >'.$row->description.'</p>
                                        </div>
                                    </div>
                                </div>';
                           }
                        ?>
                    </div> 
                </div> 
            </div> 
        </section>

        <!-- ========================  Instagram ======================== -->

       
