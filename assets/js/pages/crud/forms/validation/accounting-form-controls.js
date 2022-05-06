'use strict';
// Class definition
var KTFormControls = function () {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const url_Params_Status = urlParams.get('urlstatus');
	var validation;var form;var url;var thisURL;var val;
	var idArr = [];var idArrs = [];var idItemArr = [];var keys = [];var myData = {};
	var id;var production_no;var status;var item;var quantity;var remarks;var status;
	var supplier;var payment;var received;var balance;var amount;var warehouse_status;
	var unit;var designer;var production;var supervisor;var superuser;var admin;var role;
	var no;var unit;var accounting;
	var _initSwalWarning = function(url){
	     Swal.fire("Warning!", "Please Complete the form!", "warning");
	}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       window.location = url;
		});
	}
	var _initCurrency_format = function(action){
		$( document ).ready(function() {
			$(''+action+'').mask('000,000,000,000,000.00', {reverse: true});
		});
	}
	var _initToastSuccess = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initToastWarning = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'warning',title: 'Nothing to change'});
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
	}
	var _initgetvaluetable = function(){

			 $("table thead th").each(function() {
				   var k = $(this).text().trim().toLowerCase();
				   keys.push(k);
				   myData[k] = [];
			 });
			 $("table tbody tr").each(function(i, el) {
				  $.each(keys, function(k, v) {
				      myData[v].push($("td:eq(" + k + ")", el).text().trim());
				    });
			  });
				 item = myData.items;
				 quantity = myData.qty;
				 unit = myData.unit; 	 	
				 remarks = myData.remarks;
	}
	var _initgetvaluetable2 = function(){
			 $("#myTable thead th").each(function() {
				   var k = $(this).text().trim().toLowerCase();
				   keys.push(k);
				   myData[k] = [];
			 });
			 $("#myTable tbody tr").each(function(i, el) {
				  $.each(keys, function(k, v) {
				      myData[v].push($("td:eq(" + k + ")", el).text().trim());
				    });
			  });
				 item = myData.items;
				 status = myData.status;
				 supplier = myData.supplier;
				 payment  = myData.payment;
				 received = myData.received;
				 amount = myData.amount;
	}
	var _initgetvaluetable3 = function(){

			 $("table thead th").each(function() {
				   var k = $(this).text().trim().toLowerCase();
				   keys.push(k);
				   myData[k] = [];
			 });
			 $("table tbody tr").each(function(i, el) {
				  $.each(keys, function(k, v) {
				      myData[v].push($("td:eq(" + k + ")", el).text().trim());
				    });
			  });
			      no = myData.no;
				 item = myData.items;
				 quantity = myData.qty; 	
				 unit = myData.unit;
	}
	var _initgetvalueArray = function(){
		     $("input[name='id[]']").each(function(){
		            idArr.push($(this).val());

		     });
		     $('.supplier_in option:selected').each(function(){
		            idArrs.push($(this).val());
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
	var _initnotificationupdate = function(){
		 let url = window.location.pathname;
		 let urlpost;
		  if(url.split('/')[0] == 'genteelhome2022' || url.split('/')[0] == 'genteelhomev2'){
		 	urlpost = url.split('/')[2];
		 }else if(url.split('/')[1] == 'genteelhome2022' || url.split('/')[1] == 'genteelhomev2'){
		 	urlpost = url.split('/')[3];
		 }else if(url.split('/')[2] == 'genteelhome2022' || url.split('/')[2] == 'genteelhomev2'){
		 	urlpost = url.split('/')[4];
		 }else if(url.split('/')[3] == 'genteelhome2022' || url.split('/')[3] == 'genteelhomev2'){
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
		 	_ajaxloaderOption('Dashboard_controller/admin_dashboard','POST',false,'admin');
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
				$('.request_stocks_project').text(response.request_stocks_project);

				$('.request_jo_stocks').text(response.request_jo_stocks);
				$('.request_jo_project').text(response.request_jo_project);
				$('.request_jo').text(response.request_jo_designer);

				$('.request_material_pending').text(response.request_material_pending);
				$('.request_material_received').text(response.request_material_received);
				$('.request_material_cancelled').text(response.request_material_cancelled);

				$('.request_pre_order_pending').text(response.request_pre_order_pending);
				$('.request_pre_order_approved').text(response.request_pre_order_approved);
				$('.request_pre_order_rejected').text(response.request_pre_order_rejected);

				$('.request_customized_pending').text(response.request_customized_pending);
				$('.request_customized_approved').text(response.request_customized_approved);
				$('.request_customized_rejected').text(response.request_customized_rejected);

				$('.request_preoder_customized').text(response.request_preoder_customized);
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
				$('.customer_count').text(response.customer_total_count);
				$('.customer_request_count').text(response.customer_service_request);
				$('.customer_approved_count').text(response.customer_service_approved);

				$('.online_add_cart').text(response.online_add_cart);
				$('.pre_order_count').text(response.pre_order_count);
				$('.collection_count').text(response.collection_count);

				$('.request_customized_pending').text(response.request_customized_pending);
				$('.request_customized_approved').text(response.request_customized_approved);
				$('.request_customized_rejected').text(response.request_customized_rejected);

				$('.request_inquiry_pending').text(response.request_inquiry_pending);
				$('.request_inquiry_approved').text(response.request_inquiry_approved);
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

				$('.material_request_complete_stocks').text(response.material_request_complete_stocks);
				$('.material_request_complete_project').text(response.material_request_complete_project);

				$('.material_request_pending_stocks').text(response.material_request_pending_stocks);
				$('.material_request_pending_project').text(response.material_request_pending_project);

				$('.purchase_stocks_pending').text(response.purchase_stocks_pending);
				$('.purchase_stocks_approved').text(response.purchase_stocks_approved);
				$('.purchase_project_pending').text(response.purchase_project_pending);
				$('.purchase_project_approved').text(response.purchase_project_approved);
				$('.purchase_stocks').text(response.purchase_stocks);
				$('.purchase_project').text(response.purchase_project);

				$('.purchase_stocks_complete').text(response.purchase_stocks_complete);
				$('.purchase_project_complete').text(response.purchase_project_complete);
				break;
			}
			case "admin":{
				$('.request_stocks').text(response.request_stocks);
				$('.approved_stocks').text(response.approved_stocks);
				$('.rejected_stocks').text(response.rejected_stocks);
				$('.request_project').text(response.request_project);
				$('.approved_project').text(response.approved_project);
				$('.rejected_project').text(response.rejected_project);

				$('.request_sales_stocks').text(response.request_sales_stocks);
				$('.approved_sales_stocks').text(response.approved_sales_stocks);
				$('.rejected_sales_stocks').text(response.rejected_sales_stocks);

				$('.request_sales_project').text(response.request_sales_project);
				$('.approved_sales_project').text(response.approved_sales_project);
				$('.rejected_sales_project').text(response.rejected_sales_project);

				$('.stocks_inpection_pending').text(response.stocks_inpection_pending);
				$('.stocks_inpection_approved').text(response.stocks_inpection_approved);
				$('.stocks_inpection_rejected').text(response.stocks_inpection_rejected);

				$('.project_inpection_pending').text(response.project_inpection_pending);
				$('.project_inpection_approved').text(response.project_inpection_approved);
				$('.project_inpection_rejected').text(response.project_inpection_rejected);

				$('.total_request').text(response.total_request);
				break;
			}
			
		}
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
	var _DataTableLoader1 = async function(link,TableURL,TableData,val){
		var table = $('#'+link);
		table.DataTable().clear().destroy();
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			destroy: true,
			responsive: true,
			info: true,
			searching: false,
			pageLength : 4,
    			lengthChange: false,
			"fnDrawCallback": function() {
	                $('[data-toggle="tooltip"]').tooltip();
	                _initCurrency_format('.td-amount');

	           },
			language: { 
			 	infoEmpty: "No records available", 
			 },
			serverSide:false,
			ajax: {
				url: TableURL,
				type: 'POST',
				datatype: "json",
				data: {val:val},
			},
			columns:TableData,
		});
	}
	var _DataTableLoader = async function(link,TableURL,TableData,val){
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
				data: val,
			},
			columns:TableData,
		});

	}		

	 var _FormSubmit = async function(action){
	 	switch(action){
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
				  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
			  	      _ajaxForm(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_username').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="username"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);

	 			});
	 			$('#save_firstname').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="firstname"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_lastname').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="lastname"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
				  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 			});
	 			$('#save_middlename').on('click', function(e){
	 				e.preventDefault();
	 				var action = $(this).attr('data-action');
	 				var data = $('input[name="middlename"]').val();
			   		val = {data:data,action:action};
				  	thisURL = baseURL + 'update_controller/Update_Profile';
				  	var page = $('input[name=page]').val();
				  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
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
					  	url = baseURL + 'gh/'+page+'/user_update?'+btoa('urlstatus=pending');
					  	_ajaxForm_loaded(thisURL,"POST",val,"Update_Profile",false);
	 				}else{
	 					const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Password not matched'});
	 				}
			   		
	 			});
	 			break;
	 		}
	 		   case "Update_Purchase_Stocks_Request":{
	 		   		form = document.getElementById('Update_Accounting_Purchase_Request_Stocks');
				         validation = FormValidation.formValidation(
							form,{
								fields: {
									cash_fund: {validators: {notEmpty: {message: 'Cash Fund is required'}}}
								},
								plugins: {
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap()
							}
						   }
					    );
					    $(document).on('click','.btn-request-submit',function(e){
		 				e.preventDefault();
		 				let action = $(this).attr('data-status');
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
	                                           let formData = new FormData(form);
	                                            formData.append('id',$('.cash_fund').text());
	                                            formData.append('action',action);
                                                 thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Request';
									  _ajaxForm(thisURL,"POST",formData,"Update_Accounting_Purchase_Stocks_Request",false);
						          	}
					     		});
					   	 }
				   	 	});
		 			});	
					var form_received = document.getElementById('Update_Accounting_Purchase_Request_Received');
				     var validation_received = FormValidation.formValidation(
							form_received,{
								fields: {
									actual_change: {validators: {notEmpty: {message: 'Change is required'}}}
								},
								plugins: {
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap()
							}
						   }
					    );
					    $(document).on('click','.btn-received-submit',function(e){
		 				e.preventDefault();
		 				validation_received.validate().then(function(status) {
					     if (status == 'Valid') {
				     		 Swal.fire({
							        title: "Are you sure?",
							        text: "You won't be able to revert this",
							        icon: "warning",
							        confirmButtonText: "Submit!",
							        showCancelButton: true
							    }).then(function(result) {
							        if (result.value) {
	                                           let formData = new FormData(form_received);
	                                            formData.append('id',$('.cash_fund_r').text());
                                                 thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Received';
									  _ajaxForm(thisURL,"POST",formData,"Update_Accounting_Purchase_Stocks_Received",false);
						          	}
					     		});
					   	 }
				   	 	});
		 			});	    
	 			break;
	 		   }
	 		   case "Update_Purchase_Material_Project_Request":{
		 			form = document.getElementById('Update_Accounting_Purchase_Request_Stocks');
				         validation = FormValidation.formValidation(
							form,{
								fields: {
									cash_fund: {validators: {notEmpty: {message: 'Cash Fund is required'}}}
								},
								plugins: {
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap()
							}
						   }
					    );
					    $(document).on('click','.btn-request-submit',function(e){
		 				e.preventDefault();
		 				let action = $(this).attr('data-status');
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
	                                           let formData = new FormData(form);
	                                            formData.append('id',$('.cash_fund').text());
	                                            formData.append('action',action);
                                                 thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Request';
									  _ajaxForm(thisURL,"POST",formData,"Update_Accounting_Purchase_Project_Request",false);
						          	}
					     		});
					   	 }
				   	 	});
		 			});	
					var form_received = document.getElementById('Update_Accounting_Purchase_Request_Received');
				     var validation_received = FormValidation.formValidation(
							form_received,{
								fields: {
									actual_change: {validators: {notEmpty: {message: 'Change is required'}}}
								},
								plugins: {
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap()
							}
						   }
					    );
					    $(document).on('click','.btn-received-submit',function(e){
		 				e.preventDefault();
		 				validation_received.validate().then(function(status) {
					     if (status == 'Valid') {
				     		 Swal.fire({
							        title: "Are you sure?",
							        text: "You won't be able to revert this",
							        icon: "warning",
							        confirmButtonText: "Submit!",
							        showCancelButton: true
							    }).then(function(result) {
							        if (result.value) {
	                                           let formData = new FormData(form_received);
	                                            formData.append('id',$('.cash_fund_r').text());
                                                 thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Received';
									  _ajaxForm(thisURL,"POST",formData,"Update_Accounting_Purchase_Project_Received",false);
						          	}
					     		});
					   	 }
				   	 	});
		 			});	    
	 			break;
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
                                                      formData.append('date_downpayment',$('#date-text-downpayment').attr('data-date'));
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
                                                      formData.append('date_downpayment',$('#date-text-downpayment').attr('data-date'));
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


	 		   case "Update_Project_Monitoring":{
	 		   	$(document).on('click','.save',function(e){
	 		   		e.preventDefault();
 		     		let element = $(this);
	  				let action = element.attr('data-action');
	  				let id = $('.btn-search').attr('data-id');
	  				let split = action.split("-");
	  				let data = $('input[name='+split[1]+']').val();
				 	let  formdata = new FormData();
				 	formdata.append('id',id);
 		     		formdata.append('data',data);
 		     		formdata.append('start',$('input[name=start]').val());
 		     		formdata.append('due',$('input[name=due]').val());
 		     		formdata.append('action',action);
 		     		thisURL = baseURL + 'update_controller/Update_Project_Monitoring';
		 			_ajaxForm(thisURL,"POST",formdata,"Update_Project_Monitoring",false);
	 			});
	 		   	break;
	 		   }
	 	
	 		   case "Cash_Position":{
	 			$(document).on('click','.save',function(e){
 		     		e.preventDefault();
 		     		let action = $(this).attr('data-action');
 		     		let status = $(this).attr('data-status');
 		     		let id = $(this).attr('data-id');
 		     		let name = $('input[name=name]').val();
	  				let amount = $('input[name=amount]').val();
	  				let date_position = $('input[name=date_position]').val();
	  				let type = $('select[name=type]').val();
	  				let cat_id = $('select[name=cat_id]').val();
	  				// let description = $('textarea[name=description]').val();
	  				if(!name || !amount || !date_position){
	  					Swal.fire("Warning!", "Please Complete The Form!", "warning");
	  				}else{
	  					if(action == 'create'){
		     				thisURL = baseURL + 'create_controller/Create_Cash_Position';
	 		     		}else{
					     	thisURL = baseURL + 'update_controller/Update_Cash_Position';
	 		     		}   
	 		     		let  formdata = new FormData();
	 		     			formdata.append('id',id);
	 		     			formdata.append('name',name);
					     	formdata.append('amount',amount);
					     	// formdata.append('description',description);	
					     	formdata.append('date_position',date_position);
					     	formdata.append('type',type);
					     	formdata.append('cat_id',cat_id);
					     _ajaxForm(thisURL,"POST",formdata,"Cash_Position",false);	
	  				}
	 			});
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
						  	 _ajaxForm(thisURL,"POST",val,"Update_OfficeSupplies_Stocks",false);
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
	 		case "Update_Supplier":{
				var form = document.getElementById('Create_Supplier_Item');
			         validation = FormValidation.formValidation(
						form,
						{
							fields: {item_add: {validators: {notEmpty: {message: 'Item is required'}}},
								amount_add: {validators: {notEmpty: {message: 'Amount is required'}}},
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
	 			$(document).on('click','.btn-add',function(e){
	 				e.preventDefault();
	 				validation.validate().then(function(status) {
					     if (status == 'Valid'){ 	
						 	let fd = new FormData(form);
		   					fd.append('id',$('.name').attr('data-id'));
		   					fd.append('item',$('select[name=item_add]').val());
		   					fd.append('amount',$('input[name=amount_add]').val());
						 	thisURL = baseURL + 'create_controller/Create_Supplier_Item';
					  	 	_ajaxForm(thisURL,"POST",fd,"Create_Supplier_Item",false);
					     }
					 });
	 			})

	 			var form1 = document.getElementById('Update_Supplier_Item');
			    var validation1 = FormValidation.formValidation(
						form1,
						{
							fields: {item: {validators: {notEmpty: {message: 'Item is required'}}},
								amount: {validators: {notEmpty: {message: 'Amount is required'}}},
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
	 			$(document).on('click','.btn-save-item',function(e){
	 				e.preventDefault();
	 				validation1.validate().then(function(status) {
					     if (status == 'Valid'){ 	
						 	let fd = new FormData(form1);
		   					fd.append('supplier',$('.name').attr('data-id'));
		   					fd.append('id',$('select[name=item]').attr('data-id'));
		   					fd.append('amount',$('input[name=amount]').val());
						 	thisURL = baseURL + 'update_controller/Update_Supplier_Item';
					  	 	_ajaxForm(thisURL,"POST",fd,"Update_Supplier_Item",false);
					     }
					 });
	 			})
	 			var form2 = document.getElementById('Update_Supplier_Edit');
			    var validation2 = FormValidation.formValidation(
						form2,
						{
							fields: {name: {validators: {notEmpty: {message: 'Supplier Name is required'}}},
								mobile: {validators: {notEmpty: {message: 'Mobile is required'}}},
								email: {validators: {notEmpty: {message: 'Email is required'}}},
								address: {validators: {notEmpty: {message: 'Address is required'}}},
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
	 			$(document).on('click','.btn-save-supplier',function(e){
	 				e.preventDefault();
	 				validation2.validate().then(function(status) {
					     if (status == 'Valid'){ 	
						 	let fd = new FormData(form2);
		   					fd.append('id',$('.name').attr('data-id'));
						 	thisURL = baseURL + 'update_controller/Update_Supplier_Edit';
					  	 	_ajaxForm(thisURL,"POST",fd,"Update_Supplier_Edit",false);
					     }
					 });
	 			})
	 			var form3 = document.getElementById('Create_Supplier');
			    var validation3 = FormValidation.formValidation(
						form3,
						{
							fields: {name_add: {validators: {notEmpty: {message: 'Supplier Name is required'}}},
								mobile_add: {validators: {notEmpty: {message: 'Mobile is required'}}},
								email_add: {validators: {notEmpty: {message: 'Email is required'}}},
								address_add: {validators: {notEmpty: {message: 'Address is required'}}},
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
	 			$(document).on('click','.btn-add-supplier',function(e){
	 				e.preventDefault();
	 				validation3.validate().then(function(status) {
					     if (status == 'Valid'){ 	
						 	let fd = new FormData(form3);
						 	thisURL = baseURL + 'create_controller/Create_Supplier';
					  	 	_ajaxForm(thisURL,"POST",fd,"Create_Supplier",false);
					     }
					 });
	 			})
	 			$(document).on('click','.btn-add-supplier',function(e){
	 				e.preventDefault();
	 				validation3.validate().then(function(status) {
					     if (status == 'Valid'){ 	
						 	let fd = new FormData(form3);
						 	thisURL = baseURL + 'create_controller/Create_Supplier';
					  	 	_ajaxForm(thisURL,"POST",fd,"Create_Supplier",false);
					     }
					 });
	 			})
	 			$("input[name=image]").on('change',function(e) {
                    e.preventDefault();
                    if($('input[name=image]')[0].files[0]){
                    	let name = e.target.files[0].name;
                    	let extension = name.split(".");
                    	if(extension[1] == 'docx' || extension[1] == 'pdf' || extension[1] == 'csv' || extension[1] == 'gif' || extension[1] == 'doc'){
                    		Swal.fire("Warning!", "Make sure the file is jpg & png", "warning");
                    	}else{
                    		let fd = new FormData();
	                    	fd.append('id',$('.name').attr('data-id'));
	                    	fd.append('image',$('input[name=image]')[0].files[0]);
	                    	thisURL = baseURL + 'update_controller/Update_Supplier_Image';
						  	 _ajaxForm(thisURL,"POST",fd,"Update_Supplier_Image",false);
                    	}
                    }
                  });
	 			break;
	 		}
	 		case "Create_Deposit":{
	 			var form = document.getElementById('Create_Deposit');
			         validation = FormValidation.formValidation(form,{
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
	 			$(document).on('click','#create_deposite_btn',function(e){
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


	 		case "Update_Project_Monitoring":{
	 			if(response.status == 'success'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Saves Changes!'});
	 			}else{
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'error',title: 'Nothing Changes!'});
	 			}
	 				if(response.action == 'save-name'){
	  					$('.btn-name').attr('data-action','edit-name').removeClass('save');
	  					$('#edit-name').removeClass('flaticon2-check-mark').addClass('far fa-edit');
					 	$('.text-name').attr('disabled');
				 	}else if(response.action == 'save-address'){
				 		$('.btn-address').attr('data-action','edit-address').removeClass('save');
				 		$('#edit-address').removeClass('flaticon2-check-mark').addClass('far fa-edit');
				 		$('.text-address').attr('disabled');
				 	}else if(response.action == 'save-amount'){
				 		$('.btn-amount').attr('data-action','edit-amount').removeClass('save');
				 		$('#edit-amount').removeClass('flaticon2-check-mark').addClass('far fa-edit');
				 		$('.text-amount').prop('disabled','disabled');
				 	}else if(response.action == 'save-labor'){
				 		$('.btn-labor').attr('data-action','edit-labor').removeClass('save');
				 		$('#edit-labor').removeClass('flaticon2-check-mark').addClass('far fa-edit');
				 		$('.text-labor').prop('disabled','disabled');
				 	}else if(response.action == 'save-date'){
				 		$('.btn-date').attr('data-action','edit-date').removeClass('save');
				 		$('#edit-date').removeClass('flaticon2-check-mark').addClass('far fa-edit');
				 		$('.text-start').prop('disabled','disabled');
				 		$('.text-due').prop('disabled','disabled');
				 	}
	 			break;
	 		}
	 	
	 		case "Cash_Position":{
	 			if(response.status == 'create'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Created Successfully!'});
	 				$('input[name=name]').val("");
	  				$('input[name=amount]').val('');
	  				$('input[name=date_position]').val("");
	  				$('select[name=type]').val('');
	  				$('#search').trigger('click');
	 			}else if(response.status == 'update'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Saves Changes!'});
	 			}else{
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'info',title: 'Nothing Changes!'});	
	 			}
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
	 			break;
	 		}
	 		case "Update_Production":{
	 			if(response == true){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 				let TableURL = baseURL + 'datatable_controller/RawMat_Production_Stocks_DataTable';
					let TableData =  [{data: 'no'},{data: 'item'},{data:'stocks'},{data:'action'}];
					_DataTableLoader('tbl_production_stocks',TableURL,TableData,false);
	 			}else{
	 				_initToast('error','Nothing Changes');
	 			}
	 			break;
	 		}
	 		case "Create_Supplier_Item":{
	 			if(response !=false){
	 				_initToast('success','Item created successfully');
			 		let TableURL = baseURL + 'modal_controller/Modal_Supplier_Item_View';
					let TableData = [{data:'item'},{data:'amount',className: "text-center"},{data:'action', className: "text-center"}];
					_DataTableLoader1('tbl_supplier_item',TableURL,TableData,response);
					$('#Create_Supplier_Item')[0].reset();
					$('#add-item').modal('hide');
	 			}else{
	 				Swal.fire("Oopps!", "Item Already Exist", "error"); 
	 			}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Supplier_Item":{
	 			if(response !=false){
	 				_initToast('success','Save Changes');
			 		let TableURL = baseURL + 'modal_controller/Modal_Supplier_Item_View';
					let TableData = [{data:'item'},{data:'amount',className: "text-center"},{data:'action', className: "text-center"}];
					_DataTableLoader1('tbl_supplier_item',TableURL,TableData,response);
					$('#Update_Supplier_Item')[0].reset();
					$('#edit-item').modal('hide');
	 			}else{
	 				Swal.fire("Oopps!", "Item Already Exist", "error"); 
	 			}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Supplier_Edit":{
	 			if(response !=false){
	 				$('.name').text(response.name).attr('data-id',response.id);
			  		$('.mobile').text(response.mobile);
			  		$('.email').text(response.email);
			  		$('.address').text(response.address);
	 				_initToast('success','Save Changes');
					$('#edit-supplier').modal('hide');
	 			}else{
	 				 Swal.fire("Error!", "Something went wrong!", "error");
	 			}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Create_Supplier":{
	 			if(response !=false){
	 				_initToast('success','New Supplier Created Successfully');
	 				let TableURL = baseURL + 'datatable_controller/Supplier_Datatable';
					let TableData =  [{data: 'name'},{data: 'address'},{data: 'mobile'},{data:'status'},{data: 'date_created'},{data: 'action'}]; 
					_DataTableLoader('tbl_supplier',TableURL,TableData,false);
					$('#Create_Supplier')[0].reset();
					$('#add-supplier').modal('hide');
	 			}else{
	 				 Swal.fire("Error!", "Something went wrong!", "error");
	 			}
				_initnotificationupdate();
	 			break;
	 		}
	 		case "Update_Supplier_Image":{
	 			if(response != false){
	 				_initToast('success','Save changes');
	 				$('.image-view').css('background-image','url('+baseURL+'assets/images/supplier/'+response+')');
	 			}else{
	 				 Swal.fire("Error!", "Image upload is incorrect!", "warning");
	 			}
	 			break;
	 		}
	 		case "Update_Accounting_Purchase_Stocks_Received":
	 		case"Update_Accounting_Purchase_Stocks_Request":{
	 			if(response.type == 'success'){
	 				_initToast(response.type,response.message);
	 				let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks';
					let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action'}];
					_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

					let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
					let TableData2 = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action'}]; 
					_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
					if(response.type == 'success'){
						$('#view-purchased-request').modal('hide');
						$('#view-purchased-received').modal('hide');
					}
	 			}else{
	 				 Swal.fire("Error!", "Something went wrong! ("+response.message+")", response.type);
	 			}
				break;
	 		}
	 		case "Update_Accounting_Purchase_Project_Received":
	 		case"Update_Accounting_Purchase_Project_Request":{
	 			if(response.type == 'success'){
	 				_initToast(response.type,response.message);
	 				let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
					let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action'}];
					_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

					let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
					let TableData2 = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'status'},{data:'action'}]; 
					_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
					if(response.type == 'success'){
						$('#view-purchased-request').modal('hide');
						$('#view-purchased-received').modal('hide');
					}
	 			}else{
	 				 Swal.fire("Error!", "Something went wrong! ("+response.message+")", response.type);
	 			}
				break;
	 		}
	 	}
	 }

	return {
		// public functions
		init: function() {
		     var tbl =	$('.form').attr('data-link');
		     if(tbl == 'request_form'){
		    		_initsubmit_request();
		    	}else{
		    	     _FormSubmit(tbl);
		    	}
		    
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
