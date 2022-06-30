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
    var _initnotificationupdate = function(){
		 _ajaxloaderOption('Dashboard_controller/designer_dashboard','POST',false,'designer');
	}
	var _sessionStorage = function(key,value){
		sessionStorage.setItem(key, value);
	}
	var _getItem = function(key){
		return sessionStorage.getItem(key);
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
		}
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
		                                max: 50,
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
		                                max: 50,
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
				    $('#design_image_add').trigger('click');
				    document.getElementById('Create_Design_Project').reset();
				});
				$('.btn-add-save').on('click',function(e){
		            e.preventDefault();
		            validation_add.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData_add = new FormData(form_add);
	                        formData_add.append("action", "design-project");
	                        formData_add.append("type", 'add_design_project');
	                        _ajaxForm(formData_add,'add_design_project',false);
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
		                                max: 50,
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
		                                max: 50,
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
				    document.getElementById('Update_Design_Stocks').reset();
				});
				$('.btn-edit-save').on('click',function(e){
		            e.preventDefault();
		            validation.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData_update = new FormData(form);
	                        formData_update.append("action", "design-stocks");
	                        formData_update.append("type", 'edit_design-stocks');
	                        formData_update.append("id", $('input[name=title]').attr('data-id'));
	                        _ajaxForm(formData_update,'edit_design-stocks',false);
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
		                                max: 50,
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
		                                max: 50,
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
		        	document.getElementById('Create_Design_Stocks').reset();
		        	$('#design_image_add > span').trigger('click');
		        	$('#blahx').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
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
				    $('#blahh').attr('src',baseURL+'assets/images/design/project_request/images/default.jpg');
				    document.getElementById('Create_Design_Stocks_Existing').reset();
				});
				$('.btn-add-existing-save').on('click',function(e){
		            e.preventDefault();
		            validation_existing.validate().then(function(status) {
		                if (status == 'Valid') {
	                		let formData_existing = new FormData(form_existing);
	                        formData_existing.append("action", "design-stocks");
	                        formData_existing.append("type", 'add_design_stocks-existing');
	                        _ajaxForm(formData_existing,'add_design_stocks-existing',false);
		                }	
	                });                
	            });
				break;	
			}
		}
	}
	var _initResponse = function(response,val,val2){
		_initnotificationupdate();
		switch(val){
			case "add_design_stocks":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-stocks-modal').modal('hide');
				}
				KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_stocks',false,'request');
				break;
			}
			case "add_design_stocks-existing":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-stocks-existing-modal').modal('hide');
				}
				KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_stocks',false,'request');
				break;
			}
			case "edit_design-stocks":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#edit-stocks-modal').modal('hide');
				}
				let tab1 = _getItem('creative-design-stocks');
				if(!_getItem('creative-design-stocks')){
					_sessionStorage('creative-design-stocks','approved');
					 tab1 = 'approved';
				}
				KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_stocks',false,tab1);
				break;
			}
			case "add_design_project":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#add-project-modal').modal('hide');
				}
				let tab1 = _getItem('creative-design-project');
				if(!_getItem('creative-design-stocks')){
					_sessionStorage('creative-design-project','approved');
					 tab1 = 'approved';
				}
				KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_project',false,tab1);
				break;
			}
			case "edit_design-project":{
				_showToast(response.type,response.message);
				if(response.type == 'success'){
					$('#edit-project-modal').modal('hide');
				}
				let tab1 = _getItem('creative-design-project');
				if(!_getItem('creative-design-stocks')){
					_sessionStorage('creative-design-project','approved');
					 tab1 = 'approved';
				}
				KTDatatablesDataSourceAjaxClientCreative.init('tbl_design_project',false,tab1);
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
