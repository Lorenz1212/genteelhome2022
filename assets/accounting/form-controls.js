// Class definition
var KTFormControlsAccounting = function () {
	var validation;
	var _showToast = function(type,message) {
        const Toast = Swal.mixin({toast: true,position: 'top-end',showConfirmButton: false,timer: 3000,timerProgressBar: true,onOpen: (toast) => {toast.addEventListener('mouseenter', Swal.stopTimer),toast.addEventListener('mouseleave', Swal.resumeTimer)}});Toast.fire({icon: type,title: message});
    }
    var _showSwal  = function(type,message) {
        swal.fire({
          text: message,
          icon: type,
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          }
          })
    }
	var _ajaxForm = function(formData,val=null,val2=null){
		 $.ajax({
                url: baseURL+'Accounting_Controller/Action',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType:"json",
                beforeSend: function(){
                  KTApp.blockPage();
                },
                complete: function(){
                  KTApp.unblockPage();
                },
                success: function(response){
                    if(response.status=="success"){
                        res=JSON.parse(window.atob(response.payload));
                        	_initResponse(res,val,val2);
                    }else if(response.status == "failed"){
                        Swal.fire("Oopps!", response.message, "info");
                    }else if(response.status == "error"){
                       Swal.fire("Oopps!", response.message, "info");
                    }else{
                       Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");
                       console.log(JSON.parse(window.atob(response.payload)));
                    }
                  },
                  error: function(xhr,status,error){
                      console.log(xhr);
                      console.log(status);
                      console.log(error);
                      console.log(xhr.responseText);
                      Swal.fire("Oopps!", "Something went wrong, Please try again later", "info");
                 } 
            })
	}
	var _InitView = function(form,id){
		switch(form){
			case "profile":{
				 let validation_contact;
			     let form_contact = KTUtil.getById('contact_info_form');
			       validation_contact = FormValidation.formValidation(
			      form_contact,{
			        fields: {
			           mobile: {
			                     validators: {
			                            notEmpty: {
			                                message: 'Mobile number is  required'
			                            },
			                            digits: {
			                                message: 'Mobile number can contain digits only'
			                            },
			                            stringLength: {
			                                min: 6,
			                                max: 10,
			                                message: 'The mobile number must have at least 6 to 10 digits'
			                            }
			                        }
			                    },
			                    city: {
			                        validators: {
			                            regexp: {
			                                regexp: /^[a-zA-ZÀ-ž-.\s]+$/,
			                                message: 'The city can only consist of alphabetical characters'
			                            },
			                            stringLength: {
			                                max: 20,
			                                message: 'You have reached your maximum limit of characters allowed'
			                            }
			                        }
			                    },
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
			    $('#contact_info_form').on('submit',function(e){
		            e.preventDefault();
		            validation_contact.validate().then(function(status) {
		                if (status == 'Valid') {
		                    let formData = new FormData(form_contact);
		                        formData.append("action", "save_user_profile");
		                        formData.append("type", 'save_contact_info');
		                        _ajaxForm(formData,'save_contact_info',false);
		                }	
	                });                
	            });
	            var validation_pass;
			     var form_pass = KTUtil.getById('change_pass_form');
			       validation_pass = FormValidation.formValidation(
			      form_pass,{
			        fields: {
			          c_password: {
			                        validators: {
			                            notEmpty: {
			                                message: 'The password is required'
			                            }
			                        }
			                    },
			                    n_password: {
			                        validators: {
			                            stringLength: {
			                                min: 8,
			                                message: 'The password must have at least 8 characters'
			                            },
			                            notEmpty: {
			                                message: 'The password is required'
			                            }
			                        }
			                    },
			                    
			                    v_password: {
			                        validators: {
			                            notEmpty: {
			                                message: 'The password confirmation is required'
			                            },
			                            identical: {
			                                compare: function() {
			                                    return form.querySelector('[name="n_password"]').value;
			                                },
			                                message: 'The password and its confirm are not the same'
			                            }
			                        }
			                    }
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
			    $('#change_pass_form').on('submit',function(e){
		            e.preventDefault();
		            validation_pass.validate().then(function(status) {
		                if (status == 'Valid') {
		                    let formData = new FormData(form_pass);
		                        formData.append("action", "save_user_profile");
		                        formData.append("type", 'save_change_pass');
		                        _ajaxForm(formData,'save_change_pass',false);
		                }	
	                });                
	            });
	             var validation_personal;
			     var form_personal = KTUtil.getById('personal_info_form');
			       validation_personal = FormValidation.formValidation(
			      form_personal,
			      {
			        fields: {
			           fname: {
			                        validators: {
			                            notEmpty: {
			                                message: 'First name is required'
			                            },
			                            regexp: {
			                                regexp: /^[a-zA-ZÀ-ž-.\s]+$/,
			                                message: 'The first name can only consist of alphabetical characters'
			                            },
			                            stringLength: {
			                                max: 20,
			                                message: 'You have reached your maximum limit of characters allowed'
			                            },
			                            
			                        }
			                    },
			                    lname: {
			                        validators: {
			                            notEmpty: {
			                                message: 'Last name is required'
			                            },
			                            regexp: {
			                                regexp: /^[a-zA-ZÀ-ž-.\s]+$/,
			                                message: 'The last name can only consist of alphabetical characters'
			                            },
			                            stringLength: {
			                                max: 20,
			                                message: 'You have reached your maximum limit of characters allowed'
			                            }
			                        }
			                    },
			                    mname: {
			                        validators: {
			                            regexp: {
			                                regexp: /^[a-zA-ZÀ-ž-.\s]+$/,
			                                message: 'The middle name can only consist of alphabetical characters'
			                            },
			                            stringLength: {
			                                max: 20,
			                                message: 'You have reached your maximum limit of characters allowed'
			                            }
			                        }
			                    }
			                },

			        plugins: { //Learn more: https://formvalidation.io/guide/plugins
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
			      $('#personal_info_form').on('submit',function(e){
		            e.preventDefault();
		            validation_personal.validate().then(function(status) {
		                if (status == 'Valid') {
		                    let formData = new FormData(form_personal);
		                        formData.append("action", "save_user_profile");
		                        formData.append("type", 'save_personal_info');
		                        _ajaxForm(formData,'save_personal_info',false);
		                }	
	                });                
	            });
				break;
			}
			case "report_project_monitoring":{
		        var form = KTUtil.getById('edit_details');
		       	validation = FormValidation.formValidation(
		            form,{
		                fields: {
							customer: {
								validators: {
									notEmpty: {
										message: 'Customer Name is required'
									},
								}
							},
							address: {
								validators: {
									notEmpty: {
										message: 'Address is required'
									},
								}
							},

							amount: {
								validators: {
									notEmpty: {
										message: 'Amount is required'
									},
								}
							},

							labor: {
								validators: {
									notEmpty: {
										message: 'Labor cost is required'
									},
								}
							},

							start: {
								validators: {
									notEmpty: {
										message: 'Start date is required'
									},
								}
							},
							end: {
								validators: {
									notEmpty: {
										message: 'End date is required'
									},
								}
							},

		                },

		                plugins: {
		                    trigger: new FormValidation.plugins.Trigger(),
		                    bootstrap: new FormValidation.plugins.Bootstrap(),
		                }
		            }
		        );
		        $('#view-details').on('hidden.bs.modal', function () {
				    validation.resetForm();
				});
				$('.btn-edit-detials').on('click',function(e){
		            e.preventDefault();
		            validation.validate().then(function(status) {
		                if (status == 'Valid') {
		                	if(!$('.text-trans').attr('data-id')){
		                		_showSwal('info','Please search J.O Number first to update details');
		                	}else{
		                		let formData = new FormData(form);
		                        formData.append("action", "project-monitoring");
		                        formData.append("type", 'edit_project_monitoring_details');
		                        formData.append("id", $('.text-trans').attr('data-id'));
		                        _ajaxForm(formData,'edit_project_monitoring_details',false);
		                	}
		                    
		                }	
	                });                
	            });
	             var form_mat = KTUtil.getById('edit_materials');
		       	 validation_mat = FormValidation.formValidation(
		            form_mat,{
		                fields: {
							item: {
								validators: {
									notEmpty: {
										message: 'Material is required'
									},
								}
							},
							quantity_costing: {
								validators: {
									notEmpty: {
										message: 'Quantity costing is required'
									},
								}
							},

							cost: {
								validators: {
									notEmpty: {
										message: 'Unit Price is required'
									},
								}
							},
		                },
		                plugins: {
		                    trigger: new FormValidation.plugins.Trigger(),
		                    bootstrap: new FormValidation.plugins.Bootstrap(),
		                }
		            }
		        );
		       	$('#view-materials').on('hidden.bs.modal', function () {
				    validation_mat.resetForm();
				    $('#Create-sales-form').get(0).reset();
				});
				$('.btn-edit-details-materials').on('click',function(e){
		            e.preventDefault();
		            validation_mat.validate().then(function(status) {
		                if (status == 'Valid') {
		                		let formData = new FormData(form_mat);
		                        formData.append("action", "project-monitoring-materials");
		                        formData.append("type", 'edit_project_monitoring_materials');
		                        _ajaxForm(formData,'edit_project_monitoring_materials',false);
		                }	
	                });                
	            });
				break;	
			}
			case "sales-collection":{
				var form = KTUtil.getById('Create-sales-form');
		       	validation = FormValidation.formValidation(
		            form,{
		                fields: {
							firstname: {
								validators: {
									notEmpty: {
										message: 'First name is required'
									},
								}
							},
							lastname: {
								validators: {
									notEmpty: {
										message: 'Last name is required'
									},
								}
							},

							email: {
								validators: {
									notEmpty: {
										message: 'Email is required'
									},
								}
							},
							order_no: {
								validators: {
									notEmpty: {
										message: 'Order No. is required'
									},
								}
							},
							date_deposite: {
								validators: {
									notEmpty: {
										message: 'Date Deposite is required'
									},
								}
							},
							amount: {
								validators: {
									notEmpty: {
										message: 'Amount is required'
									},
								}
							},
							bank: {
								validators: {
									notEmpty: {
										message: 'Bank type is required'
									},
								}
							},
							image: {
								validators: {
									notEmpty: {
										message: 'Photo of deposite slip is required'
									},
								}
							},

		                },

		                plugins: {
		                    trigger: new FormValidation.plugins.Trigger(),
		                    bootstrap: new FormValidation.plugins.Bootstrap(),
		                }
		            }
		        );
		        $('#create-sales-collection-modal').on('hidden.bs.modal', function () {
				    validation.resetForm();
				});
				$('.btn-save').on('click',function(e){
		            e.preventDefault();
		            validation.validate().then(function(status) {
		                if (status == 'Valid') {
		                		let formData = new FormData(form);
		                        formData.append("action", "sales-collection");
		                        formData.append("type", 'add_sales_collection');
		                        _ajaxForm(formData,'add_sales_collection',false);
		                }	
	                });                
	            });
				break;
			}
		}
	}
	var _initResponse = function(response,val,val2){
		switch(val){
			case "edit_project_monitoring_details":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#view-details').modal('hide');
					$('.btn-search').trigger('click');
				}else{
					$('#view-details').modal('hide');
				}
				break;
			}
			case "edit_project_monitoring_materials":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#view-materials').modal('hide');
					$('.btn-search').trigger('click');
				}else{
					$('#view-materials').modal('hide');
				}
				break;
			}
			case "add_sales_collection":{
				_showToast(response.type,response.message);
				$('#create-sales-collection-modal').modal('hide');
				KTDatatablesDataSourceAjaxClient.init('tbl_collection');
				break;
			}
			
		}
	}
	return {
		// public functions
		init: function(form,val=false){
			_InitView(form,val);
		}
	};
}();

// jQuery(document).ready(function() {
// 	KTFormControls.init();
// });
