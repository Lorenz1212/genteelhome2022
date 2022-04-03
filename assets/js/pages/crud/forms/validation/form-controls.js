'use strict';
// Class definition
var KTFormControls = function () {
	var validation;
	var form;
	var url;
	var thisURL;
	var val;
	var keys = [];
	var myData = {};
	var id;
	var production_no;
	var status;
	var item;
	var remarks;
	var status;
	var supplier;
	var payment;
	var received;
	var balance;
	var amount;
	var unit;
	var designer;
	var production;
	var supervisor;
	var superuser;
	var admin;
	var role;
	var no;
	var unit;
	var accounting;
	var amount;
	var webmodifier;
	var sales;
	var _initSwalWarning = function(url){Swal.fire("Warning!", "Please Complete the form!", "warning");}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){window.location = url;});
	}
	var _initToastSuccess = function(){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
	}
	var _initnotificationupdate = function(){
		 let url = window.location.pathname;
		 let urlpost;
		 if(url.split('/')[0] == 'genteelhome2022'){
		 	urlpost = url.split('/')[2];
		 }else if(url.split('/')[1] == 'genteelhome2022'){
		 	urlpost = url.split('/')[3];
		 }else if(url.split('/')[2] == 'genteelhome2022'){
		 	urlpost = url.split('/')[4];
		 }else if(url.split('/')[3] == 'genteelhome2022'){
		 	urlpost = url.split('/')[6];
		 }
		 if(urlpost == 'designer'){
		 	_ajaxloaderOption('Dashboard_controller/designer_dashboard','POST',false,'designer');
		 }else if(urlpost =='production'){
		 	_ajaxloaderOption('Dashboard_controller/production_dashboard','POST',false,'production');
		 }else if(urlpost == 'sales'){
		 	_ajaxloaderOption('Dashboard_controller/sales_dashboard','POST',false,'sales');
		 }else if(urlpost =='supervisor'){

		 }else if(urlpost == 'superuser'){
		 	_ajaxloaderOption('Dashboard_controller/superuser_dashboard','POST',false,'superuser');
		 }else if(urlpost == 'admin'){

		 }else if(urlpost == 'accounting'){

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
			case "designer":{
				$('.request_stocks').text(response.request_stocks);
				$('.approved_stocks').text(response.approved_stocks);
				$('.rejected_stocks').text(response.rejected_stocks);
				$('.request_project').text(response.request_project);
				$('.approved_project').text(response.approved_project);
				$('.rejected_project').text(response.rejected_project);
				$('.request_stocks_project').text(parseInt(response.request_stocks+response.request_project));

				$('.request_jo_stocks').text(response.request_jo_stocks);
				$('.request_jo_project').text(response.request_jo_project);
				$('.request_jo').text(response.request_jo_designer);

				$('.request_material_pending').text(response.request_material_pending);
				$('.request_material_received').text(response.request_material_received);
				$('.request_material_cancelled').text(response.request_material_cancelled);
				break;
			}
			case "production":{
				$('.request_jo_stocks_production').text(response.request_jo_stocks);
				$('.request_jo_project_production').text(response.request_jo_project);
				$('.request_jo_production').text(response.request_jo_production);
				$('.sales_count').text(response.request_salesorder);
				$('.sales_project').text(response.request_sales_project);
				$('.sales_stocks').text(response.request_sales_stocks);

				$('.sales_shipping_stocks').text(response.sales_shipping_stocks);
				$('.sales_deliver_stocks').text(response.sales_deliver_stocks);

				$('.sales_shipping_project').text(response.sales_shipping_project);
				$('.sales_deliver_project').text(response.sales_deliver_project);

				$('.request_material_pending').text(response.request_material_pending);
				$('.request_material_received').text(response.request_material_received);
				$('.request_material_cancelled').text(response.request_material_cancelled);
				break;
			}
			case "sales":{
				$('.sales_count').text(response.request_salesorder);
				$('.sales_project').text(response.request_sales_project);
				$('.sales_stocks').text(response.request_sales_stocks);

				$('.sales_shipping_stocks').text(response.sales_shipping_stocks);
				$('.sales_deliver_stocks').text(response.sales_deliver_stocks);

				$('.sales_shipping_project').text(response.sales_shipping_project);
				$('.sales_deliver_project').text(response.sales_deliver_project);
				$('.customer_count').text(response.customer_service_request);
				$('.customer_request_count').text(response.customer_service_request);
				$('.customer_approved_count').text(response.customer_service_approved);
				break;
			}
			case "superuser":{
				$('.request_count').text(response.total_request);
				$('.customer_concern_count').text(response.customer_service_request);

				$('.customer_request_count').text(response.customer_service_request);
				$('.customer_approved_count').text(response.customer_service_approved);
				
				$('.return_item_good').text(response.return_item_good);
				$('.return_item_rejected').text(response.return_item_rejected);
				$('.return_item_customer_repair').text(response.return_item_customer_repair);
				$('.return_item_customer_good').text(response.return_item_customer_good);
				$('.return_item_customer_rejected').text(response.return_item_customer_rejected);

				$('.request_material_pending').text(response.request_material_pending);
				$('.request_material_received').text(response.request_material_received);
				$('.request_material_cancelled').text(response.request_material_cancelled);

				$('.sales_project').text(response.request_sales_project);
				$('.sales_stocks').text(response.request_sales_stocks);

				$('.sales_deliver_stocks').text(response.sales_deliver_stocks);
				$('.sales_deliver_project').text(response.sales_deliver_project);
				break;
			}
			
		}
	}
	var _DataTableLoader = async function(link,TableURL,TableData,url_link){
		var table = $('#'+link);
		table.DataTable().clear().destroy();
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			destroy: true,
			responsive: true,
			info: true,
			language: { 
			 	infoEmpty: "No records available", 
			 },
			serverSide:false,
			ajax: {
				url: TableURL,
				type: 'POST',
				datatype: "json",
				data: {status:url_link},
			},
			columns:TableData,
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
		 	   case "Update_Request_Materials":{
		 	   		$('.Update_Request_Materials').on('click',function(e){
		 	   			if($('input[name=quantity]').val() == 0){
		 	   				Swal.fire("Oopps!", "Please input request quantity", "error"); 
		 	   			}else{
		 	   			 Swal.fire({
                                 title: "Are you sure you want to submit the request?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',$('#title-item').attr('data-id'));
                                       formData.append('qty',$('input[name=quantity]').val());
                                       formData.append('balance',$('input[name=balance]').val());
                                    thisURL = baseURL + 'update_controller/Update_Request_Materials';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Request_Materials",false);
                             }
                          });
                         }
		 	   		})
		 	   		$('body').delegate('.btn-cancelled','click',function(e){
		 	   			e.preventDefault();
		 	   			e.stopImmediatePropagation();
		 	   			let id =$(this).attr('data-id');
		 	   			Swal.fire({
                                 title: "Are you sure you want to cancel this item?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',id);
                                    thisURL = baseURL + 'update_controller/Update_Request_Materials_Cancelled';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Request_Materials_Cancelled",false);
                             }
                          });
		 	   		});
		 		  	break;
		 	   }
               case "Update_Salesorder_Stock_Request":{
                    $('.btn-status-save').on('click', function(e){
                         let status = $(this).attr('data-status');
                          Swal.fire({
                                 title: "Are you sure?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',$('.so_no').attr('data-id'));
                                       formData.append('status',status);
                                    thisURL = baseURL + 'update_controller/Update_Salesorder_Stock_Request';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Salesorder_Stock_Request",false);
                             }
                          });
                     });
                    break;
               }
               case "Update_Salesorder_Project_Request":{
                    $('.btn-status-save').on('click', function(e){
                         let status = $(this).attr('data-status');
                          Swal.fire({
                                 title: "Are you sure?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',$('.so_no').attr('data-id'));
                                       formData.append('status',status);
                                    thisURL = baseURL + 'update_controller/Update_Salesorder_Project_Request';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Salesorder_Project_Request",false);
                             }
                          });
                     });
                    break;
               }
               case "Update_Salesorder_Stock_Delivery":{
                    $('.btn-save').on('click', function(e){
                          Swal.fire({
                                 title: "Are you sure?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',$('.so_no').attr('data-id'));
                                       formData.append('si_no',$('input[name="si_no"]').val());
                                    thisURL = baseURL + 'update_controller/Update_Salesorder_Stock_Delivery';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Salesorder_Stock_Delivery",false);
                             }
                          });
                     });
                    break;
               }
               case "Update_Salesorder_Project_Delivery":{
                    $('.btn-save').on('click', function(e){
                          Swal.fire({
                                 title: "Are you sure?",
                                 text: "You won't be able to revert this",
                                 icon: "warning",
                                 confirmButtonText: "Submit!",
                                 showCancelButton: true
                             }).then(function(result) {
                                 if (result.value) {
                                   let formData = new FormData();
                                       formData.append('id',$('.so_no').attr('data-id'));
                                       formData.append('si_no',$('input[name="si_no"]').val());
                                    thisURL = baseURL + 'update_controller/Update_Salesorder_Project_Delivery';
                                    _ajaxForm(thisURL,"POST",formData,"Update_Salesorder_Project_Delivery",false);
                             }
                          });
                     });
                    break;
               }
	 		case "Update_Approval_Concern":{
	 			$(document).ready(function() {
					 $(document).on("click","#btn_save",function() {
					 	let action = $(this).attr('data-action');
					 	let id = $('#production_no').attr('data-id');
						thisURL = baseURL + 'update_controller/Update_Approval_Concern';
						 _ajaxForm_loaded(thisURL,"POST",{id:id,action:action},"Update_Approval_Concern",false);
				    });
				})
	 			break;
	 		}

	 		//Designer
	 		case "Create_Design_Stocks":{
	 			form = document.getElementById('Create_Design_Stocks');
				         validation = FormValidation.formValidation(
							form,
							{
								fields: {
									 image: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an image'
						                   },
						                   file: {
						                       extension: 'jpeg,jpg,png',
						                       type: 'image/jpeg,image/png,image/jpg',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
						            color: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please Enter Pallete Color Name & Image'
						                   },
						                   file: {
						                       extension: 'jpeg,jpg,png',
						                       type: 'image/jpeg,image/png,image/jpg',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								docs: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an spcecification (docs/pdf)'
						                   },
						                   file: {
						                       extension: 'doc,pdf,xls',
						                       type: 'application/msword,application/pdf',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								title: {
										validators: {
											notEmpty: {
												message: 'Project Title is required'
											}
										}
									}
								
								},

								plugins: { //Learn more: https://formvalidation.io/guide/plugins
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap(),
				                    icon: new FormValidation.plugins.Icon({
				                    valid: 'fa fa-check',
				                    invalid: 'fa fa-times',
				                    validating: 'fa fa-refresh'
				                }),
							}
						   }
					    );
	 			$('#Create_Design_Stocks').on('submit', function(e){
	 				e.preventDefault();
	 				var element = this;
	 				var formData = new FormData(element);
	 				validation.validate().then(function(status) {
				     if (status == 'Valid') {
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
						  	 thisURL = baseURL + 'create_controller/Create_Design_Stocks';
						  	 _ajaxForm(thisURL,"POST",formData,"Create_Design_Stocks",false);
				         }
				   	 });
				    }
			   	 });
	 		      });
	 			break;
	 		}

	 		case "Create_Design_Existing":{
	 			form = document.getElementById('Create_Design_Existing');
				         validation = FormValidation.formValidation(
							form,
							{
								fields: {
								 image: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an image'
						                   },
						                   file: {
						                       extension: 'jpeg,jpg,png',
						                       type: 'image/jpeg,image/png,image/jpg',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
						            color: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please Enter Pallete Color Name & Image'
						                   },
						                   file: {
						                       extension: 'jpeg,jpg,png',
						                       type: 'image/jpeg,image/png,image/jpg',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								docs: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an spcecification (docs/pdf)'
						                   },
						                   file: {
						                       extension: 'doc,pdf,xls',
						                       type: 'application/msword,application/pdf',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								project_no: {
										validators: {
											notEmpty: {
												message: 'Project Title is required'
											}
										}
									}
								
								},

								plugins: { //Learn more: https://formvalidation.io/guide/plugins
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap(),
				                    icon: new FormValidation.plugins.Icon({
				                    valid: 'fa fa-check',
				                    invalid: 'fa fa-times',
				                    validating: 'fa fa-refresh'
				                }),
							}
						   }
					    );
	 			$('#Create_Design_Existing').on('submit', function(e){
	 				e.preventDefault();
	 				var element = this;
	 				var formData = new FormData(element);
	 				validation.validate().then(function(status) {
				     if (status == 'Valid') 
				     {
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
						  	 thisURL = baseURL + 'create_controller/Create_Design_Existing';
						  	 _ajaxForm(thisURL,"POST",formData,"Create_Design_Stocks",false);
				         }
				   	 });
				    }
			   	 });
	 		});
	 			break;
	 		}
	 		case "Create_Design_Project":{
	 			form = document.getElementById('Create_Design_Project');
				         validation = FormValidation.formValidation(
							form,
							{
								fields: {
									 image: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an image'
						                   },
						                   file: {
						                       extension: 'jpeg,jpg,png',
						                       type: 'image/jpeg,image/png,image/jpg',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								docs: {
						               validators: {
						                   notEmpty: {
						                       message: 'Please select an spcecification (docs/pdf)'
						                   },
						                   file: {
						                       extension: 'doc,pdf,xls',
						                       type: 'application/msword,application/pdf',
						                       message: 'The selected file is not valid'
						                   },
						               }
						           },
								title: {
										validators: {
											notEmpty: {
												message: 'Project Title is required'
											}
										}
									}
								
								},
								plugins: { //Learn more: https://formvalidation.io/guide/plugins
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap(),
				                    icon: new FormValidation.plugins.Icon({
				                    valid: 'fa fa-check',
				                    invalid: 'fa fa-times',
				                    validating: 'fa fa-refresh'
				                }),
							}
						   }
					    );
	 			$('#Create_Design_Project').on('submit', function(e){
	 				e.preventDefault();
	 				var element = this;
	 				var formData = new FormData(element);
	 				validation.validate().then(function(status) {
				     if (status == 'Valid') {
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
						  	 thisURL = baseURL + 'create_controller/Create_Design_Project';
						  	 _ajaxForm(thisURL,"POST",formData,"Create_Design_Stocks",false);
				         }
				   	 });
				    }
			   	 });
	 		});
	 			break;
	 		}
	 		case "Create_Joborder_Stocks":{
	 			$('#Create_Joborder_Stocks').on('submit',function(e){
	 				e.preventDefault();
	 				var rowCount = $('#kt_material_table tbody tr').length;
	 				var project_no=$('select[name=project_no]').val();
	 				var c_code=$('select[name=c_code]').val();
	 				var unit=$('input[name=unit]').val();
	 				if(!project_no || !c_code || !unit){
	 					_initSwalWarning();
	 				}else if(!rowCount){
	 					_initSwalWarning();
	 				}else{
		 				let mat_type = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-type'));
						let mat_itemno = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-id'));
						let mat_quantity = Array.from(document.getElementsByClassName('tbl-mat-2')).map(item => item.getAttribute('data-qty'));
						let mat_remarks = Array.from(document.getElementsByClassName('tbl-mat-3')).map(item => item.getAttribute('data-remarks'));

						let p_type = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-type'));
						let p_itemno = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-id'));	
						let p_quantity = Array.from(document.getElementsByClassName('tbl-pur-2')).map(item => item.getAttribute('data-qty'));
						let p_remarks = Array.from(document.getElementsByClassName('tbl-pur-3')).map(item => item.getAttribute('data-remarks'));

					   	let formData = new FormData();
					   	formData.append('project_no',project_no);
					   	formData.append('c_code',c_code);
					   	formData.append('unit',unit);
					   	formData.append('mat_itemno', mat_itemno);
					   	formData.append('mat_quantity',mat_quantity);
					   	formData.append('mat_type', mat_type);
					   	formData.append('mat_remarks',mat_remarks);
					   	formData.append('pur_itemno',p_itemno);
					   	formData.append('pur_quantity',p_quantity);
					   	formData.append('pur_remarks',p_remarks);
					   	formData.append('pur_type',p_type);
					   	thisURL = baseURL + 'create_controller/Create_Joborder_Stocks';
	 					_ajaxForm(thisURL,"POST",formData,"Create_Joborder_Stocks",false);
	 				}
	 			});
	 			break;
	 		}
	 		case "Update_Joborder_Stocks":{
	 			$('#Update_Joborder_Stocks').on('submit',function(e){
	 				e.preventDefault();
	 				var rowCount = $('#kt_material_table tbody tr').length;
					if(!rowCount){
	 					_initSwalWarning();
	 				}else{
		 				let mat_type = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-type'));
						let mat_itemno = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-id'));
						let mat_quantity = Array.from(document.getElementsByClassName('tbl-mat-2')).map(item => item.getAttribute('data-qty'));
						let mat_remarks = Array.from(document.getElementsByClassName('tbl-mat-3')).map(item => item.getAttribute('data-remarks'));

						let p_type = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-type'));
						let p_itemno = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-id'));	
						let p_quantity = Array.from(document.getElementsByClassName('tbl-pur-2')).map(item => item.getAttribute('data-qty'));
						let p_remarks = Array.from(document.getElementsByClassName('tbl-pur-3')).map(item => item.getAttribute('data-remarks'));

					   	let formData = new FormData();
					   	formData.append('production_no',$('#joborder').attr('data-id'));
					   	formData.append('mat_itemno', mat_itemno);
					   	formData.append('mat_quantity',mat_quantity);
					   	formData.append('mat_type', mat_type);
					   	formData.append('mat_remarks',mat_remarks);
					   	formData.append('pur_itemno',p_itemno);
					   	formData.append('pur_quantity',p_quantity);
					   	formData.append('pur_remarks',p_remarks);
					   	formData.append('pur_type',p_type);
					   	thisURL = baseURL + 'update_controller/Update_Joborder_Stocks';
	 					_ajaxForm(thisURL,"POST",formData,"Update_Joborder_Stocks",false);
	 				}
	 			});
	 			break;
	 		}
	 		case "Update_Joborder_Project":{
	 			$('#Update_Joborder_Project').on('submit',function(e){
	 				e.preventDefault();
	 				var rowCount = $('#kt_material_table tbody tr').length;
					if(!rowCount){
	 					_initSwalWarning();
	 				}else{
		 				let mat_type = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-type'));
						let mat_itemno = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-id'));
						let mat_quantity = Array.from(document.getElementsByClassName('tbl-mat-2')).map(item => item.getAttribute('data-qty'));
						let mat_remarks = Array.from(document.getElementsByClassName('tbl-mat-3')).map(item => item.getAttribute('data-remarks'));

						let p_type = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-type'));
						let p_itemno = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-id'));	
						let p_quantity = Array.from(document.getElementsByClassName('tbl-pur-2')).map(item => item.getAttribute('data-qty'));
						let p_remarks = Array.from(document.getElementsByClassName('tbl-pur-3')).map(item => item.getAttribute('data-remarks'));

					   	let formData = new FormData();
					   	formData.append('production_no',$('#joborder').attr('data-id'));
					   	formData.append('mat_itemno', mat_itemno);
					   	formData.append('mat_quantity',mat_quantity);
					   	formData.append('mat_type', mat_type);
					   	formData.append('mat_remarks',mat_remarks);
					   	formData.append('mat_type', mat_type);
					   	formData.append('pur_itemno',p_itemno);
					   	formData.append('pur_quantity',p_quantity);
					   	formData.append('pur_remarks',p_remarks);
					   	formData.append('pur_type',p_type);
					   	thisURL = baseURL + 'update_controller/Update_Joborder_Stocks';
	 					_ajaxForm(thisURL,"POST",formData,"Update_Joborder_Project",false);
	 				}
	 			});
	 			break;
	 		}
	 		case "Create_Joborder_Project":{
	 			$('#Create_Joborder_Project').on('submit',function(e){
	 				e.preventDefault();
	 				var rowCount = $('#kt_material_table tbody tr').length;
	 				var project_no=$('select[name=project_no]').val();
	 				if(!project_no){
	 					_initSwalWarning();
	 				}else if(!rowCount){
	 					_initSwalWarning();
	 				}else{
		 				let mat_type = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-type'));
						let mat_itemno = Array.from(document.getElementsByClassName('tbl-mat-1')).map(item => item.getAttribute('data-id'));
						let mat_quantity = Array.from(document.getElementsByClassName('tbl-mat-2')).map(item => item.getAttribute('data-qty'));
						let mat_remarks = Array.from(document.getElementsByClassName('tbl-mat-3')).map(item => item.getAttribute('data-remarks'));

						let p_type = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-type'));
						let p_itemno = Array.from(document.getElementsByClassName('tbl-pur-1')).map(item => item.getAttribute('data-id'));	
						let p_quantity = Array.from(document.getElementsByClassName('tbl-pur-2')).map(item => item.getAttribute('data-qty'));
						let p_remarks = Array.from(document.getElementsByClassName('tbl-pur-3')).map(item => item.getAttribute('data-remarks'));

					   	let formData = new FormData();
					   	formData.append('project_no',project_no);
					   	formData.append('mat_itemno', mat_itemno);
					   	formData.append('mat_quantity',mat_quantity);
					   	formData.append('mat_type', mat_type);
					   	formData.append('mat_remarks',mat_remarks);
					   	formData.append('mat_type', mat_type);
					   	formData.append('pur_itemno',p_itemno);
					   	formData.append('pur_quantity',p_quantity);
					   	formData.append('pur_remarks',p_remarks);
					   	formData.append('pur_type',p_type);
					   	thisURL = baseURL + 'create_controller/Create_Joborder_Project';
	 					_ajaxForm(thisURL,"POST",formData,"Create_Joborder_Project",false);
	 				}
	 			});
	 			break;
	 		}
	 		case "Create_Joborder_Inpection_Project_Image":{
	 			$(document).on('click','#delete',function(e){
	 				var id = $(this).attr('data-id'); 
	 				thisURL = baseURL + 'delete_controller/Delete_Inspection_Image';
				  	_ajaxForm_loaded(thisURL,"POST",{id:id},"Delete_Inspection_Image",false);
	 			});
	 			$(document).on('click','#save_image',function(e){
	 				e.preventDefault();
	 				let image = $('#imagess')[0].files;
 				 	if(image.length == 0){
 				 		Swal.fire("Warning!", "Please Input New Image!", "warning");
 				 	}else{
 				 		let formdata = new FormData();
	 				 	formdata.append('production_no',$('#joborder').text());
        					formdata.append('image',image[0]);
	 				 	thisURL = baseURL + 'create_controller/Create_Joborder_Inpection_Project_Image';
				  	      _ajaxForm(thisURL,"POST",formdata,"Create_Joborder_Inpection_Project_Image",false);
 				 	}		
	 			});
	 			$(document).on('click','.btn-save-qty',function(e){
	 				var status = $('select[name=status]').val();
 					let formdata = new FormData();
	 				formdata.append('production_no',$('#joborder').text());
        				formdata.append('qty',0);
        				formdata.append('status',status);
        				formdata.append('type',2);
	 				thisURL = baseURL + 'update_controller/Update_Joborder_Status';
				     _ajaxForm(thisURL,"POST",formdata,"Update_Joborder_Status",false);

	 			});
	 			$(document).on('click','#create_joborder_request',function(e){
	 				e.preventDefault();
	 				let project_no = $('select[name=project_no]').val();
	 				if(!project_no){
	 					Swal.fire("Warning!", "Please Complete The Form!", "warning");
	 				}else{
	 					let formdata = new FormData();
	 				 	formdata.append('project_no',project_no);
	   					formdata.append('type',2);
	   					thisURL = baseURL + 'create_controller/Create_Joborder_Request';
					  	_ajaxForm(thisURL,"POST",formdata,"Create_Joborder_Request",false);	
	 				}
	 			});
	 			break;
	 		}
	 		case "Create_Joborder_Inpection_Stocks_Image":{
	 			$(document).on('click','#delete',function(e){
	 				e.preventDefault();	 				
	 				var id = $(this).attr('data-id'); 
	 				thisURL = baseURL + 'delete_controller/Delete_Inspection_Image';
				  	_ajaxForm_loaded(thisURL,"POST",{id:id},"Delete_Inspection_Image",false);
	 			});
	 			$(document).on('click','#save_image',function(e){
	 				e.preventDefault();
	 				let image = $('#imagess')[0].files;
 				 	if(image.length == 0){
 				 		Swal.fire("Warning!", "Please Input New Image!", "warning");
 				 	}else{
 				 		let formdata = new FormData();
	 				 	formdata.append('production_no',$('#joborder').text());
        					formdata.append('image',image[0]);
	 				 	thisURL = baseURL + 'create_controller/Create_Joborder_Inpection_Stocks_Image';
				  	      _ajaxForm(thisURL,"POST",formdata,"Create_Joborder_Inpection_Stocks_Image",false);
 				 	}		
	 			});
	 			$(document).on('click','.btn-save-qty',function(e){
	 				var qty = $('input[name=unit]').val();
	 				var status = $('select[name=status]').val();
	 				var unit = $('#unit').val();
	 				var total = parseFloat(unit-qty);
	 				if(unit > 0){
	 					if(!qty || total < -1){
	 						Swal.fire("Warning!", "Please Input Quantity!", "warning");
		 				}else{
		 					let formdata = new FormData();
			 				formdata.append('production_no',$('#joborder').text());
		        				formdata.append('qty',qty);
		        				formdata.append('status',status);
		        				formdata.append('type',1);
			 				thisURL = baseURL + 'update_controller/Update_Joborder_Status';
						     _ajaxForm(thisURL,"POST",formdata,"Update_Joborder_Status",false);
		 				}
	 				}else{
	 					Swal.fire("Warning!", "Job order is already done!", "warning");
	 				}
	 			});
	 			$(document).on('click','#create_joborder_request',function(e){
	 				e.preventDefault();
	 				let project_no = $('select[name=project_no]').val();
	 				let c_code = $('select[name=c_code]').val();
	 				let unit = $('#requestAddModal > div > div > div.modal-body > div > div:nth-child(3) > div > input').val();
	 				if(!project_no || !c_code || !unit){
	 					Swal.fire("Warning!", "Please Complete The Form!", "warning");
	 				}else{
	 					let formdata = new FormData();
	 				 	formdata.append('project_no',project_no);
	   					formdata.append('c_code',c_code);
	   					formdata.append('unit',unit);
	   					formdata.append('type',1);
	   					thisURL = baseURL + 'create_controller/Create_Joborder_Request';
					  	_ajaxForm(thisURL,"POST",formdata,"Create_Joborder_Request",false);	
	 				}
	 			});
	 			break;
	 		}
	 		case"Create_Salesorder_Project":{
	 				form = document.getElementById('Create_Salesorder_Project_Form');
				         validation = FormValidation.formValidation(
							form,{
								fields: {
									project_no: {validators: {notEmpty: {message: 'Field is required'}}},
									date_created: {validators: {notEmpty: {message: 'Field is required'}}},
									fullname: {validators: {notEmpty: {message: 'Field is required'}}},
									email: {validators: {notEmpty: {message: 'Field is required'}}},
									mobile: {validators: {notEmpty: {message: 'Field is required'}}},
									address: {validators: {notEmpty: {message: 'Field is required'}}},
								},
								plugins: { //Learn more: https://formvalidation.io/guide/plugins
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap()
							}
						   }
					    );
		 			$(document).on('click','.btn-create-submit',function(e){
		 				e.preventDefault();
		 				validation.validate().then(function(status) {
					     if (status == 'Valid') {
					     	var rowCount = $('#kt_product_breakdown_table tbody tr').length;
					     	if(!rowCount){
	 							Swal.fire("Warning!", "Product break down form is empty!", "warning")
					     	}else{
					     		 Swal.fire({
								        title: "Are you sure?",
								        text: "You won't be able to revert this",
								        icon: "warning",
								        confirmButtonText: "Submit!",
								        showCancelButton: true
								    }).then(function(result) {
								        if (result.value) {
                                                  let formData = new FormData();
                                                      formData.append('project_no',$('select[name="project_no"]').val());
                                                      formData.append('date_created',$('input[name="date_created"]').val());
                                                      formData.append('customer',$('input[name="fullname"]').val());
                                                      formData.append('email',$('input[name="email"]').val());
                                                      formData.append('mobile',$('input[name="mobile"]').val());
                                                      formData.append('tin',$('input[name="tin"]').val());
                                                      formData.append('address',$('textarea[name="address"]').val());
                                                      formData.append('downpayment',$('input[name="downpayment"]').val());
                                                      formData.append('date_downpayment',$('input[name="date_downpayment"]').val());
                                                      formData.append('discount',$('input[name="discount"]').val());
                                                      formData.append('vat',$('select[name="vat"]').val());
                                                      formData.append('shipping_fee',$('input[name="shipping_fee"]').val());
                                                       for(let i =0;i<rowCount;i++){
     									  	    formData.append('description[]', Array.from(document.getElementsByClassName('td-item['+i+']')).map(item => item.textContent));
     									  	    formData.append('qty[]',Array.from(document.getElementsByClassName('td-qty['+i+']')).map(item => item.textContent));
     									  	    formData.append('unit[]',Array.from(document.getElementsByClassName('td-unit['+i+']')).map(item => item.textContent));
     									  	    formData.append('amount[]',Array.from(document.getElementsByClassName('td-amount['+i+']')).map(item => item.textContent));
									         }
                                                      thisURL = baseURL + 'create_controller/Create_Salesorder_Project';
									  _ajaxForm(thisURL,"POST",formData,"Create_Salesorder_Project",false);
							          }
							   	 });
					     	}
					    }
				   	 });
		 		});
	 			break;
	 		}
               case"Create_Salesorder_Stocks":{
                         form = document.getElementById('Create_Salesorder_Stocks_Form');
                             validation = FormValidation.formValidation(
                                   form,{
                                        fields: {
                                             date_created: {validators: {notEmpty: {message: 'Field is required'}}},
                                             fullname: {validators: {notEmpty: {message: 'Field is required'}}},
                                             email: {validators: {notEmpty: {message: 'Field is required'}}},
                                             mobile: {validators: {notEmpty: {message: 'Field is required'}}},
                                             address: {validators: {notEmpty: {message: 'Field is required'}}},
                                        },
                                        plugins: { //Learn more: https://formvalidation.io/guide/plugins
                                        trigger: new FormValidation.plugins.Trigger(),
                                        bootstrap: new FormValidation.plugins.Bootstrap()
                                   }
                                 }
                             );
                         $(document).on('click','.btn-create-submit',function(e){
                              e.preventDefault();
                              validation.validate().then(function(status) {
                              if (status == 'Valid') {
                                   var rowCount = $('#kt_product_breakdown_table tbody tr').length;
                                   if(!rowCount){
                                        Swal.fire("Warning!", "Product break down form is empty!", "warning")
                                   }else{
                                         Swal.fire({
                                                title: "Are you sure?",
                                                text: "You won't be able to revert this",
                                                icon: "warning",
                                                confirmButtonText: "Submit!",
                                                showCancelButton: true
                                            }).then(function(result) {
                                                if (result.value) {
                                                	alert($('input[name="tin"]').val())
                                                  let formData = new FormData();
                                                      formData.append('date_created',$('input[name="date_created"]').val());
                                                      formData.append('customer',$('input[name="fullname"]').val());
                                                      formData.append('email',$('input[name="email"]').val());
                                                      formData.append('mobile',$('input[name="mobile"]').val());
                                                      formData.append('address',$('textarea[name="address"]').val());
                                                      formData.append('tin',$('input[name="tin"]').val());
                                                      formData.append('downpayment',$('input[name="downpayment"]').val());
                                                      formData.append('date_downpayment',$('input[name="date_downpayment"]').val());
                                                      formData.append('discount',$('input[name="discount"]').val());
                                                      formData.append('vat',$('select[name="vat"]').val());
                                                      formData.append('shipping_fee',$('input[name="shipping_fee"]').val());
                                                       for(let i =0;i<rowCount;i++){
                                                           formData.append('description[]', Array.from(document.getElementsByClassName('td-item['+i+']')).map(item => item.getAttribute('data-id')));
                                                           formData.append('qty[]',Array.from(document.getElementsByClassName('td-qty['+i+']')).map(item => item.textContent));
                                                           formData.append('unit[]',Array.from(document.getElementsByClassName('td-unit['+i+']')).map(item => item.textContent));
                                                           formData.append('amount[]',Array.from(document.getElementsByClassName('td-amount['+i+']')).map(item => item.textContent));
                                                      }
                                                  thisURL = baseURL + 'create_controller/Create_Salesorder_Stocks';
                                               _ajaxForm(thisURL,"POST",formData,"Create_Salesorder_Stocks",false);
                                             }
                                         });
                                   }
                             }
                          });
                    });
                    break;
               }

	 		//FOR REPAIR

	 		
	 		case "Create_Supplier":{
				    form = document.getElementById('Create_Supplier');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {
								name: {validators: {notEmpty: {message: 'Supplier Name is required'}}},
			                   		mobile: {validators: {notEmpty: {message: 'Mobile No. is required'}}},
			                   		email: {validators: {notEmpty: {message: 'Email is required'}}},
								address: {validators: {notEmpty: {message: 'Address is required'}}}},

							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Create_Supplier').on('submit',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid') 
				            { 
				            	let formData = new FormData(element);
				            	val = formData;
						     thisURL = baseURL + 'create_controller/Create_Supplier';
						     url = baseURL + 'gh/superuser/supplier_create';
						     _ajaxForm(thisURL,"POST",val,"Create_Supplier",url);
						
							}
						});
					});
	 			break;
	 		}
	 		case "Create_Return_Item":{
	 			    var form = document.getElementById('Create_Return_Item');
			         validation = FormValidation.formValidation(
							form,{
								fields: 
								{type: {validators: {notEmpty: {message: 'Item is required'}}},
								item_no: {validators: {notEmpty: {message: 'Item is required'}}},
								 qty: {validators: {notEmpty: {message: 'Quanity is required'}}},
								 remarks: {validators: {notEmpty: {message: 'Remarks is required'}}},
				               },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                   
						}
					   }
					);
					$('.Create_Return_Item').on('click',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid') { 
				            	let formData = new FormData();
				            	formData.append('type',$('select[name=type]').val());
				            	formData.append('item_no',$('select[name=item_no]').val());
				            	formData.append('qty',$('input[name=qty]').val());
				            	formData.append('status',$('select[name=status]').val());
				            	formData.append('remarks',$('textarea[name=remarks]').val());
							     thisURL = baseURL + 'create_controller/Create_Return_Item_Warehouse';
								_ajaxForm(thisURL,"POST",formData,"Create_Return_Item_Warehouse",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Create_Return_Item_Customer":{
	 			    var form = document.getElementById('Create_Return_Item_Customer');
			         validation = FormValidation.formValidation(
							form,{
								fields: 
								{so_no: {validators: {notEmpty: {message: 'S.O No. is required'}}},
								item_no: {validators: {notEmpty: {message: 'Item is required'}}},
								 qty: {validators: {notEmpty: {message: 'Quanity is required'}}},
								 remarks: {validators: {notEmpty: {message: 'Remarks is required'}}},
				               },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                   
						}
					   }
					);
					$('.Create_Return_Item_Customer').on('click',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid') { 
				            	let formData = new FormData();
				            	formData.append('so_no',$('input[name=so_no]').val());
				            	formData.append('item_no',$('select[name="item_no"]').val());
				            	formData.append('item',$('select[name="item_no"] option:selected').text());
				            	formData.append('qty',$('input[name=qty]').val());
				            	formData.append('status',$('select[name=status]').val());
				            	formData.append('remarks',$('textarea[name=remarks]').val());
							     thisURL = baseURL + 'create_controller/Create_Return_Item_Customer';
								_ajaxForm(thisURL,"POST",formData,"Create_Return_Item_Customer",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Create_RawMaterial":{
	 			    var form = document.getElementById('Create_RawMaterial');
			         validation = FormValidation.formValidation(
							form,{
								fields: {item: {validators: {notEmpty: {message: 'Item is required'}}},
								 price: {validators: {notEmpty: {message: 'Price is required'}}},
								 unit: {validators: {notEmpty: {message: 'Unit is required'}}},
				               },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Create_RawMaterial_btn').on('click',function(e){
					    e.preventDefault();
				            	item = $('input[name=item]').val();
				            	let price = $('input[name=price]').val();
				            	let unit = $('input[name=unit]').val();
				            	if(!item || !price){
				            		Swal.fire("Warning!", "Please Complete the form!", "warning");
				            	}else{
				            	val = {item:item,price:price,unit:unit};
						     thisURL = baseURL + 'create_controller/Create_RawMaterial';
						     _ajaxForm_loaded(thisURL,"POST",val,"Create_RawMaterial_btn",false);	
				            	}
					});
					var form = document.getElementById('Update_RawMaterial');
			          validation = FormValidation.formValidation(
						form,
						{
							fields: {item: {validators: {notEmpty: {message: 'Item is required'}}},
			                },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Update_RawMaterial').on('submit',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid') { 
				            	let formData = new FormData(element);
				            	val = formData;
						     thisURL = baseURL + 'update_controller/Update_RawMaterial';
							_ajaxForm(thisURL,"POST",val,"Update_RawMaterial",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Update_Production":{
				   var form = document.getElementById('Update_Production');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {stocks: {validators: {notEmpty: {message: 'Stock is required'}}},
			                },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Update_Production').on('submit',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid') 
				            { 
				            	let formData = new FormData(element);
						     thisURL = baseURL + 'update_controller/Update_Production';
							_ajaxForm(thisURL,"POST",formData,"Update_Production",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Create_SpareParts":{
	 			    var form = document.getElementById('Create_SpareParts');
			         validation = FormValidation.formValidation(
							form,{fields: {item: {validators: {notEmpty: {message: 'Item is required'}}},},
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Create_SpareParts_btn').on('click',function(e){
					    e.preventDefault();
				            	item = $('input[name=item]').val();
				            	if(!item){
				            		Swal.fire("Warning!", "Please Complete the form!", "warning");
				            	}else{
				            	let formData = new FormData();
				            	formData.append('item',item);
				            	formData.append('type',1);
						     thisURL = baseURL + 'create_controller/Create_Other_Materials';
						     _ajaxForm(thisURL,"POST",formData,"Create_SpareParts",false);	
				            	}
					});
					var form = document.getElementById('Update_SpareParts');
			          validation = FormValidation.formValidation(
						form,{fields: {item_update: {validators: {notEmpty: {message: 'Item is required'}}},},
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Update_SpareParts').on('submit',function(e){
					    e.preventDefault();
					     let element = this;
					    validation.validate().then(function(status) {
				            if (status == 'Valid'){ 
				            	let formData = new FormData(element);
						     thisURL = baseURL + 'update_controller/Update_Other_Materials';
							_ajaxForm(thisURL,"POST",formData,"Update_SpareParts",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Create_OfficeSupplies":{
	 			    var form1 = document.getElementById('Create_OfficeSupplies');
			        var validation1 = FormValidation.formValidation(
							form1,{
								fields: {item: {validators: {notEmpty: {message: 'Item is required'}}},
				               },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('#Create_OfficeSupplies_btn').on('click',function(e){
					    e.preventDefault();
					    validation1.validate().then(function(status) {
				            if (status == 'Valid') { 
				            let formData1 = new FormData();
				             formData1.append('item',$('input[name=item]').val());
				             formData1.append('type',2);
						     let thisURL1 = baseURL+'create_controller/Create_Other_Materials';
							_ajaxForm(thisURL1,"POST",formData1,"Create_OfficeSupplies",false);
						    }
						});
					});
					var form = document.getElementById('Update_OfficeSupplies');
			         validation = FormValidation.formValidation(
						form,{fields: {item_update: {validators: {notEmpty: {message: 'Item is required'}}},},
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
					$('.Update_OfficeSupplies_btn').on('click',function(e){
					    e.preventDefault();
					    validation.validate().then(function(status) {
				            if (status == 'Valid') { 
				            	let formData = new FormData(form);
						     thisURL = baseURL + 'update_controller/Update_Other_Materials';
							_ajaxForm(thisURL,"POST",formData,"Update_OfficeSupplies",false);
						    }
						});
					});
	 			break;
	 		}
	 		case "Create_Users":{
	 			var form = document.getElementById('Create_Users');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {firstname: {validators: {notEmpty: {message: 'Firstname is required'}}},
								lastname: {validators: {notEmpty: {message: 'Lastname is required'}}},
								middlename: {validators: {notEmpty: {message: 'Middlename/Initial is required'}}},
								username: {validators: {notEmpty: {message: 'Username is required'}}},
								password: {validators: {notEmpty: {message: 'Password is required'}}},
								conpassword: {validators: {notEmpty: {message: 'Confirm Password is required'}}},
			                },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
	 			$('#Create_Users').on('submit', function(e){
	 				e.preventDefault();
	 				var element = this;
	 				var password = $('input[name=password]').val();
	 				var conpassword = $('input[name=conpassword]').val();
	 				if(password == conpassword){
	 					validation.validate().then(function(status) {
					     if (status == 'Valid'){ 	
					     	if($('#designer').prop("checked") == true){designer = 1;}else if($('#designer').prop("checked") == false){designer = 0;}
					     	if($('#production').prop("checked") == true){production = 1;}else if($('#production').prop("checked") == false){production = 0;}
					     	if($('#supervisor').prop("checked") == true){supervisor = 1;}else if($('#supervisor').prop("checked") == false){supervisor = 0;}
					     	if($('#superuser').prop("checked") == true){superuser = 1;}else if($('#superuser').prop("checked") == false){superuser = 0;}
					     	if($('#admin').prop("checked") == true){admin = 1;}else if($('#admin').prop("checked") == false){admin = 0;}
					     	if($('#accounting').prop("checked") == true){accounting = 1;}else if($('#accounting').prop("checked") == false){accounting = 0;}
					     	if($('#webmodifier').prop("checked") == true){webmodifier = 1;}else if($('#webmodifier').prop("checked") == false){webmodifier = 0;}
					     	if($('#sales').prop("checked") == true){sales = 1;}else if($('#sales').prop("checked") == false){sales = 0;}
					     	var formData = new FormData(element);
					     	    formData.append('designer',designer);
					     	    formData.append('production',production);
					     	    formData.append('supervisor',supervisor);
					     	    formData.append('superuser',superuser);
					     	    formData.append('admin',admin);
					     	    formData.append('accounting',accounting);
					     	    formData.append('webmodifier',webmodifier);
					     	    formData.append('sales',sales);
					   		 val = formData;
						  	 thisURL = baseURL + 'create_controller/Create_Users';
						  	 var page = $('input[name=page]').val();
						  	 url = baseURL + 'gh/'+page+'/user_create';
						  	 _ajaxForm(thisURL,"POST",val,"Create_Users",url);
					  	}
					  });

	 				}else{
	 				     Swal.fire("Warning!", "Password & Confirm Password does not matched!", "warning");
	 				}
	 				
	 			});
	 			break;
	 		}
	 		case "Create_Deposit":{
	 			var form = document.getElementById('Create_Deposit');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {firstname: {validators: {notEmpty: {message: 'Firstname is required'}}},
								lastname: {validators: {notEmpty: {message: 'Lastname is required'}}},
								middlename: {validators: {notEmpty: {message: 'Middlename/Initial is required'}}},
								email: {validators: {notEmpty: {message: 'Email is required'}}},
								order_no: {validators: {notEmpty: {message: 'Trancking No. is required'}}},
								amount: {validators: {notEmpty: {message: 'Amount is required'}}},
								bank: {validators: {notEmpty: {message: 'Bank is required'}}},
								date_deposite: {validators: {notEmpty: {message: 'Date Deposite is required'}}},
			                },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
	 			$(document).on('submit','#Create_Deposit',function(e){
	 				e.preventDefault();
	 				validation.validate().then(function(status) {
					     if (status == 'Valid'){ 	
					     	let files =  $('input[name=image]')[0].files;
						 	let fd = new FormData(form);
		   					fd.append('image',files[0]);
						 	thisURL = baseURL + 'create_controller/Create_Deposit';
					  	 	_ajaxForm(thisURL,"POST",fd,"Create_Deposit",false);
					     }
					 });
	 			})
	 			$(document).on('click','#Update_Deposit_Approved',function(e){
	 				e.preventDefault();
				 	 thisURL = baseURL + 'update_controller/Update_Deposit_Approved';
			  	 	_ajaxForm_loaded(thisURL,"POST",{id:$(this).attr('data-id')},"Create_Deposit",false);
	 			})
	 			break;
	 		}

	 		//Update Form
	 		case "Update_Purchase_Request_Stocks":{
	 			$(document).on('click','#btn-save',function(e){
	 				e.preventDefault();
	 				let id = Array.from(document.getElementsByClassName('td-id')).map(item => item.getAttribute('data-id'));
	 				let count = Array.from(document.getElementsByClassName('td-id')).map(item => item.getAttribute('data-count'));
	 				let amount = Array.from(document.getElementsByClassName('td-amount')).map(item => item.value);
	 				let cleanArray = amount.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
	 				let am= amount.join("_");
	 				if(cleanArray.length === 0){
	 					Swal.fire("Warning!", "Please Input the Estimate Amount of each Item!", "warning");
	 				}else{
	 					let formdata = new FormData();
		 				formdata.append('id',id);
		 				formdata.append('amount',am);
		 				formdata.append('type',1);
		 				thisURL = baseURL + 'update_controller/Update_Purchase_Stocks_Estimate';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Stocks_Estimate",false);
	 				}
	 			});


	 			$(document).on('click','#btn-save-process',function(e){
	 				e.preventDefault();
	 				let pr_id = Array.from(document.getElementsByClassName('td-item')).map(item => item.getAttribute('data-prid'));
	 				let item_id = Array.from(document.getElementsByClassName('td-item')).map(item => item.getAttribute('data-item'));
	 				let quantity = Array.from(document.getElementsByClassName('td-quantity')).map(item => item.getAttribute('data-qty'));
	 				let amount = Array.from(document.getElementsByClassName('td-amount-process')).map(item => item.getAttribute('data-amount'));
	 				let supplier = Array.from(document.getElementsByClassName('td-supplier')).map(item => item.getAttribute('data-supplier'));
	 				let terms = Array.from(document.getElementsByClassName('td-terms')).map(item => item.getAttribute('data-terms'));
	 				let cleanArray = amount.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
	 				let am= amount.join("_");
	 				var rowCount = $('#tbl_purchasing_process tr').length-1;
	 				if(!rowCount){
	 					Swal.fire("Warning!", "Please Complete This Form!", "warning");
	 				}else{
	 					let formdata = new FormData();
	 					formdata.append('joborder',$('#joborder').attr('data-id'));
		 				formdata.append('pr_id',pr_id);
		 				formdata.append('item_id',item_id);
		 				formdata.append('amount',am);
		 				formdata.append('quantity',quantity);
		 				formdata.append('supplier',supplier);
		 				formdata.append('terms',terms);
		 				formdata.append('type',1);
		 				thisURL = baseURL + 'update_controller/Update_Purchase_Stocks_Process';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Stocks_Process",false);
	 				}
	 			});
	 			break;
	 		}
	 		case "Update_Purchase_Request_Project":{
	 			$(document).on('click','#btn-save',function(e){
	 				e.preventDefault();
	 				let id = Array.from(document.getElementsByClassName('td-id')).map(item => item.getAttribute('data-id'));
	 				let count = Array.from(document.getElementsByClassName('td-id')).map(item => item.getAttribute('data-count'));
	 				let amount = Array.from(document.getElementsByClassName('td-amount')).map(item => item.value);
	 				let cleanArray = amount.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
	 				let am= amount.join("_");
	 				if(cleanArray.length === 0){
	 					Swal.fire("Warning!", "Please Input the Estimate Amount of each Item!", "warning");
	 				}else{
	 					let formdata = new FormData();
		 				formdata.append('id',id);
		 				formdata.append('amount',am);
		 				formdata.append('type',2);
		 				thisURL = baseURL + 'update_controller/Update_Purchase_Stocks_Estimate';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Project_Estimate",false);
	 				}
	 			});


	 			$(document).on('click','#btn-save-process',function(e){
	 				e.preventDefault();
	 				let pr_id = Array.from(document.getElementsByClassName('td-item')).map(item => item.getAttribute('data-prid'));
	 				let item_id = Array.from(document.getElementsByClassName('td-item')).map(item => item.getAttribute('data-item'));
	 				let quantity = Array.from(document.getElementsByClassName('td-quantity')).map(item => item.getAttribute('data-qty'));
	 				let amount = Array.from(document.getElementsByClassName('td-amount-process')).map(item => item.getAttribute('data-amount'));
	 				let supplier = Array.from(document.getElementsByClassName('td-supplier')).map(item => item.getAttribute('data-supplier'));
	 				let terms = Array.from(document.getElementsByClassName('td-terms')).map(item => item.getAttribute('data-terms'));
	 				let cleanArray = amount.filter(function(e){ return e.replace(/(\r\n|\n|\r)/gm,"")});
	 				let am= amount.join("_");
	 				var rowCount = $('#tbl_purchasing_process tr').length-1;
	 				if(!rowCount){
	 					Swal.fire("Warning!", "Please Complete This Form!", "warning");
	 				}else{
	 					let formdata = new FormData();
	 					formdata.append('joborder',$('#joborder').attr('data-id'));
		 				formdata.append('pr_id',pr_id);
		 				formdata.append('item_id',item_id);
		 				formdata.append('amount',am);
		 				formdata.append('quantity',quantity);
		 				formdata.append('supplier',supplier);
		 				formdata.append('terms',terms);
		 				formdata.append('type',2);
		 				thisURL = baseURL + 'update_controller/Update_Purchase_Stocks_Process';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Project_Process",false);
	 				}
	 			});
	 			break;
	 		}
	 		

	 		case "Update_SupplierItem":{
	 			$('#Create_SupplierItem').on('click',function(e){		
		 			 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
					        	alert(supplier_id)
					       let formData = new FormData();
					       formData.append('id',supplier_id);
					       formData.append('amount',$('#price').val());
					       formData.append('item',$('#item').val());
						  thisURL = baseURL + 'create_controller/Create_SupplierItem';
						   _ajaxForm(thisURL,"POST",formData,"Create_SupplierItem",false);
				         }
				   	 });
				});
	 			$('#Update_Supplier').on('submit',function(e){
				    e.preventDefault();
				  	let element = this;
			     	let formData = new FormData(element);
			     	formData.append('id',supplier_id);
				  	thisURL = baseURL + 'update_controller/Update_Supplier';
				  	_ajaxForm(thisURL,"POST",formData,"Update_Suppliers",false);
				});
	 			break;
	 		}
	 		case "Update_Material_Request_Stocks_Process":{
	 			$(document).ready(function() {
					 $(document).on("click",".btn-save",function(e) {
					 	e.preventDefault();
					 	var i = $(this).attr('data-count');
					 	   Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Submit!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
						        	let count = parseInt(i)+1;
						        	let id = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(1)').attr('data-id');
						        	let type = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(1)').attr('data-type');
						        	let balance = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(2)').attr('data-balance');
						        	let request = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(4) > input').val();
						        	let total = parseFloat(balance-request);
						        	if(total >= 0){
							          let formData = new FormData();
							     	formData.append('id', id);
							     	formData.append('production_no',$('#joborder').attr('data-id'));
							     	formData.append('request',request);
							     	formData.append('total',total);
							     	formData.append('type',type);
							     	thisURL = baseURL + 'update_controller/Update_Material_Request_Process';
								     _ajaxForm(thisURL,"POST",formData,"Update_Material_Request_Stocks_Process",count);
						        	}else{
						        		Swal.fire("Warning!", "Request Quantity is not Equal!<br> Please Input Correct Request", "warning");
						        	}
							 	
					         }
					    });
				    });
				})
				break;
	 		}
	 		case "Update_Material_Request_Project_Process":{
	 			$(document).ready(function() {
					 $(document).on("click",".btn-save",function(e) {
					 	e.preventDefault();
					 	var i = $(this).attr('data-count');
					 	   Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Submit!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
						        	let count = parseInt(i)+1;
						        	let id = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(1)').attr('data-id');
						        	let type = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(1)').attr('data-type');
						        	let balance = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(2)').attr('data-balance');
						        	let request = $('#tbl_material_accept > tbody > tr:nth-child('+count+') > td:nth-child(4) > input').val();
						        	let total = parseFloat(balance-request);
						        	if(total >= 0){
							          let formData = new FormData();
							     	formData.append('id', id);
							     	formData.append('production_no',$('#joborder').attr('data-id'));
							     	formData.append('request',request);
							     	formData.append('total',total);
							     	formData.append('type',type);
							     	thisURL = baseURL + 'update_controller/Update_Material_Request_Process';
								     _ajaxForm(thisURL,"POST",formData,"Update_Material_Request_Project_Process",count);
						        	}else{
						        		Swal.fire("Warning!", "Request Quantity is not Equal!<br> Please Input Correct Request", "warning");
						        	}
							 	
					         }
					    });
				    });
				})
				break;
	 		}

	 		case "Update_Rawmats_Stocks":{
	 			$('#Update_Rawmats_Stocks').on('submit', function(e){
	 				var element = this;
	 				var formData = new FormData(element);
	 				e.preventDefault();
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
					   		 val = formData;
						  	 thisURL = baseURL + 'update_controller/Update_Rawmats_Stocks';
						  	 _ajaxForm(thisURL,"POST",val,"Update_Rawmats_Stocks",false);
				         }
				   	 });
	 			});
	 			break;
	 		}
	 		case "Update_SpareParts_Stocks":{
	 			$('#Update_SpareParts_Stocks').on('submit', function(e){
	 				var element = this;
	 				var formData = new FormData(element);
	 				e.preventDefault();
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
					   		 val = formData;
						  	 thisURL = baseURL + 'update_controller/Update_Other_Materials_Stocks';
						  	 _ajaxForm(thisURL,"POST",val,"Update_SpareParts_Stocks",false);
				         }
				   	 });
	 			});
	 			break;
	 		}
	 		case "Update_OfficeSupplies_Stocks":{
	 			$('#Update_OfficeSupplies_Stocks').on('submit', function(e){
	 				var element = this;
	 				e.preventDefault();
	 				 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
					        	var formData = new FormData(element);
						  	 thisURL = baseURL + 'update_controller/Update_Other_Materials_Stocks';
						  	 _ajaxForm(thisURL,"POST",formData,"Update_OfficeSupplies_Stocks",false);
				         }
				   	 });
	 			});
	 			break;
	 		}
	 		case "Update_OnlineOrder":{
	 			$(document).on('click','#save_vat',function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var vat = $('select[name="vat"]').val();
	 				var order_no = $('input[name="order_no"]').val();
	 				val = {order_no:order_no,vat:vat,action:action};
	 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",false);
	 			});
	 			$(document).on('click','#save_delivery',function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var order_no = $('#order_no').text();
	 				val = {order_no:order_no,action:action};
	 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 				url = baseURL + 'gh/sales/online-order?'+btoa('urlstatus=request');
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",url);
	 			});
	 			$(document).on('click','#save_approved',function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var item_id = $(this).attr('data-id');
	 				val = {item_id:item_id,action:action};
	 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 				url = baseURL + 'gh/designer/online-preorder?'+btoa('urlstatus=request');
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",url);
	 			});
	 			$(document).on('click','#save_downpayment',function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var downpayment = $('input[name="downpayment"]').val();
	 				var order_no = $('input[name="order_no"]').val();
	 				val = {order_no:order_no,downpayment:downpayment,action:action};
	 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",false);
	 			});
	 			$(document).on('click','#save_shipping',function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var shipping_fee = $('input[name="shipping_fee"]').val();
	 				var order_no = $('input[name="order_no"]').val();
	 				val = {order_no:order_no,shipping_fee:shipping_fee,action:action};
	 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",false);
	 			});
	 			$(document).on('click','#action',function(e){
	 				e.preventDefault();
	 					var action = $(this).attr('data-action');
	 					var item_id = $(this).attr('data-id');
	 					var order_no = $('input[name="order_no"]').val();
	 				if(action == 'SAVED'){
		 				var qty = $('input[name=qty'+item_id+']').val();
		             		var price = $('input[name=price'+item_id+']').val();
		             		var type = $('#type'+item_id).text();
		 				val = {item_id:item_id,qty:qty,price:price,action:action,order_no:order_no,type:type};	
		 				thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 			          _ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",false);
	 				}else{
	 					Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Submit!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
	 							val = {order_no:order_no,item_id:item_id,action:action};	
	 							thisURL = baseURL + 'update_controller/Update_OnlineOrder';
	 			    				_ajaxForm_loaded(thisURL,"POST",val,"Update_OnlineOrder",false);
					         }
					    });
	 				}
	 			});
	 			break;
	 		}
	 		

	 		//APPROVAL UPDATE
	 		case "Update_Approval_Customization":{
	 			$(document).on('click','.btn_approved',function(e){
	 				let status = $(this).attr('id');
	 				let id = $('#so_no').text();
	 				val = {id:id,status:status};
	 				thisURL = baseURL + 'update_controller/Update_Approval_Customization';
	 				let page = $('#page').val();
	 				url = baseURL + 'gh/designer/'+page+'?'+btoa('urlstatus=request');
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_Customization",url);
	 			});
	 			break;
	 		}
	 		case "Update_Approval_Purchase":{
	 			$(document).on('click','.btn_rejected',function(e){
	 				var status = $(this).attr('id');
		 			var production_no = $('input[name=production_no]').val();	
	 				val = {production_no:production_no,status:status};
					thisURL = baseURL + 'update_controller/Update_Approval_Purchase';
					url = baseURL + 'gh/admin/purchase-request';
	 				 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_Purchase",false);
	 			});
	 			$(document).on('click','.btn_approved',function(e){
	 				let status = $(this).attr('id');
	 				var production_no = $('input[name=production_no]').val();	
	 				val = {production_no:production_no,status:status};
	 				thisURL = baseURL + 'update_controller/Update_Approval_Purchase';
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_Purchase",false);
	 			});
	 			break;
	 		}
	 		case "Update_Approval_Inspection_Stocks":{
	 			$(document).on('click','.btn_status',function(e){
	 				e.preventDefault();
	 				let status = $(this).attr('data-status');
		 			let production_no = $('#joborder').text();
		 			let remarks = $('.summernote').summernote('code');	
					thisURL = baseURL + 'update_controller/Update_Approval_Inspection';
					val = {status:status,production_no:production_no,remarks:remarks};
	 				 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_Inspection_Stocks",false);
	 			});
	 			break; 
	 		}
	 		case "Update_Approval_Inspection_Project":{
	 			$(document).on('click','.btn_status',function(e){
	 				e.preventDefault();
	 				let status = $(this).attr('data-status');
		 			let production_no = $('#joborder').text();
		 			let remarks = $('.summernote').summernote('code');	
					thisURL = baseURL + 'update_controller/Update_Approval_Inspection';
					val = {status:status,production_no:production_no,remarks:remarks};
	 				 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_Project_Inspection",false);
	 			});
	 			break; 
	 		}

	 		
	 		case "Update_Approval_SalesOrder":{
	 			$(document).on('click','.btn_rejected',function(e){
	 				var status = $(this).attr('id');
		 			var so_no = $('#so_no').text();
					thisURL = baseURL + 'update_controller/Update_Approval_SalesOrder';
					val = {so_no:so_no,status:status};
					url = baseURL + 'gh/admin/salesorder-request';
	 				 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_SalesOrder",url);
	 			});
	 			$(document).on('click','.btn_approved',function(e){
	 				var status = $(this).attr('id');
		 			var so_no = $('#so_no').text();
	 				thisURL = baseURL + 'update_controller/Update_Approval_SalesOrder';
	 				val = {so_no:so_no,status:status};
	 				url = baseURL + 'gh/admin/salesorder-request';
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_SalesOrder",url);
	 			});
	 			break;
	 		}
	 		case "Update_Approval_UsersRequest":{
		 			$('#btn-approved').on('click',function(){	
		 				var status = $(this).attr('data-id');
		 				var id = $('input[name=id]').val();	
						     Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Submit!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
						   		 val = {id:id,status:status};
							  	 thisURL = baseURL + 'update_controller/Update_Approval_Users';
							  	 url = baseURL + 'gh/admin/user-request?'+btoa('urlstatus=request');
							  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_UsersRequest",url);
					         }
					    });
					});
					$('#btn-reject').on('click',function(){	
		 				var status = $(this).attr('data-id');
		 				var id = $('input[name=id]').val();	
						     Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this",
						        icon: "warning",
						        confirmButtonText: "Submit!",
						        showCancelButton: true
						    }).then(function(result) {
						        if (result.value) {
						   		 val = {id:id,status:status};
							  	 thisURL = baseURL + 'update_controller/Update_Approval_Users';
							  	 url = baseURL + 'gh/admin/user-request?'+btoa('urlstatus=request');
							  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_UsersRequest",url);
					         }
					    });
					});
	 			
	 			break;
	 		}
	 		case "Update_Users":{
	 			var form = document.getElementById('Update_Users');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {firstname: {validators: {notEmpty: {message: 'Firstname is required'}}},
								lastname: {validators: {notEmpty: {message: 'Lastname is required'}}},
								middlename: {validators: {notEmpty: {message: 'Middlename/Initial is required'}}},
								username: {validators: {notEmpty: {message: 'Username is required'}}},
			                },
							plugins: {
							trigger: new FormValidation.plugins.Trigger(),
							bootstrap: new FormValidation.plugins.Bootstrap(),
			                    icon: new FormValidation.plugins.Icon({
			                    valid: 'fa fa-check',
			                    invalid: 'fa fa-times',
			                    validating: 'fa fa-refresh'
			                }),
						}
					   }
					);
	 			$('#Update_Users').on('submit', function(e){
	 				e.preventDefault();
	 				validation.validate().then(function(status) {
				     if (status == 'Valid') 
				     { 	
				     	if($('#designer').prop("checked") == true){designer = 1;}else if($('#designer').prop("checked") == false){designer = 0;}
				     	if($('#production').prop("checked") == true){production = 1;}else if($('#production').prop("checked") == false){production = 0;}
				     	if($('#supervisor').prop("checked") == true){supervisor = 1;}else if($('#supervisor').prop("checked") == false){supervisor = 0;}
				     	if($('#superuser').prop("checked") == true){superuser = 1;}else if($('#superuser').prop("checked") == false){superuser = 0;}
				     	if($('#admin').prop("checked") == true){admin = 1;}else if($('#admin').prop("checked") == false){admin = 0;}
				     	if($('#accounting').prop("checked") == true){accounting = 1;}else if($('#accounting').prop("checked") == false){accounting = 0;}
				     	if($('#webmodifier').prop("checked") == true){webmodifier = 1;}else if($('#webmodifier').prop("checked") == false){webmodifier = 0;}
				     	if($('#sales').prop("checked") == true){sales = 1;}else if($('#sales').prop("checked") == false){sales = 0;}
				     	let id = $('input[name=id]').val();
				     	let firstname = $('input[name=firstname]').val();
			  			let lastname = $('input[name=lastname]').val();
			  			let middlename = $('input[name=middlename]').val();
			  			let username = $('input[name=username]').val();
			  			let status = $('select[name=status]').val();
			  			let voucher = $('select[name=voucher]').val();
				   		 val = {id:id,voucher:voucher,firstname:firstname,lastname:lastname,middlename:middlename,username:username,status:status,designer:designer,production:production,supervisor:supervisor,superuser:superuser,admin:admin,accounting:accounting,webmodifier:webmodifier,sales};
					  	 thisURL = baseURL + 'update_controller/Update_Users';
					  	 var page = $('input[name=page]').val();
					  	 url = baseURL + 'gh/'+page+'/users?'+btoa('urlstatus=pending')
					  	 _ajaxForm_loaded(thisURL,"POST",val,"Update_Users",url);
				  	}
				  });
	 			});
	 			break;
	 		}
	 		case "Update_Approval_OnlineOrder":{
	 			$(document).on('click','.btn_approved',function(e){
	 				var status = $(this).attr('id');
		 			var order_no = $('#order_no').text();
	 				thisURL = baseURL + 'update_controller/Update_Approval_OnlineOrder';
	 				val = {order_no:order_no,status:status};
	 				url = baseURL + 'gh/sales/online-order?'+btoa('urlstatus=request');
	 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Approval_OnlineOrder",url);
	 			});
	 			break;
	 		}
	 		case "Update_Profile":{
	 			$('#save_image').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var files = $('input[name=image]')[0].files;
 				 	var fd = new FormData();
 				 	fd.append('action',action);
 				 	fd.append('data',false);
   					fd.append('file',files[0]);
 				 	val = fd;
 				 	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
			  	      _ajaxForm(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_username').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="username"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);

	 			});
	 			$('#save_firstname').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="firstname"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_lastname').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="lastname"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_middlename').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="middlename"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_password').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="password"]').val();
	 				var con = $('input[name="con_password"]').val();
	 				if(data == con){
	 					val = {data:data,action:action};
					  	thisURL = baseURL + 'update_controller/Update_Profile';
					  	var page = $('input[name=page]').val();
					  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 				}else{
	 					const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Password not matched'});
	 				}
			   		
	 			});
	 			break;
	 		}
	 		case "Update_Design_Stocks":{
	 			$(document).on('click','.btn-save',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let formdata = new FormData();
		  			let image =  $('input[name=image]')[0].files;
		  			let color =  $('input[name=color]')[0].files;
		  			let docs =  $('input[name=docs]')[0].files;
		  			formdata.append('id',$('input[name=title]').attr('data-id'));
		  			formdata.append('title',$('input[name=title]').val());
		  			formdata.append('c_name',$('input[name=c_name]').val());
		  			formdata.append('image_previous',$('input[name=image_previous]').val());
		  			formdata.append('color_previous',$('input[name=color_previous]').val());
		  			formdata.append('docs_previous',$('input[name=docs_previous]').val());
		  			formdata.append('image',image[0]);
		  			formdata.append('color',color[0]);
		  			formdata.append('docs',docs[0]);
		  			thisURL = baseURL + 'update_controller/Update_Design_Stocks';
	 				_ajaxForm(thisURL,"POST",formdata,"Update_Design_Stocks",false);
			  		
	 			});
	 			break;
	 		}
	 		case "Update_Design_Project":{
	 			$(document).on('click','.btn-save',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let formdata = new FormData();
		  			let image =  $('input[name=image]')[0].files;
		  			let docs =  $('input[name=docs]')[0].files;
		  			formdata.append('id',$('input[name=title]').attr('data-id'));
		  			formdata.append('title',$('input[name=title]').val());
		  			formdata.append('image_previous',$('input[name=image_previous]').val());
		  			formdata.append('docs_previous',$('input[name=docs_previous]').val());
		  			formdata.append('image',image[0]);
		  			formdata.append('docs',docs[0]);
		  			thisURL = baseURL + 'update_controller/Update_Design_Project';
	 				_ajaxForm(thisURL,"POST",formdata,"Update_Design_Project",false);
			  		
	 			});
	 			break;
	 		}
	 		case "Update_Approval_Design_Stocks":{
	 			$(document).on('click','.btn_rejected',function(e){
	 				e.preventDefault();
	 				let formdata = new FormData();
	 				formdata.append('id',$('input[name=title]').attr('data-id'));
	 				formdata.append('status',3);
					thisURL = baseURL + 'update_controller/Update_Approval_Design';
	 				 _ajaxForm(thisURL,"POST",formdata,"Update_Approval_Design_Stocks",false);
	 			});
	 			$(document).on('click','.btn_approved',function(e){
	 				e.preventDefault();
	 				let formdata = new FormData();
	 				formdata.append('id',$('input[name=title]').attr('data-id'));
	 				formdata.append('status',2);
					thisURL = baseURL + 'update_controller/Update_Approval_Design';
	 				_ajaxForm(thisURL,"POST",formdata,"Update_Approval_Design_Stocks",false);
	 			});
	 			break;
	 		}
	 		case "Update_Approval_Designed_Project":{
	 			$(document).on('click','.btn_rejected',function(e){
	 				e.preventDefault();
	 				let formdata = new FormData();
	 				formdata.append('id',$('input[name=title]').attr('data-id'));
	 				formdata.append('status',3);
					thisURL = baseURL + 'update_controller/Update_Approval_Design';
	 				 _ajaxForm(thisURL,"POST",formdata,"Update_Approval_Designed_Project",false);
	 			});
	 			$(document).on('click','.btn_approved',function(e){
	 				e.preventDefault();
	 				let formdata = new FormData();
	 				formdata.append('id',$('input[name=title]').attr('data-id'));
	 				formdata.append('status',2);
					thisURL = baseURL + 'update_controller/Update_Approval_Design';
	 				_ajaxForm(thisURL,"POST",formdata,"Update_Approval_Designed_Project",false);
	 			});
	 			break;
	 		}
	 		case "Update_Vouncher_Customer":{
	 			$(document).on('click','#save',function(e){
	 				let id = $(this).attr('data-id');
	 				let voucher = $('#voucher').text();
	 				val = {id:id,voucher:voucher};
	 				thisURL = baseURL + 'update_controller/Update_Vouncher_Customer';
					_ajaxForm_loaded(thisURL,"POST",val,"Update_Vouncher_Customer",false);
	 			});
	 			break;
	 		}
	 		case "Customer":{
	 			$(document).on('click','.save',function(e){
	 				let action = $(this).attr('data-action');
	 				let firstname = $('input[name="firstname"]').val();
			  		let lastname = $('input[name="lastname"]').val();
			  		let mobile = $('input[name="mobile"]').val();
			  		let email = $('input[name="email"]').val();
			  		let address = $('input[name="address"]').val();
			  		let city = $('input[name="city"]').val();
			  		let province =$('input[name="province"]').val();
			  		let region = $('select[name="region"]').val();
			  		let formdata = new FormData();
			  		if(!firstname || !lastname || !email || !address || !city || !province || !region)
			  		{
			  			Swal.fire("Please Complete The Form!", "Thank you!", "info");
			  		}else{
			  			if(action == 'create'){
			  				thisURL = baseURL + 'create_controller/Create_Customer';
		 				}else{
		 				    thisURL = baseURL + 'update_controller/Update_Customer';
		 				    formdata.append('id',$('input[name="firstname"]').attr('data-id'));
		 				}
		 				    formdata.append('firstname',firstname);
		 				    formdata.append('lastname',lastname);
		 				    formdata.append('mobile',mobile);
		 				    formdata.append('email',email);
		 				    formdata.append('address',address);
		 				    formdata.append('city',city);
		 				    formdata.append('province',province);
		 				    formdata.append('region',region);
		 				_ajaxForm(thisURL,"POST",formdata,"Customer",false);
			  		}
	 				
	 			});
	 			break;
	 		}
	 		case "Update_Material_Purchase_Supervisor":{
	 			$(document).on('click','#btn_changes',function(e){
	 				e.preventDefault();
	 				let action = $('#text-name').attr('data-action');
	 				let qty = $('#text-qty').val();
	 				if(action == 'material'){
	 					let id = $('#text-name').attr('data-id');
	 					let formdata = new FormData();
	 					formdata.append('id',id);
	 					formdata.append('action',action);
	 					formdata.append('qty',qty);
	 					thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
			 			_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
	 				}else if(action == 'material-create'){
		 					let item_no = $('select[name=item]').val();
		 					let type = $('select[name=type]').val();
		 					let unit = $('input[name=unit]').val();
		 					let production_no = $('#project_no').attr('data-order');
	 					if(!type || !qty || !unit){
	 						Swal.fire("Please Complete The Form!", "Thank you!", "error");
	 					}else{
	 						let formdata = new FormData();
		 					formdata.append('production_no',production_no);
		 					formdata.append('item_no',item_no);
		 					formdata.append('type',type);
		 					formdata.append('unit',unit);
		 					formdata.append('action',action);
		 					formdata.append('qty',qty);
		 					thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
				 			_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
	 					}
	 				}else if(action == 'purchased'){
	 					let id = $('#text-name').attr('data-id');
	 					let unit = $('input[name=unit]').val();
	 					let remarks = $('textarea[name=remarks]').val();
	 					let formdata = new FormData();
	 					formdata.append('id',id);
	 					formdata.append('action',action);
	 					formdata.append('qty',qty);
	 					formdata.append('unit',unit);
	 					formdata.append('remarks',remarks);
	 					thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
	 					_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
	 				}else if(action == 'purchased-create'){
	 					let production_no = $('#project_no').attr('data-order');
	 					let item_no = $('select[name=item]').val();
	 					let item_special = $('input[name=item_special]').val();
	 					let unit = $('input[name=unit]').val();
	 					let remarks = $('textarea[name=remarks]').val();
	 					let type = $('select[name=type]').val();
	 					if(type == 'common'){var item = item_no;}else{var item = item_special;}	
	 					if(!item || !qty || !unit){
	 						Swal.fire("Please Complete The Form!", "Thank you!", "error");
	 					}else{
	 						let formdata = new FormData();
		 					formdata.append('production_no',production_no);
			 				formdata.append('item_no',item_no);
			 				formdata.append('item_special',item_special);
		 					formdata.append('action',action);
		 					formdata.append('qty',qty);
		 					formdata.append('unit',unit);
		 					formdata.append('remarks',remarks);
		 					formdata.append('type',type);
		 					thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
				 			_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
	 					}
	 				}
	 			});
	 			$(document).on('click','#btn_remove_material',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let id = $(this).attr('data-id');
	 				  Swal.fire({
				        title: "Are you sure?",
				        text: "You won't be able to revert this!",
				        icon: "warning",
				        showCancelButton: true,
				        confirmButtonText: "Yes, delete it!"
				    }).then(function(result) {
				        if (result.value) {
				        	let formdata = new FormData();
		 				formdata.append('id',id);
		 				formdata.append('action',action);
				          thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
				        }
				    });
	 			});
	 			$(document).on('click','#btn_remove_purchased',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let id = $(this).attr('data-id');
	 				  Swal.fire({
				        title: "Are you sure?",
				        text: "You won't be able to revert this!",
				        icon: "warning",
				        showCancelButton: true,
				        confirmButtonText: "Yes, delete it!"
				    }).then(function(result) {
				        if (result.value) {
				        	let formdata = new FormData();
		 				formdata.append('id',id);
		 				formdata.append('action',action);
				          thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
				        }
				    });
	 			});
	 			$(document).on('click','#btn_material_request',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let id = $(this).attr('data-id');
	 				let qty = $('#quantity'+id).val();
	 				let total_qty  = $('#tbl_material #row_'+id).find("td").eq(2).html();
	 				if(!qty){
	 					Swal.fire("Enter Item Quantity Request!", "Thank you!", "info");
	 				}else{
	 					if(parseFloat(total_qty) < parseFloat(qty)){
	 						Swal.fire("Invalid Request!", "Thank you!", "error");
		 				}else{
		 					 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this!",
					        icon: "warning",
					        showCancelButton: true,
					        confirmButtonText: "Yes, submit it!"
						    }).then(function(result) {
						        if (result.value) {
						        	let formdata = new FormData();
				 				formdata.append('id',id);
				 				formdata.append('action',action);
				 				formdata.append('qty',qty);
						          thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
				 				_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
						        }
						    });	
		 				}
	 				} 
	 			});
	 			$(document).on('click','#btn_purchased_request',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let id = $(this).attr('data-id');
	 				  Swal.fire({
				        title: "Are you sure?",
				        text: "You won't be able to revert this!",
				        icon: "warning",
				        showCancelButton: true,
				        confirmButtonText: "Yes, submit it!"
				    }).then(function(result) {
				        if (result.value) {
				        	let formdata = new FormData();
		 				formdata.append('id',id);
		 				formdata.append('action',action);
				          thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
		 				_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
				        }
				    });
	 			});
	 			$(document).on('click','#btn_material_used',function(e){
	 				e.preventDefault();
	 				let action = $(this).attr('data-action');
	 				let math = $(this).attr('data-m');
	 				let id = $(this).attr('data-id');
	 				let qty = $('#quantity_used'+id).val();
	 				if(!qty){
	 					Swal.fire("Enter Material Use!", "Thank you!", "info");
	 				}else{
	 					 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this!",
					        icon: "warning",
					        showCancelButton: true,
					        confirmButtonText: "Yes, submit it!"
						    }).then(function(result) {
						        if (result.value) {
						        	let formdata = new FormData();
				 				formdata.append('id',id);
				 				formdata.append('action',action);
				 				formdata.append('qty',qty);
				 				formdata.append('math',math);
						          thisURL = baseURL + 'update_controller/Update_Material_Purchase_Supervisor';
				 				_ajaxForm(thisURL,"POST",formdata,"Update_Material_Purchase_Supervisor",false);
						        }
						    });	
	 				} 
	 			});
	 			break;
	 		}
	 		case "Create_Request_Material":{
	 			$('.Create_Request_Material').on('click',function(e){
	 				e.preventDefault();
	 				var rowCount = $('#kt_material_table tbody tr').length;
	 				if(!rowCount){
	 					_initSwalWarning();
	 				}else{
		 				let mat_type = Array.from(document.getElementsByClassName('td-type')).map(item => item.getAttribute('data-type'));
						let mat_itemno = Array.from(document.getElementsByClassName('td-item')).map(item => item.getAttribute('data-id'));
						let mat_item = Array.from(document.getElementsByClassName('td-item')).map(item => item.textContent);
						let mat_quantity = Array.from(document.getElementsByClassName('td-qty')).map(item => item.textContent);
					   	let formData = new FormData();
					   	formData.append('item_no', mat_itemno);
					   	formData.append('item',mat_item);
					   	formData.append('qty',mat_quantity);
					   	formData.append('type', mat_type);
					   	thisURL = baseURL + 'create_controller/Create_Request_Material';
	 					_ajaxForm(thisURL,"POST",formData,"Create_Request_Material",false);
	 				}
	 			});
	 			break;
	 		}
	 	}
	 }

	 var _constructData = async function(view,response,url){
	 	switch(view){
	 		//Create
	 		case "Create_Deposit":{
	 			if(response.status=="success"){
                  	_initToastSuccess();
                  	let TableURL = baseURL + 'datatable_controller/Customer_Collected_DataTable';
					let TableData = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action'}];
					_DataTableLoader('tbl_customer_collected',TableURL,TableData,false);
					document.getElementById("Create_Deposit").reset();
					$('#Create_Deposit').resetForm();
                    }else if(response.status =='APPROVED'){
                    	Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
						let TableURL = baseURL + 'datatable_controller/Customer_Deposite_DataTable';
						let TableData = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action'}]; 
						_DataTableLoader('tbl_customer_deposite',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Customer_Collected_DataTable';
						let TableData1 = [{data:'so_no'},{data:'customer'},{data:'bank'},{data:'amount'},{data:'date'},{data:'action'}];
						_DataTableLoader('tbl_customer_collected',TableURL1,TableData1,false);
                    	});
                    
                    }else{
                    	Swal.fire("TRACKING NO IS INVALID!", "Please check your receipt", "info");
                    }
                    break;
	 		}

	 		case "Create_Production_Order":{
	 			if(response.status=="success"){_initSwalSuccess(url);}
	 			break;
	 		}

	 		case "Create_RawMaterial_btn":{
	 			if(response.status=="success"){ _initToastSuccess();$('input[name="item"]').val('');
	 			$('input[name="price"]').val('');
	 			$('input[name="unit"]').val('');
	 			var TableURL = baseURL + 'datatable_controller/RawMaterial_DataTable';
				var TableData = [{data:'no'},{data: 'item'},{data:'price'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader('tbl_rawmaterials_add',TableURL,TableData,false);
	 		     }
	 			break;
	 		}
	 		case "Update_RawMaterial":{
	 			_initToastSuccess();
	 			var TableURL = baseURL + 'datatable_controller/RawMaterial_DataTable';
				var TableData = [{data:'no'},{data: 'item'},{data:'price'},{data: 'date_created'},{data: 'action'}]; 
				_DataTableLoader('tbl_rawmaterials_add',TableURL,TableData,false);
	 			break
	 		}
	 		case "Create_RawMaterial":{
	 			if(response.status=="success"){ _initToastSuccess();$('input[name="item"]').val('');
	 			$('input[name="price"]').val('');}
	 			break;
	 		}
	 		case "Create_EM_Material_Request":
	 		case "Create_EM_Purchase_Request":{
	 			if(response.status=="success"){_initSwalSuccess(url);}
	 			break;
	 		}
	 		case "Create_Supplier":{
		 			if(response=="success"){
	                  	    _initToastSuccess();
	                  	    $('input[name="name"]').val('');
	                  	    $('input[name="mobile"]').val('');
	                  	    $('input[name="email"]').val('');
	                  	    $('input[name="facebook"]').val('');
	                  	    $('input[name="website"]').val('');
	                  	    $('input[name="address"]').val('');
	                   }else{
	                   		Swal.fire("Supplier Name is already used!", "Thank you!", "error");
	                   }
		          break;
                   }
	 		case "Create_Users":{
	 			if(response.status=="success"){_initSwalSuccess(url);}
	 			break;
	 		}
	 		case "request_update_admin":{
	 			if(response.status=="success"){_initSwalSuccess(url);}
	 			break;
	 		}

	 		//Update

	 	
	 		case "Update_SupplierItem":
	 		case "Update_Supplier":
	 		case "Update_Users":{
	 			if(response.status=="success"){_initSwalSuccess(url);}
	 			break;
	 		}
	 		case "Update_Profile":{
	 			if(response == 'no image'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'No Image Upload!'});
	 			}else if(response == 'success'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 			}else if(response == 'existing'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Username Is already Existing'});
	 			}else{
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Nothing Changes'});
	 			}
	 			break;
	 		}
	 		case "Update_Approval_Customization":{
	 			if(response.status=="success"){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){window.location = url;});
	 			}
	 			break;
	 		}
	 		case "Update_Material_Request_Approval":{
	 			if(response.status == 'IN PROGRESS'){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){window.location = url;});
	 			}else if(response.status == 'REJECTED'){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){window.location = url;});
	 			}
	 			break;
	 		}
	 		case "Update_Approval_Purchase":{
	 			if(response.status == 'IN PROGRESS'){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Purchase_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_purchased_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Approval_Purchase_Approved_DataTable';
						let TableData1 =[{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_purchased_approved',TableURL1,TableData1,false);
						$('#requestModal').modal('hide');
	 				});
	 			}else if(response.status == 'REJECTED'){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Purchase_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_purchased_request',TableURL,TableData,false);

						let TableURL2 = baseURL + 'datatable_controller/Approval_Purchase_Rejected_DataTable';
						let TableData2 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_purchased_rejected',TableURL2,TableData2,false);
						$('#requestModal').modal('hide');
	 				});
	 			}
	 			break;
	 		}
	 		case "Update_Approval_Project_Inspection":{
	 			if(response.status == 2){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Inspection_Project_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_project_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Project_Approved_DataTable';
						let TableData1 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_project_approved',TableURL1,TableData1,false);
						$('#requestModal').modal('hide');
	 				});
	 			}else if(response.status == 3){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Inspection_Project_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_project_request',TableURL,TableData,false);

						let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Project_Rejected_DataTable';
						let TableData2 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_project_rejected',TableURL2,TableData2,false);
						$('#requestModal').modal('hide');
	 				});
	 			}
	 			break;
	 		}
	 		case "Update_Approval_Inspection_Stocks":{
	 			if(response.status == 2){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_stocks_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Approved_DataTable';
						let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_stocks_approved',TableURL1,TableData1,false);
						$('#requestModal').modal('hide');
	 				});
	 			}else if(response.status == 3){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Request_DataTable';
						let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_stocks_request',TableURL,TableData,false);

						let TableURL2 = baseURL + 'datatable_controller/Approval_Inspection_Stocks_Rejected_DataTable';
						let TableData2 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'qty'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_approval_inspection_stocks_rejected',TableURL2,TableData2,false);
						$('#requestModal').modal('hide');
	 				});
	 			}
	 			break;
	 		}
	 		case "Update_Approval_SalesOrder":{
	 			if(response.status == 'APPROVED'){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 					$('#requestModal').modal('hide');
	 					let TableURL = baseURL + 'datatable_controller/Approval_Request_Salesorder_DataTable';
						let TableData = [{data:'so_no'},{data:'sales_person'},{data:'b_name'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_salesorder_request',TableURL,TableData,false);

	 					let TableURL1 = baseURL + 'datatable_controller/Approval_Approved_Salesorder_DataTable';
						let TableData1 = [{data:'so_no'},{data:'sales_person'},{data:'b_name'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_salesorder_approved',TableURL1,TableData1,false);
	 				});
	 			}else if(response.status == 'REJECTED'){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){
	 					$('#requestModal').modal('hide');
	 					let TableURL = baseURL + 'datatable_controller/Approval_Request_Salesorder_DataTable';
						let TableData = [{data:'so_no'},{data:'sales_person'},{data:'b_name'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_salesorder_request',TableURL,TableData,false);
	 					let TableURL2 = baseURL + 'datatable_controller/Approval_Rejected_Salesorder_DataTable';
						let TableData2 = [{data:'so_no'},{data:'sales_person'},{data:'b_name'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_salesorder_rejected',TableURL2,TableData2,false);
	 				});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Approval_OnlineOrder":{
	 			if(response.status == 'APPROVED'){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){window.location = url;});
	 			}else if(response.status == 'REJECTED'){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){window.location = url;});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Approval_UsersRequest":{
	 			if(response.status == 'APPROVED'){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){window.location = url;});
	 			}else if(response.status == 'REJECTED'){
	 				Swal.fire("REJECTED!", "Thank you!", "error").then(function(){window.location = url;});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 	
	 		case "Update_OnlineOrder":{
	 			if(response.status =='success'){
	 				_initToastSuccess();
	 			}else if(response.status == 'REQUEST'){
	 				_initToastSuccess();
	 				$('#type'+response.item_id).html(response.type);
	 				var html ='<button type="button" class="btn btn-dark font-weight-bold" disabled>Update</button>';
	 				$('#btn_action'+response.item_id).empty();
	             		$('#btn_action'+response.item_id).append(html);
	 			}else if(response.status =='CANCELLED'){
	 				_initToastSuccess();
	 				$('#row_'+response.item_id).remove();
	 		     }else if(response.status == 'APPROVED'){
	 		     	Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 		     		window.location = url;
	 		     	});
	 		     }else{
	 				_initToastSuccess();
	 				$('#qty'+response.item_id).html(response.qty);
	             		$('#price'+response.item_id).html(response.price);
	             			if(response.type == 'Pre Order'){
	             		       var html ='<div class="btn-group" role="group">'
						     +'<button id="btnGroupDrop1" type="button" class="btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
						     +'   Update'
						     +'   </button>'
						     +'   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
						     +'		<a class="dropdown-item" id="action"  data-id="'+response.item_id+'" data-action="REQUEST">Request</a>'
						     +'		<a class="dropdown-item" id="action'+response.item_id+'"  data-qty="'+response.qty+'" data-price="'+response.price+'" data-id="'+response.item_id+'" data-action="EDIT">Edit</a>'
						      +'		<a class="dropdown-item" id="action"  data-id="'+response.item_id+'" data-action="CANCELLED">Cancel</a>'
						     +'   </div>'
						     +'</div>';
			             	}else{
			             		var html ='<div class="btn-group" role="group">'
								     +'<button id="btnGroupDrop1" type="button" class="btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
								     +'   Update'
								     +'   </button>'
								     +'   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
								     +'		<a class="dropdown-item" id="action'+response.item_id+'" data-qty="'+response.qty+'" data-price="'+response.price+'" data-id="'+response.item_id+'" data-action="EDIT" >Edit</a>'
								     +'		<a class="dropdown-item" id="action" data-id="'+response.item_id+'" data-action="CANCELLED">Cancel</a>'
								     +'   </div>'
								     +'</div>';
			             	}
			             	$('#btn_action'+response.item_id).empty();
	             			$('#btn_action'+response.item_id).append(html);
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Vouncher_Customer":{
	 			if(response.status == 'success'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 				$('#button'+response.id).empty();
	 				$('#button'+response.id).append('<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" disabled><i class="icon-nm ki ki-bold-check"></i></button>');
	 				$('#username'+response.id).empty();
	  				$('#username'+response.id).append(response.username);
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Approval_Concern":{
	 			if(response == 'P'){
	 				Swal.fire("Approved!", "Thank you!", "success").then(function(){
                        let TableURL = baseURL + 'datatable_controller/Customer_Concern_Request_Sales_DataTable';
						let TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Customer_Concern_Approved_Sales_DataTable';
						let TableData1 = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_approved',TableURL1,TableData1,false);
                    });
	 			}else if(response == 'A'){
	 				Swal.fire("Approved!", "Thank you!", "success").then(function(){
                        let TableURL = baseURL + 'datatable_controller/Customer_Concern_Request_Superuser_DataTable';
						let TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Customer_Concern_Approved_Superuser_DataTable';
						let TableData1 = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_approved',TableURL1,TableData1,false);     
                     });
	 			}else if(response == 'C'){
	 				Swal.fire("Rejected!", "Thank you!", "error").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Customer_Concern_Request_Superuser_DataTable';
						let TableData = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_request',TableURL,TableData,false);

                        let TableURL1 = baseURL + 'datatable_controller/Customer_Concern_Approved_Superuser_DataTable';
						let TableData1 = [{data:'no'},{data:'production_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_service_approved',TableURL1,TableData1,false);  
                     });
	 			}
	 			$('#modal-form').modal('hide');
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Customer":{
	 			if(response.status == 'create'){
	 				$('input[name="firstname"]').val('');
			  		$('input[name="lastname"]').val('');
			  		$('input[name="mobile"]').val('');
			  		$('input[name="email"]').val('');
			  		$('input[name="address"]').val('');
			  		$('input[name="city"]').val('');
			  		$('input[name="province"]').val('');
			  		$('select[name="region"]').val('').change();
			  		let TableURL = baseURL + 'datatable_controller/Customer_List_DataTable';
					let TableData =  [{data: 'no'},{data: 'name'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status'},{data: 'action'}];
					_DataTableLoader('tbl_customer_list',TableURL,TableData,false);
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 			}else if(response.status == 'update'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 				let TableURL = baseURL + 'datatable_controller/Customer_List_DataTable';
					let TableData =  [{data: 'no'},{data: 'name'},{data:'mobile'},{data:'email'},{data:'date_created'},{data:'status'},{data: 'action'}];
					_DataTableLoader('tbl_customer_list',TableURL,TableData,false);
	 			}else{
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Nothing Changes'});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		
	 		
	 		case "Update_Material_Purchase_Supervisor":{
	 			if(response.status == 'success'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
					$('#tbl_material #row_'+response.id).find("td").eq(2).text(response.qty);
					$('#exampleModal').modal('hide');
	 			}else if(response.status == 'material-create'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
						$('#tbl_material > tbody').prepend('<tr id="row_'+response.id+'">\
		  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_material" data-action="material-remove" data-id="'+response.id+'"><i class="flaticon-delete-1"></i></button></td>\
							<td data-id="'+response.id+'"><a href="#" id="form-item" data-action="material" data-name="'+response.item+'" data-id="'+response.id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.id+'">'+response.item+'</a></td>\
							<td>'+response.qty+'</td>\
							<td class="text-center">'+response.previous+'</td>\
							<td>'+response.stocks+'</td>\
							<td><input type="text" class="form-control form-control-sm text-center" placeholder="Enter Quantity"/></td>\
							<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_request" data-action="material-request" data-id="'+response.id+'"><i class="flaticon2-fast-next"></i></button></td>\
						</tr>');
						$('#tbl_material_used > tbody').prepend('<tr id="row_'+response.id+'">\
								<td data-id="'+response.id+'">'+response.item+'</td>\
								<td>'+response.p_qty+'</td>\
								<td><input type="text" class="form-control form-control-sm text-center" id="quantity_used'+response.id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
								<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_used" data-action="material-used" data-m="plus" data-id="'+response.id+'"><i class="flaticon2-plus"></i></button>\
								<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_material_used" data-action="material-used" data-m="minus" data-id="'+response.id+'"><i class="flaticon2-line"></i></button></td>\
							</tr>');
					$('#exampleModal').modal('hide');
	 			}else if(response.status == 'purchased-create'){
	 					const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
						$('#tbl_puchased > tbody').prepend('<tr id="row_'+response.id+'">\
			  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_purchased" data-action="purchased-remove" data-id="'+response.id+'"><i class="flaticon-delete-1"></i></button></td>\
								<td><a href="#" id="form-item" data-action="purchased" data-name="'+response.item+'" data-id="'+response.id+'" data-toggle="modal" data-target="#exampleModal">'+response.item+'</a></td>\
								<td>'+response.qty+'</td>\
								<td>'+response.unit+'</td>\
								<td>'+response.remarks+'</td>\
								<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_purchased_request" data-action="purchased-request" data-id="'+response.id+'"><i class="flaticon2-fast-next"></i></button></td>\
							</tr>');
					$('#exampleModal').modal('hide');
	 			}else if(response.status == 'material-remove'){
	 				$('#tbl_material #row_'+response.id).remove();
	 				$('#tbl_material_used #row_'+response.id).remove();
					_initToast('success','Your Material has been removed');
	 			}else if(response.status == 'purchased-remove'){
	 				$('#tbl_puchased #row_'+response.id).remove();
					_initToast('success','Your Material has been removed');
	 			}else if(response.status == 'material-request'){
	 				$('#quantity'+response.id).val('');
	 				$('#tbl_material #row_'+response.id).find("td").eq(3).text(response.balance);
	 				_initToast('success','Material Request Submited');
				}else if(response.status == 'purchased-update'){
					_initToast('success','Save Changes');
					$('#tbl_puchased #row_'+response.id).find("td").eq(2).text(response.qty);
					$('#tbl_puchased #row_'+response.id).find("td").eq(3).text(response.unit);
				 	$('#tbl_puchased #row_'+response.id).find("td").eq(4).text(response.remarks);
					$('#exampleModal').modal('hide');
				}else if(response.status == 'purchased-request'){
					$('#tbl_puchased #row_'+response.id).remove();
					_initToast('success','Purchased Request Submited');
				}else if(response.status == 'material-used'){
					$('#quantity_used'+response.id).val('');
					_initToast('success','Save Material');
				}else if(response.status == 'material-used-saved'){
					$('#quantity_used'+response.id).val('');
					$('#tbl_material_used #row_'+response.id).find("td").eq(1).text(response.qty);
					_initToast('success','Save Changes');
				}else{
					_initToast('info','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Design_Stocks":{
	 			if(response.status == 'update'){
	 				_initToast('success','Save Changes');
	 				let TableURL = baseURL + 'datatable_controller/Design_Stocks_Request_DataTable';
					let TableData = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_stocks_request',TableURL,TableData,false);
					let TableURL1 = baseURL + 'datatable_controller/Design_Stocks_Approved_DataTable';
					let TableData1 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_stocks_approved',TableURL1,TableData1,false);
					let TableURL2 = baseURL + 'datatable_controller/Design_Stocks_Rejected_DataTable';
					let TableData2 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_stocks_rejected',TableURL2,TableData2,false);
	 				$('.btn-edit').attr('data-action','edit');
	 				$('.image-view').css('display','block');
				 	$('.image-update').css('display','none');
				 	$('.color-view').css('display','block');
				 	$('.color-update').css('display','none');
				 	$('.specifications-edit').css('display','none');
				 	$('.btn-edit').css('display','block');
					$('.btn-save').css('display','none');
				 	$("input[name=image]").val("");
				 	$("input[name=color]").val("");
				 	$("input[name=docs]").val("");
				 	$("input[name=title]").val(response.title).attr('readonly');
				 	$("input[name=c_name]").val(response.c_name).attr('readonly');
				 	$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.image+")");
	  				$(".c-image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  				$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
		  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
		  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  			("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
				 	$('input[name="image_previous"]').val(response.image);
		  			$('input[name="color_previous"]').val(response.c_image);
		  			$('input[name="docs_previous"]').val(response.docs);
	 			}else{
	 				_initToast('error','Image is incorrect format!');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Design_Project":{
	 			if(response.status == 'update'){
	 				_initToast('success','Save Changes');
	 				let TableURL = baseURL + 'datatable_controller/Design_Project_Request_DataTable';
					let TableData = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_project_request',TableURL,TableData,false);

					let TableURL1 = baseURL + 'datatable_controller/Design_Project_Approved_DataTable';
					let TableData1 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_project_approved',TableURL1,TableData1,false);

					let TableURL2 = baseURL + 'datatable_controller/Design_Project_Rejected_DataTable';
					let TableData2 = [{data:'project_no'},{data:'title'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_design_project_rejected',TableURL2,TableData2,false);
	 				$('.btn-edit').attr('data-action','edit');
	 				$('.image-view').css('display','block');
				 	$('.image-update').css('display','none');
				 	$('.specifications-edit').css('display','none');
				 	$('.btn-edit').css('display','block');
					$('.btn-save').css('display','none');
				 	$("input[name=image]").val("");
				 	$("input[name=docs]").val("");
				 	$("input[name=title]").val(response.title).attr('readonly');
				 	$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.image+")");
	  				$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
		  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
				 	$('input[name="image_previous"]').val(response.image);
		  			$('input[name="docs_previous"]').val(response.docs);
	 			}else{
	 				_initToast('error','Image is incorrect format!');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Joborder_Project":
	 		case "Create_Joborder_Stocks":{
	 			Swal.fire("Created Successfully!", "Thank you!", "success").then(function(){
	 				location.reload();	 			
	 			});
	 			break;
	 		}
	 		case "Create_Joborder_Inpection_Project_Image":{
	 			if(response.status == 'maximum'){
	 				Swal.fire("Warning!", "You exceed the maximum number of 15 images!", "warning");
	 				$('#customFile').val("");
		 			document.getElementById("imagess").value = null;
	 			}else if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 $('#customFile').val(" ");
		 			 document.getElementById("imagess").value = null;
	 			}else if(response.status == 'success'){
	 				$("#requestInspection").prepend('<div class="col-lg-2 col-xl-2" id="row_'+response.id+'">'
				  			+'<div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url('+baseURL+'assets/images/inspection/'+response.image+')">'
							+'<div class="image-input-wrapper"></div>'
							+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="delete" data-id="'+response.id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
							+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
							+'	 </label>'
							+'  </div>'
				  			+'</div>');
	 				_initToast('success','Save Changes');
		 			$('#customFile').val(" ");
		 			document.getElementById("imagess").value = "";
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Joborder_Inpection_Stocks_Image":{
	 			if(response.status == 'maximum'){
	 				Swal.fire("Warning!", "You exceed the maximum number of 15 images!", "warning");
	 				$('#customFile').val("");
		 			document.getElementById("imagess").value = null;
	 			}else if(response.status == 'no image'){
	 				 Swal.fire("Warning!", "No Image Upload!", "question");
	 				 $('#customFile').val(" ");
		 			 document.getElementById("imagess").value = null;
	 			}else if(response.status == 'success'){
	 				$("#requestInspection").prepend('<div class="col-lg-2 col-xl-2" id="row_'+response.id+'">'
				  			+'<div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url('+baseURL+'assets/images/inspection/'+response.image+')">'
							+'<div class="image-input-wrapper"></div>'
							+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="delete" data-id="'+response.id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
							+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
							+'	 </label>'
							+'  </div>'
				  			+'</div>');
	 				_initToast('success','Save Changes');
		 			$('#customFile').val(" ");
		 			document.getElementById("imagess").value = "";
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Delete_Inspection_Image":{
	 			Swal.fire("Deleted!", "Image Deleted", "error").then(function(){$('#roww_'+response.id).remove();});
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Joborder_Status":{
	 			if(response.type==1){
	 				if(response.status == 1){
	 					_initToast('success', response.qty+' Units is Successfully Completed');
	 				}else{
	 					_initToast('error', response.qty+' Units is Successfully Cancelled');
	 				}
	 				$('#unit').val(response.unit);
		 			$('input[name=unit]').val("");
	 				if(response.unit == 0){
	 					$('#requestModal').modal('hide');
	 				}
		 			
	 			}else{
	 				if(response.status == 1){
	 					_initToast('success','Project is Successfully Completed');
	 				}else{
	 					_initToast('error', 'Project is Successfully Cancelled');
	 				}
	 				$('#requestModal').modal('hide');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Purchase_Stocks_Estimate":{
	 			if(response == true){
	 				_initToast('success','Estimated Cost is Successfully Submited');
	 				let TableURL = baseURL + 'datatable_controller/Purchase_Material_Stocks_Request_DataTable';
					let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

					let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Inprogress_DataTable';
					let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);
					$('#requestModal').modal('hide');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Purchase_Stocks_Process":{
	 			if(response == true){
	 				_initToast('success','Puchased Item is Successfully Submited');
	 				let TableURL = baseURL + 'datatable_controller/Purchase_Material_Stocks_Request_DataTable';
					let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

					let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Inprogress_DataTable';
					let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);
						
					let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Stocks_Complete_DataTable';
					let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
					_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
					$('#processModal').modal('hide');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Purchase_Project_Estimate":{
	 			if(response == true){
	 				_initToast('success','Estimated Cost is Successfully Submited');
	 				let TableURL = baseURL + 'datatable_controller/Purchase_Material_Project_Request_DataTable';
					let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

					let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Project_Inprogress_DataTable';
					let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);
					$('#requestModal').modal('hide');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Purchase_Project_Process":{
	 			if(response == true){
	 				_initToast('success','Puchased Item is Successfully Submited');
	 				let TableURL = baseURL + 'datatable_controller/Purchase_Material_Project_Request_DataTable';
					let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request',TableURL,TableData,false);

					let TableURL1 = baseURL + 'datatable_controller/Purchase_Material_Project_Inprogress_DataTable';
					let TableData1 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'status'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_purchase_request_inprogress',TableURL1,TableData1,false);
						
					let TableURL3 = baseURL + 'datatable_controller/Purchase_Material_Project_Complete_DataTable';
					let TableData3 = [{data:'production_no'},{data:'item'},{data:'quantity'},{data:'amount'},{data:'supplier'},{data:'terms'},{data:'date_created'}]; 
					_DataTableLoader('tbl_purchase_request_complete',TableURL3,TableData3,false);
					$('#processModal').modal('hide');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Material_Request_Stocks_Process":{
	 			if(response.status == 'success'){
	 				_initToast('success','Puchased Item is Successfully Submited');
	 				$('#tbl_material_request_stocks_modal > tbody > tr:nth-child('+(url+1)+') > td:nth-child(2)').text(response.total);
			        	$('#tbl_material_accept > tbody > tr:nth-child('+url+') > td:nth-child(2)').attr('data-balance',response.total).text(response.total);
			        	$('#tbl_material_accept > tbody > tr:nth-child('+url+') > td:nth-child(4) > input').val("");
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Material_Request_Project_Process":{
	 			if(response.status == 'success'){
	 				_initToast('success','Puchased Item is Successfully Submited');
	 				$('#tbl_material_request_stocks_modal > tbody > tr:nth-child('+url+') > td:nth-child(2)').text(response.total);
			        	$('#tbl_material_accept > tbody > tr:nth-child('+url+') > td:nth-child(2)').attr('data-balance',response.total).text(response.total);
			        	$('#tbl_material_accept > tbody > tr:nth-child('+url+') > td:nth-child(4) > input').val("");
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Joborder_Request":{
	 			if(response == true){
	 				Swal.fire("Created Successfully!", "Thank you!", "success").then(function(){
	 					location.reload();	 			
	 				});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Joborder_Stocks":{
	 			if(response.status == 'success'){
	 				Swal.fire("Job Order Request Successfully Update!", "Thank you!", "success").then(function(){	
	 					window.location =  baseURL + 'gh/designer/joborder-stocks'; 			
	 				});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Joborder_Project":{
	 			if(response.status == 'success'){
	 				Swal.fire("Job Order Request Successfully Update!", "Thank you!", "success").then(function(){	
	 					window.location =  baseURL + 'gh/designer/joborder-project'; 			
	 				});
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Design_Stocks":{
	 			if(response.status=="create"){
	 				Swal.fire("Submited!", "This form is Completed!", "success").then(function(){
		      			location.reload();
					});
	 			}else{
	 				Swal.fire("Warning!", "Image is incorrect format", "error");
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Design_Project":{
	 			if(response.status=="create"){
	 				Swal.fire("Submited!", "This form is Completed!", "success").then(function(){
		      			location.reload();
					});
	 			}else{
	 				Swal.fire("Warning!", "Image is incorrect format", "error");
	 			}
	 			_initnotificationupdate();
	 			break
	 		}
	 		case "Create_Other_Materials_Request":{
	 			Swal.fire("Submited!", "This form is Completed!", "success").then(function(){
		      			location.reload();
				});
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_SpareParts":{
	 			if(response == true){ 
	 				_initToastSuccess();$('input[name="item"]').val('');
	 				let TableURL = baseURL + 'datatable_controller/SpareParts_DataTable';
					let TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
					_DataTableLoader('tbl_spareparts_add',TableURL,TableData,false);
				}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_OfficeSupplies":{
	 			if(response==true){ 
	 				_initToastSuccess();
	 				$('input[name="item"]').val('');
	 				let TableURL = baseURL + 'datatable_controller/OfficeSupplies_DataTable';
					let TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
					_DataTableLoader('tbl_officesupplies_add',TableURL,TableData,false);
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_SpareParts":{
	 			if(response==true){ 
	 				_initToast('success','Saved Changes');
	 				let TableURL = baseURL + 'datatable_controller/SpareParts_DataTable';
					let TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
					_DataTableLoader('tbl_spareparts_add',TableURL,TableData,false);
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_OfficeSupplies":{
	 			if(response==true){ 
	 				_initToast('success','Saved Changes');
	 				let TableURL = baseURL + 'datatable_controller/OfficeSupplies_DataTable';
					let TableData = [{data:'no'},{data: 'item'},{data: 'date_created'},{data: 'action'}]; 
					_DataTableLoader('tbl_officesupplies_add',TableURL,TableData,false);
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Rawmats_Stocks":{
	 			if(response == true){
	 			Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
	 			let TableURL = baseURL + 'datatable_controller/RawMaterial_Stocks_DataTable';
				let TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_rawmats',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/RawMaterial_OutStocks_DataTable';
				let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
				_DataTableLoader('tbl_rawmats_outofstocks',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/RawMaterial_New_DataTable';
				let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
				_DataTableLoader('tbl_rawmats_new',TableURL2,TableData2,false);
				});}else{
	 				_initToast('error','Nothing Changes');
				}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_SpareParts_Stocks":{
	 			if(response == true){
	 				Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
			 			let TableURL = baseURL + 'datatable_controller/SpareParts_Stocks_DataTable';
						let TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
						_DataTableLoader('tbl_spareparts',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/SpareParts_Outofstocks_DataTable';
						let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
						_DataTableLoader('tbl_spareparts_outofstocks',TableURL1,TableData1,false);

						let TableURL2 = baseURL + 'datatable_controller/SpareParts_newstocks_DataTable';
						let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
						_DataTableLoader('tbl_spareparts_new',TableURL2,TableData2,false);
					});
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_OfficeSupplies_Stocks":{
	 			if(response == true){
			 			Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
			 			let TableURL = baseURL + 'datatable_controller/OfficeSupplies_Stocks_DataTable';
						let TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
						_DataTableLoader('tbl_officesupplies',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/OfficeSupplies_Outofstocks_DataTable';
						let TableData1 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'stocks_alert'},{data: 'action'}];
						_DataTableLoader('tbl_officesupplies_outofstocks',TableURL1,TableData1,false);

						let TableURL2 = baseURL + 'datatable_controller/OfficeSupplies_newstocks_DataTable';
						let TableData2 =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'date_created'}];
						_DataTableLoader('tbl_officesupplies_new',TableURL2,TableData2,false);
						});
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Production":{
	 			if(response == true){
	 				_initToast('success','Save Changes');
	 				let TableURL = baseURL + 'datatable_controller/RawMat_Production_Stocks_DataTable';
					let TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'action'}];
					_DataTableLoader('tbl_production_stocks',TableURL,TableData,false);
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			_initnotificationupdate();
	 			break;
	 		}
	 			case "Update_Approval_Design_Stocks":{
	 			if(response.status==3){
	 				 Swal.fire("REJECTED!", "Thank you!!", "warning").then(function(){
 				 		let TableURL = baseURL + 'datatable_controller/Approval_Design_Stocks_Request_DataTable';
						let TableData = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_stocks_request',TableURL,TableData,false);

						let TableURL2 = baseURL + 'datatable_controller/Approval_Design_Stocks_Rejected_DataTable';
						let TableData2 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_stocks_rejected',TableURL2,TableData2,false);
	 				 });
	 			}else{
	 				 Swal.fire("APPROVED!", "Thank you!!", "success").then(function(){
	 				 	let TableURL = baseURL + 'datatable_controller/Approval_Design_Stocks_Request_DataTable';
						let TableData = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_stocks_request',TableURL,TableData,false);

	 				 	let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Stocks_Approved_DataTable';
						let TableData1 = [{data:'project_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_stocks_approved',TableURL1,TableData1,false);
	 				 });
	 			}
	 			$('#modal-form').modal('hide');
	 			_initnotificationupdate();
	 			break;
	 		}

	 		case "Update_Approval_Designed_Project":{
	 			if(response.status==3){
	 				 Swal.fire("REJECTED!", "Thank you!!", "warning").then(function(){
 				 		let TableURL = baseURL + 'datatable_controller/Approval_Design_Project_Request_DataTable';
						let TableData = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_project_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Project_Request_DataTable';
						let TableData1 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_project_rejected',TableURL1,TableData1,false);
	 				 });
	 			}else{
	 				 Swal.fire("APPROVED!", "Thank you!!", "success").then(function(){
	 				 	let TableURL = baseURL + 'datatable_controller/Approval_Design_Project_Request_DataTable';
						let TableData = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_project_request',TableURL,TableData,false);

	 				 	let TableURL1 = baseURL + 'datatable_controller/Approval_Design_Project_Approved_DataTable';
						let TableData1 = [{data:'project_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_approval_design_project_approved',TableURL1,TableData1,false);
	 				 });
	 			}
	 			$('#modal-form').modal('hide');
	 			_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_SupplierItem":{
	 			_initToast('success',response);
	 			let TableURL = baseURL + 'datatable_controller/SupplierItem_DataTable';
				let TableData =  [{data:'item'},{data: 'price'},{data:'status'},{data: 'date_created'},{data: 'action'}];
				_DataTableLoader('tbl_supplier_item',TableURL,TableData,supplier_id);
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Suppliers":{
	 			Swal.fire("Update!", "This form is Completed!", "success").then(function(){
		      			location.reload();
				});
	 			break;
	 		}
	 		case "Create_Request_Material":
            case "Create_Salesorder_Stocks":
	 		case "Create_Salesorder_Project":{
                if(response == true){
                    Swal.fire("Create Successfully!", "This form is Completed!", "success").then(function(){
                    	 location.reload();
                     }); 
                }else{
                      Swal.fire("Error!", "Something went wrong!", "error");
                }
                _initnotificationupdate();
	 			break;
	 		}
               case "Update_Salesorder_Stock_Request":{
                    if(response == 'A'){
                         $('#requestModal').modal('hide');
                         _initToast('success','Sales Order Approved');
                    }else{
                          $('#requestModal').modal('hide');
                         _initToast('error','Sales Order Rejected');
                    }
                    let TableURL = baseURL + 'datatable_controller/Salesorder_Stocks_Request_DataTable_Admin';
                    let TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

                    let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Approved_DataTable_Admin';
                    let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

                    let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Rejected_DataTable_Admin';
                    let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
                    _initnotificationupdate();
                    break;
               }
                case "Update_Salesorder_Project_Request":{
                    if(response == 'A'){
                         $('#requestModal').modal('hide');
                         _initToast('success','Sales Order Approved');
                    }else{
                          $('#requestModal').modal('hide');
                         _initToast('error','Sales Order Rejected');
                    }
                    let TableURL = baseURL + 'datatable_controller/Salesorder_Project_Request_DataTable_Admin';
                    let TableData = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_approved',TableURL,TableData,false);

                    let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Approved_DataTable_Admin';
                    let TableData1 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

                    let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Rejected_DataTable_Admin';
                    let TableData2 = [{data:'so_no'},{data:'customer'},{data:'created'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
                    _initnotificationupdate();
                    break;
                }
                case "Update_Salesorder_Stock_Delivery":{
                    $('#requestModal').modal('hide');
                     _initToast('success','Sales Invoice Number Submitted');
                    let TableURL1 = baseURL + 'datatable_controller/Salesorder_Stocks_Shipping_DataTable_Superuser';
                    let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

                    let TableURL2 = baseURL + 'datatable_controller/Salesorder_Stocks_Delivered_DataTable_Production';
                    let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
                    _initnotificationupdate();
                    break;
                }
                case "Update_Salesorder_Project_Delivery":{
                    $('#requestModal').modal('hide');
                     _initToast('success','Sales Invoice Number Submitted');
                    let TableURL1 = baseURL + 'datatable_controller/Salesorder_Project_Shipping_DataTable_Superuser';
                    let TableData1 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_shipping',TableURL1,TableData1,false);

                    let TableURL2 = baseURL + 'datatable_controller/Salesorder_Project_Delivered_DataTable_Superuser';
                    let TableData2 = [{data:'so_no'},{data:'customer'},{data:'date_created'},{data:'action'}]; 
                    _DataTableLoader('tbl_salesorder_delivered',TableURL2,TableData2,false);
                    _initnotificationupdate();
                    break;
                }
             case "Create_Return_Item_Warehouse":{
	 			_initToast('success','Return Item Successfully Submited ');
	 			$('#item').empty();
	 			if(response == 1){
	 				let TableURL = baseURL + 'datatable_controller/Return_Item_Good_DataTable_Superuser';
					let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'type'},{data:'date_created'}]; 
					_DataTableLoader('tbl_return_item_good',TableURL,TableData,false);
	 			}else{
	 				let TableURL1 = baseURL + 'datatable_controller/Return_Item_Rejected_DataTable_Superuser';
					let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'type'},{data:'date_created'}]; 
					_DataTableLoader('tbl_return_item_rejected',TableURL1,TableData1,false);
	 			}
	 			_initnotificationupdate();
	 			document.getElementById('Create_Return_Item').reset();
	 			break;
	 		}
	 		case "Create_Return_Item_Customer":{
	 			_initToast('success','Return Item Successfully Submited ');
	 			if(response == 1){
	 				let TableURL = baseURL + 'datatable_controller/Return_Item_Repair_Customer_DataTable_Superuser';
					let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
					_DataTableLoader('tbl_return_item_repair',TableURL,TableData,false);
	 			}else if(response == 2){
	 				let TableURL1 = baseURL + 'datatable_controller/Return_Item_Good_Customer_DataTable_Superuser';
					let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
					_DataTableLoader('tbl_return_item_good',TableURL1,TableData1,false);
	 			}else{
	 				let TableURL2 = baseURL + 'datatable_controller/Return_Item_Rejected_Customer_DataTable_Superuser';
					let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'remarks'},{data:'date_created'}]; 
					_DataTableLoader('tbl_return_item_rejected',TableURL2,TableData2,false);
	 			}
	 			$('#item').empty();
	 			_initnotificationupdate();
	 			document.getElementById('Create_Return_Item_Customer').reset();
	 			break;
	 		}
	 		case "Update_Request_Materials":{
	 			if(response == true){
	 				_initToast('success','Request Material Successfully Submited');
					let TableURL1 = baseURL + 'datatable_controller/Request_Material_Received_Superuser_Datatable';
					let TableData1 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
					_DataTableLoader('tbl_request_material_received',TableURL1,TableData1,false);

					let TableURL2 = baseURL + 'datatable_controller/Request_Material_Cancelled_Superuser_Datatable';
					let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
					_DataTableLoader('tbl_request_material_cancelled',TableURL2,TableData2,false);
					$('#requestModal').modal('hide');
	 			}else if(response == false){
	 				Swal.fire("Oopps!", "Something went wrong, Please try again later", "info"); 
	 			}else{
	 				$('.balance-quantity').val(response.qty);
	 				$('input[name=quantity]').val(0);
	 				Swal.fire("Oopps!", response.item+" is out of stocks", "error"); 
	 			}
	 			let TableURL = baseURL + 'datatable_controller/Request_Material_List_Superuser_Datatable';
				let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_request_material_list',TableURL,TableData,false);
	 			_initnotificationupdate();
	 			break;
	 		}
	 		 case "Update_Request_Materials_Cancelled":{
	 		 	if(response == true){
	 		 	_initToast('success','Request Cancelled');
		 		 	let TableURL2 = baseURL + 'datatable_controller/Request_Material_Cancelled_Superuser_Datatable';
					let TableData2 = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'}]; 
					_DataTableLoader('tbl_request_material_cancelled',TableURL2,TableData2,false);
	 			}else{
	 				Swal.fire("Oopps!", "Something went wrong, Please try again later", "info"); 
	 			}
		 			let TableURL = baseURL + 'datatable_controller/Request_Material_List_Superuser_Datatable';
					let TableData = [{data:'no'},{data:'item'},{data:'quantity'},{data:'type'},{data:'date_created'},{data:'action'}]; 
					_DataTableLoader('tbl_request_material_list',TableURL,TableData,false);
	 			_initnotificationupdate();
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
