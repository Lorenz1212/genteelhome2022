"use strict";

// Class definition
var KTWizard2 = function () {
	var validation;var form;var url;var thisURL;var val;
	var idArr = [];var idArrs = [];var idItemArr = [];var keys = [];var myData = {};
	var keyss = [];var myDatas = {};
	var id;var production_no;var status;var item;var quantity;var remarks;var status;
	var supplier;var payment;var received;var balance;var amount;var warehouse_status;
	var price;
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizardObj;
	var _validations = [];
	var _initSwalWarning = function(url){
	     Swal.fire("Warning!", "Material Request is empty!", "warning");
	}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       window.location = url;
		});
	}
	 var _ajaxForm_loaded = async function(thisURL,type,val,url){
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
             	if(response.status == 'success'){
             		Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       			window.location = url;
				 	});
             	}
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
	var _ajaxOption = async function(thisURL,type,val,sub){
		$.ajax({
              url: baseURL + thisURL,
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
             	  _initOption(sub,response);
             }                                   
		});
	}
	var _initremovetable = function(action){
		$(""+action+"").on("click", "#DeleteButton", function() {
			   $(this).closest("tr").remove();
		});
	}
	var _initOption = function(view,response){
		switch(view){
			case "material_item":{
				for(let i=0;i<response.length;i++){
                  	  	  $('#item').append('<option value="'+response[i].id+'">('+response[i].qty+') '+response[i].name+'</option>');
                  	  	  $('#item').addClass('selectpicker');
					  $('#item').attr('data-live-search', 'true');
					  $('#item').selectpicker('refresh');
                  	  }
				break;
			}
			case "purchase_item":{
				for(let i=0;i<response.length;i++){
	     //    	  	  $('select[name=purchase_item]').append('<option value="'+response[i].id+'">('+response[i].qty+') '+response[i].name+'</option>');
	     //    	  	  $('select[name=purchase_item]').addClass('selectpicker');
				  // $('select[name=purchase_item]').attr('data-live-search', 'true');
				  // $('select[name=purchase_item]').selectpicker('refresh');
				}
				break;
			}
			case"material_request":{
				$('#myTable > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">\
				<td class="align-middle pl-0 border-0 type item_no item_name" data-name="'+response.data.item+'" data-type="'+response.type+'" data-id="'+response.data.item_no+'">'+response.data.item+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0 unit quantity" data-qty="'+response.qty+'" data-unit="'+response.unit+'">'+response.qty+' '+response.unit+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest pr-0 border-0 remarks" data-remarks="'+response.remarks+'">'+response.remarks+'</td>\
				<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"><i class="icon-xl la la-times"></i></button></td>\
				</tr>');
				_initremovetable('#myTable');				
				break;
			}
			case"purchase_material":{
				if(response.type == 'common'){var name = response.data.item;}else{var name = response.name;}
				$('#myTable1 > tbody:last-child').append('<tr class="font-size-lg font-weight-bolder h-65px">\
				<td class="align-middle pl-0 border-0 p_type p_itemno" data-type="'+response.type+'" data-id="'+name+'">'+name+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest font-size-h5 pr-0 border-0 p_unit p_quantity" data-qty="'+response.qty+'" data-unit="'+response.unit+'">'+response.qty+' '+response.unit+'</td>\
				<td class="align-middle text-right text-success font-weight-boldest pr-0 border-0 p_remarks" data-remarks="'+response.remarks+'">'+response.remarks+'</td>\
				<td class="align-middle text-right text-danger font-weight-boldest font-size-h5 pr-0 border-0"><button type="button" id="DeleteButton" class="btn btn-icon btn-danger btn-circle btn-sm mr-2"><i class="icon-xl la la-times"></i></button></td>\
				</tr>');
				_initremovetable('#myTable1');		
			   break;
			}
		}
	}
	// Private functions
	var _initValidation = function () {
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					title: {
						validators: {
							notEmpty: {
								message: 'Item is required'
							}
						}
					},
					labor_cost: {
						validators: {
							notEmpty: {
								message: 'Item is required'
							}
						}
					},
					unit: {
						validators: {
							notEmpty: {
								message: 'Quantity is required'
							}
						}
					}
				
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					package: {
						validators: {
							notEmpty: {
								message: 'Package details is required'
							}
						}
					},
					packagelength: {
						validators: {
							notEmpty: {
								message: 'Package length is required'
							},
							digits: {
								message: 'The value added is not valid'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					delivery: {
						validators: {
							notEmpty: {
								message: 'Delivery type is required'
							}
						}
					},
					packaging: {
						validators: {
							notEmpty: {
								message: 'Packaging type is required'
							}
						}
					},
					preferreddelivery: {
						validators: {
							notEmpty: {
								message: 'Preferred delivery window is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));

		// Step 4
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					locaddress1: {
						validators: {
							notEmpty: {
								message: 'Address is required'
							}
						}
					},
					locpostcode: {
						validators: {
							notEmpty: {
								message: 'Postcode is required'
							}
						}
					},
					loccity: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					locstate: {
						validators: {
							notEmpty: {
								message: 'State is required'
							}
						}
					},
					loccountry: {
						validators: {
							notEmpty: {
								message: 'Country is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap({
						//eleInvalidClass: '',
						eleValidClass: '',
					})
				}
			}
		));
	}

	var _initWizard = function () {
		// Initialize form wizard
		_wizardObj = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false  // allow step clicking
		});

		// Validation before going to next page
		_wizardObj.on('change', function (wizard) {
			if (wizard.getStep() > wizard.getNewStep()) {
				return; // Skip if stepped back
			}
			// Validate form before change wizard step
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						if(wizard.getStep()==1){
							// _ajaxOption('option_controller/Item_option',"POST",false,'material_item');
							$('#add_request').on('click',function(){
								  let id       = $('select[name=material_item]').val();
								  let qty      = $('input[name=material_qty]').val();
								  let remarks 	= $('#material_remarks').val();
								  let unit 	= $('#material_unit').val();
								  let type      = $('select[name=type]').val();
								  if(!id || !qty  || !unit || !type){
								  	Swal.fire("Warning!", "Please Complete the form!", "warning");
								  }else{
								  	 let val = {id:id,qty:qty,remarks:remarks,unit:unit,type:type};
								 	_ajaxOption('option_controller/Material_option',"POST",val,'material_request');
								  }
							  });
							wizard.goTo(wizard.getNewStep());
						}else if(wizard.getStep()==2){
							// _ajaxOption('option_controller/Item_option',"POST",false,'purchase_item');
							$('#add_purchase').on('click',function(){
								   	let type = $('select[name=special_option]').val();
								     let qty  = $('input[name=purchase_quantity]').val();
									let remarks 	= $('#purchase_remarks').val();
									let unit 	= $('#purchase_unit').val();
									let name = $('#special_item').val();
									let id = $('select[name=purchase_item]').val();
								  if(!qty || !unit || !type){
								  	Swal.fire("Warning!", "Please Complete the form!", "warning");
								  }else{
								  	 let val = {id:id,name:name,qty:qty,remarks:remarks,unit:unit,type:type};
								 	_ajaxOption('option_controller/Purchase_option',"POST",val,'purchase_material');
								  }
							  });
							 var rowCount = $('#myTable tbody tr').length;
							 if (!rowCount) {
								_initSwalWarning();
							 }else{
							 	wizard.goTo(wizard.getNewStep());
							 }
						}else if(wizard.getStep()==3){
							wizard.goTo(wizard.getNewStep());
						}
					
						KTUtil.scrollTop();
					} else {
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light"
							}
						}).then(function () {
							KTUtil.scrollTop();
						});
					}
				});
			}

			return false;  // Do not change wizard step, further action will be handled by he validator
		});

		// Change event
		_wizardObj.on('changed', function (wizard) {
			KTUtil.scrollTop();
		});

		//Submit event
		_wizardObj.on('submit', function (wizard) {
			 var rowCount = $('#myTable tbody tr').length;
			if (!rowCount) {
				_initSwalWarning();
			}else{
				
			    let mat_type = Array.from(document.getElementsByClassName('type')).map(item => item.getAttribute('data-type'));
			    let mat_name = Array.from(document.getElementsByClassName('item_name')).map(item => item.getAttribute('data-name'));
			    let mat_unit = Array.from(document.getElementsByClassName('unit')).map(item => item.getAttribute('data-unit'));
			    let mat_itemno = Array.from(document.getElementsByClassName('item_no')).map(item => item.getAttribute('data-id'));
			    let mat_quantity = Array.from(document.getElementsByClassName('quantity')).map(item => item.getAttribute('data-qty'));
			    let mat_remarks = Array.from(document.getElementsByClassName('remarks')).map(item => item.getAttribute('data-remarks'));

			    let p_unit = Array.from(document.getElementsByClassName('p_unit')).map(item => item.getAttribute('data-unit'));
			    let p_itemno = Array.from(document.getElementsByClassName('p_itemno')).map(item => item.getAttribute('data-id'));	
			    let p_quantity = Array.from(document.getElementsByClassName('p_quantity')).map(item => item.getAttribute('data-qty'));
			    let p_remarks = Array.from(document.getElementsByClassName('p_remarks')).map(item => item.getAttribute('data-remarks'));
			    let p_type = Array.from(document.getElementsByClassName('p_type')).map(item => item.getAttribute('data-type'));

	         	    let project_no = $('select[name=project_no]').val();
		         let c_code = $('select[name=c_code]').val();
		         let unit = $('input[name=unit]').val();
		         
			    val = {project_no:project_no,c_code:c_code,unit:unit,mat_type,mat_itemno,mat_item:mat_name,mat_quantity:mat_quantity,mat_unit:mat_unit,mat_remarks:mat_remarks,pur_item:p_itemno,pur_quantity:p_quantity,pur_unit:p_unit,pur_remarks:p_remarks,pur_type:p_type};
			    thisURL = baseURL + 'create_controller/Create_Joborder';
			    let role = $('input[name=role]').val();
			    if(role == 'production'){
			    	 url = baseURL + 'gh/production/joborder_create';
			    }else if(role == 'superuser'){
			    	 url = baseURL + 'gh/superuser/joborder_create';
			    }else if(role == 'admin'){
			    	 url = baseURL + 'gh/admin/joborder_create';
			    }else if(role == 'designer'){
			    	 url = baseURL + 'gh/designer/joborder_create';
			    }
			    _ajaxForm_loaded(thisURL,"POST",val,url);
		    }
		});
	}

	return {
		// public functions
		init: function () {
				_wizardEl = KTUtil.getById('kt_wizard');
				_formEl = KTUtil.getById('kt_form');
				_initValidation();
				_initWizard();
		}
	};
}();

// jQuery(document).ready(function () {
	
// });
