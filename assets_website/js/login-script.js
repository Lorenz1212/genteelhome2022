"use strict";
// Class Definition
var KTLogin = function() {
    var _ajaxloader = async function(thisURL,type,val,action,login){
		  $.ajax({
	             url: baseURL + thisURL,
	             type: "POST",
	             data: val,
	             dataType:"json",
	             beforeSend: function()
	             {
	                 
	             },
                 complete: function(){
                     
                  },
                  success: function(response)
                  { 
                  	if(response.status =='success'){
                  		swal({
						  title: response.message,
						  text: "You clicked the button!",
						  icon: response.status,
						  button: "Ok!",
						}).then(function() {
                            if(login == 'Login'){
                                var url = baseURL+'gh/app/index';
                                window.location = url;
                            }else{
                                 var url = $(location).attr('href');
                                 window.location = url;
                            }
						});
                  	}else if(response.status =='error'){
                  		swal("Oopps", "Invalid Username/Password", "warning");
                  	}else if(response.status == 'no account'){
                  		swal({
						  title: "Warning!",
						  text: "The email you entered isn’t connected to an account.",
						  icon: "warning",
						  button: "Ok!",
						});
                  	}else if(response.status == 'already'){
                        swal({
                          title: "Warning!",
                          text: response.message,
                          icon: "warning",
                          button: "Ok!",
                        });
                    }	
                  },
                 error: function(xhr,status,error){
                       console.log(xhr);
                       console.log(status);
                       console.log(error);
                       console.log(xhr.responseText);
                       swal({
                          title: "Warning!",
                          text: "Invalid Username/Password.",
                          icon: "warning",
                          button: "Ok!",
                        });  
                 }                                      
		});	
	}
    var _ajaxForm = function(formData){
         $.ajax({
                url: baseURL+'Website_controller/registration',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType:"json",
                beforeSend: function(){
                  // KTApp.blockPage();
                },
                complete: function(){
                  // KTApp.unblockPage();
                },
                success: function(response){
                   if(response.status =='success'){
                        swal({
                          title: response.message,
                          text: "You clicked the button!",
                          icon: response.status,
                          button: "Ok!",
                        }).then(function() {
                            window.location.reload();
                        });
                    }else if(response.status =='error'){
                        swal("Oopps", "Invalid Username/Password", "warning");
                    }else if(response.status == 'no account'){
                        swal({
                          title: "Warning!",
                          text: "The email you entered isn’t connected to an account.",
                          icon: "warning",
                          button: "Ok!",
                        });
                    }else if(response.status == 'already'){
                        swal({
                          title: "Warning!",
                          text: response.message,
                          icon: "warning",
                          button: "Ok!",
                        });
                    }   
                  },
                  error: function(xhr,status,error){
                      console.log(xhr);
                      console.log(status);
                      console.log(error);
                      console.log(xhr.responseText);
                 } 
            })
    }

    var _handleSignInForm = function() {
        $('#kt_signin').on('click', function () {
            var email = $('.email1').val();
            var password = $('.password1').val();
            var val = {email:email,password:password};
            var thisURL = 'gh/app_login';
            var action ='Login Successfully'
            _ajaxloader(thisURL,"POST",val,action,false);
        });
    }
     var _handleSignInForm1 = function() {
        $('#kt_signin1').on('click', function () {
            var email = $('#email').val();
            var password = $('#password').val();
            var val = {email:email,password:password};
            var thisURL = 'gh/app_login';
            var action ='Login Successfully'
            var login ='Login';
            _ajaxloader(thisURL,"POST",val,action,login);
        });
    }

     var _handleSignUpForm = function() {
         var form = KTUtil.getById('registration-form');
        $('#registration-form').on('submit', function (e) {
            e.preventDefault();
            let password    = $('.password').val();
            let confirm_password = $('#confirm_password').val();
            let email    = $('.email').val();
            let confirm_email = $('#confirm_email').val();
            if(email == confirm_email){
                if(password == confirm_password){
                   let formData = new FormData(form);
                    _ajaxForm(formData);
                }else{
                    swal("Oopps", "Sorry, the confirmation password you entered does not match!", "info");
                }
            }else{
                 swal("Oopps", "Sorry, the confirmation email you entered does not match!", "info");
            }
        });
    }
    var _handleForgotForm = function(e) {
        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
            var email = $('input[name=email]').val();
            var password = $('input[name=password]').val();
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _handleSignInForm();
            _handleSignInForm1();
            _handleSignUpForm();
            // _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
