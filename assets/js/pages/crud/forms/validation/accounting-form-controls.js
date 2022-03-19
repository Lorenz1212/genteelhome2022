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
	var _initToastSuccess = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save changes'});
	}
	var _initToastWarning = function()
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'warning',title: 'Nothing to change'});
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
	 		   case "Update_Purchase_Material_Stocks_Request":{
		 			$(document).on('click','.save_request',function(e){
		 				e.preventDefault();
		 				let cash = $('input[name="cash_request"]').val();
		 				let fund_no = $('#joborder').attr('data-id');
		 				if(!cash){
		 					Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 				}else{
			 				let formdata = new FormData();
			 				formdata.append('fund_no',fund_no);
			 				formdata.append('cash',cash);
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Request';
			 			   _ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Material_Stocks_Request",false);	
		 				}
		 				
		 			});
		 			 $(document).on('click','.save_approved',function(e){
		 			 	e.preventDefault();
		 				let cash = $('input[name="cash_approved"]').val();
		 				let fund_no = $('#production_no_f').attr('data-id');
		 				let previous = $('#pettycash').text();
		 				if(!cash){
		 					Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 				}else{
			 				val = {fund_no:fund_no,cash:cash,previous:previous};
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Material_Stocks_Approved';
			 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Accounting_Purchase_Material_Stocks_Approved",false);	
		 				}
		 				
		 			});
		 			  $(document).on('click','.save_received',function(e){
		 			  	e.preventDefault();
		 				let refund = $('input[name="refund"]').val();
		 				let change = $('input[name="change"]').val();
		 				let fund_no = $('input[name="fund_no"]').val();
		 				let total = $('#total').text(); 
		 				if(!change){
		 					Swal.fire("Warning!", "Please Input the Actual changed!", "warning");
		 				}else{
			 				val = {fund_no:fund_no,change:change,refund:refund,total:total};
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Received';
			 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Purchase_Stocks_Received",false);	
		 				}
		 				
		 			});
	 			break;
	 		   }
	 		   case "Update_Purchase_Material_Project_Request":{
		 			$(document).on('click','.save_request',function(e){
		 				e.preventDefault();
		 				let cash = $('input[name="cash_request"]').val();
		 				let fund_no = $('#joborder').attr('data-id');
		 				if(!cash){
		 					Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 				}else{
			 				let formdata = new FormData();
			 				formdata.append('fund_no',fund_no);
			 				formdata.append('cash',cash);
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Request';
			 			   _ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Material_Project_Request",false);	
		 				}
		 				
		 			});
		 			 $(document).on('click','.save_approved',function(e){
		 			 	e.preventDefault();
		 				let cash = $('input[name="cash_approved"]').val();
		 				let fund_no = $('#production_no_f').attr('data-id');
		 				let previous = $('#pettycash').text();
		 				if(!cash){
		 					Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 				}else{
			 				val = {fund_no:fund_no,cash:cash,previous:previous};
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Material_Stocks_Approved';
			 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Accounting_Purchase_Material_Project_Approved",false);	
		 				}
		 				
		 			});
		 			  $(document).on('click','.save_received',function(e){
		 			  	e.preventDefault();
		 				let refund = $('input[name="refund"]').val();
		 				let change = $('input[name="change"]').val();
		 				let fund_no = $('input[name="fund_no"]').val();
		 				let total = $('#total').text(); 
		 				if(!change){
		 					Swal.fire("Warning!", "Please Input the Actual changed!", "warning");
		 				}else{
			 				val = {fund_no:fund_no,change:change,refund:refund,total:total};
			 				thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Received';
			 			   _ajaxForm_loaded(thisURL,"POST",val,"Update_Purchase_Project_Received",false);	
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
                                                      formData.append('date_downpayment',$('input[name="downpayment"]').val());
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


	 		 //   case "Update_Purchase_Stocks_Request":{
		 		// 	$(document).on('click','.save_request',function(e){
		 		// 		e.preventDefault();
		 		// 		let cash = $('input[name="cash_request"]').val();
		 		// 		let request_id = $('input[name="request_id"]').val();
		 		// 		if(!cash){
		 		// 			Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 		// 		}else{
		 		// 			let formdata = new FormData();
		 		// 			formdata.append('request_id',request_id);
		 		// 			formdata.append('cash',cash);
			 	// 			thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Request';
			 	// 			url = baseURL + 'gh/accounting/purchase-project-request';
			 	// 		    _ajaxForm(thisURL,"POST",val,"Update_Purchase_Stocks_Request",url);	
		 		// 		}
		 		// 	});
		 		// 	 $(document).on('click','.save_approved',function(e){
		 		// 	 	e.preventDefault();
		 		// 		let cash = $('input[name="cash_approved"]').val();
		 		// 		let fund_no = $('input[name="fund_no"]').val();
		 		// 		let previous = $('#pettycash').text();
		 		// 		if(!cash){
		 		// 			Swal.fire("Warning!", "Please Input the cash fund!", "warning");
		 		// 		}else{
		 		// 			let formdata = new FormData();
		 		// 			formdata.append('fund_no',fund_no);
		 		// 			formdata.append('cash',cash);
		 		// 			formdata.append('previous',previous);
			 	// 			thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Approved';
			 	// 		     _ajaxForm(thisURL,"POST",formdata,"Update_Purchase_Stocks_Approved",false);	
		 		// 		}
		 				
		 		// 	});
		 		// 	$(document).on('click','.save_received',function(e){
		 		// 		e.preventDefault();
		 		// 		let refund   		= $('input[name="refund"]').val();
		 		// 		let change   		= $('input[name="change"]').val();
		 		// 		let total    		= $('#total').text(); 
		 		// 		if(!change){
		 		// 			Swal.fire("Warning!", "Please Input the Actual changed!", "warning");
		 		// 		}else{
		 		// 		   let formdata = new FormData();
		 		// 		   formdata.append('fund_no',$('input[name="fund_no"]').val());
				 //     	   formdata.append('change',change);
				 //     	   formdata.append('refund',refund);	
				 //     	   formdata.append('total',total);	
				 //     	   thisURL = baseURL + 'update_controller/Update_Accounting_Purchase_Stocks_Received';
			 	// 		   _ajaxForm(thisURL,"POST",formdata,"Update_Accounting_Purchase_Stocks_Received",false);		
		 		// 		}
		 		// 	});
	 			// break;
	 		 //   }	
	 		  
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
	 		case "Create_SupplierItem":{
	 			$('#Create_SupplierItem').on('click',function(e){		
		 			 Swal.fire({
					        title: "Are you sure?",
					        text: "You won't be able to revert this",
					        icon: "warning",
					        confirmButtonText: "Submit!",
					        showCancelButton: true
					    }).then(function(result) {
					        if (result.value) {
					        	 id = $('input[name=id]').val(); 
					   		 amount = $('#price').val();
					   		 item = $('#item').val().split('-');
					   		 val = {id:id,item:item[0],price:amount};
						  	 thisURL = baseURL + 'create_controller/Create_SupplierItem';
						  	 url = baseURL + 'gh/superuser/supplier_view/'+btoa(id);
						  	 _ajaxForm_loaded(thisURL,"POST",val,"Create_SupplierItem",false);
				         }
				   	 });
				});
				break;
	 		}
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
	 		case "Update_Purchase_Material_Stocks_Request":{
	 			if(response == true){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
		 				let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Request';
						let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Approval';
						let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

						let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
						let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
						$('#requestModalRequest').modal('hide');
	 				});
                	 }
                 	
	 			break;
	 		}
	 		case "Update_Accounting_Purchase_Material_Stocks_Approved":{
	 			if(response.status=="success"){
		 				$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			 				$('#button_save').hide();
			 				var s = $('input[name="previouscash"]').val();
			 				if(response.cash == s){
			 					$('#del_cash').text('');
			 				}else{
			 					$('#del_cash').text(response.previous);
			 				}
				  		   	 $('#pettycash').text(response.cash);
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edits').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			                $('#button_saves').hide();

			           }

	               let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Request';
				let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
                break;
	 		}
	 		case "Update_Purchase_Stocks_Received":{
	 			if(response.status=="success"){
		 				$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			 				$('#button_save').hide();
			 				$('#change').hide();
			 				$('#change1').show();
				  		   	$('#change1').html('<span>'+response.change+'</span>');

				  		   	$('#refund').hide();
			 				$('#refund1').show();
				  		   	$('#refund1').html('<span>'+response.refund+'</span>');
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			                $('#button_save').hide();
			           }
			     let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Request';
				let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
                break;
	 		}
	 		case "Update_Purchase_Material_Project_Request":{
	 			if(response == true){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
		 				let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
						let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
						_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Approval';
						let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

						let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
						let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
						_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
						$('#requestModalRequest').modal('hide');
	 				});
                	 }
                 	
	 			break;
	 		}
	 		case "Update_Accounting_Purchase_Material_Project_Approved":{
	 			if(response.status=="success"){
		 				$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			 				$('#button_save').hide();
			 				var s = $('input[name="previouscash"]').val();
			 				if(response.cash == s){
			 					$('#del_cash').text('');
			 				}else{
			 					$('#del_cash').text(response.previous);
			 				}
				  		   	 $('#pettycash').text(response.cash);
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edits').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			                $('#button_saves').hide();
			           }
	               let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
				let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
                break;
	 		}
	 		case "Update_Purchase_Project_Received":{
	 			if(response.status=="success"){
		 				$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			 				$('#button_save').hide();
			 				$('#change').hide();
			 				$('#change1').show();
				  		   	$('#change1').html('<span>'+response.change+'</span>');

				  		   	$('#refund').hide();
			 				$('#refund1').show();
				  		   	$('#refund1').html('<span>'+response.refund+'</span>');
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			                $('#button_save').hide();
			           }
			     let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Request';
				let TableData = [{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Project_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
                break;
	 		}


	 		case "Update_Purchase_Stocks_Request":{
	 			if(response.status=="success"){
	 				Swal.fire("APPROVED!", "Thank you!", "success").then(function(){
	 					let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Request';
						let TableData =  [{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
						_DataTableLoader('tbl_purchased_stocks_request',TableURL,TableData,false);

						let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Approval';
						let TableData1 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
						_DataTableLoader('tbl_purchased_stocks_approved',TableURL1,TableData1,false);

						let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Received';
						let TableData2 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
						_DataTableLoader('tbl_purchased_stocks_received',TableURL2,TableData2,false);
	 					$('#requestModal').modal('hide');
	 				});
                 }
	 			break;
	 		}
	 		case "Update_Purchase_Stocks_Approved":{
	 			if(response.status=="success"){
		 				$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			 				$('#button_save').hide();
			 				var s = $('input[name="previouscash"]').val();
			 				if(response.cash == s){
			 					$('#del_cash').text('');
			 				}else{
			 					$('#del_cash').text(response.previous);
			 				}
				  		   	 $('#pettycash').text(response.cash);
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edit').show('<button type="button" class="btn btn-success edit">EDIT</button>');
			                $('#button_save').hide();
			           }
			          let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Request';
					let TableData =  [{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
					_DataTableLoader('tbl_purchased_stocks_request',TableURL,TableData,false);

					let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Stocks_Received';
					let TableData2 =  [{data:'fund_no'},{data: 'request_id'},{data: 'requestor'},{data:'date_created'},{data: 'action'}];
					_DataTableLoader('tbl_purchased_stocks_received',TableURL2,TableData2,false);
                break;
	 		}
	 		case "Update_Accounting_Purchase_Stocks_Received":{
	 			if(response.status=="success"){
		 			$(document).ready(function(){
			 				_initToastSuccess();
			 				$('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			 				$('#button_save').hide();
			 				$('#change').hide();
			 				$('#change1').show();
				  		   	$('#change1').html('<span>'+response.change+'</span>');

				  		   	$('#refund').hide();
			 				$('#refund1').show();
				  		   	$('#refund1').html('<span>'+response.refund+'</span>');
		 				});
			           }else{
			           	_initToastWarning();
			                $('#button_edit').show('<button type="button" class="btn btn-success edit'+response.fund_no+'">EDIT</button>');
			                $('#button_save').hide();
			           }
			 	let TableURL = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Request';
				let TableData = [{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}];
				_DataTableLoader('tbl_purchased_request',TableURL,TableData,false);

				let TableURL1 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Approval';
				let TableData1 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_approved',TableURL1,TableData1,false);

				let TableURL2 = baseURL + 'datatable_controller/Accounting_Purchase_Material_Stocks_Received';
				let TableData2 = [{data:'fund_no'},{data:'production_no'},{data:'image'},{data:'title'},{data:'requestor'},{data:'date_created'},{data:'action'}]; 
				_DataTableLoader('tbl_purchased_received',TableURL2,TableData2,false);
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
	 		case "Create_SupplierItem":{
	 			if(response.status == 'success'){
	 				const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'success',title: 'Save Changes'});
	 				let TableURL = baseURL + 'datatable_controller/SupplierItem_DataTable';
					let TableData =  [{data: 'item'},{data: 'price'},{data: 'status'},{data: 'date_created'},{data: 'action'}];
					let id = $('input[name=id]').val();
					_DataTableLoader('tbl_supplier_item',TableURL,TableData,id);
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
