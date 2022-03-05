'use strict';
var KTAjaxClient = function() {
var arrows;
var html;
var option;
	var _initToastSuccess = function(type,message)
	{
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
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
		 $(""+action+"").inputmask('decimal', {
		   numericInput: true,
		   rightAlignNumerics: true
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
	var _initDatepicker = function(action){
		  $(action).datepicker({
		   rtl: KTUtil.isRTL(),
		   orientation: "bottom left",
		   todayHighlight: true,
		   templates: arrows
		  });
	}
	var _initDatepicker_year = function(action){
		  $(action).datepicker({
		   rtl: KTUtil.isRTL(),
		   orientation: "bottom left",
		   todayHighlight: true,
		   templates: arrows,
		   changeYear: false,
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

	var _initsupplier_option = async function(select_no,action){
		 $.ajax({
	             url: baseURL + 'option_controller/supplier_option',
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
                  	  	  let option1 = '<option value="'+response[i].name+'">'+response[i].name+'</option>';
                  	  	  $('#supplier_'+select_no).append(option1);  
                  	  	  $('#supplier_'+select_no).addClass('selectpicker');
					  $('#supplier_'+select_no).attr('data-live-search', 'true');
					  $('#supplier_'+select_no).selectpicker('refresh');
                  	  	
                  	  }
                  }                                    
		});	
	}
	var _initSO_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/SO_option',
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
                  	  	  let option = '<option value="'+response[i].so_no+'">'+response[i].so_no+'</option>';
                  	  	  $('#so').append(option); 
                  	  	  $('#so').addClass('selectpicker');
					  $('#so').attr('data-live-search', 'true');
					  $('#so').selectpicker('refresh');
				
                  	   }
                  }                                    
		});	
	}
	var _initUser = async function(username){
		 $.ajax({
	             url: baseURL + 'option_controller/User_option',
	             type: "POST",
	             data:{username:username},
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
                  	if(response.username == username){
                  		Swal.fire("Warning!", "Username is already exists!", "warning");
                  		$('input[name=username]').val('');
                  	}
                 }                                    
		});	
	}
	var _initUsers_option = function(action){
		$.ajax({
	             url: baseURL + 'option_controller/UserJobOrder_option',
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
                  	  	  $('#users_data').append(option);  
                  	  	  $('#users_data').addClass('selectpicker');
					  $('#users_data').attr('data-live-search', 'true');
					  $('#users_data').selectpicker('refresh');
                  	  	
                  	  }
                 }                                    
		});
	}
	var _initUserUpdate = function(username,id){
		var val = {username:username,id:id};
		 $.ajax({
	             url: baseURL + 'option_controller/UserUpdate_option',
	             type: "POST",
	             data:val,
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
                  	if(response== 'warning'){
                  		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: 'info',title: "Nothing changes"});
                  	}else if(response == 'error'){
                  		Swal.fire("Warning!", "Username is already exists!", "warning");
                  	}else{

                  	}
                 } 
		});	
	}
	var _initSalesOrder_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/SalesOrder_Option',
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
                  	  	  let option = '<option value="'+response[i].id+'-'+response[i].name+'">('+response[i].qty+') '+response[i].name+'</option>';
                  	  	 $('#officesupplies').append(option);
                  	  	 $('#officesupplies').addClass('selectpicker');
					 $('#officesupplies').attr('data-live-search', 'true');
					 $('#officesupplies').selectpicker('refresh');
                  	  }
                  }                                  
		});	
	}
	var _initItem_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/Item_option',
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
                  	  	 $('select[name=purchase_item]').selectpicker('refresh');
                  	  	  let option = '<option value="'+response[i].id+'-'+response[i].name+'">('+response[i].qty+') '+response[i].name+'</option>';
                  	  	  $('#item').append(option);
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
					   let option1 = '<option value="'+response[i].id+'-'+response[i].name+'">('+response[i].qty+') '+response[i].name+'</option>';
                  	  	  $('select[name=purchase_item]').append(option1);
                  	  	  $('select[name=purchase_item]').addClass('selectpicker');
					  $('select[name=purchase_item]').attr('data-live-search', 'true');
					  $('select[name=purchase_item]').selectpicker('refresh');
                  	  }
                  }                                  
		});	
	}
	var _initItemQTY_option = async function(id){
		 $.ajax({
	             url: baseURL + 'option_controller/ItemQty_option',
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
                  	 if(response.stocks <= response.stocks_alert && response.stocks_alert <= response.stocks){
                  	 	Swal.fire("Warning!", "Running Out of Stocks!", "warning");
                  	 }else if(response.stocks == 0){
                  	 	Swal.fire("Warning!", "Out of Stocks!", "warning");
                  	 }
                  }                                  
		});	
	}

	var _initProject_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/Project_option',
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
                  	  	// $('#project_no').selectpicker('refresh');
                  	  	  let option = '<option value="'+response[i].production_no+'-'+response[i].title+'-'+response[i].unit+'">'+response[i].production_no+'</option>';
                  	  	$('#production').append(option);
                  	  }
                  }                                   
		});	
	}
	var _initDesigner_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/Designer_option',
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
                  	  	let option = '<option value="'+response[i].project_no+'-'+response[i].title+'-'+response[i].image+'-'+response[i].docs+'-'+response[i].designer+'">'+response[i].title+'</option>';
                  	  	$('#project_no').append(option);
                  	  	$('#project_no').addClass('selectpicker');
				     $('#project_no').attr('data-live-search', 'true');
					$('#project_no').selectpicker('refresh');
                  	  }
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
	var _ajaxloaderOption = async function(thisURL,type,val,sub){
		  $.ajax({
	             url: baseURL + thisURL,
	             type: type,
	             data: val,
	             dataType:"json",
                  success: function(response){
                  	  _initOption(sub,response);
                  }                                     
		});	
	}

      var _initOption = function(view,response){
		switch(view){
			case "job_order":{
				if(!response == false){
					 $('#joborder').empty();
					 for(let i=0;i<response.length;i++){
	                  	  	  $('#joborder').append('<option value="'+response[i].production_no+'">'+response[i].production_no+'</option>').addClass('selectpicker').attr('data-live-search', 'true').selectpicker('refresh');
	                  	  }	
				}
				break;
			}
			case "Update_Income_Statement":{
				if(response.status == 'insert'){
	  				$('#tbl_income_daily > table > tbody > tr:nth-child('+response.count_tr+') > td:nth-child('+response.count+')').attr('data-id',response.last_id);
	  			}
	  			$('#tbl_income_daily > table > tbody > tr:nth-child('+response.count_tr+') > td.text-success.font-size-lg.sticky-col.second-col').text(response.total);
	  			$('#tbl_income_daily > table > tbody > tr:nth-child('+response.count_tr+') > td:nth-child('+response.count+')').text(response.amount);
			    break;
			}

		}
	}

	var _ViewController = async function(view){
		 _month_year();
		switch(view){
			case "data-dashboard-accounting":{
				_ajaxloader('Chart_controller/Fetch_Options',"POST",{type:'all_options',option:'MONTH'},"all_options");
				for (let g = 1; g<=3 ; ++g) {
                   KTApexChartsDemo.init('chart'+g, 'MONTH', new Date().getFullYear(), false);
	             $("a[tba_option"+g+"]").on("click", async function(){
	                   option = $(this).attr('data-id');
	                        if(option != '' || option != null){
	                        let result = await _ajaxloader('Chart_controller/Fetch_Options',"POST",{type:'chart'+g+'_options',option:option},'chart'+g+'_options');
	                            if(result == true){

	                              KTApexChartsDemo.init('chart'+g, option, $('#chart'+g+'_options').val(), false);
	                            }else{
	                              const Toast = Swal.mixin({
	                                        toast: true,
	                                        position: 'top-end',
	                                        showConfirmButton: false,
	                                        timer: 3000,
	                                        timerProgressBar: true,
	                                        onOpen: (toast) => {
	                                          toast.addEventListener('mouseenter', Swal.stopTimer)
	                                          toast.addEventListener('mouseleave', Swal.resumeTimer)
	                                        }
	                                      })
	                                      Toast.fire({
	                                        icon: 'info',
	                                        title: 'Cant load sales chart!'
	                                      })
	                                }
	                        }else{
	                            const Toast = Swal.mixin({
	                                          toast: true,
	                                          position: 'top-end',
	                                          showConfirmButton: false,
	                                          timer: 3000,
	                                          timerProgressBar: true,
	                                          onOpen: (toast) => {
	                                            toast.addEventListener('mouseenter', Swal.stopTimer)
	                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
	                                          }
	                                        })
	                                        Toast.fire({
	                                          icon: 'info',
	                                          title: 'Cant load sales chart!'
	                                        })  
	                        }
	                    })

	                  $('#chart'+g+'_options').on('change',function(e){
	                    e.preventDefault(); 
	                    KTApexChartsDemo.init('chart'+g, option, $('#chart'+g+'_options').val(), false);
	                  })
	                }
				break;
			}
			case "data-profile-update":{
				let thisUrl = 'view_controller/View_Profile';
				_ajaxloader(thisUrl,"POST",false,"View_Profile");
				break;
			}
			case "data-collection":{
					$(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Collection_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Collection_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Collection_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Collection_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Collection_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Collection_Yearly");		
								break;}
						}		
					});
 					 $(document).on('click','#action',function(e){
 						var action = $(this).attr('data-action');
 						$('#search_collection').attr('data-status',action);
 						$('#search_collection').trigger('click');
 					  }); 
					$('#action').trigger('click');  
				break;
			}
			case "data-saleorder":{
				   $(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Salesorder_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Salesorder_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Salesorder_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Salesorder_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Salesorder_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Salesorder_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Salesorder_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Salesorder_Yearly");		
								break;}
						}		
					});
 					
 					 $(document).on('click','#action',function(e){
 						var action = $(this).attr('data-action');
 						$('#search_collection').attr('data-status',action);
 						$('#search_collection').trigger('click');
 					 }); 
					$('#action').trigger('click');  
				break;
			}
			case "data-cashfund":{
				 $(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Project_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Project_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Project_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Project_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Project_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Project_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Project_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Project_Yearly");		
								break;}
						}		
					 });
 					 $(document).on('click','#action',function(e){
 						var action = $(this).attr('data-action');
 						$('#search_collection').attr('data-status',action);
 						$('#search_collection').trigger('click');
 					 }); 
					$('#action').trigger('click');
				break;
			}
			case "data-purchased-material-stocks-request":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Stocks_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Stocks_Request");
				    });
					$(document).on("click","#form-approval",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Stocks_Approved';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Stocks_Approved");
				    });
					$(document).on("click","#form-received",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Received_Stocks';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Received_Stocks");
				    });
				})
			   break;
			}
			case "data-purchased-material-project-request":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Project_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Project_Request");
				    });
					$(document).on("click","#form-approved",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Project_Approved';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Project_Approved");
				    });
				    $(document).on("click","#form-received",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Received_Project';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Received_Project");
				    });
				})
			   break;
			}
			case "data-production-supplies":{
				$(document).ready(function(){
					_initCurrency_format('.text-amount,.text-labor');
					_initDatepicker('#start-date,#end-date');
					_ajaxloaderOption('option_controller/Joborder_Option','POST',false,'job_order');
					 $(document).on('click','.btn-search',function(e){
					 	e.preventDefault();
					 	let val = {id:$('select[name=joborder]').val()};
						let thisUrl = 'datatable_controller/Account_Report_Production_Supplies';
						_ajaxloader(thisUrl,"POST",val,"Account_Report_Production_Supplies");
					});
				})
				break;
			}
			case "data-cashposition":{
				$(document).ready(function(){
					_initDatepicker('#date_position');
					_initCurrency_format('#amount');
					$(document).on('click','#search',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"weekly":{
								let thisUrl = 'datatable_controller/Account_Report_Cashposition_Weekly';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Cashposition_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Cashposition_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Cashposition_Monthly");
								break;}
							case "income-statement":{
								let thisUrl2 = 'datatable_controller/Account_Report_Income_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Income_Monthly");
								break;}
						}		
					 });
 					$(document).on('click','#action',function(e){
 						var action = $(this).attr('data-action');
 						$('#search').attr('data-status',action);
 						$('#search').trigger('click');
 					 }); 
					$('#action').trigger('click');  
				     $(document).on("click","#form-income",function(e) {
				     	e.preventDefault();
				     	let action = $(this).attr('data-action');
				     	if(action == 'create'){
				     		$('.save').attr('data-action','create');
							$('input[name=name]').val("");
			  				$('input[name=amount]').val('');
			  				$('input[name=date_position]').val('');
			  				$('select[name=type]').val('');
			  				// $('textarea[name=description]').val('');
						}else{
						 	let val = {id:$(this).attr('data-id')};
						 	let thisUrl = 'modal_controller/Modal_Accounting_Cash_Position';
							_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Cash_Position");
						}
				     });
				       $(document).on('dblclick','#tbl_cashposition_weekly > table > tbody > tr > #td-input', function(e){
					  	    e.preventDefault(); 
					  	    var col = $(this).index(),
						    row = $(this).parent().index();
						    var tbl_id = '#tbl_cashposition_weekly > table > tbody > tr:nth-child('+(row+1)+') > td:nth-child('+(col+1)+')';
						    var id = $('#tbl_cashposition_weekly > table > tbody > tr:nth-child('+(row+1)+')').attr('data-id');
						    var action = $('#tbl_cashposition_weekly > table > tbody > tr:nth-child('+(row+1)+') > td:nth-child('+(col+1)+')').attr('data-action');
						    $('#tbl_cashposition_weekly > table > tbody > tr:nth-child('+(row+1)+') > td:nth-child(6) > .delete').css('display','block');
						    if(action == 'date_position'){
						       let date = $(tbl_id).attr('data-date');
						       $(tbl_id+' > div.form-group > div > input').val(date);
						       $(tbl_id+' > .form-group').css('display','block');
						    	  $(tbl_id+' > #input-dateposition').hide();
						    	   _initDatepicker_year('.datepicker-input');
						    	  $(document).on('click',tbl_id+'> div.form-group > div > div > .btn-save', function(e){
						    	  	e.preventDefault(); 	
						    	  	 let data = $(tbl_id+' > div.form-group > div > input').val();
								 let val = {id:id,data:data,action:action,row:row,col:col};
								 _ajaxloaderOption('update_controller/Update_Cash_Position',"POST",val,"Update_Cash_Position");
								 _initToastSuccess('success','Save Changes');
								 $('#search').trigger('click');
							  });
							  $(document).on('click',tbl_id+' div.form-group > div > div > .btn-cancelled', function(e){
							  		e.preventDefault(); 
								 	_initToastSuccess('info','Nothing Changes');
								 	$(tbl_id+' > div.form-group').css('display','none');
								 	$(tbl_id+' > #input-dateposition').show();
							  });
						    }else{
						    		$(tbl_id).attr('contenteditable',true);
							    	 $(document).on('blur',tbl_id, function(e){
								    e.preventDefault(); 
								    let data =  $(tbl_id).text();
								    let val = {id:id,data:data,action:action,row:row,col:col};
								    _ajaxloaderOption('update_controller/Update_Cash_Position',"POST",val,false);
								    _initToastSuccess('success','Save Changes');
								  	$('#search').trigger('click');
								 });
						    }
					 });
				       $(document).on('click','.delete', function(e){
				       	 let id = $(this).attr('data-id');
				       	 Swal.fire({
						        title: "Are you sure?",
						        text: "You won't be able to revert this!",
						        icon: "warning",
						        showCancelButton: true,
						        confirmButtonText: "Yes, delete it!"
						    }).then(function(result) {
						        if (result.value) {
						        	let val = {id:id};
						         _ajaxloaderOption('delete_controller/Delete_Cash_Position',"POST",val,false);
						         _initToastSuccess('error','Remove Item');
						          $('#search').trigger('click');
						        }else{
						        	$('#search').trigger('click');
						        }
						    });
				       });
				       $(document).on('change','.select-type', function(e){
				       	let id = $(this).attr('data-id');
				        	let data = $(this).val();
				        	let val = {id:id,data:data,action:'type'};
				         _ajaxloaderOption('update_controller/Update_Cash_Position',"POST",val,false);
				         _initToastSuccess('success','Saved Changes');
				          $('#search').trigger('click');
				       });
				       $(document).on('change','.select-category', function(e){
				       	let id = $(this).attr('data-id');
				       	let data = $(this).val();
				        	let val = {id:id,data:data,action:'category'};
				         _ajaxloaderOption('update_controller/Update_Cash_Position',"POST",val,false);
				         _initToastSuccess('success','Saved Changes');
				       });

				})
				break;
			}
			case "data-rawmats-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Stocks_Rawmats_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_Rawmats_View");
				    });
				})
				break;
			}
			case "data-spareparts-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Stocks_SpareParts_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_SpareParts_View");
				    });
				})
				break;
			}
			case "data-officesupplies-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Stocks_OfficeSupplies_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_OfficeSupplies_View");
				    });
				})
				break;
			}
			case "data-rawmaterials":{
				_initCurrency_format("#price");
				  $(document).ready(function() {
					   $(document).on("click","#form-request",function() {
						let id = $(this).attr('data-id');
						let val = {id:id};
						let thisUrl = 'modal_controller/Modal_RawMaterial_view';
						_ajaxloader(thisUrl,"POST",val,"Modal_RawMaterial_view");
				    });
				  });
				break;
			}
			case "data-production-stocks":{
				_initNumberOnly('#stockss');
				  $(document).ready(function() {
					   $(document).on("click","#form-request",function() {
						let val = {id:$(this).attr('data-id')};
						let thisUrl = 'modal_controller/Modal_Production_Stocks';
						_ajaxloader(thisUrl,"POST",val,"Modal_Production_Stocks");
				    });
				  });
				break;
			}
		}
	}

	var _initView = async function(type,response){
	  switch(type){
	  	 case 'chart1_options':
           case 'chart2_options':
           case 'all_options':{
                $("#"+type).empty();
                if(response != false){
                      if(type=='all_options'){
                      	for (i = new Date().getFullYear(); i > 2020; i--)
					{
					    $('#chart1_options').append($('<option />').val(i).html(i));
					}
                        // if(response.gensale){
                        //       for (var i = 0; response.gensales.length > i; i++){
                        //          if(response.gensales.length - 1 == i){
                        //            $("#chart1_options").append('<option selected value="'+response.gensales[i].year+'">'+response.gensales[i].year+'</option>'); 
                        //          }else{
                        //           $("#chart1_options").append('<option value="'+response.gensales[i].year+'">'+response.gensales[i].year+'</option>'); 
                        //          }
                        //        }
                        // }else{
                        //   $("#chart1_options").append('<option selected value="'+response.default+'">'+response.default+'</option>'); 
                        // }
                        if(response.cart){
                              for (var i = 0; response.payout.length > i; i++){
                                 if(response.payout.length - 1 == i){
                                   $("#chart2_options").append('<option selected value="'+response.payout[i].year+'">'+response.payout[i].year+'</option>'); 
                                 }else{
                                  $("#chart2_options").append('<option value="'+response.payout[i].year+'">'+response.payout[i].year+'</option>'); 
                                 }
                               }
                        }else{
                          $("#chart2_options").append('<option selected value="'+response.default+'">'+response.default+'</option>'); 
                        }
                      }else if(type == 'chart1_options' || type == 'chart2_options'){
                          if(option == 'DAY'){
                            if(response.default){
                              $("#"+type).append('<option selected value="'+response.default.year+'-'+response.default.month+'">'+response.default.year+'-'+response.default.monthname+'</option>'); 
                            }else{
                              for (var i = 0; response.length > i; i++){
                                 if(response.length - 1 == i){
                                   $("#"+type).append('<option selected value="'+response[i].year+'-'+response[i].month+'">'+response[i].year+'-'+response[i].monthname+'</option>'); 
                                 }else{
                                  $("#"+type).append('<option value="'+response[i].year+'-'+response[i].month+'">'+response[i].year+'-'+response[i].monthname+'</option>'); 
                                 }
                              }
                            }
                          }else{
                            if(response.default){
                              $("#"+type).append('<option selected value="'+response.default+'">'+response.default+'</option>'); 
                            }else{
                              for (var i = 0; response.length > i; i++){
                                 if(response.length - 1 == i){
                                   $("#"+type).append('<option selected value="'+response[i].year+'">'+response[i].year+'</option>'); 
                                 }else{
                                  $("#"+type).append('<option value="'+response[i].year+'">'+response[i].year+'</option>'); 
                                 }
                              }
                            }
                          }
                        }
                  }
              break;
              }
	  	case "Modal_Production_Stocks":{
	  		if(!response == false){
	  			_initNumberOnly('#stocks');
	  			$('input[name=id]').val(response.id);
	  			$('#items').val(response.item);
	  			$('#stocks').val(response.production_stocks);
	  		}
	  		break;
	  	}
		case "Modal_RawMaterial_view":{
  			if(!response == false){
	  			_initCurrency_format("#prices");
	  			$('input[name=id]').val(response.id);
	  			$('#item').val(response.item);
	  			if(!response.price || response.price == '0') {
					var tal = '';
				}else{
					var tal = moneyFormat(response.price);
				}
	  			$('.price').val(tal);
	  			$('select[name=status]').val(response.status).change();
	  		}
	  		break;
		 }
	  	case "Modal_Stocks_Rawmats_View":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			_initNumberOnly("#alert");
	  			$('input[name=id]').val(response.id);
	  			$('input[name=item]').val(response.item);
	  			$('input[name=stocks]').val(response.stocks);
	  			$('input[name=stocks_alert]').val(response.stocks_alert);
	  			$('select[name=status]').val(response.status).change();
	  		} 
	  		break;
	  	}
	  	case "Modal_Stocks_SpareParts_View":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			_initNumberOnly("#alert");
	  			$('input[name=id]').val(response.id);
	  			$('input[name=item]').val(response.item);
	  			$('input[name=stocks]').val(response.stocks);
	  			$('input[name=stocks_alert]').val(response.stocks_alert);
	  			$('select[name=status]').val(response.status).change();
	  		} 
	  		break;
	  	}
	  	case "Modal_Stocks_OfficeSupplies_View":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			_initNumberOnly("#alert");
	  			$('input[name=id]').val(response.id);
	  			$('input[name=item]').val(response.item);
	  			$('input[name=stocks]').val(response.stocks);
	  			$('input[name=stocks_alert]').val(response.stocks_alert);
	  			$('select[name=status]').val(response.status).change();
	  		} 
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
	  	case "Modal_Accounting_Purchase_Material_Stocks_Request":{
	  		if(!response == false){
	  			_initCurrency_format('#cash_request');
	  		     $('#joborder').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].fund_no);
	  		     $('#title').text('ITEM: '+response[0].title);
	  		     $('#c_name').text('('+response[0].c_name+')');
	  		     $('#requestor').text('REQUESTOR : '+response[0].requestor);
	  		     $('input[name="cash"]').focus();
	  		     $('#button_status').html('<div class="row"><div class="col-lg-7">'
	  		     				+'<input type="text" id="cash_request" name="cash_request" class="form-control form-control-solid border border-success" placeholder="Input Cash Fund"/></div>'
	  		     				+'<div class="col-lg-4"><button type="button" class="btn btn-success save_request">UPDATE</button></div></div>');
	               $('#status').text('TOTAL: P'+response[0].total);
	               $('#date_created').text('DATE: '+response[0].date_created);
	             	$('#tbl_purchase_request_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	             			$('#tbl_purchase_request_modal > tbody:last-child').append('<tr>'
						+'<td class="align-middle text-left">'+response[i].item+'</td>'
						+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
						+'<td class="align-middle text-right">'+response[i].amount+'</td>'
						+'</tr>');
				 }
	  		   }
	  		   break;
	  		}
	  		case "Modal_Accounting_Purchase_Material_Stocks_Approved":{
		  		if(!response == false){
		  		     $('#production_no_f').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].fund_no);
		  		     $('#title_f').text('ITEM: '+response[0].title+' ('+response[0].c_name+')');
		  		     $('#requestor_f').text('REQUESTOR : '+response[0].requestor);
		  		     $('#button_edits').html('<button type="button" class="btn btn-success edit'+response[0].fund_no+'">EDIT</button>');
		  		     if(!response[0].updatecash || response[0].updatecash == "0.00"){
		  		     	var cash = response[0].pettycash;
		  		     	var del = '';
		  		     }else{
		  		     	if(response[0].updatecash == response[0].pettycash){var del = '';}else{var del = response[0].pettycash;}
		  		     	 var cash = response[0].updatecash;
		  		     }
		  		     $('#del_cash').text(del);
		  		     $('#pettycash').text(cash);
		  		     $('input[name="previouscash"]').val(response[0].pettycash);
		  		     $(document).on('click','.close',function(e){
		  		     	   $('#button_edit').show();
		  		    		   $('#button_save').hide();
		  		     });
			  		$(document).on('click','.edit'+response[0].fund_no,function(e){
		  		     	if(!response[0].updatecash || response[0].updatecash == "0.00"){
		  		     	 _initCurrency_format('#cash_approved');
		  		     	   $('#button_edits').hide();
		  		     	   $('input[name="cash_approved"]').focus();
		  		    		   $('#button_saves').fadeIn();
			  		     }else{
			  		     	if(response[0].updatecash == response[0].pettycash){
			  		     	   $('#button_edits').hide();
			  		     	   $('input[name="cash_approved"]').focus();
			  		    		   $('#button_saves').fadeIn();
			  		     	}else{
			  		     	  Swal.fire("Warning!", "Cash fund is already changed!", "warning");
			  		     	}
			  		     }
		  		     });
		  		     $('#button_saves').hide();
		  		     $('#button_saves').html('<div class="row"><div class="col-lg-7">'
  		     				+'<input type="text" id="cash_approved" name="cash_approved" value="'+cash+'" class="form-control form-control-solid border border-success" placeholder="Input Cash Fund"/></div>'
  		     				+'<div class="col-lg-4"><button type="button" class="btn btn-success save_approved">UPDATE</button></div></div>');
		               $('#status_f').text('TOTAL: P'+response[0].total);
		               $('#date_created_f').text('DATE: '+response[0].date_created);
		             	$('#tbl_purchased_approved_modal > tbody:last-child').empty();
		             	for(var i=0;i<response.length;i++){
		             			$('#tbl_purchased_approved_modal > tbody:last-child').append('<tr>'
							+'<td class="align-middle">'+response[i].item+'</td>'
							+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
							+'<td class="align-middle text-right">'+response[i].amount+'</td>'
							+'</tr>');
					 }
		  		}
	  		 break;
	  		}
	  		case "Modal_Accounting_Purchase_Received_Stocks":{
		  		if(!response == false){
		  			$('input[name="fund_no"]').val(response[0].fund_no);
		  		     $('#production_no_c').text('JOB ORDER: '+response[0].production_no);
		  		     $('#title_c').text('ITEM: '+response[0].title);
		  		     $('#c_name_c').text('('+response[0].c_name+')');
		  		     $('#requestor_c').text('PURCHASER : '+response[0].requestor);
		  		     $('#button_save').hide();
		  		     $(document).on('click','.close',function(e){
		  		     	   $('#button_edit').show();
		  		    		   $('#button_save').hide();
		  		     });
		  		     if(!response[0].updatecash || response[0].updatecash == "0.00"){var cash = response[0].pettycash;var del = '';
		  		     }else{if(response[0].updatecash == response[0].pettycash){var del = '';}else{var del = response[0].pettycash;	}
		  		     var cash = response[0].updatecash;}
		  		     $('#del_cash').text(del);
		  		     $('#pettycash').text(cash);
		  		     $('#pettycash1').text(cash);
		  		     if(response[0].actual_change == "0.00"){var actual_change = 0;}else{var actual_change =response[0].actual_change;}
		  		     if(response[0].refund == "0.00"){var refund = 0;}else{var refund =response[0].refund;}
		  		    $('#button_edit').html('<button type="button" class="btn btn-success edit'+response[0].fund_no+'">EDIT</button>');
		  		     _initCurrency_format('#cash');
	  		     	_initCurrency_format('input[name="refund"]');
	  		     	 $(document).on('click','.edit'+response[0].fund_no,function(e){
			  		     	 $('#button_edit').hide();
			  		     	 $('input[name="cash"]').focus();
			  		    		 $('#button_save').fadeIn();
			  		    		 $('#change').show();
			  		    		 $('#change1').hide();
			  		    		 $('#refund').show();
			  		    		 $('#refund1').hide();
	  		   		  });
	  		    		$('#change1').html('<span>'+actual_change+'</span>'); 
	  		    		$('#change').hide(); 
		  		     $('#change').html('<input type="text" style="text-align:right;" id="cash" name="change" value="'+actual_change+'" class="form-control form-control-solid border border-success" placeholder="Input Actual Change"/>');
		  		     $('#refund1').html('<span>'+refund+'</span>'); 
	  		    		$('#refund').hide(); 
		  		     $('#refund').html('<input type="text" style="text-align:right;" id="refund" name="refund" value="'+refund+'" class="form-control form-control-solid border border-success" placeholder="Input Rund"/>');
		  		     $('#button_save').html('<button type="button" class="btn btn-success save_received">UPDATE</button>');
		  		     $('#save').on('keyup keypress', function(e) { var keyCode = e.keyCode || e.which; if (keyCode === 13) { e.preventDefault(); return false; } });
		               $('#total').text(response[0].total);
		               $('#total_payment').text(response[0].total);
		               $('#date_created_c').text('DATE: '+response[0].date_created);
		             	$('#tbl_purchased_received_modal > tbody:last-child').empty();
		             	for(var i=0;i<response.length;i++){
		             			$('#tbl_purchased_received_modal > tbody:last-child').append('<tr>'
							+'<td class="align-middle pl-0">'+response[i].item+'</td>'
							+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
							+'<td class="align-middle text-center">'+response[i].supplier+'</td>'
							+'<td class="align-middle text-center">'+response[i].type+'</td>'
							+'<td class="align-middle text-right">'+response[i].amount+'</td>'
							+'</tr>');
					 }
		  		}
	  		 break;
	  		}
	  		case "Modal_Accounting_Purchase_Material_Project_Request":{
	  			if(!response == false){
	  			_initCurrency_format('#cash_request');
	  			$('input[name="cash"]').focus();
	  		     $('#joborder').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].fund_no);
	  		     $('#title').text('ITEM: '+response[0].title);
	  		     $('#requestor').text('REQUESTOR : '+response[0].requestor);
	  		     $('#button_status').html('<div class="row"><div class="col-lg-7">'
	  		     				+'<input type="text" id="cash_request" name="cash_request" class="form-control form-control-solid border border-success" placeholder="Input Cash Fund"/></div>'
	  		     				+'<div class="col-lg-4"><button type="button" class="btn btn-success save_request">UPDATE</button></div></div>');
	               $('#status').text('TOTAL: P'+response[0].total);
	               $('#date_created').text('DATE: '+response[0].date_created);
	             	$('#tbl_purchase_request_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	             			$('#tbl_purchase_request_modal > tbody:last-child').append('<tr>'
						+'<td class="align-middle text-left">'+response[i].item+'</td>'
						+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
						+'<td class="align-middle text-right">'+response[i].amount+'</td>'
						+'</tr>');
				 }
	  		   }
	  		   break;
	  		}
	  		case "Modal_Accounting_Purchase_Material_Project_Approved":{
		  		if(!response == false){
		  		     $('#production_no_f').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].fund_no);
		  		     $('#title_f').text('ITEM: '+response[0].title);
		  		     $('#requestor_f').text('REQUESTOR : '+response[0].requestor);
		  		     $('#button_edits').html('<button type="button" class="btn btn-success edit'+response[0].fund_no+'">EDIT</button>');
		  		     if(!response[0].updatecash || response[0].updatecash == "0.00"){
		  		     	var cash = response[0].pettycash;
		  		     	var del = '';
		  		     }else{
		  		     	if(response[0].updatecash == response[0].pettycash){var del = '';}else{var del = response[0].pettycash;}
		  		     	 var cash = response[0].updatecash;
		  		     }
		  		     $('#del_cash').text(del);
		  		     $('#pettycash').text(cash);
		  		     $('input[name="previouscash"]').val(response[0].pettycash);
		  		     $(document).on('click','.close',function(e){
		  		     	   $('#button_edit').show();
		  		    		   $('#button_save').hide();
		  		     });
			  		$(document).on('click','.edit'+response[0].fund_no,function(e){
		  		     	if(!response[0].updatecash || response[0].updatecash == "0.00"){
		  		     	 _initCurrency_format('#cash_approved');
		  		     	   $('#button_edits').hide();
		  		     	   $('input[name="cash_approved"]').focus();
		  		    		   $('#button_saves').fadeIn();
			  		     }else{
			  		     	if(response[0].updatecash == response[0].pettycash){
			  		     	   $('#button_edits').hide();
			  		     	   $('input[name="cash_approved"]').focus();
			  		    		   $('#button_saves').fadeIn();
			  		     	}else{
			  		     	  Swal.fire("Warning!", "Cash fund is already changed!", "warning");
			  		     	}
			  		     }
		  		     });
		  		     $('#button_saves').hide();
		  		     $('#button_saves').html('<div class="row"><div class="col-lg-7">'
  		     				+'<input type="text" id="cash_approved" name="cash_approved" value="'+cash+'" class="form-control form-control-solid border border-success" placeholder="Input Cash Fund"/></div>'
  		     				+'<div class="col-lg-4"><button type="button" class="btn btn-success save_approved">UPDATE</button></div></div>');
		               $('#status_f').text('TOTAL: P'+response[0].total);
		               $('#date_created_f').text('DATE: '+response[0].date_created);
		             	$('#tbl_purchased_approved_modal > tbody:last-child').empty();
		             	for(var i=0;i<response.length;i++){
		             			$('#tbl_purchased_approved_modal > tbody:last-child').append('<tr>'
							+'<td class="align-middle">'+response[i].item+'</td>'
							+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
							+'<td class="align-middle text-right">'+response[i].amount+'</td>'
							+'</tr>');
					 }
		  		}
	  		 break;
	  		}
	  		case "Modal_Accounting_Purchase_Received_Project":{
		  		if(!response == false){
		  			$('input[name="fund_no"]').val(response[0].fund_no);
		  		     $('#production_no_c').text('JOB ORDER: '+response[0].production_no);
		  		     $('#title_c').text('ITEM: '+response[0].title);
		  		     $('#requestor_c').text('PURCHASER : '+response[0].requestor);
		  		     $('#button_save').hide();
		  		     $(document).on('click','.close',function(e){
		  		     	   $('#button_edit').show();
		  		    		   $('#button_save').hide();
		  		     });
		  		     if(!response[0].updatecash || response[0].updatecash == "0.00"){var cash = response[0].pettycash;var del = '';
		  		     }else{if(response[0].updatecash == response[0].pettycash){var del = '';}else{var del = response[0].pettycash;	}
		  		     var cash = response[0].updatecash;}
		  		     $('#del_cash').text(del);
		  		     $('#pettycash').text(cash);
		  		     $('#pettycash1').text(cash);
		  		     if(response[0].actual_change == "0.00"){var actual_change = 0;}else{var actual_change =response[0].actual_change;}
		  		     if(response[0].refund == "0.00"){var refund = 0;}else{var refund =response[0].refund;}
		  		    $('#button_edit').html('<button type="button" class="btn btn-success edit'+response[0].fund_no+'">EDIT</button>');
		  		     _initCurrency_format('#cash');
	  		     	_initCurrency_format('input[name="refund"]');
	  		     	 $(document).on('click','.edit'+response[0].fund_no,function(e){
			  		     	 $('#button_edit').hide();
			  		     	 $('input[name="cash"]').focus();
			  		    		 $('#button_save').fadeIn();
			  		    		 $('#change').show();
			  		    		 $('#change1').hide();
			  		    		 $('#refund').show();
			  		    		 $('#refund1').hide();
	  		   		  });
	  		    		$('#change1').html('<span>'+actual_change+'</span>'); 
	  		    		$('#change').hide(); 
		  		     $('#change').html('<input type="text" style="text-align:right;" id="cash" name="change" value="'+actual_change+'" class="form-control form-control-solid border border-success" placeholder="Input Actual Change"/>');

		  		     $('#refund1').html('<span>'+refund+'</span>'); 
	  		    		$('#refund').hide(); 
		  		     $('#refund').html('<input type="text" style="text-align:right;" id="refund" name="refund" value="'+refund+'" class="form-control form-control-solid border border-success" placeholder="Input Rund"/>');
		  		     $('#button_save').html('<button type="button" class="btn btn-success save_received">UPDATE</button>');
		  		     $('#save').on('keyup keypress', function(e) { var keyCode = e.keyCode || e.which; if (keyCode === 13) { e.preventDefault(); return false; } });
		               $('#total').text(response[0].total);
		               $('#total_payment').text(response[0].total);
		               $('#date_created_c').text('DATE: '+response[0].date_created);
		             	$('#tbl_purchased_received_modal > tbody:last-child').empty();
		             	for(var i=0;i<response.length;i++){
		             			$('#tbl_purchased_received_modal > tbody:last-child').append('<tr>'
							+'<td class="align-middle pl-0">'+response[i].item+'</td>'
							+'<td class="align-middle text-center">'+response[i].quantity+' '+response[i].unit+'</td>'
							+'<td class="align-middle text-center">'+response[i].supplier+'</td>'
							+'<td class="align-middle text-center">'+response[i].type+'</td>'
							+'<td class="align-middle text-right">'+response[i].amount+'</td>'
							+'</tr>');
					 }
		  		}
	  		 break;
	  		}
	  		case "Account_Report_Collection_Daily":{
	  			$('#total_amount').text(response.data[0].total_amount);
	  			$('#total_vat').text(response.data[0].total_vat);
	  			$('#total_gross').text(response.data[0].total_gross);
	  			$('#tbl_collection_daily > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_collection_daily > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.data[i].customer+'</span><span class="text-muted font-weight-bold" id="bank">'+response.data[i].bank+'</span></td>'
		             				+'<td class="pl-0">'+response.data[i].si_no+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Collection_Weekly":{
	  			$('#total_amount').text(response.data[0].total_amount);
  				$('#total_vat').text(response.data[0].total_vat);
  				$('#total_gross').text(response.data[0].total_gross);
	  			$('#tbl_collection_weekly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_collection_weekly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Collection_Monthly":{
	  			$('#total_amount').text(response.data[0].total_amount);
  				$('#total_vat').text(response.data[0].total_vat);
  				$('#total_gross').text(response.data[0].total_gross);
	  			$('#tbl_collection_monthly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_collection_monthly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Collection_Yearly":{
	  			$('#tbl_collection_yearly > tbody:last-child').empty();
  					$('#total_amount').text(response.data[0].total_amount);
	  				$('#total_vat').text(response.data[0].total_vat);
	  				$('#total_gross').text(response.data[0].total_gross);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_collection_yearly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Daily":{
	  			$('#tbl_salesorder_daily > tbody:last-child').empty();
	  				$('#total_grand').text(response.data[0].total_amount);
	  				$('#total_vats').text(response.data[0].total_vat);
	  				$('#total_subtotal').text(response.data[0].total_subtotal);
	  				$('#total_shippingfee').text(response.data[0].total_shippingfee);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_salesorder_daily > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.data[i].customer+'</span></td>'
		             				+'<td class="pl-0">'+response.data[i].si_no+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].subtotal+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].shipping_fee+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Weekly":{
	  			$('#total_grand').text(response.data[0].total_amount);
  				$('#total_vats').text(response.data[0].total_vat);
  				$('#total_subtotal').text(response.data[0].total_subtotal);
  				$('#total_shippingfee').text(response.data[0].total_shippingfee);
	  			$('#tbl_salesorder_weekly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_salesorder_weekly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].subtotal+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].shipping_fee+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Monthly":{
	  			$('#total_grand').text(response.data[0].total_amount);
  				$('#total_vats').text(response.data[0].total_vat);
  				$('#total_subtotal').text(response.data[0].total_subtotal);
  				$('#total_shippingfee').text(response.data[0].total_shippingfee);
	  			$('#tbl_salesorder_monthly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_salesorder_monthly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].subtotal+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].shipping_fee+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Yearly":{
	  			$('#tbl_salesorder_yearly > tbody:last-child').empty();
	  				$('#total_grand').text(response.data[0].total_amount);
	  				$('#total_vats').text(response.data[0].total_vat);
	  				$('#total_subtotal').text(response.data[0].total_subtotal);
	  				$('#total_shippingfee').text(response.data[0].total_shippingfee);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_salesorder_yearly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].subtotal+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].shipping_fee+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Daily":{
	  				$('#tbl_cashfund_daily > tbody:last-child').empty();
	  				$('#total_pettycash').text(response.data[0].total_pettycash);
	  				$('#total_change').text(response.data[0].total_change);
	  				$('#total_refund').text(response.data[0].total_refund);
	  				$('#total_vat').text(response.data[0].total_vat);
	  				$('#total_gross').text(response.data[0].total_gross);
	  				$('#total_amount').text(response.data[0].total_amount);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_daily > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.data[i].production_no+'</span></td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].pettycash+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].change+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].refund+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Weekly":{
	  				$('#tbl_cashfund_weekly > tbody:last-child').empty();
	  				$('#total_pettycash').text(response.data[0].total_pettycash);
	  				$('#total_change').text(response.data[0].total_change);
	  				$('#total_refund').text(response.data[0].total_refund);
	  				$('#total_vat').text(response.data[0].total_vat);
	  				$('#total_gross').text(response.data[0].total_gross);
	  				$('#total_amount').text(response.data[0].total_amount);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_weekly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].pettycash+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].change+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].refund+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Monthly":{
	  				$('#tbl_cashfund_monthly > tbody:last-child').empty();
	  				$('#total_pettycash').text(response.data[0].total_pettycash);
	  				$('#total_change').text(response.data[0].total_change);
	  				$('#total_refund').text(response.data[0].total_refund);
	  				$('#total_vat').text(response.data[0].total_vat);
	  				$('#total_gross').text(response.data[0].total_gross);
	  				$('#total_amount').text(response.data[0].total_amount);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_monthly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].pettycash+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].change+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].refund+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Yearly":{
	  				$('#tbl_cashfund_yearly > tbody:last-child').empty();
	  				$('#total_pettycash').text(response.data[0].total_pettycash);
	  				$('#total_change').text(response.data[0].total_change);
	  				$('#total_refund').text(response.data[0].total_refund);
	  				$('#total_vat').text(response.data[0].total_vat);
	  				$('#total_gross').text(response.data[0].total_gross);
	  				$('#total_amount').text(response.data[0].total_amount);
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_yearly > tbody:last-child').append('<tr>'
		             				+'<td class="pl-0 font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].pettycash+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].change+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].refund+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].vat+'</span></td>'
		             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.data[i].amount+'</span></td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "other_expenses_categories":{
	  			if(!response==false){
	  				$('select[name="cat_id"]').empty().append('<option value="">SELECT OPTION</option>');
	  				for(var i=0;i<response.length;i++){
	  					$('select[name="cat_id"]').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
	  				}
	  			}
	  			break;
	  		}
	  		case "income_statement_categories":{
	  			if(!response==false){
	  				$('select[name="income_id"]').empty().append('<option value="">SELECT OPTION</option>');
	  				for(var i=0;i<response.length;i++){
	  					$('select[name="income_id"]').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
	  				}
	  			}
	  			break;
	  		}
	  		case "Account_Report_Production_Supplies":{
	  			$('.text-name').val(response.project.customer);
	  			$('.text-address').val(response.project.address);
	  			$('.text-amount').val(response.amount);
	  			$('.text-labor').val(response.labor);
	  			$('.text-start').val(response.start);
	  			$('.text-due').val(response.due);
	  			$('.btn-edit').removeAttr('disabled');
	  			$('.btn-search').attr('data-id',response.project.id);
	  			$(document).on('click','.btn-edit',function(e){
	  				e.preventDefault();
	  				let element = $(this);
	  				let action = element.attr('data-action');
	  				$('#'+action).removeClass('far fa-edit').addClass('flaticon2-check-mark');
	  				if(action == 'edit-name'){
	  					element.attr('data-action','save-name').addClass('save');
					 	$('.text-name').removeAttr('disabled');
				 	}else if(action == 'edit-address'){
				 		element.attr('data-action','save-address').addClass('save');
				 		$('.text-address').removeAttr('disabled');
				 	}else if(action == 'edit-amount'){
				 		element.attr('data-action','save-amount').addClass('save');
				 		$('.text-amount').removeAttr('disabled');
				 	}else if(action == 'edit-labor'){
				 		element.attr('data-action','save-labor').addClass('save');
				 		$('.text-labor').removeAttr('disabled');
				 	}else if(action == 'edit-date'){
				 		element.attr('data-action','save-date').addClass('save');
				 		$('.text-start').removeAttr('disabled');
				 		$('.text-due').removeAttr('disabled');
				 	}
	  			});
	  			if(!response.framing == false){
		  			for(var i=0;i<response.framing.length;i++){
		             			$('#tbl_framing > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.framing[i].item+'</td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75 d-block">'+response.framing[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_framing > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" rows="4" class="text-center">NO DATA</td>\
							</tr>');
				}
				if(!response.mechanism == false){
		  			for(var i=0;i<response.mechanism.length;i++){
		             			$('#tbl_mechanism > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.mechanism[i].item+'</td>'
		             				+'<td class="text-right"><span  class="text-dark-75   d-block">'+response.mechanism[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.mechanism[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_mechanism > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" class="text-center">NO DATA</td>\
							</tr>');
				}
				if(!response.finishing == false){
		  			for(var i=0;i<response.finishing.length;i++){
		             			$('#tbl_finishing > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.finishing[i].item+'</td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.finishing[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_finishing > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" class="text-center">NO DATA</td>\
							</tr>');
				}
				if(!response.sulihiya == false){
		  			for(var i=0;i<response.sulihiya.length;i++){
		             			$('#tbl_sulihiya > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.sulihiya[i].item+'</td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.sulihiya[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_sulihiya > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" class="text-center">NO DATA</td>\
							</tr>');
				}
				if(!response.upholstery == false){
		  			for(var i=0;i<response.upholstery.length;i++){
		             			$('#tbl_upholstery > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.upholstery[i].item+'</td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75   d-block">'+response.upholstery[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_upholstery > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" class="text-center">NO DATA</td>\
							</tr>');
				}
				if(!response.others == false){
		  			for(var i=0;i<response.others.length;i++){
		             			$('#tbl_others > tbody:last-child').empty().append('<tr>'
		             				+'<td class="text-success">'+response.others[i].item+'</td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].qty+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].production_quantity+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].unit+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].cost+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].amount_costing+'</span></td>'
		             				+'<td class="text-right"><span class="text-dark-75  d-block">'+response.others[i].amount_actual+'</span></td>'
							+'</tr>');
					}
				}else{
					$('#tbl_others > tbody:last-child').empty().append('<tr>\
		             				<td colspan="8" rows="4"  class="text-center">NO DATA</td>\
							</tr>');
				}
	  			break;
	  		}
	  		case "Modal_Accounting_Income_Statement":{
	  			$('.save_income').attr('data-action','update');
	  			$('.save_income').attr('data-status','income');
	  			$('.save_income').attr('data-id',response[0].id);
  				$('select[name=income_id]').val(response[0].income_id).change();
  				$('input[name=amount]').val(response[0].amount);
  				$('input[name=date_income]').val(response[0].date_income);
  				$('#description').val(response[0].description);
	  			break;
	  		}
	  		case "Modal_Accounting_Category_Income":{
	  			$('#category-list').modal('hide');
	  			$('.save_cat').attr('data-action','update');
	  			$('.save_cat').attr('data-status','category');
	  			$('.save_cat').attr('data-id',response[0].id);
	  			$('input[name=name]').val(response[0].name);
	  			break;
	  		}
	  		case "Modal_Accounting_Category_Income_List":{
	  			if(!response == false){
	  				$('#tbl_cat_income > tbody:last-child').empty();
	  				for(var i=0;i<response.length;i++){
	  					let no = i+1;
	             			$('#tbl_cat_income > tbody:last-child').append('<tr id="row_'+response[i].count+'">\
	             				<td>'+no+'</td>\
	             				<td width="200">'+response[i].name+'</td>\
	             				<td><button data-toggle="modal" id="form-category" data-action="update" data-target="#category" class="btn btn-icon btn-dark" data-id="'+response[i].id+'"><i class="flaticon2-edit"></i></button</td>\
						   </tr>');
					}
	  			}
	  			break;
	  		}
	  		case "Account_Report_Income_Daily":{
				$('#tbl_income_daily').empty().append(response.html).promise().done(function(){
					  $('table td').on('blur', function(e){
					  	e.preventDefault();
					  	let income_id = $(this).attr('data-sub');
					  	let id = $(this).attr('data-id');
					  	let amount = $(this).text();
					  	let count = $(this).attr('data-count');
					  	let count_tr = $(this).attr('data-tr');
					  	let date = $(this).attr('data-date');
					  	if(amount == '-' || amount == "0.00" || amount == "0" || amount == " "){
					  		$('#tbl_income_daily > table > tbody > tr:nth-child('+count_tr+') > td:nth-child('+count+')').text("-");
					  	}else{
					  		let val = {id:id,income_id:income_id,count:count,count_tr:count_tr,amount:amount,date_income:date,status:'update_amount'};
							_ajaxloaderOption('update_controller/Update_Income_Statement','POST',val,'Update_Income_Statement');
					  	}
					  });
				
				 });
		  		break;
	  		}
	  		
	  		
	  	case "Account_Report_Cashposition_Weekly":{
	  		  let html = "";
	  		  html +='<table class="table table-hover font-size-lg">\
			  			<thead>\
	  		  				<tr>\
	  		  					<th colspan="6" class="text-center font-size-lg"><h2>'+response.month+'-'+response.year+'</h2></th>\
	  		  				</tr>\
	  		  			</thead>\
  		  			<tbody>';
	  		if(response){
	  		  if(response.week1_type2 || response.week1_type1){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="6" class="text-center">'+response.month+' - 1st Week</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.beginning+'</td>\
	  		    			<td></td>\
	  		    			<td></td>\
	  		    		 </tr>';	
	  			if(response.week1_type2){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.week1_type2.length;i++){
	  		    	  	let count = response.week1_type2[i].count;
	  		    		let cat_id = response.week1_type2[i].cat_id;
	  		    		let status = response.week1_type2[i].type;
	  		    		html +='<tr data-id="'+response.week1_type2[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.week1_type2[i].date+'"><div id="input-dateposition">'+response.week1_type2[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week1_type2[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week1_type2[i].amount+'</td>\
			  		    		  <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week1_type2[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week1_type2[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week1_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week1_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	    html +='<tr>\
	  		    			<td colspan="6"></td>\
	  		    		 </tr>'; 
	  		    }
	  		   
	  		    if(response.week1_type1){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.week1_type1.length;i++){
	  		    	  	let count = response.week1_type1[i].count;
	  		    		let cat_id = response.week1_type1[i].cat_id;
	  		    		let status = response.week1_type1[i].type;
	  		    		html +='<tr data-id="'+response.week1_type1[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.week1_type1[i].date+'"><div id="input-dateposition">'+response.week1_type1[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week1_type1[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week1_type1[i].amount+'</td>\
			  		    		<td width="160">\
				  		    		   <select class="form-control form-control-sm cat select-category"data-count="'+count+'" name="cat_id_update" data-id="'+response.week1_type1[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm type select-type" data-count="'+count+'" name="type" data-id="'+response.week1_type1[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week1_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
		  		    	   html +='<tr class="bg-warning text-white">\
		  		    	   			<td></td>\
		  		    	   			<td>TOTAL</td>\
		  		    	   			<td>'+response.week1_less+'</td>\
		  		    	   			<td></td>\
		  		    	   			<td></td>\
		  		    	   			<td></td>\
		  		    	   		</tr>';
	  		   	 }
		  		    html +='<tr class="bg-dark text-white">\
			  		    			<td></td>\
			  		    			<td>BALANCED</td>\
			  		    			<td></td>\
			  		    			<td>'+response.balanced1+'</td>\
			  		    			<td></td>\
			  		    			<td></td>\
			  		    		 </tr>';	
		  		    html +='<tr>\
		  		    			<td colspan="6"></td>\
		  		    		 </tr>';
	  			}
	  		    if(response.week2_type2 || response.week2_type1){
	  		    html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="6" class="text-center">'+response.month+' - 2nd Week</td>\
	  			 	    </tr>';	
	  		    	html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BEGINNING BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced1+'</td>\
		  		    			<td></td>\
		  		    			<td></td>\
		  		    		 </tr>';	  	 
		  	    if(response.week2_type2){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week2_type2.length;i++){
	  		    	  	let count = response.week2_type2[i].count;
	  		    		let cat_id = response.week2_type2[i].cat_id;
	  		    		let status = response.week2_type2[i].type;
	  		    		html +='<tr data-id="'+response.week2_type2[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.week2_type2[i].date+'"><div id="input-dateposition">'+response.week2_type2[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week2_type2[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week2_type2[i].amount+'</td>\
			  		    		   <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week2_type2[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" name="type" data-count="'+count+'" data-id="'+response.week2_type2[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week2_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week2_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 	 html +='<tr>\
	  		    			<td colspan="6"></td>\
	  		    		 </tr>'; 
	  		    if(response.week2_type1){
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week2_type1.length;i++){
	  		    	  	let count = response.week2_type1[i].count;
	  		    		let cat_id = response.week2_type1[i].cat_id;
	  		    		let status = response.week2_type1[i].type;
	  		    		html +='<tr data-id="'+response.week2_type1[i].id+'">\
			  		    		   <td id="td-input" data-action="date_position" data-date="'+response.week2_type1[i].date+'"><div id="input-dateposition">'+response.week2_type1[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week2_type1[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week2_type1[i].amount+'</td>\
			  		    		   <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week2_type1[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week2_type1[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week2_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week2_less+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced2+'</td>\
		  		    			<td></td>\
		  		    			<td></td>\
		  		    		 </tr>';	

	  		    html +='<tr>\
	  		    			<td colspan="6"></td>\
	  		    		 </tr>';  
	  		    }
	  		    if(response.week3_type2 || response.week3_type1){
	  		    html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="6" class="text-center">'+response.month+' - 3rd Week</td>\
	  			 	    </tr>';
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BEGINNING BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced2+'</td>\
		  		    			<td></td>\
		  		    			<td></td>\
		  		    		 </tr>';	
	  		        if(response.week3_type2){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week3_type2.length;i++){
	  		    	  	let count = response.week3_type2[i].count;
	  		    		let cat_id = response.week3_type2[i].cat_id;
	  		    		let status = response.week3_type2[i].type;
	  		    		html +='<tr data-id="'+response.week3_type2[i].id+'">\
	  		    				  <td id="td-input" data-action="date_position" data-date="'+response.week3_type2[i].date+'"><div id="input-dateposition">'+response.week3_type2[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week3_type2[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week3_type2[i].amount+'</td>\
			  		    		   <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week3_type2[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week3_type2[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week3_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week3_type1){
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week3_type1.length;i++){
	  		    	  	let count = response.week3_type1[i].count;
	  		    		let cat_id = response.week3_type1[i].cat_id;
	  		    		let status = response.week3_type1[i].type;
	  		    		html +='<tr data-id="'+response.week3_type1[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.week3_type1[i].date+'"><div id="input-dateposition">'+response.week3_type1[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week3_type1[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week3_type1[i].amount+'</td>\
			  		    		  <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week3_type1[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week3_type1[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week3_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_less+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	    html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced3+'</td>\
		  		    			<td></td>\
		  		    			<td></td>\
		  		    		 </tr>';		
		  		     html +='<tr>\
		  		    			<td colspan="6"></td>\
		  		    		 </tr>';  
	  		    }
	  		    if(response.week4_type2 || response.week4_type1){		 
	  		   	 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="6" class="text-center">'+response.month+' - 4th Week</td>\
	  			 	    </tr>';
  		    	  	 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.balanced3+'</td>\
	  		    			<td></td>\
	  		    			<td></td>\
	  		    		 </tr>';	
	  		        if(response.week4_type2){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week4_type2.length;i++){
	  		    	  	let count = response.week4_type2[i].count;
	  		    		let cat_id = response.week4_type2[i].cat_id;
	  		    		let status = response.week4_type2[i].type;
	  		    		html +='<tr data-id="'+response.week4_type2[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.week4_type2[i].date+'"><div id="input-dateposition">'+response.week4_type2[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week4_type2[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week4_type2[i].amount+'</td>\
			  		    		<td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week4_type2[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week4_type2[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week4_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week4_type1){
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  	<td></td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week4_type1.length;i++){
	  		    	  	let count = response.week4_type1[i].count;
	  		    		let cat_id = response.week4_type1[i].cat_id;
	  		    		let status = response.week4_type1[i].type;
	  		    		html +='<tr data-id="'+response.week4_type1[i].id+'">\
			  		    		   <td id="td-input" data-action="date_position" data-date="'+response.week4_type1[i].date+'"><div id="input-dateposition">'+response.week4_type1[i].date_position+'</div>\
	  		    				   <div class="form-group" style="display:none">\
							    <div class="input-group">\
							     <input type="text" class="form-control datepicker-input" style="width:50px" readonly/>\
							     <div class="input-group-append">\
							      <button class="btn btn-success btn-xs btn-save" type="button"><i class="flaticon2-check-mark icon-sm"></i></button>\
							     </div>\
							     <div class="input-group-append">\
							      <button class="btn btn-danger btn-xs btn-cancelled" type="button"><i class="flaticon2-cross icon-sm"></i></button>\
							     </div>\
							    </div>\
							   </div></td>\
			  		    		   <td id="td-input" data-action="name">'+response.week4_type1[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.week4_type1[i].amount+'</td>\
			  		    		  <td width="160">\
				  		    		   <select class="form-control form-control-sm select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week4_type1[i].id+'">\
				  		    		   		<option value="1">Sales</option>\
									    	<option value="2">La Maison Fund</option>\
									    	<option value="3">Company Events</option>\
									    	<option value="4">Raw Materials</option>\
									    	<option value="5">Outsource</option>\
									    	<option value="6">Fixtures</option>\
									    	<option value="7">Direct Labor</option>\
									    	<option value="8">La Maison Payment</option>\
									    	<option value="9">Withdrawals</option>\
									    	<option value="10">Indirect Labor</option>\
									    	<option value="11">Utilities Expense</option>\
									    	<option value="12">Inventory</option>\
									    	<option value="13">Selling Expense</option>\
									    	<option value="14">Office Supplies</option>\
									    	<option value="15">Beginning Balanced</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td width="100">\
				  		    		   <select class="form-control form-control-sm select-type" data-count="'+count+'" name="type" data-id="'+response.week4_type1[i].id+'">\
				  		    		   	  <option value="1">Credit</option>\
				  		    		   	  <option value="2">Debit</option>\
				  		    		   </select>\
			  		    		   </td>\
			  		    		   <td>\
			  		    		   <button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week4_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
			  		    		$(document).ready( function(){
						          $('select.select-category[data-count='+count+'] option[value='+cat_id+']').attr('selected', 'selected');
						          $('select.select-type[data-count='+count+'] option[value='+status+']').attr('selected', 'selected');
						      }); 
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_less+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced4+'</td>\
		  		    			<td></td>\
		  		    			<td></td>\
		  		    		 </tr>';	
	  		  }
	  		}else{
	  			html+='<td colspan="4">NO DATA AVAILABLE</td>';
	  		}
	  		html +="</tbody></table>";
	  		$('#tbl_cashposition_weekly').empty();
	  		$('#tbl_cashposition_weekly').append(html);
	  		break;
	  	   }
	  	   case "Account_Report_Cashposition_Monthly":{
	  	   	let html = "";
	  	   	html +='<table class="table table-hover font-size-lg">\
	  	   		     <thead>\
	  	   		     	<tr><th colspan="4" class="text-center font-size-lg"><h2>'+response.year+'</h2></th></tr>\
	  	   		     </thead><tbody>';
	  	   	if(response.jan_add || response.jan_less){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">JANUARY</td>\
	  			 	    </tr>';
	  			 html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BEGINNING BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.beginning+'</td>\
		  		    		 </tr>';	
	  			if(response.jan_add){
		  			  html +='<tr class="bg-success text-white">\
				  			  	<td>Date</td>\
				  			  	<td>Add: Collection</td>\
				  			  	<td>Amount</td>\
				  			  	<td></td>\
			  			     </tr>';	
	  		    	  for (var i =0;i<response.jan_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.jan_add[i].date_position+'</td>\
			  		    		   <td>'+response.jan_add[i].name+'</td>\
			  		    		   <td>'+response.jan_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td></td>\
	  		    	   			<td>'+response.jan_add_total+'</td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.jan_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.jan_less.length;i++){
	  		    		html +='<tr>\
			  		    		   <td>'+response.jan_less[i].date_position+'</td>\
			  		    		   <td>'+response.jan_less[i].name+'</td>\
			  		    		   <td>'+response.jan_less[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.jan_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.jan_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		   if(response.feb_add || response.feb_less){
	  		   	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">FEBRUARY</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.jan_balanced+'</td>\
	  		    		 </tr>';	
	  			if(response.feb_add){
		  			  html +='<tr class="bg-success text-white">\
				  			  	<td>Date</td>\
				  			  	<td>Add: Collection</td>\
				  			  	<td>Amount</td>\
				  			  	<td></td>\
			  			     </tr>';	
	  		    	  for (var i =0;i<response.feb_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.feb_add[i].date_position+'</td>\
			  		    		   <td>'+response.feb_add[i].name+'</td>\
			  		    		   <td>'+response.feb_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.feb_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.feb_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.feb_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.feb_less[i].date_position+'</td>\
			  		    		  <td>'+response.feb_less[i].name+'</td>\
			  		    		  <td>'+response.feb_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    	   </tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.feb_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.feb_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		  if(response.march_add || response.march_less){
	  		  	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">MARCH</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.feb_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.march_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.march_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.march_add[i].date_position+'</td>\
			  		    		   <td>'+response.march_add[i].name+'</td>\
			  		    		   <td >'+response.march_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.march_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.march_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.march_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.march_less[i].date_position+'</td>\
			  		    		  <td>'+response.march_less[i].name+'</td>\
			  		    		  <td>'+response.march_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.march_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.march_balanced+'</td>\
		  		    		 </tr>';	
		  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		}
	  		if(response.april_add || response.april_less){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">APRIL</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.march_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.april_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.april_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.april_add[i].date_position+'</td>\
			  		    		   <td>'+response.april_add[i].name+'</td>\
			  		    		   <td>'+response.april_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.april_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.april_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.april_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.april_less[i].date_position+'</td>\
			  		    		  <td>'+response.april_less[i].name+'</td>\
			  		    		  <td>'+response.april_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.april_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.april_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		   if(response.may_add || response.may_add){
	  		   	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">MAY</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.april_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.may_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.may_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.may_add[i].date_position+'</td>\
			  		    		   <td>'+response.may_add[i].name+'</td>\
			  		    		   <td>'+response.may_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.may_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.may_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.may_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.may_less[i].date_position+'</td>\
			  		    		  <td>'+response.may_less[i].name+'</td>\
			  		    		  <td>'+response.may_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.may_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.may_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		   if(response.june_add || response.june_less){
	  		   	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">JUNE</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.may_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.june_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.june_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.june_add[i].date_position+'</td>\
			  		    		   <td>'+response.june_add[i].name+'</td>\
			  		    		   <td>'+response.june_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.june_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.june_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.june_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.june_less[i].date_position+'</td>\
			  		    		  <td>'+response.june_less[i].name+'</td>\
			  		    		  <td>'+response.june_less[i].amount+'</td>\
			  		    		  <td>></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.june_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.june_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		     if(response.july_add || response.july_less){
	  		      html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">JULY</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.june_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.july_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.july_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.july_add[i].date_position+'</td>\
			  		    		   <td>'+response.july_add[i].name+'</td>\
			  		    		   <td>'+response.july_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.july_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.july_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.july_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.july_less[i].date_position+'</td>\
			  		    		  <td>'+response.july_less[i].name+'</td>\
			  		    		  <td>'+response.july_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.july_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.july_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		   if(response.august_add || response.august_less){
	  		   	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">AUGUST</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.july_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.august_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.august_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.august_add[i].date_position+'</td>\
			  		    		   <td>'+response.august_add[i].name+'</td>\
			  		    		   <td>'+response.august_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.august_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.august_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.august_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.august_less[i].date_position+'</td>\
			  		    		  <td>'+response.august_less[i].name+'</td>\
			  		    		  <td>'+response.august_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.august_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.august_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		    if(response.sept_add || response.sept_less){
	  		    	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">SEPTEMBER</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.august_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.sept_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.sept_add.length;i++){
	  		    		html +='<tr>\
  		    				   <td>'+response.sept_add[i].date_position+'</td>\
		  		    		   <td>'+response.sept_add[i].name+'</td>\
		  		    		   <td>'+response.sept_add[i].amount+'</td>\
		  		    		   <td></td>\
		  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.sept_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.sept_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.sept_less.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.sept_less[i].date_position+'</td>\
			  		    		  <td>'+response.sept_less[i].name+'</td>\
			  		    		  <td>'+response.sept_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.sept_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.sept_balanced+'</td>\
		  		    		 </tr>';	
		  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		   }
	  		    if(response.oct_add || response.oct_less){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">OCTOBER</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.oc_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.oct_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.oct_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.oct_add[i].date_position+'</td>\
			  		    		   <td>'+response.oct_add[i].name+'</td>\
			  		    		   <td>'+response.oct_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.oct_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.oct_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.oct_less.length;i++){
	  		    		html +='<tr data-id="'+response.oct_less[i].id+'">\
			  		    		  <td>'+response.oct_less[i].date_position+'</td>\
			  		    		  <td>'+response.oct_less[i].name+'</td>\
			  		    		  <td>'+response.oct_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.oct_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.oct_balanced+'</td>\
		  		    		 </tr>';	
	  		   }

	  		   if(response.nov_add || response.nov_less){
	  		   	 html +='<tr>\
	  		    			<td colspan="3"></td>\
	  		    		 </tr>'; 
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">NOVEMBER</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.oct_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.nov_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.nov_add.length;i++){
	  		    		html +='<tr data-id="'+response.nov_add[i].id+'">\
	  		    				   <td>'+response.nov_add[i].date_position+'</td>\
			  		    		   <td>'+response.nov_add[i].name+'</td>\
			  		    		   <td>'+response.nov_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.nov_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.nov_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.nov_less.length;i++){
	  		    		html +='<tr data-id="'+response.nov_less[i].id+'">\
			  		    		  <td>'+response.nov_less[i].date_position+'</td>\
			  		    		  <td>'+response.nov_less[i].name+'</td>\
			  		    		  <td>'+response.nov_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.nov_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.nov_balanced+'</td>\
		  		    		 </tr>';	
		  		   html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		   }

	  		   if(response.dec_add || response.dec_less){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">DECEMBER</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.nov_balanced+'</td>\
		  		    		 </tr>';	
	  			if(response.dec_add){
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.dec_add.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.dec_add[i].date_position+'</td>\
			  		    		   <td>'+response.dec_add[i].name+'</td>\
			  		    		   <td>'+response.dec_add[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.dec_add_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.dec_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.dec_less.length;i++){
	  		    		html +='<tr data-id="'+response.dec_less[i].id+'">\
			  		    		  <td>'+response.dec_less[i].date_position+'</td>\
			  		    		  <td>'+response.dec_less[i].name+'</td>\
			  		    		  <td>'+response.dec_less[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.dec_less_total+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	  }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.dec_balanced+'</td>\
		  		    		 </tr>';	
	  		   }
	  	  	 	html +='</tbody></table>';
	  	   	$('#tbl_cashposition_monthly').empty();
	  		$('#tbl_cashposition_monthly').append(html);
	  	   	break;
	  	}
	  	case "Account_Report_Income_Monthly":{
	  			if(!response == false){
	  			let html = '';
	  			    html +='<table class="table table-striped table-sm"><thead><tr class="text-white bg-dark">';
	  			    html +='<th></th>\
	  			    		 <th>JANUARY</th>\
	  			    		 <th>FEBRUARY</th>\
	  			    		 <th>MARCH</th>\
	  			    		 <th>APRIL</th>\
	  			    		 <th>MAY</th>\
	  			    		 <th>JUNE</th>\
	  			    		 <th>JULY</th>\
	  			    		 <th>AUGUST</th>\
	  			    		 <th>SEPTEMBER</th>\
	  			    		 <th>OCTOBER</th>\
	  			    		 <th>NOVEMBER</th>\
	  			    		 <th>DECEMBER</th>\
	  			    		 <th>TOTAL</th>\
	  			    		 ';
	  			    html +='</tr></thead>';
	  			    html +='<tbody>';
	  			    html +='<tr class="bg-success text-white">\
	  			    			 <td>SALES</td>\
		             			 <td id="td-input" data-date="'+response.year+'-01-01">'+response.sales.jan+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-02-01">'+response.sales.feb+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-03-01">'+response.sales.march+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-04-01">'+response.sales.apr+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-05-01">'+response.sales.may+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-06-01">'+response.sales.june+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-07-01">'+response.sales.july+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-08-01">'+response.sales.aug+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-09-01">'+response.sales.sept+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-10-01">'+response.sales.oct+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-11-01">'+response.sales.nov+'</td>\
		             			 <td id="td-input" data-date="'+response.year+'-12-01">'+response.sales.dec+'</td>\
		             			 <td>'+response.sales.year+'</td>\
	  			    		 </tr>';
	  			    	html +='<tr><td colspan="15" class="text-center">-</td></tr>';
	  			    	html +='<tr class="bg-warning"><td colspan="15" class="text-left">EXPENSES</td></tr>';
			  		for(var i=0;i<response.expenses.length;i++){
	             			html +='<tr>\
		             			 <td>'+response.expenses[i].name+'</td>\
		             			 <td>'+response.expenses[i].jan+'</td>\
		             			 <td>'+response.expenses[i].feb+'</td>\
		             			 <td>'+response.expenses[i].march+'</td>\
		             			 <td>'+response.expenses[i].apr+'</td>\
		             			 <td>'+response.expenses[i].may+'</td>\
		             			 <td>'+response.expenses[i].june+'</td>\
		             			 <td>'+response.expenses[i].july+'</td>\
		             			 <td>'+response.expenses[i].aug+'</td>\
		             			 <td>'+response.expenses[i].sept+'</td>\
		             			 <td>'+response.expenses[i].oct+'</td>\
		             			 <td>'+response.expenses[i].nov+'</td>\
		             			 <td>'+response.expenses[i].dec+'</td>\
		             			 <td>'+response.expenses[i].year_total+'</td>\
	             			 </tr>';
					}
					html +='</tbody>';
					html +='<tfoot>\
							<tr class="text-white bg-dark">\
							      <td>TOTAL</td>\
							   	 <td>'+response.expenses[0].total_jan+'</td>\
			             			 <td>'+response.expenses[0].total_feb+'</td>\
			             			 <td>'+response.expenses[0].total_march+'</td>\
			             			 <td>'+response.expenses[0].total_apr+'</td>\
			             			 <td>'+response.expenses[0].total_may+'</td>\
			             			 <td>'+response.expenses[0].total_june+'</td>\
			             			 <td>'+response.expenses[0].total_july+'</td>\
			             			 <td>'+response.expenses[0].total_aug+'</td>\
			             			 <td>'+response.expenses[0].total_sept+'</td>\
			             			 <td>'+response.expenses[0].total_oct+'</td>\
			             			 <td>'+response.expenses[0].total_nov+'</td>\
			             			 <td>'+response.expenses[0].total_dec+'</td>\
			             			 <td>'+response.expenses[0].year_grandtotal+'</td>\
							</tr>\
						</tfoot>';
					html +='</table>';
					$('#tbl_income_monthly').empty().append(html);
				}
				
		  		break;
	  		}
	  }
	}
	return {

		//main function to initiate the module
		init: function() {
			var viewForm = $('#kt_content').attr('data-table');
			_ViewController(viewForm);
			_initView();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});