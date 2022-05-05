'use strict';
var KTAjaxClient = function() {
var arrows;
var html;
var option;
const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
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
			case "customer_name":{
				if(!response==false){
					$('#customer-option').select2({ placeholder: "Select Customer",width: '100%' });
				     $('#customer-option').empty();
				     for(let i=0;i<response.length;i++){
						$('#customer-option').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
						$('#customer-option').selectpicker("refresh");
		             	  	$('#customer-option').addClass('selectpicker');
						$('#customer-option').attr('data-live-search', 'true');
				     }
				     $(document).on('click','.search',function(e){
				     	let val = $('#customer-option').val();
				     	_ajaxloaderOption('option_controller/customer_info','POST',{id:val},'customer_info');
				     });	
				}
				break;
			}
			case "customer_info":{
				$('input[name=fullname]').attr('data-id',response.id).val(response.fullname);
				$('input[name=email]').val(response.email);
				$('input[name=mobile]').val(response.mobile);
				$('textarea[name=address]').val(response.address);
				break;
			}

		}
	}

	var _ViewController = async function(view){
		 _month_year();
		switch(view){
			case "data-dashboard-accounting":{
				let date = new Date();
				let month = ("0"+(date.getMonth()+1)).slice(-1);
				KTApexChartsDemo.init('chart1', false, new Date().getFullYear(), false);
				KTApexChartsDemo.init('chart2', false, new Date().getFullYear(), month);
				KTApexChartsDemo.init('chart3', false, new Date().getFullYear(), month);
				for (let i = new Date().getFullYear(); i > 2020; i--){
				    $('#chart1_options').append($('<option />').val(i).html(i));
				    $('#chart2_year').append($('<option />').val(i).html(i));
				    $('#chart3_year').append($('<option />').val(i).html(i));
				}
				$('#chart1_options,#chart2_year,#chart3_year').val(new Date().getFullYear()).change();
				$('#chart2_months,#chart3_months').val(month).change();
				 $('#chart1_options').on('change',function(e){
	                    e.preventDefault(); 
	                    KTApexChartsDemo.init('chart1', false, $(this).val(), false);
		           });
		           $('#chart2_months,#chart2_year').on('change',function(e){
	                    e.preventDefault(); 
	                    KTApexChartsDemo.init('chart2', false, $('#chart2_year').val(), $('#chart2_months').val());
		           });
		           $('#chart3_months,#chart3_year').on('change',function(e){
	                    e.preventDefault(); 
	                    KTApexChartsDemo.init('chart3', false, $('#chart3_year').val(), $('#chart3_months').val());
		           });
				break;
			}
			case "data-collection":{
				$('#kt_datepicker_4_3').datepicker({
				   rtl: KTUtil.isRTL(),
				   orientation: "bottom left",
				   todayHighlight: true,
				   templates: arrows
				  });
				_initCurrency_format('#amount');
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Customer_Collection';
						_ajaxloader(thisUrl,"POST",val,"Modal_Customer_Collection");
				    });
				})
			}
			case "data-salesorder-create-project":{
				_initNumberOnly(".qty,#discount");
				_initCurrency_format('input[name="amount"],input[name="shipping_fee"],input[name="downpayment"]');
				_ajaxloaderOption('option_controller/Customer_Name','POST',false,'customer_name');
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let description = $('input[name=description]').val();
					let qty  = $('input[name=qty]').val();
					let unit = $('input[name=unit]').val();
					let amount = $('input[name=amount]').val();
					if(!description || !qty || !unit || !amount){
						Swal.fire("Warning!", "Please fillup the form before you click!", "warning");
					}else{
						let i = $('#kt_product_breakdown_table tbody tr').length;
						$('#kt_product_breakdown_table > tbody:last-child').append('<tr>\
							<td class="td-item['+i+']">'+description+'</td>\
							<td class="text-center td-qty['+i+']">'+qty+'</td>\
							<td class="text-center td-unit['+i+']">'+unit+'</td>\
							<td class="text-right td-amount['+i+']">'+amount+'</td>\
							<td class="text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow"><i class="la la-times"></i></button></td>\
									</tr>');	
					}
				})
				$('input[name=checkbox-status]').click(function() {
					let status = $(this).attr('data-status');
					if($(this).prop('checked') == true){
						if(status == 'downpayment'){
							$('#modal_downpayment').modal('show');
						}
						$('input[name='+status+']').attr('disabled',false);
					}else{
						if(status == 'downpayment'){
							$('input[name=date_downpayment]').val("");
							$('#date-text-downpayment').html('Downpayment :');
							$('#date-text-downpayment').attr('data-date',"");
						}
						$('input[name='+status+']').val("");
						$('input[name='+status+']').attr('disabled',true);
					}
				});
				$('#date-text-downpayment').html('Downpayment :');
				$('.save-downpayment').on('click',function(e){
					e.preventDefault();
					let date = $('input[name=date_downpayment]').val();
					if(date){
						$('#date-text-downpayment').html('Downpayment <br> ('+date+') :');
						$('#date-text-downpayment').attr('data-date',date);
						$('input[name=date_downpayment]').val("");
						$('#modal_downpayment').modal('hide');
					}
				});
				_initremovetable('#kt_product_breakdown_table');
				break;
			}
			case "data-salesorder-create-stocks":{
				_initNumberOnly(".qty,#discount");
				_initCurrency_format('input[name="amount"],input[name="shipping_fee"],input[name="downpayment"]');
				_ajaxloaderOption('option_controller/Customer_Name','POST',false,'customer_name');
				$(document).on('change','#project_no',function(e){
					e.preventDefault();
					let id = $(this).val();
					_ajaxloaderOption('option_controller/pallet_color','POST',{id:id},'pallet-color');
				});
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let description = $('select[name=project_no] option:selected').text();
					let color = $('select[name=c_code] option:selected').text();
					let id = $('select[name=c_code] ').val();
					let qty  = $('input[name=qty]').val();
					let unit = $('input[name=unit]').val();
					let amount = $('input[name=amount]').val();
					if(!description|| !id || !qty || !unit || !amount){
						Swal.fire("Warning!", "Please fillup the form before you click!", "warning");
					}else{
						let i = $('#kt_product_breakdown_table tbody tr').length;
						$('#kt_product_breakdown_table > tbody').append('<tr>\
							<td class="td-item['+i+']" data-id="'+id+'">'+description+' ('+color+')</td>\
							<td class="text-center td-qty['+i+']">'+qty+'</td>\
							<td class="text-center td-unit['+i+']">'+unit+'</td>\
							<td class="text-right td-amount['+i+']">'+amount+'</td>\
							<td class="text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow"><i class="far fa-trash-alt"></i></button></td>\
									</tr>');	
					}
				})
				$('input[name=checkbox-status]').click(function() {
					let status = $(this).attr('data-status');
					if($(this).prop('checked') == true){
						if(status == 'downpayment'){
							$('#modal_downpayment').modal('show');
						}
						$('input[name='+status+']').attr('disabled',false);
					}else{
						if(status == 'downpayment'){
							$('input[name=date_downpayment]').val("");
							$('#date-text-downpayment').html('Downpayment :');
							$('#date-text-downpayment').attr('data-date',"");
						}
						$('input[name='+status+']').val("");
						$('input[name='+status+']').attr('disabled',true);
					}
				});
				$('#date-text-downpayment').html('Downpayment :');
				$('.save-downpayment').on('click',function(e){
					e.preventDefault();
					let date = $('input[name=date_downpayment]').val();
					if(date){
						$('#date-text-downpayment').html('Downpayment <br> ('+date+') :');
						$('#date-text-downpayment').attr('data-date',date);
						$('input[name=date_downpayment]').val("");
						$('#modal_downpayment').modal('hide');
					}
				});
				_initremovetable('#kt_product_breakdown_table');
				break;
			}
			case "data-salesorder-stocks":{
				$(document).ready(function() {
					$(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_SalesOrder_Stocks';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_SalesOrder_Stocks");
				    });
					$(document).on("click",".btn-print",function(e) {
						e.preventDefault();
						let id = $('.so_no').attr('data-id');
						sessionStorage.setItem('so_no', id);
						window.open(baseURL+'gh/printview/print-salesorder-stocks');
				    });
				})
				break;
			}
			case "data-salesorder-project":{
				$(document).ready(function() {
				    $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_SalesOrder_Project';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_SalesOrder_Project");
				    });
				    $(document).on("click",".btn-print",function(e) {
						e.preventDefault();
						let id = $('.so_no').attr('data-id');
						sessionStorage.setItem('so_no', id);
						window.open(baseURL+'gh/printview/print-salesorder-project');
				    });

				})
				break;
			}
			case "data-salesorder-stocks-print":{
					let thisUrl = 'modal_controller/Modal_SalesOrder_Stocks';
					_ajaxloader(thisUrl,"POST",{id:sessionStorage.getItem('so_no')},"Modal_SalesOrder_Stocks");
				break;
			}
			case "data-salesorder-project-print":{
					let thisUrl = 'modal_controller/Modal_SalesOrder_Project';
					_ajaxloader(thisUrl,"POST",{id:sessionStorage.getItem('so_no')},"Modal_SalesOrder_Project");
				break;
			}
			case "data-profile-update":{
				let thisUrl = 'view_controller/View_Profile';
				_ajaxloader(thisUrl,"POST",false,"View_Profile");
				break;
			}
			case "data-report-collection-stocks":{
					$(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Stocks_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Stocks_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Collection_Stocks_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Collection_Stocks_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Collection_Stocks_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Collection_Stocks_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Collection_Stocks_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Collection_Stocks_Yearly");		
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
			case "data-report-collection-project":{
					$(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Project_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Project_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Collection_Project_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Collection_Project_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Collection_Project_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Collection_Project_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Collection_Project_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Collection_Project_Yearly");		
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
			case "data-saleorder-stocks-report":{
				   $(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Salesorder_Stocks_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Salesorder_Stocks_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Salesorder_Stocks_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Salesorder_Stocks_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Salesorder_Stocks_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Salesorder_Stocks_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Salesorder_Stocks_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Salesorder_Stocks_Yearly");		
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
			case "data-saleorder-project-report":{
				   $(document).on('click','#search_collection',function(e){
				   		var action = $(this).attr('data-status');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Salesorder_Project_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Salesorder_Project_Daily");
								break;}
							case "weekly":{
								let thisUrl1 = 'datatable_controller/Account_Report_Salesorder_Project_Weekly';
								_ajaxloader(thisUrl1,"POST",val,"Account_Report_Salesorder_Project_Weekly");
								break;}
							case "monthly":{
								let thisUrl2 = 'datatable_controller/Account_Report_Salesorder_Project_Monthly';
								_ajaxloader(thisUrl2,"POST",val,"Account_Report_Salesorder_Project_Monthly");
								break;}
							case "yearly":{
								let thisUrl3 = 'datatable_controller/Account_Report_Salesorder_Project_Yearly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Salesorder_Project_Yearly");		
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
					 $(document).on("click","#view-request-form",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Stocks_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Stocks");
				    });
					$(document).on("click","#view-received-form",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Received_Stocks';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Received_Stocks");
				    });
				})
			   break;
			}
			case "data-purchased-material-project-request":{
				$(document).ready(function() {
					$(document).on("click","#view-request-form",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Accounting_Purchase_Material_Project_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_Accounting_Purchase_Material_Project");
				    });
					$(document).on("click","#view-received-form",function() {
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
			case "data-supplier":{
				 $(document).ready(function() {
				 	_initItem_option();
					_initCurrency_format("#price");
					$(document).on("click","#form-request",function() {
						let thisUrl = 'modal_controller/Modal_Supplier_View';
						_ajaxloader(thisUrl,"POST",{id:$(this).attr('data-id')},"Modal_Supplier_View");
				    	});
				    	$(document).on("click","#edit-item-view",function() {
						let thisUrl = 'modal_controller/Modal_Supplier_Item_Update_View';
						_ajaxloader(thisUrl,"POST",{id:$(this).attr('data-id')},"Modal_Supplier_Item_Update_View");
				    	});
				    	$(document).on("click",".add-supplier",function() {
						$('#Create_Supplier')[0].reset();
				    	});
				  });
				break;
			}
		}
	}

	var _initView = async function(type,response){
	  switch(type){
	  	case "Modal_Customer_Collection":{
	  		$('.btn_action').attr('data-id',response.id);
	  		$('#order_nos').val(response.order_no);
	  		$('#customer').val(response.customer);
  			$('#email').val(response.email);
  			$('#mobile').val(response.mobile);
  			$('#date_deposite').val(response.date_created);
  			$('#amounts').val(response.amount);
  			$('#bank').val(response.bank);
  			if(response.status == 'A'){
  				$('.btn_action').hide();
  			}else{
  				$('.btn_action').show();
  			}
	  		break;
	  	}
	  	case "Modal_SalesOrder_Stocks":{
	  		let container = $('#kt_table_soa_item > tbody:last-child');
	  		    container.empty();
	  		     $('.tr-discount').empty();
	               $('.tr-shipping').empty();
	  		let html=""    
	  		if(!response == false){
	               $('#date_order').text(response[0].date_order);
	               $('.so_no').attr('data-id',response[0].id).text(response[0].so_no);
	               $('.si_no').text(response[0].si_no);
	               $('.tin').text(response[0].tin);
	               $('.sold-to').text(response[0].customer);
	               $('.address').text(response[0].address);
	               $('.date-order').text(response[0].date_order);
	               if(response[0].shipping_fee !=0){
	               	$('.tr-shipping').append('<td class="text-right text-success">SHIPPING FEE :</td>\
	               						<td class="text-right text-success"><div style="float:left;">₱</div><div style="float:right;">'+response[0].shipping_fee+'<div></td>');
	               }
	               if(response[0].discount !=0){
	               	$('.tr-discount').append('<td class="text-right text-success">DISCOUNTED :</td>\
	               						<td class="text-right text-success"><div style="float:right;">'+response[0].discount+'%<div></td>');
	               }
	               $('.td-date-downpayment').text('('+response[0].date_downpayment+')');
	               $('.total').text(response[0].total);
	               $('.td-downpayment').text(response[0].downpayment);
	               $('.td-amountdue').text(response[0].amount_due);
	             	if(response[0].vat_status==1){$('.vat-included').text('(with vat)');}else{$('.vat-included').text('');}
	             	for(var i=0;i<response.length;i++){
             			html += '<tr>\
							<td class="text-center td1-border-1px">'+response[i].item+'</td>\
							<td class="text-right td1-border-1px"><div style="float:left;">₱</div><div style="float:right;">'+response[i].amount+'<div></td>\
						   </tr>';
				}	
				if(response.length < 5){
				   for(var i=0;i<4;i++){
					html += '<tr>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
							<td class="text-right td1-border-1px">&nbsp;</td>\
						</tr>';
					}
				}
				html +='<tr>\
						<td class="text-right td1-border-1px"><b>TOTAL AMOUNT:</b></td>\
						<td class="text-right td1-border-1px"><b><div style="float:left;">₱</div><div style="float:right;">'+response[0].subtotal+'</div></b></td>\
					   </tr>';
				container.append(html);
				if(response[0].delivery == 1){
	  				$('.modal-delivery').show();
	  				$('.btn-print').hide();
	  			}else{
	  				$('.modal-delivery').hide();
	  				$('.btn-print').show();
	  			}
				if(response[0].status == 'P'){
	  				$('#requestModal > div > div > div.modal-approval').show();
	  			}else{
	  				$('#requestModal > div > div > div.modal-approval').hide();
	  			}
	  		}
	  		break;
	  	}
	  	case "Modal_SalesOrder_Project":{
	  		let container = $('#kt_table_soa_item > tbody:last-child');
	  		    container.empty();
	  		     $('.tr-discount').empty();
	               $('.tr-shipping').empty();
	  		let html=""    
	  		if(!response == false){
	               $('#date_order').text(response.soa.date_order);
	               $('.so_no').attr('data-id',response.soa.id).text(response.soa.so_no);
	               $('.si_no').text(response.soa.si_no);
	               $('.tin').text(response.soa.tin);
	               $('.sold-to').text(response.soa.customer);
	               $('.address').text(response.soa.address);
	               $('.date-order').text(response.soa.date_order);
	               if(response.soa.shipping_fee !=0){
	               	$('.tr-shipping').append('<td class="text-right text-success">SHIPPING FEE :</td>\
	               						<td class="text-right text-success"><div style="float:left;">₱</div><div style="float:right;">'+response.soa.shipping_fee+'<div></td>');
	               }
	               if(response.soa.discount !=0){
	               	$('.tr-discount').append('<td class="text-right text-success">DISCOUNTED :</td>\
	               						<td class="text-right text-success"><div style="float:right;">'+response.soa.discount+'%<div></td>');
	               }
	               $('.td-date-downpayment').text('('+response.soa.date_downpayment+')');
	               $('.td-downpayment').text(response.soa.downpayment);
	               $('.td-amountdue').text(response.soa.amount_due);
	             	if(response.soa.vat_status==1){$('.vat-included').text('(with vat)');}else{$('.vat-included').text('');}
	             	for(var i=0;i<response.item.length;i++){
             			html += '<tr>\
							<td class="text-center td1-border-1px">'+response.item[i].quantity+' '+response.item[i].unit+' '+response.item[i].description+'</td>\
							<td class="text-right td1-border-1px"><div style="float:left;">₱</div><div style="float:right;">'+Number(response.item[i].amount).toLocaleString("en")+'<div></td>\
							</tr>';
				}	
				if(response.item.length < 5){
				   for(var i=0;i<4;i++){
					html += '<tr>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
							<td class="text-right td1-border-1px">&nbsp;</td>\
						</tr>';
					}
				}
				html +='<tr>\
						<td class="text-right td1-border-1px"><b>TOTAL AMOUNT:</b></td>\
						<td class="text-right td1-border-1px"><b><div style="float:left;">₱</div><div style="float:right;">'+response.soa.subtotal+'</div></b></td>\
					   </tr>';
				container.append(html);
				if(response.soa.delivery == 1){
	  				$('.modal-delivery').show();
	  				$('.btn-print').hide();
	  			}else{
	  				$('.modal-delivery').hide();
	  				$('.btn-print').show();
	  			}
				if(response.soa.status == 'P'){
	  				$('#requestModal > div > div > div.modal-approval').show();
	  			}else{
	  				$('#requestModal > div > div > div.modal-approval').hide();
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
	  	case "Modal_Accounting_Purchase_Material_Stocks":{
	  			if(!response == false){
	  				_initCurrency_format(".amount");
	  			    $('.cash_fund').text(response.info.fund_no);
		  		    $('.joborder').text(response.info.production_no);
		  		    $('.requestor').text(response.info.requestor);
		  		    $('.date_created').text(response.info.date_created);
		  		    $('.title').text(response.info.title+' ('+response.info.c_name+')');
		  		    $('.total').text(response.total);
		  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
		  		    					  </tr>');
		  		    }
	  		    		$('.purchase-button').show();
	  		    		$('.purchase-cash-fund').hide();
	  		    		$('.total_fund').text(response.fund);
	  		    		$('.btn-request-submit').text('Submit').attr('data-status',1);
		  		    	if(response.info.status == 5){
		  		    		$('.purchase-button').hide();
		  		    		$('.purchase-cash-fund').show();
		  		    		$('.status').text('Complete').removeClass('text-primary text-warning').addClass('text-success');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-primary').addClass('separator-success');
		  		    	}else if(response.info.status == 4){
		  		    		$('.status').text('Approved').removeClass('text-warning text-success').addClass('text-primary');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-success').addClass('separator-primary');
		  		    		$('input[name=cash_fund]').val(response.fund);
		  		    		$('.btn-request-submit').text('Update').attr('data-status',2);
		  		    	}else{
		  		    		$('.status').text('Request').removeClass('text-primary text-success').addClass('text-warning');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-success separator-primary').addClass('separator-warning');
		  		    	}
		  		    $('#view-purchased-request').modal('show');

		  		}
	  		   break;
	  		}
	  		case "Modal_Accounting_Purchase_Received_Stocks":{
		  		if(!response == false){
	  				_initCurrency_format(".amount");
	  			    $('.cash_fund_r').text(response.info.fund_no);
		  		    $('.joborder_r').text(response.info.production_no);
		  		    $('.requestor_r').text(response.info.requestor);
		  		    $('.date_created_r').text(response.info.date_created);
		  		    $('.title_r').text(response.info.title+' ('+response.info.c_name+')');
		  		    $('.total-received').text(response.total);
		  		    $('.total_petty').text(response.total_petty);
		  		    $('.actual_change').text(response.total_change);
		  		    $('.total_refund').text(response.total_refund);
		  		    let container = $('#tbl_purchased_received_modal > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].supplier+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].payment+'</td>\
		  		    					  </tr>');

		  		    }
		  		     $('.purchased-received-input').show();
	  		    		$('.purchased-received-hide').hide();
		  		    	if(response.info.status == 2){
		  		    		$('.purchased-received-hide').show();
		  		    		$('.purchased-received-input').hide();
		  		    		$('.status-received').text('Complete').removeClass('text-primary text-warning').addClass('text-success');
		  		    		$('#separator-status-received-1,#separator-status-received-2').removeClass('separator-warning separator-primary').addClass('separator-success');
		  		    	}else{
		  		    		$('.status-received').text('Request').removeClass('text-primary text-success').addClass('text-warning');
		  		    		$('#separator-status-received-1,#separator-status-received-2').removeClass('separator-success separator-primary').addClass('separator-warning');
		  		    	}
		  		    $('#view-purchased-received').modal('show');

		  		}
	  		 break;
	  		}
	  		case "Modal_Accounting_Purchase_Material_Project":{
	  			if(!response == false){
	  				_initCurrency_format(".amount");
	  			    $('.cash_fund').text(response.info.fund_no);
		  		    $('.joborder').text(response.info.production_no);
		  		    $('.requestor').text(response.info.requestor);
		  		    $('.date_created').text(response.info.date_created);
		  		    $('.title').text(response.info.title);
		  		    $('.total').text(response.total);
		  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
		  		    					  </tr>');
		  		    }
	  		    		$('.purchase-button').show();
	  		    		$('.purchase-cash-fund').hide();
	  		    		$('.total_fund').text(response.fund);
	  		    		$('.btn-request-submit').text('Submit').attr('data-status',1);
		  		    	if(response.info.status == 5){
		  		    		$('.purchase-button').hide();
		  		    		$('.purchase-cash-fund').show();
		  		    		$('.status').text('Complete').removeClass('text-primary text-warning').addClass('text-success');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-primary').addClass('separator-success');
		  		    	}else if(response.info.status == 4){
		  		    		$('.status').text('Approved').removeClass('text-warning text-success').addClass('text-primary');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-success').addClass('separator-primary');
		  		    		$('input[name=cash_fund]').val(response.fund);
		  		    		$('.btn-request-submit').text('Update').attr('data-status',2);
		  		    	}else{
		  		    		$('.status').text('Request').removeClass('text-primary text-success').addClass('text-warning');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-success separator-primary').addClass('separator-warning');
		  		    	}
		  		    $('#view-purchased-request').modal('show');

		  		}
	  		   break;
	  		}

	  		case "Modal_Accounting_Purchase_Received_Project":{
		  		if(!response == false){
	  				_initCurrency_format(".amount");
	  			    $('.cash_fund_r').text(response.info.fund_no);
		  		    $('.joborder_r').text(response.info.production_no);
		  		    $('.requestor_r').text(response.info.requestor);
		  		    $('.date_created_r').text(response.info.date_created);
		  		    $('.title_r').text(response.info.title);
		  		    $('.total-received').text(response.total);
		  		    $('.total_petty').text(response.total_petty);
		  		    $('.actual_change').text(response.total_change);
		  		    $('.total_refund').text(response.total_refund);
		  		    let container = $('#tbl_purchased_received_modal > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].supplier+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].payment+'</td>\
		  		    					  </tr>');

		  		    }
		  		     $('.purchased-received-input').show();
	  		    		$('.purchased-received-hide').hide();
		  		    	if(response.info.status == 2){
		  		    		$('.purchased-received-hide').show();
		  		    		$('.purchased-received-input').hide();
		  		    		$('.status-received').text('Complete').removeClass('text-primary text-warning').addClass('text-success');
		  		    		$('#separator-status-received-1,#separator-status-received-2').removeClass('separator-warning separator-primary').addClass('separator-success');
		  		    	}else{
		  		    		$('.status-received').text('Request').removeClass('text-primary text-success').addClass('text-warning');
		  		    		$('#separator-status-received-1,#separator-status-received-2').removeClass('separator-success separator-primary').addClass('separator-warning');
		  		    	}
		  		    $('#view-purchased-received').modal('show');

		  		}
	  		 break;
	  		}
	  	

	  		case "Account_Report_Collection_Stocks_Daily":{
	  			let container = $('#tbl_collection_daily > tbody:last-child');
	  			container.empty();
	             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td class=""><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.row[i].customer+'</span><span class="text-muted font-weight-bold" id="bank">'+response.row[i].bank+'</span></td>'
	             				+'<td class="">'+response.row[i].si_no+'</td>'
	             				+'<td class="text-right">'+response.row[i].gross+'</td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
				}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Collection_Stocks_Weekly":{
	  			let container = $('#tbl_collection_weekly > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	             				+'<td class="text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response[i].vat+'</td>'
	             				+'<td class="text-right">'+response[i].amount+'</td>'
						+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Collection_Stocks_Monthly":{
	  			let container = $('#tbl_collection_monthly > tbody:last-child');
	  			    container.empty();
		             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.row[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
					}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Collection_Stocks_Yearly":{
	  			let container = $('#tbl_collection_yearly > tbody:last-child');
	  			    container.empty();
		             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.row[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
					}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}


	  		case "Account_Report_Collection_Project_Daily":{
	  			let container = $('#tbl_collection_daily > tbody:last-child');
	  			container.empty();
	             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td class=""><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.row[i].customer+'</span><span class="text-muted font-weight-bold" id="bank">'+response.row[i].bank+'</span></td>'
	             				+'<td class="">'+response.row[i].si_no+'</td>'
	             				+'<td class="text-right">'+response.row[i].gross+'</td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
				}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Collection_Project_Weekly":{
	  			let container = $('#tbl_collection_weekly > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	             				+'<td class="text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response[i].vat+'</td>'
	             				+'<td class="text-right">'+response[i].amount+'</td>'
						+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Collection_Project_Monthly":{
	  			let container = $('#tbl_collection_monthly > tbody:last-child');
	  			    container.empty();
		             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.row[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
					}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Collection_Project_Yearly":{
	  			let container = $('#tbl_collection_yearly > tbody:last-child');
	  			    container.empty();
		             	for(var i=0;i<response.row.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response.row[i].date_created+'</td>'
	             				+'<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.row[i].gross+'</span></td>'
	             				+'<td class="text-right">'+response.row[i].vat+'</td>'
	             				+'<td class="text-right">'+response.row[i].amount+'</td>'
						+'</tr>');
					}
				$('#total_gross').text(response.total_gross);
				$('#total_vat').text(response.total_vat);
				$('#total_amount').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Stocks_Daily":{
	  			let container = $('#tbl_salesorder_daily > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.result[i].customer+'</span></td>'
             				+'<td class="pl-0">'+response.result[i].si_no+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Stocks_Weekly":{
	  			let container = $('#tbl_salesorder_weekly > tbody:last-child');
	  			container.empty();
		          for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Stocks_Monthly":{
	  			console.log(response)
	  			let container = $('#tbl_salesorder_monthly > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.result.length;i++){
	             			container.append('<tr>'
	             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
	             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
						+'</tr>');
					}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Stocks_Yearly":{
	  			let container = $('#tbl_salesorder_yearly > tbody:last-child');
	  			container.empty();
	             	for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}

	  		case "Account_Report_Salesorder_Project_Daily":{
	  			let container = $('#tbl_salesorder_daily > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response.result[i].customer+'</span></td>'
             				+'<td class="pl-0">'+response.result[i].si_no+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Project_Weekly":{
	  			let container = $('#tbl_salesorder_weekly > tbody:last-child');
	  			container.empty();
		          for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Project_Monthly":{
	  			console.log(response)
	  			let container = $('#tbl_salesorder_monthly > tbody:last-child');
	  			container.empty();
		             	for(var i=0;i<response.result.length;i++){
	             			container.append('<tr>'
	             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
	             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
	             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
						+'</tr>');
					}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Project_Yearly":{
	  			let container = $('#tbl_salesorder_yearly > tbody:last-child');
	  			container.empty();
	             	for(var i=0;i<response.result.length;i++){
             			container.append('<tr>'
             				+'<td class="pl-0 font-weight-bolder text-success">'+response.result[i].date_created+'</td>'
             				+'<td class="pl-0"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].subtotal+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].vat+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].shipping_fee+'</span></td>'
             				+'<td class="pl-0 text-right"><span class="text-dark-75 font-weight-bolder d-block font-size-lg text-right">'+response.result[i].amount_due+'</span></td>'
					+'</tr>');
				}
				$('#total_subtotal').text(response.total_subtotal);
  				$('#total_vats').text(response.total_vat);
  				$('#total_shippingfee').text(response.total_shippingfee);
  				$('#total_grand').text(response.total_amount);
	  			break;
	  		}
	  		case "Account_Report_Project_Daily":{
	  				let container = $('#tbl_cashfund_daily > tbody:last-child');
	  				container.empty();
		             	for(var i=0;i<response.data.length;i++){
		             			container.append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td><span class="text-dark-75 font-weight-bolder font-size-lg">'+response.data[i].fund_no+'</span></td>'
		             				+'<td>'+response.data[i].pettycash+'</td>'
		             				+'<td class="text-right">'+response.data[i].change+'</td>'
		             				+'<td class="text-right">'+response.data[i].refund+'</td>'
		             				+'<td class="text-right">'+response.data[i].gross+'</span></td>'
		             				+'<td class="text-right">'+response.data[i].vat+'</td>'
		             				+'<td class="text-right">'+response.data[i].amount+'</td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Weekly":{
	  				$('#tbl_cashfund_weekly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_weekly > tbody:last-child').append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td>'+response.data[i].pettycash+'</td>'
		             				+'<td class="text-right">'+response.data[i].change+'</td>'
		             				+'<td class="text-right">'+response.data[i].refund+'</td>'
		             				+'<td class="text-right">'+response.data[i].gross+'</td>'
		             				+'<td class="text-right">'+response.data[i].vat+'</td>'
		             				+'<td class="text-right">'+response.data[i].amount+'</td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Monthly":{
	  				$('#tbl_cashfund_monthly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_monthly > tbody:last-child').append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td >'+response.data[i].pettycash+'</td>'
		             				+'<td class="text-right">'+response.data[i].change+'</td>'
		             				+'<td class="text-right">'+response.data[i].refund+'</td>'
		             				+'<td class="text-right">'+response.data[i].gross+'</td>'
		             				+'<td class="text-right">'+response.data[i].vat+'</td>'
		             				+'<td class="text-right">'+response.data[i].amount+'</td>'
							+'</tr>');
					}
	  			break;
	  		}
	  		case "Account_Report_Project_Yearly":{
	  				$('#tbl_cashfund_yearly > tbody:last-child').empty();
		             	for(var i=0;i<response.data.length;i++){
		             			$('#tbl_cashfund_yearly > tbody:last-child').append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response.data[i].date_created+'</td>'
		             				+'<td>'+response.data[i].pettycash+'</td>'
		             				+'<td class="text-right">'+response.data[i].change+'</td>'
		             				+'<td class="text-right">'+response.data[i].refund+'</td>'
		             				+'<td class="text-right">'+response.data[i].gross+'</td>'
		             				+'<td class="text-right">'+response.data[i].vat+'</td>'
		             				+'<td class="text-right">'+response.data[i].amount+'</td>'
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
		  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week3_type1){
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_add+'</td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week4_type1){
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
		  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
		  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark>\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			  html +='<tr class="table-success text-dark">\
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
	  		    	    html +='<tr class="table-success text-dark">\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		    	   html +='<tr class="table-warning text-dark">\
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
	  			    html +='<table class="table table-striped table-sm"><thead><tr class="text-white">';
	  			    html +='<th class="bg-dark"></th>\
	  			    		 <th class="bg-dark">JANUARY</th>\
	  			    		 <th class="bg-dark">FEBRUARY</th>\
	  			    		 <th class="bg-dark">MARCH</th>\
	  			    		 <th class="bg-dark">APRIL</th>\
	  			    		 <th class="bg-dark">MAY</th>\
	  			    		 <th class="bg-dark">JUNE</th>\
	  			    		 <th class="bg-dark">JULY</th>\
	  			    		 <th class="bg-dark">AUGUST</th>\
	  			    		 <th class="bg-dark">SEPTEMBER</th>\
	  			    		 <th class="bg-dark">OCTOBER</th>\
	  			    		 <th class="bg-dark">NOVEMBER</th>\
	  			    		 <th class="bg-dark">DECEMBER</th>\
	  			    		 <th class="bg-dark">TOTAL</th>\
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
	  	case "Modal_Supplier_View":{
	  		_initCurrency_format('.amount');
	  		$('.name').text(response.name).attr('data-id',response.id);
	  		$('.mobile').text(response.mobile);
	  		$('.email').text(response.email);
	  		$('.address').text(response.address);
	  		$('input[name=name]').val(response.name);
	  		$('input[name=mobile]').val(response.mobile);
	  		$('input[name=email]').val(response.email);
	  		$('input[name=address]').val(response.address);

	  		$('.image-view').css('background-image','url('+baseURL+'assets/images/supplier/'+response.image+')');
	  		let TableURL = baseURL + 'modal_controller/Modal_Supplier_Item_View';
			let TableData = [{data:'item'},{data:'amount',className: "text-center"},{data:'action', className: "text-center"}];
			_DataTableLoader1('tbl_supplier_item',TableURL,TableData,response.id);
	  		break;
	  	}
	  	case "Modal_Supplier_Item_Update_View":{
	  		_initCurrency_format('.amount');
	  		$('select[name=item]').val(response.item_no).change();
	  		$('select[name=item]').attr('data-id',response.id);
	  		$('input[name=amount]').val(response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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