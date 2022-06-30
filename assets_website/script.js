'use strict';
var KTAjaxClientweb = function() {
let view;	
let mainpage; 
	var _check_url =  async function (url){
		let id="";
	 	if(url.split('/')[0] == 'genteelhome2022' || url.split('/')[0] == 'genteelhomev2'){
	 		view =  url.split('/')[3];
	 		id=url.split('/')[4];
	 	}else if(url.split('/')[1] == 'genteelhome2022' || url.split('/')[1] == 'genteelhomev2'){
	 		view =  url.split('/')[4];
	 		id=url.split('/')[5];
	 	}else if(url.split('/')[2] == 'genteelhome2022' || url.split('/')[2] == 'genteelhomev2'){
	 		view =  url.split('/')[5];
	 		id=url.split('/')[6];
	 	}else if(url.split('/')[3] == 'genteelhome2022' || url.split('/')[3] == 'genteelhomev2'){
	 		view =  url.split('/')[6];
	 		id=url.split('/')[7];
	 	
	 	}else if(url.split('/')[4] == 'genteelhome2022' || url.split('/')[4] == 'genteelhomev2'){
	 		view = url.split('/')[7];
	 		id=url.split('/')[8];
	 	}else if(url.split('/')[5] == 'genteelhome2022' || url.split('/')[5] == 'genteelhomev2'){
	 		view =  url.split('/')[8];
	 		id=url.split('/')[9];
	 	}
	 	 mainpage= view;
	 	if(!view){
	 		mainpage = 'index';
	 	}
	 	_ViewController(mainpage,id);
    };
	var _formatnumbercommat = function(value){
		return value.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
	}
	var _initImageView = function(){
		var modal = document.getElementById("myModal");
		var img = document.getElementById("myImg");
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		 $(document).on("click","#myImg",function() {
		 	 let image= $(this).attr('data-image');
		 	  modal.style.display = "block";
			  modalImg.src = image;
			  // captionText.innerHTML = this.alt;
			  $('.navbar-fixed').attr('style','z-index:10 !important');
		 })
		var span = document.getElementsByClassName("close-image")[0];
		  span.onclick = function() {
		  modal.style.display = "none";
		    $('nav.navbar-fixed').removeAttr('style');
		}
	}
	var _showSwal  = function(type,message,title) {
      if(!title){
        swal.fire({
          text: message,
          icon: type,
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          }
          })
      }else{
        swal.fire({
          title: title,
          text: message,
          icon: type,
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          }
          })
      }
      
    }
	var _initremovetable = function(action){
		$(""+action+"").on("click", "#DeleteButton", function() {
			   $(this).closest("tr").remove();
		});
	}
	var _initCurrency_format = function(action){
		$( document ).ready(function() {
			$(''+action+'').mask('000,000,000,000,000.00', {reverse: true});
		});
	}
	var _initNumberOnly = function(action){
		$(document).on('input', action, function(evt){
			var self = $(this);
			self.val(self.val().replace(/[^0-9\.]/g,''));
			if ((evt.which < 48 || evt.which > 57)) 
			{
				evt.preventDefault();
			}
		});
	}
	var _sessionStorage = function(key,value){
		sessionStorage.setItem(key, value);
	}
	var _getItem = function(key){
		return sessionStorage.getItem(key);
	}
	var categories = function(){
		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['categories', 'fetch_categories_list']));
	}
	var cart_list = function(){
		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['categories', 'fetch_cart_list']));
	}
	var footer = function(){
		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['company', 'fetch_company_info']));
	}
	var _ViewController = async function(view,val){
		switch(view){
			case "index":{
				 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['dashboard', 'fetch_popular_product']));
				 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['dashboard', 'fetch_blog_list_latest']));
				break;
			}
			case "terms-conditions":
			case "returns-exchange-policy":
			case "privacy-policy":
			case "about":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['company', 'fetch_company_profile']));
				break;
			}
			case "interior-list":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interior', 'fetch_interior_list',val]));
				break;
			}
			case "article":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interior', 'fetch_interior_details',val]));
				break;
			}
			case "blogs":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['blogs', 'fetch_blog_list']));
				break;
			}
			case "cart":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'fetch_cart_list_view']));
				break;
			}
			case"collection":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['collection', 'fetch_collection_list']));
				break;
			}
			case "product-list":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_list',val]));
				break;
			}
			case "product-details":{
				 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_details',val]));
				 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_gallery',val]));
				$('.add_collection').on('click',function(e){
					let id = $(this).attr('data-id');
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'add_product_collection',id]));
				 });
				break;
			}
			case "checkout":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'fetch_checkout_list']));
				$('#next').on('click',function(e){
					e.preventDefault();
					var nextt = $(this).attr('data-action');
					if(nextt == 'delivery'){
					  var rowCount = $('#table-cart-list > tbody tr').length;
					    if(!rowCount){
						    	swal({
							  title: "No Item!",
							  text: "You clicked the button!",
							  icon: "error",
							  button: "Ok!",});
					    }else{
					    	var next = 'delivery';
					    }
					}else if(nextt == 'payment'){
		  			   let b_address_message  = $('input[name=b_address]').val();
		  			   let b_city_message 	  = $('input[name=b_city]').val();
		  			   let b_province_message = $('input[name=b_province]').val();
		  			   let s_address_message  = $('input[name=s_address]').val();
		  			   let s_city_message 	  = $('input[name=s_city]').val();
		  			   let s_province_message = $('input[name=s_province]').val();
		  			   let region_message = $('select[name=region]').val();
		  			   if(!b_address_message || !b_city_message || !b_province_message || !s_address_message || !s_city_message || !s_province_message){
		  			   	swal({
						  title: "Please Complete The Form!",
						  text: "You clicked the button!",
						  icon: "error",
						  button: "Ok!",});
		  			   }else{
		  			   	var next = 'payment';
		  			   }
		  			}else{
		  			   var next = nextt;
		  			}
		  			switch(next){
		  				case"delivery":{
		  				   $('#shop_more').hide();
			  			   $('#back').first().fadeIn("fast");
			  			   $('#delivery_hide').first().fadeIn("fast");
			  			   $('#cart_hide').hide();
			  			   $('#next').attr('data-action','payment');
			  			   $('#back').attr('data-back','shop_more');
			  			   $("#delivery_active").addClass("active");
			  			   $('#next').text('Next');
			  			   $("#cart_active").addClass("active");
		  				   break;
		  				}
		  				case "payment":{
		  				   $('#shop_more').hide();
		  				   $('#delivery_hide').hide();
			  			   $('#back').first().fadeIn("fast");
			  			   $('#payment_hide').first().fadeIn("fast");
			  			   $('#cart_hide').hide();
			  			   $('#next').attr('data-action','submit');
			  			   $('#back').attr('data-back','delivery');
			  			   $("#delivery_active").addClass("active");
			  			   $("#cart_active").addClass("active");
			  			   $('#next').text('Place Order');
			  			   $("#payment_active").addClass("active");
				  		   let b_address = $('input[name=b_address]').val();
					 	   let b_city = $('input[name=b_city]').val();
					 	   let b_province = $('input[name=b_province]').val();
				  		   let s_address = $('input[name=s_address]').val();
					 	   let s_city = $('input[name=s_city]').val();
					 	   let s_province = $('input[name=s_province]').val();
					 	   $('#b_address').text(b_address);
					 	   $('#b_city').text(b_city);
					 	   $('#b_province').text(b_province);
					 	   $('#s_address').text(s_address);
					 	   $('#s_city').text(s_city);
					 	   $('#s_province').text(s_province);
					 	   var today = new Date();
					 	   var order_date = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();
					 	   var shipping_date = (today.getMonth()+1)+'/'+(today.getDate()+14)+'/'+today.getFullYear();

					 	   var date = today.getFullYear()+''+(today.getMonth()+1)+''+today.getDate();
						   var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds();
						   var order_no = date+'-'+time;
					 	   $('#order_date').text(order_date);
					 	   $('#shipping_date').text(shipping_date);
					 	   $('#order_no').text('OR'+order_no);
		  				   break;
		  				}
		  			}
				});
				$('#back').on('click',function(e){
					e.preventDefault();				 
		  			var back = $(this).attr('data-back');
		  			switch(back){
		  				case"shop_more":{
		  				   $('#shop_more').first().fadeIn("fast");
			  			   $('#back').hide();
			  			   $('#next').attr('data-action','delivery');
			  			   $('#delivery_hide').hide();
			  			   $('#cart_hide').first().fadeIn("fast");
			  			   $("#delivery_active").removeClass("active");
			  			   $("#cart_active").addClass("active");
			  			   $('#next').text('Next');
			  			   $('#coupon_hide').first().fadeIn("fast");
			  			   $('#coupon1_hide').hide();
		  				   break;
		  				}
		  				case "delivery":{
		  				   $('#shop_more').hide();
		  				   $('#payment_hide').hide();
			  			   $('#back').first().fadeIn("fast");
			  			   $('#delivery_hide').first().fadeIn("fast");
			  			   $('#cart_hide').hide();
			  			   $('#next').attr('data-action','payment');
			  			   $('#back').attr('data-back','shop_more');
			  			   $("#delivery_active").addClass("active");
			  			   $('#next').text('Next');
			  			   $("#cart_active").addClass("active");
			  			   $("#payment_active").removeClass("active");
		  				   break;
		  				}
		  			}
				});
				 $('#checkcopy').change(function() {
				 	let b_address = $('input[name=b_address]').val();
				 	let b_city = $('input[name=b_city]').val();
				 	let b_province = $('input[name=b_province]').val();
				        if($(this).is(":checked")) {
				            $('input[name=s_address]').val(b_address);
					 	$('input[name=s_city]').val(b_city);
					 	$('input[name=s_province]').val(b_province);
				        }else{
				        	$('input[name=s_address]').val('');
					 	$('input[name=s_city]').val('');
					 	$('input[name=s_province]').val('');
				        }
				 });
				break;
			}
		}
	}
	

	var _construct = async function(response, type, element, object){
		switch(type){
			case "fetch_interior_details":{
				let btn = $('.categories-list').empty();
				let cat_name ="";
				if(!response == false){
					if(response.cat_id == 1){
						cat_name = 'Residential Project';
					}else if(response.cat_id == 2){
						cat_name = 'Commerial Project';
					}
					btn.append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>\
		                			<li><a href="'+baseURL+'gh/app/interior">INTERIOR</a></li>\
		                			<li><a class="active">'+cat_name+'</a></li>');
	  			$('#project_name').text(response.project_name);
	  			$('#description').html(response.description);
	  			$('#image').attr('style','background-image: -webkit-linear-gradient(rgba(0,0,0, 0) 0%,rgba(0,0,0, 1) 100%) ,url('+baseURL+'assets/images/interior/'+response.bg+')');
	  			$('#image1').attr('src',baseURL+'assets/images/interior/'+response.image);
	  		}
				break;
			}
			case "fetch_interior_list":{
				let container =$('#interior_list').empty();
				let btn = $('.categories-list').empty();
				$('.title').text(response.cat_name);
				btn.append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
		                			+'<li><a href="'+baseURL+'gh/app/interior">INTERIOR</a></li>');
				if(response.data){
		  			for(let i=0;i<response.data.length;i++){
				  				container.append(' <div class="col-sm-4 col-md-4">\
								                        <article>\
							                           <a href="'+baseURL+'gh/app/article/'+response.data[i].id+'">\
							                           	<div class="image" style="background-image:url('+baseURL+'assets/images/interior/'+response.data[i].image+')">\
							                           	   <img src="'+baseURL+'assets/images/interior/'+response.data[i].image+'" alt="" />\
							                                  </div>\
							                                        <div class="entry entry-table">\
							                                            <div class="title">\
							                                                <h2 class="h5">'+response.data[i].project_name+'</h2>\
							                                            </div>\
							                                        </div>\
							                                    </a>\
							                                </article>\
							                            </div>');	
				  	 }
				}else{
					 container.append('<div class="col-md-12 col-xs-12">\
					  		   	  			 <section class="history">\
						           				 <div class="container">\
															  	<div class="row row-block">\
														                    <div class="col-md-7 history-desc">\
														                        <p>  <h1 class="title" data-title="Page not found!">Sorry!</h1>\
																                    <div class="h4 subtitle">No Interior Design Available</div>\
																                <p>The requested interior was not available on this page. That’s all we know.</p>\
																                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
														                    		</div>\
														                	</div>\
														                </div>\
														            <div>\
											           	</div>');
				}
				break;
			}
			case "fetch_blog_list_latest":{
				let container = $('.list-blog-latest').empty();
				if(response !=false){
					for(let i=0;i<response.length;i++){
						let html =$('<div class="col-sm-4">\
			                            <article>\
			                                <a href="article.html">\
			                                    <div class="image" style="background-image:url('+baseURL+'assets/images/events/'+response[i].image+')">\
			                                        <img src="assets/images/blog-1.jpg" alt="">\
			                                    </div>\
			                                    <div class="entry entry-table">\
			                                        <div class="date-wrapper">\
			                                            <div class="date">\
			                                                <span>'+response[i].month_name+'</span>\
			                                                <strong>'+response[i].day_name+'</strong>\
			                                                <span>'+response[i].year_name+'</span>\
			                                            </div>\
			                                        </div>\
			                                        <div class="title">\
			                                            <h2 class="h5">'+response[i].title+'</h2>\
			                                        </div>\
			                                    </div>\
			                                    <div class="show-more">\
			                                       <a href="'+baseURL+'gh/app/blogs-detials/'+response[i].id+'"><span class="btn btn-clean-dark btn-block">Read more</span></a>\
			                                    </div>\
			                                </a>\
			                            </article>\
			                        </div>');
						container.append(html);
					}
				}else{
					$('.blog-list').attr('style','display:none');
				}
				break;
			}
			case "fetch_blog_list":{
				let container = $('.list-blog').empty();
				if(response !=false){
					for(let i=0;i<response.length;i++){
						let html = $('<div class="col-sm-12">\
			                                <article class="article-table">\
			                                	<a href="javascript:;">\
			                                        <div class="image" id="myImg" data-image="'+baseURL+'assets/images/events/'+response[i].image+'" style="background-image:url('+baseURL+'assets/images/events/'+response[i].image+')">\
			                                            <img src="'+baseURL+'assets/images/events/'+response[i].image+'" alt="">\
			                                        </div>\
			                                        <div class="text">\
			                                            <div class="title">\
			                                                <p>'+response[i].month_name+'.'+response[i].day_name+'.'+response[i].year_name+'</p>\
			                                                <h2 class="h5">'+response[i].title+'</h2>\
			                                            </div>\
			                                            <div class="text-intro">\
			                                                <p>'+response[i].description+'</p>\
			                                            </div>\
			                                        </div>\
			                                        </a>\
			                                </article>\
			                            </div>');
						container.append(html);
					}
				}else{
					 container.append('<div class="col-md-12 col-xs-12">\
					  		   	  			 <section class="history">\
						           				 <div class="container">\
															  	<div class="row row-block">\
														                    <div class="col-md-7 history-desc">\
														                        <p>  <h1 class="title" data-title="Page not found!">Sorry!</h1>\
																                    <div class="h4 subtitle">No Blogs Available</div>\
																                <p>The requested blogs was not available on this page. That’s all we know.</p>\
																                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
														                    		</div>\
														                	</div>\
														                </div>\
														            <div>\
											           	</div>');
				}
				break;
			}
			case "fetch_company_profile":{
				if(response !=false){
					$('#image').attr('style','background-image: url('+baseURL+'assets/images/avatar/'+response.image+')');
					$('#owner_name').text(response.owner_name);
					$('#about').html(response.about_owner);
					$('#ourstory').html(response.our_story);
					$('#return_policy').html(response.return_exchange);
					$('#privacy').html(response.privacy);
					$('#terms').html(response.terms);
				}
				break;
			}
			case "fetch_company_info":{
				if(response !=false){
					$('#facebook').attr('href',response.facebook);
			  		$('#youtube').attr('href',response.youtube);
			  		$('#tweeter').attr('href',response.tweeter);
			  		$('#instagram').text(response.instagram);
			  		$('#email').text(response.email);
			  		$('#mobile').text(response.mobile);
			  		$('#company').text(response.company);
			  		$('#address').text(response.address);
			  		$('#storeopen').text(response.store_open);
			  		$('#mobile_contact').text(response.mobile);
			  		$('#company_contact').text(response.company);
			  		$('#address_contact').text(response.address);
			  		$('#store_open').text(response.store_open);
				}
				break;
			}
			case "fetch_categories_list":{
				let container = $('#category_nav').empty();
				if(response != false){
					for(let i=0;i<response.length;i++){
						let html = $('<div class="col-md-3"><ul><li class="label">'+response[i].cat_name+'</li>\
													'+response[i].sub+'\
													</ul></ul>');
				    	container.append(html).promise().done(function(){
				    	$('.view-product-list').on('click',function(e){
				    		e.preventDefault();
				    		let id = $(this).attr('data-id');
				    		window.location.replace(baseURL+"gh/app/product-list/"+id);
				    	})
				    });
		  		}	
				}
				break;
			}

			case "fetch_popular_product":{
				let container = $('.product_index').empty();
				if(response !=false){
					for (let i=0;i<response.length;i++) {
						let html = $('<div class="col-md-4 col-xs-6">\
                              <article>\
                              	<div class="info">\
                                   </div>\
                                   <div class="btn btn-add view-product-details" data-id="'+response[i].id+'"  style="cursor:pointer;">\
                                        <i class="icon icon-cart"></i>\
                                    </div>\
                                    <div class="figure-grid">\
                                        <div class="image">\
                                            <a href="javascript:;" class="mfp-open view-product-details"  data-id="'+response[i].id+'">\
                                                <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response[i].image+'" alt=""/>\
                                            </a>\
                                        </div>\
                                        <div class="text">\
                                            <h2 class="title h4"><a>'+response[i].title+'</a></h2>\
                                            <span class="description clearfix"></span>\
                                        </div>\
                                    </div>\
                                </article>\
                              </div>');
						 container.append(html).promise().done(function(){
						 	$('body').delegate('.view-product-details','click',function(e){
						 		e.stopImmediatePropagation();
						 		let id = $(this).attr('data-id');
						 		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_details',id]));
						 	});
						 });
					}
				}
				break;
			}
			case "fetch_collection_list":{
				let container = $('.product_list').empty();
				if(response !=false){
					if(response.cat !=false){
							for (let i=0;i<response.details.length;i++) {
							let html = $('<div class="col-md-4 col-xs-6">\
	                              <article>\
	                              	<div class="info">\
	                                   </div>\
	                                   <div class="btn btn-add view-product-details" data-id="'+response.details[i].id+'"  style="cursor:pointer;">\
	                                        <i class="icon icon-cart"></i>\
	                                    </div>\
	                                    <div class="figure-grid">\
	                                        <div class="image">\
	                                            <a href="javascript:;" class="mfp-open view-product-details"  data-id="'+response.details[i].id+'">\
	                                                <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.details[i].image+'" alt=""/>\
	                                            </a>\
	                                        </div>\
	                                        <div class="text">\
	                                            <h2 class="title h4"><a>'+response.details[i].title+'</a></h2>\
	                                            <span class="description clearfix"></span>\
	                                        </div>\
	                                    </div>\
	                                </article>\
	                              </div>');
							 container.append(html).promise().done(function(){
							 	$('body').delegate('.view-product-details','click',function(e){
							 		e.stopImmediatePropagation();
							 		let id = $(this).attr('data-id');
							 		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_details',id]));
							 	});
							 });
						}

					}
					
				}
				break;
			}
			case "fetch_product_list":{
				let container = $('.product_list').empty();
				if(response !=false){
					if(response.cat !=false){
							//$('.main-header').attr('style','background-image:url('+baseURL+'assets/images/category/'+response.cat.image+')');
							$('.cat-name').text(response.cat.cat_name);
							$('.sub-name').text(response.cat.sub_name);
							for (let i=0;i<response.details.length;i++) {
							let html = $('<div class="col-md-4 col-xs-6">\
	                              <article>\
	                              	<div class="info">\
	                                   </div>\
	                                   <div class="btn btn-add view-product-details" data-id="'+response.details[i].id+'"  style="cursor:pointer;">\
	                                        <i class="icon icon-cart"></i>\
	                                    </div>\
	                                    <div class="figure-grid">\
	                                        <div class="image">\
	                                            <a href="javascript:;" class="mfp-open view-product-details"  data-id="'+response.details[i].id+'">\
	                                                <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.details[i].image+'" alt=""/>\
	                                            </a>\
	                                        </div>\
	                                        <div class="text">\
	                                            <h2 class="title h4"><a>'+response.details[i].title+'</a></h2>\
	                                            <span class="description clearfix"></span>\
	                                        </div>\
	                                    </div>\
	                                </article>\
	                              </div>');
							 container.append(html).promise().done(function(){
							 	$('body').delegate('.view-product-details','click',function(e){
							 		e.stopImmediatePropagation();
							 		let id = $(this).attr('data-id');
							 		 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_details',id]));
							 	});
							 });
						}

					}
					
				}
				break;
			}
			case "fetch_product_details":{
				let html;
				let container;
				if(response !=false){
					$('.add_collection').attr('data-id',response.id);
					if(response.collection=='delete'){
						$('.add').show();
						$('.added').hide();
					}else{
						$('.add').hide();
						$('.added').show();
					}
					if(response.info != false){
						$('.title-product').text(response.info.title);
						$('.title-model').text(response.info.title);
						$('.tearsheet').attr('href',baseURL+'assets/images/tearsheet/'+response.info.tearsheet);
						let stocks = $('.product-on-stocks').empty();
						let pre = $('.product-pre-stocks').empty();
						if(response.pallet){
							for(let i=0;i<response.pallet.length;i++){
								if(response.pallet[i].stocks  == 0){
					  			  pre.append('<img data-action="Pre Order" class="color-btn" data-id="'+response.pallet[i].id+'"  src="'+baseURL+'assets/images/palettecolor/'+response.pallet[i].pallet_color+'"/>');
					  			}else{
					  			   stocks.append('<img data-action="In Stocks" data-id="'+response.pallet[i].id+'" class="color-btn" src="'+baseURL+'assets/images/palettecolor/'+response.pallet[i].pallet_color+'"/>');
					  			}
							}
							let id = response.pallet[0].id;
							 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_image',id]));
							$('.color-btn').on('click',function(e) {
								e.stopImmediatePropagation();
								let c_code = $(this).attr('data-id');
								 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'fetch_product_image',c_code]));
							});
							$('.add_cart').on('click',function(e){
								e.preventDefault();
								let qty = $('#qty').val();
								let availability =$('.product-availability').attr('data-status');
				 				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'add_product_cart',id,qty,availability]));
				 			});
				 			
						}
						$("#btn_modal").trigger('click');
					}
					$('.view-details').on('click',function(e){
						e.preventDefault();
						window.location.replace(baseURL+"gh/app/product-details/"+response.id);
					});
				}
				break;
			}
			case"add_product_collection":{
				if(response !=false){
					if(response=='delete'){
						$('.add').show();
						$('.added').hide();
					}else{
						$('.add').hide();
						$('.added').show();
					}
				}
				break;
			}
			case "fetch_product_image":{
				let container = $('.modal_image').empty();
  				let container1 = $('.modal_image1').empty();
  				let html="";
  			  	let html1="";
				if(response != false){
					if(response.info != false){
						$('.pallet-name').text(response.info.c_name);
						$('.pallet-price').text(response.price);
						var status = {
							1: {'title': 'Pre Order'},
							2: {'title': 'In Stocks'},
						};
						$('.product-availability').text(status[response.availability].title).attr('data-status',response.availability);
						if(response.pallet){
							for(let i=0;i<response.pallet.length;i++){
								 html +='<img src="'+baseURL+'assets/images/finishproduct/product600x600/'+response.pallet[i].images+'" alt="" width="340">';
				  				 html1 +='<a href="'+baseURL+'assets/images/finishproduct/product600x600/'+response.pallet[i].images+'"><img src="'+baseURL+'assets/images/finishproduct/product600x600/'+response.pallet[i].images+'" alt="" height="500"></a>';
							 }
						}else{
							 html ='<img src="'+baseURL+'assets/images/finishproduct/product/default.png" alt="" width="340">';
				  		 html1 ='<a href="'+baseURL+'assets/images/finishproduct/product/default.png"><img src="'+baseURL+'assets/images/finishproduct/product/default.png" alt="" height="500"></a>';
						}
						container.append('<div class="owl-product-gallery owl-carousel owl-theme" style="opacity: 1; display: block;">\
	                      	'+html+'');
                      	container1.append('<div class="owl-product-gallery open-popup-gallery owl-carousel owl-theme">\
                      	'+html1+'');
                      	_image_pop_up();
					}	
				}else{
					$('.pallet-name').text("");
  			  		$('.pallet-price').text("");
  			  		$('.product-availability').text("");
				}
				break;
			}
			case "fetch_product_gallery":{
				let container = $('.view-gallery').empty();
				if(response !=false){
				  		for(let i=0;i<response.length;i++){
				  			container.append('<div class="col-md-3 col-xs-3">\
				                                  <article>\
				                                      <div class="figure-grid">\
				                                          <div class="image">\
				                                              <a>\
				                                                  <img src="'+baseURL+'assets/images/finishproduct/product/'+response[i].images+'" alt="" width="360" />\
				                                              </a>\
				                                          </div>\
				                                      </div>\
				                                  </article>\
				                              </div>');
				  		}
				}
				break;
			}
			case "add_product_cart":{
				if(response !=false){
					cart_list();
				}
				break;
			}
			case "fetch_cart_list":{
				let container = $('#product_table').empty();
				if(response !=false){
					$('.count_cart').text(response.count);
					for(let i=0;i<response.cart.length;i++){
						let html = $('<tr id="delete_row" >\
					  							 <td style="padding-right:3px"><img src="'+baseURL+'assets/images/finishproduct/product/'+response.cart[i].image+'" alt="" style="width:60;height:60px;"></td>\
					  							 <td width="200"><div class="title"><div>'+response.cart[i].title+'</div><small> '+response.cart[i].pallet_name+'</small></div></td>\
					  							 <td ><div class="quantity"><input type="number" style="text-align:center;" class="form-control form-quantity"  min="1" value="'+response.cart[i].quantity+'" data-id="'+response.cart[i].id+'"></div></td>\
					  							 <td width="100" style="text-align:right;"><div class="price"><span class="final"><span class="cart_price"">'+response.cart[i].price+'</span></span></div></td>\
					  							 <td width="50" style="text-align:center;"><a href="javascript:;" class="detele-cart" data-id="'+response.cart[i].id+'"><span class="icon icon-cross icon-delete"></span></a></td>\
					  						</tr>');
						container.append(html).promise().done(function(){
								$('body').delegate('.form-quantity','input',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									let qty = $(this).val();
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'update_product_cart',id,qty]));
								});
								$('body').delegate('.detele-cart','click',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product', 'delete_product_cart',id]));
								});
						});
					}
				}
				break;
			}
			case "delete_product_cart":
			case "update_product_cart":{
				if(response !=false){
						cart_list();
				}
				break;
			}
			case "fetch_cart_list_view":{
				let container = $('#table-cart-list > tbody').empty();
				if(response !=false){
					$('.count_cart').text(response.count);
					for(let i=0;i<response.cart.length;i++){
						let html = $('<tr>\
										<td width="50" style="text-align:center;vertical-align: middle;"><span class="checkbox"><input type="checkbox" id="check_'+i+'" data-id="'+response.cart[i].id+'" ><label for="check_'+i+'"></label></span></td>\
			  							 <td style="padding-right:3px"><img src="'+baseURL+'assets/images/finishproduct/product/'+response.cart[i].image+'" alt="" style="width:60;height:60px;"></td>\
			  							 <td ><div class="title"><div>'+response.cart[i].title+'</div><small> '+response.cart[i].pallet_name+'</small></div></td>\
			  							 <td width="100"><div class="quantity"><input type="number" style="text-align:center;" class="form-control form-quantity"  min="1" value="'+response.cart[i].quantity+'" data-id="'+response.cart[i].id+'"></div></td>\
			  							 <td width="100" style="text-align:right;"><div class="price"><span class="final"><span class="cart_price"">'+response.cart[i].price+'</span></span></div></td>\
			  							 <td width="50" style="text-align:center;"><a href="javascript:;" class="detele-cart" data-id="'+response.cart[i].id+'"><span class="icon icon-cross icon-delete"></span></a></td>\
					  						</tr>');
						container.append(html).promise().done(function(){
								$('body').delegate('.form-quantity','input',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									let qty = $(this).val();
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'update_product_cart_list',id,qty]));
								});
								$('body').delegate('.detele-cart','click',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'delete_cart_list_view',id]));
								});
								$("#Update_Cart_Process").on('click',function (e) {
									e.stopImmediatePropagation();
										$("input[type=checkbox]:checked").each(function (e) {
				                 	 let id = $(this).attr('data-id');
				                 	_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'update_check_out',id]));

				            });
								});
						});
					}
				}
				break;
			}
			case "update_product_cart_list":
			case "delete_cart_list_view":{
				if(response !=false){
					cart_list();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'fetch_cart_list_view']));
				}
				break;
			}
			case "update_check_out":{
				if(response !=false){
						window.location = baseURL + 'gh/app/checkout';
				}
				break;
			}
			case "fetch_checkout_list":{
				let container = $('#table-cart-list > tbody').empty();
				if(response !=false){
					$('#subtotal').text(response.total);
					if(response.cart){
						for(let i=0;i<response.cart.length;i++){
						let html = $('<tr>\
			  							 <td style="padding-right:3px"><img src="'+baseURL+'assets/images/finishproduct/product/'+response.cart[i].image+'" alt="" style="width:60;height:60px;"></td>\
			  							 <td ><div class="title"><div>'+response.cart[i].title+'</div><small> '+response.cart[i].pallet_name+'</small></div></td>\
			  							 <td width="100"><div class="quantity"><input type="number" style="text-align:center;" class="form-control form-quantity"  min="1" value="'+response.cart[i].quantity+'" data-id="'+response.cart[i].id+'"></div></td>\
			  							 <td width="100" style="text-align:right;"><div class="price"><span class="final"><span class="cart_price"">'+response.cart[i].price+'</span></span></div></td>\
			  							 <td width="50" style="text-align:center;"><a href="javascript:;" class="detele-cart" data-id="'+response.cart[i].id+'"><span class="icon icon-cross icon-delete"></span></a></td>\
			  						</tr>');
						container.append(html).promise().done(function(){
							$('body').delegate('.form-quantity','input',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									let qty = $(this).val();
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'update_checkout_list',id,qty]));
								});
								$('body').delegate('.detele-cart','click',function(e){
									e.preventDefault();
									e.stopImmediatePropagation();
									let id = $(this).attr('data-id');
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'delete_checkout_list_view',id]));
								});
						});
						}
					}
				}
				break;
			}
			case "update_checkout_list":
			case "delete_checkout_list_view":{
				if(response !=false){
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['cart', 'fetch_checkout_list']));
				}
				break;
			}
		}
	}
	var _image_pop_up = function(){
		let t = [ '<span class="icon icon-chevron-left"></span>', '<span class="icon icon-chevron-right"></span>' ];
		let refresh = $('.owl-product-gallery').owlCarousel({
	        	autoHeight: !0,
	        	slideSpeed: 800,
	       		navigation: !0,
	       		pagination: !0,
	       		navigationText: t,
	       		items: 1,
	       		loop: false,
	        	singleItem: !0
	   	 });
	   	 $(".open-popup-gallery").magnificPopup({
				 delegate: "a",
				 type: "image",
				 tLoading: "Loading image #%curr%...",
				 gallery: {
					 enabled: !0,
	    				navigateByImgClick: !0,
	   				 preload: [ 0, 1 ]
					},
	    		fixedContentPos: !1,
	    		fixedBgPos: !0,
	   		 overflowY: "auto",
	    		closeBtnInside: !0,
	    		preloader: !1,
	    		midClick: !0,
	    		removalDelay: 300,
	    		mainClass: "my-mfp-zoom-in"
			 });
		refresh.trigger('refresh.owl.carousel');	
	}
    var _constructForm = function(args){
          let formData = new FormData();
          for (var i = 1; (args.length+1) > i; i++){
             formData.append('data'+ i, args[i-1]);
           }  
          return formData;
    };
    var _constructBlockUi = function(type, element, message){
          let formData = new FormData();
           formData.append('type', type);
           formData.append('element', element);
           formData.append('message', message);
           if(formData){
             return formData;
           }
    };
    var _ajaxrequest = async function(blockUi, formData){
      return new Promise((resolve, reject) => {
             let y = true;
             $.ajax({
              url: baseURL+'Website_controller/Controller',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              dataType: "json",
              beforeSend: function(){
                // if(blockUi.get("type") == "blockPage"){
                //    if(blockUi.get("message") != "false"){
                //       KTApp.blockPage({
                //       overlayColor: '#000000',
                //       state: 'primary',
                //       message: blockUi.get("message")
                //      });
                //    }else{
                //       KTApp.blockPage();
                //    }
                // }else if(blockUi.get("type") == "blockContent"){
                //       KTApp.block(blockUi.get("element"));
                // }else{
                // }
              },
              complete: function(){
                // if(blockUi.get("type") == "blockPage"){
                //   KTApp.unblockPage();
                // }else if(blockUi.get("type") == "blockContent"){
                //   KTApp.unblock(blockUi.get("element"));
                // }else{
                // }
                 resolve(y)
              },
              success: function(res){
                 if(res.status == 'success'){
                    if(window.atob(res.payload) != false){
                      _construct(JSON.parse(window.atob(res.payload)), formData.get("data2"));
                    }else{
                      _construct(res.message, formData.get("data2"));
                    }
                 }else if(res.status == 'not_found'){
                    Swal.fire("Ops!", res.message, "info");
                 }else{
                    Swal.fire("Ops!", res.message, "info");
                 } 
              },
              error: function(xhr,status,error){
                if(xhr.status == 500){
                  Swal.fire("Ops!", 'Internal error: ' + xhr.responseText, "error");
                }else{
                  console.log(xhr);
                  console.log(status);
                  swal("Ops!", 'Something went wrong..', "error");
                }
              }       
        });      
       })
    };
	return {
		//main function to initiate the module
		init: function(){
			_check_url(window.location.pathname);
			categories();
			cart_list();
			footer();
			_initImageView();
			sessionStorage.clear();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClientweb.init();
});