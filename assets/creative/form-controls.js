// Class definition
var KTFormControlsCreatives = function () {
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
                url: baseURL+'Creative_Controller/Action',
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
		                	alert(id)
		                    let formData = new FormData(form_personal);
		                        formData.append("action", "save_user_profile");
		                        formData.append("type", 'save_personal_info');
		                        _ajaxForm(formData,'save_personal_info',false);
		                }	
	                });                
	            });
				break;
			}
			case "form-design-project":{
		        var form = KTUtil.getById('Update_Design_Project');
		       	validation = FormValidation.formValidation(
		            form,{
		                fields: {
							 title: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Project Title is required'
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
		                    image: {
								validators: {
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							docs: {
								validators: {
									file: {
					                    extension: 'pdf',
					                    type: 'application/pdf',
					                    message: 'The selected file is not valid',
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
		        $('#edit-project-modal').on('hidden.bs.modal', function () {
				    validation.resetForm();
				});
				$('.btn-edit-save').on('click',function(e){
		            e.preventDefault();
		            validation.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData = new FormData(form);
	                        formData.append("action", "design-project");
	                        formData.append("type", 'edit_design-project');
	                        formData.append("id", $('input[name=title]').attr('data-id'));
	                        _ajaxForm(formData,'edit_design-project',false);
		                }	
	                });                
	            });

	            var form_add = KTUtil.getById('Create_Design_Project');
		       	var validation_add = FormValidation.formValidation(
		            form_add,{
		                fields: {
							 title: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Project Title is required'
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
							image: {
								validators: {
									notEmpty: {
										message: 'Project Image is required'
									},
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							docs: {
								validators: {
									notEmpty: {
										message: 'Project Specification is required'
									},
									file: {
					                    extension: 'pdf',
					                    type: 'application/pdf',
					                    message: 'The selected file is not valid',
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
		        $('#add-project-modal').on('hidden.bs.modal', function () {
				    validation_add.resetForm();
				});
				$('.btn-add-save').on('click',function(e){
		            e.preventDefault();
		            validation_add.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData = new FormData(form_add);
	                        formData.append("action", "design-project");
	                        formData.append("type", 'add_design_project');
	                        _ajaxForm(formData,'add_design_project',false);
		                }	
	                });                
	            });
				break;	
			}
			case "form-design-stocks":{
		     	var form = KTUtil.getById('Update_Design_Stocks');
		       	validation = FormValidation.formValidation(
		            form,{
		                fields: {
							 title: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Item name is required'
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
		                    pallet_name: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Pallet name is required'
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
		                     pallet: {
								validators: {
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
		                    image: {
								validators: {
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							docs: {
								validators: {
									file: {
					                    extension: 'pdf',
					                    type: 'application/pdf',
					                    message: 'The selected file is not valid',
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
		        $('#edit-stocks-modal').on('hidden.bs.modal', function () {
				    validation.resetForm();
				});
				$('.btn-edit-save').on('click',function(e){
		            e.preventDefault();
		            validation.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData = new FormData(form);
	                        formData.append("action", "design-stocks");
	                        formData.append("type", 'edit_design-stocks');
	                        formData.append("id", $('input[name=title]').attr('data-id'));
	                        _ajaxForm(formData,'edit_design-stocks',false);
		                }	
	                });                
	            });
            var form_add = KTUtil.getById('Create_Design_Stocks');
	       	var validation_add = FormValidation.formValidation(
		            form_add,{
		                fields: {
							 title: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Item name is required'
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
		                    pallet_name: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Pallet name is required'
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
		                    pallet: {
								validators: {
									notEmpty: {
										message: 'Pallet color Image is required'
									},
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							image: {
								validators: {
									notEmpty: {
										message: 'Project Image is required'
									},
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							docs: {
								validators: {
									notEmpty: {
										message: 'Item Specification is required'
									},
									file: {
					                    extension: 'pdf',
					                    type: 'application/pdf',
					                    message: 'The selected file is not valid',
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
		        $('#add-stocks-modal').on('hidden.bs.modal', function () {
				    validation_add.resetForm();
				});
				$('.btn-add-save').on('click',function(e){
		            e.preventDefault();
		            validation_add.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData = new FormData(form_add);
	                        formData.append("action", "design-stocks");
	                        formData.append("type", 'add_design_stocks');
	                        _ajaxForm(formData,'add_design_stocks',false);
		                }	
	                });                
	            });
	            var form_existing = KTUtil.getById('Create_Design_Stocks_Existing');
		       	var validation_existing = FormValidation.formValidation(
		            form_existing,{
		                fields: {
							 title: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Item name is required'
		                            }
		                        }
		                    },
		                    pallet_name: {
		                        validators: {
		                            notEmpty: {
		                                message: 'Pallet name is required'
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
		                    pallet: {
								validators: {
									notEmpty: {
										message: 'Pallet color Image is required'
									},
									file: {
					                    extension: 'jpeg,jpg,png',
					                    type: 'image/jpeg,image/png',
					                    message: 'The selected file is not valid',
					                },
								}
							},
							docs: {
								validators: {
									notEmpty: {
										message: 'Item Specification is required'
									},
									file: {
					                    extension: 'pdf',
					                    type: 'application/pdf',
					                    message: 'The selected file is not valid',
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
		        $('#add-stocks-existing-modal').on('hidden.bs.modal', function () {
				    validation_existing.resetForm();
				});
				$('.btn-add-existing-save').on('click',function(e){
		            e.preventDefault();
		            validation_existing.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData = new FormData(form_existing);
	                        formData.append("action", "design-stocks");
	                        formData.append("type", 'add_design_stocks-existing');
	                        _ajaxForm(formData,'add_design_stocks-existing',false);
		                }	
	                });                
	            });
				break;	
			}
		}
	}
	var _initResponse = function(response,val,val2){
		switch(val){
			case "add_design_stocks":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-stocks-modal').modal('hide');
				}
				break;
			}
			case "add_design_stocks-existing":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-stocks-existing-modal').modal('hide');
				}
				break;
			}
			case "edit_design-stocks":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#edit-stocks-modal').modal('hide');
				}
				break;
			}
			case "add_design_project":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-project-modal').modal('hide');
				}
				break;
			}
			case "edit_design-project":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#edit-project-modal').modal('hide');
				}
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
