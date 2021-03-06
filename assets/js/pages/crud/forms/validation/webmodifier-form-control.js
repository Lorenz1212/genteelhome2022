'use strict';
// Class definition
var KTFormControls = function () {
	var validation;var form;var url;var thisURL;var val;
	var id;var production_no;var status;var item;var quantity;var remarks;var status;
	var supplier;var payment;var received;var balance;var amount;var warehouse_status;
	var unit;var designer;var production;var supervisor;var superuser;var admin;var role;
	var no;var unit;var accounting;
	var data;
	var _avatar;
	var _initSwalWarning = function(url){
	     Swal.fire("Warning!", "Please Complete the form!", "warning");
	}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       window.location = url;
		});
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
	}
	var _initToastSuccess = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initToastWarning = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'warning',title: 'Nothing to change'});
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
                 KTApp.blockPage();
             },
            complete: function(){
                 KTApp.unblockPage();
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
                       Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");    
              }
                                                     
		});
	}
	var _ajaxForm_loaded = async function(thisURL,type,val,view,url){
		$.ajax({
              url: thisURL,
              type: type,
              data: val,
              dataType:"json",
            beforeSend: function(){
                 KTApp.blockPage();
             },
            complete: function(){
                 KTApp.unblockPage();
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
                       Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");    
              }
                                                     
		});
	}	

	 var _FormSubmit = async function(action){
	 	switch(action){
	 	     case "Create_Company_Profile":{
	 			$(document).on('click','.save',function(e){
	 				 var action = $(this).attr('id');
	 				 if(action =='save_company'){
	 				 	data = $('input[name=company]').val();	
	 				 }else if(action == 'save_mobile'){
	 				 	data = $('input[name=mobile]').val();	
	 				 }else if(action == 'save_email'){
	 				 	data = $('input[name=email]').val();
	 				 }else if(action == 'save_facebook'){
	 				 	data = $('input[name=facebook]').val();
	 				 }else if(action == 'save_instagram'){
	 				 	data = $('input[name=instagram]').val();
	 				 }else if(action == 'save_tweeter'){
	 				 	data = $('input[name=tweeter]').val();
	 				 }else if(action == 'save_youtube'){
	 				 	data = $('input[name=youtube]').val();
	 				 }else if(action == 'save_address'){
	 				 	data = $('input[name=address]').val();
	 				 }else if(action == 'save_open'){
	 				 	data = $('input[name=store_open]').val();
	 				 }
	 				 val = {data:data,action:action};
	 				 thisURL = baseURL + 'update_controller/Update_Web_Company_Profile';
				  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Company_Profile",false);
	 			});
	 			$(document).on('click','.saves',function(e){
	 				 var action = $(this).attr('id');
	 				 if(action =='save_ownername'){
	 				 	data = $('input[name=owner_name]').val();	
	 				 }else if(action == 'save_about'){
	 				 	data = $('#about').summernote('code');
	 				 }else if(action == 'save_ourstory'){
	 				 	data = $('#ourstory').summernote('code');
	 				 }else if(action == 'save_terms'){
	 				 	data = $('#terms').summernote('code');
	 				 }else if(action == 'save_privacy'){
	 				 	data = $('#privacy').summernote('code');
	 				 }else if(action == 'save_return'){
	 				 	data = $('#return').summernote('code');
	 				 }else if(action == 'save_shipping'){
	 				 	data = $('#shipping').summernote('code');
	 				 }
	 				 val = {data:data,action:action};
	 				 thisURL = baseURL + 'update_controller/Update_Web_About_Us';
				  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Web_About_Us",false);
	 			});
	 			$(document).on('click','.save_image',function(e){
	 				var files = $('input[name=image]')[0].files;
	 				if(files.length == 0){
	 					_initToast('error','No Image Upload!');
	 				}else{
	 					let fd = new FormData();
	        				fd.append('file',files[0]);
		 				 thisURL = baseURL + 'update_controller/Update_Web_Company_Image';
					  	 _ajaxForm(thisURL,"POST",fd,"Update_Web_Company_Image",false);
	 				}
	 				
	 			});
	 			$(document).on('click','.save_imageowner',function(e){
	 				var files = $('input[name=owner_image]')[0].files;
	 				if(files.length == 0){
	 					_initToast('error','No Image Upload!');
	 				}else{
	 					let fd = new FormData();
	        				fd.append('file',files[0]);
		 				thisURL = baseURL + 'update_controller/Update_Web_Owner_Image';
					  	_ajaxForm(thisURL,"POST",fd,"Update_Web_Owner_Image",false);
	 				}
	 				
	 			});
	 			break;
	 		}
	 		case "Create_Update_Voucher":{
		 			$('#Create_Update_Voucher').on('submit', function(e){
		 				e.preventDefault();
		 				var element = this;
		 				var action = $('#action').val();
		 				var formData = new FormData(element);
				     	if(action == 'create'){
				   			 thisURL = baseURL + 'create_controller/Create_Web_Voucher';
						}else{
							thisURL = baseURL + 'update_controller/Update_Web_Voucher';
						}
		 				_ajaxForm(thisURL,"POST",formData,"Create_Web_Voucher",false);

		 			});
	 			break;
	 		}
	 		case "Update_Shipping_Range":{
	 			$(document).on('click','#save',function(e){
	 				 var id = $('#id').val();
	 				 var fee = $('#shipping_range').val();
	 				 val = {id:id,fee:fee};
	 				 thisURL = baseURL + 'update_controller/Update_Shipping_Range';
				  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Shipping_Range",false);
	 			});
	 			break;
	 		}
	 		case "Create_Update_Testimony":{
	 			$('#Create_Update_Testimony').on('submit', function(e){
	 				e.preventDefault();
	 				var element = this;
	 				var action =$('input[name=page]').val();
	 				var files = $('input[name=profile_avatar]')[0].files;
	 				var formData = new FormData(element);
		 			formData.append('image',files[0]);
			     	if(action == 'create'){
			   			 thisURL = baseURL + 'create_controller/Create_Web_Testimony';
					}else{
						formData.append('id',$('input[name=id]').val());
						formData.append('previous',$('input[name=previous_image]').val());
						thisURL = baseURL + 'update_controller/Update_Web_Testimony';
					}
		 			_ajaxForm(thisURL,"POST",formData,"Create_Update_Testimony",false);
		 		});
		 		$(document).on('click','.btn-delete',function(e){
		 			e.preventDefault();
	 				var id = $(this).attr('data-id'); 
				  	 Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Delete!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
						   	   val = {id:id};
				 			   thisURL = baseURL + 'delete_controller/Delete_Testimony';
							    _ajaxForm_loaded(thisURL,"POST",val,"Create_Update_Testimony",false);
					         }
					   	 });	
	 			});
	 			break;
	 		}
	 	}
	 }

	 var _constructData = async function(view,response,url){
	 	switch(view){
	 		//Create
	 		case "Update_Web_About_Us":{
	 			if(response == 'no image'){
	 				_initToast('error','No Image Upload!');
	 			}else if(response == 'success'){
	 				_initToast('success','Saved Changes');
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			break;
	 		}
	 		case "Update_Web_Owner_Image":{
	 			if(response == 'no image'){
	 				_initToast('error','No Image Upload!');
	 			}else if(response == 'success'){
	 				_initToast('success','Saved Changes');
	 				$('#customFiles').val("");
	 				$('#imagefiles').val("");
	 			}else{
	 				_initToast('error','Nothing Changes');
	 				$('#customFile').val("");
	 				$('#imagefile').val("");
	 			}
	 			break;
	 		}
	 		case "Update_Web_Company_Image":{
	 			if(response == 'no image'){
	 				_initToast('error','No Image Upload!');
	 			}else if(response == 'success'){
	 				_initToast('success','Saved Changes');
	 				$('#customFile').val("");
	 				$('#imagefile').val("");
	 			}else{
	 				_initToast('error','Nothing Changes');
	 				$('#customFile').val("");
	 				$('#imagefile').val("");
	 			}
	 			break;
	 		}
	 		case "Update_Company_Profile":{
	 			if(response == 'no image'){
	 				_initToast('error','No Image Upload!');
	 			}else if(response == 'success'){
	 				_initToast('success','Saved Changes');
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			break;
	 		}
	 		case "Create_Update_Events":{
	 			if(response.status == 'success'){
	 				Swal.fire("Created Successfully!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
	 			}
	 			break;
	 		}
	 		case "Create_Update_Interior":{
	 			if(response.status == 'create'){
	 				Swal.fire("Create Successfully!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
	 			}else if(response.status == 'update'){
	 				Swal.fire("Save Changes!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
	 			}else{
	 				Swal.fire("Error!", response.message, "error");
	 			}
	 			break;
	 		}
	 		case "Create_Update_Banner":{
	 			if(response.status == 'create'){
	 				Swal.fire("Create Successfully!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
	 			}else if(response.status == 'update'){
	 				Swal.fire("Save Changes!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
	 			}else{
	 				 Swal.fire("Warning!", "Image is incorrect format!", "question");
                	}
	 			break;
	 		}
	 		case "Create_Web_SubCategory":{
	 			if(response.status=="success"){
	 				_initSwalSuccess(url);
                 	}else if(response.status =='error'){
                 		 Swal.fire("Warning!", "Sub Name is already used!", "warning");
                 	}else if(response.status =='nothing'){
                 		_initToastWarning();
                 	}else if(response.status == 'change'){
                 	    Swal.fire("Update!", "All text fields are correct and recorded!", "success").then(function(){
					     location.reload();
				    });
                 	}else if(response.status =='product_change'){
                 		  Swal.fire("Update!", "All text fields are correct and recorded!", "success").then(function(){
					       $('#row_'+response.id).remove();
				    });
                 	}
	 			break;
	 		}
	 		case "Create_Project_Price":{
	 			if(response == 'success'){
	 				_initToast('success','Save Changes');
	 			}else{
	 				_initToast('info','Nothing Changes');
	 			}
	 			break;
	 		}
	 		
	 		case "Create_Web_Project_Image":{
	 			if(response.status == 'maximum'){
	 				Swal.fire("Warning!", "You exceed the maximum number of 15 images!", "warning");
	 				$('#customFile').val("");
		 			document.getElementById("imagess").value = null;
	 			}else if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 $('#customFile').val(" ");
		 			 document.getElementById("imagess").value = null;
	 			}else if(response.status == 'success'){
	 				$("#divimages").prepend('<div class="col-lg-2 col-xl-2 mb-5" id="row_'+response.id+'">\
		  									  <div class="row">\
		  									  	<div class="col-lg-12 col-xl-12">\
			  										<div class="symbol symbol-50 symbol-lg-150">\
														<img alt="Pic" id="myImg" src="'+baseURL+'assets/images/finishproduct/product/'+response.image+'" class="">\
													</div>\
												</div>\
													<div class="col-lg-12 col-xl-12">\
													   <button class="btn btn-danger btn-sm btn-block" id="delete" data-id="'+response.id+'">Remove</button>\
													</div>\
												</div>\
		  									</div>');
	 				_initToast('success','Save Changes');
		 			$('#customFile').val(" ");
		 			document.getElementById("imagess").value = "";
	 			}
	 			break;
	 		}
	 		case "Create_Web_Project_Category":
	 		case "Create_Project_Title":
	 		case "Create_Project_Status":{
	 			_initToast('success','Saved Changes!');
	 			break;
	 		}
	 		case "Create_Web_Project_Gallery":{
	 			if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 document.getElementById('customFileg').value = "";
		 			 document.getElementById('imagefileg').value = "";
	 			}else if(response.status == 'success'){
	 				$("#divgallery").prepend('<div class="col-lg-2 col-xl-2" id="row_'+response.id+'">'
				  			+'<div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url('+baseURL+'assets/images/finishproduct/product/'+response.image+')">'
							+'<div class="image-input-wrapper"></div>'
							+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="deletes" data-id="'+response.id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
							+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
							+'	 </label>'
							+'  </div>'
				  			+'</div>');
	 				_initToast('success','Saved Changes!');
		 			document.getElementById('customFileg').value = "";
		 			document.getElementById('imagefileg').value = "";
	 			}
	 			break;
	 		}
	 		case "Create_Web_Project_Tearsheet":{
	 			if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 document.getElementById('tearsheetss').value = "";
		 			 document.getElementById('tearsheets').value = "";
	 			}else if(response.status == 'success'){
	 				$("#tearsheet_href").attr("href",baseURL + 'assets/images/tearsheet/'+response.image);
	 				_initToast('success','Saved Changes!');
		 			document.getElementById('tearsheetss').value = "";
		 			document.getElementById('tearsheets').value = "";
	 			}
	 			break;
	 		}
	 		case "Create_Web_Change_Pallet":{
	 			if(response.status == 'success'){
	 				_initToast('success','Saved Changes!');
	 				$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
	 				$("#c_previous").val(response.c_image);
	 			}
	 			break;
	 		}
	 		case "Delete_Web_Project_Image":{
	 				_initToast('success','Image Delete Successfully');
				     $('#row_'+response).remove();
			     break;
	 		}
	 		case "Delete_Web_Project_Gallery":{
	 				Swal.fire("Deleted!", "Image Delete Successfully", "success").then(function(){
					      $('#row_'+response.id).remove();
				     });
			     break;
	 		}
	 		case "View_Profile":{
	  		if(!response == false){
	  			 _initAvatar('avatar');	
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
	  		case "Update_Profile":{
	 			if(response == 'no image'){
	 				 _initToast('error','No Image Upload!');
	 			}else if(response == 'success'){
	 				 _initToast('success','Saved Changes');
	 			}else if(response == 'existing'){
	 				 _initToast('error','Username Is already Existing');
	 			}else{
	 				 _initToast('error','Nothing Changes');
	 			}
	 			break;
	 		}
	 		case "Create_Web_Voucher":{
	 			if(response.type == 'success'){
	 			   _initToast(response.type,response.message);
	 			   $('#add-voucher').modal('hide');
	 			}
	 			break;
	 		}
	 		case "Update_Shipping_Range":{
	 			_initToast('success','Save Changes!');
				 $('#requestModal').modal('hide');
	 			break;
	 		}
	 		case "Create_Interior_Status":{
	 			_initToast('success','Saved Changes!');
	 			break;
	 		}
	 		case "Create_Web_Interior_Image":{
	 			if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 document.getElementById('customFileg').value = "";
		 			 document.getElementById('imagefileg').value = "";
	 			}else if(response.status == 'success'){
	 				$("#divgallery").prepend('<div class="col-lg-2 col-xl-2" id="roww_'+response.id+'">'
				  			+'<div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url('+baseURL+'assets_website/images/'+response.image+')">'
							+'<div class="image-input-wrapper"></div>'
							+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="deletes" data-id="'+response.id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
							+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
							+'	 </label>'
							+'  </div>'
				  			+'</div>');
	 				_initToast('success','Saved Changes!');
		 			document.getElementById('customFileg').value = "";
		 			document.getElementById('imagefileg').value = "";
	 			}else{
	 				Swal.fire("Error!", 'Image is incorrect format!', "error");
	 				document.getElementById('customFileg').value = "";
		 			document.getElementById('imagefileg').value = "";
	 			}
	 			break;
	 		}
	 		case "Delete_Web_Interior_Image":{
	 				Swal.fire("Deleted!", "Image Deleted", "error").then(function(){
					      $('#roww_'+response.id).remove();
				     });
			     break;
	 		}
	 		case "Create_Update_Testimony":{
	 			if(response.status == 'create'){
	 				_initToast('success','Create Successfully!');
	 				 $('#staticBackdrop').modal('hide');
				 	 $('input[name=profile_avatar]').val(response.image);
	 			}else if(response.status == 'error'){
	 				_initToast('success','Delete Successfully!');
	 				KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response.data);
	 			}else if (response.status == 'update'){
	 				_initToast('success','Save Changes!');
	 				 $('#staticBackdrop').modal('hide');
				 	 $('input[name=profile_avatar]').val(response.image);
	 			}else{
	 				Swal.fire("Error!", 'Image is incorrect format!', "info");
	 			}
	 			
	 			break;
	 		}
	 		case "Create_Web_Finishproduct":{
	 			if(response.status == 'error'){
	 				Swal.fire("Error!", response.message, "error");
	 			}else{
					Swal.fire("Created Successfully!", "All text fields are correct and recorded!", "success").then(function(){
					       location.reload();});
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
