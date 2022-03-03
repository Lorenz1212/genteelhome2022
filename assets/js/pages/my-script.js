'use strict';
var KTAjaxClient = function() {
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
		  $(action).datepicker({
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
	var _initFinishproduct_Release = function(project_no,c_code,quantity,price){
		 $.ajax({
	             url: baseURL + 'option_controller/Finishproduct_option',
	             type: "POST",
	             data:{project_no:project_no,c_code:c_code},
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
                  	  $('#myTable > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">'
						+'<td class="align-middle pl-0 border-0"><input type="hidden" name="project_no[]" value="'+response.project_no+'"/>'+response.title+'</td>'
						+'<td class="align-middle pl-0 border-0"><input type="hidden" name="c_code[]" value="'+response.c_code+'"/>'+response.c_name+'</td>'
						+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+quantity+'</td>'
						+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+price+'</td>'
						+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"><i class="icon-xl la la-times"></i></button></td>'
						+'</tr>');
                  }                                    
		});	
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
	var _initFinishproduct_option = async function(select_no,action){
		 $.ajax({
	             url: baseURL + 'option_controller/Finishproduct_option',
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
                  	  	  let option1 = '<option value="'+response[i].item+'">('+response[i].qty+') '+response[i].item+'</option>';
                  	  	  $('#finishproduct').append(option1);  
                  	  	  $('#finishproduct').addClass('selectpicker');
					  $('#finishproduct').attr('data-live-search', 'true');
					  $('#finishproduct').selectpicker('refresh');
                  	  	
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
	var _initItem1_option =  function(){
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
                  	  	  let option = '<option value="'+response[i].item_no+'">('+response[i].qty+') '+response[i].name+'</option>';
                  	  	  $('#item_no').append(option);
                  	  	  $('#item_no').addClass('selectpicker');
					  $('#item_no').attr('data-live-search', 'true');
					  $('#item_no').selectpicker('refresh');
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
			case "Purchased_Item":{
				if(response.terms == 1){var terms = 'CASH';}else{var terms = 'TERMS';}
				$('#tbl_purchasing_process > tbody:last-child').append('<tr>\
				<td class="align-middle td-item" data-prid="'+response.data.item.id+'" data-item="'+response.data.item.item_id+'">'+response.data.item.item+'</td>\
				<td class="align-middle text-right td-supplier" data-supplier="'+response.data.supplier.id+'">'+response.data.supplier.name+'</td>\
				<td class="align-middle text-right td-terms" data-terms="'+response.terms+'">'+terms+'</td>\
				<td class="align-middle text-center td-quantity" data-qty="'+response.quantity+'">'+response.quantity+'</td>\
				<td class="align-middle text-right td-amount-process" data-amount="'+response.amount+'">'+response.amount+'</td>\
				<td class="align-middle text-center"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm"><i class="la la-times"></i></button></td>\
						</tr>');	
				_initremovetable('#tbl_purchasing_process');
				break;
			}
			case "imagecode":{
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
				break;
			}
			case "imageproject":{
				if(!response== false){
                  		$('#designer').val(response.designer);
					$('#images').val(response.image);
					$('#docss').val(response.docs);
				  	$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
				  	$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
				  	$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
				  	$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
                  	}
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
				if(!response == false){
                  	   $("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
                  	   $("#docs_href").attr('target','_blank');

                  	}else{
                  	   $("#docs_href").removeAttr("target");
                  	   $("#docs_href").removeAttr("href");
                  	}
				break;
			}
			case"colorcode":{
				 $('#c_code').empty();
				if(!response == false){
                  	    $('#c_code').append('<option value="" disabled selected>SELECT PALLETE COLOR</option>');
                       for(let i=0;i<response.length;i++){
                         $('#c_code').append('<option value="'+response[i].c_code+'">('+response[i].stocks+') '+response[i].c_name+'</option>');
                  	   }
                  	}
				break;
			}
			
			case "region":{
				if(!response == false){
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
				$('input[name=fullname]').val(response.customer);
				$('input[name=email]').val(response.email);
				$('input[name=mobile]').val(response.mobile);
				break;
			}
			case "spare_parts":{
				if(!response == false){
					$('#spare_parts').empty();
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
				if(!response == false){
					$('#officesupplies').empty();
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
			case "job_order":{
				if(!response == false){
					 $('#joborder').empty();
					 for(let i=0;i<response.length;i++){
	                  	  	  $('#joborder').append('<option value="'+response[i].production_no+'">'+response[i].production_no+'</option>').addClass('selectpicker').attr('data-live-search', 'true').selectpicker('refresh');
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
			case "material_item":{
				for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].id+'">('+response[i].qty+') '+response[i].name+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }
				break;
			}
			case "material_item_no":{
				for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].item_no+'">('+response[i].qty+') '+response[i].name+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }
				break;
			}
			case"material_request":{
				if(response.data.unit){var unit = response.data.unit}else{ var unit=""};
				if(response.remarks){ var remarks='(<a href="javascript:;" type="button" id="bulk_actions_btn" data-toggle="popover" data-action="show" data-content="'+response.remarks+'">Remark</a>)';}else{ var remarks =" "};
				if(response.qty == 1){

				}else{

				}
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
				$('#kt_material_table > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">\
				<td class="align-middle pl-0 border-0 type tbl-mat-1" data-type="'+response.type+'" data-id="'+response.data.id+'">'+response.data.item+' '+remarks+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0 tbl-mat-2" data-qty="'+response.qty+'">'+response.qty+' '+unit+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest pr-0 border-0 tbl-mat-3" data-remarks="'+response.remarks+'">'+type+'</td>\
				<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"><i class="icon-xl la la-times"></i></button></td>\
				</tr>');
				_initremovetable('#kt_material_table');				
				break;
			}
			case"purchase_material":{
				if(response.type == 1){
					var name = response.data.item;
					var id = response.data.id;
				}else{
					var name = response.name;
					var id = response.name;
				}
				if(response.data.unit){var unit = response.data.unit}else{ var unit=""};
				if(response.remarks){ var remarks='(<a href="javascript:;" type="button" id="bulk_actions_btn" data-toggle="popover" data-action="show" data-content="'+response.remarks+'">Remark</a>)';}else{ var remarks =" "};
				$('#kt_purchased_table > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">\
				<td class="align-middle pl-0 border-0 tbl-pur-1" data-type="'+response.type+'" data-id="'+id+'">'+name+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0 tbl-pur-2" data-qty="'+response.qty+'">'+response.qty+' '+unit+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest pr-0 border-0 tbl-pur-3" data-remarks="'+response.remarks+'">'+remarks+'</td>\
				<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"><i class="icon-xl la la-times"></i></button></td>\
				</tr>');
				_initremovetable('#kt_purchased_table');		
			   break;
			}
			
		}
	}
	
	var _ViewController = async function(view){
		_month_year();
		switch(view){
			case "data-dashboard-admin":{
				let thisUrl = 'dashboard_controller/admin_dashboard';
				_ajaxloader(thisUrl,"POST",false,"admin_dashboard");
				break;
			}
			case "data-dashboard-superuser":{
				let thisUrl = 'dashboard_controller/superuser_dashboard';
				_ajaxloader(thisUrl,"POST",false,"superuser_dashboard");
				break;
			}
			case "data-dashboard-designer":{
				let thisUrl = 'dashboard_controller/designer_dashboard';
				_ajaxloader(thisUrl,"POST",false,"designer_dashboard");
				break;
			}
			case "data-dashboard-production":{
				let thisUrl = 'dashboard_controller/production_dashboard';
				_ajaxloader(thisUrl,"POST",false,"production_dashboard");
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
				let thisUrl = 'modal_controller/Modal_Customer_Concern';
				_ajaxloader(thisUrl,"POST",val,"Modal_Customer_Concern");
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Customer_Concern';
						_ajaxloader(thisUrl,"POST",val,"Modal_Customer_Concern");
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
			
			case "data-return-finishproduct-view":{
				$(document).ready(function() {
					_initSO_option();
					 $(document).on("change","#so",function() {
					 	let id = $(this).val();
					 	let val = {id:id};
					 	let thisUrl = 'view_controller/View_SO_Data';
						_ajaxloader(thisUrl,"POST",val,"View_SO_Return_Data");
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
			case "data-design-create":{
				$(document).ready(function() {
					_initAvatar('design_image');
					$('#image').hide();
					$(".upfile1").click(function (e) {
						e.preventDefault()
					    $("#image").trigger('click');
					});
				});
				break;
			}
			case "data-design-stocks-approval":{
				$(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	$('input[name=title]').attr('data-id',id);
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Design_Stocks_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Design_Stocks_Approval_View");
				 });
				break;
			}
			case "data-design-project-approval":{
				$(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	$('input[name=title]').attr('data-id',id);
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Design_Project_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Design_Project_Approval_View");
				 });
				break;
			}
			case "data-jobeorder-update-stocks":{
				_sessionStorage('request','Material Request');
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
				})
				break;
			}
			case "data-jobeorder-update-project":{
				_sessionStorage('request','Material Request');
				let id = getUrlParameter('URI');
				let thisUrl = 'view_controller/View_Joborder_Request_Stocks';
				_ajaxloader(thisUrl,"POST",{id:id},"View_Joborder_Request_Stocks");
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
					
				})
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
				})
				break;
			}
			case "data-design-stocks":{
				$(document).ready(function() {
					_initAvatar('design_image');
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	$('input[name=title]').attr('data-id',id);
					 	$('.specifications-edit').css('display','none');
					 	$('.image-view').css('display','block');
					 	$('.image-update').css('display','none');
					 	$('.color-view').css('display','block');
					 	$('.color-update').css('display','none');
					 	$("input[name=title]").attr('readonly');
					 	$("input[name=c_name]").attr('readonly');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Design_Stocks_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Design_Stocks_View");
				     });
					$(document).on("click",".btn-edit",function(e) {
					 	e.preventDefault();
					 	let action = $(this).attr('data-action');
					 	$(this).css('display','none');
					 	$('.btn-save').css('display','block');
				 		$('.specifications-edit').css('display','block');
					 	$('.image-view').css('display','none');
					 	$('.image-update').css('display','block');
					 	$('.color-view').css('display','none');
					 	$('.color-update').css('display','block');
					 	$("#text-edit").text('Save Changes');
					 	$("input[name=title]").removeAttr('readonly');
					 	$("input[name=c_name]").removeAttr('readonly');
				     });
					$(".upfile1").click(function () {
					    $("#c-image").trigger('click');
					});
					$(document).on("click","#modal-form > div > div > div.modal-body > form > div.row.justify-content-center > div > div:nth-child(1) > div:nth-child(1) > div.form-group.image-update > div > div > span",function(e) {
		  				e.preventDefault();
		  				let  image = $('input[name=title]').attr('data-image');
		  				$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+image+")");
	  				});
				})
				break;
			}
			case "data-design-project":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function(e) {
					 	e.preventDefault();
					 	let id = $(this).attr('data-id');
					 	$('input[name=title]').attr('data-id',id);
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Design_Project_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Design_Project_View");
				    });
					 $(".upfile1").click(function () {
					    $("#image").trigger('click');
					});
					$(document).on("click","#modal-form > div > div > div.modal-body > form > div.row.justify-content-center > div > div:nth-child(1) > div:nth-child(1) > div.form-group.row > div > div > span",function(e) {
		  				e.preventDefault();
		  				let  image = $('input[name=title]').attr('data-image');
		  				$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+image+")");
	  				});
	  				_initAvatar('design_image');
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	$('input[name=title]').attr('data-id',id);
					 	$('.specifications-edit').css('display','none');
					 	$('.image-view').css('display','block');
					 	$('.image-update').css('display','none');
					 	$("input[name=title]").attr('readonly');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_Design_Project_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Design_Project_View");
				     });
					$(document).on("click",".btn-edit",function(e) {
					 	e.preventDefault();
					 	let action = $(this).attr('data-action');
					 	$(this).css('display','none');
					 	$('.btn-save').css('display','block');
				 		$('.specifications-edit').css('display','block');
					 	$('.image-view').css('display','none');
					 	$('.image-update').css('display','block');
					 	$("#text-edit").text('Save Changes');
					 	$("input[name=title]").removeAttr('readonly');
				     });
					$(".upfile1").click(function () {
					    $("#c-image").trigger('click');
					});
					$(document).on("click","#modal-form > div > div > div.modal-body > form > div.row.justify-content-center > div > div:nth-child(1) > div:nth-child(1) > div.form-group.image-update > div > div > span",function(e) {
		  				e.preventDefault();
		  				let  image = $('input[name=title]').attr('data-image');
		  				$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+image+")");
	  				});
				})
				break;
			}
			case "data-project-existing":{
				$(document).ready(function() {
					_ajaxloaderOption('option_controller/Designer_option','POST',false,'design_option');
					_initAvatar('design_image');
					_initNumberOnly("#quantity");
					$(".upfile1").click(function () {
					    $("#image").trigger('click');
					});
				});
				break;
			}

			case "data-design-joborder-pending":{
				$(document).ready(function() { 
					_initCurrency_format('#labor_cost');
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Joborder_Data';
					_ajaxloader(thisUrl,"POST",val,"View_JobOrder_Pending_Data");
				 });
				break;
			}
			case "data-inquiry":{
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

			//production
			case "data-salesorder":{
				$(document).ready(function() {
					KTSALESORDER.init();
					_ajaxloaderOption('option_controller/Customer_Name','POST',false,'customer_name');
					_ajaxloaderOption('option_controller/Designer_option','POST',false,'design_option');
					$('#project_no').on('change',function(){
						let id = $(this).val();
						_initColor_option1(id);
					});
					$('#c_code').on('change',function(){
						let id = $(this).val();
						_initImage_option(id);
					})
					_initCurrency_format('#cost2');
					_initCurrency_format('#cost');
					_initCurrency_format('#shipping_fee');
					_initPercentage('#discount');
					$('#textarea').hide();
					$('.hide_button').hide();
					$('.hide_button1').hide();
					 $(document).on("change","select[name=status]",function() {
					 	let status = $(this).val();
					 	if(status == 'On Stocks'){
					 		
					 		$('#textarea').hide();
					 		$('.hide_button1').fadeIn();
					 		$('.hide_button').hide();
					 	}else if(status =='customized' || status == 'request'){
					 		$('#textarea').fadeIn();
					 		$('.hide_button1').hide();
					 		$('.hide_button').show();
					 	}else{
					 		$('#textarea').hide();
							$('.hide_button').hide();
							$('.hide_button1').hide();
					 	}	
					 	_initNumberOnly('#qty');
					 	
				    });
					 $('#add_request').on('click',function(){
							var project_no = $('select[name="project_no"]').val();
							var c_code 	= $('select[name="c_code"]').val();
							var quantity  	= $('input[name=qty]').val();
							var price 	= $('input[name=price]').val();
							if(!quantity || !price){
								 Swal.fire("Warning!", "Please Enter Qty and Price!", "warning");
							}else{
								_initFinishproduct_Release(project_no,c_code,quantity,price);
								_initremovetable('#myTable');
								$('input[name=qty]').val('');
							     $('input[name=price]').val('');
							     $('select[name=project_no]').val('').change();
							     $('select[name=c_code]').empty();
							     $('select[name=c_code]').val('').change();
							     $('#color').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
							}
					  });

					 $(document).on("click","input[name=copy]",function() { 
				            if($(this).prop("checked") == true){
				               let address1 = $('input[name=b_address]').val();
				               let city = $('input[name=b_city]').val();
				               let province = $('input[name=b_province]').val();
				               let zipcode = $('input[name=b_zipcode]').val();

				               $('input[name=s_address]').val(address1);
				               $('input[name=s_city]').val(city);
				               $('input[name=s_province]').val(province);
				               $('input[name=s_zipcode]').val(zipcode);
				            }
				            else if($(this).prop("checked") == false){
				               $('input[name=s_address]').val('');
				               $('input[name=s_city]').val('');
				               $('input[name=_s_province]').val('');
				               $('input[name=s_zipcode]').val('');
				            }
					 });
				})
				break;
			}
			case "data-salesorder-list":{
				 $(document).on("click","#view_href",function(){
				 	var page = $('#kt_content').attr('url-link');
					var id = $(this).attr('data-id');
				     $(this).attr("href", baseURL+'gh/'+page+'/salesorder_update/'+id);
				});
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_SalesOrder';
						_ajaxloader(thisUrl,"POST",val,"Modal_SalesOrder");
				    });
				})
				break;
			}
			case "data-salesorder-update":{
				$(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_SalesOrder_Data';
					_ajaxloader(thisUrl,"POST",val,"View_SalesOrder_Data");
				 });
				break;
			}
			case "data-joborder-stocks-list":{
				$(document).ready(function() {
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
			case "data-joborder-project-list":{
				$(document).ready(function() {
				    $(document).on("click","#form-add",function(e) {
				    		e.preventDefault();
				    		$('')
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
			case "data-joborder-process":{
				$(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Joborder_Data';
					_ajaxloader(thisUrl,"POST",val,"View_JobOrder_Data_Process");
				 });
				break;
			}

			case "data-production-Salesorder-Create":{
				_initDatepicker('#date_order')
				break;
			}
			//supervisor
			case "data-supervisor-return-rawmats":{
				$(document).ready(function() { 
					_initJOBORDER1_option();
					$(document).on('change','#joborder',function(e){
						var id = $(this).val();
						let val = {id:id};
						let thisUrl = 'view_controller/View_Return_Item_Data';
						_ajaxloader(thisUrl,"POST",val,"View_Return_Item_Data");
					 });
				 });
			    break;
			}
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

			case "data-onlineorder-list":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let val = {id:id};
					 	let thisUrl = 'modal_controller/Modal_OnlineOrder';
						_ajaxloader(thisUrl,"POST",val,"Modal_OnlineOrder");
				    });
				})
				break;
			}
			case "data-onlineorder-view":{
				$(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_OnlineOrder';
					_ajaxloader(thisUrl,"POST",val,"View_OnlineOrder");
				 });
				break;
			}

			//Reviewer
			case "data-joborder-update":{
				$(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Joborder_Data';
					_ajaxloader(thisUrl,"POST",val,"View_Designer_JobOrder_Data");
				 });
				break;
			}
			case "data-reviewer-joborder-update":{
				$(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Joborder_Data';
					_ajaxloader(thisUrl,"POST",val,"View_Reviewer_JobOrder_Data");
				 });
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
					 $(document).on("click","#form-request",function(){
					 	let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Stocks_SpareParts_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Stocks_SpareParts_View");
				    });
				})
				break;
			}
			case "data-officesupplies-list":{
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
				})
				break;
			}
			case "data-material-request-project":{
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
				})
				break;
			}
			case "data-purchase-stocks-request":{
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
					 $(document).on('click','.btn-add',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let item = $('select[name="item"]').val();
					 	let supplier = $('select[name=supplier]').val();
					 	let terms = $('select[name=terms]').val();
					 	let amount = $('input[name=amount_process]').val();
					 	let quantity = $('input[name=quantity]').val();
					 	if(!quantity || !amount){
					 		Swal.fire("Warning!", "Please Enter Quantity and Amount!", "warning");
					 	}else{
					 		let val = {item:item,quantity:quantity,terms:terms,amount:amount,supplier:supplier};
					 		_ajaxloaderOption('option_controller/Purchased_Item','POST',val,'Purchased_Item');
					 		$('input[name=amount_process]').val("");
					 		$('input[name=quantity]').val("");
					 	}
					 });
				})
				break;
			}
			case "data-purchase-project-request":{
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
					 $(document).on('click','.btn-add',function(e){
					 	e.preventDefault();
					 	e.stopPropagation();
					 	let item = $('select[name="item"]').val();
					 	let supplier = $('select[name=supplier]').val();
					 	let terms = $('select[name=terms]').val();
					 	let amount = $('input[name=amount_process]').val();
					 	let quantity = $('input[name=quantity]').val();
					 	if(!quantity || !amount){
					 		Swal.fire("Warning!", "Please Enter Quantity and Amount!", "warning");
					 	}else{
					 		let val = {item:item,quantity:quantity,terms:terms,amount:amount,supplier:supplier};
					 		_ajaxloaderOption('option_controller/Purchased_Item','POST',val,'Purchased_Item');
					 		$('input[name=amount_process]').val("");
					 		$('input[name=quantity]').val("");
					 	}
					 });
				})
				break;
			}
			case "data-supplier":{
				 $(document).ready(function() {
				 	_initItem_option();
					_initCurrency_format("#price");
				 	let id =  $('input[name=id]').val();
					let val = {id:id};
					let thisUrl = 'view_controller/View_Supplier_Data';
					_ajaxloader(thisUrl,"POST",val,"View_Supplier_Data");
					   $(document).on("click","#form-request",function() {
						let id = $(this).attr('data-id');
						let val = {id:id};
						let thisUrl = 'modal_controller/Modal_SupplierItem_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_SupplierItem_View");
				        });
				  });
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
						let id = $(this).attr('data-id');
						let val = {id:id};
						let thisUrl = 'modal_controller/Modal_Production_Stocks';
						_ajaxloader(thisUrl,"POST",val,"Modal_Production_Stocks");
				    });
				  });
				break;
			}
			case "data-spareparts":{
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
				_initPercentage('#commission');
				 $(document).on("blur","input[name=username]",function() {
				 	 var username = $(this).val();
					 _initUser(username);	
				 });			
				break;
			}

			//ADMIN
			case "data-approval-purchased":{
				$(document).ready(function() {
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let status = $(this).attr('data-status');
					 	let val = {id:id,status:status};
					 	let thisUrl = 'modal_controller/Modal_Approval_Purchase_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Approval_Purchase_View");
				    });
				})
			   break;
			}
			case "data-approval-inspection-project":{
				$(document).ready(function() {
					 $('.summernote').summernote({height: 100});
					 $(document).on("click","#form-request",function() {
					 	let id = $(this).attr('data-id');
					 	let status = $(this).attr('data-status');
					 	let val = {id:id,status:status};
					 	let thisUrl = 'modal_controller/Modal_Approval_Inspection_View';
						_ajaxloader(thisUrl,"POST",val,"Modal_Approval_Inspection_Project_View");
				    });
				})
				break;
			}
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
			case "data-officesupplies-request-view":{
				 $(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Officesupplier_Request_Data';
					_ajaxloader(thisUrl,"POST",val,"View_OfficeSupplies_Request");
				 });
				break;
			}
			case "data-spareparts-request-view":{
				 $(document).ready(function() { 
				    	let id =  $('#request_id_update').attr('data-id');
					let val = {id:id};
					let thisUrl = 'view_controller/View_Spareparts_Request_Data';
					_ajaxloader(thisUrl,"POST",val,"View_Spareparts_Request_Data");
				 });
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
					$(document).on("click","#form-request",function() {
				 		let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Stocks_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Joborder_Stocks_Supervisor");
				     });
				     $(document).on("click","#form-material",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Material_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Request_Supervisor");
				     });
				     $(document).on("click","#form-purchased",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Purchased_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchased_Request_Supervisor");
				     });
				     $(document).on("click","#form-used",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Material_Used_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Used_Supervisor");
				     });
				})
				break;
			}
			case "data-joborder-project-supervisor":{
				$(document).ready(function() {
					$(document).on("click","#form-request",function() {
				 		let val = {id:$(this).attr('data-id')};
					 	let thisUrl = 'modal_controller/Modal_Joborder_Project_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Joborder_Project_Supervisor");
				     });
				     $(document).on("click","#form-material",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Material_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Request_Supervisor");
				     });
				     $(document).on("click","#form-purchased",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Purchased_Request_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Purchased_Request_Supervisor");
				     });
				     $(document).on("click","#form-used",function() {
				 		let val = {id:$('#project_no').attr('data-order')};
					 	let thisUrl = 'modal_controller/Modal_Material_Used_Supervisor';
						_ajaxloader(thisUrl,"POST",val,"Modal_Material_Used_Supervisor");
				     });
				})
				break;
			}
			case "data-dashboard-accounting":{
				let thisUrl = 'dashboard_controller/accounting_dashboard';
				_ajaxloader(thisUrl,"POST",false,"accounting_dashboard");
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
								let thisUrl3 = 'datatable_controller/Account_Report_Income_Monthly';
								_ajaxloader(thisUrl3,"POST",val,"Account_Report_Income_Monthly");
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
		}
	}

	var _initView = async function(view,response)
	{
	  switch(view){
	  	case "production_dashboard":{
		  	$('#sc').text(response.data[0].sc);
		  	$('#ss').text(response.data[0].ss);
		  	$('#pr').text(response.data[0].pr);
		  	$('#ia').text(response.data[0].ia);
		  	$('#ir').text(response.data[0].ir);
		  	$('#sd').text(response.data[0].sd);
		  	$('#so').text(response.data[0].so);
	  		break;
	  	}
	  	case "designer_dashboard":{
		  	$('#mr').text(response.data.mr);
		  	$('#sc').text(response.data.sc);
		  	$('#sr').text(response.data.sr);
		  	$('#da').text(response.data.da);
		  	$('#dr').text(response.data.dr);
		  	$('#ia').text(response.data.ia);
		  	$('#ir').text(response.data.ir);
		  	$('#on').text(response.data.on);
		  	break;
	  	}
	  	case "superuser_dashboard":{
		  	   $('#pr').text(response.pr);
		  	   $('#mr').text(response.mr);
		  	   $('#of').text(response.of);
		  	   $('#sp').text(response.sp);
		  	   $('#so').text(response.so);
		  	   $('#sr').text(response.sr);
		  	   $('#sd').text(response.sd);
		  	   $('#sg').text(response.sg);
		  	   $('#sop').text(response.sop);
		  	   $('#cs').text(response.cs);
		  	   $('#table_rawmats > tbody:last-child').empty();
		  	   for(var i=0;i<response.rawmats.length;i++){
	        			$('#table_rawmats > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response.rawmats[i].item+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response.rawmats[i].stocks+'</td>'
					+'</tr>');
			   }
			   $('#table_office > tbody:last-child').empty();
		  	   for(var i=0;i<response.office.length;i++){
	        			$('#table_office > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response.office[i].item+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response.office[i].stocks+'</td>'
					+'</tr>');
			   }
			    $('#table_supplies > tbody:last-child').empty();
		  	   for(var i=0;i<response.spare.length;i++){
	        			$('#table_supplies > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response.spare[i].item+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response.spare[i].stocks+'</td>'
					+'</tr>');
			   }
	  	   break;
	  	}
	  	case "admin_dashboard":{
	  		$('#pd').text(response[0].pd);
	  		$('#pr').text(response[0].pr);
	  		$('#ir').text(response[0].ir);
	  		$('#so').text(response[0].so);
	  		$('#user').text(response[0].user);
	  		$('#customer').text(response[0].customer);
	  		$('#total-sale').text(response[0].sales);
	  		$('#sr').text(response[0].sr);
	  		$('#sd').text(response[0].sd);
	  		$('#sg').text(response[0].sg);
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
	  	case "Modal_Design_View":{
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
	  			if(response.p_status == 'REQUEST'){
	  				$('#button_status').html('<button type="button" id="REJECTED" class="btn btn-danger btn_rejected">REJECT</button>'
	  									  +'<button type="button" id="APPROVED" class="btn btn-success btn_approved">APPROVE</button>');
	  			}else{
	  				$('#button_status').remove();
	  			}
	  			$("#update_href").click(function(){
				  	 $(this).attr("href", baseURL+'gh/designer/project_request/'+btoa(response.c_code));
				});

	  		}
	  		break;
	  	}
	  	case "Modal_Design_Stocks_View":{
	  		if(!response == false){
	  			$('input[name=title]').val(response.title);
	  			$('input[name=title]').attr('data-image',response.image);
	  			$('input[name=c_name]').val(response.c_name);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$('input[name="image_previous"]').val(response.image);
	  			$('input[name="color_previous"]').val(response.c_image);
	  			$('input[name="docs_previous"]').val(response.docs);
	  			$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.image+")");
	  			$(".c-image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  		}
	  		break;
	  	}
	  	case "Modal_Design_Project_View":{
	  		if(!response == false){
	  			$('input[name=title]').val(response.title);
	  			$('input[name=title]').attr('data-image',response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$(".image-stocks").css("background-image", "url("+baseURL+"assets/images/design/project_request/images/"+response.image+")");
	  			$('input[name="image_previous"]').val(response.image);
	  			$('input[name="docs_previous"]').val(response.docs);
	  		}
	  		break;
	  	}
	  	case "Modal_Design_Stocks_Approval_View":{
	  		if(!response == false){
	  			$('input[name=title]').val(response.title);
	  			$('input[name=c_name]').val(response.c_name);
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			if(response.status == 1){
	  				$('.button_status').html('<button class="btn btn-danger btn_rejected" data-status="3">REJECT</button>\
	  									<button class="btn btn-success btn_approved" data-status="2">APPROVE</button>');
	  			}else{
	  				$('.button_status').remove();
	  			}

	  		}
	  		break;
	  	}
	  	case "Modal_Design_Project_Approval_View":{
	  		if(!response == false){
	  			$('input[name=title]').val(response.title);
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			if(response.status == 1){
	  				$('.button_status').html('<button class="btn btn-danger btn_rejected" data-status="3">REJECT</button>\
	  									<button class="btn btn-success btn_approved" data-status="2">APPROVE</button>');
	  			}else{
	  				$('.button_status').remove();
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
		  		// $("#material_used").attr("href",baseURL + 'gh/supervisor/production-supplies/'+btoa(response.production_no));
		  		// $("#purchase_request").attr("href",baseURL + 'gh/supervisor/purchase_request/'+btoa(response.production_no));
		  		// $("#material_used").attr("href",baseURL + 'gh/supervisor/used_material/'+btoa(response.production_no));
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
	  		     $('#joborder').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title+'('+response[0].c_name+')');
	  		     $('#requestor').text('REQUESTOR: '+response[0].requestor);
	  		     $('#date_created').text(response[0].date_created);
	  		     $('#tbl_material_request_stocks_modal > tbody:last-child').empty();
	  		     $('#tbl_material_accept > tbody:last-child').empty();
	  		     $('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Quantity Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
	             	for(var i=0;i<response.length;i++){
	             		 var remarks = "";
	             		 if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        				$('#tbl_material_request_stocks_modal > tbody:last-child').append('<tr>\
						<td class="align-middle pl-0">'+response[i].item+'</td>\
						<td class="align-middle text-center">'+response[i].balance+'</td>\
						<td class="align-middle text-center">'+response[i].unit+'</td>\
						<td class="align-middle text-center text-success">'+remarks+'</td>\
						</tr>');
					$('#tbl_material_accept > tbody:last-child').append('<tr>\
						<td class="align-middle td-id-'+i+'" data-type="1" data-id="'+response[i].id+'">'+response[i].item+' </td>\
						<td class="align-middle text-center td-balance-'+i+'" data-balance="'+response[i].balance+'">'+response[i].balance+'</td>\
						<td class="align-middle text-center">'+response[i].unit+'</td>\
						<td class="align-middle text-center" width="200"><input type="number" min="0" class="form-control form-control-solid form-control-sm text-center text-qty-'+i+'" placeholder="Input Quantity....."/></td>\
						<td class="align-middle text-center">\
							<button type="button" class="btn btn btn-light-dark font-weight-bold btn-icon btn-shadow btn-save" data-count="'+i+'" data-container="body" data-theme="dark" data-toggle="tooltip" data-placement="top" title="Submit Request"><i class="flaticon2-fast-next blink_me"></i></button>\
						</td>\
					</tr>')
				 }
				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	  	case "Modal_Material_Request_Project_View":{
	  		if(!response == false){
	  		     $('#joborder').text('JOB ORDER: '+response[0].production_no).attr('data-id',response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title);
	  		     $('#requestor').text('REQUESTOR: '+response[0].requestor);
	  		     $('#date_created').text(response[0].date_created);
	  		     $('#tbl_material_request_stocks_modal > tbody:last-child').empty();
	  		     $('#tbl_material_accept > tbody:last-child').empty();
	  		     $('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Quantity Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#modal-form > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
	             	for(var i=0;i<response.length;i++){
	             		 var remarks = "";
	             		 if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        				$('#tbl_material_request_stocks_modal > tbody:last-child').append('<tr>\
						<td class="align-middle pl-0">'+response[i].item+'</td>\
						<td class="align-middle text-center">'+response[i].balance+'</td>\
						<td class="align-middle text-center">'+response[i].unit+'</td>\
						<td class="align-middle text-center text-success">'+remarks+'</td>\
						</tr>');
					$('#tbl_material_accept > tbody:last-child').append('<tr>\
						<td class="align-middle td-id-'+i+'" data-type="2" data-id="'+response[i].id+'">'+response[i].item+' </td>\
						<td class="align-middle text-center td-balance-'+i+'" data-balance="'+response[i].balance+'">'+response[i].balance+'</td>\
						<td class="align-middle text-center">'+response[i].unit+'</td>\
						<td class="align-middle text-center" width="200"><input type="number" min="0" class="form-control form-control-solid form-control-sm text-center text-qty-'+i+'" placeholder="Input Quantity....."/></td>\
						<td class="align-middle text-center">\
							<button type="button" class="btn btn btn-light-dark font-weight-bold btn-icon btn-shadow btn-save" data-count="'+i+'" data-container="body" data-theme="dark" data-toggle="tooltip" data-placement="top" title="Submit Request"><i class="flaticon2-fast-next blink_me"></i></button>\
						</td>\
					</tr>')
				 }
				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	 
	  	case "Modal_Purchase_Stocks_Request_View":{
	  		if(!response == false){
	  		     $('#production_no').text('JOB ORDER: '+response[0].production_no);
	  		     $('#production_no').attr('data-id',response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title+' ('+response[0].c_name+')');
	  		     $('#requestor').text('REQUESTOR: '+response[0].production);
	               $('#date_created').text(response[0].date_created);
	             	$('#tbl_purchasing_modal > tbody:last-child').empty();
	             	$('#tbl_purchasing_estimate > tbody:last-child').empty();

	             	$('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit').addClass('d-none').removeAttr('id');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
	             	for(var i=0;i<response.length;i++){
	             		_initCurrency_format('.text-amount'+i);
	             		var remarks = "";
	             		if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        			$('#tbl_purchasing_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder">'
					+'<td class="align-middle pl-0">'+response[i].item+' </td>'
					+'<td class="align-middle text-center text-success">'+response[i].balance+' '+response[i].unit+'</td>'
					+'<td class="align-middle text-center text-success">'+remarks+'</td>'
					+'</tr>');

					$('#tbl_purchasing_estimate > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder">\
					<td class="align-middle pl-0 td-id" data-id="'+response[i].id+'" data-count="'+i+'">'+response[i].item+' </td>\
					<td class="align-middle text-center">'+response[i].balance+' '+response[i].unit+'</td>\
					<td class="align-middle text-center" width="200"><input type="text" class="form-control form-control-solid form-control-sm text-center td-amount text-amount'+i+'" placeholder="Input Estimate Amount....."/></td>\
					</tr>');
				 }
				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Stocks_Inprogress_View":{
	  		if(!response == false){
	  			_initCurrency_format('.text-amount-process');
	  			$('#joborder').attr('data-id',response[0].production_no).text('JOB ORDER: '+response[0].production_no);
	  		     $('#title_inprocess').text('ITEM: '+response[0].title+' ('+response[0].c_name+')');
	  		     $('#requestor_inprocess').text('REQUESTOR: '+response[0].requestor);
	               $('#date_created_inprocess').text(response[0].date_created);
	             	$('#tbl_purchasing_inprogress_modal > tbody:last-child').empty();
	             	$('.btn-change-process').attr('data-action','view');
	             	$('.btn-change-process').html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit-process').addClass('d-none').removeAttr('id');
	             	$('#view-details').removeClass('d-none');
				$('#view-purchased').addClass('d-none');
				$('#tbl_purchasing_process > tbody:last-child').empty();	
	             	for(var i=0;i<response.length;i++){
	             		if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        			$('#tbl_purchasing_inprogress_modal > tbody:last-child').append('<tr>\
						<td class="align-middle pl-0">'+response[i].item+' </td>\
						<td class="align-middle text-center text-success pr-0">'+response[i].balance+' '+response[i].unit+'</td>\
						<td class="align-middle text-center text-success">'+remarks+'</td>\
					</tr>');
					$('#select-material').append('<option value="'+response[i].id+'">'+response[i].item+'</option>');
					$('#select-material').addClass('selectpicker');
					$('#select-material').attr('data-live-search', 'true');
					$('#select-material').selectpicker('refresh');
				 }
				   $('[data-toggle="tooltip"]').tooltip();
				 if(response[0].status_request == 0){
				 	$('.btn-hide').show();
				 }else{
				 	$('.btn-hide').hide();
				 }
				
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Project_Request_View":{
	  		if(!response == false){
	  		     $('#production_no').attr('data-id',response[0].production_no).text('JOB ORDER: '+response[0].production_no);
	  		     $('#title').text('ITEM: '+response[0].title);
	  		     $('#requestor').text('REQUESTOR: '+response[0].production);
	               $('#date_created').text(response[0].date_created);
	             	$('#tbl_purchasing_modal > tbody:last-child').empty();
	             	$('#tbl_purchasing_estimate > tbody:last-child').empty();

	             	$('.btn-change').attr('data-action','view');
	             	$('.btn-change').html('Generate Cost Estimate <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit').addClass('d-none').removeAttr('id');
	             	$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(1)').removeClass('d-none');
				$('#requestModal > div > div > div.modal-body > div:nth-child(2) > div:nth-child(2)').addClass('d-none');
	             	for(var i=0;i<response.length;i++){
	             		_initCurrency_format('.text-amount'+i);
	             		var remarks = "";
	             		if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        			$('#tbl_purchasing_modal > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder">'
					+'<td class="align-middle pl-0">'+response[i].item+' </td>'
					+'<td class="align-middle text-center text-success">'+response[i].balance+' '+response[i].unit+'</td>'
					+'<td class="align-middle text-center text-success">'+remarks+'</td>'
					+'</tr>');

					$('#tbl_purchasing_estimate > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder">\
					<td class="align-middle pl-0 td-id" data-id="'+response[i].id+'" data-count="'+i+'">'+response[i].item+' </td>\
					<td class="align-middle text-center">'+response[i].balance+' '+response[i].unit+'</td>\
					<td class="align-middle text-center" width="200"><input type="text" class="form-control form-control-solid form-control-sm text-center td-amount text-amount'+i+'" placeholder="Input Estimate Amount....."/></td>\
					</tr>');
				 }
				 $('[data-toggle="tooltip"]').tooltip();
	  		}
	  		break;
	  	}
	  	case "Modal_Purchase_Project_Inprogress_View":{
	  		if(!response == false){
	  			_initCurrency_format('.text-amount-process');
	  			$('#joborder').attr('data-id',response[0].production_no).text('JOB ORDER: '+response[0].production_no);
	  		     $('#title_inprocess').text('ITEM: '+response[0].title);
	  		     $('#requestor_inprocess').text('REQUESTOR: '+response[0].requestor);
	               $('#date_created_inprocess').text(response[0].date_created);
	             	$('#tbl_purchasing_inprogress_modal > tbody:last-child').empty();
	             	$('.btn-change-process').attr('data-action','view');
	             	$('.btn-change-process').html('Inbound Item <i class="flaticon2-fast-next blink_me"></i>');
	             	$('.btn-submit-process').addClass('d-none').removeAttr('id');
	             	$('#view-details').removeClass('d-none');
				$('#view-purchased').addClass('d-none');
				$('#tbl_purchasing_process > tbody:last-child').empty();	
	             	for(var i=0;i<response.length;i++){
	             		if(response[i].remarks){remarks = '(<a href="javascript:;" data-container="body"  data-theme="dark" data-toggle="tooltip" data-placement="top" title="'+response[i].remarks+'">Remarks</a>)';}
	        			$('#tbl_purchasing_inprogress_modal > tbody:last-child').append('<tr>\
						<td class="align-middle pl-0">'+response[i].item+' </td>\
						<td class="align-middle text-center text-success pr-0">'+response[i].balance+' '+response[i].unit+'</td>\
						<td class="align-middle text-center text-success">'+remarks+'</td>\
					</tr>');
					$('#select-material').append('<option value="'+response[i].id+'">'+response[i].item+'</option>');
					$('#select-material').addClass('selectpicker');
					$('#select-material').attr('data-live-search', 'true');
					$('#select-material').selectpicker('refresh');
				 }
				   $('[data-toggle="tooltip"]').tooltip();
				 if(response[0].status_request == 0){
				 	$('.btn-hide').show();
				 }else{
				 	$('.btn-hide').hide();
				 }
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
	  			$('#unit').val(response.unit);
	  			$('select[name=status]').val(response.status).change();
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
	  			_initPercentage('#commission');
	  			let dis = parseFloat((response.commission*100)/1);
	  			$('input[name=id]').val(response.id);
	  			$('input[name=firstname]').val(response.firstname);
	  			$('input[name=lastname]').val(response.lastname);
	  			$('input[name=middlename]').val(response.middlename);
	  			$('input[name=username]').val(response.username);
	  			$('#commission').val(dis+'%');
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
	  	
	  	case "Modal_Approval_Inspection_Project_View":{
	  		 if(!response == false){
	  			$('#joborder').text(response[0].production_no);
	  			$('#title').val(response[0].title);
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response[0].image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response[0].docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response[0].image);
	  			$('.summernote').summernote('code',response[0].remarks);
	  			if(response[0].status == 1){
	  				$('#button_status').html('<button type="button" class="btn btn-danger btn_status" data-status="3">REJECT</button>'
					+'<button type="button" class="btn btn-success btn_status" data-status="2">APPROVE</button>');
	  			}else{
	  				$('#button_status').remove();
	  			}
	  			$("#requestInspection").empty();
	  			for(let i=0;i<response.length;i++){
	  				$("#requestInspection").append('<div class="col-lg-2 col-xl-2" id="row_'+response[i].id+'">'
		  			+'<div class="image-input image-input-empty image-input-outline"  style="background-image: url('+baseURL+'assets/images/inspection/'+response[i].i_images+')">'
					+'<div class="image-input-wrapper"></div>'
					+'  </div>'
		  			+'</div>');
	  			}
	  		} 
	  		break;
	  	}
	  	case "Modal_SalesOrder_Approval":{
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
	               $('#vat').text(response[0].vat);
	               $('#discount').text(dis+'%');
	               $('#total').text(response[0].total);
	               $('#downpayment').text(response[0].downpayment);
	               $('#grandtotal').text(response[0].grandtotal);
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
				if(response[0].status == 'REQUEST FOR APPROVAL'){
	  				$('#button_status').html('<button type="button" id="REJECTED" class="btn btn-danger btn_rejected">REJECT</button>\
									<button type="button" id="APPROVED" class="btn btn-success btn_approved">APPROVE</button>');
	  			}else{
	  				$('#button_status').remove();
	  			}
	  			if(response[0].status == 'SHIPPING'){
	  				$('#delivered_btn').show();
	  			}else{
	  				$('#delivered_btn').hide();
	  			}
	  		}
	  		break;
	  	}
	  	case "Modal_SalesOrder":{
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
	               $('#vat').text(response[0].vat);
	               $('#discount').text(dis+'%');
	               $('#total').text(response[0].total);
	               $('#downpayment').text(response[0].downpayment);
	               $('#grandtotal').text(response[0].grandtotal);
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
				if(response[0].status == 'REQUEST'){
	  				$('#button_status').html('<button type="button" id="REJECTED" class="btn btn-danger btn_rejected">REJECT</button>'
									+'<button type="button" id="APPROVED" class="btn btn-success btn_approved">APPROVE</button>');
	  			}else{
	  				$('#button_status').remove();
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
	  	//Designer
	  	case "View_OfficeSupplies_Request":{
	  		if(!response == false){
	  				$('#title').val(response[0].title);
	  		$('#unit').val(response[0].unit);
	  		 let html =' ';
				html +='<thead>'+'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STOCKS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STATUS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RELEASE</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
					for(let i=0;i<response.length;i++){
						_initNumberOnly("#balance_quantity"+response[i].id);
						$(document).ready(function() {
							if(response[i].status == 'PARTIAL PENDING'){
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PARTIAL CLOSED'){
								$('.add'+response[i].id).attr('disabled',true);
								$('#balance_quantity'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'CANCELLED'){
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PENDING'){
								$('.add'+response[i].id).attr('disabled',true);
							}
							$('#status'+response[i].id).val(response[i].status).change().attr('selected',true);
						});
						
						$(document).on('change','#status'+response[i].id,function() {
						 	status = $(this).val();
						 	balance = $('#balanced'+response[i].id).val();
						 	if(status == 'COMPLETE'){
						 		$('#balance_quantity'+response[i].id).val(balance).prop('readonly',true);
							 	$('#balanced_'+response[i].id).text(0);
							 	if(response[i].status == 'COMPLETE'){
							 		$('.add'+response[i].id).attr('disabled',true);
							 		$('#status'+response[i].id).attr('disabled',true);
							 	}else{
							 		$('.add'+response[i].id).attr('disabled',false);	
							 	}
							 	
							}else if(status == 'CANCELLED'){
								$('#balance_quantity'+response[i].id).val(0).prop('readonly',true);
							     $('#balanced_'+response[i].id).text(balance);
							     if(response[i].status == 'CANCELLED'){
								$('.add'+response[i].id).attr('disabled',true);
								$('#status'+response[i].id).attr('disabled',true);
								}else{$('.add'+response[i].id).attr('disabled',false);}
							     
							}else if(status == 'PENDING'){
								$('#balance_quantity'+response[i].id).val('');
							     $('#balanced_'+response[i].id).text(balance);
							     $('.add'+response[i].id).attr('disabled',true);
							}else{
								$(document).on('blur','#balance_quantity'+response[i].id,function() {
								 	received = $(this).val();
								 	let total =  parseFloat(balance) - parseFloat(received);
								 	if(total < 0 || isNaN(total)){
								 		$('#balance_quantity'+response[i].id).val('');
									 	$('#balanced_'+response[i].id).text(balance);
									 	$('.add'+response[i].id).attr('disabled',true);	
									}else{
									     $('#balanced_'+response[i].id).text(total);
									     $('.add'+response[i].id).attr('disabled',false);
									}	
								});
							}	
						});
						html +='<tr class="font-size-lg font-weight-bolder h-65px">'
								+'<td class="align-middle pl-0 border-0" width="300"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'">'+response[i].item+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="balanced'+response[i].id+'" value="'+response[i].balance+'"/><span id="balanced_'+response[i].id+'">'+response[i].balance+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].stocks+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="200"><select class="form-control form-control-solid" id="status'+response[i].id+'">'
																+'<option value="PENDING" selected>SELECT OPTION</option>'
																+'<option value="PARTIAL PENDING">PARTIAL PENDING</option>'
																+'<option value="PARTIAL CLOSED">PARTIAL CLOSED</option>'
															     +'<option value="COMPLETE">COMPLETE</option>'
															     +'<option value="CANCELLED">CANCEL</option></select></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center;"/></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1 add'+response[i].id+'">SAVE</button></td>'
								+'</tr>';
				}	
				$('#tbl-OfficeSupplies-Request').html(html);
	  		}
	  		break;
	  	}
	  	case "View_Spareparts_Request_Data":{
	  		if(!response == false){
	  				$('#title').val(response[0].title);
	  		$('#unit').val(response[0].unit);
	  		 let html =' ';
				html +='<thead>'+'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STOCKS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STATUS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RELEASE</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
					for(let i=0;i<response.length;i++){
						_initNumberOnly("#balance_quantity"+response[i].id);
						$(document).ready(function() {
							if(response[i].status == 'PARTIAL PENDING'){
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PARTIAL CLOSED'){
								$('.add'+response[i].id).attr('disabled',true);
								$('#balance_quantity'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'CANCELLED'){
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PENDING'){
								$('.add'+response[i].id).attr('disabled',true);
							}
							$('#status'+response[i].id).val(response[i].status).change().attr('selected',true);
						});
						
						$(document).on('change','#status'+response[i].id,function() {
						 	status = $(this).val();
						 	balance = $('#balanced'+response[i].id).val();
						 	if(status == 'COMPLETE'){
						 		$('#balance_quantity'+response[i].id).val(balance).prop('readonly',true);
							 	$('#balanced_'+response[i].id).text(0);
							 	if(response[i].status == 'COMPLETE'){
							 		$('.add'+response[i].id).attr('disabled',true);
							 		$('#status'+response[i].id).attr('disabled',true);
							 	}else{
							 		$('.add'+response[i].id).attr('disabled',false);	
							 	}
							 	
							}else if(status == 'CANCELLED'){
								$('#balance_quantity'+response[i].id).val(0).prop('readonly',true);
							     $('#balanced_'+response[i].id).text(balance);
							     if(response[i].status == 'CANCELLED'){
								$('.add'+response[i].id).attr('disabled',true);
								$('#status'+response[i].id).attr('disabled',true);
								}else{$('.add'+response[i].id).attr('disabled',false);}
							     
							}else if(status == 'PENDING'){
								$('#balance_quantity'+response[i].id).val('');
							     $('#balanced_'+response[i].id).text(balance);
							     $('.add'+response[i].id).attr('disabled',true);
							}else{
								$(document).on('blur','#balance_quantity'+response[i].id,function() {
								 	received = $(this).val();
								 	let total =  parseFloat(balance) - parseFloat(received);
								 	if(total < 0 || isNaN(total)){
								 		$('#balance_quantity'+response[i].id).val('');
									 	$('#balanced_'+response[i].id).text(balance);
									 	$('.add'+response[i].id).attr('disabled',true);	
									}else{
									     $('#balanced_'+response[i].id).text(total);
									     $('.add'+response[i].id).attr('disabled',false);
									}	
								});
							}	
						});
						html +='<tr class="font-size-lg font-weight-bolder h-65px">'
								+'<td class="align-middle pl-0 border-0" width="300"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'">'+response[i].item+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="balanced'+response[i].id+'" value="'+response[i].balance+'"/><span id="balanced_'+response[i].id+'">'+response[i].balance+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].stocks+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="200"><select class="form-control form-control-solid" id="status'+response[i].id+'">'
																+'<option value="PENDING" selected>SELECT OPTION</option>'
																+'<option value="PARTIAL PENDING">PARTIAL PENDING</option>'
																+'<option value="PARTIAL CLOSED">PARTIAL CLOSED</option>'
															     +'<option value="COMPLETE">COMPLETE</option>'
															     +'<option value="CANCELLED">CANCEL</option></select></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center;"/></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1 add'+response[i].id+'">SAVE</button></td>'
								+'</tr>';
				}	
				$('#tbl-sprareparts-Request').html(html);
	  		}
	  		break;
	  	}
	  	case "View_Desing_Project_Data":{
	  		if(!response == false){
	  		      _initAvatar('design_image');
	  		      $(document).ready(function() {
					$(".upfile1").click(function () {
					    $("#image1").trigger('click');
					});
				});
		  		$('#title').val(response.title);
		  		$('#project_no').text(response.project_no);
		  		$('input[name=previous_image]').val(response.image);
		  		$('input[name=previous_docs]').val(response.docs);
		  		$('input[name=previous_color]').val(response.c_image);
		  		$('input[name=c_name]').val(response.c_name);
		  		$('select[name=status]').val(response.status).change();
		  		$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
		  		$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
		  		$(".color").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
		  		$('#image').attr('style','background-image: url('+baseURL+'assets/images/design/project_request/images/'+response.image+')');
		  	}
	  		break;
	  	}
	  	case "View_Designer_JobOrder_Data":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			$('#project_nos').text(response.production_no);
	  			$('#title').val(response.title);
	  			$('#unit').val(response.balance);
	  			$('#production_no').val(response.production_no);
	  			$('#c_code').val(response.c_code);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.project_no));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$('#c_name').val(response.c_name);
	  			$("#update_href").click(function(){
				    $(this).attr("href", baseURL+'gh/production/joborder_update/'+btoa(response.production_no));
				});
				$(document).on('keyup','input[name=release]',function() {
				 	received = $(this).val();
				 	let total =  parseFloat(response.balance) - parseFloat(received);

				 	if(total < 0 || isNaN(total)){
				 		$('#unit').val(response.balance);	
					 	$('input[name=release]').val('');	
					}else{
					     $('#unit').val(total);
					}	
				});
	  		}
	  		break;
	  	}
	  	case "View_JobOrder_Pending_Data":{
	  			KTWizard1.init();
	  		     _initNumberOnly("#quantity");
				_initNumberOnly("#qty");
	  			$('#project_no').text(response.project_no);
	  			$('#title').val(response.title);
	  			$('#c_code').text(response.c_code);
	  			$('#c_name').val(response.c_name);
	  			$('#unit').val(response.unit);
	  			$('#production').val(response.production);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.c_code));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
				$(document).on('change','select[name=material_item]',function(e){
					var action = $(this).val().split('-');
					_initItemQTY_option(action[0]);
				});
				$('.hide_special').hide();
				$(".special").removeAttr("name");
				$(document).on('change','select[name=special_option]',function(){
					let option = $(this).val();
					if(option == 'common'){
						$('.hide_common').show();
						$(".special").removeAttr("name");
						$(".common").attr("name",'purchase_item');
						$('.hide_special').hide();
					}else{
						$('.hide_common').hide();
						$(".common").removeAttr("name");
						$(".special").attr("name",'special_item');
						$('.hide_special').show();
					}
				});
	  		break;
	  	}
	  	case "View_JobOrder_Data_Process":{
	  		if(!response == false){
	  			_initNumberOnly("#release");
	  			$('#project_nos').text(response.production_no);
	  			$('#title').val(response.title);
	  			$('#unit').val(response.balance);
	  			$('#production_no').val(response.production_no);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.project_no));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  			$("#update_href").click(function(){
				    $(this).attr("href", baseURL+'gh/production/joborder_update/'+btoa(response.production_no));
				});
				$(document).on('keyup','input[name=release]',function() {
				 	received = $(this).val();
				 	let total =  parseFloat(response.balance) - parseFloat(received);

				 	if(total < 0 || isNaN(total)){
				 		$('#unit').val(response.balance);	
					 	$('input[name=release]').val('');	
					}else{
					     $('#unit').val(total);
					}	
				});
	  		}
	  		break;
	  	}
	  	case "View_SalesOrder_Data":{
	  	     if(!response == false){
	  	     	KTSALESORDER.init();
	  	     	_ajaxloaderOption('option_controller/Designer_option','POST',false,'design_option');
				$('#project_no').on('change',function(){
					_initColor_option($(this).val());
				});
				$('#c_code').on('change',function(){
					_initImage_option($(this).val());
				})
				_initCurrency_format('#cost1');
				_initNumberOnly('#qty');
				let dis = parseFloat((response.discount*100)/1);
		  		$('input[name=fullname]').val(response.c_name);
				$('input[name=email]').val(response.email);
				$('input[name=mobile]').val(response.mobile);
				$('input[name=dp]').val(response.mobile);
				$('input[name=so_no]').val(response.so_no);
				$('input[name=discount]').val(dis);
				$('input[name=shipping_fee]').val(response.shipping_fee);
				$('select[name=vat]').val(response.vat).change();
				tinyMCE.get('kt-tinymce-4').setContent(response.remarks);
				_initCurrency_format('input[name=price]');
				$(document).on("click","input[name=copy]",function() { 
				    if($(this).prop("checked") == true){
				         let address1 = $('input[name=b_address]').val();
				         let city = $('input[name=b_city]').val();
				         let province = $('input[name=b_province]').val();
				         let zipcode = $('input[name=b_zipcode]').val();
			               $('input[name=s_address]').val(address1);
			               $('input[name=s_city]').val(city);
			               $('input[name=s_province]').val(province);
			               $('input[name=s_zipcode]').val(zipcode);
			            }
			            else if($(this).prop("checked") == false){
			               $('input[name=s_address]').val('');
			               $('input[name=s_city]').val('');
			               $('input[name=_s_province]').val('');
			               $('input[name=s_zipcode]').val('');
			            }
			     });
			      $('#add_request').on('click',function(){
						var project_no = $('select[name="project_no"]').val();
						var c_code 	= $('select[name="c_code"]').val();
						var quantity  	= $('input[name=qty]').val();
						var price 	= $('input[name=price]').val();
						if(!quantity || !price){
							 Swal.fire("Warning!", "Please Enter Qty and Price!", "warning");
						}else{
							_initFinishproduct_Release(project_no,c_code,quantity,price);
							_initremovetable('#myTable');
							$('input[name=qty]').val('');
						     $('input[name=price]').val('');
						     $('select[name=project_no]').val('').change();
						     $('select[name=c_code]').empty();
						     $('select[name=c_code]').val('').change();
						     $('#color').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
						}
				});

	  	     }
	  		break;
	  	}

	  	//supervisor
	  	case "View_Return_Item_Data":{
   		          let html =' ';
				html +='<thead>'+'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">UNIT</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RETURN</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
				for(let i=0;i<response.length;i++){
					_initNumberOnly("#balance_quantity"+response[i].id);
					html +='<tr class="font-size-lg font-weight-bolder h-65px">'
							+'<td class="align-middle pl-0 border-0"  width="300"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'">'+response[i].item+'</td>'
							+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].qty+'</td>'
							+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="unit'+response[i].id+'" value="'+response[i].unit+'">'+response[i].unit+'</td>'
							+'<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center"/></td>'
							+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1">RETURN</button></td>'
							+'</tr>';
				}	
				html +='</tbody>';
			$('#tbl-return-item').html(html);	
	  	   break;
	  	}
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
	  	case "View_SO_Return_Data":{
	  		if(!response == false){
	  			$('input[name=c_name]').val(response[0].costumer);
	  			let html =' ';
				html +='<thead>'
							 +'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">PRICE</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STATUS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RETURN</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
					  for(let i=0;i<response.length;i++){
						  $(document).ready(function(){
							if(response[i].balance == 0){
							$('#balance_quantity'+response[i].id).attr('disabled',true);
							$('.add'+response[i].id).attr('disabled',true);	
						    }
						});
						_initNumberOnly("#balance_quantity"+response[i].id);
						$(document).on('blur','#balance_quantity'+response[i].id,function() {
						 	received = $(this).val();
						 	balance = $('#balanced'+response[i].id).val();
						 	let total =  parseFloat(balance) - parseFloat(received);
						 	if(total < 0 || isNaN(total)){
						 		$('#balance_quantity'+response[i].id).val('');
							 	$('#balanced_'+response[i].id).text(balance);
							 	$('.add'+response[i].id).attr('disabled',true);	
							}else{
							     $('#balanced_'+response[i].id).text(total);
							     $('.add'+response[i].id).attr('disabled',false);
							}	
						});
						html +='<tr class="font-size-lg font-weight-bolder h-65px">'
								+'<td class="align-middle pl-0 border-0" width="400" id="c_code'+response[i].id+'" data-code="'+response[i].c_code+'"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'">'+response[i].title+'</td>'
								+'<td class="text-center align-middle text-center text-success font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="balanced'+response[i].id+'" value="'+response[i].balance+'"/><span id="balanced_'+response[i].id+'">'+response[i].balance+'</span></td>'
								+'<td class="text-center align-middle pl-0 border-0" width="300"><input type="hidden" id="balanceprice'+response[i].id+'" value="'+response[i].balance_price+'"><span id="balanceprice_'+response[i].id+'">'+response[i].balance_price+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="200"><select class="form-control form-control-solid" id="status'+response[i].id+'">'
																+'<option value="PENDING">SELECT OPTION</option>'
																+'<option value="GOOD">GOOD</option>'
																+'<option value="REJECTED">REJECT</option></select></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center;"/></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1 add'+response[i].id+'">SAVE</button></td>'
								+'</tr>';
				}	
				$('#tbl-return-finishproduct-request').html(html);
	  		}
	  		break;
	  	}

	  	//Reviewer
	
	  	case "Modal_Delivery_Data":{
	  		if(!response == false){
	  			$('#delivery_no').text(response[0].delivery_no);
	  			let html =' ';
				html +='<thead>'+'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">TOTAL QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RECEIVED</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STATUS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
					for(let i=0;i<response.length;i++){
						_initNumberOnly("#balance_quantity"+response[i].id);
						$( document ).ready(function() {
							if(response[i].status == 'INCOMPLETE'){
								$('#status'+response[i].id).text('INCOMPLETE').removeClass().addClass('label label-warning label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'COMPLETE'){
								$('#status'+response[i].id).text('COMPLETE').removeClass().addClass('label label-success label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
								$('#balance_quantity'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PENDING'){
								$('#status'+response[i].id).text('N/A').removeClass().addClass('label label-danger label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
							}
						});
						$(document).on('blur','#balance_quantity'+response[i].id,function() {
						 	received = $(this).val();
						 	balance =  $('#balanced'+response[i].id).val();
						 	let total =  parseFloat(balance) - parseFloat(received);
						 	if(total < 0 || isNaN(total)){
						 			$('#balance_quantity'+response[i].id).val('');
							 	    	$('#balanced_'+response[i].id).text(balance);
							 	    	$('#status'+response[i].id).text('N/A').removeClass().addClass('label label-danger label-pill label-inline mr-2');
							 	    	$('.add'+response[i].id).attr('disabled',true);	
							}else{
								if(total == 0){
								 	$('#status'+response[i].id).text('COMPLETE').removeClass().addClass('label label-success label-pill label-inline mr-2');
								}else{
									$('#status'+response[i].id).text('INCOMPLETE').removeClass().addClass('label label-warning label-pill label-inline mr-2');
								}
							     $('#balanced_'+response[i].id).text(total);
							     $('.add'+response[i].id).attr('disabled',false);
							}	
						});
						html +='<tr class="font-size-lg font-weight-bolder h-65px">'	
								+'<td class="align-middle pl-0 border-0" width="300"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'"/>'+response[i].item+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].quantity+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="balanced'+response[i].id+'" value="'+response[i].balance+'"/><span id="balanced_'+response[i].id+'">'+response[i].balance+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center;"/></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><span class="" id="status'+response[i].id+'"></span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1 add'+response[i].id+'">SAVE</button></td>'
								+'</tr>';
				}	
				$('#tbl_delivery_update').html(html);
			}
	  		break;
	  	}
	  	case "Modal_Stocks_Delivery_Data":{
	  		if(!response == false){
	  			let html =' ';
				html +='<thead>'+'<tr><th class="pl-0 font-weight-bold text-muted text-uppercase">ITEM</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">QTY</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">RECEIVED</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">STATUS</th>'
							 +'<th class="text-center font-weight-bold text-muted text-uppercase">ACTION</th></tr>'
						  	 +'</thead><tbody>';
					for(let i=0;i<response.length;i++){
						_initNumberOnly("#balance_quantity"+response[i].id);
						$( document ).ready(function() {
							if(response[i].status == 'INCOMPLETE'){
								$('#status'+response[i].id).text('INCOMPLETE').removeClass().addClass('label label-warning label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'COMPLETE'){
								$('#status'+response[i].id).text('COMPLETE').removeClass().addClass('label label-success label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
								$('#balance_quantity'+response[i].id).attr('disabled',true);
							}else if(response[i].status == 'PENDING'){
								$('#status'+response[i].id).text('N/A').removeClass().addClass('label label-danger label-pill label-inline mr-2');
								$('.add'+response[i].id).attr('disabled',true);
							}
						});
						$(document).on('blur','#balance_quantity'+response[i].id,function() {
						 	received = $(this).val();
						 	balance =  $('#balanced'+response[i].id).val();
						 	let total =  parseFloat(balance) - parseFloat(received);
						 	if(total < 0 || isNaN(total)){
						 			$('#balance_quantity'+response[i].id).val('');
							 	    	$('#balanced_'+response[i].id).text(balance);
							 	    	$('#status'+response[i].id).text('N/A').removeClass().addClass('label label-danger label-pill label-inline mr-2');
							 	    	$('.add'+response[i].id).attr('disabled',true);	
							}else{
								if(total == 0){
								 	$('#status'+response[i].id).text('COMPLETE').removeClass().addClass('label label-success label-pill label-inline mr-2');
								}else{
									$('#status'+response[i].id).text('INCOMPLETE').removeClass().addClass('label label-warning label-pill label-inline mr-2');
								}
							     $('#balanced_'+response[i].id).text(total);
							     $('.add'+response[i].id).attr('disabled',false);
							}	
						});
						html +='<tr class="font-size-lg font-weight-bolder h-65px">'	
								+'<td class="align-middle pl-0 border-0" width="300"><input type="hidden" id="item'+response[i].id+'" value="'+response[i].item+'"/>'+response[i].item+'</td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><input type="hidden" id="balanced'+response[i].id+'" value="'+response[i].balance+'"/><span id="balanced_'+response[i].id+'">'+response[i].balance+'</span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><input type="text" id="balance_quantity'+response[i].id+'"  class="form-control" style="text-align:center;"/></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0" width="100"><span class="" id="status'+response[i].id+'"></span></td>'
								+'<td class="align-middle text-center text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="save" data-id="'+response[i].id+'" class="btn btn-success font-weight-bolder ml-sm-auto my-1 add'+response[i].id+'">SAVE</button></td>'
								+'</tr>';
				}	
				$('#tbl_delivery_update').html(html);
			}
	  	}
	     case "View_Supplier_Data":{
	  		if(!response == false){
	  			$('#supplier_name').text(response.name);
	  			$('#status').text(response.status);
	  			$('#email').text(response.email);
	  			$('#mobile').text(response.mobile);
	  			$('#facebook').text(response.facebook);
	  			$('#address').text(response.address);
	  			$('#website').text(response.website);

	  			$('input[name=name]').val(response.name);
	  			$('select[name=s_status]').val(response.status).change();
	  			$('input[name=email]').val(response.email);
	  			$('input[name=mobile]').val(response.mobile);
	  			$('input[name=facebook]').val(response.facebook);
	  			$('input[name=address]').val(response.address);
	  			$('input[name=website]').val(response.website);
	  		}
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
	  	case "Modal_OnlineOrder":{
	  		if(!response == false){
	               $('#date_order').text(response[0].date_order);
	               $('#order_no').text(response[0].order_no);
	               $('#c_name').text(response[0].c_name);
	               $('#mobile').text(response[0].mobile);
	               $('#email').text(response[0].email);
	               $('#b_address').text(response[0].b_address);
	               $('#b_city').text(response[0].b_city+','+response[0].b_province);
	               $('#s_address').text(response[0].s_address);
	               $('#s_city').text(response[0].s_city+','+response[0].s_province);

	               if(response[0].downpayment == 0.00 || !response[0].downpayment){
	               	$('.downpayment').hide();
	               	$('.grandtotal').hide();
	               	$('.vat').hide();
	               	$('.shipping_fee').hide();
	               }else{
	               	$('.total').show();
	               	$('.downpayment').show();
	               	$('.grandtotal').show();
	               	$('.vat').show();
	               	$('.shipping_fee').show();
	               }
	               let dis = parseFloat((response[0].discount*100)/1);
	               $('#subtotal').text(response[0].subtotal);
	               $('#shipping_fee').text(response[0].shipping_fee);
	               $('#discount').text(dis+'%');
	               $('#total').text(response[0].total);
	               $('#downpayment').text(response[0].downpayment);
	               $('#grandtotal').text(response[0].grandtotal);
	               $('#vat').text(response[0].vat);
	             	$('#tbl_admin_salesorder_so > tbody:last-child').empty();
	             	for(var i=0;i<response.length;i++){
	        			$('#tbl_admin_salesorder_so > tbody:last-child').append('<tr>'
					+'<td class="align-middle pl-0 border-0">'+response[i].title+'</td>'
					+'<td class="align-middle pl-0 border-0">'+response[i].color+'</td>'
					+'<td class="align-middle text-center text-success font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].qty+'</td>'
					+'<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].price+'</td>'
					+'<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0">'+response[i].type+'</td>'
					+'</tr>');
				}
				if(response[0].status == 'REQUEST'){
	  				$('#button_status').html('<button type="button" id="APPROVED" class="btn btn-success btn_approved">APPROVE</button>');
	  			}else if(response[0].status =='PENDING'){
	  				$('#button_status').html('<button type="button" class="btn btn-primary" id="save_delivery" data-action="READY">Ready For Delivery</button><a href="'+baseURL+'gh/sales/onlineorder-update/'+btoa(response[0].order_no)+'"  class="btn btn-success">Update</a>');
	  			}else{
	  				$('#button_status').remove();
	  			}
	  		}
	  		break;
	  	}
	  	case "View_OnlineOrder":{
	  			_initCurrency_format('#downpayment');
	  			_initCurrency_format('#shipping_fee');
	  		     $('#date_order').val(response[0].date_order);
	               $('#order_no').val(response[0].order_no);
	               $('#c_name').val(response[0].c_name);
	               $('#mobile').val(response[0].mobile);
	               $('#email').val(response[0].email);
	               $('#b_address').val(response[0].b_address);
	               $('#b_city').val(response[0].b_city+','+response[0].b_province);
	               $('#s_address').val(response[0].s_address);
	               $('#s_city').val(response[0].s_city+','+response[0].s_province);
	               $('#s_type').val(response[0].s_type);
	               $('#downpayment').val(response[0].downpayment);
	               $('#shipping_range').val(response[0].shipping_range);
	               $('#region').val(response[0].region);
	               $('#shipping_fee').val(response[0].shipping_fee);
	               $('#vat').val(response[0].vat).change();
	  		$('#tbl_onlineorder_view > tbody:last-child').empty();
	             for(var i=0;i<response.length;i++){
	        		$('#tbl_onlineorder_view > tbody:last-child').append('<tr id="row_'+response[i].item_id+'">'
					+'<td class="align-middle pl-0 border-0" id="item_id" data-id="'+response[i].item_id+'">'+response[i].title+'</td>'
					+'<td class="align-middle pl-0 border-0" id="c_price'+response[i].item_id+'" data-c_price="'+response[i].c_price+'">'+response[i].color+'</td>'
					+'<td class="align-middle text-center text-success font-weight-boldest font-size-h5 pr-0 border-0" id="qty'+response[i].item_id+'"></td>'
					+'<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0"  id="price'+response[i].item_id+'"></td>'
					+'<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0"><span id="type'+response[i].item_id+'"></span></td>'
					+'<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0" id="btn_action'+response[i].item_id+'"></td>'
					+'</tr>');
				if(response[i].type == 'Pre Order'){
	             		var html ='<div class="btn-group" role="group">'
						     +'<button id="btnGroupDrop1" type="button" class="btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
						     +'   Update'
						     +'   </button>'
						     +'   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
						     +'		<a class="dropdown-item" id="action"  data-id="'+response[i].item_id+'" data-action="REQUEST">Request</a>'
						     +'		<a class="dropdown-item" id="action"  data-id="'+response[i].item_id+'" data-action="In Stocks">In Stocks</a>'
						     +'		<a class="dropdown-item" id="action'+response[i].item_id+'"  data-qty="'+response[i].qty+'" data-price="'+response[i].price+'" data-id="'+response[i].item_id+'" data-action="EDIT">Edit</a>'
						     +'		<a class="dropdown-item" id="action"  data-id="'+response[i].item_id+'" data-action="CANCELLED">Cancel</a>'
						     +'   </div>'
						     +'</div>';
	             	}else if(response[i].type == 'In Stocks'){
	             		var html ='<div class="btn-group" role="group">'
						     +'<button id="btnGroupDrop1" type="button" class="btn btn-dark font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
						     +'   Update'
						     +'   </button>'
						     +'   <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">'
						     +'		<a class="dropdown-item" id="action'+response[i].item_id+'" data-qty="'+response[i].qty+'" data-price="'+response[i].price+'" data-id="'+response[i].item_id+'" data-action="EDIT" >Edit</a>'
						     +'		<a class="dropdown-item" id="action" data-id="'+response[i].item_id+'" data-action="CANCELLED">Cancel</a>'
						     +'   </div>'
						     +'</div>';
	             	}else if(response[i].type == 'REQUEST'){
	             		var html ='<button type="button" class="btn btn-dark font-weight-bold" disabled>Update</button>';
	             	}
	             	
	             	$('#btn_action'+response[i].item_id).empty();
	             	$('#btn_action'+response[i].item_id).append(html);
				$('#qty'+response[i].item_id).html(response[i].qty);
	             	$('#price'+response[i].item_id).html(response[i].price);
	             	$('#type'+response[i].item_id).text(response[i].type);
	             	$(document).on("input","input[name=qty"+response[i].item_id+"]",function() {
	             		let qty = $(this).val();
	             		let id = $(this).attr('data-id');
	             		let price = $('#c_price'+id).attr('data-c_price');
	             		let total = parseFloat(qty*price);
	             		 $("input[name=price"+id+"]").val(total.toLocaleString());
	             	});
	             	$(document).on("click","#action"+response[i].item_id,function() {
	             		var action = $(this).attr('data-action');
	             		var item_id = $(this).attr('data-id');
	             		var qty = $(this).attr('data-qty');
	             		var price = $(this).attr('data-price');
	             		if(action == 'EDIT'){
	             			$('#qty'+item_id).html('<div class="form-group" style="text-align: center; float:center"><input type="text" class="form-control" data-id="'+item_id+'" name="qty'+item_id+'" value="'+qty+'" style="width:100px;text-align:center;"/></div>');
	             			$('#price'+item_id).html('<div class="form-group" style="text-align: right; float:right"><input type="text" class="form-control" id="prices'+item_id+'" name="price'+item_id+'" value="'+price+'" style="width:150px;text-align:right;" readonly/></div>');
	             			var html ='<button type="button"  class="btn btn-success font-weight-bold" id="action" data-id="'+item_id+'" data-action="SAVED">SAVE</button>';
	             			$('#btn_action'+item_id).empty();
	             			$('#btn_action'+item_id).append(html);
	             			_initCurrency_format('#prices'+item_id);
	             		}
	             	});
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
	  			$('#date_created').val(response.date_created);
	  			$('#customer').val(response.customer);
	  			$('#mobile').val(response.mobile);
	  			$('#email').val(response.email);
	  			$('#so_no').val(response.so_no);
	  			$('#production_no').val(response.production_no);
	  			$('#concern').val(response.concern);
	  			$('#id').val(response.id);
	  			$('#date_created').val(response.date_created);
	  			$("#receipt").attr("href",baseURL + 'assets/images/receipt/'+response.receipt);
	  			$("#image").attr("href",baseURL + 'assets/images/service/'+response.image);
	  			$('#btn_action').empty();
	  			$('#btn_action1').empty();
	  			if(response.status == 'REQUEST'){
	  				$('#btn_action').append('<button type="button" class="btn btn-danger font-weight-bold" id="btn_save" data-page="sales" data-action="CANCELLED">CANCEL</button>'
                							+'<button type="button" class="btn btn-success font-weight-bold" id="btn_save" data-page="sales" data-action="APPROVED">APPROVED</button>');
	  			}
	  			if(response.s_status == 'PENDING'){
	  				$('#btn_action1').append('<button type="button" class="btn btn-success font-weight-bold" id="btn_save" data-page="superuser" data-action="S_APPROVED">APPROVED</button>');
	  			}
	  		}
	  		break;
	  	}
	  	case "Modal_Inquiry_View":{
	  		$('#date_created').val(response.date_created);
	  		$('#customer').val(response.name);
  			$('#email').val(response.email);
  			$('#subject').val(response.subject);
  			$('#comment').val(response.comment);
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
	  	case "Modal_Joborder_Project_Supervisor":{
	  		if(!response.row == false){
	  			$('#project_no').text(response.row.production_no).attr('data-order',response.row.production_no);
	  			$('#title').val(response.row.title);
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.row.docs);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  		}
	  		if(!response.material == false){
	  			_initNumberOnly('#text-qty');
	  			$('#tbl_material > tbody').empty();
	  			$('#tbl_material_used > tbody').empty();
	  			for(var i=0;i<response.material.length;i++){
	  				_initNumberOnly('#quantity'+response.material[i].id);
	  				$('#tbl_material > tbody').append('<tr id="row_'+response.material[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_material" data-action="material-remove" data-id="'+response.material[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.material[i].id+'"><a href="#" id="form-item" data-action="material" data-name="'+response.material[i].item+'" data-id="'+response.material[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.material[i].id+'">'+response.material[i].item+'</a></td>\
						<td>'+response.material[i].quantity+'</td>\
						<td class="text-center">'+response.material[i].balance+'</td>\
						<td>'+response.material[i].stocks+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_request" data-action="material-request" data-id="'+response.material[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');

	  				let id = response.material[i].id;
					$('#tbl_material_used > tbody').append('<tr id="row_'+id+'">\
						<td data-id="'+response.material[i].id+'">'+response.material[i].item+'</td>\
						<td>'+response.material[i].p_qty+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity_used'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_used" data-action="material-used" data-m="plus" data-id="'+response.material[i].id+'"><i class="flaticon2-plus"></i></button>\
						<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_material_used" data-action="material-used" data-m="minus" data-id="'+response.material[i].id+'"><i class="flaticon2-line"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		if(!response.purchase == false){
	  			$('#tbl_puchased > tbody').empty();
	  			for(var i=0;i<response.purchase.length;i++){
	  				$('#tbl_puchased > tbody').append('<tr id="row_'+response.purchase[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_purchased" data-action="purchased-remove" data-id="'+response.purchase[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.purchase[i].id+'"><a href="#" id="form-item" data-action="purchased" data-name="'+response.purchase[i].item+'" data-id="'+response.purchase[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.purchase[i].id+'">'+response.purchase[i].item+'</a></td>\
						<td>'+response.purchase[i].quantity+'</td>\
						<td>'+response.purchase[i].unit+'</td>\
						<td>'+response.purchase[i].remarks+'</td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_purchased_request" data-action="purchased-request" data-id="'+response.purchase[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		$(document).on("click","#form-item",function() {
				 	let id = $(this).attr('data-id');
				 	let name = $(this).attr('data-name');
				 	let action = $(this).attr('data-action');
				 	$('#text-name').text(name);
				 	$('#text-name').attr('data-id',id);
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material'){
				 		let qty  = $('#tbl_material #row_'+id).find("td").eq(2).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div></div>');
				 	}else{
				 		let qty  = $('#tbl_puchased #row_'+id).find("td").eq(2).html();
				 		let unit  = $('#tbl_puchased #row_'+id).find("td").eq(3).html();
				 		let remarks  = $('#tbl_puchased #row_'+id).find("td").eq(4).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">UNIT</label><input type="text" class="form-control" name="unit" value="'+unit+'" autocomplete="off"/></div></div></div><div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">Remark</label><textarea class="form-control" name="remarks" rows="4" autocomplete="off">'+remarks+'</textarea></div></div></div>');
				 	}
				 
			});
			$(document).on("click","#form-add",function() {
				 	let action = $(this).attr('data-action');
				 	_ajaxloaderOption('option_controller/Item_option',"POST",false,'material_item_no');
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material-create'){
				 	$('#text-name').text('Add New Material');
				 	for(var i=0;i<response.material.length;i++){
				 		$('select[name=item] > option[value='+response.material[i].item_no+']').remove();
				 	}
				 	$('.data-append').empty().append('<div class="row">\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<select class="form-control" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
						 			<option value="" selected="" disabled="">SELECT TYPE</option>\
									<option value="1">FRAMING - MATERIALS</option>\
									<option value="2">MECHANISM</option>\
									<option value="3">FINISHING - MATERIALS</option>\
									<option value="4">SULIHIYA</option>\
									<option value="5">UPHOLSTERY</option>\
									<option value="6">OTHERS</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }else{
				 	$(document).on('change','select[name=type]',function(e){
				 		if($(this).val() == 'common'){
				 		   $("input[name=item_special]").css('display','none');
				 		   $(".displayitem").removeAttr('style');
				 		}else{
				 		  $("input[name=item_special]").removeAttr('style');
				 		  $(".displayitem").css('display','none');
				 		}
				 	});
				 	$('.data-append').empty().append('<div class="row">\
				 		<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
									<option value="common" selected="">COMMON</option>\
									<option value="special">SPECIAL</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<input type="text" class="form-control" name="item_special" style="display:none">\
						 		<select class="form-control displayitem" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">REMARKS</label>\
						 		<textarea name="remarks" class="form-control" rows="4"/>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }
			});
	  		break;
	  	}
	  	case "Modal_Joborder_Stocks_Supervisor":{
	  		if(!response.row == false){
	  			$('#project_no').text(response.row.production_no).attr('data-order',response.row.production_no);
	  			$('#title').val(response.row.title);
	  			$('#c_code').text(response.row.c_code);
	  			$('#c_name').val(response.row.c_name);
	  			$('#unit').val(response.row.unit);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.row.docs);
	  			$(".image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
	  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  		}
	  		if(!response.material == false){
	  			_initNumberOnly('#text-qty');
	  			$('#tbl_material > tbody').empty();
	  			$('#tbl_material_used > tbody').empty();
	  			for(var i=0;i<response.material.length;i++){
	  				_initNumberOnly('#quantity'+response.material[i].id);
	  				$('#tbl_material > tbody').append('<tr id="row_'+response.material[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_material" data-action="material-remove" data-id="'+response.material[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.material[i].id+'"><a href="#" id="form-item" data-action="material" data-name="'+response.material[i].item+'" data-id="'+response.material[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.material[i].id+'">'+response.material[i].item+'</a></td>\
						<td>'+response.material[i].quantity+'</td>\
						<td class="text-center">'+response.material[i].balance+'</td>\
						<td>'+response.material[i].stocks+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_request" data-action="material-request" data-id="'+response.material[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');

	  				let id = response.material[i].id;
					$('#tbl_material_used > tbody').append('<tr id="row_'+id+'">\
						<td data-id="'+response.material[i].id+'">'+response.material[i].item+'</td>\
						<td>'+response.material[i].p_qty+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity_used'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_used" data-action="material-used" data-m="plus" data-id="'+response.material[i].id+'"><i class="flaticon2-plus"></i></button>\
						<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_material_used" data-action="material-used" data-m="minus" data-id="'+response.material[i].id+'"><i class="flaticon2-line"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		if(!response.purchase == false){
	  			$('#tbl_puchased > tbody').empty();
	  			for(var i=0;i<response.purchase.length;i++){
	  				$('#tbl_puchased > tbody').append('<tr id="row_'+response.purchase[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_purchased" data-action="purchased-remove" data-id="'+response.purchase[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.purchase[i].id+'"><a href="#" id="form-item" data-action="purchased" data-name="'+response.purchase[i].item+'" data-id="'+response.purchase[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.purchase[i].id+'">'+response.purchase[i].item+'</a></td>\
						<td>'+response.purchase[i].quantity+'</td>\
						<td>'+response.purchase[i].unit+'</td>\
						<td>'+response.purchase[i].remarks+'</td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_purchased_request" data-action="purchased-request" data-id="'+response.purchase[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		$(document).on("click","#form-item",function() {
				 	let id = $(this).attr('data-id');
				 	let name = $(this).attr('data-name');
				 	let action = $(this).attr('data-action');
				 	$('#text-name').text(name);
				 	$('#text-name').attr('data-id',id);
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material'){
				 		let qty  = $('#tbl_material #row_'+id).find("td").eq(2).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div></div>');
				 	}else{
				 		let qty  = $('#tbl_puchased #row_'+id).find("td").eq(2).html();
				 		let unit  = $('#tbl_puchased #row_'+id).find("td").eq(3).html();
				 		let remarks  = $('#tbl_puchased #row_'+id).find("td").eq(4).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">UNIT</label><input type="text" class="form-control" name="unit" value="'+unit+'" autocomplete="off"/></div></div></div><div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">Remark</label><textarea class="form-control" name="remarks" rows="4" autocomplete="off">'+remarks+'</textarea></div></div></div>');
				 	}
				 
			});
			$(document).on("click","#form-add",function() {
				 	let action = $(this).attr('data-action');
				 	_ajaxloaderOption('option_controller/Item_option',"POST",false,'material_item_no');
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material-create'){
				 	$('#text-name').text('Add New Material');
				 	for(var i=0;i<response.material.length;i++){
				 		$('select[name=item] > option[value='+response.material[i].item_no+']').remove();
				 	}
				 	$('.data-append').empty().append('<div class="row">\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<select class="form-control" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
						 			<option value="" selected="" disabled="">SELECT TYPE</option>\
									<option value="1">FRAMING - MATERIALS</option>\
									<option value="2">MECHANISM</option>\
									<option value="3">FINISHING - MATERIALS</option>\
									<option value="4">SULIHIYA</option>\
									<option value="5">UPHOLSTERY</option>\
									<option value="6">OTHERS</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }else{
				 	$(document).on('change','select[name=type]',function(e){
				 		if($(this).val() == 1){
				 		   $("input[name=item_special]").css('display','none');
				 		   $(".displayitem").removeAttr('style');
				 		}else{
				 		  $("input[name=item_special]").removeAttr('style');
				 		  $(".displayitem").css('display','none');
				 		}
				 	});
				 	$('.data-append').empty().append('<div class="row">\
				 		<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
									<option value="1" selected="">COMMON</option>\
									<option value="2">SPECIAL</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<input type="text" class="form-control" name="item_special" style="display:none">\
						 		<select class="form-control displayitem" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">REMARKS</label>\
						 		<textarea name="remarks" class="form-control" rows="4"/>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }
			});
	  		break;
	  	}
	  	case "Modal_Joborder_Supervisor":{
	  		if(!response.row == false){
	  			$('#project_no').text(response.row.project_no).attr('data-order',response.row.production_no);
	  			$('#title').val(response.row.title);
	  			$('#c_code').text(response.row.c_code);
	  			$('#c_name').val(response.row.c_name);
	  			$('#unit').val(response.row.unit);
	  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.row.c_code));
	  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
	  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.row.docs);
	  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
	  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
	  			$("#c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
	  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
	  		}
	  		if(!response.material == false){
	  			_initNumberOnly('#text-qty');
	  			$('#tbl_material > tbody').empty();
	  			$('#tbl_material_used > tbody').empty();
	  			for(var i=0;i<response.material.length;i++){
	  				_initNumberOnly('#quantity'+response.material[i].id);
	  				$('#tbl_material > tbody').append('<tr id="row_'+response.material[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_material" data-action="material-remove" data-id="'+response.material[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.material[i].id+'"><a href="#" id="form-item" data-action="material" data-name="'+response.material[i].item+'" data-id="'+response.material[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.material[i].id+'">'+response.material[i].item+'</a></td>\
						<td>'+response.material[i].quantity+'</td>\
						<td class="text-center">'+response.material[i].balance+'</td>\
						<td>'+response.material[i].stocks+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_request" data-action="material-request" data-id="'+response.material[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');

	  				let id = response.material[i].id;
					$('#tbl_material_used > tbody').append('<tr id="row_'+id+'">\
						<td data-id="'+response.material[i].id+'">'+response.material[i].item+'</td>\
						<td>'+response.material[i].p_qty+'</td>\
						<td><input type="text" class="form-control form-control-sm text-center" id="quantity_used'+response.material[i].id+'" placeholder="Enter Quantity" autocomplete="off"/></td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_material_used" data-action="material-used" data-m="plus" data-id="'+response.material[i].id+'"><i class="flaticon2-plus"></i></button>\
						<button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_material_used" data-action="material-used" data-m="minus" data-id="'+response.material[i].id+'"><i class="flaticon2-line"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		if(!response.purchase == false){
	  			$('#tbl_puchased > tbody').empty();
	  			for(var i=0;i<response.purchase.length;i++){
	  				$('#tbl_puchased > tbody').append('<tr id="row_'+response.purchase[i].id+'">\
	  					<td><button  class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-danger" id="btn_remove_purchased" data-action="purchased-remove" data-id="'+response.purchase[i].id+'"><i class="flaticon-delete-1"></i></button></td>\
						<td data-id="'+response.purchase[i].id+'"><a href="#" id="form-item" data-action="purchased" data-name="'+response.purchase[i].item+'" data-id="'+response.purchase[i].id+'" data-toggle="modal" data-target="#exampleModal" data-id="'+response.purchase[i].id+'">'+response.purchase[i].item+'</a></td>\
						<td>'+response.purchase[i].quantity+'</td>\
						<td>'+response.purchase[i].unit+'</td>\
						<td>'+response.purchase[i].remarks+'</td>\
						<td><button type="button" class="btn btn-sm btn-shadow btn-icon btn-bg-light btn-icon-success btn-hover-success" id="btn_purchased_request" data-action="purchased-request" data-id="'+response.purchase[i].id+'"><i class="flaticon2-fast-next"></i></button></td>\
					</tr>');
	  			}
	  		}
	  		$(document).on("click","#form-item",function() {
				 	let id = $(this).attr('data-id');
				 	let name = $(this).attr('data-name');
				 	let action = $(this).attr('data-action');
				 	$('#text-name').text(name);
				 	$('#text-name').attr('data-id',id);
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material'){
				 		let qty  = $('#tbl_material #row_'+id).find("td").eq(2).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div></div>');
				 	}else{
				 		let qty  = $('#tbl_puchased #row_'+id).find("td").eq(2).html();
				 		let unit  = $('#tbl_puchased #row_'+id).find("td").eq(3).html();
				 		let remarks  = $('#tbl_puchased #row_'+id).find("td").eq(4).html();
				 		$('.data-append').empty().append('<div class="row"><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">QTY</label><input type="text" class="form-control" id="text-qty" value="'+qty+'" autocomplete="off"/></div></div><div class="col-lg-6 col-xl-6"><div class="form-group"><label class="text-white item-p">UNIT</label><input type="text" class="form-control" name="unit" value="'+unit+'" autocomplete="off"/></div></div></div><div class="row"><div class="col-lg-12 col-xl-12"><div class="form-group"><label class="text-white item-p">Remark</label><textarea class="form-control" name="remarks" rows="4" autocomplete="off">'+remarks+'</textarea></div></div></div>');
				 	}
				 
			});
			$(document).on("click","#form-add",function() {
				 	let action = $(this).attr('data-action');
				 	_ajaxloaderOption('option_controller/Item_option',"POST",false,'material_item_no');
				 	$('#text-name').attr('data-action',action);
				 	if(action == 'material-create'){
				 	$('#text-name').text('Add New Material');
				 	for(var i=0;i<response.material.length;i++){
				 		$('select[name=item] > option[value='+response.material[i].item_no+']').remove();
				 	}
				 	$('.data-append').empty().append('<div class="row">\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<select class="form-control" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
						 			<option value="" selected="" disabled="">SELECT TYPE</option>\
									<option value="1">FRAMING - MATERIALS</option>\
									<option value="2">MECHANISM</option>\
									<option value="3">FINISHING - MATERIALS</option>\
									<option value="4">SULIHIYA</option>\
									<option value="5">UPHOLSTERY</option>\
									<option value="6">OTHERS</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }else{
				 	$(document).on('change','select[name=type]',function(e){
				 		if($(this).val() == 1){
				 		   $("input[name=item_special]").css('display','none');
				 		   $(".displayitem").removeAttr('style');
				 		}else{
				 		  $("input[name=item_special]").removeAttr('style');
				 		  $(".displayitem").css('display','none');
				 		}
				 	});
				 	$('.data-append').empty().append('<div class="row">\
				 		<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">TYPE</label>\
						 		<select class="form-control" name="type">\
									<option value="1" selected="">COMMON</option>\
									<option value="2">SPECIAL</option>\
						 		</select>\
				 			 </div>\
					 	</div>\
				 		 <div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">ITEM</label>\
						 		<input type="text" class="form-control" name="item_special" style="display:none">\
						 		<select class="form-control displayitem" name="item" id="item"></select>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">QTY</label>\
						 		<input type="text" class="form-control" id="text-qty" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-6 col-xl-6">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">UNIT</label>\
						 		<input type="text" class="form-control" name="unit" autocomplete="off"/>\
				 			 </div>\
					 	</div>\
					 	<div class="col-lg-12 col-xl-12">\
				 			<div class="form-group">\
						 		<label class="text-white item-p">REMARKS</label>\
						 		<textarea name="remarks" class="form-control" rows="4"/>\
				 			 </div>\
					 	</div>\
					 </div>');
				 }
				 	
			});
	  		break;
	  	}
	  	 case "Modal_Material_Request_Supervisor":{
	  	 	$('#text-table').text('Material Request');
	  	 	let html="";
	  	 	html +='<table class="table table-hover table-dark table-sm table-material">\
						<thead>\
							<th>No.</th>\
							<th>ITEM</th>\
							<th>QTY</th>\
							<th>DATE RECEIVED</th>\
						</thead>	\
					<tbody>';
	  	 	for(var i=0;i<response.material.length;i++){
				html+='<tr>\
						  <td>'+response.material[i].no+'</td>\
						  <td>'+response.material[i].item+'</td>\
						  <td>'+response.material[i].quantity+'</td>\
						  <td>'+response.material[i].date_release+'</td>\
					</tr>';
					
	  			}
	  			html+='</tbody>\
				</table>';
	  			$('.data-table').empty().append(html);
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
	  	 case "Modal_Material_Used_Supervisor":{
	  	 	$('#text-table').text('Material Used');
  				let html="";
	  	 		html +='<table class="table table-hover table-dark table-sm table-purchased">\
					<thead>\
						<th>No.</th>\
						<th>ITEM</th>\
						<th>QTY</th>\
						<th>DATE CREATED</th>\
					</thead>	\
					<tbody>';
	  	 	for(var i=0;i<response.used.length;i++){
				html+='<tr>\
					  <td>'+response.used[i].no+'</td>\
					  <td>'+response.used[i].item+'</td>\
					  <td>'+response.used[i].quantity+'</td>\
					  <td>'+response.used[i].date_created+'</td>\
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


	  		case "Account_Report_Income_Daily":{
				$('#tbl_income_daily').empty().append(response.html);
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.week1_type2.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week1_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
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
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.week1_type1.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week1_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
		  		    	   html +='<tr class="bg-warning text-white">\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week2_type2.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week2_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
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
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week2_type1.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week2_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week3_type2.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week3_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week3_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week3_type1){
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week3_type1.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week3_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';	
	  		    	  for (var i =0;i<response.week4_type2.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week4_type2[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	    html +='<tr class="bg-success text-white">\
	  		    	   			<td></td>\
	  		    	   			<td>TOTAL</td>\
	  		    	   			<td>'+response.week4_add+'</td>\
	  		    	   			<td></td>\
	  		    	   		</tr>';
	  		    }
	  		 
	  		    if(response.week4_type1){
	  		    	   html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			   </tr>';
	  		    	  for (var i =0;i<response.week4_type1.length;i++){
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
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.week4_type1[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
			  		    		</tr>';
	  		    	   }
	  		    	   html +='<tr class="bg-warning text-white">\
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
		  			  html +='<tr class="bg-success text-white">\
				  			  	<td>Date</td>\
				  			  	<td>Add: Collection</td>\
				  			  	<td>Amount</td>\
				  			  	<td></td>\
			  			     </tr>';	
	  		    	  for (var i =0;i<response.jan_add.length;i++){
	  		    		html +='<tr data-id="'+response.jan_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.jan_add[i].date+'"><div id="input-dateposition">'+response.jan_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.jan_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.jan_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.jan_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    			<td colspan="4></td>\
	  		    		 </tr>'; 
	  		    if(response.jan_less){
	  		    	  html +='<tr class="bg-warning text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Less: Disbursement</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
			  			  </tr>';
	  		    	  for (var i =0;i<response.jan_less.length;i++){
	  		    		html +='<tr data-id="'+response.jan_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.jan_less[i].date+'"><div id="input-dateposition">'+response.jan_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.jan_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.jan_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.jan_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
		  			  html +='<tr class="bg-success text-white">\
				  			  	<td>Date</td>\
				  			  	<td>Add: Collection</td>\
				  			  	<td>Amount</td>\
				  			  	<td></td>\
			  			     </tr>';	
	  		    	  for (var i =0;i<response.feb_add.length;i++){
	  		    		html +='<tr data-id="'+response.feb_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.feb_add[i].date+'"><div id="input-dateposition">'+response.feb_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.feb_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.feb_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.feb_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.feb_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.feb_less[i].date+'"><div id="input-dateposition">'+response.feb_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.feb_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.feb_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.feb_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.march_add.length;i++){
	  		    		html +='<tr data-id="'+response.march_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.march_add[i].date+'"><div id="input-dateposition">'+response.march_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.march_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.march_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.march_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.march_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.march_less[i].date+'"><div id="input-dateposition">'+response.march_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.march_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.march_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.march_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.april_add.length;i++){
	  		    		html +='<tr data-id="'+response.april_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.april_add[i].date+'"><div id="input-dateposition">'+response.april_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.april_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.april_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.april_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.april_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.april_less[i].date+'"><div id="input-dateposition">'+response.april_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.april_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.april_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.april_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.may_add.length;i++){
	  		    		html +='<tr data-id="'+response.may_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.may_add[i].date+'"><div id="input-dateposition">'+response.may_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.may_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.may_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.may_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.may_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.may_less[i].date+'"><div id="input-dateposition">'+response.may_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.may_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.may_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.may_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.june_add.length;i++){
	  		    		html +='<tr data-id="'+response.june_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.june_add[i].date+'"><div id="input-dateposition">'+response.june_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.june_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.june_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.june_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.june_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.june_less[i].date+'"><div id="input-dateposition">'+response.june_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.june_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.june_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.june_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.july_add.length;i++){
	  		    		html +='<tr data-id="'+response.july_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.july_add[i].date+'"><div id="input-dateposition">'+response.july_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.july_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.july_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.july_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.july_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.july_less[i].date+'"><div id="input-dateposition">'+response.july_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.july_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.july_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.july_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.august_add.length;i++){
	  		    		html +='<tr data-id="'+response.august_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.august_add[i].date+'"><div id="input-dateposition">'+response.august_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.august_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.august_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.august_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.august_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.august_less[i].date+'"><div id="input-dateposition">'+response.august_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.august_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.august_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.august_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.sept_add.length;i++){
	  		    		html +='<tr data-id="'+response.sept_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.sept_add[i].date+'"><div id="input-dateposition">'+response.sept_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.sept_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.sept_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.sept_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  		    		html +='<tr data-id="'+response.sept_less[i].id+'">\
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.sept_less[i].date+'"><div id="input-dateposition">'+response.sept_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.sept_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.sept_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.sept_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.oct_add.length;i++){
	  		    		html +='<tr data-id="'+response.oct_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.oct_add[i].date+'"><div id="input-dateposition">'+response.oct_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.oct_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.oct_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.oct_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.oct_less[i].date+'"><div id="input-dateposition">'+response.oct_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.oct_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.oct_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.oct_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.nov_add.length;i++){
	  		    		html +='<tr data-id="'+response.nov_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.nov_add[i].date+'"><div id="input-dateposition">'+response.nov_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.nov_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.nov_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.nov_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.nov_less[i].date+'"><div id="input-dateposition">'+response.nov_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.nov_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.nov_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.nov_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  			  html +='<tr class="bg-success text-white">\
			  			  	<td>Date</td>\
			  			  	<td>Add: Collection</td>\
			  			  	<td>Amount</td>\
			  			  	<td></td>\
		  			     </tr>';	
	  		    	  for (var i =0;i<response.dec_add.length;i++){
	  		    		html +='<tr data-id="'+response.dec_add[i].id+'">\
	  		    				   <td id="td-input" data-action="date_position" data-date="'+response.dec_add[i].date+'"><div id="input-dateposition">'+response.dec_add[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.dec_add[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.dec_add[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.dec_add[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
			  		    		  <td id="td-input" data-action="date_position" data-date="'+response.dec_less[i].date+'"><div id="input-dateposition">'+response.dec_less[i].date_position+'</div>\
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
			  		    		   <td id="td-input" data-action="name">'+response.dec_less[i].name+'</td>\
			  		    		   <td id="td-input" data-action="amount">'+response.dec_less[i].amount+'</td>\
			  		    		   <td><button class="btn btn-icon btn-danger btn-xs delete" data-id="'+response.dec_less[i].id+'" style="display:none"><i class="flaticon2-cross"></i></button></td>\
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
	  }
	}
	return {

		//main function to initiate the module
		init: function() {
			var viewForm = $('#kt_content').attr('data-table');
			_ViewController(viewForm);
			_initView();
			_initImageView();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClient.init();
});
		