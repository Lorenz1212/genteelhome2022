'use strict';
var KTAjaxClientweb = function() {
let view;	 
	var _check_url =  async function (url){
	 	if(url.split('/')[0] == 'genteelhome2022'){
	 		view =  url.split('/')[3];
	 	}else if(url.split('/')[1] == 'genteelhome2022'){
	 		view =  url.split('/')[4];
	 	}else if(url.split('/')[2] == 'genteelhome2022'){
	 		view =  url.split('/')[5];
	 	}else if(url.split('/')[3] == 'genteelhome2022'){
	 		view =  url.split('/')[6];
	 	}else if(url.split('/')[4] == 'genteelhome2022'){
	 		view = url.split('/')[7];
	 	}else if(url.split('/')[5] == 'genteelhome2022'){
	 		view =  url.split('/')[8];
	 	}
	 	_ViewController(view);
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
		_month_year();
		switch(view){
			case "product":{
				_initCurrency_format('.amount');
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_list']));
				$('body').delegate('.view-product','click',function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					let element = $(this);
					 _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_details',element.attr('data-id')]));
				});
				$('#modal-form').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_list']));
				});
				$('#modal-form-add').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_list']));
				});
				$('#modal-form-pallet').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['product','fetch_product_list']));
				});
				break;
			}
			case "voucher":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['voucher','fetch_voucher_list']));
				 $('#add-voucher').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['voucher','fetch_voucher_list']));
				});
				break;
			}
			case "shipping-fee":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['shipping','fetch_shipping_list']));
				 $('#requestModal').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['shipping','fetch_shipping_list']));
				});
				break;
			}
			case "testimony":{
				_ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_list']));
				$('#staticBackdrop').on('hidden.bs.modal', function (e) {
					e.preventDefault();
				    _ajaxrequest(_constructBlockUi('blockPage', false, 'Loading...'),_constructForm(['testimony','fetch_testimony_list']))
				});
				break;
			}
		}
	}
	

	var _construct = async function(response, type, element, object){
		switch(type){
			case "fetch_product_list":{
			  KTDatatablesDataSourceAjaxClient.init('tbl_products',response);
			  break;
			}
			case "fetch_product_details":{
				if(response != false){
					_ajaxloaderOption('option_controller/SubCategory_Edit_option','POST',{id:response.row.sub_id},'sub-category-update');
		  			$('#cat-id-edit').on('change',function(e){
						e.preventDefault();
						let id = $(this).val();
						_ajaxloaderOption('option_controller/SubCategory_Update_option','POST',{id:id},'sub-category-update');
					});
					$('#project_no').attr('data-id',response.row.project_no);
		  			$('#title').val(response.row.title);
		  			$('#c_code').attr('data-id',response.row.id);
		  			$('#c_name').val(response.row.c_name);
		  			$('#unit').val(response.row.unit);
		  			$('#c_price').val(_formatnumbercommat(response.row.c_price));
		  			$('select[name=cat_id_update]').val(response.row.cat_id);
		  			$('#displayed_status').val(response.row.display_status).change();
		  			$("#projectno_href").attr("href",baseURL + 'gh/designer/project_update/'+btoa(response.row.c_code));
		  			$("#image_href").attr("href",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
		  			$("#docs_href").attr("href",baseURL + 'assets/images/design/project_request/docx/'+response.row.docs);
		  			$("#cimage_href").attr("href",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
		  			$("#image").attr("src",baseURL + 'assets/images/design/project_request/images/'+response.row.image);
		  			$(".c_image").attr("src",baseURL + 'assets/images/palettecolor/'+response.row.c_image);
		  			$("#docs").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
		  			$("#tearsheet_href").attr("href",baseURL + 'assets/images/tearsheet/'+response.row.tearsheet);
		  			$("#tearsheet").attr("src",baseURL + 'assets/images/design/project_request/docx/default.jpg');
		  			$("#c_previous").val(response.row.c_image);
		  			$("#divimages").empty();
		  			for(let i=0;i<response.data.length;i++){
		  				$("#divimages").append('<div class="col-lg-2 col-xl-2 mb-5" id="row_'+response.data[i].id+'">\
		  									  <div class="row">\
		  									  	<div class="col-lg-12 col-xl-12">\
			  										<div class="symbol symbol-50 symbol-lg-150">\
														<img alt="Pic" id="myImg" src="'+baseURL+'assets/images/finishproduct/product/'+response.data[i].images+'" class="">\
													</div>\
												</div>\
													<div class="col-lg-12 col-xl-12">\
													   <button class="btn btn-danger btn-sm btn-block" id="delete" data-id="'+response.data[i].id+'">Remove</button>\
													</div>\
												</div>\
		  									</div>');

		  			}
		  			$('#modal-form').modal('show');
		  		}
				break;
			}
			case "fetch_voucher_list":{
			  KTDatatablesDataSourceAjaxClient.init('tbl_voucher',response);
			  break;
			}
			case "fetch_shipping_list":{
			   KTDatatablesDataSourceAjaxClient.init('tbl_shipping',response);
			   break;
			}
			case "fetch_testimony_list":{
			   KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response);
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
              url: baseURL+'Webmodifier_Controller/Controller',
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
			_check_url(window.location.pathname);
			_initImageView();
			sessionStorage.clear();
		},

	};

}();

jQuery(document).ready(function() {
	KTAjaxClientweb.init();
});
		