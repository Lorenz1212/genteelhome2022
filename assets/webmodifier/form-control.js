// Class definition
var KTFormControlsWeb= function () {
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
	var _sessionStorage = function(key,value){
		sessionStorage.setItem(key, value);
	}
	var _getItem = function(key){
		return sessionStorage.getItem(key);
	}
	var _ajaxForm = function(formData,val=null,val2=null){
		 $.ajax({
                url: baseURL+'Webmodifier_Controller/Action',
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
			case "banner":{
				    var form = KTUtil.getById('Create-banner-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-banner-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("Create-banner-form").reset();
                    $('.images').attr('src',''+baseURL+'assets/images/banner/default.png');
                });
                $('.btn-create-banner').on('click',function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "banner");
                                formData.append("type", 'add_banner');
                                _ajaxForm(formData,'add_banner',false);
                        }   
                    });                
                });
                var form_update = KTUtil.getById('update-banner-form');
                $('#view-banner-modal').on('hidden.bs.modal', function () {
                    document.getElementById("update-banner-form").reset();
                });
                $('.btn-update-banner').on('click',function(e){
                    e.preventDefault();
                    let formDatas = new FormData(form_update);
                    formDatas.append("action", "banner");
                    formDatas.append("type", 'update_banner');
                    formDatas.append("id", id);
                    _ajaxForm(formDatas,'update_banner',false);
              
                });
				break;
			}
            case "interior":{
                    var form = KTUtil.getById('create-interior-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            project_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Title is required'
                                    },
                                }
                            },
                             cat_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Category is required'
                                    },
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
                                    },
                                }
                            },
                             bg_image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-interior-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-interior-form").reset();
                    $('.description-create').summernote('code',' ');
                    $('.image-update').attr('src',''+baseURL+'assets/images/interior/default.png');
                    $('.bg-update').attr('src',''+baseURL+'assets/images/interior/default.png');
                });
                $('.btn-create-interior').on('click',function(e){
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "interior");
                                formData.append("type", 'add_interior');
                                formData.append('description',$('.description-create').summernote('code'));
                                _ajaxForm(formData,'add_interior',false);
                        }   
                    });                
                });
                var form_update = KTUtil.getById('update-interior-form');
                $('#update-interior-modal').on('hidden.bs.modal', function () {
                     $('.description-update').summernote('code',' ');
                    document.getElementById("update-interior-form").reset();
                });
                $('.btn-update-interior').on('click',function(e){
                    e.preventDefault();
                    let formDatas = new FormData(form_update);
                    formDatas.append("action", "interior");
                    formDatas.append("type", 'update_interior');
                    formDatas.append('description',$('.description-update').summernote('code'));
                    formDatas.append("id", id);
                    _ajaxForm(formDatas,'update_interior',false);
              
                });
                break;
            }
              case "events":{
                    var form = KTUtil.getById('create-event-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Title is required'
                                    },
                                }
                            },
                            description: {
                                validators: {
                                    notEmpty: {
                                        message: 'Description is required'
                                    },
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-events-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-event-form").reset();
                    $('.image-create').attr('src',''+baseURL+'assets/images/events/default.jpg');
                });
                $('.btn-create-events').on('click',function(e){
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "events");
                                formData.append("type", 'add_events');
                                _ajaxForm(formData,'add_events',false);
                        }   
                    });                
                });
                var form_update = KTUtil.getById('update-events-form');
                $('#update-events-modal').on('hidden.bs.modal', function () {
                    document.getElementById("update-events-form").reset();
                });
                $('.btn-update-events').on('click',function(e){
                    e.preventDefault();
                    let formDatas = new FormData(form_update);
                    formDatas.append("action", "events");
                    formDatas.append("type", 'update_events');
                    formDatas.append("id", id);
                    _ajaxForm(formDatas,'update_events',false);
              
                });
                break;
            }
             case "testimony":{
                  var form = KTUtil.getById('create-testimony-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Fullname is required'
                                    },
                                }
                            },
                            description: {
                                validators: {
                                    notEmpty: {
                                        message: 'Testimony is required'
                                    },
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-testimony-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-testimony-form").reset();
                    $('.images').attr('src',''+baseURL+'assets/images/testimony/default.jpg');
                });
                $('.btn-create-testimony').on('click',function(e){
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "testimony");
                                formData.append("type", 'add_testimony');
                                _ajaxForm(formData,'add_testimony',false);
                        }   
                    });                
                });
                var form_update = KTUtil.getById('update-testimony-form');
                $('#view-testimony-modal').on('hidden.bs.modal', function () {
                    document.getElementById("update-testimony-form").reset();
                });
                $('.btn-update-testimony').on('click',function(e){
                    e.preventDefault();
                    let formDatas = new FormData(form_update);
                    formDatas.append("action", "testimony");
                    formDatas.append("type", 'update_testimony');
                    formDatas.append("id", id);
                    _ajaxForm(formDatas,'update_testimony',false);
              
                });
                break;
            }
            case "product":{
                var form = KTUtil.getById('create-product-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Product Name is required'
                                    },
                                }
                            },
                            pallet_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Pallet Name is required'
                                    },
                                }
                            },
                            amount: {
                                validators: {
                                    notEmpty: {
                                        message: 'Amount of product is required'
                                    },
                                }
                            },
                            cat_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Category is required'
                                    },
                                }
                            },
                            sub_id: {
                                validators: {
                                    notEmpty: {
                                        message: 'Sub Category is required'
                                    },
                                }
                            },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
                                    },
                                }
                            },
                            color: {
                                validators: {
                                    notEmpty: {
                                        message: 'Pallet Color is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
                                    },
                                }
                            },
                            docs: {
                                validators: {
                                    notEmpty: {
                                        message: 'Tearsheet is required'
                                    }
                                }
                            },

                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap(),
                        }
                    }
                );
                $('#create-product-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-product-form").reset();
                    $('#kt_image_5 > span').trigger('click');
                    $('.image').attr('src',''+baseURL+'assets/images/design/project_request/images/default.jpg');
                });
                $('.btn-create-product').on('click',function(e){
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "product");
                                formData.append("type", 'add_product');
                                _ajaxForm(formData,'add_product',false);
                        }   
                    });                
                });   
                  var form_exisiting = KTUtil.getById('create-existing-form');
                    validation_existing = FormValidation.formValidation(
                    form_exisiting,{
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'Product Name is required'
                                    },
                                }
                            },
                            pallet_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Pallet Name is required'
                                    },
                                }
                            },
                            amount: {
                                validators: {
                                    notEmpty: {
                                        message: 'Amount of product is required'
                                    },
                                }
                            },
                            color: {
                                validators: {
                                    notEmpty: {
                                        message: 'Pallet Color is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-existing-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-existing-form").reset();
                    $('.image').attr('src',''+baseURL+'assets/images/design/project_request/images/default.jpg');
                });
                $('.btn-create-existing').on('click',function(e){
                    e.preventDefault();
                    validation_existing.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData_existing = new FormData(form_exisiting);
                                formData_existing.append("action", "product");
                                formData_existing.append("type", 'add_existing');
                                _ajaxForm(formData_existing,'add_existing',false);
                        }   
                    });                
                });      
                break;
            }
            case "lookbook":{
                var form = KTUtil.getById('create-lookbook-form');
                    validation = FormValidation.formValidation(
                    form,{
                        fields: {
                            // cat_id: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Category is required'
                            //         },
                            //     }
                            // },
                            image: {
                                validators: {
                                    notEmpty: {
                                        message: 'Image is required'
                                    },
                                    file: {
                                        extension: 'jpg,jpeg,png',
                                        type: 'image/jpeg,image/png',
                                        message: 'The selected file is not valid'
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
                $('#create-lookbook-modal').on('hidden.bs.modal', function () {
                    validation.resetForm();
                    document.getElementById("create-lookbook-form").reset();
                    $('.image').attr('src',''+baseURL+'assets/images/lookbook/default.jpg');
                });
                 $('.btn-create-lookbook').on('click',function(e){
                    e.preventDefault();
                    validation.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData = new FormData(form);
                                formData.append("action", "lookbook");
                                formData.append("type", 'add_lookbook');
                                _ajaxForm(formData,'add_lookbook',false);
                        }   
                    });                
                }); 

                  var form_update = KTUtil.getById('update-lookbook-form');
                    validation_update = FormValidation.formValidation(
                    form_update,{
                        fields: {
                            // cat_id: {
                            //     validators: {
                            //         notEmpty: {
                            //             message: 'Category is required'
                            //         },
                            //     }
                            // },

                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap(),
                        }
                    }
                );
                  $('.btn-update-lookbook').on('click',function(e){
                    e.preventDefault();
                    validation_update.validate().then(function(status) {
                        if (status == 'Valid') {
                                let formData_update = new FormData(form_update);
                                formData_update.append("action", "lookbook");
                                formData_update.append("type", 'update_lookbook');
                                formData_update.append("id", $('.title-update').attr('data-id'));
                                _ajaxForm(formData_update,'update_lookbook',false);
                        }   
                    });                
                }); 
                break;
            }
		}
	}
	var _initResponse = function(response,val,val2){
		switch(val){
            case "update_lookbook":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_lookbooks',response.data);
                    }
                    $('#update-lookbook-modal').modal('hide');
                }
                break;
            }
            case "add_lookbook":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_lookbooks',response.data);
                    }
                    $('#create-lookbook-modal').modal('hide');
                }
                break;
            }
            case "add_existing":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_products',response.data);
                    }
                    $('#create-existing-modal').modal('hide');
                }
                break;
            }
            case "add_product":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_products',response.data);
                    }
                    $('#create-product-modal').modal('hide');
                }
                break;
            }
            case "add_testimony":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response.data);
                    }
                    $('#create-testimony-modal').modal('hide');
                }
                break
            }
             case "update_testimony":{
                if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_testimony',response.data);
                    }
                    $('#update-testimony-modal').modal('hide');
                }
                break
            }
            case"update_events":{
                 if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_events',response.data);
                    }
                    $('#update-events-modal').modal('hide');
                }
                break;
            }
            case "add_events":{
                 if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_events',response.data);
                    }
                    $('#create-events-modal').modal('hide');
                }
                break;
            }
            case"update_interior":{
                 if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_interiors',response.data);
                    }
                    $('#update-interior-modal').modal('hide');
                }
                break;
            }
            case "add_interior":{
                 if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_interiors',response.data);
                    }
                    $('#create-interior-modal').modal('hide');
                }
                break;
            }
            case "update_banner":{
              if(response != false){
                    _showToast(response.type,response.message);
                    if(response.data){
                     KTDatatablesDataSourceAjaxClient.init('tbl_banners',response.data);
                    }
                    $('#view-banner-modal').modal('hide');
                }
               break;    
            }
            case "add_banner":{
                if(response != false){
                    _showToast(response.type,response.message);
                     KTDatatablesDataSourceAjaxClient.init('tbl_banners',response.data);
                    $('#create-banner-modal').modal('hide');
                }
                break;
            }
			case "add_voucher":{
				_showToast(response.type,response.message);
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
