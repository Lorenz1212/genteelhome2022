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
			
		}
	}
	var _initResponse = function(response,val,val2){
		switch(val){

			
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
