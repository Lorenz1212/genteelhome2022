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
						  title: action,
						  text: "You clicked the button!",
						  icon: "success",
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
        $('.kt_signup').on('click', function (e) {
            e.preventDefault();
            let email = $('input[name=email_address]').val();
            let code = $('input[name=code]').val();
            let con_code = $('input[name=code]').attr('data-code');
            if(code == atob(con_code)){
                var firstname       = $('#firstname').val();
                var lastname         = $('#lastname').val();
                var confirm_email    = $('#confirm_email').val();
                var password         = $('.password').val();
                var confirm_password = $('#confirm_password').val();
                var val = {firstname:firstname,lastname:lastname,email:email,password:password};
                var thisURL = 'Website_controller/registration';
                var action ='Your Account has been Created Successfully'
                var login ='Login';
                _ajaxloader(thisURL,"POST",val,action,login);
            }else{
                swal("Invalid Code", "Sorry, the verification code you entered does not match!", "info");
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
