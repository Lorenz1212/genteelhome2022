"use strict";

// Class definition
var KTSALESORDER = function () {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const url_Params_Status = urlParams.get('urlstatus');
	var validation;var form;var url;var thisURL;var val;
	var idArr = [];var idArrs = [];var idItemArr = [];var keys = [];var myData = {};
	var id;var production_no;var status;var item;var quantity;var remarks;var status;
	var supplier;var payment;var received;var balance;var amount;var warehouse_status;
	var price;
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizardObj;
	var _validations = [];
	var _initSwalWarning = function(url){
	     Swal.fire("Warning!", "Please Complete the form!", "warning");
	}
	var _initSwalSuccess = function(url){
	    Swal.fire("Submit!", "This form is Completed!", "success").then(function(){
		       window.location = url;
		});
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
				 quantity = myData.qty;
				 price = myData.price;
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
	// Private functions
	var _initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					fullname: {
						validators: {
							notEmpty: {
								message: 'Fullname is required'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							}
						}
					},
					mobile: {
						validators: {
							notEmpty: {
								message: 'Mobile is required'
							}
						}
					},
					dp: {
						validators: {
							notEmpty: {
								message: 'Downpayment is required'
							}
						}
					},
					status: {
						validators: {
							notEmpty: {
								message: 'Status is required'
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
					b_address: {
						validators: {
							notEmpty: {
								message: 'Bld/Blk & Lot/Street/Subdivision/Barangay type is required'
							}
						}
					},
					b_city: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					b_province: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					s_address: {
						validators: {
							notEmpty: {
								message: 'Bld/Blk & Lot/Street/Subdivision/Barangay is required'
							}
						}
					},
					s_province: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					s_city: {
						validators: {
							notEmpty: {
								message: 'City is required'
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
					b_address: {
						validators: {
							notEmpty: {
								message: 'Bld/Blk & Lot/Street/Subdivision/Barangay type is required'
							}
						}
					},
					b_city: {
						validators: {
							notEmpty: {
								message: 'City is required'
							}
						}
					},
					b_province: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					s_address: {
						validators: {
							notEmpty: {
								message: 'Bld/Blk & Lot/Street/Subdivision/Barangay is required'
							}
						}
					},
					s_province: {
						validators: {
							notEmpty: {
								message: 'Province is required'
							}
						}
					},
					s_city: {
						validators: {
							notEmpty: {
								message: 'City is required'
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
						wizard.goTo(wizard.getNewStep());
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
				Swal.fire("Warning!", "Product Table is Empty !", "warning");
			}else{
				    let b_address 	= $('input[name=b_address]').val();
				    let b_city 	= $('input[name=b_city]').val();
				    let b_province  = $('input[name=b_province]').val();
				    let b_zipcode 	= $('input[name=b_zipcode]').val();
				    let s_address   = $('input[name=s_address]').val();
				    let s_city      = $('input[name=s_city]').val();
				    let s_province  = $('input[name=s_province]').val();
				    let s_zipcode   = $('input[name=s_zipcode]').val();
				    var project_no = [];
				    var c_code = [];
				    $("input[name='project_no[]']").each(function(){
					            project_no.push(this.value);
				    });
				     $("input[name='c_code[]']").each(function(){
					            c_code.push(this.value);
				     });
					 if(!b_address || !b_city || !b_province || !s_address || !s_city || !s_province){
					 	Swal.fire("Warning!", "Please Complete the Billing & Shipping Address Form!", "warning");
					 }else{
				 		_initgetvaluetable2();
						if($('input[name=so_no]').val() == 0)
						{   
						    let fullname = $('input[name=fullname]').val();
						    let email    = $('input[name=email]').val();
						    let mobile   = $('input[name=mobile]').val();
						    let dp       = $('input[name=dp]').val();
						    let shipping_fee      = $('input[name=shipping_fee]').val();
						    let discount     = $('#discount').val();
						    let status   = $('select[name=status]').val();
						    let vat   = $('select[name=vat]').val();
						    thisURL = baseURL + 'create_controller/Create_SalesOrder';
						    val = {vat:vat,so_no:so_no,project_no:project_no,c_code:c_code,quantity:quantity,price:price,b_address:b_address,b_city:b_city,b_province:b_province,b_zipcode:b_zipcode,s_address:s_address,s_city:s_city,s_province:s_province,s_zipcode:s_zipcode,fullname:fullname,email:email,mobile:mobile,dp:dp,status:status,shipping_fee:shipping_fee,discount:discount};
						    let role = $('input[name=role]').val();
						    url = baseURL + 'gh/'+role+'/salesorder_list';
						    _ajaxForm_loaded(thisURL,"POST",val,url);
						}else{
						    var so_no 		= $('input[name=so_no]').val();
						    val = {so_no:so_no,project_no:project_no,c_code:c_code,quantity:quantity,price:price,b_address:b_address,b_city:b_city,b_province:b_province,b_zipcode:b_zipcode,s_address:s_address,s_city:s_city,s_province:s_province,s_zipcode:s_zipcode};
						    thisURL = baseURL + 'update_controller/Update_SalesOrder';
						    let role = $('input[name=role]').val();
						    url = baseURL + 'gh/'+role+'/salesorder_list';
						    _ajaxForm_loaded(thisURL,"POST",val,url);
						}
				 }    
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

jQuery(document).ready(function () {
	
});
