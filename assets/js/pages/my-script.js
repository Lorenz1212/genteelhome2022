'use strict';
var KTAjaxClient = function() {
var validation;
var type;
var item;
var description;
var quantity;
var remarks;
var date;
var title;
var _avatar;
var html;
var balance;
var status;
var supplier;
var type;
var received;
var amount;
var unit; 
var arrows;var item_v;var price;var special_option;
	var getUrlParameter = function(sParam) {
	    var sPageURL = window.location.search.substring(1),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
	        }
	    }
	    return false;
	};
	var _formatnumbercommat = function(value){
		return value.toLocaleString('en-US').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	var _initToast = function(type,message){
		const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
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
	var _initAvatar = function (action) {
		_avatar = new KTImageInput(''+action+'');
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


	var _initJOBORDER1_option = async function(){
		 $.ajax({
	             url: baseURL + 'option_controller/Joborder1_Option',
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
                  	  	  let option = '<option value="'+response[i].production_no+'">'+response[i].production_no+'</option>';
                  	  	  $('#joborder').append(option).addClass('selectpicker').attr('data-live-search', 'true').selectpicker('refresh');
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
                  	  	 
                  	  	  let option = '<option value="'+response[i].id+'">('+response[i].qty+') '+response[i].name+'</option>';
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
	var _initnotificationupdate = function(){
		 let url = window.location.pathname;
		 let urlpost="";
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
		 }
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
	var _initImage_option = async function(id){
		 $.ajax({
	             url: baseURL + 'option_controller/Image_option',
	             type: "POST",
	             data:{id:id},
	             dataType:"json",
	             beforeSend: function(){
	             	 $.getScript(baseURL+'assets/plugins/global/plugins.bundle.js');
	             	 $.getScript(baseURL+'assets/plugins/custom/prismjs/prismjs.bundle.js');
	             	 $.getScript(baseURL+'assets/js/scripts.bundle.js');
	             	KTApp.blockPage();
	             },
                 complete: function(){
                      KTApp.unblockPage();
                  },
                  success: function(response)
                  {	  
                  	if(!response== false){
                  		$('#designer').val(response.designer);
					$('#images').val(response.image);
					$('#docss').val(response.docs);
				  	$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
				  	$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
				  	$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
				  	$("#color").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
				  	$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
                  	}
	                    
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
	var _DataTableLoader2 = async function(link,TableURL,TableData,val){
		var table = $('#'+link);
		table.DataTable().clear().destroy();
		$.fn.dataTable.ext.errMode = 'throw';
		table.DataTable({
			destroy: true,
			responsive: true,
			info: false,
			searching: false,
    			lengthChange: false,
			paging: false,
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

				let total_salesoder_request = $('.total_salesoder_request');
				(response.total_salesoder_request != 0)?total_salesoder_request.addClass('label label-rounded label-warning').text(response.total_salesoder_request):total_salesoder_request.removeClass("label label-rounded label-warning").text("");

				let sales_stocks_pending = $('.sales_stocks_pending_request');
				(response.sales_stocks_pending != 0)?sales_stocks_pending.addClass('label label-rounded label-warning').text(response.sales_stocks_pending):sales_stocks_pending.removeClass("label label-rounded label-warning").text("");

				let sales_project_pending = $('.sales_project_pending_request');
				(response.sales_project_pending != 0)?sales_project_pending.addClass('label label-rounded label-warning').text(response.sales_project_pending):sales_project_pending.removeClass("label label-rounded label-warning").text("");

				$('.sales_stocks_pending').text(response.sales_stocks_pending);
				$('.sales_project_pending').text(response.sales_project_pending);
				$('.sales_stocks_approved').text(response.sales_stocks_approved);
				$('.sales_project_approved').text(response.sales_project_approved);
				$('.sales_stocks_completed').text(response.sales_stocks_completed);
				$('.sales_project_completed').text(response.sales_project_completed);
				$('.sales_stocks_cancelled').text(response.sales_stocks_cancelled);
				$('.sales_project_cancelled').text(response.sales_project_cancelled);

				$('.request_material_pending').text(response.request_material_pending);
				$('.request_material_received').text(response.request_material_received);
				$('.request_material_cancelled').text(response.request_material_cancelled);
				break;
			}
			case "sales":{
				let total_salesoder_request = $('.total_salesoder_request');
				(response.total_salesoder_request != 0)?total_salesoder_request.addClass('label label-rounded label-warning').text(response.total_salesoder_request):total_salesoder_request.removeClass("label label-rounded label-warning").text("");

				let sales_stocks_pending = $('.sales_stocks_pending_request');
				(response.sales_stocks_pending != 0)?sales_stocks_pending.addClass('label label-rounded label-warning').text(response.sales_stocks_pending):sales_stocks_pending.removeClass("label label-rounded label-warning").text("");

				let sales_project_pending = $('.sales_project_pending_request');
				(response.sales_project_pending != 0)?sales_project_pending.addClass('label label-rounded label-warning').text(response.sales_project_pending):sales_project_pending.removeClass("label label-rounded label-warning").text("");

				$('.sales_stocks_pending').text(response.sales_stocks_pending);
				$('.sales_project_pending').text(response.sales_project_pending);
				$('.sales_stocks_approved').text(response.sales_stocks_approved);
				$('.sales_project_approved').text(response.sales_project_approved);
				$('.sales_stocks_completed').text(response.sales_stocks_completed);
				$('.sales_project_completed').text(response.sales_project_completed);
				$('.sales_stocks_cancelled').text(response.sales_stocks_cancelled);
				$('.sales_project_cancelled').text(response.sales_project_cancelled);

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

				$('.sales_delivery_pending').text(response.sales_delivery_pending);
				$('.sales_delivery_ship').text(response.sales_delivery_ship);
				$('.sales_delivery_received').text(response.sales_delivery_received);
				$('.sales_delivery_completed').text(response.sales_delivery_completed);
				$('.sales_delivery_cancelled').text(response.sales_delivery_cancelled);
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
			case "pallet-image-docs":{
				if(!response == false){
                  	   $("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
                  	   $("#docs_href").attr('target','_blank');
                  	   $("#color").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
                  	}else{
                  	   $("#color").attr("src",baseURL + 'assets/images/design/project_request/images/default.jpg');
                  	   $("#docs_href").removeAttr("target");
                  	   $("#docs_href").removeAttr("href");
                  	}
				break;
			}
			case "design-project-docs":{
				if(response != false){
				   if(response.docs){
				   	$("#docs_href").attr("href", baseURL+'assets/images/design/project_request/docx/'+response.docs);
                  	     $("#docs_href").attr('target','_blank');
				   }else{
				   	$("#docs_href").removeAttr("target");
                  	   	$("#docs_href").removeAttr("href");
				   }
                  	}else{
                  	   $("#docs_href").removeAttr("target");
                  	   $("#docs_href").removeAttr("href");
                  	}
				break;
			}
			case "region":{
				if(response != false){
					$('.region-option').empty();
				     $('.region-option').append('<option value="">SELECT REGION</option>');
					for(let i=0;i<response.length;i++){
						$('.region-option').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
					}
				}
				break;
			}
			case "supplier":{
				if(!response == false){
				   $('.supplier-option').empty();
				   $('.supplier-option').append('<option value="">SELECT SUPPLIER</option>');
				   for(let i=0;i<response.length;i++){
						$('.supplier-option').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
				   }
				}
			   break;
			}
			case "email":{
				if(response.status == 'error'){$('.text-danger').text('Email address is already exists!');}else{$('.text-danger').text('');}
				break;
			}
			case "email_update":{
				if(response.status == 'error'){
					$('.text-danger').text('Email address is already exists!');
				}else{
					$('.text-danger').text('');
				}
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
			case "spare_parts":{
				$('#spare_parts').empty();
				if(!response == false){
					for(let i=0;i<response.length;i++){
	                  	  	 $('#spare_parts').append('<option value="'+response[i].id+'-'+response[i].name+'">('+response[i].qty+') '+response[i].name+'</option>');
	                  	  	 $('#spare_parts').addClass('selectpicker');
						 $('#spare_parts').attr('data-live-search', 'true');
						 $('#spare_parts').selectpicker('refresh');
	                  	  }
				}
				break;
			}
			case "office_supplies":{
				$('#officesupplies').empty();
				if(!response == false){
					 for(let i=0;i<response.length;i++){
	                  	  	  let option = '<option value="'+response[i].id+'-'+response[i].name+'">('+response[i].qty+') '+response[i].name+'</option>';
	                  	  	 $('#officesupplies').append(option);
	                  	  	 $('#officesupplies').addClass('selectpicker');
						 $('#officesupplies').attr('data-live-search', 'true');
						 $('#officesupplies').selectpicker('refresh');
	                  	  }
	                 }
				break;
			}
			case "design_option":{
				if(!response == false){
					$('#project_no').empty();
					$('#project_no').append('<option value="" selected disabled>SELECT ITEM</option>');
					for(let i=0;i<response.length;i++){
	                  	  	$('#project_no').append('<option value="'+response[i].project_no+'">'+response[i].title+'</option>');
	                  	  	$('#project_no').addClass('selectpicker');
					     $('#project_no').attr('data-live-search', 'true');
						$('#project_no').selectpicker('refresh');
		                }	
	          	 }
				break;
			}
			case "item_list":{
				let element = $('#item');
				element.empty();
				if(response!=false){
					 element.append('<option value="">Select Item</option>');
					for(let i=0;i<response.length;i++){
	                  	  	  element.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
	                  	  	  
                  	 	}
				}else{
					element.append('<option value="">No Data Available</option>');
				}
				  element.addClass('selectpicker');
				  element.attr('data-live-search', 'true');
				  element.selectpicker('refresh');
				break;
			}
			case "soa_no":{
				let element = $('select[name=trans_no]');
				element.empty();
				if(response !=false){
					for(let i=0;i<response.length;i++){
                  	  	 element.append('<option value="'+response[i].so_no+'">'+response[i].so_no+'</option>');
      //             	  	 element.addClass('selectpicker');
					 // element.attr('data-live-search', 'true');
					 // element.selectpicker('refresh');
                  	  	}	
				}else{
					element.append('<option value="">No Data Available</option>');
				}
				element.trigger('change');
				break;
			}
			case "so_no_item":{
				let element = $('#item');
				element.empty();
				if(response !=false){
					for(let i=0;i<response.length;i++){
                  	  	  element.append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                  	  }	
				}else{
					element.append('<option value="">No Data Available</option>');
				}
					 element.addClass('selectpicker');
					 element.attr('data-live-search', 'true');
					 element.selectpicker('refresh');
				break;
			}
			case "material_item_no":{
				$('#item').empty();
				for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].item_no+'">('+response[i].qty+') '+response[i].name+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }
				break;
			}
			case"material_request":{
				let unit = "";
				let remarks ="";
				if(response.data.unit){unit = ' - '+response.data.unit+'(s)';}
				let name = response.data.item+unit;
				if($('#kt_material_table tr > td:contains('+name+')').length == 0){
					
					if(response.remarks){remarks='(<a href="javascript:;" type="button" id="bulk_actions_btn" data-toggle="popover" data-action="show" data-content="'+response.remarks+'">Remark</a>)';}
					if(response.type ==1){
						var type ='FRAMING - MATERIALS';
					}else if(response.type == 2){
						var type ='MECHANISM';
					}else if(response.type == 3){
						var type ='FINISHING - MATERIALS';
					}else if(response.type == 4){
						var type ='SULIHIYA';
					}else if(response.type==5){
						var type ='UPHOLSTERY';
					}else if(response.type==6){
						var type ='OTHERS';
					}	
					$('#kt_material_table > tbody:last-child').append('<tr>\
					<td class="type tbl-mat-1" data-type="'+response.type+'" data-id="'+response.data.id+'">'+name+' '+remarks+'</td>\
					<td class="text-left text-success tbl-mat-2" data-qty="'+response.qty+'">'+response.qty+'</td>\
					<td class="text-right text-success  tbl-mat-3" data-remarks="'+response.remarks+'">'+type+'</td>\
					<td class="text-right text-danger"><button type="button" id="DeleteButton" class="btn btn-icon  btn-danger btn-circle btn-xs"><i class="icon-sm la la-times"></i></button></td>\
					</tr>');
				}else{
					Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
				}
				_initremovetable('#kt_material_table');				
				break;
			}
			case"purchase_material":{
					let  name = response.name;
					let id = response.name;
					let unit="";
					let remarks ="";
					if(response.data.unit){unit = ' - '+response.data.unit}
					if(response.type == 1){
						 name = response.data.item+unit+'(s)';
						 id = response.data.id;
					}
				if($('#kt_purchased_table tr > td:contains('+name+')').length == 0){
					if(response.remarks){remarks='(<a href="javascript:;" type="button" id="bulk_actions_btn" data-toggle="popover" data-action="show" data-content="'+response.remarks+'">Remark</a>)';}
					$('#kt_purchased_table > tbody:last-child').append('<tr>\
					<td class="tbl-pur-1" data-type="'+response.type+'" data-id="'+id+'">'+name+'</td>\
					<td class="text-left text-success tbl-pur-2" data-qty="'+response.qty+'">'+response.qty+'</td>\
					<td class="text-center tbl-pur-3" data-remarks="'+response.remarks+'">'+remarks+'</td>\
					<td class="text-right text-danger"><button type="button" id="DeleteButton" class="btn btn-icon  btn-danger btn-circle btn-xs"><i class="icon-sm la la-times"></i></button></td>\
					</tr>');
				}else{
					Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
				}
				
				_initremovetable('#kt_purchased_table');		
			   break;
			}
			case "purchase_product":{
				 $('#item').empty();
				 $('#item').append('<option value="" disabled selected>SELECT MATERIAL</option>');
				if(response !=false){
					for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].id+'">'+response[i].item+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }	
				}else{
					$('#item').append('<option value="">No Data Available</option>');
				}
				break;
			}
			case "purchase_inventory":{
				 $('#item').empty();
				 $('#item').append('<option value="" disabled selected>SELECT MATERIAL</option>');
				if(response !=false){
					for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].id+'" data-type="'+response[i].type+'">'+response[i].item+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }	
				}else{
					$('#item').append('<option value="">No Data Available</option>');
				}
				break;
			}
			case "supplier_list":{
				$('#supplier').empty();
				$('#supplier').append('<option value="" disabled selected>SELECT SUPPLIER</option>');
				if(response !=false){
					for(let i=0;i<response.length;i++){
                  	  	  $('#supplier').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                  	  	  $('#supplier').addClass('selectpicker');
					  $('#supplier').attr('data-live-search', 'true');
					  $('#supplier').selectpicker('refresh');
                  	  }	
				}else{
					$('#supplier').append('<option value="">No Data Available</option>');
				}
				 break;
			}
			case "purchase_transaction":{
				let container = $('#tbl_purchasing_process > tbody');
				container.empty();
				if(response != false){
					for(let i =0;i<response.length;i++){
						container.append('<tr>\
							<td>'+response[i].item+'</td>\
							<td>'+response[i].supplier+'</td>\
							<td>'+response[i].payment+'</td>\
							<td class="text-center">'+response[i].quantity+'</td>\
							<td class="text-right">'+response[i].amount+'</td>\
							<td class="text-center"><button type="button" class="btn btn-icon btn-light-danger btn-xs btn-delete" data-id="'+response[i].id+'"><i class="flaticon2-trash"></i></button></td>\
						</tr>');
					}
					
				}
				break;
			}
			case "other_material_p_transaction":{
				let container = $('#tbl_purchasing_process > tbody');
				container.empty();
				if(response != false){
					for(let i =0;i<response.length;i++){
						container.append('<tr>\
							<td>'+response[i].item+'</td>\
							<td>'+response[i].supplier+'</td>\
							<td>'+response[i].payment+'</td>\
							<td class="text-center">'+response[i].quantity+'</td>\
							<td class="text-right">'+response[i].amount+'</td>\
							<td class="text-center"><button type="button" class="btn btn-icon btn-light-danger btn-xs btn-delete" data-id="'+response[i].id+'"><i class="flaticon2-trash"></i></button></td>\
						</tr>');
					}
					
				}
				break;
			}
			
		}
	}
	
	var _ViewController = async function(view){
		_month_year();
		switch(view){
			case "data-dashboard-admin":{
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
			case "data-salesorder-delivery-print":{
					let thisUrl = 'modal_controller/Modal_SalesOrder_Delivery';
					_ajaxloader(thisUrl,"POST",{id:sessionStorage.getItem('so_no')},"Modal_SalesOrder_Delivery");
				break;
			}
			case "data-dashboard-superuser":{
				let thisUrl = 'dashboard_controller/superuser_dashboard';
				_ajaxloader(thisUrl,"POST",false,"superuser_dashboard");
				break;
			}
			case "joborder-stock-masterlist":{
				KTDatatablesDataSourceAjaxClient.init('tbl_joborder_masterlist_stocks');
				break;
			}
			case "joborder-project-masterlist":{
				KTDatatablesDataSourceAjaxClient.init('tbl_joborder_masterlist_project');
				break;
			}
			case "production_stocks":{
				KTDatatablesDataSourceAjaxClient.init('tbl_production_stocks');
				break;
			}
			case "request-material-list":{
				KTDatatablesDataSourceAjaxClient.init('tbl_request_material');
				break;
			}
			case "design-stocks":{
				$(document).ready(function() {
					KTFormControlsCreatives.init('form-design-stocks');
					KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_stocks');
					_initAvatar('design_image');
					_initAvatar('design_image_add');
					$('#add-stocks-modal input[name=image]').on('change',function(e){
					    var file, img;
					    if ((file = this.files[0])) {
					        img = new Image();
					        var objectUrl =window.URL.createObjectURL(file);
					        img.onload = function () {
					        	if(this.width > 1000 && this.height > 1000){
					        		Swal.fire("Warning!", "Sorry, this image doesn't look like the size we wanted. It's "+this.width+" x "+this.height+" but we require 500 x 500 size image.", "warning").then(function(){$('#design_image_add > span').trigger('click');
					        			});
					        	}
					        };img.src = objectUrl;
					    }
					});
					$(".upfile1").click(function () {
					    $("#image").trigger('click');
					});
					$(".upfile2").click(function () {
					    $("#image2").trigger('click');
					});
					$(".upfile3").click(function () {
					    $("#image3").trigger('click');
					});
				    $(document).on('click','.view-stocks',function(e){
					 	e.preventDefault();
					 	e.stopImmediatePropagation();
					 	let id = $(this).attr('data-id');
					 	_ajaxrequest('Creative_Controller/Controller',_constructBlockUi('blockPage', false, 'Stocks...'),_constructForm(['design-stocks', 'fetch_design_stocks',id]));
				    });
				    $(document).on('click','.edit-stocks',function(e){
					 	e.preventDefault();
					 	e.stopImmediatePropagation();
					 	let id = $(this).attr('data-id');
					 	_ajaxrequest('Creative_Controller/Controller',_constructBlockUi('blockPage', false, 'Stocks...'),_constructForm(['design-stocks', 'fetch_design_stocks_edit',id]));
				    });
				     $(document).on('click','.add-stocks',function(e){
					 	e.preventDefault();
					 	$('#add-stocks-modal').modal('show');
				    });
				      $(document).on('click','.add-stocks-existing',function(e){
					 	e.preventDefault();
					 	_ajaxrequest('Creative_Controller/Controller',_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['design-stocks', 'fetch_design_stocks_list']));
				    });
				     $('#add-stocks-modal input[name=docs]').on('change',function(e){
		                    e.preventDefault();
		                    $('#add-stocks-modal .valid-uploadx').val(this.files[0].name);
		               });

		            
		               $('body').delegate('.remarks-stocks','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Item name : "+element.attr('data-name')+"</br>Reason to Remarks",
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
			case "design-project":{
				$(document).ready(function() {
					KTFormControlsCreatives.init('form-design-project');
					KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_project');
					_initAvatar('design_image');
					_initAvatar('design_image_add');
					$('#add-project-modal input[name=image]').on('change',function(e){
					    var file, img;
					    if ((file = this.files[0])) {
					        img = new Image();
					        var objectUrl =window.URL.createObjectURL(file);
					        img.onload = function () {
					        	if(this.width > 1000 && this.height > 1000){
					        		Swal.fire("Warning!", "Sorry, this image doesn't look like the size we wanted. It's "+this.width+" x "+this.height+" but we require 500 x 500 size image.", "warning").then(function(){$('#design_image_add > span').trigger('click');
					        			});
					        	}
					        };img.src = objectUrl;
					    }
					});
				    $(document).on('click','.view-project',function(e){
					 	e.preventDefault();
					 	e.stopImmediatePropagation();
					 	let id = $(this).attr('data-id');
					 	_ajaxrequest('Creative_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-project', 'fetch_design_project',id]));
				    });
				    $(document).on('click','.edit-project',function(e){
					 	e.preventDefault();
					 	e.stopImmediatePropagation();
					 	let id = $(this).attr('data-id');
					 	_ajaxrequest('Creative_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-project', 'fetch_design_project_edit',id]));
				    });
				     $(document).on('click','.add-project',function(e){
					 	e.preventDefault();
					 	$('#add-project-modal').modal('show');
				    });
				     $('#add-project-modal input[name=docs]').on('change',function(e){
		                    e.preventDefault();
		                    $('#add-project-modal .valid-upload').val(this.files[0].name);
		               });
		               $('body').delegate('.remarks-project','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Project Title : "+element.attr('data-name')+"</br>Remarks",
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
			case "data-request-material-create":{
				$('select[name=type]').on('change',function(e){
					_ajaxloaderOption('option_controller/item_list','POST',{type:$(this).val()},'item_list');
				});
				if($('#kt_material_table tbody tr').length == 0){
	                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
	                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
	                                    </div>\
	                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
					$('#kt_material_table > tbody').empty();	
				}
				$(document).on('click','.add_item',function(e){
					e.preventDefault();
					let id  = $('select[name=item_no]').val();
					let item = $('select[name="item_no"] option:selected').text();
					let type  = $('select[name=type]').val();
					let qty  = $('input[name=qty]').val();
					let status;
					if(type == 1){
					    status = 'Raw Materials';
					}else if(type ==2){
					    status = 'Office & Janitorial Supplies';
					}else{
					   status = 'Spare Parts';
					}
					let validation = $('#kt_material_table tr > td:contains('+item+')').length;
					if(validation == 0){
						if(!qty){
							Swal.fire("Warning!", "Please Input Quantity!", "info");
						}else{
							$('#kt_material_table > tbody:last-child').append('<tr>\
										<td class="td-item" data-id="'+id+'">'+item+'</td>\
										<td class="text-right td-qty">'+qty+'</td>\
										<td class="text-right td-type" data-type="'+type+'">'+status+'</td>\
										<td class="text-right"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow btn-delete"><i class="la la-times"></i></button></td>\
												</tr>');	
							$('.cart-empty-page').empty();
							_initremovetable('#kt_material_table');	
							}
					}else{
						Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
					}
				})
				$(document).on('click','.btn-delete',function(e){
					e.preventDefault();
					if($('#kt_material_table tbody tr').length == 0){
		                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
		                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
		                                    </div>\
		                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
						$('#kt_material_table > tbody').empty();	
					}
				});
				break;
			}
			case "data-request-purchase-create":{
				_initCurrency_format('.amount')
				$('select[name=type]').on('change',function(e){
					_ajaxloaderOption('option_controller/item_list','POST',{type:$(this).val()},'item_list');
				});
				if($('#kt_material_table tbody tr').length == 0){
	                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
	                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
	                                    </div>\
	                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
					$('#kt_material_table > tbody').empty();	
				}
				$(document).on('click','.add_item',function(e){
					e.preventDefault();
					let id  = $('select[name=item_no]').val();
					let item = $('select[name="item_no"] option:selected').text();
					let type  = $('select[name=type]').val();
					let qty  = $('input[name=qty]').val();
					let amount  = $('input[name=amount]').val();
					let status;
					if(type == 1){
					    status = 'Raw Materials';
					}else if(type ==2){
					    status = 'Office & Janitorial Supplies';
					}else{
					   status = 'Spare Parts';
					}
					let validation = $('#kt_material_table tr > td:contains('+item+')').length;
					if(validation == 0){
						if(!qty){
							Swal.fire("Warning!", "Please Input Quantity!", "info");
						}else{
						let i = $('#kt_material_table tbody tr').length;
						if((i+1) != 0){
							 $('.cart-empty-page').empty();
						}
						$('#kt_material_table > tbody:last-child').append('<tr>\
									<td class="td-item['+i+']" data-id="'+id+'">'+item+'</td>\
									<td class="text-right td-qty['+i+']">'+qty+'</td>\
									<td class="text-right td-amount['+i+']">'+amount+'</td>\
									<td class="text-right td-type['+i+']" data-type="'+type+'">'+status+'</td>\
									<td class="text-right"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow btn-delete"><i class="la la-times"></i></button></td>\
											</tr>');	
						_initremovetable('#kt_material_table');	
						}
					}else{
						Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
					}
				})
				$(document).on('click','.btn-delete',function(e){
					e.preventDefault();
					if($('#kt_material_table tbody tr').length == 0){
		                    $('.cart-empty-page').empty().append('<div class="empty-icon mt-2">\
		                                    <img src="'+baseURL+'assets/media/svg/empty-cart.svg"/>\
		                                    </div>\
		                                    <p class=""><a class="font-weight-bolder font-size-h3">Empty Cart</a></p>');
						$('#kt_material_table > tbody').empty();	
					}
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
			case "data-customer-concern-list":{
				KTDatatablesDataSourceAjaxClient.init('tbl_service_request_sales');
				$(document).ready(function() {
					$(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_Customer_Concern';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_Customer_Concern");
				    });
				})
				break;
			}
			case "data-purchase-inventory":{
				KTDatatablesDataSourceAjaxClient.init('tbl_other_purchase_invetory');
				$(document).ready(function() {
				    $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_Other_Purchase_View';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_Other_Purchase_View");
				    });
				    $(document).on("click","#view-inprogress",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_Other_Purchase_View';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_Other_Purchase_View_Received");
				    });
				     $(document).on('click','.btn-change-process',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('.btn-submit-process').removeClass('d-none').attr('id','btn-save-process');
						 	$('#view-details').addClass('d-none');
						 	$('#view-purchased').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
						 	$('.btn-submit-process').addClass('d-none').removeAttr('id');
						 	$('#view-details').removeClass('d-none');
						 	$('#view-purchased').addClass('d-none');	
					 	}
					 }); 
				})

				break;
			}
			case "data-purchase-stocks-create":{
				$(document).ready(function(){
					_initCurrency_format('#amount');
				    $(document).on('change','select[name=special_option]',function(){
						let option = $(this).val();
						_initPurchaseStocks(option);
				    });
				    _initPurchaseStocks_request();
				});
			 	break;
			}
			case "data-purchase-stocks":{
				$(document).ready(function() {
					$(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Stocks_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Stocks_View");
				     });
				     $(document).on("click","#form-complete",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Stocks_Complete_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Stocks_Complete_View");
				     });
				     $(document).on("click","#form-delivery",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Stocks_Delivery_Data';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_Delivery_Data");
				       }); 
				})
				break;
			}
			
			case "data-officesupplies-request-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_OfficeSupplies_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_OfficeSupplies_Request");
				    });
				})
				break;
			}
			case "data-sparerequest-request-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_SpareParts_Request';
						_ajaxloader(thisUrl,"POST",val,"Modal_SpareParts_Request");
				    });
				})
				break;
			}
			case "data-sparerequest-create":{
				_ajaxloaderOption('option_controller/Spare_Option','POST',false,'spare_parts');
				_initstocksRequest();
				_initNumberOnly("#quantity");
				break;
			}
			case "data-officesupplies-create":{
				_ajaxloaderOption('option_controller/Office_Option','POST',false,'office_supplies');
				_initstocksRequest();
				_initNumberOnly("#quantity");
				break;
			}
			//designer
			case "data-customization":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Designer_Customization';
						_ajaxloader(thisUrl,"POST",val,"Modal_Designer_Customization");
				    });
				})
				break;
			}
			case "design-stocks-approval":{
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_design_stocks_request');
				$(document).on('click','.view-stocks',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-stocks', 'fetch_design_stocks',id]));
			    });
			    $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Product name: "+element.attr('data-name'),
			                          text: "You wont be able to revert this!",
			                          icon: "warning",
			                          showCancelButton: true,
			                          confirmButtonText: "Yes, proceed!",
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      }).then(function(result) {
			                          if (result.value){
			                             _ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-stocks', 'fetch_design_stocks_status',element.attr('data-id'),element.attr('data-status')]));
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
			                          	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-stocks', 'fetch_design_stocks_status',element.attr('data-id'),element.attr('data-status'),result.value]));
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
	              $('body').delegate('.remarks-stocks','click',function(e){
		                    e.preventDefault();
		                    e.stopImmediatePropagation();
		                    let element = $(this);
		                        Swal.fire({
		                          title: " Product name: "+element.attr('data-name')+"</br>Remarks",
		                          text: element.attr('data-remarks'),
		                          showConfirmButton:false,
		                          showCancelButton: false,
		                          cancelButtonText: "close!",
		                          reverseButtons: true
		                      })
		          });
				break;
			}
			case "design-project-approval":{
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_design_project_request');
				$(document).on('click','.view-project',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-project', 'fetch_design_project',id]));
			    });
			    $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Project Title: "+element.attr('data-name'),
			                          text: "You wont be able to revert this!",
			                          icon: "warning",
			                          showCancelButton: true,
			                          confirmButtonText: "Yes, proceed!",
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      }).then(function(result) {
			                          if (result.value){
			                             _ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-project', 'fetch_design_project_status',element.attr('data-id'),element.attr('data-status')]));
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
			                          	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['design-project', 'fetch_design_project_status',element.attr('data-id'),element.attr('data-status'),result.value]));
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
	              $('body').delegate('.remarks-project','click',function(e){
		                    e.preventDefault();
		                    e.stopImmediatePropagation();
		                    let element = $(this);
		                        Swal.fire({
		                          title: "Project Title: "+element.attr('data-name')+"</br>Remarks",
		                          text: element.attr('data-remarks'),
		                          showConfirmButton:false,
		                          showCancelButton: false,
		                          cancelButtonText: "close!",
		                          reverseButtons: true
		                      })
		          });
				break;
			}
			case "inspection-stocks":{
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_inspection_stocks');
				 $(document).on('click','.view-stocks',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['inspection-stocks', 'fetch_inspection_stocks',id]));
		    		});
				 $(document).on('click','.view-stocks-approved',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	let id1 = $(this).attr('data-trans');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['inspection-stocks', 'fetch_inspection_stocks_approved',id,id1]));
			     });
				 $('body').delegate('.btn-approved','click',function(e){
		                    e.preventDefault();
		                    e.stopImmediatePropagation();
		                    let element = $(this);
		                        Swal.fire({
		                          title: "Do you want to move this form? Project Title: "+element.attr('data-name'),
		                          text: "You wont be able to revert this!",
		                          icon: "warning",
		                          showCancelButton: true,
		                          confirmButtonText: "Yes, proceed!",
		                          cancelButtonText: "close!",
		                          reverseButtons: true
		                      }).then(function(result) {
		                          if (result.value){
		                             _ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['inspection-stocks', 'fetch_inspection_stocks_status',element.attr('data-id'),element.attr('data-status')]));
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
			                          	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['inspection-stocks', 'fetch_inspection_stocks_status',element.attr('data-id'),element.attr('data-status'),result.value]));
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
				$('body').delegate('.remarks-stocks','click',function(e){
	                    e.preventDefault();
	                    e.stopImmediatePropagation();
	                    let element = $(this);
	                        Swal.fire({
	                          title: "Product Name: "+element.attr('data-name')+"</br>Remarks",
	                          text: element.attr('data-remarks'),
	                          showConfirmButton:false,
	                          showCancelButton: false,
	                          cancelButtonText: "close!",
	                          reverseButtons: true
	                      })
		          });
				break;
			}
			case "inspection-project":{
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_inspection_project');
				$(document).on('click','.view-project',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['inspection-project', 'fetch_inspection_project',id]));
			     });
			     $(document).on('click','.view-project-approved',function(e){
				 	e.preventDefault();
				 	e.stopImmediatePropagation();
				 	let id = $(this).attr('data-id');
				 	let id1 = $(this).attr('data-trans');
				 	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['inspection-project', 'fetch_inspection_project_approved',id,id1]));
			     });
				$('body').delegate('.btn-approved','click',function(e){
		                    e.preventDefault();
		                    e.stopImmediatePropagation();
		                    let element = $(this);
		                        Swal.fire({
		                          title: "Do you want to move this form? Project Title: "+element.attr('data-name'),
		                          text: "You wont be able to revert this!",
		                          icon: "warning",
		                          showCancelButton: true,
		                          confirmButtonText: "Yes, proceed!",
		                          cancelButtonText: "close!",
		                          reverseButtons: true
		                      }).then(function(result) {
		                          if (result.value){
		                             _ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['inspection-project', 'fetch_inspection_project_status',element.attr('data-id'),element.attr('data-status')]));
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
			                          	_ajaxrequest('Admin_Controller/Controller',_constructBlockUi('blockPage', false, 'Project...'),_constructForm(['inspection-project', 'fetch_inspection_project_status',element.attr('data-id'),element.attr('data-status'),result.value]));
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
				$('body').delegate('.remarks-project','click',function(e){
	                    e.preventDefault();
	                    e.stopImmediatePropagation();
	                    let element = $(this);
	                        Swal.fire({
	                          title: "Project Title: "+element.attr('data-name')+"</br>Remarks",
	                          text: element.attr('data-remarks'),
	                          showConfirmButton:false,
	                          showCancelButton: false,
	                          cancelButtonText: "close!",
	                          reverseButtons: true
	                      })
		          });
				break;
			}
			case "data-jobeorder-update-stocks":{
				var id = getUrlParameter('URI');
				let thisUrl = 'view_controller/View_Joborder_Request_Stocks';
				_ajaxloader(thisUrl,"POST",{id:id},"View_Joborder_Request_Stocks");
				$('.card-label-title').text(_getItem('request'));
				if(_getItem('request') == 'Material Request'){
					$('#special-select').addClass('d-none');
					$('#special-item').addClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').removeClass('d-none');
				}else{
					$('#special-select').removeClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').addClass('d-none');
				}
				$(document).on('click','.btn-request',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					_sessionStorage('request',action);
					$('.card-label-title').text(action);
					$('.btn-submit').attr('data-action',action);
					if(action == 'Material Request'){
						$('#special-select').addClass('d-none');
						$('#special-item').addClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').removeClass('d-none');
					}else{
						$('#special-select').removeClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').addClass('d-none');
					}
				});
				$(document).on('change','#special-option',function(e){
					e.preventDefault();
					let id = $(this).val();
					if(id==2){
					    $('#special-item').removeClass('d-none');
					    $('#item-select').addClass('d-none');
					}else{
					    $('#special-item').addClass('d-none');
					    $('#item-select').removeClass('d-none');
					}
				});
				$(document).on('click','#bulk_actions_btn',function(){
					 let action = $(this).attr('data-action');
					 if(action == 'show'){
				        $(this).popover('show');
				        $(this).attr('data-action','hide');
					 }else{
					   $(this).popover('hide');
				        $(this).attr('data-action','show');
					 }
				});
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					let remarks 	= $('#remarks').val();
					let qty      = $('input[name=qty]').val();
					let id       = $('select[name=item]').val();
					if(!qty){
						Swal.fire("Warning!", "Please Input Quantity!", "info");
					}else{
						if(action == 'Material Request'){
						   let type      = $('select[name=type]').val();
						   let val = {id:id,qty:qty,remarks:remarks,type:type};
						   _ajaxloaderOption('option_controller/Material_option',"POST",val,'material_request');
						}else{
						   let type = $('select[name=special_option]').val();
						   let name = $('#special_item').val();
						   let val = {id:id,name:name,type:type,qty:qty,remarks:remarks};
						   _ajaxloaderOption('option_controller/Purchase_option',"POST",val,'purchase_material');
						}
					}
				})
				$('#Update_Joborder_Project > div > div:nth-child(2) > button').trigger('click');
				break;
			}
			case "data-jobeorder-update-project":{
				//_sessionStorage('request','Material Request');
				let id = getUrlParameter('URI');
				let thisUrl = 'view_controller/View_Joborder_Request_Project';
				_ajaxloader(thisUrl,"POST",{id:id},"View_Joborder_Request_Project");
				$(document).on('click','.btn-request',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					_sessionStorage('request',action);
					$('.card-label-title').text(action);
					$('.btn-submit').attr('data-action',action);
					if(action == 'Material Request'){
						$('#special-select').addClass('d-none');
						$('#special-item').addClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').removeClass('d-none');
					}else{
						$('#special-select').removeClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').addClass('d-none');
					}
				});
				$(document).on('change','#special-option',function(e){
					e.preventDefault();
					let id = $(this).val();
					if(id==2){
					    $('#special-item').removeClass('d-none');
					    $('#item-select').addClass('d-none');
					}else{
					    $('#special-item').addClass('d-none');
					    $('#item-select').removeClass('d-none');
					}
				});
				$(document).on('click','#bulk_actions_btn',function(){
					 let action = $(this).attr('data-action');
					 if(action == 'show'){
				        $(this).popover('show');
				        $(this).attr('data-action','hide');
					 }else{
					   $(this).popover('hide');
				        $(this).attr('data-action','show');
					 }
				});
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					let remarks 	= $('#remarks').val();
					let qty      = $('input[name=qty]').val();
					let id       = $('select[name=item]').val();
					if(!qty){
						Swal.fire("Warning!", "Please Input Quantity!", "info");
					}else{
						if(action == 'Material Request'){
						   let type      = $('select[name=type]').val();
						   let val = {id:id,qty:qty,remarks:remarks,type:type};
						   _ajaxloaderOption('option_controller/Material_option',"POST",val,'material_request');
						}else{
						   let type = $('select[name=special_option]').val();
						   let name = $('#special_item').val();
						   let val = {id:id,name:name,type:type,qty:qty,remarks:remarks};
						   _ajaxloaderOption('option_controller/Purchase_option',"POST",val,'purchase_material');
						}
					}
					
				});
				$('#Update_Joborder_Project > div > div:nth-child(2) > button').trigger('click');
				break;
			}
			case "data-jobeorder-create-project":{
				_sessionStorage('request','Material Request');
				$('.card-label-title').text(_getItem('request'));
				$(document).on('change','#project_no',function(e){
					e.preventDefault();
					let id = $(this).val();
					_ajaxloaderOption('option_controller/design_project_docs','POST',{id:id},'design-project-docs');
				});
				if(_getItem('request') == 'Material Request'){
					$('#special-select').addClass('d-none');
					$('#special-item').addClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').removeClass('d-none');
				}else{
					$('#special-select').removeClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').addClass('d-none');
				}
				$(document).on('click','.btn-request',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					_sessionStorage('request',action);
					$('.card-label-title').text(action);
					$('.btn-submit').attr('data-action',action);
					if(action == 'Material Request'){
						$('#special-select').addClass('d-none');
						$('#special-item').addClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').removeClass('d-none');
					}else{
						$('#special-select').removeClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').addClass('d-none');
					}
				});
				$(document).on('change','#special-option',function(e){
					e.preventDefault();
					let id = $(this).val();
					if(id==2){
					    $('#special-item').removeClass('d-none');
					    $('#item-select').addClass('d-none');
					}else{
					    $('#special-item').addClass('d-none');
					    $('#item-select').removeClass('d-none');
					}
				});
				$(document).on('click','#bulk_actions_btn',function(){
					 let action = $(this).attr('data-action');
					 if(action == 'show'){
				        $(this).popover('show');
				        $(this).attr('data-action','hide'); //here if the condition is true then popover should be display.
					 }else{
					   $(this).popover('hide');
				        $(this).attr('data-action','show');
					 }
				});
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					let remarks 	= $('#remarks').val();
					let qty      = $('input[name=qty]').val();
					let id       = $('select[name=item]').val();
					if(!qty){
						Swal.fire("Warning!", "Please Input Quantity!", "info");
					}else{
						if(action == 'Material Request'){
						   let type      = $('select[name=type]').val();
						   let val = {id:id,qty:qty,remarks:remarks,type:type};
						   _ajaxloaderOption('option_controller/Material_option',"POST",val,'material_request');
						}else{
						   let type = $('select[name=special_option]').val();
						   let name = $('#special_item').val();
						   let val = {id:id,name:name,type:type,qty:qty,remarks:remarks};
						   _ajaxloaderOption('option_controller/Purchase_option',"POST",val,'purchase_material');
						}
				   }
					
				})
				break;
			}
			case "data-jobeorder-create-stocks":{
				_sessionStorage('request','Material Request');
				$('.card-label-title').text(_getItem('request'));
				$(document).on('change','#project_no',function(e){
					e.preventDefault();
					let id = $(this).val();
					_ajaxloaderOption('option_controller/pallet_color','POST',{id:id},'pallet-color');
				});
				$(document).on('change','#c_code',function(e){
					e.preventDefault();
					let id = $(this).val();
					_ajaxloaderOption('option_controller/pallet_docs','POST',{id:id},'pallet-image-docs');
				});
				if(_getItem('request') == 'Material Request'){
					$('#special-select').addClass('d-none');
					$('#special-item').addClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').removeClass('d-none');
				}else{
					$('#special-select').removeClass('d-none');
					$('#item-select').removeClass('d-none');
					$('#type-select').addClass('d-none');
				}
				$(document).on('click','.btn-request',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					_sessionStorage('request',action);
					$('.card-label-title').text(action);
					$('.btn-submit').attr('data-action',action);
					if(action == 'Material Request'){
						$('#special-select').addClass('d-none');
						$('#special-item').addClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').removeClass('d-none');
					}else{
						$('#special-select').removeClass('d-none');
						$('#item-select').removeClass('d-none');
						$('#type-select').addClass('d-none');
					}
				});
				$(document).on('change','#special-option',function(e){
					e.preventDefault();
					let id = $(this).val();
					if(id==2){
					    $('#special-item').removeClass('d-none');
					    $('#item-select').addClass('d-none');
					}else{
					    $('#special-item').addClass('d-none');
					    $('#item-select').removeClass('d-none');
					}
				});
				$(document).on('click','#bulk_actions_btn',function(){
					 let action = $(this).attr('data-action');
					 if(action == 'show'){
				        $(this).popover('show');
				        $(this).attr('data-action','hide'); //here if the condition is true then popover should be display.
					 }else{
					   $(this).popover('hide');
				        $(this).attr('data-action','show');
					 }
				});
				$(document).on('click','.btn-submit',function(e){
					e.preventDefault();
					let action = $(this).attr('data-action');
					let remarks 	= $('#remarks').val();
					let qty      = $('input[name=qty]').val();
					let id       = $('select[name=item]').val();
					if(!qty){
						Swal.fire("Warning!", "Please Input Quantity!", "info");
					}else{
						if(action == 'Material Request'){
						   let type      = $('select[name=type]').val();
						   let val = {id:id,qty:qty,remarks:remarks,type:type};
						   _ajaxloaderOption('option_controller/Material_option',"POST",val,'material_request');
						}else{
						   let type = $('select[name=special_option]').val();
						   let name = $('#special_item').val();
						   let val = {id:id,name:name,type:type,qty:qty,remarks:remarks};
						   _ajaxloaderOption('option_controller/Purchase_option',"POST",val,'purchase_material');
						}
					}
				})
				break;
			}
			
			case "data-online-request":{
				KTDatatablesDataSourceAjaxClient.init('tbl_onlineorder');
				$(document).ready(function() {
				    $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_OnlineOrder';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_OnlineOrder");
				    });
				    $(document).on("click",".btn-create-sales-order",function(e) {
				    		e.preventDefault();
						window.location = baseURL+'gh/sales/salesorder-update-stocks?URI='+$('.order_no').text();
				    });
				})
				break;
			}
			case "data-salesorder-update-stocks":{
				var id = getUrlParameter('URI');
				let thisUrl = 'view_controller/View_Salesorder_Update';
				_ajaxloader(thisUrl,"POST",{id:id},"View_Salesorder_Update");
				break;
			}

			//production
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
			case "salesorder-stocks":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_stocks_production');
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
			case "salesorder-project":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_salesorder_project_production');
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
			case "data-sales-delivery":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_sales_delivery_superuser');
					_initNumberOnly(".qty");
					$('[data-toggle="tooltip"]').tooltip();
				    $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let thisUrl = 'modal_controller/Modal_SalesOrder_Delivery';
						_ajaxloader(thisUrl,"POST",{id:id},"Modal_SalesOrder_Delivery");
				    });
				    $(document).on("click",".btn-print",function(e) {
						e.preventDefault();
						let id = $('.so_no').attr('data-id');
						sessionStorage.setItem('dr_no', id);
						window.open(baseURL+'gh/printview/print-salesorder-delivery');
				    });
				     $(document).on('change','.type-soa',function(e){
						e.preventDefault();
						let id = $(this).val();
						$('.text-dr').attr('data-type',id);
						_ajaxloaderOption('option_controller/soa_no','POST',{id:id},'soa_no');
					});
					$(document).on('change','.trans-no',function(e){
						e.preventDefault();
						let id = $(this).val();
						$('.text-dr').text(id);
						_ajaxloaderOption('option_controller/so_no_item','POST',{so_no:id},'so_no_item');
					});
					$(document).on('click','.btn-add',function(e){
							e.preventDefault();
							let id = $('select[name=item]').val();
							let item = $('select[name=item] option:selected').text();
							let qty  = $('input[name=qty]').val();
							let validation = $('#tbl_delivery_breakdown tr > td:contains('+item+')').length;
							if(validation == 0){
								if(!qty){
									Swal.fire("Warning!", "Please fillup the form before you click!", "warning");
								}else{
									let i = $('#tbl_delivery_breakdown tbody tr').length;
									$('#tbl_delivery_breakdown > tbody').append('<tr>\
										<td class="text-center td-id" data-id="'+id+'">'+item+'</td>\
										<td class="text-center td-qty">'+qty+'</td>\
										<td class="text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-xs btn-shadow" data-container="body" data-toggle="tooltip" data-placement="top" title="Remove"><i class="far fa-trash-alt"></i></button></td>\
												</tr>');	
								}
							}else{
								Swal.fire("Warning!", "You're trying to add the same entry!", "warning");
							}
					});
					 _initremovetable('#tbl_delivery_breakdown');
					 $("body").delegate('.create-delivery-receipt-modal','click',function(e){
			                  e.stopImmediatePropagation(); 
			                  e.preventDefault();
			                  let element=$(this);
			                  Swal.fire({
			                    title:'Create new D.R',
			                    heightAuto: false,
			                    html:' <div class="row">\
									 <div class="col">\
										 <div class="form-group">\
										    <label>Type <span class="text-danger">*</span></label>\
										    <select class="form-control type-soa" name="type">\
										    	<option value="">Select Type First</option>\
										    	<option value="1">Stocks</option>\
										    	<option value="2">Project</option>\
										    </select>\
										 </div>\
									</div></div>\
								<div class="row">\
									<div class="col">\
										 <div class="form-group">\
										    <label>Trans. # <span class="text-danger">*</span></label>\
										    <select class="form-control trans-no" name="trans_no"></select>\
										 </div>\
									</div>\
								</div>',
			                    showCancelButton: true,
			                    confirmButtonText: "Yes, submit!",
			                    cancelButtonText: "No, cancel",
			                    customClass: {
				                      confirmButton: "btn font-weight-bold btn-primary",
				                      cancelButton: "btn font-weight-bold btn-default"
				                },
			                    inputValidator: (value) => {
			                      return new Promise((resolve) => {
			                        if (value.length >=1){
			                          resolve();
			                        }else{
			                          resolve('Please enter your control number.')
			                        }
			                      })
			                    }
			                  }).then(function(result){
			                      if(result.isConfirmed == true){
			                        if(result.value){
			      				  $('#create-delivery-receipt-modal').modal('show');	                 	
			                        }else{
			                           Swal.fire('Opss', 'Please enter your control number', 'info');
			                        }
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
								 	let thisUrl = 'update_controller/Update_Sales_Delivery_Receipt_Superuser';
									_ajaxloader(thisUrl,"POST",{id:id,status:status,remarks:result.value},"Update_Sales_Delivery_Receipt_Superuser");
			                        }else{
			                           swal.fire('Opss', 'Please enter your remarks', 'info');
			                        }
			                      }
			                  });
			              })
					 $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Trans #: "+element.attr('data-dr'),
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
								 	let thisUrl = 'update_controller/Update_Sales_Delivery_Receipt_Superuser';
									_ajaxloader(thisUrl,"POST",{id:id,status:status},"Update_Sales_Delivery_Receipt_Superuser");
			                          } 
			                      });
			            });
					 $('body').delegate('.btn-remarks','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Trans #: "+element.attr('data-dr')+"</br>Reason to Remarks",
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
			case "joborder-stocks":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_joborder_stocks');
				    $(document).on("click","#form-request",function(e) {
				    		e.preventDefault();
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Stocks_View';
						_ajaxloader(thisUrl,"POST",val,"Modal-JobOrder-Stocks-View");
				    });
				     $(document).on("click",".btn-active",function(e) {
					 	e.preventDefault();
					 	$('.btn-inspection').removeClass('active');
					 	let element = $(this);
				    		let action = element.attr('data-action');
				    		let val = {id:$('#joborder').text()};
				    		if(action == 'material_request'){
				    			let thisUrl = 'view_controller/View_Joborder_Material';
							_ajaxloader(thisUrl,"POST",val,"View_Joborder_Material");
				    		}else{
				    			let thisUrl = 'view_controller/View_Joborder_Purchase';
							_ajaxloader(thisUrl,"POST",val,"View_Joborder_Purchase");
				    		}
				    });
				    $(document).on('click','.btn-inspection',function(e){
				    		e.preventDefault();
				    		$('.btn-active').removeClass('active');
				    		let val = {id:$('#joborder').text()};
					 	let thisUrl = 'view_controller/View_Inpection_project';
						_ajaxloader(thisUrl,"POST",val,"View-Inpection-Project");
						$('#requestInspection').removeClass('d-none');
						$('#approvedInspection').addClass('d-none');
					 	$('#rejectedInspection').addClass('d-none');
					 	$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').addClass('d-none');
					 	$('#inspections > div > div.card-body > div:nth-child(1)').removeClass('d-none');
				    });
				    $(document).on("click",".btn-status",function(e) {
					 	e.preventDefault();
					 	let element = $(this);
					 	let action = element.attr('data-action');
					 	$('#'+action).removeClass('d-none');
					 	if(action == 'requestInspection'){
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').addClass('d-none');
					 		$('#approvedInspection').addClass('d-none');
					 		$('#rejectedInspection').addClass('d-none');
					 		$('#inspections > div > div.card-body > div:nth-child(1)').removeClass('d-none');
					 	}else if(action == 'approvedInspection'){
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').removeClass('d-none');
					 		$('#requestInspection').addClass('d-none');
					 		$('#rejectedInspection').addClass('d-none');
					 		$('#inspections > div > div.card-body > div:nth-child(1)').addClass('d-none');
					 	}else if(action == 'rejectedInspection'){
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').removeClass('d-none');
					 		$('#requestInspection').addClass('d-none');
					 		$('#approvedInspection').addClass('d-none');
					 		$('#inspections > div > div.card-body > div:nth-child(1)').addClass('d-none');
					 	}
					 	
				    });
				    $(".upfile1").click(function(e){
						e.preventDefault()
						$("#imagess").trigger('click');
					});
				    $(document).on('change','#project_no',function(e){
					e.preventDefault();
					let id = $(this).val();
					_ajaxloaderOption('option_controller/pallet_color','POST',{id:id},'pallet-color');
					});
					$(document).on('change','#c_code',function(e){
						e.preventDefault();
						let id = $(this).val();
						_ajaxloaderOption('option_controller/pallet_docs','POST',{id:id},'pallet-image-docs');
					});
				})
				break;
			}
			case "joborder-project":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_joborder_project');
					$(document).on('change','#project_no',function(e){
						e.preventDefault();
						let id = $(this).val();
						_ajaxloaderOption('option_controller/design_project_docs','POST',{id:id},'design-project-docs');
					});
				    $(document).on("click","#form-request",function(e) {
				    		e.preventDefault();
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Project_View';
						_ajaxloader(thisUrl,"POST",val,"Modal-JobOrder-Project-View");
				    });
				    $(document).on("click",".btn-active",function(e) {
					 	e.preventDefault();
					 	$('.btn-inspection').removeClass('active');
					 	let element = $(this);
				    		let action = element.attr('data-action');
				    		let val = {id:$('#joborder').text()};
				    		if(action == 'material_request'){
				    			let thisUrl = 'view_controller/View_Joborder_Material';
							_ajaxloader(thisUrl,"POST",val,"View_Joborder_Material");
				    		}else{
				    			let thisUrl = 'view_controller/View_Joborder_Purchase';
							_ajaxloader(thisUrl,"POST",val,"View_Joborder_Purchase");
				    		}
				    });
				    $(document).on('click','.btn-inspection',function(e){
				    		e.preventDefault();
				    		$('.btn-active').removeClass('active');
				    		let val = {id:$('#joborder').text()};
					 	let thisUrl = 'view_controller/View_Inpection_Stocks';
						_ajaxloader(thisUrl,"POST",val,"View-Inpection-Project");
						$('#requestInspection').removeClass('d-none');
						$('#approvedInspection').addClass('d-none');
					 	$('#rejectedInspection').addClass('d-none');
					 	$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').addClass('d-none');
					 	$('#inspections > div > div.card-body > div:nth-child(1)').removeClass('d-none');
				    });
				    $(document).on("click",".btn-status",function(e) {
					 	e.preventDefault();
					 	let element = $(this);
					 	let action = element.attr('data-action');
					 	$('#'+action).removeClass('d-none');
					 	if(action == 'requestInspection'){
					 		$('#inspections > div > div.card-body > div:nth-child(1)').removeClass('d-none');
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').addClass('d-none');
					 		$('#approvedInspection').addClass('d-none');
					 		$('#rejectedInspection').addClass('d-none');
					 	}else if(action == 'approvedInspection'){
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').removeClass('d-none');
					 		$('#requestInspection').addClass('d-none');
					 		$('#rejectedInspection').addClass('d-none');
					 		$('#inspections > div > div.card-body > div:nth-child(1)').addClass('d-none');
					 	}else if(action == 'rejectedInspection'){
					 		$('#inspections > div > div.card-header.bg-dark > div.card-toolbar > button:nth-child(1)').removeClass('d-none');
					 		$('#requestInspection').addClass('d-none');
					 		$('#approvedInspection').addClass('d-none');
					 		$('#inspections > div > div.card-body > div:nth-child(1)').addClass('d-none');
					 	}
					 	
				    });
				    $(".upfile1").click(function(e){
						e.preventDefault()
						$("#imagess").trigger('click');
					});
				})
				break;
			}
			case "data-joborder-finished":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_JobOrder_Finished';
						_ajaxloader(thisUrl,"POST",val,"Modal_JobOrder_Finished");
				    });
				})
				break;
			}
			case "data-joborder-create-request":{
				_ajaxloaderOption('option_controller/Designer_option','POST',false,'design_option');
				_initCurrency_format('#labor_cost');
				_initUsers_option();
				$('#project_no').on('change',function(){
					let id = $(this).val();
					_initColor_option(id);
				});
				$('#c_code').on('change',function(){
					let id = $(this).val();
					_initImage_option(id);
				})
			  	break;
			}

			case "data-production-Salesorder-Create":{
				_initDatepicker('#date_order');
				break;
			}
			//supervisor
			case "data-supervisor-project-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Joborder_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Production_View");
				    });
				})
				break;
			}
			case "data-supervisor-material-request":{
				$(document).ready(function() { 
					_initJOBORDER1_option();
					$(document).on('change','#joborder',function(e){
						var id = $(this).val();
						let val = {id:id};
						let thisUrl = 'view_controller/View_Joborder_Data';
						_ajaxloader(thisUrl,"POST",val,"View_Production_Data");
					 });
				 });
				_initNumberOnly("#quantity");
				_initItem_option();
				$(document).on('change','select[name=item]',function(e){
					var action = $(this).val().split('-');
					_initItemQTY_option(action[0]);
				});
				_initpurchasing_mat();
				break;
			}
			case "data-supervisor-purchase-request":{
				$(document).ready(function() { 
					_initJOBORDER1_option();
					$(document).on('change','#joborder',function(e){
						var id = $(this).val();
						let val = {id:id};
						let thisUrl = 'view_controller/View_Joborder_Data';
						_ajaxloader(thisUrl,"POST",val,"View_Production_Data");
					 });
				 });
				_initNumberOnly("#quantity");
				_initItem_option();
				$(document).on('change','select[name=item]',function(e){
					_initItemqty_option();
				});
				_initpurchasing('add_purchase');
				$('.hide_special').hide();
				$(".special").removeAttr("name");
				$(document).on('change','select[name=special_option]',function(){
					let option = $(this).val();
					if(option == 'common'){
						$('.hide_common').show();
						$(".special").removeAttr("name");
						$(".common").attr("name",'item');
						$('.hide_special').hide();
					}else{
						$('.hide_common').hide();
						$(".common").removeAttr("name");
						$(".special").attr("name",'item');
						$('.hide_special').show();
					}
				});
				break;
			}

			//Reviewer
			case "data-request-material-superuser":{
				KTDatatablesDataSourceAjaxClient.init('tbl_request_material_superuser');
				$(document).ready(function() {
				    $(document).on("click","#form-request",function() {
					 	let thisUrl = 'modal_controller/Modal_Request_Material';
						_ajaxloader(thisUrl,"POST",{id:$(this).attr('data-id')},"Modal_Request_Material");
				    });
				})
				break;
			}
			case "data-return-item-customer":{
				KTDatatablesDataSourceAjaxClient.init('tbl_return_item_customer_superuser');
				 $('input[name=so_no]').on('blur',function(e){
				   	e.preventDefault();
				   	_ajaxloaderOption('option_controller/so_no_item',"POST",{so_no:$(this).val()},'so_no_item');
				 });
				break;
			}
			case "data-return-item":{
				KTDatatablesDataSourceAjaxClient.init('tbl_return_item_warehouse_superuser');
			   $('select[name=type]').on('change',function(e){
			   	e.preventDefault();
			   	_ajaxloaderOption('option_controller/item_list',"POST",{type:$(this).val()},'item_list');
			   });
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
					 $(document).on("click","#form-request",function(){
					 	let val = {id:$(this).attr('data-id')};
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
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Stocks_OfficeSupplies_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_OfficeSupplies_View");
				    });
				})
				break;
			}
			case "data-finishproduct-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Finishproduct_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Finishproduct_View");
				    });
				})
				break;
			}
			case "data-salesorder-release-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_SalesOrder';
						_ajaxloader(thisUrl,"POST",val,"Modal_SalesOrder_Release_View");
				    });
				})
				break;
			}
			case "data-salesorder-return-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_SalesOrder_Return';
						_ajaxloader(thisUrl,"POST",val,"Modal_SalesOrder_Return_View");
				    });
				})
				break;
			}
			case "data-material-request-stocks":{
				KTDatatablesDataSourceAjaxClient.init('tbl_material_request_stocks');
				$(document).ready(function() {
					$(document).on("click","#form-request-inprogress",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Material_Request_Stocks_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Request_Stocks_View");
				     });
				     $(document).on('click','.btn-change',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').addClass('d-none');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Generate Request Item <i class="flaticon2-fast-next blink_me"></i>');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');	
					 	}
					 });
					 $(document).on('click','.btn-view-cancel',function(e){
					 	e.preventDefault();
			  			let TableURL = baseURL + 'modal_controller/Modal_Material_Request_Cancel_View';
						let TableData = [{data:'item'},{data:'balance'},{data:'date_created'},{data:'action'}];
						_DataTableLoader1('tbl_material_cancelled',TableURL,TableData,$('#joborder').attr('data-id'));
						$('#ModalTalble').modal('show');
					 });
				})
				break;
			}
			case "data-material-request-project":{
				KTDatatablesDataSourceAjaxClient.init('tbl_material_request_project');
				$(document).ready(function() {
					$(document).on("click","#form-request-inprogress",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Material_Request_Project_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Request_Project_View");
				     });
				     $(document).on('click','.btn-change',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').addClass('d-none');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Generate Request Item <i class="flaticon2-fast-next blink_me"></i>');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
						 	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');	
					 	}
					 });
					 $(document).on('click','.btn-view-cancel',function(e){
					 	e.preventDefault();
			  			let TableURL = baseURL + 'modal_controller/Modal_Material_Request_Cancel_View';
						let TableData = [{data:'item'},{data:'balance'},{data:'date_created'},{data:'action'}];
						_DataTableLoader1('tbl_material_cancelled',TableURL,TableData,$('#joborder').attr('data-id'));
						$('#ModalTalble').modal('show');
					 });
				})
				break;
			}
			case "data-purchase-stocks-request":{
				KTDatatablesDataSourceAjaxClient.init('tbl_purchase_request_stocks');
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Stocks_Request_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Stocks_Request_View");
				       });
					 $(document).on("click","#form-request-inprogress",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Stocks_Inprogress_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Stocks_Inprogress_View");
				       });
				     $(document).on('click','.btn-change',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('.btn-submit').removeClass('d-none').attr('id','btn-save');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').addClass('d-none');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
						 	$('.btn-submit').addClass('d-none').removeAttr('id');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');	
					 	}
					 }); 
					 $(document).on('click','.btn-change-process',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('.btn-submit-process').removeClass('d-none').attr('id','btn-save-process');
						 	$('#view-details').addClass('d-none');
						 	$('#view-purchased').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
						 	$('.btn-submit-process').addClass('d-none').removeAttr('id');
						 	$('#view-details').removeClass('d-none');
						 	$('#view-purchased').addClass('d-none');	
					 	}
					 }); 
					
				})
				break;
			}
			case "data-purchase-project-request":{
				KTDatatablesDataSourceAjaxClient.init('tbl_purchase_request_project');
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Project_Request_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Project_Request_View");
				       });
					 $(document).on("click","#form-request-inprogress",function() {
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Purchase_Project_Inprogress_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchase_Project_Inprogress_View");
				       });
				     $(document).on('click','.btn-change',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('.btn-submit').removeClass('d-none').attr('id','btn-save');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').addClass('d-none');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
						 	$('.btn-submit').addClass('d-none').removeAttr('id');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
						 	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');	
					 	}
					 }); 
					 $(document).on('click','.btn-change-process',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let action = $(this).attr('data-action');
					 	if(action == 'view'){
						 	$(this).attr('data-action','back');
						 	$(this).html('<i class="flaticon2-fast-back blink_me"></i> Back');
						 	$('.btn-submit-process').removeClass('d-none').attr('id','btn-save-process');
						 	$('#view-details').addClass('d-none');
						 	$('#view-purchased').removeClass('d-none');
					 	}else{
						 	$(this).attr('data-action','view');
						 	$(this).html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
						 	$('.btn-submit-process').addClass('d-none').removeAttr('id');
						 	$('#view-details').removeClass('d-none');
						 	$('#view-purchased').addClass('d-none');	
					 	}
					 }); 
					
				})
				break;
			}
			case "data-supplier":{
				KTDatatablesDataSourceAjaxClient.init('tbl_supplier');
				 $(document).ready(function() {
					_initCurrency_format("#price");
					$('select[name=type]').on('change',function(e){
						_ajaxloaderOption('option_controller/item_list','POST',{type:$(this).val()},'item_list');
					});
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
			case "data-rawmaterials":{
				KTDatatablesDataSourceAjaxClient.init('tbl_rawmaterials_add');
				_initCurrency_format("#price");
				_initCurrency_format("#prices");
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
				KTDatatablesDataSourceAjaxClient.init('tbl_production_stockss');
				_initNumberOnly('#stockss');
				  $(document).ready(function() {
					   $(document).on("click","#form-request",function() {
						let id = $(this).attr('data-id');
						let val = {id:id};
						let thisUrl = 'modal_controller/Modal_Production_Stocks';
						_ajaxloader(thisUrl,"POST",val,"Modal_Production_Stocks");
				    });
				  });
				break;
			}
			case "data-spareparts":{
				KTDatatablesDataSourceAjaxClient.init('tbl_spareparts_add');
				  $(document).ready(function() {
					   $(document).on("click","#form-request",function() {
						let val = {id:$(this).attr('data-id'),type:1};
						let thisUrl = 'modal_controller/Modal_Other_Materials_view';
						_ajaxloader(thisUrl,"POST",val,"Modal_Other_Materials_view");
				    });
				  });
				break;
			}
			case "data-officesupplies":{
				KTDatatablesDataSourceAjaxClient.init('tbl_officesupplies_add');
				  $(document).ready(function() {
					   $(document).on("click","#form-request",function() {
					   	let val = {id:$(this).attr('data-id'),type:2};
						let thisUrl = 'modal_controller/Modal_Other_Materials_view';
						_ajaxloader(thisUrl,"POST",val,"Modal_Other_Materials_view");
				    });
				  });
				break;
			}
			case"data-users":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Users';
						_ajaxloader(thisUrl,"POST",val,"Modal_Users");
				    });
				})
				break;
			}
			case "data-user-create":{
				_initAvatar('avatar');	
				 $(document).on("blur","input[name=username]",function() {
				 	 var username = $(this).val();
					 _initUser(username);	
				 });			
				break;
			}

			//ADMIN
			
			case "data-approval-salesorder":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_SalesOrder';
						_ajaxloader(thisUrl,"POST",val,"Modal_SalesOrder_Approval");
				    });
				})
				break;
			}
			case"data-approval-usersreqeuest":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Users';
						_ajaxloader(thisUrl,"POST",val,"Modal_Approval_UsersRequest");
				    });
				})
				break;
			}
			case "data-profile-update":{
				let thisUrl = 'view_controller/View_Profile';
				_ajaxloader(thisUrl,"POST",false,"View_Profile");
				break;
			}

			case "data-voucher-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Voucher_Customer';
						_ajaxloader(thisUrl,"POST",val,"Modal_Voucher_Customer");
				    });
				})
				break;
			}
			case "data-customer":{
				KTDatatablesDataSourceAjaxClient.init('tbl_customer_list');
				_ajaxloaderOption('option_controller/region_option','POST',false,'region');
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let action = $(this).attr('data-action');
					 	if(action == 'create'){
					 		$('.save').attr('data-action','create');
					  		$('input[name="firstname"]').val('').removeAttr('data-id');
					  		$('input[name="lastname"]').val('');
					  		$('input[name="mobile"]').val('');
					  		$('input[name="email"]').val('');
					  		$('input[name="address"]').val('');
					  		$('input[name="city"]').val('');
					  		$('input[name="province"]').val('');
					  		$('select[name="region"]').val('').change();
					  		$(document).on("blur",'input[name="email"]',function(e){
								_ajaxloaderOption('option_controller/email_option','POST',{id:$(this).val()},'email');
							});
					 	}else{
					 		let val = {id:$(this).attr('data-id')};
						 	let thisUrl = 'modal_controller/Modal_Customer_View';
							_ajaxloader(thisUrl,"POST",val,"Modal_Customer_View");
					 	}
				     });
					
				})
				break;
			}
			case "data-joborder-stocks-supervisor":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_joborder_stocks');
					$(document).on("click","#form-request",function() {
				 		let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Stocks_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Joborder_Stocks_Supervisor");
				     });
				     $(document).on("click","#form-purchased",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Purchased_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchased_Request_Supervisor");
				     });
				})
				break;
			}
			case "data-joborder-project-supervisor":{
				$(document).ready(function() {
					KTDatatablesDataSourceAjaxClient.init('tbl_joborder_project');
					$(document).on("click","#form-request",function() {
				 		let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Project_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Joborder_Project_Supervisor");
				     });
				     $(document).on("click","#form-purchased",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Purchased_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchased_Request_Supervisor");
				     });
				})
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
			case "reports-cashposition":{
				$(document).ready(function(){
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
				})
				break;
			}
			case "data-customer-customized-sales":{
				$(document).ready(function(){
					  KTDatatablesDataSourceAjaxClient.init('tbl_customized_sales');
					  $('.summernote').summernote({
					     height: 300
					  });
					  $('.summernote1').summernote({
					     height: 300
					  });
					$(document).on("click","#form-request",function() {
					 	let thisUrl = 'modal_controller/Modal_Customized_View';
						_ajaxloader(thisUrl,"POST",{id:$(this).attr('data-id')},"Modal_Customized_View");
				     });
				});
				break;
			}
			case "data-customer-customized-superuser":{
				$(document).ready(function(){
					KTDatatablesDataSourceAjaxClientCreative.init('tbl_customized');
					 $('body').delegate('.view-details','click',function(e){
					 	let thisUrl = 'modal_controller/Modal_Customized_View';
						_ajaxloader(thisUrl,"POST",{id:$(this).attr('data-id')},"Modal_Customized_View_Superuser");
				       });
				      $('body').delegate('.btn-approved','click',function(e){
			                    e.preventDefault();
			                    e.stopImmediatePropagation();
			                    let element = $(this);
			                        Swal.fire({
			                          title: "Do you want to move this form? Subject: "+element.attr('data-name'),
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
								 	let thisUrl = 'update_controller/Update_Customized_Approval_Request';
									_ajaxloader(thisUrl,"POST",{id:id,status:status},"Update_Customized_Approval_Request");
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
								 	let thisUrl = 'update_controller/Update_Customized_Approval_Request';
									_ajaxloader(thisUrl,"POST",{id:id,status:status,remarks:result.value},"Update_Customized_Approval_Request");
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
			                          title: "Subject: "+element.attr('data-name')+"</br>Reason to Remarks",
			                          text: element.attr('data-remarks'),
			                          showConfirmButton:false,
			                          showCancelButton: false,
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      })
			            });

				});
				break;
			}
			case "data-pre-order-request":{
				$(document).ready(function(){
					KTDatatablesDataSourceAjaxClientCreative.init('tbl_preoder');
				     $('body').delegate('.btn-approved','click',function(e){
		                    e.preventDefault();
		                    e.stopImmediatePropagation();
		                    let element = $(this);
		                        Swal.fire({
		                          title: "Do you want to move this form? Trans #: "+element.attr('data-name'),
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
							 	let thisUrl = 'update_controller/Update_Pre_Order_Request';
								_ajaxloader(thisUrl,"POST",{id:id,status:status},"Update_Pre_Order_Request");
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
			                    inputPlaceholder: 'Enter your remarks',
			                    confirmButtonText: 'Submit',
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
								 	let thisUrl = 'update_controller/Update_Pre_Order_Request';
									_ajaxloader(thisUrl,"POST",{id:id,status:status,remarks:result.value},"Update_Pre_Order_Request");
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
			                          title: "Trans #:: "+element.attr('data-name')+"</br>Reason to Remarks",
			                          text: element.attr('data-remarks'),
			                          showConfirmButton:false,
			                          showCancelButton: false,
			                          cancelButtonText: "close!",
			                          reverseButtons: true
			                      })
			            });

				});
				break;
			}
			case "data-inquiry":{
				KTDatatablesDataSourceAjaxClient.init('tbl_inquiry');
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let status = $(this).attr('data-status');
					 	let val = {id:id,status:status};
					 	let thisUrl = 'modal_controller/Modal_Inquiry_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Inquiry_View");
				    });
				})
				break;
			}
		}
	}

	var _initView = async function(view,response){
	  switch(view){

	  	case "superuser_dashboard":{
		  	   $('#table_rawmats > tbody:last-child').empty();
		  	   if(response.rawmats.length > 0){
		  	   	for(let i=0;i<response.rawmats.length;i++){
	        			$('#table_rawmats > tbody:last-child').append('<tr>'
					+'<td>'+response.rawmats[i].item+'</td>'
					+'<td>'+response.rawmats[i].stocks+'</td>'
					+'</tr>');
			     }
		  	   }else{
				  $('#table_rawmats > tbody:last-child').append('<tr><td class="text-center">NO OUT OF STOCKS</td></tr>');
		  	   }
		  	   
			   $('#table_office > tbody:last-child').empty();
			   if(response.spare.length > 0){
			   	for(let i=0;i<response.office.length;i++){
	        			$('#table_office > tbody:last-child').append('<tr>'
					+'<td>'+response.office[i].item+'</td>'
					+'<td>'+response.office[i].stocks+'</td>'
					+'</tr>');
			     }
			   }else{
			   	$('#table_office > tbody:last-child').append('<tr><td class="text-center">NO OUT OF STOCKS</td></tr>');
			   }
			    $('#table_supplies > tbody:last-child').empty();
			    if(response.spare.length > 0){
			    	   for(let i=0;i<response.spare.length;i++){
		        			$('#table_supplies > tbody:last-child').append('<tr>'
						+'<td>'+response.spare[i].item+'</td>'
						+'<td>'+response.spare[i].stocks+'</td>'
						+'</tr>');
				   }
			    }else{
			    	 $('#table_supplies > tbody:last-child').append('<tr><td class="text-center">NO OUT OF STOCKS</td></tr>');
			    }
		  	   
	  	   break;
	  	}
	  	//Modal View//
	  	//designer
	  	case "Modal_Designer_Customization":{
	  		if(!response == false){
	               $('#date_order').text(response.date_order);
	               $('#so_no').text(response.so_no);
	               tinyMCE.get('kt-tinymce-4').setContent(response.remarks);
	               if(response.status == 'REQUEST'){
	               	$('#button_status').html('<button type="button" id="PENDING" class="btn btn-success font-weight-bolder btn_approved">APPROVE</button>');
	               }else{
	               	$('#button_status').remove();
	               }
	  		}
	  		break;
	  	}
	  	//production
	  	case "Modal_JobOrder_Request_View":{
	  		if(!response == false){
	  			$('#project_no').text(response.project_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			$('#unit').val(response.unit);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.c_code));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			let page = $('#page').val();
	  			$('#update_request').empty();
	  			if(response.status == 'MATERIAL REQUEST'){
	  				var hrefURL = baseURL+'gh/'+page+'/joborder_pending/'+btoa(response.production_no);
	  			}else{
	  				$('#update_request').append('<a  id="update_href" class="btn btn-success font-weight-bolder ml-sm-auto my-1">UPDATE</a>');
	  				var hrefURL = baseURL+'gh/'+page+'/joborder_update/'+btoa(response.production_no);
	  			}
	  			$("#update_href").click(function(){
				    $(this).attr("href", hrefURL);
				});
	  		}
	  		break;
	  	}
	  	case "Modal-JobOrder-Stocks-View":{
	  		if(!response == false){
	  			$('#joborder').text(response.production_no);
	  			$('#title').val(response.title);
	  			$('#c_name').val(response.c_name);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#docs").val(response.docs);
	  			$('#unit').val(response.unit);
	  			$('.status-hide').show();
	  			if(response.unit == 0){
	  				$('.status-hide').hide();
	  			}
	  			$('#requestModal').modal('show');
	  		}
	  		break;
	  	}
	  	case "Modal-JobOrder-Project-View":{
	  		if(!response == false){
	  			$('#joborder').text(response.production_no);
	  			$('#title').val(response.title);
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#docs").val(response.docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$('.status-hide').show();
	  			if(response.status == 2){
	  				$('.status-hide').hide();
	  			}
	  			$('#requestModal').modal('show');
	  		}
	  		break;
	  	}
	  	case "View-Inpection-Project":{
	  		$("#requestInspection").empty();
	  		$("#approvedInspection").empty();
	  		$("#rejectedInspection").empty();
  			for(let i=0;i<response.length;i++){
  				if(response[i].status == 1){
  					$("#requestInspection").append('<div class="col-lg-2 col-xl-2" id="row_'+response[i].id+'">'
		  			+'<div class="image-input image-input-empty image-input-outline" style="background-image: url('+baseURL+'assets/images/inspection/'+response[i].images+')">'
					+'<div class="image-input-wrapper"></div>'
					+'  	<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="delete" data-id="'+response[i].id+'" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">'
					+'	   <i class="ki ki-bold-close icon-xs text-muted"></i>'
					+'	 </label>'
					+'  </div>'
		  			+'</div>');
  				}else if(response[i].status == 2){
  					$("#approvedInspection").append('<div class="col-lg-2 col-xl-2">'
		  			+'<div class="image-input image-input-empty image-input-outline" style="background-image: url('+baseURL+'assets/images/inspection/'+response[i].images+')">'
		  			+'<div class="image-input-wrapper"></div>'
		  			+'</div>'
		  			+'</div>');
  				}else{
  					$("#rejectedInspection").append('<div class="col-lg-2 col-xl-2">'
		  			+'<div class="image-input image-input-empty image-input-outline" style="background-image: url('+baseURL+'assets/images/inspection/'+response[i].images+')">'
		  			+'<div class="image-input-wrapper"></div>'
		  			+'</div>'
		  			+'</div>');
  				}
  			}
	  		break;
	  	}
	  	case "Modal_JobOrder_Finished":{
	  		if(!response == false){
	  			$('#project_no').text(response.project_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			$('#unit').val(response.unit);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.c_code));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  		}
	  		break;
	  	}

	  	//supervisor
	  	case "Modal_Production_View":{
	  		if(!response == false){
		  		if(response.status == 'COMPLETE'){
		  			$('#btn_request').remove();
		  			$('#btn_request1').remove();
		  		}else if(response.status == 'REQUEST' || response.status == 'PARTIAL'){
		  			$('#btn_request').html('<a  class="btn btn-success"  id="purchase_request">E.P Request</a>');
		  			$('#btn_request1').html('<a  class="btn btn-primary"    id="material_request">E.M Request</a>');
		  		}
		  		$('#project_no').text(response.project_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			$('#unit').val(response.unit);

		  		$('#c_name').val(response.c_name);
		  		$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
		  		$("#return_item").attr("href",baseURL + 'gh/supervisor/return-item/'+btoa(response.production_no));
		  		$("#material_request").attr("href",baseURL + 'gh/supervisor/material_request/'+btoa(response.production_no));
		  		$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  		$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
		  		$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  		$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
		  		$('#title').val(response.title);
		  		$('#unit').val(response.balance);
	  		}
	  		break;
	  	}

	  	//Reviewer
	  	case "Modal_SalesOrder_Release_View":{
	  		if(!response == false){
	               $('#date_order').text(response[0].date_order);
	               $('#so_no').text(response[0].so_no);
	               $('#si_no').text(response[0].si_no);
	               $('#c_name').text(response[0].c_name);
	               $('#mobile').text(response[0].mobile);
	               $('#email').text(response[0].email);
	               $('#b_address').text(response[0].b_address);
	               $('#b_city').text(response[0].b_city+','+response[0].b_province);
	               $('#s_address').text(response[0].s_address);
	               $('#s_city').text(response[0].s_city+','+response[0].s_province);
	               let dis = parseFloat((response[0].discount*100)/1);
	               $('#subtotal').text(response[0].subtotal);
	               $('#discount').text(dis+'%');
	               $('#total').text(response[0].total);
	               $('#downpayment').text(response[0].downpayment);
	               $('#grandtotal').text(response[0].grandtotal);
	               $('#vat').text(response[0].vat);
	               $('#shipping_fee').text(response[0].shipping_fee);
	             	$('#tbl_admin_salesorder_so > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_admin_salesorder_so > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response[i].title+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response[i].color+'</td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].qty+'</td>'
					+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].price+'</td>'
					+'</tr>');
				}
				if(response[0].status == 'APPROVED'){
					$('.hide_button').show();
				}else if(response[0].status == 'DELIVERED'){
					$('.hide_button').hide();
				}
	  		}
	  		break;
	  	}
	  	case "Modal_SalesOrder_Return_View":{
	  		if(!response == false){
	               $('#date_order').text(response[0].date_order);
	               $('#so_no').text(response[0].so_no);
	               $('#so_no').text(response[0].so_no);
	               $('#c_name').text(response[0].c_name);
	               $('#b_address').text(response[0].b_address);
	               $('#b_city').text(response[0].b_city+','+response[0].b_province);
	               $('#b_zipcode').text(response[0].b_zipcode);
	               $('#s_address').text(response[0].s_address);
	               $('#s_city').text(response[0].s_city+','+response[0].s_province);
	               $('#s_zipcode').text(response[0].s_zipcode);
	               $('#total').text(response[0].total);
	             	$('#tbl_salesorder_return_item > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_salesorder_return_item > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response[i].title+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response[i].color+'</td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].qty+'</td>'
					+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].price+'</td>'
					+'<td class="align-middle text-right  font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].status+'</td>'
					+'</tr>');
				}
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
	  			$('#requestModal').modal('show');
	  		} 
	  		break;
	  	}
	  	
	  	case "Modal_Finishproduct_View":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			_initNumberOnly("#alert");
	  			$('input[name="stocks"]').val(response.stocks);
	  			$('input[name="stocks_alert"]').val(response.stock_alert);
		  		$('#project_no').text(response.project_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			
	  			$('input[name=item]').val(response.item);
		  		$('#c_name').val(response.c_name);
		  		$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
		  	
		  		$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  		$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
		  		$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  		$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  		}
	  		break;
	  	}
	  	case "Modal_Material_Request_View":{
	  		if(!response == false){
	  			$('#production_no_input').val(response[0].production_no);
	  		     $('#production_no').text('JOB ORDER: '+response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title+' ('+response[0].c_name+')');
	  		     $('#requestor').text('REQUESTOR: '+response[0].production);
	  		     $('#unit').text('QTY: '+response[0].unit);
	               $('#status').text(response[0].status);
	               $('#btn_hide').html('<a type="button" id="update_href" class="btn btn-success font-weight-bolder">UPDATE</a>');
	               $('#date_created').text(response[0].date_created);
	             	$('#tbl_reviewer_material_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_reviewer_material_modal > tbody:last-child').append('<tr >'
					+'<td class="align-middle pl-0 border-0">'+response[i].item+'</td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].balance+' '+response[i].units+'</td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].remarks+'</td>'
					+'</tr>');
				 }
				  $("#update_href").click(function(){
				    $(this).attr("href", baseURL+'gh/superuser/material-request-update/'+btoa(response[0].production_no));
				});
	  		}
	  		break;
	  	}
	  	case "Modal_Material_Request_Stocks_View":{
	  		if(!response == false){
	  		     $('#joborder').text('JOB ORDER: '+response.row.production_no).attr('data-id',response.row.production_no);
	  		     $('.title').text(response.row.title);
	  		     $('.color').text(response.row.c_name);
	  		     $('.requestor').text('Created By: '+response.row.requestor);
	  		     $('.date_created').text(response.row.date_created);
	  		     $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.row.image+')');
	  		     let count = '('+response.count+')';
	  		     if(response.count <=0){
	  		     	count ="";
	  		     }
	  		     $('#count-cancelled').text(count);
	  		     $('#tbl_material_request_stocks_modal > tbody').empty();
	  		     $('#tbl_material_accept > tbody').empty();
	  		     $('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Quantity Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');

				let TableURL = baseURL + 'modal_controller/Modal_Material_Request_List_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_material_request_stocks_modal',TableURL,TableData,response.row.production_no);

				let TableURL1 = baseURL + 'modal_controller/Modal_Material_Request_Accept_View';
				let TableData1 = [{data:'remove', className: "text-center"},{data:'item'},{data:'balance',className: "text-center"},{data:'stocks', className: "text-center"},{data:'input', className: "text-center"},{data:'action', className: "text-center"}];
				_DataTableLoader1('tbl_material_accept',TableURL1,TableData1,response.row.production_no);

				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	 
	  	case "Modal_Material_Request_Project_View":{
	  		if(!response == false){
	  		     $('#joborder').text('JOB ORDER: '+response.row.production_no).attr('data-id',response.row.production_no);
	  		     $('.title').text(response.row.title);
	  		     $('.requestor').text('Created By: '+response.row.requestor);
	  		     $('.date_created').text(response.row.date_created);
	  		     $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.row.image+')');
	  		     let count = '('+response.count+')';
	  		     if(response.count <=0){
	  		     	count ="";
	  		     }
	  		     $('#count-cancelled').text(count);
	  		     $('#tbl_material_request_stocks_modal > tbody').empty();
	  		     $('#tbl_material_accept > tbody').empty();
	  		     $('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Quantity Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');

				let TableURL = baseURL + 'modal_controller/Modal_Material_Request_List_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_material_request_stocks_modal',TableURL,TableData,response.row.production_no);

				let TableURL1 = baseURL + 'modal_controller/Modal_Material_Request_Accept_View';
				let TableData1 = [{data:'remove', className: "text-center"},{data:'item'},{data:'balance',className: "text-center"},{data:'stocks', className: "text-center"},{data:'input', className: "text-center"},{data:'action', className: "text-center"}];
				_DataTableLoader1('tbl_material_accept',TableURL1,TableData1,response.row.production_no);

				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	 
	  	case "Modal_Purchase_Stocks_Request_View":{
	  		if(!response == false){
	  		     $('#joborder').text('JOB ORDER: '+response.production_no).attr('data-id',response.production_no);
	  		     $('.title').text(response.title);
	  		     $('.color').text(response.c_name);
	  		     $('.requestor').text(response.production);
	               $('.date_created').text(response.date_created);
	               $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.image+')');

	               let TableURL = baseURL + 'modal_controller/Modal_Purchase_Request_List_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_purchasing_modal',TableURL,TableData,response.production_no);

				let TableURL1 = baseURL + 'modal_controller/Modal_Purchase_Request_Estimate_View';
				let TableData1 = [{data:'item'},{data:'quantity',className: "text-center"},{data:'input', className: "text-center"}];
				_DataTableLoader2('tbl_purchasing_estimate',TableURL1,TableData1,response.production_no);

				$('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit').addClass('d-none').removeAttr('id');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
				$('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Stocks_Inprogress_View":{
	  		if(!response == false){
	               $('.joborder').text('JOB ORDER: '+response.production_no).attr('data-id',response.production_no);
	               $('.fund_no').text('Trans #: '+response.fund_no).attr('data-id',response.fund_no);;
	  		     $('.title').text(response.title);
	  		     $('.color').text(response.c_name);
	  		     $('.requestor').text(response.production);
	               $('.date_created').text(response.date_created);
	               $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.image+')');
	               $('.btn-change-process').attr('data-action','view');
	             	$('.btn-change-process').html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit-process').addClass('d-none').removeAttr('id');
	             	$('#view-details').removeClass('d-none');
				$('#view-purchased').addClass('d-none');
				$('[data-toggle="tooltip"]').tooltip();
				 $('.btn-hide').hide();
				 if(response.status == 4){
				 	$('.btn-hide').show();
				 }
	               let TableURL = baseURL + 'modal_controller/Modal_Purchase_Inprogress_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'amount'},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_purchasing_inprogress_modal',TableURL,TableData,response.fund_no);
	             	_ajaxloaderOption('option_controller/purchase_product','POST',{id:response.fund_no},'purchase_product');
	             	 $(document).on('change','select[name=item]',function(e){
	             	 	e.preventDefault();
	             	 	_ajaxloaderOption('option_controller/supplier_list','POST',{id:$(this).val(),type:1},'supplier_list');
	             	 });
	             	 _ajaxloaderOption('option_controller/purchase_transaction','POST',{id:response.fund_no},'purchase_transaction');
				$('[data-toggle="tooltip"]').tooltip();
				_initCurrency_format('.amount');
				$('#kt_datepicker_5').datepicker({
					   rtl: KTUtil.isRTL(),
					   todayHighlight: true,
					   templates: arrows
				 });	
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Project_Request_View":{
	  		if(!response == false){
	  		     $('#joborder').text('JOB ORDER: '+response.production_no).attr('data-id',response.production_no);
	  		     $('.title').text(response.title);
	  		     $('.requestor').text(response.production);
	               $('.date_created').text(response.date_created);
	               $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.image+')');

	               let TableURL = baseURL + 'modal_controller/Modal_Purchase_Request_List_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_purchasing_modal',TableURL,TableData,response.production_no);

				let TableURL1 = baseURL + 'modal_controller/Modal_Purchase_Request_Estimate_View';
				let TableData1 = [{data:'item'},{data:'quantity',className: "text-center"},{data:'input', className: "text-center"}];
				_DataTableLoader2('tbl_purchasing_estimate',TableURL1,TableData1,response.production_no);

				$('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit').addClass('d-none').removeAttr('id');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
				$('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Project_Inprogress_View":{
	  		if(!response == false){
	              $('.joborder').text('JOB ORDER: '+response.production_no).attr('data-id',response.production_no);
	               $('.fund_no').text('Trans #: '+response.fund_no).attr('data-id',response.fund_no);;
	  		     $('.title').text(response.title);
	  		     $('.requestor').text(response.production);
	               $('.date_created').text(response.date_created);
	               $('.image-view').css('background-image','url('+baseURL+'assets/images/design/project_request/images/'+response.image+')');
	               $('.btn-change-process').attr('data-action','view');
	             	$('.btn-change-process').html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit-process').addClass('d-none').removeAttr('id');
	             	$('#view-details').removeClass('d-none');
				$('#view-purchased').addClass('d-none');
				$('[data-toggle="tooltip"]').tooltip();
				 $('.btn-hide').hide();
				 if(response.status == 4){
				 	$('.btn-hide').show();
				 }
	               let TableURL = baseURL + 'modal_controller/Modal_Purchase_Inprogress_View';
				let TableData = [{data:'item'},{data:'quantity',className: "text-center"},{data:'amount'},{data:'remarks', className: "text-center"}];
				_DataTableLoader1('tbl_purchasing_inprogress_modal',TableURL,TableData,response.fund_no);
	             	_ajaxloaderOption('option_controller/purchase_product','POST',{id:response.fund_no},'purchase_product');
	             	 $(document).on('change','select[name=item]',function(e){
	             	 	e.preventDefault();
	             	 	_ajaxloaderOption('option_controller/supplier_list','POST',{id:$(this).val(),type:1},'supplier_list');
	             	 });
	             	 _ajaxloaderOption('option_controller/other_material_p_transaction','POST',{id:response.fund_no},'other_material_p_transaction');
				$('[data-toggle="tooltip"]').tooltip();
				_initCurrency_format('.amount');

				KTBootstrapDatepicker.init();
				$(".datepicker").css('width', '360px'); 
	  		}
	  		break;
	  	}


	  	case "Modal_Material_Request_Complete_View":{
	  		if(!response == false){
	  		     $('#production_no_c').text('JOB ORDER: '+response[0].production_no);
	  		     $('#title_c').text('ITEM: '+response[0].title+' ('+response[0].c_name+')');
	  		     $('#unit_c').text('QTY: '+response[0].unit);
	  		     $('#requestor_c').text('REQUESTOR: '+response[0].production);
	               $('#date_created_c').text(response[0].date_created);
	             	$('#tbl_purchasing_complete_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_purchasing_complete_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
						+'<td class="align-middle pl-0">'+response[i].item+' </td>'
						+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].quantity+'</td>'
						+'</tr>');
				 }
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Stocks_View":{
	  		if(!response == false){
	  		     $('#request_id').text('REQUEST NO: '+response[0].request_id);
	  		     $('#requestor').text('PURCHASER: '+response[0].purchaser);
	  		     if(response[0].status == 'PENDING'){
	  		     	$('#buttons_status').remove();
				}else if(response[0].status == 'APPROVED' || response[0].status == 'PARTIAL'){
					$('#buttons_status').html('<a  id="update_href" class="btn btn-success font-weight-bolder ml-sm-auto my-1">UPDATE</a>');
	  		     }else if(response[0].status == 'COMPLETE'){
	  		     	$('#buttons_status').remove();
	  		     }
	               $('#status').text(response[0].status);
	               $('#date_created').text(response[0].date_created);
	             	$('#tbl_purchase_stocks_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_purchase_stocks_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
					+'<td class="align-middle pl-0">'+response[i].item+' </td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].balance+' '+response[i].unit+'</td>'
					+'<td class="align-middle text-left text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].type+'</td>'
					+'</tr>');
				 }
				$("#update_href").click(function(){
					   $(this).attr("href", baseURL+'gh/superuser/purchase-stocks-process/'+btoa(response[0].request_id));
				});
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Stocks_Complete_View":{
	  		if(!response == false){
	  		     $('#request_ids').text('REQUEST NO: '+response[0].request_id);
	  		     $('#requestors').text('PURCHASER: '+response[0].purchaser);
	               $('#statuss').text(response[0].status);
	               $('#date_created_cs').text(response[0].date_complete);
	             	$('#tbl_purchase_stocks_complete_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_purchase_stocks_complete_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
					+'<td class="align-middle pl-0">'+response[i].item+' </td>'
					+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].balance+' '+response[i].unit+'</td>'
					+'</tr>');
				 }
	  		}
	  		break;
	  	}
	  
	  
	  	case "Modal_SupplierItem_View":{
	  		if(!response == false){
	  			_initCurrency_format("#price_s");
	  			$('input[name=ss_id]').val(response.ss_id);
	  			$('input[name=item]').val(response.m_item);
	  			$('input[name=price]').val(response.ss_price);
	  			$('select[name=status]').val(response.ss_status).change();
	  		}
	  		break;
	  	}
	  	case "Modal_RawMaterial_view":{
	  		if(response != false){
	  			
	  			$('input[name=id]').val(response.id);
	  			$('#item').val(response.item);
	  			if(!response.price || response.price == '0') {
					var tal = '';
				}else{
					var tal = _formatnumbercommat(response.price);
				}
	  			$('.price').val(tal);
	  			$('#unit').val(response.unit);
	  			$('select[name=status]').val(response.status).change();
	  			$('#exampleModal').modal('show');
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
	  	
	  	case "Modal_OfficeSupplies_Request":{
	  		if(!response == false){
	  		     $('#request_id').text('REQUEST NO: '+response[0].request_id);
	  		     $('#requestor').text('REQUESTOR : '+response[0].requestor);
	               $('#date_created').text('DATE: '+response[0].date_created);
	             	$('#tbl_admin_project_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	             			$('#tbl_officesupplies_request_modal > tbody:last-child').html('<tr class="font-size-lg font-weight-bolder h-65px">'
						+'<td class="align-middle pl-0">'+response[i].item+'</td>'
						+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].balance+'</td>'
						+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].remarks+'</td>'
						+'</tr>');
				 }
				 $('#button_status').html('<a href="'+baseURL+'gh/superuser/officesupplies-request-update/'+btoa(response[0].request_id)+'"  class="btn btn-success">UPDATE</a>');
	  		}
	  		break;
	  	}
	  	case "Modal_SpareParts_Request":{
	  		if(!response == false){
	  		     $('#request_id').text('REQUEST NO: '+response[0].request_id);
	  		     $('#requestor').text('REQUESTOR : '+response[0].requestor);
	               $('#date_created').text('DATE: '+response[0].date_created);
	             	$('#tbl_admin_project_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	             			$('#tbl_spareparts_modal > tbody:last-child').html('<tr class="font-size-lg font-weight-bolder h-65px">'
						+'<td class="align-middle pl-0">'+response[i].item+'</td>'
						+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].balance+'</td>'
						+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].remarks+'</td>'
						+'</tr>');
				 }
				 $('#button_status').html('<a href="'+baseURL+'gh/superuser/spareparts-request-update/'+btoa(response[0].request_id)+'"  class="btn btn-success">UPDATE</a>');
	  		}
	  		break;
	  	}
	  	case "Modal_Users":{
	  		if(!response == false){
	  			let dis = parseFloat((response.commission*100)/1);
	  			$('input[name=id]').val(response.id);
	  			$('input[name=firstname]').val(response.firstname);
	  			$('input[name=lastname]').val(response.lastname);
	  			$('input[name=middlename]').val(response.middlename);
	  			$('input[name=username]').val(response.username);
	  			$('select[name=status]').val(response.status).change();
	  			$('#voucher').val(response.coupon_status).change();
	  			if(response.designer == 1){
	  			   $("#designer").attr("checked", true);	
	  			}else{
	  			   $("#designer").attr("checked", false);
	  			}
	  			if(response.production == 1){
	  			   $("#production").attr("checked", true);	
	  			}else{
	  			   $("#production").attr("checked", false);
	  			}
	  			if(response.supervisor == 1){
	  			   $("#supervisor").attr("checked", true);	
	  			}else{
	  			   $("#supervisor").attr("checked", false);
	  			}
	  			if(response.superuser == 1){
	  			   $("#superuser").attr("checked", true);	
	  			}else{
	  			   $("#superuser").attr("checked", false);
	  			}
	  			if(response.accounting == 1){
	  			   $("#accounting").attr("checked", true);	
	  			}else{
	  			   $("#accounting").attr("checked", false);
	  			}
	  			if(response.admin == 1){
	  			   $("#admin").attr("checked", true);	
	  			}else{
	  			   $("#admin").attr("checked", false);
	  			}
	  			if(response.webmodifier == 1){
	  			   $("#webmodifier").attr("checked", true);	
	  			}else{
	  			   $("#webmodifier").attr("checked", false);
	  			}
	  			if(response.sales == 1){
	  			   $("#sales").attr("checked", true);	
	  			}else{
	  			   $("#sales").attr("checked", false);
	  			}
	  		}
	  		break;
	  	}
	  	//Admin
	  	case "Modal_Approval_Purchase_View":{
	  		if(!response == false){
	  			$('#production_no_input').val(response[0].production_no);
	  		     $('#production_no').text('JOB ORDER: '+response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title);
	  		     $('#c_name').text('('+response[0].c_name+')');
	  		     $('#unit').text('QTY: '+response[0].unit);
	  		     $('#requestor').text('REQUESTOR : '+response[0].production);
	  		     if(response[0].status == 'APPROVED1'){
	  		     	$('#button_status').html('<button type="button" id="REJECTED" class="btn btn-danger btn_rejected">REJECT</button>'
	  									  +'<button type="button" id="IN PROGRESS" class="btn btn-success btn_approved">APPROVE</button>');
	  		     	status = 'TOTAL: P'+response[0].total;
	  		     }if(response[0].status == 'REJECTED'){
	  		     	$('#button_status').remove();
	  		     	status = response[0].status;
	  		     }if(response[0].status == 'IN PROGRESS'){
	  		     	$('#button_status').remove();
	  		     	status = 'APPROVED';
	  		     }
	  		
	               $('#status').text(status);
	               $('#date_created').text('DATE: '+ response[0].date_created);
	             	$('#tbl_admin_project_modal > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	             			$('#tbl_admin_project_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
						+'<td class="align-middle pl-0">'+response[i].item+'</td>'
						+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].quantity+' '+response[i].units+'</td>'
						+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0">'+response[i].amount+'</td>'
						+'</tr>');
				 }
	  		}
	  		break;
	  	}
	  	
	  	case "Modal_SalesOrder_Approval":{
	  		let container = $('#kt_table_soa_item > tbody:last-child');
	  		    container.empty();
	  		     $('.tr-discount').empty();
	               $('.tr-shipping').empty();
	  		let html=""    
	  		if(!response == false){
	               $('#date_order').text(response[0].date_order);
	               $('.so_no').text(response[0].so_no);
	               $('.si_no').text(response[0].si_no);
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
	               if(response[0].downpayment==0){
	               	$('.td-date-downpayment').text("");
	               	$('.td-downpayment').text(0);
	               }else{
	                  $('.td-date-downpayment').text('('+response[0].date_downpayment+')');
	                  $('.td-downpayment').text(response[0].downpayment);
	               }
	               $('.total').text(response[0].total);
	               $('.td-amountdue').text(response[0].amount_due);
	               $('.shipping_fee').text(response[0].shipping_fee);
	             	if(response[0].vat_status==1){$('.vat-included').text('(with vat)');}else{$('.vat-included').text('(w/o vat)');}
	             	for(var i=0;i<response.length;i++){
             			html += '<tr>\
							<td class="text-center">'+response[i].item+'</td>\
							<td class="text-right"><div style="float:left;">₱</div><div style="float:right;">'+response[i].amount+'<div></td>\
							</tr>';
				}	
				if(response.length < 5){
				   for(var i=0;i<4;i++){
					html += '<tr>\
							<td class="text-center">&nbsp;</td>\
							<td class="text-right">&nbsp;</td>\
						</tr>';
					}
				}
				html +='<tr>\
						<td class="text-right"><b>TOTAL AMOUNT:</b></td>\
						<td class="text-right"><b><div style="float:left;">₱</div><div style="float:right;">'+response[0].subtotal+'</div></b></td>\
					   </tr>';
				container.append(html);
	  		}
	  		break;
	  	}


	  	case "Modal_SalesOrder_Delivery":{
	  		let container = $('#kt_table_soa_item > tbody:last-child');
	  		container.empty();  
	  		let html="";  
	  		if(response != false){
	               $('.so_no').text(response.info.dr_no).attr('data-id',response.id);
	               $('.sold-to').text(response.info.fullname);
	               $('.address').text(response.info.address);
	               $('.date-order').text(response.info.date_created);

	             	for(var i=0;i<response.result.length;i++){
	             		console.log(response.result[i].item)
             			html += '<tr>\
							<td class="text-center td1-border-1px">'+response.result[i].item+'</td>\
							<td class="text-center td1-border-1px">'+response.result[i].qty+'</td>\
						   </tr>';
				}	
				if(response.result.length < 5){
				   for(var i=0;i<4;i++){
					html += '<tr>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
							<td class="text-right td1-border-1px">&nbsp;</td>\
						</tr>';
					}
				}
				container.append(html);
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
	               if(response[0].downpayment==0){
	               	$('.td-date-downpayment').text("");
	               	$('.td-downpayment').text(0);
	               }else{
	                  $('.td-date-downpayment').text('('+response[0].date_downpayment+')');
	                  $('.td-downpayment').text(response[0].downpayment);
	               }
	               $('.total').text(response[0].total);
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
	               if(response.soa.downpayment==0){
	               	$('.td-date-downpayment').text("");
	               	$('.td-downpayment').text(0);
	               }else{
	                  $('.td-date-downpayment').text('('+response.soa.date_downpayment+')');
	                  $('.td-downpayment').text(response.soa.downpayment);
	               }
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
	  	case "Modal_Approval_UsersRequest":{
	  		if(!response == false){
	  			$('input[name=id]').val(response.id);
	  			$('input[name=firstname]').val(response.firstname);
	  			$('input[name=lastname]').val(response.lastname);
	  			$('input[name=middlename]').val(response.middlename);
	  			$('input[name=username]').val(response.username);
	  			$('input[name=status]').val(response.status);
	  			if(response.designer == 1){
	  			   $("#designer").attr("checked", true);	
	  			}else{
	  			   $("#designer").attr("checked", false);
	  			}
	  			if(response.production == 1){
	  			   $("#production").attr("checked", true);	
	  			}else{
	  			   $("#production").attr("checked", false);
	  			}
	  			if(response.supervisor == 1){
	  			   $("#supervisor").attr("checked", true);	
	  			}else{
	  			   $("#supervisor").attr("checked", false);
	  			}
	  			if(response.superuser == 1){
	  			   $("#superuser").attr("checked", true);	
	  			}else{
	  			   $("#superuser").attr("checked", false);
	  			}
	  			if(response.admin == 1){
	  			   $("#admin").attr("checked", true);	
	  			}else{
	  			   $("#admin").attr("checked", false);
	  			}
	  			if(response.accounting == 1){
	  			   $("#accounting").attr("checked", true);	
	  			}else{
	  			   $("#accounting").attr("checked", false);
	  			}
	  			if(response.status == 'REQUEST'){
	  				$('#hide_button').show();
	  			}else{
	  				$('#hide_button').hide();
	  			}
	  		}
	  		break;
	  	}
	  	//View Data Update

	  	//supervisor
	  	case "View_Production_Data":{
	  	    if(!response == false){
	  	      	_initItem_option();
	  		   $('#title').val(response.title);
	  		   $('#unit').val(response.balance);
	  		   $('#c_name').val(response.c_name);
	  		   $('#requestor').val(response.production);
	  	    }
	  	    break;
	  	}

	  	//Reviewer
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
	  	case "Modal_OnlineOrder":{
	  		let container = $('#kt_table_soa_item > tbody:last-child');
	  		    container.empty();
	  		     $('.tr-discount').empty();
	               $('.tr-shipping').empty();
	  		let html=""    
	  		if(!response == false){
	               $('.date-order').text(response.row.date_created);
	               $('.order_no').attr('data-id',response.row.id).text(response.row.order_no);
	               $('.name').text(response.row.name);
	               $('.b_address').text(response.row.billing_address);
	               $('.s_address').text(response.row.shipping_address);
	               $('.date-order').text(response.row.date_created);
	               $('.email').text(response.row.email);
	               $('.mobile').text(response.row.mobile);
	               if(response.row.discount !=0){
	               	$('.tr-discount').append('<td class="text-right text-success">DISCOUNTED :</td>\
	               		<td class="text-right text-success"><div style="float:right;">'+response.row.discount+'%<div></td>');
	               }
	             	for(var i=0;i<response.data.length;i++){
	             		let type = 'text-danger';
	             		let btn = '<button type="button" class="btn btn-light-dark btn-xs font-weight-normal btn-request" data-id="'+response.data[i].id+'">Request <i class="flaticon2-fast-next"></button>';
	             		if(response.data[i].type == "In Stocks"){
	             			type = 'text-success';
	             			btn ='<i class="flaticon2-check-mark text-success"></i>';
	             		}else if(response.data[i].type == "Request"){
	             			type = 'text-warning';
	             			btn ='<i class="flaticon-signs-2 text-warning"></i>';
	             		}else if(response.data[i].type == "Cancelled"){
	             			type = 'text-danger';
	             			btn ='<i class="flaticon2-cross text-warning"></i>';
	             		}
             			html += '<tr>\
							<td class="text-center td1-border-1px" data-id="'+response.data[i].id+'">'+response.data[i].qty+' PCS '+response.data[i].title+' ('+response.data[i].color+')</td>\
							<td class="text-right td1-border-1px"><div style="float:left;">₱</div><div style="float:right;">'+Number(response.data[i].price).toLocaleString("en")+'<div></td>\
							<td class="text-center td1-border-1px td-type '+type+'" data-id="'+response.data[i].id+'">'+response.data[i].type+'</td>\
							<td class="text-center td1-border-1px td-btn" data-id="'+response.data[i].id+'">'+btn+'</td>\
						</tr>';
				}	
				if(response.data.length < 5){
				   for(var i=0;i<4;i++){
					html += '<tr>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
							<td class="text-right td1-border-1px">&nbsp;</td>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
							<td class="text-center td1-border-1px">&nbsp;</td>\
						</tr>';
					}
				}
				container.append(html);
	  		}
	  		break;
	  	}
	  	case "Modal_Voucher_Customer":{
	  		if(!response == false){
	  			$(document).ready(function() {
				    $('.example').DataTable( {
				    	   "responsive": false,
				        "scrollCollapse": true,
				        "paging":         false
				    } );
				});
	  			let dis = parseFloat((response.discount*100)/1);
	  			$('#voucher').text(response.voucher);
	  			$('#discount').text(dis+'%');
	  			$('#tbl_voucher_customer > tbody').empty();
	  			for(var i=0;i<response.data.length;i++){
	  				$('#tbl_voucher_customer > tbody').append('<tr>'
						+'<td class="align-middle pl-0 border-0">'+response.data[i].fullname+'</td>'
						+'<td class="align-middle pl-0 border-0" id="username'+response.data[i].id+'"></td>'
						+'<td class="align-middle pl-0 border-0" style="text-align:center;" id="button'+response.data[i].id+'"></td>'
						+'</tr>');
	  				$('#button'+response.data[i].id).empty();
	  				$('#username'+response.data[i].id).empty();
	  				$('#username'+response.data[i].id).append(response.data[i].username);
	  				if(response.data[i].action == 'none'){
	  					$('#button'+response.data[i].id).append('<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" id="save" data-id="'+response.data[i].id+'"><i class="la la-plus"></i></button>');
	  				}else{
	  					$('#button'+response.data[i].id).append('<button type="button" class="btn btn-sm btn-circle btn-success btn-icon" disabled><i class="icon-nm ki ki-bold-check"></i></button>');
	  				}
	  			}
	  		}
	  		break;
	  	}
	  	case "Modal_Customer_Concern":{
	  		if(!response == false){
	  			$('#production_no').attr('data-id',response.id).val(response.production_no);
	  			$('#concern').val(response.concern);
	  			$('#date_created').val(response.date_created);
	  			$('#customer').val(response.customer);
	  			$('#mobile').val(response.mobile);
	  			$('#email').val(response.email);
	  			$('#so_no').val(response.so_no);
	  			$("#receipt").attr("href",baseURL + 'assets/images/receipt/'+response.receipt);
	  			$("#image").attr("href",baseURL + 'assets/images/service/'+response.image);
	  			$('#btn_action').empty();
	  			if(response.status == 'P'){
	  				$('#btn_action').append('<button type="button" class="btn btn-danger font-weight-bold" id="btn_save" data-action="C">CANCEL</button>'
                							+'<button type="button" class="btn btn-success font-weight-bold" id="btn_save" data-action="A">APPROVE</button>');
	  			}else if(response.status == 'R'){
	  				$('#btn_action').append('<button type="button" class="btn btn-success font-weight-bold" id="btn_save" data-action="P">ACCEPT</button>');
	  			}
	  		}
	  		break;
	  	}
	  	
	  	case "Modal_Customer_Collection":{
	  		$('.btn_action').attr('data-id',response.id);
	  		$('#order_nos').val(response.order_no);
	  		$('#customer').val(response.customer);
  			$('#email').val(response.email);
  			$('#mobile').val(response.mobile);
  			$('#date_deposite').val(response.date_created);
  			$('#amounts').val(response.amount);
  			$('#bank').val(response.bank);
  			if(response.status == 'APPROVED'){
  				$('.btn_action').hide();
  			}else{
  				$('.btn_action').show();
  			}
	  		break;
	  	}
	  	case "Modal_Customer_View":{
	  		$('.save').attr('data-action','update');
	  		$('input[name="firstname"]').val(response.firstname).attr('data-id',response.id);
	  		$('input[name="lastname"]').val(response.lastname);
	  		$('input[name="mobile"]').val(response.mobile);
	  		$('input[name="email"]').val(response.email);
	  		$('input[name="address"]').val(response.address);
	  		$('input[name="city"]').val(response.city);
	  		$('input[name="province"]').val(response.city);
	  		$('select[name="region"]').val(response.region).change();
			$(document).on("blur",'input[name="email"]',function(e){
				_ajaxloaderOption('option_controller/email_update','POST',{id:response.id,email:$(this).val()},'email_update');
			});
	  		break;
	  	}
	  	case "Modal_Joborder_Stocks_Supervisor":{
	  		_initNumberOnly('.quantity');
	  		$('[data-toggle="tooltip"]').tooltip();
	  		if(!response == false){
	  			$('#project_no').text(response.production_no).attr('data-order',response.production_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			$('#unit').val(response.unit);
	  			$(".docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$(".docs").val(response.docs);

	  			KTDatatablesDataSourceAjaxClient.init('tbl_joborder_material',response.production_no);
	  		}
	  		$(document).on("click","#update-material-request",function(e) {
	  				let element = $(this);
				 	let id = element.attr('data-id');
				 	let type = element.attr('data-type');
				 	let row = element.closest("tr");
				 	let item = row.find("td:nth-child(2)").text();
				 	let qty = row.find("td:nth-child(3)").text();
				 	$('.text-name-m').text(item);
			 		$('input[name=qty_update_m]').val(qty).attr('data-id',id);
			 		$('select[name=type_update_m]').val(type);
			 		$('#edit-material-request').modal('show');
			});
			$(document).on("click","#update-purchase-request",function() {
				 	let id = $(this).attr('data-id');
				 	let row = $(this).closest("tr");
				 	let item = row.find("td:nth-child(2)").text();
				 	let qty = row.find("td:nth-child(3)").text();
				 	let unit = row.find("td:nth-child(4)").text();
				 	let remarks = row.find("td:nth-child(5) a").attr('title');
				 	$('.text-name').text(item);
				 	$('input[name=qty_update_p]').attr('data-id',id); 
				 	$('input[name=qty_update_p]').val(qty); 
					$('textarea[name=remarks_update_p]').val(remarks);
			 		$('#edit-purchase-request').modal('show');
			});
			$(document).on('click','#form-add',function(e){
				$('.item-status').trigger('change');
			});
			$('.item-status').on('change',function(e){
				e.preventDefault();
				let val = $(this).val();
				if(val == 1){
				   $('#Create_Purchase_request > div.row > div:nth-child(2)').addClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(2) > div > input').val('none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3)').addClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3) > div > input').val('none');
				   $('#Create_Purchase_request > div.row > div:nth-child(4)').removeClass('d-none');
				}else{
				   $('#Create_Purchase_request > div.row > div:nth-child(2)').removeClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(2) > div > input').val("");
				   $('#Create_Purchase_request > div.row > div:nth-child(3)').removeClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3) > div > input').val("");
				   $('#Create_Purchase_request > div.row > div:nth-child(4)').addClass('d-none');
				}
			});
			
	  		break;
	  	}
	  	case "Modal_Joborder_Project_Supervisor":{
	  		_initNumberOnly('.quantity');
	  		$('[data-toggle="tooltip"]').tooltip();
	  		if(!response == false){
	  			$('#project_no').text(response.production_no).attr('data-order',response.production_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#unit').val(response.unit);
	  			$(".docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$(".docs").val(response.docs);
	  			KTDatatablesDataSourceAjaxClient.init('tbl_joborder_material',response.production_no);
	  		}
	  		$(document).on("click","#update-material-request",function(e) {
	  				let element = $(this);
				 	let id = element.attr('data-id');
				 	let type = element.attr('data-type');
				 	let row = element.closest("tr");
				 	let item = row.find("td:nth-child(2)").text();
				 	let qty = row.find("td:nth-child(3)").text();
				 	$('.text-name-m').text(item);
			 		$('input[name=qty_update_m]').val(qty).attr('data-id',id);
			 		$('select[name=type_update_m]').val(type);
			 		$('#edit-material-request').modal('show');
			});
			$(document).on("click","#update-purchase-request",function() {
				 	let id = $(this).attr('data-id');
				 	let row = $(this).closest("tr");
				 	let item = row.find("td:nth-child(2)").text();
				 	let qty = row.find("td:nth-child(3)").text();
				 	let unit = row.find("td:nth-child(4)").text();
				 	let remarks = row.find("td:nth-child(5) a").attr('title');
				 	$('.text-name').text(item);
				 	$('input[name=qty_update_p]').attr('data-id',id); 
				 	$('input[name=qty_update_p]').val(qty); 
					$('textarea[name=remarks_update_p]').val(remarks);
			 		$('#edit-purchase-request').modal('show');
			});
			$(document).on('click','#form-add',function(e){
				$('.item-status').trigger('change');
			});
			$('.item-status').on('change',function(e){
				e.preventDefault();
				let val = $(this).val();
				if(val == 1){
				   $('#Create_Purchase_request > div.row > div:nth-child(2)').addClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(2) > div > input').val('none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3)').addClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3) > div > input').val('none');
				   $('#Create_Purchase_request > div.row > div:nth-child(4)').removeClass('d-none');
				}else{
				   $('#Create_Purchase_request > div.row > div:nth-child(2)').removeClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(2) > div > input').val("");
				   $('#Create_Purchase_request > div.row > div:nth-child(3)').removeClass('d-none');
				   $('#Create_Purchase_request > div.row > div:nth-child(3) > div > input').val("");
				   $('#Create_Purchase_request > div.row > div:nth-child(4)').addClass('d-none');
				}
			});
			
	  		break;
	  	}
	  	case "Modal_Purchased_Request_Supervisor":{
	  	 	$('#text-table').text('Purchased Request');
  				let html="";
	  	 		html +='<table class="table table-hover table-dark table-sm table-purchased">\
					<thead>\
						<th>No.</th>\
						<th>ITEM</th>\
						<th>QTY</th>\
						<th>DATE CREATED</th>\
					</thead>	\
					<tbody>';
	  	 	for(var i=0;i<response.purchased.length;i++){
				html+='<tr>\
					  <td>'+response.purchased[i].no+'</td>\
					  <td>'+response.purchased[i].item+'</td>\
					  <td>'+response.purchased[i].quantity+'</td>\
					  <td>'+response.purchased[i].date_created+'</td>\
					</tr>';
	  		}
	  			html+='</tbody>\
				</table>';
	  			$('.data-table').empty().append(html);
	  	 	break;
	  	 }
	  	 case "accounting_dashboard":{
	  		$('#p_request').text(response.data.p);
	  		$('#s_request').text(response.data.s);
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
	  			    html +='<tr class="table-success text-dark">\
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
		  		break;
	  	}
	  	case "Account_Report_Cashposition_Weekly":{
	  		  let html = "";
	  		  html +='<table class="table table-hover font-size-lg">\
			  			<thead>\
	  		  				<tr>\
	  		  					<th colspan="3" class="text-center font-size-lg"><h2>'+response.month+'-'+response.year+'</h2></th>\
	  		  				</tr>\
	  		  			</thead>\
  		  			<tbody>';
	  		if(response){
	  		  if(response.week1_type2 && response.week1_type1){
	  			 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">'+response.month+' - 1st Week</td>\
	  			 	    </tr>';
  				 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.beginning+'</td>\
	  		    		 </tr>';	
	  			if(response.week1_type2){
	  			  html +='<tr class="table-success text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.week1_type2.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.week1_type2[i].date_position+'</td>\
			  		    		   <td>'+response.week1_type2[i].name+'</td>\
			  		    		   <td>'+response.week1_type2[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week1_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    	    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    }
	  		   
	  		    if(response.week1_type1){
	  		    	  html +='<tr class="table-warning text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.week1_type1.length;i++){
	  		    		html +='<tr>\
			  		    		  <td>'+response.week1_type1[i].date_position+'</td>\
			  		    		  <td>'+response.week1_type1[i].name+'</td>\
			  		    		  <td >'+response.week1_type1[i].amount+'</td>\
			  		    		  <td></td>\
			  		    		</tr>';
	  		    	   }
		  		    	   html +='<tr class="table-warning text-dark">\
		  		    	   			<td></td>\
		  		    	   			<td>TOTAL</td>\
		  		    	   			<td>'+response.week1_less+'</td>\
		  		    	   			<td></td>\
		  		    	   		</tr>';
	  		   	 }
		  		    html +='<tr class="bg-dark text-white">\
			  		    			<td></td>\
			  		    			<td>BALANCED</td>\
			  		    			<td></td>\
			  		    			<td>'+response.balanced1+'</td>\
			  		    		 </tr>';	
		  		    html +='<tr>\
		  		    			<td colspan="4"></td>\
		  		    		 </tr>';
	  			}
	  		    if(response.week2_type2 && response.week2_type1){
	  		    html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">'+response.month+' - 2nd Week</td>\
	  			 	    </tr>';	
	  		    	html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BEGINNING BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced1+'</td>\
		  		    		 </tr>';	  	 
		  	    if(response.week2_type2){
	  			  html +='<tr class="table-success text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week2_type2.length;i++){
	  		    		html +='<tr>\
  		    				    <td>'+response.week2_type2[i].date_position+'</td>\
		  		    		    <td>'+response.week2_type2[i].name+'</td>\
		  		    		    <td>'+response.week2_type2[i].amount+'</td>\
		  		    		    <td></td>\
		  		    		  </tr>';
	  		    	   }
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week2_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 	 html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>'; 
	  		    if(response.week2_type1){
	  		    	   html +='<tr class="table-warning text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week2_type1.length;i++){
	  		    		html +='<tr>\
			  		    		   <td>'+response.week2_type1[i].date_position+'</td>\
			  		    		   <td>'+response.week2_type1[i].name+'</td>\
			  		    		   <td>'+response.week2_type1[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="table-warning text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week2_less+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced2+'</td>\
		  		    		 </tr>';	

	  		    html +='<tr>\
	  		    			<td colspan="4"></td>\
	  		    		 </tr>';  
	  		    }
	  		    if(response.week3_type2 && response.week3_type1){
	  		    html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">'+response.month+' - 3rd Week</td>\
	  			 	    </tr>';
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BEGINNING BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced2+'</td>\
		  		    		 </tr>';	
	  		        if(response.week3_type2){
	  			  html +='<tr class="table-success text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week3_type2.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.week3_type2[i].date_position+'</td>\
			  		    		   <td>'+response.week3_type2[i].name+'</td>\
			  		    		   <td>'+response.week3_type2[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week3_type1){
	  		    	   html +='<tr class="table-warning text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week3_type1.length;i++){
	  		    		html +='<tr data-id="'+response.week3_type1[i].id+'">\
			  		    		  <td>'+response.week3_type1[i].date_position+'</td>\
			  		    		   <td>'+response.week3_type1[i].name+'</td>\
			  		    		   <td>'+response.week3_type1[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="table-warning text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_less+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	    html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced3+'</td>\
		  		    		 </tr>';		
		  		     html +='<tr>\
		  		    			<td colspan="4"></td>\
		  		    		 </tr>';  
	  		    }
	  		    if(response.week4_type2 && response.week4_type1){		 
	  		   	 html +='<tr class="bg-dark text-white">\
	  			 		  <td colspan="4" class="text-center">'+response.month+' - 4th Week</td>\
	  			 	    </tr>';
  		    	  	 html +='<tr class="bg-dark text-white">\
	  		    			<td></td>\
	  		    			<td>BEGINNING BALANCED</td>\
	  		    			<td></td>\
	  		    			<td>'+response.balanced3+'</td>\
	  		    		 </tr>';	
	  		        if(response.week4_type2){
	  			  html +='<tr class="table-success text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week4_type2.length;i++){
	  		    		html +='<tr>\
	  		    				   <td>'+response.week4_type2[i].date_position+'</td>\
			  		    		   <td>'+response.week4_type2[i].name+'</td>\
			  		    		   <td>'+response.week4_type2[i].amount+'</td>\
			  		    		   <td></td>\
			  		    	   </tr>';
	  		    	   }
	  		    	    html +='<tr class="table-success text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week4_type1){
	  		    	   html +='<tr class="table-warning text-dark">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week4_type1.length;i++){
	  		    		html +='<tr>\
			  		    		   <td>'+response.week4_type1[i].date_position+'</td>\
			  		    		   <td>'+response.week4_type1[i].name+'</td>\
			  		    		   <td>'+response.week4_type1[i].amount+'</td>\
			  		    		   <td></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="table-warning text-dark">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_less+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		    	   html +='<tr class="bg-dark text-white">\
		  		    			<td></td>\
		  		    			<td>BALANCED</td>\
		  		    			<td></td>\
		  		    			<td>'+response.balanced4+'</td>\
		  		    		 </tr>';	
	  		  }
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
	  	   	if(response.jan_add && response.jan_less){
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
				  		    		   <td >'+response.jan_less[i].amount+'</td>\
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

	  		   if(response.feb_add && response.feb_less){
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
	  		    		html +='<tr >\
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

	  		  if(response.march_add && response.march_less){
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
	  		    		html +='<tr data-id="'+response.march_add[i].id+'">\
	  		    				   <td>'+response.march_add[i].date_position+'</td>\
			  		    		   <td>'+response.march_add[i].name+'</td>\
			  		    		   <td>'+response.march_add[i].amount+'</td>\
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
	  		    	  html +='<tr class="table-warning text-dark">\
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
	  		if(response.april_add && response.april_less){
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
	  		    		html +='<tr data-id="'+response.april_add[i].id+'">\
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

	  		   if(response.may_add && response.may_add){
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

	  		   if(response.june_add && response.june_less){
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
			  		    		   <td >'+response.june_add[i].name+'</td>\
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
			  		    		   <td></td>\
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

	  		     if(response.july_add && response.july_less){
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
			  		    		   <td></button></td>\
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
			  		    		   <td >'+response.july_less[i].name+'</td>\
			  		    		   <td >'+response.july_less[i].amount+'</td>\
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

	  		   if(response.august_add && response.august_less){
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
			  		    		   <td >'+response.august_less[i].amount+'</td>\
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

	  		    if(response.sept_add && response.sept_less){
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
			  		    		  <td >'+response.sept_less[i].date_position+'</td>\
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

	  		    if(response.oct_add && response.oct_less){
	  		    
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
	  		    		html +='<tr>\
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

	  		   if(response.nov_add && response.nov_less){
	  		   	 html +='<tr>\
	  		    			<td colspan="4"></td>\
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
	  		    		html +='<tr>\
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

	  		   if(response.dec_add && response.dec_less){
	  		   	
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
	  		    		html +='<tr>\
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
	  	case "View_Joborder_Material":{
	  		$('#tbl_material > tbody:last-child').empty();
	  		if(!response==false){
	  			for(var i=0;i<response.length;i++){
	  				if(!response[i].unit){
	  					var unit = "";
	  				}else{
	  					var unit = response[i].unit;
	  				}
	        			$('#tbl_material > tbody:last-child').append('<tr>'
					+'<td class="align-middle">'+response[i].item+' </td>'
					+'<td class="align-middle">'+response[i].qty+' '+unit+'</td>'
					+'<td class="align-middle">'+response[i].remarks+'</td>'
					+'</tr>');
				 }
	  		}
	  		break;
	  	}
	  	case "View_Joborder_Purchase":{
	  		$('#tbl_puchased > tbody:last-child').empty();
	  		if(!response==false){
	  			for(var i=0;i<response.length;i++){
	  				if(!response[i].unit){
	  					var unit = "";
	  				}else{
	  					var unit = response[i].unit;
	  				}
	        			$('#tbl_puchased > tbody:last-child').append('<tr>'
					+'<td class="align-middle">'+response[i].item+' </td>'
					+'<td class="align-middle">'+response[i].qty+' '+unit+'</td>'
					+'<td class="align-middle">'+response[i].remarks+'</td>'
					+'</tr>');
				 }
	  		}
	  		break;
	  	}
	  	case "View_Joborder_Request_Stocks":{
	  		$('#joborder').text(response.production_no);
	  		$('#joborder').attr('data-id',response.production_no);
	  		$('#title').val(response.title);
	  		$('#c_name').val(response.c_name);
	  		$('#docs_href').attr('href',baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  		$("#color").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  		break;
	  	}
	  	case "View_Joborder_Request_Project":{
	  		$('#joborder').text(response.production_no);
	  		$('#joborder').attr('data-id',response.production_no);
	  		$('#title').val(response.title);
	  		$('#docs_href').attr('href',baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  		$("#color").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  		break;
	  	}
	  	case "Modal_Other_Materials_view":{
	  		if(!response == false){
	  			$('input[name=id]').val(response.id);
	  			$('input[name=item_update]').val(response.item);
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
	  			$('input[name=stocks_alert]').val(response.alert);
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
	  	case "Modal_Request_Material":{
	  		_initNumberOnly(".numbers");
	  		$('#title-item').text(response.row.item).attr('data-id',response.id);
	  		$('.balance-quantity').val(response.row.qty);
	  		$('input[name=quantity]').val("");
	  		$('input[name=quantity]').on('input',function(e){
	  			let quantity = $(this).val();
	  			let total = parseFloat(response.row.qty-quantity);
	  			if(total  < 0){
	  				$(this).val("");
	  				$('.balance-quantity').val(response.row.qty);
	  			}else{
	  				$('.balance-quantity').val(total)
	  			}
	  		});
	  		break;
	  	}
	  	case "Modal_Customized_View":{
	  	  $('input[name="subject_update"]').val(response.row.subject).attr('data-id',response.id);
	  	  $(".summernote1").summernote("code", response.row.description);
	  	  if(response.row.status == 'P'){
	  	  	  $('.summernote1').summernote('enable');
	  	  	  $('input[name="subject_update"]').removeAttr('disabled');
	  	  	  $('.btn-hide').show();
	  	  	}else{
	  	  	   $('.btn-hide').hide();
	  	  	   $('.summernote1').summernote('disable');
	  	  	   $('input[name="subject_update"]').attr('disabled',true);
	  	  	}	
	  	  break;
	  	}
	  	case "Modal_Customized_View_Superuser":{
	  		if(response !=false){
	  			$('.subject_update').text(response.row.subject).attr('data-id',response.id);
		  	  	$(".description").html(response.row.description);
		  	  	$('#modal-form').modal('show');
	  		}
	  		break;
	  	}
	  	case "Modal_Inquiry_View":{
	  		$('#date_created').val(response.row.date_created);
	  		$('#customer').val(response.row.fullname);
  			$('#email').val(response.row.email);
  			$('#subject').val(response.row.subject).attr('data-id',response.id);
  			$('#comment').val(response.row.description);
  			if(response.row.status == 'P'){
	  	  	   $('#modal-form > div > div > div.modal-footer').html('<button type="button" class="btn btn-light-success font-weight-bold btn-request" data-status="A">Approve</button>');
	  	  	}else{
	  	  	   $('#modal-form > div > div > div.modal-footer').remove();
	  	  	}
	  		break;
	  	}
	  	case "View_Salesorder_Update":{
	  		_initNumberOnly("#discount");
			_initCurrency_format('input[name="amount"],input[name="shipping_fee"],input[name="downpayment"]');
	  		$('input[name=fullname]').val(response.row.name).attr('data-id',response.id);
               $('textarea[name=address]').text(response.row.billing_address);
               $('input[name=date_created]').val(response.row.date_created);
               $('input[name=email]').val(response.row.email);
               $('input[name=mobile]').val(response.row.mobile);
               for(let i=0;i<response.data.length;i++){
				$('#kt_product_breakdown_table > tbody:last-child').append('<tr>\
					<td class="td-item['+i+']" data-id="'+response.data[i].id+'">'+response.data[i].title+' ('+response.data[i].color+')</td>\
					<td class="text-center td-qty['+i+']">'+response.data[i].qty+'</td>\
					<td class="text-right td-amount['+i+']">'+response.data[i].price+'</td>\
					</tr>');	
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
	  		KTDatatablesDataSourceAjaxClient.init('tbl_supplier_item',response.id);
	  		break;
	  	}
	  	case "Modal_Supplier_Item_Update_View":{
	  		_initCurrency_format('.amount');
	  		$('select[name=item]').val(response.item_no).change();
	  		$('select[name=item]').attr('data-id',response.id);
	  		$('input[name=amount]').val(response.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	  		break;
	  	}
	  	case "Update_Sales_Delivery_Receipt_Superuser":{
	  		if(response != false){
	  			_initToast(response.type,response.message);
	  			KTDatatablesDataSourceAjaxClient.init('tbl_sales_delivery_superuser');
				_initnotificationupdate();
	  		}else{

	  		}
	  		break;
	  	}
	  	case "Modal_Other_Purchase_View":{
	  		if(!response == false){
  			    $('.cash_fund').text(response.info.request_no);
	  		    $('.requestor').text(response.info.requestor);
	  		    $('.date_created').text(response.info.date_created);
	  		    let container = $('#tbl_purchased_estimate > tbody:last-child');
	  		    container.empty();
	  		    for(let i=0;i<response.material.length;i++){
	  		    		container.append('<tr>\
	  		    					  	 <td>'+response.material[i].item+'</td>\
	  		    					  	 <td class="text-center">'+response.material[i].qty+'</td>\
	  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
	  		    					  </tr>');
	  		    }
		 	 }
		 	  $('#view-purchased-request').modal('show');
	  		break;
	  	}
	  	case "Modal_Other_Purchase_View_Received":{
	  		if(!response == false){
	               $('.cf_no').text('CF #: '+response.info.fund_no).attr('data-id',response.info.fund_no);
	               $('.trans_no').text('Trans #: '+response.info.request_no);
	  		     $('.requestor').text(response.info.requestor);
	               $('.date_created').text(response.info.date_created);
	               $('.btn-change-process').attr('data-action','view');
	             	$('.btn-change-process').html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit-process').addClass('d-none').removeAttr('id');
	             	$('#view-details').removeClass('d-none');
				$('#view-purchased').addClass('d-none');
				$('[data-toggle="tooltip"]').tooltip();
				 $('.btn-hide').hide();
				 if(response.info.status == 'APPROVED'){
				 	$('.btn-hide').show();
				 }

			    let container = $('#tbl_purchasing_inprogress_modal > tbody:last-child');
	  		    container.empty();
	  		    for(let i=0;i<response.material.length;i++){
	  		    		container.append('<tr>\
	  		    					  	 <td>'+response.material[i].item+'</td>\
	  		    					  	 <td class="text-center">'+response.material[i].qty+'</td>\
	  		    					  	 <td class="text-right">'+response.material[i].amount+'</td>\
	  		    					  </tr>');
	  		    }	
	             	_ajaxloaderOption('option_controller/purchase_inventory','POST',{id:response.info.fund_no},'purchase_inventory');
	             	 $(document).on('change','select[name=item]',function(e){
	             	 	e.preventDefault();
	             	 	let type = $('select[name=item] option:selected').attr('data-type');
	             	 	_ajaxloaderOption('option_controller/supplier_list','POST',{id:$(this).val(),type:type},'supplier_list');
	             	 });
	             	 _ajaxloaderOption('option_controller/other_material_p_transaction','POST',{id:response.info.fund_no},'other_material_p_transaction');
				
				$('[data-toggle="tooltip"]').tooltip();
				_initCurrency_format('.amount');
				KTBootstrapDatepicker.init();
				$(".datepicker").css('width', '360px'); 
				$('#processModal').modal('show');
	  		}
	  		break;
	  	}
	  	case "Update_Customized_Approval_Request":{
 		 	if(response == 'A'){
 		 		_initToast('success','Request Approved');
				$('#modal-form').modal('hide');
 		 	}else if(response == 'R'){
 		 		_initToast('error','Request Rejected');
				$('#modal-form').modal('hide');
 		 	}else{
 		 		Swal.fire("Oopps!", "Something went wrong, Please try again later", "info"); 
 		 	}
 		 	KTDatatablesDataSourceAjaxClientCreative.init('tbl_customized');
 		  	_initnotificationupdate();
 		 	break;
 		 }
 		 case "Update_Pre_Order_Request":{
 		 	if(response == 2){
	 		 		_initToast('success','Request Approved');
 		 	}else if(response == 3){
 		 		_initToast('error','Request Rejected');
 		 	}else{
 		 		Swal.fire("Oopps!", "Something went wrong, Please try again later", "info"); 
 		 	}
 		 	KTDatatablesDataSourceAjaxClientCreative.init('tbl_preoder');
 		  	_initnotificationupdate();
 		 	break;
 		 }

	  }
	}

	var _construct = async function(response, type, element, object){
		_initnotificationupdate();
		switch(type){
			case "fetch_design_stocks_list":{
				if(!response == false){
					$('#title').empty();
					$('#title').append('<option value="" selected disabled>SELECT ITEM</option>');
					for(let i=0;i<response.length;i++){
	                  	  	$('#title').append('<option value="'+response[i].id+'">'+response[i].title+'</option>');
	                  	  	$('#title').addClass('selectpicker');
					     $('#title').attr('data-live-search', 'true');
						$('#title').selectpicker('refresh');
		                }	
	          	}
          	     $('.input-image').on('change',function(e){
	                    e.preventDefault();
	                    $('.valid-uploadss').val(this.files[0].name);
	               });
	          	$('#add-stocks-existing-modal').modal('show');
				break;
			}
			case "fetch_design_stocks":{
				if(response !=false){
					$('.title').text(response.info.title);
					$('.c_name').text(response.info.c_name);
		  			$('.creator').text(response.info.creator);
		  			$('.date_created').text(response.info.date_created);
		  			$('.view-form-image').empty().append('<div class="col-lg-4"><div class=" tba_image "><img class="bgi-no-repeat bgi-size-cover rounded min-h-100px" id="myImg" src="'+baseURL+'assets/images/design/project_request/images/'+response.info.image+'" style="width: 100%;height: 150px;background-size: contain;background-position: center;" /></div></div>\
		  				<div class="col-lg-4"><div class=" tba_image "><img class="bgi-no-repeat bgi-size-cover rounded min-h-100px" id="myImg" src="'+baseURL+'assets/images/palettecolor/'+response.info.c_image+'" style="width: 100%;height: 150px;background-size: contain;background-position: center;" /></div></div>\
		                  <div class="col-lg-4"><a href="'+baseURL+'assets/images/design/project_request/docx/'+response.info.docs+'" target="_blank"><div class="bgi-no-repeat bgi-size-cover rounded min-h-100px tba_image  payment_slip" style="background-image: url('+baseURL+'assets/media/svg/files/pdf.svg);width: 100%;height: 150px;background-size: contain;background-position: center;"></div></a></div>\
		                  ');
		  			$('#view-stocks').modal('show');
				}
				break;
			}
			case "fetch_design_stocks_edit":{
				if(!response == false){
					$('#edit-stocks-modal input[name=title]').attr('data-id',response.id);
		  			$('#edit-stocks-modal input[name=title]').val(response.info.title);
		  			$('#edit-stocks-modal input[name=pallet_name]').val(response.info.c_name);

		  			$("#edit-stocks-modal .image-stocks-edit").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
		  			$("#edit-stocks-modal .pallet-image").attr("src", ""+baseURL+"assets/images/palettecolor/"+response.info.c_image+"");
		  			$('#edit-stocks-modal .valid-upload').val(response.info.docs);
		  			$('#edit-stocks-modal input[name=docs]').on('change',function(e){
		                    e.preventDefault();
		                    $('.valid-upload').val(this.files[0].name);
		               });
		               
		               $('#edit-stocks-modal input[name=image]').on('change',function(e){
					    var file, img;
					    if ((file = this.files[0])) {
					        img = new Image();
					        var objectUrl =window.URL.createObjectURL(file);
					        img.onload = function () {
					        	if(this.width > 1000 && this.height > 1000){
					        		Swal.fire("Warning!", "Sorry, this image doesn't look like the size we wanted. It's "+this.width+" x "+this.height+" but we require 500 x 500 size image.", "warning").then(function(){
					        			$(".image-stocks-edit").attr('style',"background-image:url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
					        			$('#edit-stocks-modal input[name=image]').val(" ");
					        			});
					        		
					        	}
					        };img.src = objectUrl;
					    }
					});
					$('#design_image > span').on('click',function(e){
		               	$(".image-stocks-edit").attr('style',"background-image:url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
		               });
		  			$('#edit-stocks-modal').modal('show');
	  			}
				break;
			} 
			case "fetch_design_project":{
				if(response !=false){
					$('.project_name').text(response.info.title);
		  			$('.creator').text(response.info.creator);
		  			$('.date_created').text(response.info.date_created);
		  			$('.view-form-image').empty().append('<div class="col-lg-4"><div class=" tba_image "><img class="bgi-no-repeat bgi-size-cover rounded min-h-100px" id="myImg" src="'+baseURL+'assets/images/design/project_request/images/'+response.info.image+'" style="width: 100%;height: 150px;background-size: contain;background-position: center;" /></div></div>\
		                  <div class="col-lg-4"><a href="'+baseURL+'assets/images/design/project_request/docx/'+response.info.docs+'" target="_blank"><div class="bgi-no-repeat bgi-size-cover rounded min-h-100px tba_image  payment_slip" style="background-image: url('+baseURL+'assets/media/svg/files/pdf.svg);width: 100%;height: 150px;background-size: contain;background-position: center;"></div></a></div>\
		                  ');

		  			$('#view-project').modal('show');
				}
				break;
			} 
			case "fetch_design_project_edit":{
				if(!response == false){
					$('#edit-project-modal input[name=title]').attr('data-id',response.id);
		  			$('#edit-project-modal input[name=title]').val(response.info.title);
		  			$("#edit-project-modal .image-stocks-edit").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
		  			$('#edit-project-modal .valid-upload').val(response.info.docs);
		  			$('#edit-project-modal input[name=docs]').on('change',function(e){
		                    e.preventDefault();
		                    $('.valid-upload').val(this.files[0].name);
		               });
		               $('#edit-project-modal input[name=image]').on('change',function(e){
					    var file, img;
					    if ((file = this.files[0])) {
					        img = new Image();
					        var objectUrl =window.URL.createObjectURL(file);
					        img.onload = function () {
					        	if(this.width > 1000 && this.height > 1000){
					        		Swal.fire("Warning!", "Sorry, this image doesn't look like the size we wanted. It's "+this.width+" x "+this.height+" but we require 500 x 500 size image.", "warning").then(function(){
					        			$(".image-stocks-edit").attr('style',"background-image:url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
					        			$('#edit-stocks-modal input[name=image]').val(" ");
					        			});
					        		
					        	}
					        };img.src = objectUrl;
					    }
					});
					$('#design_image > span').on('click',function(e){
		               	$(".image-stocks-edit").attr('style',"background-image:url("+baseURL+"assets/images/design/project_request/images/"+response.info.image+")");
		               });
		  			$('#edit-project-modal').modal('show');
	  			}
				break;
			}
			case "fetch_design_project_status":{
				_initToast(response.type,response.message);
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_design_project_request');
				break;
			}
			case "fetch_design_stocks_status":{
				_initToast(response.type,response.message);
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_design_stocks_request');
				break;
			}
			case "fetch_inspection_project_approved":
			case "fetch_inspection_project":{
				if(response !=false){
					$('.title').text(response.info.title);
		  			$('.creator').text(response.info.creator);
		  			$('.date_created').text(response.info.date_created);
		  			let container = $('.view-form-image').empty();
		  			for(let i=0;i<response.inspection.length;i++){
			  			container.append('<div class="col-lg-4"><div class=" tba_image "><img class="bgi-no-repeat bgi-size-cover rounded min-h-100px" id="myImg" src="'+baseURL+'assets/images/inspection/'+response.inspection[i].image+'" style="width: 100%;height: 150px;background-size: contain;background-position: center;" /></div></div>\
			                  ');	
		  			}
		  			$('#view-project').modal('show');
				}
				break;
			}
			case "fetch_inspection_stocks_approved":
			case "fetch_inspection_stocks":{
				if(response !=false){
					$('.title').text(response.info.title);
					$('.c_name').text(response.info.c_name);
		  			$('.creator').text(response.info.creator);
		  			$('.date_created').text(response.info.date_created);
		  			let container = $('.view-form-image').empty();
		  			for(let i=0;i<response.inspection.length;i++){
		  				console.log(response.inspection[i].image)
			  			container.append('<div class="col-lg-4"><div class=" tba_image "><img class="bgi-no-repeat bgi-size-cover rounded min-h-100px" id="myImg" src="'+baseURL+'assets/images/inspection/'+response.inspection[i].image+'" style="width: 100%;height: 150px;background-size: contain;background-position: center;" /></div></div>\
			                  ');	
		  			}
		  			$('#view-stocks').modal('show');
				}
				break;
			}
			case "fetch_inspection_stocks_status":{
				_initToast(response.type,response.message);
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_inspection_stocks');
				break;
			}
			case "fetch_inspection_project_status":{
				_initToast(response.type,response.message);
				KTDatatablesDataSourceAjaxClientAdmin.init('tbl_approval_inspection_project');
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
    var _ajaxrequest = async function(url,blockUi, formData){
      return new Promise((resolve, reject) => {
             let y = true;
             $.ajax({
              url: baseURL+url,
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
			var viewForm = $('#kt_content').attr('data-table');
			_ViewController(viewForm);
			_initView();
			_initImageView();
			_initnotificationupdate();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});
		
