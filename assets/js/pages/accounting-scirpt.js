'use strict';
var KTAjaxClient = function() {
var arrows;
var html;
var option;

const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
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
	var _formatnumbercommat = function(value){
		return value.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
	var _initnotificationupdate = function(){
		 _ajaxloaderOption('Dashboard_controller/accounting_dashboard','POST',false,'accounting');
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
			case "accounting":{
				let purchase_stocks_pending = $('.purchase_stocks_pending');
				(response.purchase_stocks_pending != 0)?purchase_stocks_pending.addClass('label label-rounded label-warning').text(response.purchase_stocks_pending):purchase_stocks_pending.removeClass("label label-rounded label-warning").text("");

				let purchase_project_pending = $('.purchase_project_pending');
				(response.purchase_project_pending != 0)?purchase_project_pending.addClass('label label-rounded label-warning').text(response.purchase_project_pending):purchase_project_pending.removeClass("label label-rounded label-warning").text("");

				let purchase_stocks_received = $('.purchase_stocks_received');
				(response.purchase_stocks_received != 0)?purchase_stocks_received.addClass('label label-rounded label-warning').text(response.purchase_stocks_received):purchase_stocks_received.removeClass("label label-rounded label-warning").text("");

				let purchase_project_received = $('.purchase_project_received');
				(response.purchase_project_received != 0)?purchase_project_received.addClass('label label-rounded label-warning').text(response.purchase_project_received):purchase_project_received.removeClass("label label-rounded label-warning").text("");

				let total_purchase_stocks = $('.total_purchase_stocks');
				(response.total_purchase_stocks != 0)?total_purchase_stocks.addClass('label label-rounded label-warning').text(response.total_purchase_stocks):total_purchase_stocks.removeClass("label label-rounded label-warning").text("");
				let total_purchase_project = $('.total_purchase_project');
				(response.total_purchase_project != 0)?total_purchase_project.addClass('label label-rounded label-warning').text(response.total_purchase_project):total_purchase_project.removeClass("label label-rounded label-warning").text("");

				let total_purchase = $('.total_purchase');
				(response.total_purchase != 0)?total_purchase.addClass('label label-rounded label-warning').text(response.total_purchase):total_purchase.removeClass("label label-rounded label-warning").text("");

				let total_request = $('.total_request');
				(response.total_request != 0)?total_request.addClass('label label-rounded label-warning').text(response.total_request):total_request.removeClass("label label-rounded label-warning").text("");
				
				let total_salesoder_request = $('.total_salesoder_request');
				(response.total_salesoder_request != 0)?total_salesoder_request.addClass('label label-rounded label-warning').text(response.total_salesoder_request):total_salesoder_request.removeClass("label label-rounded label-warning").text("");

				let sales_stocks_pending = $('.sales_stocks_pending_request');
				(response.sales_stocks_pending != 0)?sales_stocks_pending.addClass('label label-rounded label-warning').text(response.sales_stocks_pending):sales_stocks_pending.removeClass("label label-rounded label-warning").text("");

				let sales_project_pending = $('.sales_project_pending_request');
				(response.sales_project_pending != 0)?sales_project_pending.addClass('label label-rounded label-warning').text(response.sales_project_pending):sales_project_pending.removeClass("label label-rounded label-warning").text("");

				let other_purchased_total = $('.other_purchased_total');
				(response.other_purchased_total != 0)?other_purchased_total.addClass('label label-rounded label-warning').text(response.other_purchased_total):other_purchased_total.removeClass("label label-rounded label-warning").text("");

				let other_purchased_request = $('.other_purchased_request');
				(response.other_purchased_request != 0)?other_purchased_request.addClass('label label-rounded label-warning').text(response.other_purchased_request):other_purchased_request.removeClass("label label-rounded label-warning").text("");
				
				let other_purchased_approved = $('.other_purchased_approved');
				(response.other_purchased_approved != 0)?other_purchased_approved.addClass('label label-rounded label-warning').text(response.other_purchased_approved):other_purchased_approved.removeClass("label label-rounded label-warning").text("");



				$('.sales_stocks_pending').text(response.sales_stocks_pending);
				$('.sales_project_pending').text(response.sales_project_pending);
				$('.sales_stocks_approved').text(response.sales_stocks_approved);
				$('.sales_project_approved').text(response.sales_project_approved);
				$('.sales_stocks_completed').text(response.sales_stocks_completed);
				$('.sales_project_completed').text(response.sales_project_completed);
				$('.sales_stocks_cancelled').text(response.sales_stocks_cancelled);
				$('.sales_project_cancelled').text(response.sales_project_cancelled);
				break;
			}
			case "pallet-color":{
				if(!response == false){
                  	    $('#c_code').empty();
                  	    $('#c_code').append('<option value="" disabled selected>SELECT PALLETE COLOR</option>');
                       for(let i=0;i<response.length;i++){
                         $('#c_code').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                  	   }
                  	}
				break;
			}
			case "job_order":{
				let container = $('#joborder');
				container.empty();
				if(response != false){
					 for(let i=0;i<response.length;i++){
	                  	  	  container.append('<option value="'+response[i].id+'">'+response[i].production_no+'</option>').addClass('selectpicker').attr('data-live-search', 'true').selectpicker('refresh');
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
			case "cashpostion_category":{
				let cash_id = $('.cat_id');
				cash_id.empty();
				if(response != false){
					for(let i=0;i<response.length;i++){
						cash_id.append('<option value="'+response[i].id+'">'+response[i].name+'</option>')
					}
				}
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
			case "data-purchased-material-stocks-request":{
				KTDatatablesDataSourceAjaxClient.init('tbl_purchased_material_stocks');
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
				KTDatatablesDataSourceAjaxClient.init('tbl_purchased_material_project');
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
			case "data-purchased-inventory-request":{
				KTDatatablesDataSourceAjaxClient.init('tbl_other_purchase_invetory');
				_initCurrency_format(".amount");
				$(document).ready(function() {
					$(document).on("click","#view-request-form",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Other_Purchase_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Other_Purchase_View");
				    });
					$(document).on("click","#view-received-form",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Other_Purchase_View_Received_Accounting';
						_ajaxloader(thisUrl,"POST",val,"Modal_Other_Purchase_View_Received_Accounting");
				    });
				})
				break;
			}
			case "data-rawmats-list":{
				KTDatatablesDataSourceAjaxClient.init('tbl_rawmats');
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
				KTDatatablesDataSourceAjaxClient.init('tbl_spareparts');
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
				KTDatatablesDataSourceAjaxClient.init('tbl_officesupplies');
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
			case "data-production-stocks":{
				KTDatatablesDataSourceAjaxClient.init('tbl_production_stocks');
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
				KTDatatablesDataSourceAjaxClient.init('tbl_supplier');
				 $(document).ready(function() {
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
			case "data-collection":{
				KTDatatablesDataSourceAjaxClient.init('tbl_collection');
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

				if($('#kt_product_breakdown_table tbody tr').length == 0){
	                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
	                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
	                                    </div>\
	                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
					$('#kt_product_breakdown_table > tbody').empty();	
				}

				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let description = $('input[name=description]').val();
					let qty  = $('input[name=qty]').val();
					let unit = $('input[name=unit]').val();
					let amount = $('input[name=amount]').val();
					let validation = $('#kt_product_breakdown_table tr > td:contains('+description+')').length;
					if(validation == 0){
						if(!description || !qty || !unit || !amount){
							Swal.fire("Warning!", "Please fillup the form before you click!", "warning");
						}else{
							let i = $('#kt_product_breakdown_table tbody tr').length;
							if((i+1) != 0){
								 $('.cart-empty-page').empty();
							}
							$('#kt_product_breakdown_table > tbody:last-child').append('<tr>\
								<td class="td-item['+i+']">'+description+'</td>\
								<td class="text-center td-qty['+i+']">'+qty+'</td>\
								<td class="text-center td-unit['+i+']">'+unit+'</td>\
								<td class="text-right td-amount['+i+']">'+amount+'</td>\
								<td class="text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow btn-delete"><i class="far fa-trash-alt"></i></button></td>\
										</tr>');	
						}
					}else{
						Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
					}	
				});
				$(document).on('click','.btn-delete',function(e){
					e.preventDefault();
					if($('#kt_product_breakdown_table tbody tr').length == 0){
		                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
		                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
		                                    </div>\
		                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
						$('#kt_product_breakdown_table > tbody').empty();	
					}
				});
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
				if($('#kt_product_breakdown_table tbody tr').length == 0){
	                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
	                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
	                                    </div>\
	                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
					$('#kt_product_breakdown_table > tbody').empty();	
				}
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let description = $('select[name=project_no] option:selected').text();
					let color = $('select[name=c_code] option:selected').text();
					let id = $('select[name=c_code] ').val();
					let qty  = $('input[name=qty]').val();
					let unit = $('input[name=unit]').val();
					let amount = $('input[name=amount]').val();
					let validation = $('#kt_product_breakdown_table tr > td:contains('+description+')').length;
					if(validation == 0){
						if(!description|| !id || !qty || !unit || !amount){
							Swal.fire("Warning!", "Please fillup the form before you click!", "warning");
						}else{
							let i = $('#kt_product_breakdown_table tbody tr').length;
							if((i+1) != 0){
								 $('.cart-empty-page').empty();
							}
							$('#kt_product_breakdown_table > tbody').append('<tr>\
								<td class="td-item['+i+']" data-id="'+id+'">'+description+' ('+color+')</td>\
								<td class="text-center td-qty['+i+']">'+qty+'</td>\
								<td class="text-center td-unit['+i+']">'+unit+'</td>\
								<td class="text-right td-amount['+i+']">'+amount+'</td>\
								<td class="text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow btn-delete"><i class="far fa-trash-alt"></i></button></td>\
										</tr>');	
						}
					}else{
						Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
					}
				})
				$(document).on('click','.btn-delete',function(e){
					e.preventDefault();
					if($('#kt_product_breakdown_table tbody tr').length == 0){
		                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
		                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
		                                    </div>\
		                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
						$('#kt_product_breakdown_table > tbody').empty();	
					}
				});
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
				KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_stocks');
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
					 $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Trans #: "+element.attr('data-trans'),
			                          text: "You wont be able to revert this!",
			                          icon: "warning",
			                          showCancelButton: true,
			                          confirmButtonText: "Yes, proceed!",
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      }).then(function(result) {
			                          if (result.value){
			                              let id = element.attr('data-id');
			                              let status = element.attr('data-status');
								 	let thisUrl = 'update_controller/Update_Salesorder_Stocks_Accounting';
									_ajaxloader(thisUrl,"POST",{id:id,status:status},"Update_Salesorder_Stocks_Accounting");
			                          } 
			                      });
			            });
					 $("body").delegate('.btn-cancelled','click',function(e){
					 	   e.preventDefault();
			                  e.stopImmediatePropagation(); 
			                  let element=$(this);
			                  Swal.fire({
			                    title:'Reason to Cancel',
			                    input: 'textarea',
			                    heightAuto: true,
			                    // inputLabel: 'Remarks',
			                    inputPlaceholder: 'Enter your remarks',
			                    confirmButtonText: 'Submit',
			                    // inputValue: my_reviews,
			                    // onOpen: get_pc_options(classni),
			                    inputAttributes: {
			                      maxlength: 500,
			                      rows: 10
			                    },
			                    showCancelButton: true,
			                    inputValidator: (value) => {
			                      return new Promise((resolve) => {
			                        if (value.length >=1){
			                          resolve();
			                        }else{
			                          resolve('Please enter your remarks.')
			                        }
			                      })
			                    }
			                  }).then(function(result){
			                      if(result.isConfirmed == true){
			                        if(result.value){
			                          	let id = element.attr('data-id');
			                              let status = element.attr('data-status');
								 	let thisUrl = 'update_controller/Update_Salesorder_Stocks_Accounting';
									_ajaxloader(thisUrl,"POST",{id:id,status:status,remarks:result.value},"Update_Salesorder_Stocks_Accounting");
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
					 $('body').delegate('.btn-remarks','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Trans #: "+element.attr('data-trans')+"</br>Reason to Remarks",
			                          text: element.attr('data-remarks'),
			                          showConfirmButton:false,
			                          showCancelButton: false,
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      })
			            });

				})
				break;
			}
			case "data-salesorder-project":{
				KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_project');
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
				     $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Trans #: "+element.attr('data-trans'),
			                          text: "You wont be able to revert this!",
			                          icon: "warning",
			                          showCancelButton: true,
			                          confirmButtonText: "Yes, proceed!",
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      }).then(function(result) {
			                          if (result.value){
			                              let id = element.attr('data-id');
			                              let status = element.attr('data-status');
								 	let thisUrl = 'update_controller/Update_Salesorder_Project_Accounting';
									_ajaxloader(thisUrl,"POST",{id:id,status:status},"Update_Salesorder_Project_Accounting");
			                          } 
			                      });
			            });
				     $("body").delegate('.btn-cancelled','click',function(e){
					 	   e.preventDefault();
			                  e.stopImmediatePropagation(); 
			                  let element=$(this);
			                  Swal.fire({
			                    title:'Reason to Cancel',
			                    input: 'textarea',
			                    heightAuto: true,
			                    // inputLabel: 'Remarks',
			                    inputPlaceholder: 'Enter your remarks',
			                    confirmButtonText: 'Submit',
			                    // inputValue: my_reviews,
			                    // onOpen: get_pc_options(classni),
			                    inputAttributes: {
			                      maxlength: 500,
			                      rows: 10
			                    },
			                    showCancelButton: true,
			                    inputValidator: (value) => {
			                      return new Promise((resolve) => {
			                        if (value.length >=1){
			                          resolve();
			                        }else{
			                          resolve('Please enter your remarks.')
			                        }
			                      })
			                    }
			                  }).then(function(result){
			                      if(result.isConfirmed == true){
			                        if(result.value){
			                          	let id = element.attr('data-id');
			                              let status = element.attr('data-status');
								 	let thisUrl = 'update_controller/Update_Salesorder_Project_Accounting';
									_ajaxloader(thisUrl,"POST",{id:id,status:status,remarks:result.value},"Update_Salesorder_Project_Accounting");
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
					 $('body').delegate('.btn-remarks','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Trans #: "+element.attr('data-trans')+"</br>Reason to Remarks",
			                          text: element.attr('data-remarks'),
			                          showConfirmButton:false,
			                          showCancelButton: false,
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      })
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
			case "report-collection":{
					$(document).on('click','#search',function(e){
				   		var action = $(this).attr('data-action');
						let month = $('select[name=month]').val();
						let year  = $('select[name=year]').val();
						let val = {month:month,year:year};
						switch(action){
							case"daily":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Daily';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Daily");
								break;}
							case "weekly":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Weekly';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Weekly");
								break;}
							case "monthly":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Monthly';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Monthly");
								break;}
							case "yearly":{
								let thisUrl = 'datatable_controller/Account_Report_Collection_Yearly';
								_ajaxloader(thisUrl,"POST",val,"Account_Report_Collection_Yearly");		
								break;}
						}		
					});
 					 $(document).on('click','#action',function(e){
 						var action = $(this).attr('data-action');
 						$('#search').attr('data-action',action);
 						$('#search').trigger('click');
 					  }); 
					$('#action').trigger('click');  
				break;
			}
			case "reports-sale-order":{
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
			case "reports-cashfund":{
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
			case "report-project-monitoring":{
				KTFormControlsAccounting.init('report_project_monitoring');
				$('.btn-edit-materials').attr('disabled',true);
				$(document).ready(function(){
					_initCurrency_format('.amount');
					_ajaxrequest(_constructBlockUi('blockPage', false, 'Joborder...'),_constructForm(['project-monitoring', 'fetch_project_monitoring_joborder',false]));
					$(document).on('click','.btn-search',function(e){
					 	e.preventDefault();
					 	let element = $('select[name=joborder]');
					 	_ajaxrequest(_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['project-monitoring', 'fetch_project_monitoring',element.val()]));
					});
					$(document).on('click','.view-details',function(e){
					 	e.preventDefault();
						$('#view-details').modal('show');
					});
					$(document).on('click','.btn-edit-materials',function(e){
					 	e.preventDefault();
					 	let element = $(this);
					 	let id = element.attr('data-id');
					 	let type =element.attr('data-type');
					 	_ajaxrequest(_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['project-monitoring', 'fetch_project_monitoring_type',id,type]));
					});
					$(document).on('change','.item',function(e){
					 	e.preventDefault();
					 	e.stopImmediatePropagation();
					 	let element = $(this);
					 	let id =element.val();
					 	_ajaxrequest(_constructBlockUi('blockPage', false, 'Materials...'),_constructForm(['project-monitoring','fetch_project_monitoring_material',id]));
					});
				})
				break;
			}
			case "reports-cashposition":{
				$(document).ready(function(){
					$('.btn-add-cashposition').on('click',function(e) {
						e.preventDefault();
						$('#formIncome').modal('show');
						_ajaxloaderOption('option_controller/cashpostion_category','POST',false,'cashpostion_category');
					});
					$('.btn-list-category').on('click',function(e) {
						e.preventDefault();
						KTDatatablesDataSourceAjaxClient.init('tbl_cashposition_category');
						$('#category-list').modal('show');
					});
					$(".btn-add-category").on('click',function(e){
					 	   e.preventDefault();
			                  Swal.fire({
			                    title:'Name of category',
			                    input: 'text',
			                    heightAuto: true,
			                    inputPlaceholder: 'Enter your name',
			                    confirmButtonText: 'Submit',
			                    showCancelButton: true,
			                    inputValidator: (value) => {
			                      return new Promise((resolve) => {
			                        if (value.length >=1){
			                          resolve();
			                        }else{
			                          resolve('Please Enter Name of Category')
			                        }
			                      })
			                    }
			                  }).then(function(result){
			                      if(result.isConfirmed == true){
			                        if(result.value){
								 	let thisUrl = 'create_controller/Create_Cashposition_Category';
									_ajaxloader(thisUrl,"POST",{name:result.value},"Create_Cashposition_Category");
			                        }else{
			                           swal.fire('Opss', 'Please Enter Name of Category', 'info');
			                        }
			                      }
			                  });
			              })
					$('body').delegate("#view-update-form",'click',function(e){
					 	   e.preventDefault();
					 	   e.stopImmediatePropagation();
					 	   let element=$(this);
			                  Swal.fire({
			                    title:'<span id="cat_id" data-id="'+element.attr('data-id')+'">Name of category</span>',
			                    input: 'text',
			                    inputValue: element.attr('data-name'),
			                    heightAuto: true,
			                    inputPlaceholder: 'Enter your name',
			                    confirmButtonText: 'Submit',
			                    showCancelButton: true,
			                    inputValidator: (value) => {
			                      return new Promise((resolve) => {
			                        if (value.length >=1){
			                          resolve();
			                        }else{
			                          resolve('Please Enter Name of Category')
			                        }
			                      })
			                    }
			                  }).then(function(result){
			                      if(result.isConfirmed == true){
			                        if(result.value){
								 	let thisUrl = 'update_controller/Update_Cashposition_Category';
									_ajaxloader(thisUrl,"POST",{id:$('#cat_id').attr('data-id'),name:result.value},"Update_Cashposition_Category");
			                        }else{
			                           swal.fire('Opss', 'Please Enter Name of Category', 'info');
			                        }
			                      }else{
			                      	 $('#category-list').modal('show');
			                      }
			                  });
			                  $('#category-list').modal('hide');
			              })
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
								 _initToast('success','Save Changes');
								 $('#search').trigger('click');
							  });
							  $(document).on('click',tbl_id+' div.form-group > div > div > .btn-cancelled', function(e){
							  		e.preventDefault(); 
								 	_initToast('info','Nothing Changes');
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
								    _initToast('success','Save Changes');
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
						         _initToast('error','Remove Item');
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
				         _initToast('success','Saved Changes');
				          $('#search').trigger('click');
				       });
				       $(document).on('change','.select-category', function(e){
				       	let id = $(this).attr('data-id');
				       	let data = $(this).val();
				        	let val = {id:id,data:data,action:'category'};
				         _ajaxloaderOption('update_controller/Update_Cash_Position',"POST",val,false);
				         _initToast('success','Saved Changes');
				       });

				})
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
					var tal = _formatnumbercommat(response.price);
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
		  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
		  		    container.empty();
		  		    let total=0;
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount+'</td>\
		  		    					  </tr>');
		  		    		total+=parseFloat(response.material[i].amount);
		  		    }
		  		     $('.total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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
		  		    $('.total_petty').text(response.total_petty);
		  		    $('.actual_change').text(response.total_change);
		  		    $('.total_refund').text(response.total_refund);
		  		    let container = $('#tbl_purchased_received_modal > tbody:last-child');
		  		    container.empty();
		  		    let total =0;
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].supplier+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].payment+'</td>\
		  		    					  </tr>');
						total+=parseFloat(response.material[i].amount);
		  		    }
		  		    $('.total-received').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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
		  		    let total = 0;
		  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount+'</td>\
		  		    					  </tr>');
		  		    		total+=parseFloat(response.material[i].amount);
		  		    }
		  		     $('.total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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
		  		    $('.total_petty').text(response.total_petty);
		  		    $('.actual_change').text(response.total_change);
		  		    $('.total_refund').text(response.total_refund);
		  		    let container = $('#tbl_purchased_received_modal > tbody:last-child');
		  		    container.empty();
		  		    let total = 0;
		  		    for(let i=0;i<response.material.length;i++){
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].supplier+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].payment+'</td>\
		  		    					  </tr>');
		  		    		total+=parseFloat(response.material[i].amount);
		  		    }
		  		    $('.total-received').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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
	  	
	  		case "Account_Report_Collection_Daily":{
	  			let container = $('#tbl_collection_daily > tbody').empty();
	  			let total_gross = 0;
	  			let total_vat = 0;
	  			let total_amount = 0;
	  			if(response){
	             	for(var i=0;i<response.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	             				+'<td class=""><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response[i].customer+'</span><span class="text-muted font-weight-bold" id="bank">'+response[i].bank+'</span></td>'
	             				+'<td class="">'+response[i].so_no+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
						+'</tr>');
	             		total_gross += parseFloat(response[i].gross);
	             		total_vat += parseFloat(response[i].vat);	
	             		total_amount += parseFloat(response[i].amount);		
					}
				}else{
					container.append('<tr><td class="text-center font-size-lg" colspan="6">No Collection Available</td></tr>');
				}
				$('#tbl_collection_daily > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center" colspan="3">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');	
	  			break;
	  		}
	  		case "Account_Report_Collection_Weekly":{
	  			let container = $('#tbl_collection_weekly > tbody').empty();
	  			let total_gross = 0;
	  			let total_vat = 0;
	  			let total_amount = 0;
	  			if(response){
	  				for(var i=0;i<response.length;i++){
	             		container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
						+'</tr>');
	             		total_gross += parseFloat(response[i].gross);
	             		total_vat += parseFloat(response[i].vat);	
	             		total_amount += parseFloat(response[i].amount);		
					}
	  			}else{
	  				container.append('<tr><td class="text-center font-size-lg" colspan="4">No Collection Available</td></tr>');
	  			}
				$('#tbl_collection_weekly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Collection_Monthly":{
	  			let container = $('#tbl_collection_monthly > tbody').empty();
	  			let total_gross = 0;
	  			let total_vat = 0;
	  			let total_amount = 0;
	  			if(response){
	  				for(var i=0;i<response.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
						+'</tr>');
	             		total_gross += parseFloat(response[i].gross);
	             		total_vat += parseFloat(response[i].vat);	
	             		total_amount += parseFloat(response[i].amount);		
					}
	  			}else{
	  				container.append('<tr><td class="text-center font-size-lg" colspan="4">No Collection Available</td></tr>');
	  			}
				$('#tbl_collection_monthly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Collection_Yearly":{
	  			let container = $('#tbl_collection_yearly > tbody').empty();
	  			let total_gross = 0;
	  			let total_vat = 0;
	  			let total_amount = 0;
	  			if(response){
	  				for(var i=0;i<response.length;i++){
	             			container.append('<tr>'
	             				+'<td class="text-success">'+response[i].date_created+'</td>'
	       						+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
						+'</tr>');
	             		total_gross += parseFloat(response[i].gross);
	             		total_vat += parseFloat(response[i].vat);	
	             		total_amount += parseFloat(response[i].amount);		
					}	
	  			}else{
	  				container.append('<tr><td class="text-center font-size-lg" colspan="4">No Collection Available</td></tr>');
	  			}
				$('#tbl_collection_yearly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		
	  		case "Account_Report_Salesorder_Daily":{
	  			let container = $('#tbl_salesorder_daily > tbody');
	  			container.empty();
	  			var total_downpayment= 0; 
				var total_subtotal = 0; 
				var total_discount = 0; 
				var total_vat= 0; 
				var total_shipping_fee= 0; 
				var total_amount_due = 0; 
				if(response){
					for(var i=0;i<response.length;i++){
             			container.append('<tr>'
             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
             				+'<td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">'+response[i].customer+'</span></td>'
             				+'<td>'+response[i].so_no+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].downpayment)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].subtotal)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].discount)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].shipping_fee)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount_due)+'</td>'
					+'</tr>');
             			total_downpayment += parseFloat(response[i].downpayment);
	             		total_subtotal += parseFloat(response[i].subtotal);
	             		total_discount += parseFloat(response[i].discount);
	             		total_vat += parseFloat(response[i].vat);
	             		total_shipping_fee += parseFloat(response[i].shipping_fee);
	             		total_amount_due += parseFloat(response[i].amount_due);	
					}
				}else{
					container.append('<tr><td class="text-center font-size-lg" colspan="9">No Sales Order Available</td></tr>');
				}
				$('#tbl_salesorder_daily > tfoot').empty().append('<tr class="table-success">'
             				+'<td class="text-center" colspan="3">TOTAL</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_downpayment)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_subtotal)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_discount)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_shipping_fee)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_amount_due)+'</td>'
					+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Weekly":{
	  			let container = $('#tbl_salesorder_weekly > tbody');
	  			container.empty();
	  			let total_downpayment_weekly=0;
	  			let total_subtotal_weekly=0;
	  			let total_discount_weekly=0;
	  			let total_vat_weekly=0;
	  			let total_shipping_fee_weekly=0;
	  			let total_amount_due_weekly=0;
	  			if(response){
		          for(var i=0;i<response.length;i++){
             			container.append('<tr>'
             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].downpayment)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].subtotal)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].discount)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].shipping_fee)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount_due)+'</td>'
					+'</tr>');
             			total_downpayment_weekly += parseFloat(response[i].downpayment);
	             		total_subtotal_weekly += parseFloat(response[i].subtotal);
	             		total_discount_weekly += parseFloat(response[i].discount);
	             		total_vat_weekly += parseFloat(response[i].vat);
	             		total_shipping_fee_weekly += parseFloat(response[i].shipping_fee);
	             		total_amount_due_weekly += parseFloat(response[i].amount_due);
					}
				}else{
					container.append('<tr><td class="text-center font-size-lg" colspan="7">No Sales Order Available</td></tr>');
				}
				$('#tbl_salesorder_weekly > tfoot').empty().append('<tr class="table-success">'
             				+'<td class="text-center">TOTAL</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_downpayment_weekly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_subtotal_weekly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_discount_weekly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_vat_weekly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_shipping_fee_weekly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_amount_due_weekly)+'</td>'
					+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Monthly":{
	  			let container = $('#tbl_salesorder_monthly > tbody');
	  			container.empty();
	  			let total_downpayment_monthly=0;
	  			let total_subtotal_monthly=0;
	  			let total_discount_monthly=0;
	  			let total_vat_monthly=0;
	  			let total_shipping_fee_monthly=0;
	  			let total_amount_due_monthly=0;
	  			if(response){
		           for(var i=0;i<response.length;i++){
	             		container.append('<tr>'
	             			+'<td class="font-weight-bolder text-success ml-3">'+response[i].date_created+'</td>'
	             			+'<td class="text-right">'+_formatnumbercommat(response[i].downpayment)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].subtotal)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].discount)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].shipping_fee)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount_due)+'</td>'
						+'</tr>');
						total_downpayment_monthly += parseFloat(response[i].downpayment);
	             		total_subtotal_monthly += parseFloat(response[i].subtotal);
	             		total_discount_monthly += parseFloat(response[i].discount);
	             		total_vat_monthly += parseFloat(response[i].vat);
	             		total_shipping_fee_monthly += parseFloat(response[i].shipping_fee);
	             		total_amount_due_monthly += parseFloat(response[i].amount_due);
					}
				}else{
					container.append('<tr><td class="text-center font-size-lg" colspan="7">No Sales Order Available</td></tr>');
				}
					$('#tbl_salesorder_monthly > tfoot').empty().append('<tr class="table-success">'
             				+'<td class="text-center">TOTAL</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_downpayment_monthly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_subtotal_monthly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_discount_monthly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_vat_monthly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_shipping_fee_monthly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_amount_due_monthly)+'</td>'
					+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Salesorder_Yearly":{
	  			let container = $('#tbl_salesorder_yearly > tbody');
	  			container.empty();
	  			let total_downpayment_yearly=0;
	  			let total_subtotal_yearly=0;
	  			let total_discount_yearly=0;
	  			let total_vat_yearly=0;
	  			let total_shipping_fee_yearly=0;
	  			let total_amount_due_yearly=0;
	  			if(response){
	             	for(var i=0;i<response.length;i++){
             			container.append('<tr>'
             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].downpayment)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].subtotal)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].discount)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].shipping_fee)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount_due)+'</td>'
					+'</tr>');
             			total_downpayment_yearly += parseFloat(response[i].downpayment);
	             		total_subtotal_yearly += parseFloat(response[i].subtotal);
	             		total_discount_yearly += parseFloat(response[i].discount);
	             		total_vat_yearly += parseFloat(response[i].vat);
	             		total_shipping_fee_yearly += parseFloat(response[i].shipping_fee);
	             		total_amount_due_yearly += parseFloat(response[i].amount_due);
					}
				}else{
					container.append('<tr><td class="text-center font-size-lg" colspan="7">No Sales Order Available</td></tr>');
				}	
				$('#tbl_salesorder_yearly > tfoot').empty().append('<tr class="table-success">'
             				+'<td class="text-center">TOTAL</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_downpayment_yearly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_subtotal_yearly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_discount_yearly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_vat_yearly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_shipping_fee_yearly)+'</td>'
             				+'<td class="text-right">'+_formatnumbercommat(total_amount_due_yearly)+'</td>'
					+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Project_Daily":{
	  				let container = $('#tbl_cashfund_daily > tbody').empty();
	  				let total_pettycash = 0;
	  				let total_change = 0;
	  				let total_refund = 0;
	  				let total_gross = 0;
	  				let total_vat = 0;
	  				let total_amount = 0;
	  				if(response){
		             	for(var i=0;i<response.length;i++){
		             			container.append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
		             				+'<td><span class="text-dark-75 font-weight-bolder font-size-lg">'+response[i].fund_no+'</span></td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].pettycash)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].change)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].refund)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</span></td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
							+'</tr>');
		             		total_pettycash += parseFloat(response[i].pettycash);
		             		total_change += parseFloat(response[i].change);
		             		total_refund += parseFloat(response[i].refund);
		             		total_gross += parseFloat(response[i].gross);
		             		total_vat += parseFloat(response[i].vat);
		             		total_amount += parseFloat(response[i].amount);
	  					}
					}else{
						container.append('<tr><td class="text-center font-size-lg" colspan="9">No Cash Fund Report Available</td></tr>');
					}
					$('#tbl_cashfund_daily > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center" colspan="2">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_pettycash)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_change)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_refund)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Project_Weekly":{
	  				let container = $('#tbl_cashfund_weekly > tbody').empty();
	  				let total_pettycash = 0;
	  				let total_change = 0;
	  				let total_refund = 0;
	  				let total_gross = 0;
	  				let total_vat = 0;
	  				let total_amount = 0;
	  				if(response){
		             for(var i=0;i<response.length;i++){
		             			container.append('<tr>'
		             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].pettycash)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].change)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].refund)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
							+'</tr>');
		             		total_pettycash += parseFloat(response[i].pettycash);
		             		total_change += parseFloat(response[i].change);
		             		total_refund += parseFloat(response[i].refund);
		             		total_gross += parseFloat(response[i].gross);
		             		total_vat += parseFloat(response[i].vat);
		             		total_amount += parseFloat(response[i].amount);
	  				}
					}else{
						container.append('<tr><td class="text-center font-size-lg" colspan="9">No Cash Fund Report Available</td></tr>');
					}
					$('#tbl_cashfund_weekly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_pettycash)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_change)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_refund)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Project_Monthly":{
	  				let container = $('#tbl_cashfund_monthly > tbody').empty();
	  				let total_pettycash = 0;
	  				let total_change = 0;
	  				let total_refund = 0;
	  				let total_gross = 0;
	  				let total_vat = 0;
	  				let total_amount = 0;
	  				if(response){
		            for(var i=0;i<response.length;i++){
		             			container.append('<tr >'
		             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].pettycash)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].change)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].refund)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
		             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
							+'</tr>');
		             		total_pettycash += parseFloat(response[i].pettycash);
		             		total_change += parseFloat(response[i].change);
		             		total_refund += parseFloat(response[i].refund);
		             		total_gross += parseFloat(response[i].gross);
		             		total_vat += parseFloat(response[i].vat);
		             		total_amount += parseFloat(response[i].amount);
					}
					}else{
						container.append('<tr><td class="text-center font-size-lg" colspan="9">No Cash Fund Report Available</td></tr>');
					}
					$('#tbl_cashfund_monthly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_pettycash)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_change)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_refund)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
	  			break;
	  		}
	  		case "Account_Report_Project_Yearly":{
	  				let container = $('#tbl_cashfund_yearly > tbody').empty();
	  				let total_pettycash =0;
	  				let total_change = 0;
	  				let total_refund = 0;
	  				let total_gross = 0;
	  				let total_vat = 0;
	  				let total_amount = 0;
	  				if(response){
		             	for(var i=0;i<response.length;i++){
			             	container.append('<tr>'
			             				+'<td class="font-weight-bolder text-success">'+response[i].date_created+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].pettycash)+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].change)+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].refund)+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].gross)+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].vat)+'</td>'
			             				+'<td class="text-right">'+_formatnumbercommat(response[i].amount)+'</td>'
								+'</tr>');
			             		total_pettycash += parseFloat(response[i].pettycash);
			             		total_change += parseFloat(response[i].change);
			             		total_refund += parseFloat(response[i].refund);
			             		total_gross += parseFloat(response[i].gross);
			             		total_vat += parseFloat(response[i].vat);
			             		total_amount += parseFloat(response[i].amount);
						}
					}else{
						container.append('<tr><td class="text-center font-size-lg" colspan="9">No Cash Fund Report Available</td></tr>');
					}
					$('#tbl_cashfund_yearly > tfoot').empty().append('<tr class="table-success">'
	             				+'<td class="text-center">TOTAL</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_pettycash)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_change)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_refund)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_gross)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_vat)+'</td>'
	             				+'<td class="text-right">'+_formatnumbercommat(total_amount)+'</td>'
						+'</tr>');
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
	  		$(document).ready( function(){
	  		   let categories = $('.categories');
	  		   let html_cat ="";
	  		   if(response.categories){
	  		   	for(let i=0;i<response.categories.length;i++){
	  		   		html_cat += '<option value="'+response.categories[i].id+'">'+response.categories[i].name+'</option>';
	  		   	}
	  		   	categories.append(html_cat);
	  		   }	
	  		});
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
				  		    		   <select class="form-control form-control-sm categories select-category" data-count="'+count+'" name="cat_id_update" data-id="'+response.week1_type2[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week1_type1[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week2_type2[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week2_type1[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week3_type2[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week3_type1[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week4_type2[i].id+'">\
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
				  		    		   <select class="form-control form-control-sm select-category categories" data-count="'+count+'" name="cat_id_update" data-id="'+response.week4_type1[i].id+'">\
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
		             			 <td>'+response.sales.jan+'</td>\
		             			 <td>'+response.sales.feb+'</td>\
		             			 <td>'+response.sales.march+'</td>\
		             			 <td>'+response.sales.apr+'</td>\
		             			 <td>'+response.sales.may+'</td>\
		             			 <td>'+response.sales.june+'</td>\
		             			 <td>'+response.sales.july+'</td>\
		             			 <td>'+response.sales.aug+'</td>\
		             			 <td>'+response.sales.sept+'</td>\
		             			 <td>'+response.sales.oct+'</td>\
		             			 <td>'+response.sales.nov+'</td>\
		             			 <td>'+response.sales.dec+'</td>\
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
				_initnotificationupdate();
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
			_initnotificationupdate();
	  		break;
	  	}
	  	case "Modal_Supplier_Item_Update_View":{
	  		_initCurrency_format('.amount');
	  		$('select[name=item]').val(response.item_no).change();
	  		$('select[name=item]').attr('data-id',response.id);
	  		$('input[name=amount]').val(response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	  		_initnotificationupdate();
	  		break;
	  	}
	  	case "Update_Salesorder_Stocks_Accounting":{
	  		if(response != false){
	  			_initToast(response.type,response.message);
	  			KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_stocks');
	  		}else{

	  		}
	  		_initnotificationupdate();
	  		break;
	  	}
	  	case "Update_Salesorder_Project_Accounting":{
	  		if(response != false){
	  			_initToast(response.type,response.message);
	  			KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_project');
	  		}else{

	  		}
	  		_initnotificationupdate();
	  		break;
	  	}
	  	case "Modal_Other_Purchase_View":{
	  		if(!response == false){
	  				let total =0;
	  			    $('.cash_fund').text(response.info.request_no);
		  		    $('.requestor').text(response.info.requestor);
		  		    $('.date_created').text(response.info.date_created);
		  		    $('input[name=cash_fund]').val("");
		  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
		  		    container.empty();
		  		    for(let i=0;i<response.material.length;i++){
		  		    		total +=parseFloat(response.material[i].total);
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].qty+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>\
		  		    					  </tr>');
		  		    		
		  		    }
		  		        $('.total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	  		    		$('.purchase-button').show();
	  		    		$('.purchase-cash-fund').hide();
	  		    		if(response.fund){
	  		    			$('.total_fund').text(response.fund.pettycash.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	  		    		}
	  		    		$('.btn-request-submit').text('Submit').attr('data-status',1);
		  		    	if(response.info.status == 'COMPLETED'){
		  		    		$('.purchase-button').hide();
		  		    		$('.purchase-cash-fund').show();
		  		    		$('.status').text('Complete').removeClass('text-primary text-warning').addClass('text-success');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-primary').addClass('separator-success');
		  		    	}else if(response.info.status == 'APPROVED'){
		  		    		$('.status').text('Approved').removeClass('text-warning text-success').addClass('text-primary');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-warning separator-success').addClass('separator-primary');
		  		    		$('input[name=cash_fund]').val(response.fund.pettycash.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		  		    		$('.btn-request-submit').text('Update').attr('data-status',2);
		  		    	}else{
		  		    		$('.status').text('Request').removeClass('text-primary text-success').addClass('text-warning');
		  		    		$('#separator-status-1,#separator-status-2').removeClass('separator-success separator-primary').addClass('separator-warning');
		  		    	}
		  		    
		  		    $('#view-purchased-request').modal('show');
		  		}
	  		break;
	  	}
	  	case "Modal_Other_Purchase_View_Received_Accounting":{
	  		if(!response == false){
	  				_initCurrency_format(".amount");
	  			    $('.cash_fund_r').text(response.info.request_no);
		  		    $('.requestor_r').text(response.info.requestor);
		  		    $('.date_created_r').text(response.info.date_created);
		  		    $('.cf_no').text(response.info.fund_no);
		  		    $('.total_petty').text(response.fund.pettycash);
		  		    $('.actual_change').text(response.fund.actual_change);
		  		    $('.total_refund').text(response.fund.refund);
		  		    let container = $('#tbl_purchased_received_modal > tbody:last-child');
		  		    container.empty();
		  		    let total=0;
		  		    let terms="";
		  		    for(let i=0;i<response.material.length;i++){
		  		    	if(response.material[i].payment ==1){terms ='<span style="width: 112px;"><span class="label label-primary label-dot"></span><span class="font-weight-bold text-primary"> Cash</span></span>';
                    	}else if(response.material[i].payment == 2){terms ='<span style="width: 112px;"><span class="label label-warning label-dot"></span><span class="font-weight-bold text-warning"> Terms</span>';} 
		  		    		container.append('<tr>\
		  		    					  	 <td>'+response.material[i].item+'</td>\
		  		    					  	 <td class="text-center">'+response.material[i].quantity+'</td>\
		  		    					  	 <td class="text-right">₱ '+response.material[i].amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>\
		  		    					  	 <td class="text-right">'+response.material[i].name+'</td>\
		  		    					  	 <td class="text-center">'+terms+'</td>\
		  		    					  </tr>');
		  		    		total +=parseFloat(response.material[i].amount);

		  		    }
		  		    $('.total-received').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		  		     $('.purchased-received-input').show();
	  		    		$('.purchased-received-hide').hide();
		  		    	if(response.info.a_status == 'COMPLETED'){
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
	  	case "Update_Cashposition_Category":
	  	case "Create_Cashposition_Category":{
	  		_initToast(response.type,response.message);
	  		if(response.type == 'success'){
	  			KTDatatablesDataSourceAjaxClient.init('tbl_cashposition_category');
	  			$('#category-list').modal('show');
	  		}
	  		break;
	  	}
	 
	  }
	}
	var _construct = async function(response, type, element, object){
		switch(type){
		 case "fetch_project_monitoring_joborder":{
		 	let container = $('#joborder');
			container.empty();
			if(response != false){
			   for(let i=0;i<response.length;i++){
                  	  	  container.append('<option value="'+response[i].id+'">'+response[i].production_no+'</option>').addClass('selectpicker').attr('data-live-search', 'true').selectpicker('refresh');
                  }	
			}
		 	break;
		 }
		 case "fetch_project_monitoring_type":{
		 	$('#view-materials').on('show.bs.modal', function () {
			   	let container = $('.item');
				container.empty();
				if(response != false){
				   container.append('<option value="">SELECT MATERIAL</option>');
				   for(let i=0;i<response.length;i++){
	                  	  	  container.append('<option value="'+response[i].id+'">'+response[i].item+'</option>');
	                  }	
				}
				container.select2({
				   placeholder: "SELECT MATERIAL",
				   width: '100%'
				});
				$('.text-quantity-costing').val("");
				$('.text-amount-costing').val("");
				let trans = $('.text-trans').text();
				$('.text-trans-material').text(trans);
			})
			$('#view-materials').modal('show');
		 	break;
		 }
		 case "fetch_project_monitoring_material":{
		 	let cost = (response.cost !=0)?response.cost:" ";
		 	let total_qty = (response.total_qty !=0)?response.total_qty:" ";
		 	$('.text-material-id').val(response.id);
		 	$('.text-quantity-costing').val(total_qty);
		 	$('.text-amount-costing').val(cost);
		 	break;
		 }
           case "fetch_project_monitoring":{
           			let cost=0;
		           	let amount_costing=0;
		           	let amount_actual=0;
		           	let total_cost_framing = 0;
		           	let total_amount_costing_framing =0;
		           	let total_amount_actual_framing=0;
		           	let total_cost_mechanism = 0;
		           	let total_amount_costing_mechanism =0;
		           	let total_amount_actual_mechanism=0;
		           	let total_cost_finishing = 0;
		           	let total_amount_costing_finishing =0;
		           	let total_amount_actual_finishing=0;
		           	let total_cost_sulihiya= 0;
		           	let total_amount_costing_sulihiya=0;
		           	let total_amount_actual_sulihiya=0;
		           	let total_cost_upholstery= 0;
		           	let total_amount_costing_upholstery=0;
		           	let total_amount_actual_upholstery=0;
		           	let total_cost_others= 0;
		           	let total_amount_costing_others=0;
		           	let total_amount_actual_others=0;
	           	if(response.info){
		           	let amount = (response.info.amount != 0)?_formatnumbercommat(response.info.amount):"";
		           	let labor = (response.info.labor!= 0)?_formatnumbercommat(response.info.labor):"";
	           		$('.btn-edit-materials').attr('data-id',response.id);
	           		$('.text-trans').text(response.info.production_no).attr('data-id',response.id);
		  			$('.text-name').val(response.info.customer);
		  			$('.text-address').val(response.info.address);
		  			$('.text-amount').val(amount);
		  			$('.text-labor').val(labor);
		  			$('.text-start').val(response.info.start_date);
		  			$('.text-end').val(response.info.due_date);
		  			$('.text-start-name').val(response.info.start_date_name);
		  			$('.text-end-name').val(response.info.due_date_name);
		  			$('.btn-edit').removeAttr('disabled');
		  			$('.btn-search').attr('data-id',response.info.id);
	           	}
	  			let framing = $('#tbl_framing > tbody').empty();
	  			if(response.framing){
	  				$('.btn-edit-materials[data-type=1]').attr('disabled',false);
		  			for(var i=0;i<response.framing.length;i++){
		  			cost = _formatnumbercommat(response.framing[i].cost);
		  			amount_costing = _formatnumbercommat(response.framing[i].amount_costing);
		  			amount_actual = _formatnumbercommat(response.framing[i].amount_actual);
						framing.append('<tr>\
		             				<td class="font-size-lg">'+response.framing[i].item_name+'</td>\
		             				<td class="text-right">'+response.framing[i].total_qty+'</td>\
		             				<td class="text-right">'+response.framing[i].item_unit+'</td>\
		             				<td class="text-right">'+response.framing[i].production_quantity+'</td>\
		             				<td class="text-right">'+response.framing[i].item_unit+'</td>\
		             				<td class="text-right">'+cost+'</td>\
		             				<td class="text-right">'+amount_costing+'</td>\
		             				<td class="text-right">'+amount_actual+'</td>\
							</tr>');
					total_cost_framing +=parseFloat(response.framing[i].cost);
		  			total_amount_costing_framing +=parseFloat(response.framing[i].amount_costing);
		  			total_amount_actual_framing +=parseFloat(response.framing[i].amount_actual);
					}
					framing.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_framing)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_framing)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_framing)+'</td>\
						</tr>');
				}else{
					$('#tbl_framing > tbody').empty().append('<tr>\<td colspan="8" rows="4" class="text-center">NO DATA</td></tr>');
				}
				let mechanism = $('#tbl_mechanism > tbody').empty();
				if(response.mechanism){
					$('.btn-edit-materials[data-type=2]').attr('disabled',false);
		  			for(var i=0;i<response.mechanism.length;i++){
		  			cost = _formatnumbercommat(response.mechanism[i].cost);
		  			amount_costing = _formatnumbercommat(response.mechanism[i].amount_costing);
		  			amount_actual = _formatnumbercommat(response.mechanism[i].amount_actual);
	             			mechanism.append('<tr>'
	             				+'<td class="font-size-lg">'+response.mechanism[i].item_name+'</td>'
	             				+'<td class="text-right">'+response.mechanism[i].total_qty+'</td>'
	             				+'<td class="text-right">'+response.mechanism[i].item_unit+'</td>'
	             				+'<td class="text-right">'+response.mechanism[i].production_quantity+'</td>'
	             				+'<td class="text-right">'+response.mechanism[i].item_unit+'</td>'
	             				+'<td class="text-right">'+cost+'</td>'
	             				+'<td class="text-right">'+amount_costing+'</td>'
	             				+'<td class="text-right">'+amount_actual+'</td>'
						+'</tr>');
	             	total_cost_mechanism +=parseFloat(response.mechanism[i].cost);
		  			total_amount_costing_mechanism +=parseFloat(response.mechanism[i].amount_costing);
		  			total_amount_actual_mechanism +=parseFloat(response.mechanism[i].amount_actual);
					}
					mechanism.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_mechanism)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_mechanism)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_mechanism)+'</td>\
							</tr>');
				}else{
					$('#tbl_mechanism > tbody:last-child').empty().append('<tr><td colspan="8" class="text-center">NO DATA</td></tr>');
				}
				let finishing = $('#tbl_finishing > tbody').empty();
				if(response.finishing){
					$('.btn-edit-materials[data-type=3]').attr('disabled',false);
		  			for(var i=0;i<response.finishing.length;i++){
		  			cost = _formatnumbercommat(response.finishing[i].cost);
		  			amount_costing = _formatnumbercommat(response.finishing[i].amount_costing);
		  			amount_actual = _formatnumbercommat(response.finishing[i].amount_actual);
		             			finishing.append('<tr>'
		             				+'<td class="font-size-lg">'+response.finishing[i].item_name+'</td>'
		             				+'<td class="text-right">'+response.finishing[i].total_qty+'</td>'
		             				+'<td class="text-right">'+response.finishing[i].item_unit+'</td>'
		             				+'<td class="text-right">'+response.finishing[i].production_quantity+'</td>'
		             				+'<td class="text-right">'+response.finishing[i].item_unit+'</td>'
		             				+'<td class="text-right">'+cost+'</td>'
		             				+'<td class="text-right">'+amount_costing+'</td>'
		             				+'<td class="text-right">'+amount_actual+'</td>'
							+'</tr>');
		             total_cost_finishing +=parseFloat(response.finishing[i].cost);
		  			 total_amount_costing_finishing +=parseFloat(response.finishing[i].amount_costing);
		  			 total_amount_actual_finishing +=parseFloat(response.finishing[i].amount_actual);
					}
					finishing.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_finishing)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_finishing)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_finishing)+'</td>\
							</tr>');
				}else{
					$('#tbl_finishing > tbody:last-child').empty().append('<tr><td colspan="8" class="text-center">NO DATA</td></tr>');
				}
				let sulihiya = $('#tbl_sulihiya > tbody').empty();
				if(response.sulihiya){
					$('.btn-edit-materials[data-type=4]').attr('disabled',false);
		  			for(var i=0;i<response.sulihiya.length;i++){
			  			cost = _formatnumbercommat(response.sulihiya[i].cost);
			  			amount_costing = _formatnumbercommat(response.sulihiya[i].amount_costing);
			  			amount_actual = _formatnumbercommat(response.sulihiya[i].amount_actual);
		             			sulihiya.append('<tr>'
		             				+'<td class="font-size-lg">'+response.sulihiya[i].item_name+'</td>'
		             				+'<td class="text-right">'+response.sulihiya[i].total_qty+'</td>'
		             				+'<td class="text-right">'+response.sulihiya[i].item_unit+'</td>'
		             				+'<td class="text-right">'+response.sulihiya[i].production_quantity+'</td>'
		             				+'<td class="text-right">'+response.sulihiya[i].item_unit+'</td>'
		             				+'<td class="text-right">'+cost+'</td>'
		             				+'<td class="text-right">'+amount_costing+'</td>'
		             				+'<td class="text-right">'+amount_actual+'</td>'
							+'</tr>');
		             	total_cost_sulihiya +=parseFloat(response.sulihiya[i].cost);
		  				total_amount_costing_sulihiya +=parseFloat(response.sulihiya[i].amount_costing);
		  				total_amount_actual_sulihiya +=parseFloat(response.sulihiya[i].amount_actual);
					}
					sulihiya.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_sulihiya)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_sulihiya)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_sulihiya)+'</td>\
							</tr>');
				}else{
					$('#tbl_sulihiya > tbody:last-child').empty().append('<tr>\<td colspan="8" class="text-center">NO DATA</td>\</tr>');
				}
				let upholstery = $('#tbl_upholstery > tbody').empty();
				if(response.upholstery){
					$('.btn-edit-materials[data-type=5]').attr('disabled',false);
		  			for(var i=0;i<response.upholstery.length;i++){
		  				cost = _formatnumbercommat(response.upholstery[i].cost);
			  			amount_costing = _formatnumbercommat(response.upholstery[i].amount_costing);
			  			amount_actual = _formatnumbercommat(response.upholstery[i].amount_actual);
		             			upholstery.append('<tr>'
		             				+'<td class="font-size-lg">'+response.upholstery[i].item_name+'</td>'
		             				+'<td class="text-right">'+response.upholstery[i].total_qty+'</td>'
		             				+'<td class="text-right">'+response.upholstery[i].item_unit+'</td>'
		             				+'<td class="text-right">'+response.upholstery[i].production_quantity+'</td>'
		             				+'<td class="text-right">'+response.upholstery[i].item_unit+'</td>'
		             				+'<td class="text-right">'+cost+'</td>'
		             				+'<td class="text-right">'+amount_costing+'</td>'
		             				+'<td class="text-right">'+amount_actual+'</td>'
							+'</tr>');
		             	total_cost_upholstery +=parseFloat(response.upholstery[i].cost);
		  				total_amount_costing_upholstery +=parseFloat(response.upholstery[i].amount_costing);
		  				total_amount_actual_upholstery +=parseFloat(response.upholstery[i].amount_actual);
					}
					upholstery.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_upholstery)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_upholstery)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_upholstery)+'</td>\
							</tr>');
				}else{
					$('#tbl_upholstery > tbody:last-child').empty().append('<tr><td colspan="8" class="text-center">NO DATA</td></tr>');
				}
				let other = $('#tbl_others > tbody').empty();
				if(response.others){
					$('.btn-edit-materials[data-type=6]').attr('disabled',false);
		  			for(var i=0;i<response.others.length;i++){
		  				cost = _formatnumbercommat(response.others[i].cost);
			  			amount_costing = _formatnumbercommat(response.others[i].amount_costing);
			  			amount_actual = _formatnumbercommat(response.others[i].amount_actual);
		             			other.append('<tr>'
		             				+'<td class="font-size-lg">'+response.others[i].item_name+'</td>'
		             				+'<td class="text-right">'+response.others[i].total_qty+'</td>'
		             				+'<td class="text-right">'+response.others[i].item_unit+'</td>'
		             				+'<td class="text-right">'+response.others[i].production_quantity+'</td>'
		             				+'<td class="text-right">'+response.others[i].item_unit+'</td>'
		             				+'<td class="text-right">'+cost+'</td>'
		             				+'<td class="text-right">'+amount_costing+'</td>'
		             				+'<td class="text-right">'+amount_actual+'</td>'
							+'</tr>');
		             	total_cost_others +=parseFloat(response.others[i].cost);
		  				total_amount_costing_others +=parseFloat(response.others[i].amount_costing);
		  				total_amount_actual_others+=parseFloat(response.others[i].amount_actual);
					}
					other.append('<tr>\
			             		<td colspan="5" class="text-center">TOTAL</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_cost_others)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_costing_others)+'</td>\
			             		<td class="text-right">'+_formatnumbercommat(total_amount_actual_others)+'</td>\
							</tr>');
				}else{
					$('#tbl_others > tbody:last-child').empty().append('<tr><td colspan="8" rows="4"  class="text-center">NO DATA</td></tr>');
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
              url: baseURL+'Accounting_Controller/Controller',
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
		init: function() {
			var viewForm = $('#kt_content').attr('data-table');
			_ViewController(viewForm);
			_initView();
			_initnotificationupdate();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});
