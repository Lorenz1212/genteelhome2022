'use strict';
// Class definition
var KTFormControls = function () {
	var val;var thisURL; var url;
	var _initSwalWarning = function(url){
	     Swal.fire("Warning!", "Please Complete the form!", "warning");
	}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       window.location = url;
		});
	}
	var _initToastSuccess = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initnotification = async function(){
		  $.ajax({
	             url: baseURL + 'website_controller/notification',
	             type: 'POST',
	             data: false,
	             dataType:"json",
	             beforeSend: function()
	             {
	              
	             },
                  complete: function(){
                   
                  },
                  success: function(response){
                  	$('#count').text(response);
                  },
                 error: function(xhr,status,error){
	                 console.log(xhr);
	                 console.log(status);
	                 console.log(error);
	                 console.log(xhr.responseText);
                 }                                      
		});	
	}

	var _ajaxForm = async function(thisURL,type,val,view,url){
		$.ajax({
		    enctype: 'multipart/form-data',
              url: thisURL,
              type: type,
              data: val,
              cache: false,
	         contentType: false,
	         processData: false,
              dataType:"json",
            beforeSend: function(){
              
             },
            complete: function(){
                
             },
             success: function(response)
             {
                  _constructData(view,response,url)
             },
             error: function(xhr,status,error){
                       console.log(xhr);
                       console.log(status);
                       console.log(error);
                       console.log(xhr.responseText);
                       // Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");    
              }
                                                     
		});
	}
	var _ajaxForm_loaded = async function(thisURL,type,val,view,url){
		$.ajax({
		    enctype: 'multipart/form-data',
              url: thisURL,
              type: type,
              data: val,
              dataType:"json",
            beforeSend: function(){
                 
             },
            complete: function(){
               
             },
             success: function(response)
             {
                  _constructData(view,response,url)
             },
             error: function(xhr,status,error){
                       console.log(xhr);
                       console.log(status);
                       console.log(error);
                       console.log(xhr.responseText);
                       // Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");    
              }
                                                     
		});
	}	

	 var _FormSubmit = async function(action){
	 	switch(action){
	 		//Create Form
	 		case "Newpassword":{
	 			$('.new_password').on('click',function(e){
	 				let password = $('.password').val();
	 				let con_password = $('input[name=con_password]').val();
	 				let email = $('input[name=con_password]').attr('data-code');
	 				alert(email)
	 				alert(con_password)
	 				alert(password)
	 				if(password == con_password){
	 					val = {password:password,email:email};
						thisURL = baseURL + 'website_controller/forgotpassword';
						_ajaxForm_loaded(thisURL,"POST",val,"forgotpassword",false);	 
	 				}else{
	 					swal("Password does not matched", "Please check your password!", "info");
	 				}
					 
				 });
	 			break;
	 		}
	 		case "Create_Product_Cart":{
	 			$('#alert_collection').on('click',function(e){
					e.preventDefault();
					swal("Login First", "Thank you!", "warning");	 
				 });
	 			$('#add_collection').on('click',function(e){
					e.preventDefault();
					let c_name = $('#c_name').text();
					val = {c_name:c_name};
					thisURL = baseURL + 'website_controller/Create_Product_Collection';
					_ajaxForm_loaded(thisURL,"POST",val,"Create_Product_Collection",false);	 
				 });
	 			$('#delete_collection').on('click',function(e){
					e.preventDefault();
					var id = $('#delete_collection').attr('data-id');
					val = {id:id};
					thisURL = baseURL + 'delete_controller/Delete_Collection';
					_ajaxForm_loaded(thisURL,"POST",val,"Delete_Collection",false); 
				 });
	 			$('#alert_cart').on('click',function(e){
					e.preventDefault();
					swal("Login First", "Thank you!", "warning");	 
				 });
	 			$('#add_cart').on('click',function(e){
					e.preventDefault();
					let c_name = $('#c_name').text();
					let qty = $('input[name=qty]').val();
					let order = $('#product_order').text();
					if(qty == 0){
						$('input[name=qty]').focus();
						swal("Please Enter Quantity", "Thank you!", "warning");
					}else{
						val = {c_name:c_name,qty:qty,order:order};
					     thisURL = baseURL + 'website_controller/Create_Product_Cart';
					     _ajaxForm_loaded(thisURL,"POST",val,"Create_Product_Cart",false);
					}	 
				 });
	 			break;
	 		}
	 		case "Update_Cart_Process":{
	 			$("#Update_Cart_Process").click(function () {
		            $("#cart input[type=checkbox]:checked").each(function () {
		                 	 let id = $(this).attr('data-checked');
		                 	 val = {id:id};
		                 	 thisURL = baseURL + 'website_controller/Update_Cart_Process';
		                 	 url = baseURL + 'gh/app/checkout';	
		                 	_ajaxForm_loaded(thisURL,"POST",val,"Update_Cart_Process",url);
		            });
		            return false;
		        });
	 			break;
	 		}
	 		case "Update_Cart_Checkout":{
	 			$("#next").click(function () {
		           	var nextt = $(this).attr('data-action');
		           	if(nextt == 'submit'){
			           	 let b_address   	=  $('#b_address').text();
						 let b_city 	  	=  $('#b_city').text();
						 let b_province  	=  $('#b_province').text();
						 let s_address   	=  $('#s_address').text();
						 let s_city 	 	=  $('#s_city').text();
						 let s_province 	=  $('#s_province').text();
						 let today 		=  new Date();
					 	 let order_date 	=  today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
					 	 var shipping_date  =  today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate()+14);
					 	 let order_no    	=  $('#order_no').text();
					 	 let coupons 	  	=  $('#coupons').val();
					 	 let subtotal 	  	=  $('#subtotal').text();
					 	 let total 	  	=  $('#total').text();
					 	 let discount    	=  $('#coupons').attr('data-promo');
					 	 let type   	  	=  $('input[name="deliveryOption"]:checked').val();
					 	 let region   	  	=  $('select[name="region"]').val();
					 	 val = {order_no:order_no,b_address:b_address,b_city:b_city,b_province:b_province,s_address:s_address,s_city:s_city,s_province:s_province,order_date:order_date,shipping_date:shipping_date,coupons:coupons,subtotal:subtotal,total:total,discount:discount,type:type,region:region};
		                 	 thisURL = baseURL + 'website_controller/Update_Cart_CheckOut';
		                 	 url = baseURL + 'gh/app/cart';	
		                 	_ajaxForm_loaded(thisURL,"POST",val,"Update_Cart_CheckOut",url);
		           	}
		          });
	 			break;
	 		}
	 		case "Update_Account":{
	 			$(document).on('click','#Update_Account_Password',function(){
	 				let password   	=  $('input[name=password]').val();
	 				let con_password   	=  $('input[name=con_password]').val();
	 				if(password == con_password){
	 					var vals = {password:password};
					  	var thisURLs = baseURL + 'website_controller/Update_Password';
					  	var urls = baseURL + 'gh/app/account';
					  	 _ajaxForm_loaded(thisURLs,"POST",vals,"Update_Password",urls);
	 				}else{
	 					swal({
						  title: "Password and confirm password does not match!",
						  text: "Check your password!",
						  icon: "error",
						});
	 				}
	 			})
	 			$(document).on('click','#Update_Account_Profile',function(){
	 				 let firstname   	=  $('input[name=firstname]').val();
	 				 let lastname   	=  $('input[name=lastname]').val();
	 				 let mobile   		=  $('input[name=mobile]').val();
	 				 let address   	=  $('input[name=address]').val();
					 let city 	 	=  $('input[name=city]').val();
					 let province 		=  $('input[name=province]').val();
					 let region 		=  $('select[name=region]').val();
	 				 val = {firstname:firstname,lastname:lastname,mobile:mobile,address:address,city:city,province:province,region:region};
				  	 thisURL = baseURL + 'website_controller/Update_Account';
				  	 url = baseURL + 'gh/app/account';
				  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Account",url);
	 			})
	 			break;
	 		}
	 		case "Create_Deposit":{
	 			$(document).on('click','#Create_Deposit',function(e){
	 				e.preventDefault();
	 				 var files 		=  $('input[name=image]')[0].files;
   					 var firstname   	=  $('input[name=firstname]').val();
	 				 var lastname   	=  $('input[name=lastname]').val();
	 				 var mobile   		=  $('input[name=mobile]').val();
	 				 var email   		=  $('input[name=email]').val();
					 var order_no 	 	=  $('input[name=order_no]').val();
					 var date_deposite 	=  $('input[name=date_deposite]').val();
					 var amount 		=  $('input[name=amount]').val();
					 var bank 		=  $('select[name=bank]').val();
					 if(!files[0] || !firstname|| !lastname || !mobile|| !email || !order_no || !date_deposite || !bank || !amount){
					 	swal("Please Complete The Form", "Thank you!", "warning");
					 }else{
					 	var fd = new FormData();
	 				 	fd.append('firstname',firstname);
	 				 	fd.append('lastname',lastname);
	 				 	fd.append('mobile',mobile);
	 				 	fd.append('email',email);
	 				 	fd.append('order_no',order_no);
	 				 	fd.append('date_deposite',date_deposite);
	 				 	fd.append('amount',amount);
	 				 	fd.append('bank',bank);
	   					fd.append('image',files[0]);
					 	 thisURL = baseURL + 'website_controller/Create_Deposit';
					  	 url = baseURL + 'gh/app/payment-deposit';
				  	 	_ajaxForm(thisURL,"POST",fd,"Create_Deposit",url);
					 }
					
	 			})
	 			break;
	 		}
	 		case "Create_Email":{
	 			$(document).on('click','#Create_Email',function(e){
	 				e.preventDefault();
   					 var name   		=  $('input[name=name]').val();
	 				 var subject   	=  $('input[name=subject]').val();
	 				 var comment   	=  $('#comment').val();
	 				 var email   		=  $('#email').val();
					 if( !name || !email || !subject || !comment){
					 	swal("Please Complete The Form", "Thank you!", "warning");
					 }else{
					 	var fd = new FormData();
	 				 	fd.append('name',name);
	 				 	fd.append('subject',subject);
	 				 	fd.append('comment',comment);
	 				 	fd.append('email',email);
					 	 thisURL = baseURL + 'website_controller/Create_Email';
					  	 url = baseURL + 'gh/app/contact';
				  	 	_ajaxForm(thisURL,"POST",fd,"Create_Email",url);
					 }
					
	 			})
	 			break;
	 		}
	 		case "Create_Service":{
	 			$(document).on('click','#Create_Service',function(e){
	 				e.preventDefault();
	 				 var receipt 		=  $('input[name=receipt]')[0].files;
	 				 var service 		=  $('input[name=service]')[0].files;
   					 var firstname   	=  $('input[name=firstname]').val();
	 				 var lastname   	=  $('input[name=lastname]').val();
	 				 var mobile   		=  $('input[name=mobile]').val();
	 				 var comment   	=  $('#comment').val();
	 				 var email   		=  $('#email').val();
					 var production_no 	=  $('input[name=production_no]').val();
					 var order_no 	 	=  $('input[name=order_no]').val();
					 if(!receipt[0] || !service[0] || !firstname|| !lastname || !mobile|| !email || !production_no || !comment || !order_no){
					 	swal("Please Complete The Form", "Thank you!", "warning");
					 }else{
					 	var fd = new FormData();
	 				 	fd.append('firstname',firstname);
	 				 	fd.append('lastname',lastname);
	 				 	fd.append('mobile',mobile);
	 				 	fd.append('email',email);
	 				 	fd.append('production_no',production_no);
	 				 	fd.append('comment',comment);
	   					fd.append('receipt',receipt[0]);
	   					fd.append('service',service[0]);
	   					fd.append('order_no',order_no);
					 	 thisURL = baseURL + 'website_controller/Create_Service';
					  	 url = baseURL + 'gh/app/service';
				  	 	_ajaxForm(thisURL,"POST",fd,"Create_Service",url);
					 }
					
	 			})
	 			break;
	 		}
	 	}
	 }

	 var _constructData = async function(view,response,url){
	 	switch(view){
	 		//Create
	 		case "Create_Product_Collection":{
	 			$('#delete_collection').attr('data-id',response);
	 			break;
	 		}
	 		case "Create_Product_Cart":{
	 			if(!response == false){
	 				if(response.action == 'update'){
	 					$('#cart_price'+response.id).text(response.c_price);
	 					$('#qtys'+response.id).val(response.qty);
	 				}else{
	 					$('#product_table').prepend('<tr id="delete_row'+response.id+'">'
	  							 +'	<td><img src="'+baseURL+'assets/images/finishproduct/product/'+response.images+'" alt="" style="width:60;height:60px;"></td>'
	  							 +'	<td width="200"><div class="title"><div>'+response.title+'</div><small> '+response.c_name+'</small></div></td>'
	  							 +'	<td ><div class="quantity"><input type="text" style="text-align:center;" id="qtys'+response.id+'" data-qty="'+response.qty+'" data-id="'+response.id+'" class="form-control form-quantity qtys'+response.id+'"></div></td>'
	  							 +'	<td width="100" style="text-align:right;"><div class="price"><span class="final"><span class="cart_price'+response.id+'" data-amount="'+response.c_price+'" data-price="'+response.c_price+'" id="cart_price'+response.id+'"></span></span></div></td>'
	  							 +'	<td width="50"  style="text-align:center;"><span class="icon icon-cross icon-delete" id="delete_cart'+response.id+'" data-id="'+response.id+'" style="cursor:pointer;"></span></td>'
	  							 +'</tr>');
	 					$('#cart_price'+response.id).text(response.total);
	 					$('#qtys'+response.id).val(response.qty);
	 					$("#delete_cart"+response.id).click(function () {
							var id = $(this).attr('data-id');
							var val = {id:id};
							var thisURL = baseURL + 'delete_controller/Delete_Web_Cart';
							 _ajaxForm_loaded(thisURL,"POST",val,"Delete_Web_Cart",false);		
						});
						 $(document).on('input','.qtys'+response.id,function(){
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
									   let thisUrls = baseURL + 'website_controller/Update_Product_Cart';
									   let vals = {id:id,qty:q,total:price}
									   _ajaxForm_loaded(thisUrls,"POST",vals,false);
									}
								 })
							$('#cart_price'+id).text(total.toLocaleString());
							 var thisURLss = baseURL +'website_controller/Update_Product_Cart';
							 var valss = {id:id,qty:qty,total:total}
							_ajaxForm_loaded(thisURLss,"POST",valss,false);
						});
	 				}
		  		}
		  		_initnotification();
	 			break;
	 		}
	 		case "Update_Cart_Process":{
	 			swal({
					  title: "Cart is ready to processs!",
					  text: "You clicked the button!",
					  icon: "success",
					  button: "Ok!",
					}).then(function() {
						window.location = url;
				});
	 			break;
	 		}
	 		case "Update_Cart_CheckOut":{
	 			swal({
					  title: "Your order is completed!!",
					  text: "You clicked the button!",
					  icon: "success",
					  button: "Ok!",
					}).then(function() {
						window.location = url;
				});
				break;
	 		}
	 		case "Delete_Web_Cart":{
	 			swal({
					  title: "Removed!",
					  text: "Item Removed!",
					  icon: "error",
					}).then(function() {
		            		$('#delete_row'+response.id).remove();
		            		_initnotification();
					});
	 			break;
	 		}
	 		case "Delete_Collection":{
	 			swal("Delete Collection", "Thank you!", "warning");
	 			_initnotification();
	 			break;
	 		}
	 		case "Update_Password":{
	 			swal({
					  title: "Password Changed",
					  text: "You clicked the button!",
					  icon: "success",
					  button: "Ok!",
					}).then(function() {
						window.location = url;
				});
	 			break;
	 		}
	 		case "Update_Account":{
	 			if(response.status == 'success'){
		 			swal({
					  title: "Account Successfully Changed",
					  text: "You clicked the button!",
					  icon: "success",
					  button: "Ok!",
					}).then(function() {
						window.location = url;
				});
	 			}
	 			break;
	 		}
	 		case "Create_Deposit":{
	 			if(response.status == 'success'){
					swal("This Form is Successfully Submited", "Thank you!", "success").then(function() {
						window.location = url;
					});
	 			}else{
	 				swal("Invalid Tracking Number", "Thank you!", "warning");
	 			}
	 			break;
	 		}
	 		case "Create_Email":{
	 			if(response.status == 'success'){
					swal("Email Sent", "Thank you!", "success").then(function() {
						window.location = url;
					});
	 			}
	 			break;
	 		}
	 		case "Create_Service":{
	 			if(response.status == 'success'){
					swal("This Form is Successfully Submited", "Thank you!", "success").then(function() {
						window.location = url;
					});
	 			}else if(response.status == 'error1'){
	 				swal("Invalid Tracking Number", "Thank you!", "warning");
	 			}else if(response.status == 'error'){
	 				swal("Invalid Serial Number", "Thank you!", "warning");
	 			}
	 			break;
	 		}
	 		case "forgotpassword":{
	 			alert(JSON.stringify(response))
				if(response.status == 'success'){
	 				swal("Password Changed", "Thank you!", "success").then(function() {
						window.location = baseURL + 'gh/app/index';
					});
	 			}
	 			break;
	 		}

	 	}
	 }

	return {
		// public functions
		init: function() {
		     var tbl =	$('.form').attr('data-link');
		     _FormSubmit(tbl);
		    	
		    
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
