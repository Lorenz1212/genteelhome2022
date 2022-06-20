'use strict';
var KTAjaxClient = function() {
	var val;
	var _initremovetable = function(action){
		$(""+action+"").on("click", "#DeleteButton", function() {
			   $(this).closest("tr").remove();
		});
	}
	var _initDecimal_format = function(action){
		 // currency format
		 $(""+action+"").inputmask('decimal', {
		   numericInput: true,
		   rightAlignNumerics: true
		 }); //123456  =>  € ___.__1.234,56
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
	var _initDatepicker = function(action){
		  $('#'+action).datepicker({
		   rtl: KTUtil.isRTL(),
		   orientation: "bottom left",
		   todayHighlight: true,
		   templates: arrows
		  });
	}
	var moneyFormat = function(price) {
	  const pieces = parseFloat(price).toFixed(2).split('')
	  let ii = pieces.length - 3
	  while ((ii-=3) > 0) {
	    pieces.splice(ii, 0, ',')
	  }
	  return pieces.join('')
	}
	var _initAvatar = function (action) {
		_avatar = new KTImageInput(''+action+'');
	}
	var _initEmail_Option = function(id){
		 $.ajax({
	             url: baseURL + 'option_controller/email_option',
	             type: "POST",
	             data:{id:id},
	             dataType:"json",
	             beforeSend: function()
	            {
	                 
	            },
                  complete: function(){
                      
                  },
                  success: function(response)
                  {	  
                  	if(response.status == 'success'){
                  		$('.message_email').html('');
                  	}else{
                  		$('.message_email').html('This Email is already Used').css('color', 'red');
                  	}
                  }                                    
		});	
	}
	var _initRegion_Option = function(){
		 $.ajax({
	             url: baseURL + 'option_controller/region_option',
	             type: "POST",
	             dataType:"json",
	             beforeSend: function()
	            {
	                 
	            },
                  complete: function(){
                      
                  },
                  success: function(response)
                  {	  
                  	for(let i=0;i<response.length;i++){
                  		$('#region').append('<option value="'+response[i].id+'">'+response[i].name+'</option>')
                  	}
                  }                                    
		});	
	}
	var _initShipping_Option = function(id){
		 $.ajax({
	             url: baseURL + 'option_controller/shipping_option',
	             type: "POST",
	             data:{id:id},
	             dataType:"json",
	             beforeSend: function()
	            {
	                 
	            },
                  complete: function(){
                      
                  },
                  success: function(response)
                  {	  
                  	$('#shipping').text(response.shipping_range);
                  	$('#region_name').text(response.region);
                  	$('#shipping_fee').text('('+response.shipping_range+')');
                  }                                    
		});	
	}
	var _initCoupon = function(){
		 $.ajax({
	             url: baseURL + 'website_controller/Coupon_Promo',
	             type: "POST",
	             dataType:"json",
	             beforeSend: function()
	            {
	                 
	            },
                  complete: function(){
                      
                  },
                  success: function(response)
                  {	  
                  	var html ='';
                  	html +=' <table class="table table-striped table-condensed table-hover">'
                         +'   <thead>'
                         +'      <tr>'
                         +'        <th style="text-align:center;"></th>'
                         +'        <th>Promo Code</th>'
                         +'        <th style="text-align:center;">Discount</th>'
                         +'        <th style="text-align:right;">Expiration Date</th>'
                         +'       </tr>'
                         +' </thead><tbody>';
                         html +='<tr>'
					 +'	<td width="50" style="text-align:center;vertical-align: middle;"><button type="button" class="btn btn-clean-dark btn-sm" id="btn_use" data-discount="0" data-code="">None</button></td>'
					 +'	<td width="50" colspan="4"></td>'
					 +'</tr>';	
	  			for(let i=0;i<response.length;i++){
	  			var discount = parseFloat((response[i].discount*100)/1);
	  			html +='<tr>'
					 +'	<td width="50" style="text-align:center;vertical-align: middle;"><button type="button" class="btn btn-info btn-sm" id="btn_use" data-discount="'+response[i].discount+'" data-code="'+response[i].promo_code+'">Use</button></td>'
					 +'	<td width="50">'+response[i].promo_code+'</td>'
					 +'	<td width="50"  style="text-align:center;vertical-align: middle;">'+discount+'%</td>'
					 +'	<td width="100" style="text-align:right;vertical-align: middle;">'+response[i].date_to+'</td>'
					 +'</tr>';			 
	  			}
	  			html +='</tbody></table>';
	  			$('#coupon_table').html(html);
	  			 $(document).on('click','#btn_use',function(){
					let discount = $(this).attr('data-discount');
					let code = $(this).attr('data-code');
					$('#coupons').val(code).attr('data-promo',discount);
					let amount = $('#subtotal').text().replace(',', '');
					let t_disc = parseFloat(amount*discount);
					let total = parseFloat(amount-t_disc);
					let dis = parseFloat((discount*100)/1);
					$('#total').text(total.toLocaleString());
					$('#discount').text(dis+'%');
					$('.mfp-close').trigger('click');
				});   

                  }                                    
		});	
	}

	var _ajaxloader = async function(thisURL,type,val,sub){
		  $.ajax({
	             url: baseURL + thisURL,
	             type: type,
	             data: val,
	             dataType:"json",
	             beforeSend: function()
	             {
	              
	             },
                 complete: function(){
                   
                  },
                  success: function(response)
                  {
                  	_initView(sub,response);
                  },
                 error: function(xhr,status,error){
	                 console.log(xhr);
	                 console.log(status);
	                 console.log(error);
	                 console.log(xhr.responseText);
                 }                                      
		});	
	}
	var _initheader = function(){
		let header = 'website_controller/header';
		_ajaxloader(header,"POST",false,"header");
	}
	var _initfooter = function(){
		let footer = 'website_controller/footer';
		_ajaxloader(footer,"POST",false,"footer");
	}
	var _initnotification = function(){
		let footer = 'website_controller/notification';
		_ajaxloader(footer,"POST",false,"notification");
	}
	var _ViewController = async function(view){
		switch(view){
			case "data-index":{
				let thisUrl = 'website_controller/index';
				_ajaxloader(thisUrl,"POST",false,"index");
				 $(document).ready(function() {
				  	$("#btn_view").click(function () {
		  		   	 	var url = $(location).attr('href');
						var segments = url.split( '/' );
						var id = atob(segments[8]);
						var action = atob(segments[7]);
						let val = {id:id,action:action};
						let thisUrl = 'website_controller/product_list';
						_ajaxloader(thisUrl,"POST",val,"product-list");
					});
				  });
				break;
			}
			case "data-account":{
				let thisUrl = 'website_controller/account';
				_ajaxloader(thisUrl,"POST",false,"account");
				break;
			}
			case "data-events":{
				let thisUrl = 'website_controller/events';
				_ajaxloader(thisUrl,"POST",false,"events");
				break;
			}
			case "data-product-list":{
				 $(document).ready(function() {
				 	_initNumberOnly('#qty');
				 	var url = $(location).attr('href');
					var segments = url.split( '/' );
					var id = atob(segments[8]);
					var action = atob(segments[7]);
					let val = {id:id,action:action};
					let thisUrl = 'website_controller/product_list';
					_ajaxloader(thisUrl,"POST",val,"product-list");
		
				  });
				break;
			}
			case "data-interior-list":{
				 $(document).ready(function() {
				 	var url = $(location).attr('href');
					var segments = url.split( '/' );
					var id = atob(segments[7]);
					let val = {id:id};
					let thisUrl = 'website_controller/interior_list';
					_ajaxloader(thisUrl,"POST",val,"interior-list");
				  });
				break;
			}
			case "data-interior-article":{
				 $(document).ready(function() {
				 	var url = $(location).attr('href');
					var segments = url.split( '/' );
					var id = atob(segments[8]);
					let val = {id:id};
					let thisUrl = 'website_controller/interior_detail';
					_ajaxloader(thisUrl,"POST",val,"interior-article");
		
				  });
				break;
			}
			case "data-product-arrival":{
				 $(document).ready(function() {
				 	_initNumberOnly('#qty');
					let thisUrl = 'website_controller/product_arrival';
					_ajaxloader(thisUrl,"POST",false,"product-arrival");
		
				  });
				break;
			}
			case "data-product-stocks":{
				 $(document).ready(function() {
				 	_initNumberOnly('#qty');
					let thisUrl = 'website_controller/product_stocks';
					_ajaxloader(thisUrl,"POST",false,"product-stocks");
		
				  });
				break;
			}
			case "data-product-collection":{
				 $(document).ready(function() {
				 	_initNumberOnly('#qty');
					let thisUrl = 'website_controller/product_collection';
					_ajaxloader(thisUrl,"POST",false,"product-collection");
		
				  });
				break;
			}
			case "data-product-details":{
				 $(document).ready(function() {
				 	_initNumberOnly('#qty');
				 	var url = $(location).attr('href');
					var segments = url.split( '/' );
					var id = atob(segments[8]);
					var action = atob(segments[7]);
					let val = {id:id,action:action};
					let thisUrl = 'website_controller/product_details';
					_ajaxloader(thisUrl,"POST",val,"product-details");
		
				 });
				break;
			}
			case "data-cart":{
				$(document).ready(function() {
					let thisUrl = 'website_controller/Cart_Product';
					_ajaxloader(thisUrl,"POST",val,"Cart_Product");
				 });
				break;
			}
			case "data-registration":{
				 $(document).ready(function() {
				 	$("#btn_registration").click(function () {
		  		   	 	var name = $(this).attr('data-name');
		  		   	 	$('#title').text(name)
					});
					$("#btn_login").click(function () {
		  		   	 	var name = $(this).attr('data-name');
		  		   	 	$('#title').text(name)
					});
				       $(document).on('blur','.password',function(){
				      	 var password= $(this).val();
            				if(!password){
            					$(this).focus();
            					$('.password_message').html('Please Input Your Password').css('color', 'red');
            				}else{
            					$('.password_message').html('');
            				}
				      });
				       $(document).on('blur','.confirm_password',function(){
            				var confirm_password = $(this).val();
            				var password  = $('.password').val();
            				if(password == confirm_password){
            					$('.confirm_password_message').html('Matching').css('color', 'green');
            				}else{
            					$('.confirm_password_message').html('Not Matching').css('color', 'red');
            				}
				      });
				       $(document).on('blur','.email',function(){
				      	 var email= $(this).val();
            				if(!email){
            					$(this).focus();
            					$('.message_email').html('Please Input Your Email').css('color', 'red');
            				}else{
            					_initEmail_Option(email);
            					$('.message_email').html('');
            				}
				      });
				  //     $(document).on('blur','#confirm_email',function(){
				  //     	 var confirm_email= $(this).val();
      //       				 var email 	= $('.email').val();
						// if(email == confirm_email){
      //       					$('.confirm_email').html('Matching').css('color', 'green');
      //       				}else{
      //       					$('.confirm_email').html('Not Matching').css('color', 'red');
      //       				}
				  //     });
				     $(document).on('click','.btn_email',function(){
				 	   	let email = $('input[name=email_address]').val();
				 	   	let confirm_email = $('#confirm_email').val();
				 	   	let firstname = $('input[name=firstname]').val();
				 	   	if(email == confirm_email){
            						let thisUrl = 'website_controller/verification_code';
					 	   	let val = {email:email,firstname:firstname};
							_ajaxloader(thisUrl,"POST",val,"forgotpassword");
	            				}else{
	            					$('.confirm_email').html('Not Matching').css('color', 'red');
	            				}
			 	   	});
				 });
				break;
			}
			case "data-checkout":{
				$(document).ready(function() {
					let thisUrl = 'website_controller/CheckOut_Product';
					_ajaxloader(thisUrl,"POST",false,"CheckOut_Product");
				});
				break;
			}
			case "data-deposit":{
				$(document).ready(function() {
					_initCurrency_format('input[name=amount]');
				});
				break;
			}
			case "data-about":{
				$(document).ready(function() {
					let thisUrl = 'website_controller/About_Us';
					_ajaxloader(thisUrl,"POST",false,"About_Us");
				});
				break;
			}
			case "data-privacy":{
				$(document).ready(function() {
					let thisUrl = 'website_controller/About_Us';
					_ajaxloader(thisUrl,"POST",false,"About_Us");
				});
				break;
			}
			 case "data-forgotpassword":{
			 	$(document).ready(function(){
			 	   $('.btn_email').on('click',function(){
			 	   	let email = $('.email').val();
			 	   	let thisUrl = 'website_controller/email_validation';
			 	   	let val = {email:email};
					_ajaxloader(thisUrl,"POST",val,"forgotpassword");
			 	   });
			 	   $('.verify_code').on('click',function(){
			 	   	let email = $('.email').val();
			 	   	let code = $('input[name=code]').val();
					let con_code = $('input[name=code]').attr('data-code');
					if(code == atob(con_code)){
					   swal("Verification Code Successfully Matched", "Thank you!", "success").then(function() {
						window.location = baseURL + 'gh/app/new-password/'+con_code+'/'+btoa(email);
					    });
					}else{
					    swal("Invalid Code", "Sorry, the verification code you entered does not match!", "info");
					}
			 	   });
			 	});
			 	break;
			 }
		}
	}

	var _initView = async function(view,response)
	{
	  switch(view){
	  	case "account":{
	  		$(document).ready(function() {
	  			_initRegion_Option();
	  			$('#firstname').val(response.firstname);
	  			$('#lastname').val(response.lastname);
	  			$('#mobile').val(response.mobile);
	  			$('#address').val(response.address);
	  			$('#city').val(response.city);
	  			$('#province').val(response.province);
	  			$('#region').val(response.region).change();
	  		});
	  		break;
	  	}
	  	case "header":{
	  		$(document).ready(function() {
		  		var groups = {};
				for (var i = 0; i < response.length; i++) {
					  var groupName = response[i].cat_name;
					  if (!groups[groupName]) {
					    groups[groupName] = [];
					  }
					  groups[groupName].push(response[i].sub_name);
				}
				response = [];
				for (var groupName in groups) {
				  response.push({group: groupName, color: groups[groupName]});
				}
		  		for(let i=0;i<response.length;i++){
		  			var responses = response[i].color.filter(function (el) {return el != null;});
		  			var html ="";
		  			html +='<div class="col-md-3"><ul><li class="label">'+response[i].group+'</li>';
				    for(let s =0;s<responses.length;s++){
				    	 html +='<li><a href="'+baseURL+'gh/app/product-list/'+btoa('subcaterogy')+'/'+btoa(response[i].color[s])+'">'+response[i].color[s]+'</a></li>';
				    }
				    html +='</ul></ul>';
				    $('#category_nav').append(html);
		  		}
	  		});
	  	   break;
	  	}
	  	case "footer":{
  		 	$("#product_cart_add").empty();
	  		for (var i = 0;i<response.data.length; i++) {
	  			_initNumberOnly('#qtys'+response.data[i].id);
	  			$('#product_table').append('<tr id="delete_row'+response.data[i].id+'">'
	  							 +'	<td><img src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt="" style="width:60;height:60px;"></td>'
	  							 +'	<td width="200"><div class="title"><div>'+response.data[i].title+'</div><small> '+response.data[i].c_name+'</small></div></td>'
	  							 +'	<td ><div class="quantity"><input type="number" min="1" style="text-align:center;" id="qtys'+response.data[i].id+'" data-qty="'+response.data[i].qty+'" data-id="'+response.data[i].id+'" class="form-control form-quantity qtys'+response.data[i].id+'"></div></td>'
	  							 +'	<td width="100" style="text-align:right;"><div class="price"><span class="final"><span class="cart_price'+response.data[i].id+'" data-amount="'+response.data[i].c_price+'" data-price="'+response.data[i].price+'" id="cart_price'+response.data[i].id+'"></span></span></div></td>'
	  							  +'	<td width="50"  style="text-align:center;"><span class="icon icon-cross icon-delete" id="delete_cart'+response.data[i].id+'" data-id="'+response.data[i].id+'" style="cursor:pointer;"></span></td>'
	  							 +'</tr>');
	  			$('#cart_price'+response.data[i].id).text(response.data[i].price);
	  			$('#qtys'+response.data[i].id).val(response.data[i].qty);
	  			$("#delete_cart"+response.data[i].id).click(function () {
						var id = $(this).attr('data-id');
						var val = {id:id};
						var thisURL = 'delete_controller/Delete_Web_Cart';
						 _ajaxloader(thisURL,"POST",val,false,false);
						 swal({title: "Removed!",text: "Item Removed!",icon: "error",}).then(function() {
						 	$('#delete_row'+id).remove();
						 	$('#delete_rowww'+id).remove();
						 });	
				});
				 $(document).on('input','.qtys'+response.data[i].id,function(){
					var qty   = $(this).val();
					var id    = $(this).attr('data-id');
					var amount = $('.cart_price'+id).attr('data-amount');
					let total = parseFloat(qty*amount);
						 $(document).on('blur','.qtys'+id,function(){
						 	var q = $(this).attr('data-qty');
						 	var price = $('.cart_price'+id).attr('data-price');
						 	if(!qty){
							  $('#qtys'+id).val(q);
							  $('#cart_price'+id).text(price);
							  $('#cart_prices'+id).text(price);
	  						  $('#qtyss'+id).val(q);
							   let thisUrls = 'website_controller/Update_Product_Cart';
							   let vals = {id:id,qty:q,total:price}
							   _ajaxloader(thisUrls,"POST",vals,false);
							}
						 })
					$('#cart_prices'+id).text(total.toLocaleString());
	  				$('#qtyss'+id).val(qty);
					$('#cart_price'+id).text(total.toLocaleString());
					let thisUrl = 'website_controller/Update_Product_Cart';
					let val = {id:id,qty:qty,total:total}
					_ajaxloader(thisUrl,"POST",val,false);
				});
			}
	  		
	  		
	  		$('#facebook').attr('href',response.row.facebook);
	  		$('#youtube').attr('href',response.row.youtube);
	  		$('#tweeter').attr('href',response.row.tweeter);

	  		$('#instagram').text(response.row.instagram);
	  		$('#email').text(response.row.email);
	  		$('#mobile').text(response.row.mobile);
	  		$('#company').text(response.row.company);
	  		$('#address').text(response.row.address);
	  		$('#storeopen').text(response.row.store_open);

	  		$('#mobile_contact').text(response.row.mobile);
	  		$('#company_contact').text(response.row.company);
	  		$('#address_contact').text(response.row.address);
	  		$('#store_open').text(response.row.store_open);
	  		break;	
	  	}
	  	case "index":{
	  		$('.product_index').empty();
	  		for(let i=0;i<response.data.length;i++){	
	  		   	 $('.product_index').append('<div class="col-md-4 col-xs-6">'
                              +'  <article>'
                              +'      <div class="info">'
                              +'      </div>'
                              +'      <div id="btn_trigger'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" data-title="Quick wiew" style="cursor:pointer;" class="btn btn-add">'
                              +'          <i class="icon icon-cart"></i>'
                              +'      </div>'
                              +'      <div class="figure-grid">'
                              +'          <div class="image">'
                              +'              <a href="#productid1" id="btn_triggers'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="mfp-open">'
                              +'                  <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt="" />'
                              +'              </a>'
                              +'          </div>'
                              +'          <div class="text">'
                              +'              <h2 class="title h4"><a href="product.html">'+response.data[i].title+'</a></h2>'
                              +'              <span class="description clearfix"></span>'
                              +'          </div>'
                              +'      </div>'
                              +'  </article>'
                              +'</div>');

	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_trigger"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 	$("#btn_triggers"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   }
	  		   $('.events').empty();
	  		for(let i=0;i<response.event.length;i++){	
	  		   	 $('#events').append(' <div class="col-sm-4">'
					               +'    <article>'
					               +'         <div class="image">'
					               +'             <img src="'+baseURL+'assets/images/events/'+response.event[i].image+'" alt="" />'
					               +'         </div>'
					               +'         <div class="entry entry-block">'
					               +'                <div class="title">LOCATION :'+response.event[i].location+'</div>'
					               +'             <div class="date">'+response.event[i].date_event+' || '+response.event[i].time_event+'</div>'
					               +'                <div class="title"><h2 class="h3">'+response.event[i].title+'</h2></div>'
					               +'             <div class="description">'
					               +'                 <p>'+response.event[i].description+'</p>'
					               +'             </div>'
					               +'         </div>'
					               +'   </article>'
					               +'</div>');	
	  		   }
	  		break;
	  	}

	  	case "product-list":{

	  		if(!response == false){
	  			$('#btn_cat').empty();
	  		   if(response.action == 'category'){
	  		   	$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
                					+'<li><a class="active">'+response.cat_name+'</a></li>');
	  		   }else if(response.action == 'subcaterogy'){
	  		   	$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
                					+'<li><a href="'+baseURL+'gh/app/product-list/'+btoa('category')+'/'+btoa(response.cat_name)+'">'+response.cat_name+'</a></li>'
                					+'<li><a class="active">'+response.sub_name+'</a></li>');
	  		   }else{
	  		   	$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
                					+'<li><a class="active">'+response.cat_name+'</a></li>');
	  		   }
	  		   $('.product_list').empty();
	  		   if(!response.data){
	  		   	  $('.product_list').append('<div class="col-md-12 col-xs-12">\
	  		   	  	 <section class="history">\
           				 <div class="container">\
				  	<div class="row row-block">\
			                    <div class="col-md-7 history-desc">\
			                        <p>  <h1 class="title" data-title="Page not found!">Oops</h1>\
						                    <div class="h4 subtitle">No Product Available</div>\
						                <p>The requested product was not available on this category. That’s all we know.</p>\
						                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
			                	</div>\
			                </div>\
			            <div>\
                       	</div>');
	  		   }else{
	  		   	for(let i=0;i<response.data.length;i++){	
	  		   	 $('.product_list').append('<div class="col-md-4 col-xs-6">'
                              +'  <article>'
                              +'      <div class="info">'
                              +'      </div>'
                              +'      <div id="btn_trigger'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="btn btn-add" style="cursor:pointer;">'
                              +'          <i class="icon icon-cart"></i>'
                              +'      </div>'
                              +'      <div class="figure-grid">'
                              +'          <div class="image">'
                              +'              <a id="btn_triggers'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="mfp-open">'
                              +'                  <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt=""/>'
                              +'              </a>'
                              +'          </div>'
                              +'          <div class="text">'
                              +'              <h2 class="title h4"><a>'+response.data[i].title+'</a></h2>'
                              +'              <span class="description clearfix"></span>'
                              +'          </div>'
                              +'      </div>'
                              +'  </article>'
                              +'</div>');

	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_trigger"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_triggers"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   }
	  		   }
	  		   
	  		}else{
  			   
	  		}
	  		break;
	  	}
	  	case "product-arrival":{
	  		if(!response == false){
	  		   $('.product_list').empty();
	  		   if(!response.data){
	  		   	 $('.product_list').append('<div class="col-md-12 col-xs-12">\
	  		   	  	 <section class="history">\
           				 <div class="container">\
				  	<div class="row row-block">\
			                    <div class="col-md-7 history-desc">\
			                       <p>  <h1 class="title" data-title="Page not found!">Oops</h1>\
						                    <div class="h4 subtitle">No New Arrival Product Available</div>\
						                <p>The requested collection was not available on this category. That’s all we know.</p>\
						                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
			                    		</div>\
			                	</div>\
			                </div>\
			            <div>\
                       	</div>');
	  		   }else{
	  		   	   for(let i=0;i<response.data.length;i++){	
	  		   	 $('.product_list').append('<div class="col-md-4 col-xs-6">'
                              +'  <article>'
                              +'      <div class="info">'
                              +'      </div>'
                              +'      <div id="btn_trigger'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="btn btn-add" style="cursor:pointer;">'
                              +'          <i class="icon icon-cart"></i>'
                              +'      </div>'
                              +'      <div class="figure-grid">'
                              +'          <div class="image">'
                              +'              <a id="btn_triggers'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="mfp-open">'
                              +'                  <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt=""/>'
                              +'              </a>'
                              +'          </div>'
                              +'          <div class="text">'
                              +'              <h2 class="title h4"><a>'+response.data[i].title+'</a></h2>'
                              +'              <span class="description clearfix"></span>'
                              +'          </div>'
                              +'      </div>'
                              +'  </article>'
                              +'</div>');

	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_trigger"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_triggers"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   	}
	  		   }
	  		}
	  		break;
	  	}
	  	case "product-stocks":{
	  		if(!response == false){
	  		   $('.product_list').empty();
	  		   for(let i=0;i<response.data.length;i++){	
	  		   	 $('.product_list').append('<div class="col-md-4 col-xs-6">'
                              +'  <article>'
                              +'      <div class="info">'
                              +'      </div>'
                              +'      <div id="btn_trigger'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="btn btn-add" style="cursor:pointer;">'
                              +'          <i class="icon icon-cart"></i>'
                              +'      </div>'
                              +'      <div class="figure-grid">'
                              +'          <div class="image">'
                              +'              <a id="btn_triggers'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="mfp-open">'
                              +'                  <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt=""/>'
                              +'              </a>'
                              +'          </div>'
                              +'          <div class="text">'
                              +'              <h2 class="title h4"><a>'+response.data[i].title+'</a></h2>'
                              +'              <span class="description clearfix"></span>'
                              +'          </div>'
                              +'      </div>'
                              +'  </article>'
                              +'</div>');

	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_trigger"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_triggers"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   }
	  		   
	  		}
	  		break;
	  	}
	  	case "product-collection":{
	  		if(!response == false){
	  		    if(!response.data){
	  		   	 $('.product_list').append('<div class="col-md-12 col-xs-12">\
	  		   	  	 <section class="history">\
           				 <div class="container">\
				  	<div class="row row-block">\
			                    <div class="col-md-7 history-desc">\
			                       <p>  <h1 class="title" data-title="Page not found!">Oops</h1>\
						                    <div class="h4 subtitle">No Product Collection Available</div>\
						                <p>The requested collection was not available on this category. That’s all we know.</p>\
						                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
			                    		</div>\
			                	</div>\
			                </div>\
			            <div>\
                       	</div>');
	  		   }else{
	  		   $('.product_list').empty();
	  		   for(let i=0;i<response.data.length;i++){	
	  		   	 $('.product_list').append('<div class="col-md-4 col-xs-6">'
                              +'  <article>'
                              +'      <div class="info">'
                              +'      </div>'
                              +'      <div id="btn_trigger'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="btn btn-add" style="cursor:pointer;">'
                              +'          <i class="icon icon-cart"></i>'
                              +'      </div>'
                              +'      <div class="figure-grid">'
                              +'          <div class="image">'
                              +'              <a id="btn_triggers'+response.data[i].project_no+'" data-id="'+response.data[i].project_no+'" class="mfp-open">'
                              +'                  <img class="wp-block-cover-images" style="width: 100%;" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt=""/>'
                              +'              </a>'
                              +'          </div>'
                              +'          <div class="text">'
                              +'              <h2 class="title h4"><a>'+response.data[i].title+'</a></h2>'
                              +'              <span class="description clearfix"></span>'
                              +'          </div>'
                              +'      </div>'
                              +'  </article>'
                              +'</div>');

	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_trigger"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   	 	$(document).ready(function() {
		  		   	 	$("#btn_triggers"+response.data[i].project_no).click(function () {
		  		   	 		 let id = $(this).attr('data-id');
							 $("#btn_modal").trigger('click');
							 let thisUrl = 'website_controller/product_modal';
							 let val = {id:id}
							_ajaxloader(thisUrl,"POST",val,"product-modal");
						 });
		  		   	 });	
	  		   }
	  			}
	  		   
	  		}
	  		break;
	  	}
	  	case "product-modal":{
	  		$(document).ready(function() {
	  		      $('#title').text(response.title);
	  		      $('#title1').text(response.title);
	  		      
	  		      $('#product_color').empty();
	  		      $('#product_color_pre').empty();
		  		for(let i=0;i<response.data.length;i++){
		  			if(response.data[i].stocks  == 0){
		  			   $('#product_color_pre').append('<img data-action="Pre Order" class="color-btn" id="btn_cname'+response.data[i].c_code+'" data-id="'+response.data[i].c_code+'" data-name="'+response.data[i].c_name+'" src="'+baseURL+'assets/images/palettecolor/'+response.data[i].c_image+'"/>');
		  			}else{
		  			   $('#product_color').append('<img data-action="In Stocks" class="color-btn" id="btn_cname'+response.data[i].c_code+'" data-id="'+response.data[i].c_code+'" data-name="'+response.data[i].c_name+'" src="'+baseURL+'assets/images/palettecolor/'+response.data[i].c_image+'"/>');
		  			}
	  		   	 	$("#btn_cname"+response.data[i].c_code).click(function () {
	  		   	 		 let id 	= $(this).attr('data-id');
	  		   	 		 let c_name = $(this).attr('data-name');
	  		   	 		 let action = $(this).attr('data-action');
	  		   	 		 $('#project_href').attr('href',baseURL+'gh/app/product-details/'+btoa('_details')+'/'+btoa(response.project_no)+'/'+btoa(c_name));
	  		   	 		 $('#c_name').text(c_name);
	  		   	 		 $('#product_order').text(action);
						 let val = {id:id}
						 let thisUrl = 'website_controller/product_image_modal';
						_ajaxloader(thisUrl,"POST",val,"product-image-modal");
					 });
		  		}
		  		$("#btn_cname"+response.data[0].c_code).trigger('click');

	  	      });
	  		break;
	  	}
	  	case "product-image-modal":{
	  		if(!response == false){
	  			$('#price').text(response.price);
  			  	let html="";
  			  	let html1="";
  			  	let container = $('.modal_image');
  			  	let container1 = $('.modal_image1');
      				for(let i=0;i<response.data.length;i++){
  				 html +='<img src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt="" width="340">';
  				 html1 +='<a href="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'">\
  				 <img src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt="" height="500"></a>';
  				}
				container.html('<div class="owl-product-gallery owl-carousel owl-theme" style="opacity: 1; display: block;">\
                      	'+html+'');
                      	container1.html('<div class="owl-product-gallery open-popup-gallery owl-carousel owl-theme">\
                      	'+html1+'');

                            let t = [ '<span class="icon icon-chevron-left"></span>', '<span class="icon icon-chevron-right"></span>' ];
	  			$('.owl-product-gallery').owlCarousel({
		            		autoHeight: !0,
		            		slideSpeed: 800,
		           		navigation: !0,
		           		pagination: !0,
		           		navigationText: t,
		           		items: 1,
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

	  		}
	  		break;
	  	}

	  	case "product-details":{
	  		$(document).ready(function() {
	  			$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
                					+'<li><a href="'+baseURL+'gh/app/product-list/'+btoa('category')+'/'+btoa(response.cat_name)+'">'+response.cat_name+'</a></li>'
                					+'<li><a href="'+baseURL+'gh/app/product-list/'+btoa('subcaterogy')+'/'+btoa(response.sub_name)+'">'+response.sub_name+'</a></li>'
                					+'<li><a class="active">'+response.title+'</a></li>');
	  		      $('#title').text(response.title);
	  		      $('#title1').text(response.title);
	  		      $('#c_name1').text(response.title);
	  		      $('#project_no').attr('data-id',response.project_no);
	  		      $('#sub_name').attr('data-title',response.sub_name);
	  		      $('#product_color').empty();
	  		      $('#product_color_pre').empty();
	  		      $('#tearsheet').attr('href',baseURL+'assets/images/tearsheet/'+response.tearsheet);
		  		for(let i=0;i<response.data.length;i++){
		  			if(response.data[i].stocks  == 0){
		  			   $('#product_color_pre').append('<img data-action="Pre Order" class="color-btn" id="btn_cname'+response.data[i].c_code+'" data-id="'+response.data[i].c_code+'" data-name="'+response.data[i].c_name+'" src="'+baseURL+'assets/images/palettecolor/'+response.data[i].c_image+'"/>');
		  			}else{
		  			   $('#product_color').append('<img data-action="In Stocks" class="color-btn" id="btn_cname'+response.data[i].c_code+'" data-id="'+response.data[i].c_code+'" data-name="'+response.data[i].c_name+'" src="'+baseURL+'assets/images/palettecolor/'+response.data[i].c_image+'"/>');
		  			}
	  		   	 	$("#btn_cname"+response.data[i].c_code).click(function () {
	  		   	 		 let id 	= $(this).attr('data-id');
	  		   	 		 let c_name = $(this).attr('data-name');
	  		   	 		 let action = $(this).attr('data-action');
	  		   	 		 $('#c_name').text(c_name);
	  		   	 		 $('#product_order').text(action);
						 let val = {id:id}
						 let thisUrl = 'website_controller/product_image_modal';
						 _ajaxloader(thisUrl,"POST",val,"product-image-modal");
						 let thisUrls = 'website_controller/product_gallery';
						 _ajaxloader(thisUrls,"POST",val,"product-gallery");
					 });
		  		}
		  		$("#btn_cname"+response.data[0].c_code).trigger('click');
		  		if(!response.collection){
		  		}else{
		  			$('#add_collection').trigger('click');
		  		}
	  	      });
	  		break;
	  	}
	  	case "product-gallery":{
	  		$('#gallery').empty();
	  		for(let i=0;i<response.data.length;i++){
	  			$('#gallery').append('<div class="col-md-3 col-xs-3">'
                        +'          <article>'
                        +'              <div class="figure-grid">'
                        +'                  <div class="image">'
                        +'                      <a>'
                        +'                          <img src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" alt="" width="360" />'
                        +'                      </a>'
                        +'                  </div>'
                        +'              </div>'
                        +'          </article>'
                        +'      </div>');
	  		}
	  		break;
	  	}
	  	case "Cart_Product":{
	  		$('#cart').empty();
	  		var html ='';
	  		html +=' <table class="table table-striped table-condensed table-hover" id="cart">'
                         +'   <thead>'
                         +'      <tr>'
                         +'        <th></th>'
                         +'        <th>Image</th>'
                         +'        <th>Product</th>'
                         +'        <th style="text-align:center;">Qty</th>'
                         +'        <th style="text-align:center;">Price</th>'
                         +'        <th style="text-align:center;">Remove</th>'
                         +'       </tr>'
                         +' </thead><tbody>';
                if(response){
	  		for(let i=0;i<response.length;i++){
	  			_initNumberOnly('#qtyss'+response[i].id);
	  			$('#cart_prices'+response[i].id).text(response[i].price);
	  			$('#qtyss'+response[i].id).val(response[i].qty);
	  			html +='<tr id="delete_row'+response.id+'">'
	  							 +'	<td width="50" style="text-align:center;vertical-align: middle;"><span class="checkbox"><input type="checkbox" id="checkIDa'+response[i].id+'" data-checked="'+response[i].id+'" ><label for="checkIDa'+response[i].id+'"></label></span></td>'
	  							 +'	<td width="50"><img src="'+baseURL+'assets/images/finishproduct/product/'+response[i].images+'" alt="" style="width:50;height:50px;"></td>'
	  							 +'	<td width="200" style="text-align:left;vertical-align: baseline;"><div class="title"><div>'+response[i].title+'</div><small> '+response[i].c_name+'</small></div></td>'
	  							 +'	<td width="50" style="text-align:center;vertical-align: middle;"><div class="quantity"><input type="number" min="1" id="qtyss'+response[i].id+'" data-qty="'+response[i].qty+'" data-id="'+response[i].id+'" value="'+response[i].qty+'" class="form-control form-quantity qtyss'+response[i].id+'" style="text-align:center;"></div></td>'
	  							 +'	<td width="100" style="text-align:center;vertical-align: middle;"><div class="price"><span class="final"><span class="cart_prices'+response[i].id+'" data-amount="'+response[i].c_price+'" data-price="'+response[i].price+'" id="cart_prices'+response[i].id+'">'+response[i].price+'</span></span></div></td>'
	  							 +'	<td width="50"  style="text-align:center;vertical-align: middle;"><span class="icon icon-cross icon-delete" id="delete_cartss'+response[i].id+'" data-id="'+response[i].id+'" style="cursor:pointer;"></span></td>'
	  							 +'</tr>';

	  			$("#delete_cartss"+response[i].id).click(function () {
						var id = $(this).attr('data-id');
						var val = {id:id};
						var thisURL = 'delete_controller/Delete_Web_Cart';
						 _ajaxloader(thisURL,"POST",val,false,false);
						 swal({title: "Removed!",text: "Item Removed!",icon: "error",}).then(function() {
						 	$('#delete_row'+response[i].id).remove();
						 	$('#delete_rowww'+response[i].id).remove();
						 });	
				});
				 $(document).on('input','.qtyss'+response[i].id,function(){
					var qty   = $(this).val();
					var id    = $(this).attr('data-id');
					var amount = $('.cart_prices'+id).attr('data-amount');
					let total = parseFloat(qty*amount);
						 $(document).on('blur','.qtyss'+id,function(){
						 	var q = $(this).attr('data-qty');
						 	var price = $('.cart_prices'+id).attr('data-price');
						 	if(!qty){
							  $('#qtys'+id).val(q);
							  $('#cart_price'+id).text(price);
							  $('#cart_prices'+id).text(price);
							  $('#qtyss'+id).val(q);
							   let thisUrls = 'website_controller/Update_Product_Cart';
							   let vals = {id:id,qty:q,total:price}
							   _ajaxloader(thisUrls,"POST",vals,false);
							}
						 })
					$('#qtys'+id).val(qty);
					$('#cart_price'+id).text(total.toLocaleString());
					$('#cart_prices'+id).text(total.toLocaleString());
					let thisUrl = 'website_controller/Update_Product_Cart';
					let val = {id:id,qty:qty,total:total}
					_ajaxloader(thisUrl,"POST",val,false);
				});
	  		   }
	  	       }else{
	  	       	html +='<tr><td style="vertical-align: middle;text-align:center;height:200px;" colspan="6"><h2>EMPTY CART</h2></td></tr>';
	  	       }
	  		html +='</tbody></table>';
	  		$('#cart').append(html);
	  		break;
	  	}
	  	case "CheckOut_Product":{
	  		var sum =0;
	  		$('#checkout').empty();
	  		var html ='';
	  		_initRegion_Option();
	  		$(document).on('change','select[name=region]',function(){
	  			var id = $(this).val();
	  			_initShipping_Option(id);
	  		});
	  		html +=' <table class="table table-striped table-condensed table-hover" id="check_cart">'
                         +'   <thead>'
                         +'      <tr>'
                         +'        <th style="text-align:center;">Remove</th>'
                         +'        <th>Image</th>'
                         +'        <th>Product</th>'
                         +'        <th style="text-align:center;">Qty</th>'
                         +'        <th style="text-align:right;">Price</th>'
                         +'       </tr>'
                         +' </thead><tbody>';
	  		for(let i=0;i<response.length;i++){
	  			_initNumberOnly('#qtyss'+response[i].id);
	  			$('#cart_prices'+response[i].id).text(response[i].price);
	  			$('#qtyss'+response[i].id).val(response[i].qty);
	  			html +='<tr id="delete_row'+response[i].id+'">'
	  							 +'	<td width="50" style="text-align:center;vertical-align: middle;"><span class="icon icon-cross icon-delete" id="delete_carts'+response[i].id+'" data-id="'+response[i].id+'" style="cursor:pointer;"></span></td>'
	  							 +'	<td width="50"><img src="'+baseURL+'assets/images/finishproduct/product/'+response[i].images+'" alt="" style="width:50;height:50px;"></td>'
	  							 +'	<td width="200" style="text-align:left;vertical-align: baseline;"><div class="title"><div>'+response[i].title+'</div><small> '+response[i].c_name+'</small></div></td>'
	  							 +'	<td width="50"  style="text-align:center;vertical-align: middle;"><div class="quantity"><input type="number" min="1" id="qtyss'+response[i].id+'" data-qty="'+response[i].qty+'" data-id="'+response[i].id+'" value="'+response[i].qty+'" class="form-control form-quantity qty_action qtyss'+response[i].id+'" style="text-align:center;"></div></td>'
	  							 +'	<td width="100" style="text-align:right;vertical-align: middle;"><div class="price"><span class="final"><span class="check_total cart_prices'+response[i].id+'" data-amount="'+response[i].c_price+'" data-price="'+response[i].price+'" id="cart_prices'+response[i].id+'">'+response[i].price+'</span></span></div></td>'
	  							 +'</tr>';
	  			 $(document).on('click','#delete_carts'+response[i].id,function(){				 
						var id = $(this).attr('data-id');
						var val = {id:id};
						var thisURL = 'website_controller/Update_Cart_Product';
						 _ajaxloader(thisURL,"POST",val,false,false);
						 swal({title: "Removed!",text: "Item Removed!",icon: "error",}).then(function() {
						 	$('#delete_row'+response[i].id).remove();
						 	 var sum = 0;
							 $(".check_total").each(function() {
							    let val = isNaN($(this).text().replace(',', '')) || $(this).text().replace(',', '').trim().length === 0 ? 0 : +$(this).text().replace(',', ''); // cast to number
							    sum += val; 
							 });
							 $('#subtotal').text(sum.toLocaleString());
							 let discount = $('#coupons').attr('data-promo');
							 let t_disc = parseFloat(sum*discount);
							 let totalSS = parseFloat(sum-t_disc);
							 $('#total').text(totalSS.toLocaleString());
						 });	
				});
				 $(document).on('input','.qtyss'+response[i].id,function(){
					var qty   = $(this).val();
					var id    = $(this).attr('data-id');
					var amount = $('.cart_prices'+id).attr('data-amount');
					let total = parseFloat(qty*amount);
						 $(document).on('blur','.qtyss'+id,function(){
						 	var q = $(this).attr('data-qty');
						 	var price = $('.cart_prices'+id).attr('data-price');
						 	if(!qty){
							  $('#cart_price'+id).text(price);
							  $('#cart_prices'+id).text(price);
							  $('#qtyss'+id).val(q);
							   let thisUrls = 'website_controller/Update_Product_Cart';
							   let vals = {id:id,qty:q,total:price}
							   _ajaxloader(thisUrls,"POST",vals,false);
							}
						 })
					$('#cart_prices'+id).text(total.toLocaleString());
					let thisUrl = 'website_controller/Update_Product_Cart';
					let val = {id:id,qty:qty,total:total}
					_ajaxloader(thisUrl,"POST",val,false);
				       var sum = 0;
					  $(".check_total").each(function() {
					    let val = isNaN($(this).text().replace(',', '')) || $(this).text().replace(',', '').trim().length === 0 ? 0 : +$(this).text().replace(',', ''); // cast to number
					    sum += val; 
					  });
					   var subtotal = $('#subtotal').text(sum.toLocaleString());
					   let discount = $('#coupons').attr('data-promo');
					   let t_disc = parseFloat(sum*discount);
					   let totalSS = parseFloat(sum-t_disc);
					   $('#total').text(totalSS.toLocaleString());
					 
				});   
	  		}
	  		html +='</tbody></table>';
	  		$('#checkout').append(html);
	  		 $('#coupon input[type="checkbox"]').change(function() {
			  if ($(this).is(":checked")) {
			  	$("#btn_modal").trigger('click');
			  	_initCoupon();
			      return;
			  }
			});
	  		$(".check_total").each(function(){
				sum += parseFloat($(this).text().replace(',', ''));
			});
			$('#subtotal').text(sum.toLocaleString());
			$('#total').text(sum.toLocaleString());
			$('#delivery_hide').hide();
			$('#payment_hide').hide();
			$('#back').hide();
			$('#coupon1_hide').hide();
			$(document).on('click','#next',function(){				 
	  			var nextt = $(this).attr('data-action');
	  			
				if(nextt == 'delivery'){
				  var rowCount = $('#check_cart tr').length - 1;
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
	  			   if(!b_address_message || !b_city_message || !b_province_message || !s_address_message || !s_city_message || !s_province_message || !region_message){
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
			$(document).on('click','#back',function(){				 
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
			 	var b_address = $('input[name=b_address]').val();
			 	var b_city = $('input[name=b_city]').val();
			 	var b_province = $('input[name=b_province]').val();
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
	  	case "interior-list":{
	  		if(!response == false){
	  			$('#btn_cat').empty();
	  			$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
	                			+'<li><a href="'+baseURL+'gh/app/interior">INTERIOR</a></li>'
	                			+'<li><a class="active" href="'+baseURL+'gh/app/interior-list/'+btoa(response.category)+'">'+response.category+'</a></li>');
	  			$('#interior_list').empty();
	  			 if(!response.data){
		  		   	 $('#interior_list').append('<div class="col-md-12 col-xs-12">\
		  		   	  	 <section class="history">\
	           				 <div class="container">\
					  	<div class="row row-block">\
				                    <div class="col-md-7 history-desc">\
				                        <p>  <h1 class="title" data-title="Page not found!">Oops</h1>\
						                    <div class="h4 subtitle">No Product Available</div>\
						                <p>The requested interior was not available on this category. That’s all we know.</p>\
						                <p>Click <a href="'+baseURL+'gh/app/index">here</a> to get to the front page? </p></p>\
				                    		</div>\
				                	</div>\
				                </div>\
				            <div>\
	                       	</div>');
	  		   }else{
	  			for(let i=0;i<response.data.length;i++){
	  				$('#interior_list').append(' <div class="col-sm-4 col-md-4">'
					                           +'     <article>'
					                           +'         <a href="'+baseURL+'gh/app/article/'+btoa(response.category)+'/'+btoa(response.data[i].project_name)+'">'
					                           +'             <div class="image" style="background-image:url('+baseURL+'assets/images/interior/'+response.data[i].image+')">'
					                           +'                 <img src="'+baseURL+'assets/images/interior/'+response.data[i].image+'" alt="" />'
					                           +'             </div>'
					                           +'             <div class="entry entry-table">'
					                           +'                 <div class="title">'
					                           +'                     <h2 class="h5">'+response.data[i].project_name+'</h2>'
					                           +'                 </div>'
					                           +'             </div>'
					                           +'         </a>'
					                           +'     </article>'
					                           +' </div>');	
	  			}
	  		   }
	  		}
	  		break;
	  	}
	  	case "interior-article":{
	  		if(!response == false){
	  			$('#btn_cat').empty();
	  			$('#btn_cat').append('<li><a href="'+baseURL+'gh/app/index"><span class="icon icon-home"></span></a></li>'
	                			+'<li><a href="'+baseURL+'gh/app/interior">INTERIOR</a></li>'
	                			+'<li><a  href="'+baseURL+'gh/app/interior-list/'+btoa(response.category)+'">'+response.category+'</a></li>'
	                			+'<li><a class="active">'+response.project_name+'</a></li>');
	  			$('#project_name').text(response.project_name);
	  			$('#description').html(response.row.description);
	  			$('#image').attr('style','background-image: -webkit-linear-gradient(rgba(0,0,0, 0) 0%,rgba(0,0,0, 1) 100%) ,url('+baseURL+'assets/images/interior/'+response.row.bg+')');
	  			$('#image1').attr('src',baseURL+'assets_website/images/'+response.row.image);
	  		}
	  		break;
	  	}
	  	case "About_Us":{
	  		if(!response == false){
	  			$('#owner_name').text(response.owner.owner_name);
	  			$('#about').html(response.owner.about_owner);
	  			$('#ourstory').html(response.owner.our_story);
	  			$('#image').attr('style','background-image: url('+baseURL+'assets/images/avatar/'+response.owner.image+')');
	  			$('#logo_company').attr('style','background-image: url('+baseURL+'assets/images/logo/'+response.company.image+')');
	  			$('#company_name').text(response.company.company);
	  			$('#privacy').html(response.owner.privacy);
	  			$('#terms').html(response.owner.terms);
	  			$('#shipping').html(response.owner.shipping_policy);
	  			$('#return_policy').html(response.owner.return_exchange);
	  		}
	  		break;
	  	}
	  	case"events":{
	  		  $('.events').empty();
	  		for(let i=0;i<response.event.length;i++){	
	  		   	 $('#events').append(' <div class="col-sm-4">'
					               +'    <article>'
					               +'         <div class="image">'
					               +'             <img src="'+baseURL+'assets_website/images/'+response.event[i].image+'" alt="" />'
					               +'         </div>'
					               +'         <div class="entry entry-block">'
					               +'                <div class="title">LOCATION :'+response.event[i].location+'</div>'
					               +'             <div class="date">'+response.event[i].date_event+' || '+response.event[i].time_event+'</div>'
					               +'                <div class="title"><h2 class="h3">'+response.event[i].title+'</h2></div>'
					               +'             <div class="description">'
					               +'                 <p>'+response.event[i].description+'</p>'
					               +'             </div>'
					               +'         </div>'
					               +'   </article>'
					               +'</div>');	
	  		   }
	  		break;
	  	}
	  	case "forgotpassword":{
	  		 if(response.status == 'error'){
	 			swal("Invalid Email", "Please check your email address!", "info");
	 		}else{
	 		    $('#exampleModal').modal('show');
	  		    $('input[name=code]').attr('data-code',btoa(response.id));
	 		}
	  		break;
	  	}
	  	case "notification":{
	  		$('#count').text(response);
	  		break;
	  	}

	  }
	}
	return {

		//main function to initiate the module
		init: function() {
			// $('#logo').attr('src',baseURL+'assets/images/logo/logo2.png');
			var viewForm = $('#kt_content').attr('data-table');
			_ViewController(viewForm);
			_initView();
			_initheader();
			_initfooter();
			_initnotification();
			
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});
		