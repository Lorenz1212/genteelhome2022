   <div class="page-loader"></div>
        <section class="header-content ">
        <div class="owl-slider owl-slider-fullscreen owl-carousel owl-theme" style="opacity: 1; display: block; width: 100%;">
            <?php 
                 $sql = "SELECT * FROM tbl_website_banner WHERE status='ACTIVE' ORDER BY date_created ASC";
                 $query = $this->db->query($sql);
                  if($query !== FALSE && $query->num_rows() > 0){
                   foreach($query->result() as $row){
                      echo '<div class="item wp-block-cover-image" style="background-image: url('.base_url().'assets/images/banner/'.$row->image.'); object-fit: cover;background-color: black;">
                             <div class="box">
                             <div class="container text-center">
                                    <h2 class="title animated h1 test " data-animation="fadeInDown" style="animation-delay: 100ms;">'.$row->title.'</h2>
                                    <h2 class="title animated" data-animation="fadeInUp" style="animation-delay: 280ms;">
                                       '.$row->sub_title.'
                                    </h2>>
                                </div>
                            </div>
                          </div>
                          ';
                    }      
                 }
            ?>      
            </div> 
    </section>
    <section class="banner " style="background-image:url(<?php echo base_url() ?>assets/images/static/bg2.jpg)"></section>
    <section class="header-content " style="padding-top:0px">
        <div class="owl-slider1 owl-carousel1" style="padding-right: 1px;">
            <?php 
                 $sql = "SELECT * FROM tbl_lookbook_details WHERE status=1 ORDER BY date_created ASC LIMIT 9";
                 $query = $this->db->query($sql);
                  if($query !== FALSE && $query->num_rows() > 0){
                   foreach($query->result() as $row){
                      echo '<div class="item wp-block-cover-image" style="background-image: url('.base_url().'assets/images/lookbook/'.$row->image.'); object-fit: cover;background-color: black;margin-right: 5px;">
                             <div class="box">
                             <div class="container text-center">
                                    <h2 class="title animated h1 test " data-animation="fadeInDown" style="animation-delay: 100ms;"></h2>
                                    <h2 class="title animated" data-animation="fadeInUp" style="animation-delay: 280ms;">
                                    </h2>
                                </div>
                            </div>
                          </div>
                          ';
                    }      
                 }
            ?>      
            </div> 
               
        
    </section>

  <!--       <section class="products ">
            <div class="container">
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
                </div> 
                <div class="wrapper-more">
                     <a href="<?php echo base_url()?>gh/app/popular-product" class="btn btn-clean-dark" id="btn_view">View All</a>
                </div>
                <?php //$this->load->view('website/product_modal.php');?>
            </div>
        </section> -->
        <!-- ========================  Stretcher widget ======================== -->
<!--     <section class="banner " style="background-image:url(<?php echo base_url() ?>assets/images/static/bg2.jpg)">
    </section> -->
<!--   <section class="instagram">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="h2 title">Gallery</h2>
                        </div>
                    </div>
                </div>
            </header>

            <div class="gallery clearfix lookbook_list">
                
            </div>
         </section> -->
        <!-- ========================  Blog Block ======================== -->
      <!--   <section class="blog blog-block" >
            <div class="container">
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
        </section> -->


<!--  <section class="instagram" style="display: none">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="h2 title">Testimonial</h2>
                        </div>
                    </div>
                </div>
            </header>
    </section> -->
<!--     <section class="quotes quotes-slider" style="background-image:url(<?php echo base_url() ?>assets/images/static/bg1.jpg)" >
            <div class="container">
                <div class="row">
                    <div class="quote-carousel">
                        <?php 
                          $sql = "SELECT * FROM tbl_customer_testimony WHERE  status='ACTIVE' ORDER BY id DESC";
                          $query = $this->db->query($sql);
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
        </section>  -->
    <!--         <section class="blog">
                        <div class="container">
                            <header>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-8 text-center">
                                        <h1 class="h2 title">Blogs</h1>
                                        <div class="text">
                                            <p>Latest news from the blog</p>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <div class="row list-blog-latest"></div> 
                </div> 
            </section> -->

                
       
