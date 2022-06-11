'use strict';
var KTAjaxClient = function() {
const queryString = window.location.search;
var url_Params_Status = queryString.replace('?dXJsc3RhdHVz','');
var url_link1 = atob(url_Params_Status);
var url_link2  = url_link1.replace(/[_\W]+/g, "");
var url_link = url_link2.toUpperCase();
var html;var _avatar;
	var _initToastSuccess = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initToastWarning = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'warning',title: 'Nothing to change'});
	}
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
	var _formatnumbercommat = function(value){
		return value.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
	var _initPercentage = function(action){
		$(''+action+'').mask('##0,00%', {
            reverse: true
          });
	}
	var _initDatepicker = function(action){
		 var arrows;
		 if (KTUtil.isRTL()) {
		  arrows = {
		   leftArrow: '<i class="la la-angle-right"></i>',
		   rightArrow: '<i class="la la-angle-left"></i>'
		  }
		 } else {
		  arrows = {
		   leftArrow: '<i class="la la-angle-left"></i>',
		   rightArrow: '<i class="la la-angle-right"></i>'
		  }
		 }
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
	var _initcategory_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/Category_option',
	             type: "POST",
	             dataType:"json",
	             beforeSend: function()
	             {
	                 KTApp.blockPage();
	             },
                 complete: function(){
                      KTApp.unblockPage();
                  },
                  success: function(response)
                  {	  
                  	  for(let i=0;i<response.length;i++){
                  	  	  let option = '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                  	  	  $('#category').append(option);  
                  	  	  $('#category').addClass('selectpicker');
					  $('#category').attr('data-live-search', 'true');
					  $('#category').selectpicker('refresh');
                  	  	
                  	  }
                  }                                    
		});	
	}
	var _initsubcategory_option = async function(id){
		 $.ajax({
	             url: baseURL + 'option_controller/SubCategory_option',
	             type: "POST",
	             data:{id:id},
	             dataType:"json",
	             beforeSend: function()
	             {
	                 KTApp.blockPage();
	             },
                 complete: function(){
                      KTApp.unblockPage();
                  },
                  success: function(response)
                  {	  
                  	  if(!response){
                  	  	 let option = '<option value="">No Data Available</option>';
	                  	 $('#subcat').append(option);  
	                  	 $('#subcat').addClass('selectpicker');
					 $('#subcat').attr('data-live-search', 'true');
					 $('#subcat').selectpicker('refresh');
                  	  }else{
                  	  	 for(let i=0;i<response.length;i++){
	                  	  	  let option = '<option value="'+response[i].id+'">'+response[i].name+'</option>';
	                  	  	  $('#subcat').append(option);  
	                  	  	  $('#subcat').addClass('selectpicker');
						  $('#subcat').attr('data-live-search', 'true');
						  $('#subcat').selectpicker('refresh');
                  	  	
                  	 	 }
                  	  }
                  	 
                  }                                    
		});	
	}
	var _initvoucher_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/voucher_option',
	             type: "POST",
	             dataType:"json",
	             beforeSend: function()
	             {
	                 KTApp.blockPage();
	             },
                 complete: function(){
                      KTApp.unblockPage();
                  },
                  success: function(response)
                  {	  
                  	  $('#voucher').val(response);
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
	                 KTApp.blockPage();
	             },
                 complete: function(){
                      KTApp.unblockPage();
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
                       Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");    
                 }                                      
		});	
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
			case "sub-category":{
				var sub_id = $('select[name=sub_id]');
				sub_id.empty();
				if(!response){
	                  	 sub_id.append('<option value="">No Data Available</option>');
	                  	 sub_id.addClass('selectpicker');
	                  	 sub_id.attr('data-live-search', 'true');  
					 sub_id.selectpicker('refresh');
                  	  }else{
                  	  	 for(let i=0;i<response.length;i++){
	                  	  	  sub_id.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
	                  	  	  sub_id.addClass('selectpicker');
	                  	  	  sub_id.attr('data-live-search', 'true');  
						  sub_id.selectpicker('refresh');
                  	  	
                  	 	 }
                  	  }
				break;
			}
			case "sub-category-update":{
				var sub_id = $('select[name=sub_id_update]');
				sub_id.empty();
				if(!response){
	                  	 sub_id.append('<option value="">No Data Available</option>');
	                  	 sub_id.addClass('selectpicker');
	                  	 sub_id.attr('data-live-search', 'true');  
					 sub_id.selectpicker('refresh');
                  	  }else{
                  	  	 for(let i=0;i<response.length;i++){
	                  	  	  sub_id.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
	                  	  	  sub_id.addClass('selectpicker');
	                  	  	  sub_id.attr('data-live-search', 'true');  
						  sub_id.selectpicker('refresh');
                  	  	
                  	 	 }
                  	  }
				break;
			}
		}
	}
	var _ViewController = async function(view){
		switch(view){
					case "data-profile-update":{
						let thisUrl = 'view_controller/View_Profile';
						_ajaxloader(thisUrl,"POST",false,"View_Profile");
						break;
					}
					case "data-banner-list":{
						let thisUrl = 'datatable_controller/Web_Banner_Data';
						_ajaxloader(thisUrl,"POST",false,"Web_Banner_Data_List");
						$(document).ready(function() {
							 $(document).on("click","#form-request",function() {
							 	let status = $(this).attr('data-action');
							 	$('input[name="page"]').val(status);
							 	if(status == 'Create'){
							 		$('.images').attr('src',''+baseURL+'assets/images/banner/default.png');
							 		// $('input[name="title"]').val('');
							 		// tinyMCE.get('kt-tinymce-1').setContent('');
							 		$('select[name="type"]').val('');
							 		$('input[name="previous_image"]').val('');
							 		$('input[name="id"]').val('');
							 		$('input[name="web_no"]').val('');
							 	}else if(status == 'Update'){
							 		let id = $(this).attr('data-id');
								 	let val = {id:id};
								 	let thisUrl = 'modal_controller/Modal_Web_Banner';
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Banner");
							 	}
						    });
							$('#image').on('change', function(imageInput) {
							   let action = $(this);
				                  var img = document.createElement('img');
							   var blob = URL.createObjectURL(event.target.files[0]);
							   let extension = action.val().replace(/^.*\./, '');
							  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
							  	  let previous= $('input[name="previous_image"]').val();
							  	  var images ='default.png';
							  	   if(previous.length > 0){
							  	   	var images = previous;
							  	   }
							  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=1600){
								      	if(img.height >=1200){

								      	 }else{
								      		Swal.fire("Ops!","Please upload minimum 1600x1200 size", "info");
								      		$('.images').attr('src',''+baseURL+'assets/images/banner/'+images+'');
								      	 	action.val('');
								      	 }
								       }else{
								       	Swal.fire("Ops!","Please upload minimum 1600x1200 size", "info");
								       	$('.images').attr('src',''+baseURL+'assets/images/banner/'+images+'');
								       	action.val('');
								       }
								    }
							  }else{
							  	Swal.fire("Ops!","Please upload minimum 1600x1200 size (jpg, jpeg, or png)", "info");
							  	action.val('');
							  }
							});
						})
					   break;
					}
					case "data-interior-list":{
						$(document).ready(function() {
							$(".upfile1g").click(function () {
							    $("#imagefileg").trigger('click');
							});
						 });
						let thisUrl = 'datatable_controller/Web_Interior_Data';
						_ajaxloader(thisUrl,"POST",false,"Web_Interior_Data_List");
						$(document).ready(function() {
							 $(document).on("click","#form-request",function() {
							 	let status = $(this).attr('data-action');
							 	$('input[name="page"]').val(status);
							 	if(status == 'Create'){
							 		$('.images').attr('src',''+baseURL+'assets_website/images/default.png');
							 		$('.background-image').attr('src',''+baseURL+'assets_website/images/default.png');
							 		$('input[name="title"]').val('');
							 		$('#description').summernote('code',' ');
							 		$('select[name="type"]').val('');
							 		$('select[name="status"]').val('');
							 		$('input[name="previous_image"]').val('');
							 		$('input[name="previous_bg"]').val('');
							 		$('input[name="id"]').val('');
							 		$('input[name="web_no"]').val('');
							 	}else if(status == 'Update'){
							 		let id = $(this).attr('data-id');
								 	let val = {id:id};
								 	let thisUrl = 'modal_controller/Modal_Web_Interior';
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Interior");
							 	}
						    });
						    $(document).on("click","#form-requests",function() {
							 		let id = $(this).attr('data-id');
								 	let val = {id:id};
								 	let thisUrl = 'modal_controller/Modal_Web_Interior_Image';
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Interior_Image");
						    });
						})
					   break;
					}
					case "data-events-list":{
						_initDatepicker('date_event');
						let thisUrl = 'datatable_controller/Web_Events_Data';
						_ajaxloader(thisUrl,"POST",false,"Web_Events_Data_List");
						$(document).ready(function() {
							 $(document).on("click","#form-request",function() {
							 	let status = $(this).attr('data-action');
							 	$('input[name="page"]').val(status);
							 	if(status == 'Create'){
							 		$('.images').attr('src',''+baseURL+'assets_website/images/default.png');
					  			 	$('input[name="previous_image"]').val('');
					  			 	$('input[name="id"]').val('');
								 	$('input[name="title"]').val('');
								 	$('input[name="location"]').val('');
								 	$('input[name="date_event"]').val('');
								 	$('input[name="time_event"]').val('');
								 	tinyMCE.get('kt-tinymce-10').setContent('');
								 	$('select[name="status"]').val('').change();
							 	}else if(status == 'Update'){
							 		let id = $(this).attr('data-id');
								 	let val = {id:id};
								 	let thisUrl = 'modal_controller/Modal_Web_Events';
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Events");
							 	}
						    });
						})
					   break;
					}
					case "data-product-list":{
						$(document).ready(function() {
							_initCurrency_format('#amount-pallet')
							_initCurrency_format('#amount');
							_initCurrency_format('#c_price');
							var avatar5 = new KTImageInput('kt_image_5');
							avatar5.on('change', function(imageInput) {
							   let action = $(this);
				                  var img = document.createElement('img');
							   var blob = URL.createObjectURL(event.target.files[0]);
							   let extension = $('input[name=profile_avatar]').val().replace(/^.*\./, '');
							  if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
							  	   img.src = blob;
								   img.onload = function() {
								      if(img.width>=360){
								      	if(img.height >=360){
								      		$('.image-add').css("background-image", "url(" + blob + ")");
								      	 }else{
								      		Swal.fire("Oops!","Please upload minimum 360x360 size", "info").then(function(){
								      			$('#kt_image_5 > span').trigger('click');
								      	 		$('#profile_avatar').val('');
								      		});
								      	 }
								       }else{
								       	Swal.fire("Oops!","Please upload minimum 360x360 size", "info").then(function(){
							      			$('#kt_image_5 > span').trigger('click');
							      	 		$('#profile_avatar').val('');
							      		})
								       }
								    }
							  }else{
							  	Swal.fire("Oops!","Please upload correct file. (jpg, jpeg & png)", "info").then(function(){
					      			$('#kt_image_5 > span').trigger('click');
					      	 		$('#profile_avatar').val('');
					      		})
							  }
							});
							var avatar6 = new KTImageInput('kt_image_6');
							avatar6.on('change', function(imageInput) {
				                  var img = document.createElement('img');
							   var blob = URL.createObjectURL(event.target.files[0]);
							    if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
								   img.src = blob;
								   img.onload = function() {
								      if(img.width>=360){
								      	if(img.height >=360){
								      		$('.image-color').css("background-image", "url(" + blob + ")");
								      	 }else{
								      		Swal.fire("Oops!","Please upload minimum 360x360 size", "info").then(function(){
								      			$('#kt_image_6 > span').trigger('click');
								       			$('#image_avatar').val('');
							      			})
								      	 }
								       }else{
								       	Swal.fire("Oops!","Please upload minimum 360x360 size", "info").then(function(){
								      			$('#kt_image_6 > span').trigger('click');
								       			$('#image_avatar').val('');
							      			})
								       }
								    }
								}else{
									Swal.fire("Oops!","Please upload correct file. (jpg, jpeg & png)", "info").then(function(){
					      				$('#kt_image_6 > span').trigger('click');
								       	$('#image_avatar').val('');
					      			})
								}
							});
							_initavatar_change('kt_image_6',360,360,'.image-color','#image_avatar');
							$(".upfile1").click(function(e){
								e.preventDefault()
							    $("#imagess").trigger('click');
							});
							$(".upfile1g").click(function(e){
								e.preventDefault()
							    $("#imagefileg").trigger('click');
							});
							$(".upfile2").click(function(e){
								e.preventDefault()
							    $("#imagefiless").trigger('click');
							});
							$(".upfile3").click(function(e){
								e.preventDefault()
							    $("#imagefilebtn").trigger('click');
							});
							$(".upfile4").click(function(e){
								e.preventDefault()
							    $("#imagefile4").trigger('click');
							});
							$(".tearsheets").click(function(e){
								e.preventDefault()
							    $("#tearsheets").trigger('click');
							});
							$(".tearsheet-btn").click(function(e){
								e.preventDefault()
							    $(".docs-btn").trigger('click');
							});
							$('.docs-btn').on('change',function(e){
								e.preventDefault();
								$('.docs-text').text(this.files && this.files.length ? this.files[0].name : '');
							});
							$(".tearsheet-btn1").click(function(e){
								e.preventDefault()
							    $(".docs-btn1").trigger('click');
							});
							$('.docs-btn1').on('change',function(e){
								e.preventDefault();
								$('.docs-text1').text(this.files && this.files.length ? this.files[0].name: '');
							});
							$('.cat-id').on('change',function(e){
								e.preventDefault();
								let id = $(this).val();
								_ajaxloaderOption('option_controller/SubCategory_option','POST',{id:id},'sub-category');
							});
				 			$(document).on('click','#close-add',function(e){
								$('.btn-close-image').trigger('click');
								$('input[name=docs]').val("");
								$('input[name=color]').val("");
								$('input[name=title]').val("");
								$('input[name=c_name]').val("");
								$('input[name=amount]').val("");
								$('select[name=cat_id]').val("").change();
								$('.docs-text').text("");
								$('#changeimage').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
				 			});
				 			$(document).on('click','#close-color',function(e){
								$('.btn-close-color').trigger('click');
								$('select[name=project_no]').val("").change();
								$('input[name=cc_name]').val("");
								$('input[name=docs_image]').val("");
								$('input[name=color_image]').val("");
								$('input[name=amount-pallet]').val("");
								$('.docs-text1').text("");
								$('#changeimage1').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
				 			});
							
						})
					   break;
					}
					case "data-category":{
						let thisUrl = 'datatable_controller/Web_Category_Data';
						_ajaxloader(thisUrl,"POST",false,"Web_Category_Data");
						$(document).ready(function() {
							$(document).on("click","#btn_category",function() {
							 	let id = $(this).attr('data-id');
							 	let val = {id:id};
							 	$('#Table_ProductCategory > tbody:last-child').empty();
							 	let thisUrl = 'datatable_controller/Web_SubCategory_Data';
								_ajaxloader(thisUrl,"POST",val,"Web_SubCategory_Data");
							 	
						     });
						     $(document).on("click","#btn_category_sub",function() {
							 	let id = $(this).attr('data-id');
							 	let val = {id:id};
							 	let thisUrl = 'datatable_controller/Web_ProductCategory_Data';
								_ajaxloader(thisUrl,"POST",val,"Web_ProductCategory_Data");

						     });
						    	$(document).on("click","#save",function() {
						 			let id = $(this).attr('data-id');
						 			let sub_id = $(this).attr('data-sub');
						 			let val = {id:id,sub_id:sub_id};
						 			let thisUrl = 'create_controller/Create_ProductCategory';
						 			_ajaxloader(thisUrl,"POST",val,"Create_ProductCategory");
						 	});
							$(document).on("click","#form-request",function() {
							 	let status = $(this).attr('data-action');
							 	let id = $(this).attr('data-id');
							 	$('#form_data').empty();
							 	if(status == 'sub_caterogy'){
							 		_initcategory_option();
							 		$('#form_data').append('<div class="form-group">'
							   		   +'<label>CATEGORY:</label>'
									   +'<select id="category" class="form-control form-control-solid" name="cat_id" required><option value="" disabled selected>SELECT CATEGORY</option></select>'
									   +'</div>'
									   +'<div class="form-group">'
							   		   +'<label>Sub Name:</label>'
							   		   +'<input type="hidden" name="page" value="create"/>'
									   +'<input type="text" class="form-control form-control-solid" name="sub_name" required/>'
									   +'</div>');
							 	}else if(status == 'add_product'){
								 	let thisUrl = 'modal_controller/Modal_Web_Product_Data';
								 	let val = {id:id};
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Product_Data");
							 	}else if(status == 'view_product'){
							 		let thisUrl = 'modal_controller/Modal_Web_Product_Color_Data';
								 	let val = {id:id};
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Product_Color_Data");
							 	}
							 	else if(status == 'sub_update'){
							 		let thisUrl = 'modal_controller/Modal_Web_SubCategory_Data';
								 	let val = {id:id};
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_SubCategory_Data");
							 	}else if(status == 'product_update'){
							 		let thisUrl = 'modal_controller/Modal_Web_ProductDetails_Data';
								 	let val = {id:id};
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_ProductDetails_Data");
							 	}else if(status =='update_status'){
							 		let thisUrl = 'modal_controller/Modal_Web_Category';
								 	let val = {id:id};
									_ajaxloader(thisUrl,"POST",val,"Modal_Web_Category");
							 	}
						     });
						})
						break;
					}
					case "data-company-profile":{
						$(document).ready(function() {
							$(".upfile1").click(function () {
							    $("#imagefile").trigger('click');
							});
							$(".upfile2").click(function () {
							    $("#imagefiles").trigger('click');
							});
						 });
						let thisUrl = 'view_controller/View_Web_Company_Profile';
						_ajaxloader(thisUrl,"POST",{id:1},"View_Web_Company_Profile");

						let thisUrl1 = 'view_controller/View_Web_Owner_Profile';
						_ajaxloader(thisUrl1,"POST",{id:1},"View_Web_Owner_Profile");
						break;
					}
					case "data-voucher-list":{
						$(document).on("click","#form-request",function() {
							var action = $(this).attr('data-action');
							var id = $(this).attr('data-id');
							var html ='';
							if(action == 'create'){
								_initvoucher_option();
								_initDatepicker('date_from');
								_initDatepicker('date_to');
								_initPercentage('#discount');
								$('#action').val('create');
								$('#date_from').val('');
								$('#date_to').val('');
								$('#add-voucher').modal('show');
							}else{
								let thisUrl = 'view_controller/View_Web_Voucher';
								let val = {id:id};
								_ajaxloader(thisUrl,"POST",val,"View_Web_Voucher");
							}
						});
						break;
					}
					case "data-shipping":{
						$(document).ready(function() {
								$(document).on("click","#form-request",function() {
								 	let id = $(this).attr('data-id');
								 	let val = {id:id};
									let thisUrl = 'modal_controller/Modal_Shipping_View';
								     _ajaxloader(thisUrl,"POST",val,"Modal_Shipping_View");
								 	
							    });
						});
						break;
					}
					case "data-testimony":{
						 var avatar5 = new KTImageInput('kt_image_5');
						$(document).on('click','.btn-create',function(e){
							e.preventDefault();
							let action = $(this).attr('data-action');
							$('input[name=page]').val(action);
							if(action == 'create'){
								$('input[name=id]').val("");
								$('input[name=name]').val("");
								$('textarea[name=description]').val("");
								$('.image-input-wrapper').css('background-image','url('+baseURL+'assets/images/testimony/default.jpg)');
							}else{
								let id = $(this).attr('data-id');
								$('input[name=id]').val(id);
							 	let val = {id:id};
								let thisUrl = 'modal_controller/Modal_Testimony_View';
							     _ajaxloader(thisUrl,"POST",val,"Modal_Testimony_View");
							}
						});
						break;
					}

		}
	}
	var _initavatar_change = function(action){
		 var avatar5 = new KTImageInput(action);
			avatar5.on('cancel', function(imageInput) {
			 swal.fire({
			  title: 'Image successfully changed !',
			  type: 'success',
			  buttonsStyling: false,
			  confirmButtonText: 'Awesome!',
			  confirmButtonClass: 'btn btn-primary font-weight-bold'
			 });
			});

			avatar5.on('change', function(imageInput) {
			   let action = $(this);
                  var img = document.createElement('img');
			   var blob = URL.createObjectURL(event.target.files[0]);
			   img.src = blob;
			   img.onload = function() {
	      		 swal.fire({
				  title: 'Image successfully changed !',
				  type: 'success',
				  buttonsStyling: false,
				  confirmButtonText: 'Awesome!',
				  confirmButtonClass: 'btn btn-primary font-weight-bold'
				 });
	      		}
			});
			
	}

	var _initView = async function(view,response)
	{
	  switch(view){
	  		
	  		case "Web_Banner_Data_List":{
	  			if(!response == false){
	  				$("#banner").empty();
		  			for(let i=0;i<response.length;i++){
						$('#banner').append('<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">'
									+'<div class="card card-custom gutter-b card-stretch"><div class="card-body text-center pt-4">'
									+'<div class="card-body text-center pt-4">'
									+'<div class="d-flex justify-content-end"><span class="label label-xl label-inline label-light-success">Slide '+response[i].type+'</span></div>'
									+'<div class="mt-7">'
									+'<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">'
									+'<img id="myImg" src="'+baseURL+'assets/images/banner/'+response[i].image+'" alt="image" style="width: 100%;height: 200px;object-fit: cover;"/></div></div>'
									+'<div class="mt-9"><button type="button" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase" data-toggle="modal" data-target="#exampleModal" id="form-request" data-id="'+response[i].id+'" data-action="Update">View Banner</button></div></div>'
									+'</div></div></div>');
		  			}
		  		}
		  		break;
	  		}
	  		case "Modal_Web_Banner":{
		  		 if(!response == false){
	  			 	$('.images').attr('src',baseURL+'assets/images/banner/'+response.image);
	  			 	$('input[name="previous_image"]').val(response.image);
	  			 	$('input[name="id"]').val(response.id);
				 	$('input[name="web_no"]').val(response.web_no);
				 	$('select[name="type"]').val(response.type).change();
		  		 }
	  		  break;
	  		}
	  		case "Web_Interior_Data_List":{
	  			if(!response == false){
	  				$("#interior").empty();
		  			for(let i=0;i<response.length;i++){
		  				if(response[i].cat_id == 1){
		  					var category = 'RESIDENTIAL';
		  				}else if(response[i].cat_id == 2){
		  					var category = 'COMMERCIAL';
		  				}else if(response[i].cat_id == 3){
		  					var category = 'EXPERIENCES';
		  				}

						$('#interior').append('<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">'
									+'<div class="card card-custom gutter-b card-stretch"><div class="card-body text-center pt-4">'
									+'<div class="card-body text-center pt-4">'
									+'<div class="d-flex justify-content-end"><span class="label label-xl label-inline label-light-success">'+response[i].status+'</span></div>'
									+'<div class="mt-7">'
									+'<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">'
									+'<img id="myImg" src="'+baseURL+'assets_website/images/'+response[i].image+'" alt="'+response[i].title+'" style="width: 100%;height: 200px;object-fit: cover;"/></div></div>'
									+'<div class="my-4">'
									+'<div class="text-dark font-weight-bold text-hover-primary font-size-h4">'+response[i].title+'</div></div>'
									+'<div class="my-4">'
									+'<div class="mb-10 mt-5 font-weight-bold">'+category+'</div></div>'
									+'<div class="my-lg-0 my-1">'
									+'<button type="button" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3" data-toggle="modal" data-target="#exampleModal" id="form-request" data-id="'+response[i].id+'" data-action="Update">View Detail</button>'
									+'</div></div>'
									+'</div></div></div>');
		  			}
		  		}
		  		break;
	  		}

	  	
	  		case "Modal_Web_Interior":{
		  		 if(!response == false){
		  			 	$('.images').attr('src',baseURL+'assets_website/images/'+response.image);
		  			 	$('input[name="previous_image"]').val(response.image);
		  			 	$('.background-image').attr('src',baseURL+'assets_website/images/'+response.bg);
		  				$('input[name="previous_bg"]').val(response.bg);
		  			 	$('input[name="id"]').val(response.id);
		  			 	$('select[name="status"]').val(response.status).change();
					 	$('input[name="title"]').val(response.project_name);
					 	$('#description').summernote('code',response.description);
					 	$('select[name="cat_id"]').val(response.cat_id).change();
		  		 }
	  		  break;
	  		}
	  		case "Modal_Web_Interior_Image":{
		  		if(!response == false){
		  			$('input[name=id]').val(response.row.id);
		  			$('#project_name').text(response.row.project_name);
		  			$('select[name=status]').val(response.row.status).change();
		  			$("#divgallery").empty();
		  			for(let i=0;i<response.data.length;i++){
		  				$("#divgallery").append('<div class="col-lg-2 col-xl-2" id="roww_'+response.data[i].id+'">'
				  			+'<div class="image-input image-input-empty image-input-outline" style="background-image: url('+baseURL+'assets_website/images/'+response.data[i].image+')">'
							+'<div class="image-input-wrapper"></div>'
							+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="deletes" data-id="'+response.data[i].id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
							+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
							+'	 </label>'
							+'  </div>'
				  			+'</div>');
		  			}
		  		}
		  		break;
		  	}
		  	case "Web_Events_Data_List":{
	  			if(!response == false){
	  				$("#events").empty();
		  			for(let i=0;i<response.length;i++){
						$('#events').append('<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">'
									+'<div class="card card-custom gutter-b card-stretch"><div class="card-body text-center pt-4">'
									+'<div class="card-body text-center pt-4">'
									+'<div class="d-flex justify-content-end"><span class="label label-xl label-inline label-light-success">'+response[i].status+'</span></div>'
									+'<div class="mt-7">'
									+'<div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover">'
									+'<img id="myImg" src="'+baseURL+'assets_website/images/'+response[i].image+'" alt="'+response[i].title+'" style="width: 100%;height: 200px;object-fit: cover;"/></div></div>'
									+'<div class="my-4">'
									+'<div class="text-dark font-weight-bold text-hover-primary font-size-h4">'+response[i].title+'</div></div>'
									+'<div class="my-4">'
									+'<div class="mb-10 mt-5 font-weight-bold">'+response[i].date_event+' || '+response[i].time_event+' || LOCATION: '+response[i].location+'</div></div>'
									+'<div class="my-lg-0 my-1">'
									+'<button type="button" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3" data-toggle="modal" data-target="#exampleModal" id="form-request" data-id="'+response[i].id+'" data-action="Update">View Detail</button>'
									+'</div></div>'
									+'</div></div></div>');
		  			}
		  		}
		  		break;
	  		}

	  		case "Modal_Web_Events":{
		  		 if(!response == false){
		  			 	$('.images').attr('src',baseURL+'assets_website/images/'+response.image);
		  			 	$('input[name="previous_image"]').val(response.image);
		  			 	$('input[name="id"]').val(response.id);
					 	$('input[name="title"]').val(response.title);
					 	$('input[name="location"]').val(response.location);
					 	$('input[name="date_event"]').val(response.date_event);
					 	$('input[name="time_event"]').val(response.time_event);
					 	tinyMCE.get('kt-tinymce-10').setContent(response.description);
					 	$('select[name="status"]').val(response.status).change();
		  		 }
	  		  break;
	  		}
		  	case "Create_ProductCategory":{
	  				Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
					       $('#row'+response.id).remove();
					});
			       break;
	  		}
	  		case "Modal_Web_Category":{
	  			
	  			$('#form_data').append('<div class="form-group">'
		   		   +'<label>Name: </label>'
		   		   +'<input type="hidden" name="page" value="updatecategory"/>'
		   		   +'<input type="hidden" name="id" value="'+response.id+'"/>'
				   +'<input type="text" class="form-control form-control-solid" name="cat_name" value="'+response.cat_name+'" readonly/>'
				   +'</div>'
	  			   +'<div class="form-group">'
		   		   +'<label>CATEGORY:</label>'
				   +'<select id="status" class="form-control form-control-solid" name="status" required><option value="" disabled>SELECT STATUS</option>'
				   +'<option value="ACTIVE">ACTIVE</option>'
				   +'<option value="INACTIVE">INACTIVE</option>'
				   +'</select>'
				   +'</div>');
	  			$('select[name=status]').val(response.status).change();
	  			break;
	  		}

		  	case "Modal_Web_SubCategory_Data":{
		  		_initcategory_option();
		  		$('#form_data').append('<div class="form-group">'
		   		   +'<label>CATEGORY:</label>'
				   +'<select id="category" class="form-control form-control-solid" name="cat_id" required><option value="'+response.cat_id+'" selected>'+response.cat_name+'</option></select>'
				   +'</div>'
				   +'<div class="form-group">'
		   		   +'<label>Sub Name:</label>'
		   		   +'<input type="hidden" name="page" value="update"/>'
		   		   +'<input type="hidden" name="sub_id" value="'+response.id+'"/>'
				   +'<input type="text" class="form-control form-control-solid" name="sub_name" value="'+response.sub_name+'" required/>'
				   +'</div>');
		  		break;
		  	}

	  		case "Modal_Web_ProductDetails_Data":{
	  			_initcategory_option();
		  		$('#category').val(response.cat_id).change();
		  		$('#subcat').val(response.sub_id).change();
		  		$(document).on("change","#category",function() {
		  			let cat_id = $(this).val();
		  			$('#subcat').empty(); 
		  			_initsubcategory_option(cat_id);
		  		});
		  		
		  		$('#form_data').append('<div class="form-group">'
		   		   +'<label>CATEGORY:</label>'
		   		   +'<input type="hidden" name="page" value="updateproduct"/>'
				   +'<select id="category" class="form-control form-control-solid" name="cat_id" required><option value="" disabled>SELECT CATEGORY</option></select>'
				   +'</div>'
				   +'<div class="form-group">'
		   		   +'<label>Sub Name:</label>'
				   +'<select id="subcat" class="form-control" name="sub_id" required><option value="'+response.sub_id+'">'+response.sub_name+'</option></select>'
				   +'</div>'
				   +'<label>Product:</label>'
		   		   +'<input type="hidden" name="project_no" value="'+response.id+'"/>'
				   +'<input type="text" class="form-control form-control-solid" name="sub_name" value="'+response.title+'" disabled/>'
				   +'</div>');
		  		break;
	  		}

		  	case "Web_Category_Data":{
		  		if(!response == false){
		  			for(let i=0;i<response.data.length;i++){
			  		    $('#Table_Category > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0">'+response.data[i].name+'</td>'
							+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button class="btn btn-icon btn-light btn-sm" id="form-request" data-id="'+response.data[i].id+'" data-action="update_status" data-toggle="modal" data-target="#exampleModal">'
							+'	<span class="svg-icon svg-icon-primary svg-icon-2x">'
							+'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
							+'	    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
							+'	        <rect x="0" y="0" width="24" height="24"/>'
							+'	        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>'
							+'	        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>'
							+'	    </g>'
							+'	</svg></span>'
							+'</button> <button type="button" id="btn_category" data-id="'+response.data[i].id+'" class="btn btn-icon btn-light btn-sm">'
		                         +'<span class="svg-icon svg-icon-success">'
		                         +'       <span class="svg-icon svg-icon-md">'
		                         +'           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
		                         +'               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
		                         +'                   <polygon points="0 0 24 0 24 24 0 24" />'
		                         +'                   <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />'
		                         +'                   <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />'
		                         +'               </g>'
		                         +'           </svg>'
		                         +'       </span>'
		                         +'   </span>'
		                         +'</button></td>'
							+'</tr>');
			  		}
		  		}
		  		 break;
		  	}
		  	case "Web_SubCategory_Data":{
		  		if(!response == false){
		  			$('#Table_Subcategory > tbody:last-child').empty();
		  			for(let i=0;i<response.data.length;i++){
			  		    $('#Table_Subcategory > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0">'+response.data[i].name+'</td>'
							+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button class="btn btn-icon btn-light btn-sm" id="form-request" data-id="'+response.data[i].id+'" data-action="add_product" data-toggle="modal" data-target="#ProductModal">'
							+'	<span class="svg-icon svg-icon-primary svg-icon-2x">'
							+'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
							+'	    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
							+'	        <rect x="0" y="0" width="24" height="24"/>'
							+'	        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>'
							+'	        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>'
							+'	    </g>'
							+'	</svg></span>'
							+'</button> ' 
							+'<button type="button" id="btn_category_sub" data-id="'+response.data[i].id+'" class="btn btn-icon btn-light btn-sm">'
		                         +'<span class="svg-icon svg-icon-success">'
		                         +'       <span class="svg-icon svg-icon-md">'
		                         +'           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
		                         +'               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
		                         +'                   <polygon points="0 0 24 0 24 24 0 24" />'
		                         +'                   <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />'
		                         +'                   <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />'
		                         +'               </g>'
		                         +'           </svg>'
		                         +'       </span>'
		                         +'   </span>'
		                         +'</button></td>'
							+'</tr>');
			  		}
		  		}
		  		break;
		  	}
		  	case "Web_ProductCategory_Data":{
		  		if(!response == false){
		  			$('#Table_ProductCategory > tbody:last-child').empty();
		  			for(let i=0;i<response.data.length;i++){
			  		    $('#Table_ProductCategory > tbody:last-child').append('<tr id="row_'+response.data[i].id+'" class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0">'+response.data[i].title+'</td>'
							+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="form-request" data-id="'+response.data[i].id+'" data-action="view_product" data-toggle="modal" data-target="#ProductModalView" class="btn btn-icon btn-light btn-sm">'
		                         +'<span class="svg-icon svg-icon-success">'
		                         +'       <span class="svg-icon svg-icon-md">'
		                         +'           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
		                         +'               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
		                         +'                   <polygon points="0 0 24 0 24 24 0 24" />'
		                         +'                   <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />'
		                         +'                   <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />'
		                         +'               </g>'
		                         +'           </svg>'
		                         +'       </span>'
		                         +'   </span>'
		                         +'</button></td>'
							+'</tr>');
			  		}
		  		}
		  		break;
		  	}
		  	case "Modal_Web_Product_Data":{
		  		if(!response == false){
		  			$('#subname').text(response.sub_name);
		  			$('#Table_Product > tbody:last-child').empty();
		  			for(let i=0;i<response.data.length;i++){
			  		    $('#Table_Product > tbody:last-child').append('<tr id="row'+response.data[i].id+'" class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0" >'+response.data[i].title+'</td>'
							+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response.data[i].id+'" data-sub="'+response.sub_id+'" class="btn btn-icon btn-light btn-sm">'
		                         +'<span class="svg-icon svg-icon-success">'
		                         +' <span class="svg-icon svg-icon-md">'
		                         +'          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'
							+'	    		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'
							+'	        		<rect x="0" y="0" width="24" height="24"/>'
							+'	        		<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>'
							+'	       		 <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>'
							+'	    		</g>'
							+'			</svg>'
							+'       </span>'
		                         +' </span>'
		                         +'</button></td>'
							+'</tr>');
			  		}
		  		}
		  		break;
		  	}
		  	case "Modal_Web_Product_Color_Data":{
		  		if(!response == false){
		  			$('#Table_Product_View > tbody:last-child').empty();
		  			for(let i=0;i<response.length;i++){
			  		    $('#Table_Product_View > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0" >'+response[i].title+'</td>'
							+'</tr>');
			  		}
		  		}
		  		break;
		  	}
		  	case "View_Web_Company_Profile":{
		  		var modal = document.getElementById("myModal");
				var img = $(".myImg");
				var modalImg = document.getElementById("img01");
				var captionText = document.getElementById("caption");
				 $(document).on("click",".myImg",function() {
				 	  modal.style.display = "block";
					  modalImg.src = this.src;
					  captionText.innerHTML = this.alt;
				 })
				var span = document.getElementsByClassName("close-image")[0];
				span.onclick = function() {
				  modal.style.display = "none";
				}
		  		$(".images").attr("src",baseURL + 'assets/images/logo/'+response.logo);
		  		$('#address').val(response.address);
		  		$('.company').val(response.company);
		  		$('#mobile').val(response.mobile);
		  		$('#email').val(response.email);
		  		$('#youtube').val(response.youtube);
		  		$('#instagram').val(response.instagram);
		  		$('#tweeter').val(response.tweeter);
		  		$('#facebook').val(response.facebook);
		  		$('#store_open').val(response.store_open);
		  		break;
		  	}
		  	case "View_Web_Owner_Profile":{
		  		var modal = document.getElementById("myModal");
				var img = $(".myImg");
				var modalImg = document.getElementById("img01");
				var captionText = document.getElementById("caption");
				 $(document).on("click",".myImg",function() {
				 	  modal.style.display = "block";
					  modalImg.src = this.src;
					  captionText.innerHTML = this.alt;
				 })
				var span = document.getElementsByClassName("close-image")[0];
				span.onclick = function() {
				  modal.style.display = "none";
				}
		  		$(".owner_image").attr("src",baseURL + 'assets/images/avatar/'+response.image);
		  		$('#owner_name').val(response.owner_name);
		  		$('#about').summernote('code',response.about_owner);
		  		$('#ourstory').summernote('code',response.our_story);
		  		$('#terms').summernote('code',response.terms);
		  		$('#privacy').summernote('code',response.privacy);
		  		$('#return').summernote('code',response.return_exchange);
		  		$('#shipping').summernote('code',response.shipping_policy);
		  		break;
		  	}
		  	case "View_Profile":{
		  		if(!response == false){
					$('input[name=previous_avatar]').val(response.image);
		  			$('input[name=firstname]').val(response.firstname);
		  			$('input[name=lastname]').val(response.lastname);
		  			$('input[name=middlename]').val(response.middlename);
		  			$('input[name=username]').val(response.username);
		  			$('.images').attr('src',baseURL+'assets/images/avatar/'+response.image);
		  			$(document).ready(function() {
						$(".upfile1").click(function () {
						    $("#imagefile").trigger('click');
						});
					 });
		  		}
		  		break;
		  	}
		  	case "View_Web_Voucher":{
		  		if(!response == false){
		  			let dis = parseFloat((response.discount*100)/1);
					$('#action').val('update');
					$('#voucher').val(response.promo_code);
					$('#discount').val(dis);
					$('#date_from').val(response.date_from);
					$('#date_to').val(response.date_to);
					_initDatepicker('date_from');
					_initDatepicker('date_to');
					_initPercentage('#discount');
					$('#add-voucher').modal('show');
		  		}
		  		break;
		  	}
		  	case "Modal_Shipping_View":{
		  		_initCurrency_format('#shipping_range');
		  		$('#id').val(response.id);
		  		$('#region').val(response.region);
		  		$('#shipping_range').val(response.shipping_range);
		  		break;
		  	}
		  	case "Modal_Testimony_View":{
		  		if(!response == false){
			  		$('input[name=name]').val(response.name);
			  		$('textarea[name=description]').text(response.description);
			  		$('input[name=previous_image]').val(response.image);
			  		$('#testimony-image').attr('style','background-image: url("'+baseURL+'assets/images/testimony/'+response.image+'");');
		  		}
		  		break;
		  	}
	  }
	}
	return {

		//main function to initiate the module
		init: function() {
			var viewForm = $('#kt_content').attr('data-table');
			$('.i-title').text(url_link);
			_ViewController(viewForm);
			_initView();
			_initImageView();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});
		