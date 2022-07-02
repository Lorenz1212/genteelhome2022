'use strict';
var KTAjaxClientweb = function() {
let view;	 
	var _check_url =  async function (url){
	 	if(url.split('/')[0] == 'genteelhome2022' || url.split('/')[0] == 'genteelhomev2'){
	 		view =  url.split('/')[3];
	 	}else if(url.split('/')[1] == 'genteelhome2022' || url.split('/')[1] == 'genteelhomev2'){
	 		view =  url.split('/')[4];
	 	}else if(url.split('/')[2] == 'genteelhome2022' || url.split('/')[2] == 'genteelhomev2'){
	 		view =  url.split('/')[5];
	 	}else if(url.split('/')[3] == 'genteelhome2022' || url.split('/')[3] == 'genteelhomev2'){
	 		view =  url.split('/')[6];
	 	}else if(url.split('/')[4] == 'genteelhome2022' || url.split('/')[4] == 'genteelhomev2'){
	 		view = url.split('/')[7];
	 	}else if(url.split('/')[5] == 'genteelhome2022' || url.split('/')[5] == 'genteelhomev2'){
	 		view =  url.split('/')[8];
	 	}
	 	_ViewController(view);
    };
    var _showToast = function(type,message) {
        const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
    }
    var _showSwal  = function(type,message) {
        swal.fire({
          text: message,
          icon: type,
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          }
          })
    }
	var _formatnumbercommat = function(value){
		return value.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
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
	var _month_year = function(){
		 $(function() {
		  var monthNameList = ["January", "February", "March", "April", "May", "June", "July", "August", "September","October", "November", "December"];
	       var start_year = new Date().getFullYear(); 
	           $('select[name=month]').append('<option value="" disabled selected>SELECT MONTH</option>');
	           $.each( monthNameList, function( key, value ) {
	                var no = key+1;
	           	 $('select[name=month]').append('<option value="' + no + '">' + value + '</option>');
		       });
			  $('select[name=year]').append('<option value="" disabled selected>SELECT YEAR</option>');
			  for (var i = start_year; i > 2020; i--) {
			    $('select[name=year]').append('<option value="' + i + '">' + i + '</option>');
			  }
	      });
	}
	var _initImageView = function(){
		var modal = document.getElementById("myModal");
		var img = document.getElementById("myImg");
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		 $(document).on("click","#myImg",function() {
		 	  modal.style.display = "block";
			  modalImg.src = this.src;
			  captionText.innerHTML = this.alt;
		 })
		var span = document.getElementsByClassName("close-image")[0];
		  span.onclick = function() {
		  modal.style.display = "none";
		}
	}
	var _ajaxloaderOption = async function(thisURL,type,val,sub){
		  $.ajax({
	             url: baseURL + thisURL,
	             type: type,
	             data: val,
	             dataType:"json",
                  success: function(response)
                  {
                  	  _initOption(sub,response);
                  }                                     
		});	
	}
	 var _initOption = function(view,response){
		switch(view){
			case "banners":{
				break;
			}
			case "finishproduct":{
				 var finishproduct = $('select[name=project_no]');
				for(let i=0;i<response.length;i++){
	             	  	 finishproduct.append('<option value="'+response[i].id+'">'+response[i].title+'</option>');
	             	  	 finishproduct.addClass('selectpicker');
					 finishproduct.attr('data-live-search', 'true');
					 finishproduct.selectpicker('refresh');
	             	  }
				break;
			}
		}
	}
	var _ViewController = async function(view){
		_month_year();
		switch(view){
			case "lookbook":{
					KTFormControlsWeb.init('lookbook');
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbookcategory_list']));
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_list']));
				$('.create-lookbook').on('click',function(e){
					e.preventDefault();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_category_select']));
					$('#create-lookbook-modal').modal('show');
				});
				$('body').delegate('.create-new-category','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	        Swal.fire({  
					  input: 'text',
					  inputLabel: 'Category Name',
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please complete the form.');
                  }
                })
					  },
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_category_add',result.value]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				});
					$('#image').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob;
								   img.onload = function() {
								      if((img.height >= 500 || img.height <= 800) && (img.width >= 500 || img.width <= 800) ){

								       }else{
									       	Swal.fire("Your image upload is ("+width+"x"+height+")","Please upload image (width  is 500 to 800 size and height is 500 to 800 size) (jpg, jpeg, or png)", "info");
									       	action.val('');
									       	$('.image-create').attr('src',''+baseURL+'assets/images/lookbook/default.jpg');
								       }
								    }
						  }else{
						  	$('.image-create').attr('src',''+baseURL+'assets/images/lookbook/default.jpg');
						  	Swal.fire("Ops!","Please upload correct file. (allow: jpg, jpeg, or png)", "info");
						  	action.val('');
						  }
						});
				$('body').delegate('.update_status_lookcategory','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbookcategory_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-lookcategory','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbookcategory_delete',element.attr('data-id')]));
	            }
	          })
				});
				$('body').delegate('.view-lookcategory','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbookcategory_details',element.attr('data-id')]));
				});
				$('body').delegate('.view-lookbook','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
						_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_category_select']));
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_details',element.attr('data-id')]));
				});
				$('body').delegate('.update_status_lookbook','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-lookbook','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_delete',element.attr('data-id')]));
	            }
	          })
				});
				break;
			}
			case "testimony":{
			 	var avatar5 = new KTImageInput('kt_image_5');
			 	var avatar6 = new KTImageInput('kt_image_6');
			 	KTFormControlsWeb.init('testimony');
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_list']));
				$('body').delegate('.view-testimony','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_details',element.attr('data-id')]));
				});
				$('body').delegate('.update_status_testimony','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-testimony','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_delete',element.attr('data-id')]));
	            }
	          })
				});
				break;
			}
			case "events":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['events','fetch_events_list']));
				KTFormControlsWeb.init('events');
				$('body').delegate('.view-event','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['events','fetch_event_details',element.attr('data-id')]));
				});
				$('body').delegate('.update_status_event','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['events','fetch_event_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-event','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['events','fetch_event_delete',element.attr('data-id')]));
	            }
	          })
				});
				$('#image').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=400 ){
								      	if(img.height >=400){

								      	 }else{
								      		Swal.fire("Ops!","Please upload minimum 400x400 size (jpg, jpeg, or png)", "info");
								      		$('.image-update').attr('src',''+baseURL+'assets/images/events/default.jpg');
								      	 	action.val('');
								      	 }
								       }else{
								       	Swal.fire("Ops!","Please upload minimum 400x400 size (jpg, jpeg, or png)", "info");
								       	$('.image-update').attr('src',''+baseURL+'assets/images/events/default.jpg');
								       	action.val('');
								       }
								    }
						  }else{
						  	$('.image-update').attr('src',''+baseURL+'assets/images/events/default.jpg');
						  	Swal.fire("Ops!","Please upload minimum 400x400 size (jpg, jpeg, or png)", "info");
						  	action.val('');
						  }
						});
				break;
			}
			case "interior":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interiors','fetch_interior_list']));
				KTFormControlsWeb.init('interior');
				$('body').delegate('.view-interior','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interiors','fetch_interior_details',element.attr('data-id')]));
				});
				$('body').delegate('.update_status_interior','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interiors','fetch_interior_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-interior','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['interiors','fetch_interior_delete',element.attr('data-id')]));
	            }
	          })
				});
				$('#image').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=1140 ){
								      	if(img.height >=660){

								      	 }else{
								      		Swal.fire("Ops!","Please upload minimum 1140x660 size (jpg, jpeg, or png)", "info");
								      		$('.image-update').attr('src',''+baseURL+'assets/images/interior/default.png');
								      	 	action.val('');
								      	 }
								       }else{
								       	Swal.fire("Ops!","Please upload minimum 1140x660 size (jpg, jpeg, or png)", "info");
								       	$('.image-update').attr('src',''+baseURL+'assets/images/interior/default.png');
								       	action.val('');
								       }
								    }
						  }else{
						  	$('.image-update').attr('src',''+baseURL+'assets/images/interior/default.png');
						  	Swal.fire("Ops!","Please upload minimum 1140x660 size (jpg, jpeg, or png)", "info");
						  	action.val('');
						  }
						});
				$('#bg_image').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=810){
								      	if(img.height >=460){

								      	 }else{
								      		Swal.fire("Ops!","Please upload minimum 810x460 size (jpg, jpeg, or png)", "info");
								      		$('.bg-update').attr('src',''+baseURL+'assets/images/interior/default.png');
								      	 	action.val('');
								      	 }
								       }else{
								       	Swal.fire("Ops!","Please upload minimum 810x460 size (jpg, jpeg, or png)", "info");
								       	$('.bg-update').attr('src',''+baseURL+'assets/images/interior/default.png');
								       	action.val('');
								       }
								    }
						  }else{
						  	$('.bg-update').attr('src',''+baseURL+'assets/images/interior/default.png');
						  	Swal.fire("Ops!","Please upload minimum 810x460 size (jpg, jpeg, or png)", "info");
						  	action.val('');
						  }
						});
				break;
			}
			case "banner":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['banner','fetch_banner_list']));
				KTFormControlsWeb.init('banner');
				$('body').delegate('.view-banner','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['banner','fetch_banner_details',element.attr('data-id')]));
				});
				$('body').delegate('.update_status_banner','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['banner','fetch_banner_status',element.attr('data-id')]));
				});
				$('body').delegate('.delete-banner','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this item?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	             _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['banner','fetch_banner_delete',element.attr('data-id')]));
	            }
	          })
				});
				$('#image').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=1600){
								      	if(img.height >=1200){

								      	 }else{
								      		Swal.fire("Ops!","Please upload minimum 1600x1200 size (jpg, jpeg, or png)", "info");
								      		$('.images').attr('src',''+baseURL+'assets/images/banner/default.png');
								      	 	action.val('');
								      	 }
								       }else{
								       	Swal.fire("Ops!","Please upload minimum 1600x1200 size (jpg, jpeg, or png)", "info");
								       	$('.images').attr('src',''+baseURL+'assets/images/banner/default.png');
								       	action.val('');
								       }
								    }
						  }else{
						  	$('.images').attr('src',''+baseURL+'assets/images/banner/default.png');
						  	Swal.fire("Ops!","Please upload minimum 1600x1200 size (jpg, jpeg, or png)", "info");
						  	action.val('');
						  }
						});
				break;
			}
			case "product":{
					var avatar5 = new KTImageInput('kt_image_5');
				_initCurrency_format('.amount');
				KTFormControlsWeb.init('product');
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_list']));
				$('.category').on('change',function(e){
						e.preventDefault();
						let id = $(this).val();
						_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_select',id]));
				});
				$('body').delegate('.view-product','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_details',element.attr('data-id')]));
				});
				$('body').delegate('#delete','click',function(e){
						e.preventDefault();
						e.stopImmediatePropagation();
						let id = $(this).attr('data-id');
						_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_delete_image',id]));
				});
				$('#imagess').on('change', function(imageInput) {
						   let action = $(this);
			         var img = document.createElement('img');
						   var blob = URL.createObjectURL(action.get(0).files[0]);
						   let extension = action.val().replace(/^.*\./, '');
						  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
						  	   img.src = blob; 
								   img.onload = function() {
								  if((img.height >= 300 || img.height <= 600) && (img.width >= 300 || img.width <= 600) ){

						       }else{
							       	Swal.fire("Your image upload is ("+width+"x"+height+")","Please upload image (width  is 300 to 600 size and height is 300 to 600 size) (jpg, jpeg, or png)", "info");
							       	action.val('');
							       	$('#customFile').val("");
						       }
						    }
						  }
					});
				break;
			}
			case "voucher":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['voucher','fetch_voucher_list']));
				 $('#add-voucher').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['voucher','fetch_voucher_list']));
				});
				break;
			}
			case "shipping-fee":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['shipping','fetch_shipping_list']));
				 $('#requestModal').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['shipping','fetch_shipping_list']));
				});
				break;
			}

			case "category-list":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_list']));
				$('body').delegate('.view_details','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_details',$(this).attr('data-id')]));
				});
				$('body').delegate('.update_status','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_status',$(this).attr('data-id')]));
				});
				$('body').delegate('.view_subcategories','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_list',$(this).attr('data-id')]));
				});
				$('body').delegate('.view_sub_details','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_details',$(this).attr('data-id')]));
				});
				$('body').delegate('.update_status_sub','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_status',$(this).attr('data-id')]));
				});
				$('body').delegate('.delete-sub-cat','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	          Swal.fire({
	                 text: "Do you want to remove this sub category?",
	                 icon: "question",
	                 showCancelButton: true,
	                 buttonsStyling: false,
	                 confirmButtonText: "Yes, proceed!",
	                 cancelButtonText: "No, cancel",
	                 customClass: {
	                   confirmButton: "btn font-weight-bold btn-primary",
	                   cancelButton: "btn font-weight-bold btn-default"
	                 }
	          }).then(function (result) {
	            if (result.value) {
	              _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_delete',element.attr('data-id')]));
	            }
	          })
				});
				$('body').delegate('.create-new-category','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	        Swal.fire({
					  imageUrl: baseURL+"assets/images/category/default.jpg",
         		imageHeight: 200, 
    				imageWidth: 600,   
					  html:'<div class="form-group">\
								    <label>Upload Image</label>\
								    <div class="input-group">\
								     <div class="input-group-prepend">\
								     <span class="input-group-text text-success btn-click-upload" style="cursor: pointer;"><i class="la la-cloud-upload icon-lg text-success"></i></span></div>\
								     <input type="text" class="form-control btn-click-upload view-name" placeholder="Click here to browse files" cursor: pointer; readonly/>\
								    	 <input type="file" name="image" class="view-upload" style="display:none;">\
								    </div>\
								  </div>',
					  input: 'text',
					  inputLabel: 'Category Name',
					  width:600,
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please complete the form.');
                  }
                })
					  },
					  willOpen: () => {
					    $('.btn-click-upload').on('click',function(e){
					    	e.preventDefault();
					    		$('.view-upload').trigger('click');
					    });
					    $('.view-upload').on('change',function(e){
					    		e.preventDefault();
					    		let file = $(this).get(0).files[0].name;
					    		$('.view-name').val(file);
					    		if(file){
					    			$('.swal2-image').attr('src', window.URL.createObjectURL($(this).get(0).files[0]));
					    		}else{
					    			$('.swal2-image').attr('src', baseURL+"assets/images/category/default");
					    		}
					    		
					    });
					  }
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                  		 let files = $('input[name="image"]')[0].files;
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_add',false,result.value,files[0]]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				});
					$('body').delegate('.create-new-sub-category','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element=$(this);
	        Swal.fire({ 
					  html:'<div class="form-group">\
					  		<label>Category</label>\
					  		<select class="form-control select-category"></select>\
					  	</div>',
					  input: 'text',
					  inputLabel: 'Sub Category Name',
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please complete the form.');
                  }
                })
					  },
					  willOpen: () => {
					  	 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_option']));
					  }
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                  		let id = $('.select-category').val();
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_add',id,result.value,false]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				});
				break;
			}
		}
	}
	

	var _construct = async function(response, type, element, object){
		switch(type){
			case "fetch_lookbook_details":{
				if(response != false){
					KTFormControlsWeb.init('lookbook',response.id);
					$('.title-update').val(response.look_name);
					$('.category-update').val(response.look_cat_id).trigger('change');
					$('.image-update').attr('src',baseURL+'assets/images/lookbook/'+response.image);
					$('#update-lookbook-modal').modal('show');
				}
				break;
			}
			case "fetch_lookbookcategory_details":{
				if(response != false){
					Swal.fire({  
					  input: 'text',
					  inputValue:response.look_cat_name,
					  inputLabel: 'Category Name',
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please complete the form.');
                  }
                })
					  },
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['lookbook','fetch_lookbook_category_update',response.id,result.value]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				}
				break;
			}
			case "fetch_lookbook_delete":
			case "fetch_lookbook_status":{
				if(response !=false){
						_showToast(response.type,response.message);
					 KTDatatablesDataSourceAjaxClient.init('tbl_lookbooks',response.data);
					}
				break;
			}
			case "fetch_lookbook_category_update":
			case "fetch_lookbookcategory_status":
			case "fetch_lookbookcategory_delete":
			case "fetch_lookbook_category_add":{
				if(response !=false){
						_showToast(response.type,response.message);
					 KTDatatablesDataSourceAjaxClient.init('tbl_lookbook_categories',response.data);
					}
			}
			case "fetch_lookbook_category_select":{
				let container = $('.category').empty();
				if(response != false){
					for(let i=0;i<response.length;i++){
						container.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
					}
				}else{
					container.append('<option value="">No Sub Category Available</option>');
				}
				break;
			}
			case "fetch_lookbookcategory_list":{
					KTDatatablesDataSourceAjaxClient.init('tbl_lookbook_categories',response);
				break;
			}
			case "fetch_lookbook_list":{
					KTDatatablesDataSourceAjaxClient.init('tbl_lookbooks',response);
				break;
			}
			case "fetch_testimony_list":{
						KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response);
			   break;
			}
			case"fetch_testimony_delete":
			case "fetch_testimony_status":{
					if(response !=false){
						_showToast(response.type,response.message);
					 KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response.data);
					}
				break;
			}
			case "fetch_testimony_details":{
					if(response != false){
						KTFormControlsWeb.init('testimony',response.id);
						$('.name').val(response.name);
						$('.description-update').val(response.description);
						$('.image-update').css('background-image','url('+baseURL+'assets/images/testimony/'+response.image+')');
						$('#kt_image_6 > span').on('click',function(e){
							e.preventDefault();
							$('.image-update').css('background-image','url('+baseURL+'assets/images/testimony/'+response.image+')');
						})
						$('#update-testimony-modal').modal('show');
					}
			   break;
			}
			case "fetch_events_list":{
					 KTDatatablesDataSourceAjaxClient.init('tbl_events',response);
				break;
			}
			case"fetch_event_delete":
			case "fetch_event_status":{
					if(response !=false){
						_showToast(response.type,response.message);
					 KTDatatablesDataSourceAjaxClient.init('tbl_events',response.data);
					}
				break;
			}
			case "fetch_event_details":{
				if(response != false){
					KTFormControlsWeb.init('events',response.id);
					$('.title').val(response.title);
					$('.description-update').val(response.description);
					$('.date-event').val(response.date_event);
					$('.image-update').attr('src',baseURL+'assets/images/events/'+response.image);
					$('#update-events-modal').modal('show');
				}
				break;
			}
			case "fetch_interior_list":{
				 KTDatatablesDataSourceAjaxClient.init('tbl_interiors',response);
				 break;
			}
			case"fetch_interior_delete":
			case "fetch_interior_status":{
					if(response !=false){
						_showToast(response.type,response.message);
				 KTDatatablesDataSourceAjaxClient.init('tbl_interiors',response.data);
				}
				break;
			}
			case "fetch_interior_details":{
				if(response !=false){
					KTFormControlsWeb.init('interior',response.id);
					$('.project_name').val(response.project_name);
					$('.description-update').summernote('code',response.description);
					$('.cat_id').val(response.cat_id).change();
					$('.edit-image-bg').attr('src',baseURL+'assets/images/interior/'+response.bg);
					$('.edit-image').attr('src',baseURL+'assets/images/interior/'+response.image);
					$('#update-interior-modal').modal('show');
				}
				break;
			}
			case "fetch_banner_list":{
				KTDatatablesDataSourceAjaxClient.init('tbl_banners',response);
				break;
			}
			case"fetch_banner_delete":
			case "fetch_banner_status":{
					if(response !=false){
						_showToast(response.type,response.message);
				 KTDatatablesDataSourceAjaxClient.init('tbl_banners',response.data);
				}
				break;
			}
			case "fetch_banner_details":{
				if(response !=false){
					KTFormControlsWeb.init('banner',response.id);
					$('.title').val(response.title);
					$('.sub_title').val(response.sub_title);
					$('.slide').val(response.type).change();
					$('.edit-image').attr('src',baseURL+'assets/images/banner/'+response.image);
					$('#view-banner-modal').modal('show');
				}
				break;
			}
			case "fetch_product_list":{
			  KTDatatablesDataSourceAjaxClient.init('tbl_products',response);
			  break;
			}
			case "fetch_sub_category_select":{
				let container = $('.sub_category').empty();
				if(response != false){
					for(let i=0;i<response.length;i++){
						container.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
					}
				}else{
					container.append('<option value="">No Sub Category Available</option>');
				}
				break;
			}
			case "fetch_product_details":{
				if(response != false){
			  		$('.cat_id_update').on('change',function(e){
							e.preventDefault();
								let id = $(this).val();
								_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_select',id]));
						});
						$('.cat_id_update option[value="'+response.row.cat_id+'"]').attr("selected", "selected");
						let container = $('.sub_category_update').empty();
						if(response.sub != false){
							for(let i=0;i<response.sub.length;i++){
								container.append('<option value="'+response.sub[i].id+'">'+response.sub[i].name+'</option>');
							}
						}
						$('.sub_category_update option[value="'+response.row.sub_id+'"]').attr("selected", "selected");
		  			$('#title').val(response.row.title).attr('data-id',response.row.id);
		  			$('#c_name').val(response.row.c_name);
		  			$('#unit').val(response.row.unit);
		  			$('#c_price').val(_formatnumbercommat(response.row.c_price));
		  			$('#displayed_status').val(response.row.display_status).change();
		  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.row.c_code));
		  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
		  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.row.docs);
		  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
		  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
		  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
		  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
		  			$("#tearsheet_href").attr("href",baseURL + 'assets/images/tearsheet/'+response.row.tearsheet);
		  			$("#tearsheetss").val(response.row.tearsheet);
		  			$("#tearsheet").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
		  			$("#c_previous").val(response.row.c_image);
		  			$("#divimages").empty();
		  			for(let i=0;i<response.data.length;i++){
		  				$("#divimages").append('<div class="col-lg-3 col-xl-3 mb-5" id="row_'+response.data[i].id+'">\
									  									  <div class="row">\
									  									  	<div class="col-lg-12 col-xl-12 text-center">\
											  										<div class="symbol symbol-50 symbol-lg-150 ">\
																						<img id="myImg" style="width:100%" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" class="">\
																					</div>\
																				</div>\
																				<div class="col-lg-12 col-xl-12">\
																				   <button class="btn btn-danger btn-sm btn-block" id="delete" data-id="'+response.data[i].id+'">Remove</button>\
																				</div>\
																			</div>\
									  									</div>');

		  			}
		  			$('.save').on('click',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let name = $(this).attr('data-name');
							let val1 = $('input[name='+name+']').val();
							let val2 = $(this).attr('data-status');
							let id = $('#title').attr('data-id');
							_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_update',id,val1,val2,name]));
						});
						$('.save_status').on('click',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let name = $(this).attr('data-name');
							let val1 = $('select[name='+name+']').val();
							let val2 = $(this).attr('data-status');
							let id = $('#title').attr('data-id');
							_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_update',id,val1,val2,name]));
						});
						$('.save_category').on('click',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let val1 = $('select[name=cat_id_update]').val();
							let val2 = $('select[name=sub_id_update]').val();
							let id = $('#title').attr('data-id');
							_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_category_update',id,val1,val2]));
						});
						$('input[name=color_update]').on('change',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let image = $(this)[0].files;
							let id = $('#title').attr('data-id');
							_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_pallet',id,false,false,false,image[0]]));
						});
						$('.save_tearsheet').on('click',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let image = $('input[name=tearsheet]')[0].files;
							let id = $('#title').attr('data-id');
							_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_tearsheet',id,false,false,false,image[0]]));
						});
						$('.save_image').on('click',function(e){
							e.preventDefault();
							e.stopImmediatePropagation();
							let image = $('input[name=gallery]')[0].files;
							let id = $('#title').attr('data-id');
							let alert = $('#customFile').val();
							if(alert != ""){
									_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_save_image',id,false,false,false,image[0]]));
							}else{
								Swal.fire("Oopps!","Please upload image", "info");
							}
						});
						
		  			$('#view-details-modal').modal('show');
		  		}
				break;
			}
			case "fetch_product_delete_image":
			case "fetch_product_save_image":{
				if(response != false){
					_initToast(response.type,response.message);
					let container = $("#divimages").empty();
					if(response.data){
						$('#customFile').val("");
						for(let i=0;i<response.data.length;i++){
		  				container.append('<div class="col-lg-3 col-xl-3 mb-5" id="row_'+response.data[i].id+'">\
									  									  <div class="row">\
									  									  	<div class="col-lg-12 col-xl-12">\
										  										<div class="symbol symbol-50 symbol-lg-150">\
																					<img alt="Pic" id="myImg" style="width:100%" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" class="">\
																				</div>\
																			</div>\
																				<div class="col-lg-12 col-xl-12">\
																				   <button class="btn btn-danger btn-sm btn-block" id="delete" data-id="'+response.data[i].id+'">Remove</button>\
																				</div>\
																			</div>\
									  									</div>');

		  			}
					}
				}
				break;
			}
			case "fetch_product_tearsheet":{
				if(response != false){
					_initToast(response.type,response.message);
				}
				break;
			}
			case "fetch_product_pallet":
			case "fetch_product_category_update":
			case "fetch_product_update":{
				if(response != false){
					_initToast(response.type,response.message);
					KTDatatablesDataSourceAjaxClient.init('tbl_products',response.data);
				}
				break;
			}
			case "fetch_voucher_list":{
			  KTDatatablesDataSourceAjaxClient.init('tbl_voucher',response);
			  break;
			}
			case "fetch_shipping_list":{
			   KTDatatablesDataSourceAjaxClient.init('tbl_shipping',response);
			   break;
			}

			case "fetch_category_list":{
				KTDatatablesDataSourceAjaxClient.init('tbl_category',response);
				break;
			}
			case "fetch_category_details":{
				if(response != false){
						Swal.fire({
					  imageUrl: baseURL+"assets/images/category/"+response.image,
         		imageHeight: 200, 
    				imageWidth: 600,   
					  html:'<div class="form-group">\
								    <label>Upload Image</label>\
								    <div class="input-group">\
								     <div class="input-group-prepend">\
								     <span class="input-group-text text-success btn-click-upload" style="cursor: pointer;"><i class="la la-cloud-upload icon-lg text-success"></i></span></div>\
								     <input type="text" class="form-control btn-click-upload view-name" placeholder="Click here to browse files" cursor: pointer; readonly/>\
								    	 <input type="file" name="image" class="view-upload" style="display:none;">\
								    </div>\
								  </div>',
					  input: 'text',
					  inputLabel: 'Category Name',
					  inputValue: response.cat_name,
					  width:600,
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please complete the form.');
                  }
                })
					  },
					  willOpen: () => {
					    $('.btn-click-upload').on('click',function(e){
					    	e.preventDefault();
					    		$('.view-upload').trigger('click');
					    });
					    $('.view-upload').on('change',function(e){
					    		e.preventDefault();
					    		let file = $(this).get(0).files[0].name;
					    		$('.view-name').val(file);
					    		if(file){
					    			$('.swal2-image').attr('src', window.URL.createObjectURL($(this).get(0).files[0]));
					    		}else{
					    			$('.swal2-image').attr('src', baseURL+"assets/images/category/"+response.image);
					    		}
					    		
					    });
					  }
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                  		 var files = $('input[name="image"]')[0].files;
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_update',response.id,result.value,files[0]]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				}
				break;
			}
			case "fetch_category_option":{
				let container = $('.select-category').empty();
				if(response != false){
					for(let i=0;i<response.length;i++){
						container.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
					}
				}
				break;
			}

			case "fetch_category_add":
			case "fetch_category_status":
			case "fetch_category_update":{
				if(response !=false){
					_initToast(response.type,response.message);
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_category_list']));
				}
				break;
			}
			case "fetch_sub_category_list":{
				if(response != false){
					$('.cat-name').text(response.cat.cat_name);
					KTDatatablesDataSourceAjaxClient.init('tbl_sub_category',response.sub);
					$('#view-sub-cateogy-modal').modal('show');
				}
				break;
			}
			case "fetch_sub_category_details":{
					if(response != false){
						Swal.fire({
					  title: 'Category Name : '+response.cat_name,
					  input: 'text',
					  inputLabel: 'Sub Category Name',
					  inputValue: response.sub_name,
					  showCancelButton: true,
					  inputValidator: (value) => {
					    return new Promise((resolve) => {
                  if (value.length >=1){
                    resolve();
                  }else{
                    resolve('Please Sub Category Name');
                  }
                })
					  },
					}).then(function(result){
                if(result.isConfirmed == true){
                  	if(result.value){
                    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['category','fetch_sub_category_update',response.id,result.value]));
                    }else{
                       swal.fire('Opss', 'Please complete the form', 'info');
                    }
                  }
          	})
				}
				break;
			}
			case "fetch_sub_category_status":
			case "fetch_sub_category_update":{
				if(response !=false){
					_initToast(response.type,response.message);
					KTDatatablesDataSourceAjaxClient.init('tbl_sub_category',response.sub);
				}
				break;
			}
			case 'fetch_sub_category_delete':{
	        if(response.type == 'success'){
	          $('#kt_search').click();
	        	 _initToast(response.type,response.message);
	        	 KTDatatablesDataSourceAjaxClient.init('tbl_sub_category',response.sub);
	        }else{
	          _showSwal(response.type,response.message);
	        }
	        break;
	    }
	    case "fetch_sub_category_add":{
	    	if(response !=false){
	    			_initToast(response.type,response.message);
	    	}
	    	break;
	    }
		}
	}

	 // start making formdata
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
              url: baseURL+'Webmodifier_Controller/Controller',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              dataType: "json",
              beforeSend: function(){
                if(blockUi.get("type") == "blockPage"){
                   if(blockUi.get("message") != "false"){
                      KTApp.blockPage({
                      overlayColor: '#000000',
                      state: 'primary',
                      message: blockUi.get("message")
                     });
                   }else{
                      KTApp.blockPage();
                   }
                }else if(blockUi.get("type") == "blockContent"){
                      KTApp.block(blockUi.get("element"));
                }else{
                }
              },
              complete: function(){
                if(blockUi.get("type") == "blockPage"){
                  KTApp.unblockPage();
                }else if(blockUi.get("type") == "blockContent"){
                  KTApp.unblock(blockUi.get("element"));
                }else{
                }
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
                // if(xhr.status == 200){
                //   if(xhr.responseText.trim()=="signed-out"){
                //     Swal.fire({
                //     title:"Oopps!",
                //     text: "Your account was signed-out.",
                //     icon: "info",
                //     showCancelButton: false,
                //     confirmButtonText: "Ok, Got it",
                //         reverseButtons: true
                //     }).then(function(result) {
                //       window.location.replace("login");
                //     });
                //   }else{
                //     Swal.fire("Ops!", "Check your internet connection.", "error");
                //   }
                // }else 
                if(xhr.status == 500){
                  Swal.fire("Ops!", 'Internal error: ' + xhr.responseText, "error");
                }else{
                  console.log(xhr);
                  console.log(status);
                  Swal.fire("Ops!", 'Something went wrong..', "error");
                }
              }       
        });      
       })
    };
 
	return {

		//main function to initiate the module
		init: function(){
			_check_url(window.location.pathname);
			_initImageView();
			sessionStorage.clear();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClientweb.init();
});
		
