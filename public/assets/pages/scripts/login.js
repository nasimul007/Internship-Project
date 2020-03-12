$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$.validator.addMethod("uniqueEmail", function(value, element) {
    var response;
        $.ajax({
            type: 'POST',
            url: "/validateStudentEmail",
            data:{email: $('#emailCheck').val()},
            async: false,
            success: function(data)
            {
                //console.log($.parseJSON(data).valid);
                response = $.parseJSON(data).valid;
            }
         });
        //console.log(response);
        return response;
    },
    "Email Already Exist ! Please enter another."
);

$.validator.addMethod("uniqueId", function(value, element) {
    var response;
        $.ajax({
            type: 'POST',
            url: "/validateStudentId",
            data:{student_id: $('#idCheck').val()},
            async: false,
            success: function(data)
            {
                //console.log($.parseJSON(data).valid);
                response = $.parseJSON(data).valid;
            }
         });
        //console.log(response);
        return response;
    },
    "Id Already Exist ! Please wait for Admin's confirmation mail with sign in Id and password."
);

$.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "*Please add comment");

var Login = function() {


    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                userid: {
                    required: true
                },
                password: {
                    required: true
                }
            },

            messages: {
                userid: {
                    required: "User Id is required."
                },
                password: {
                    required: "Password is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('#enter').show();
            },

            highlight: function(element) { // hightlight error inputs
                $('#enter').show();
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                $('#enter').hide();
                $('#missmatch').hide();
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                //form.submit(); // form validation success, call ajax form submit

                $.ajax({
                    type:'POST',
                    url:'/loginVerify',
                    data:$(form).serialize(),

                    success:function(data){

                        if (data == "success") {
                            location.reload();
                        }else{
                            $('#missmatch').show();
                        }
                    }

                });
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleNewPass = function() {

        $('#newPassForm').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                newPass: {
                    required: true
                },
                newRePass: {
                    required: true,
                    equalTo: "#newPass"
                }
            },

            messages: {
                newPass: {
                    required: "New Password is required."
                },
                newRePass: {
                    equalTo: "Re-type the New Password."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit  
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                //form.submit(); // form validation success, call ajax form submit
                //alert("success");
                $.ajax({
                    type:'POST',
                    url:'/resetPassword',
                    data:$(form).serialize(),

                    success:function(data){
                        //console.log(data);
                        if (data == "success") {
                            alert("Your password Successfully changed");
                            window.location = '/login';
                        }else{
                            alert("You have already changed your password");
                            window.location = '/login';
                        }
                    }

                });
            }
        });

        $('#newPassForm input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#newPassForm').validate().form()) {
                    $('#newPassForm').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                user_id: {
                    required: true
                }
            },

            messages: {
                user_id: {
                    required: "User Id is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                //form.submit();
                //alert("success");
                $.ajax({
                    type:'GET',
                    url:'/resetPassEmail',
                    data:$(form).serialize(),

                    success:function(data){

                        if (data == "success") {
                            alert("Email has been sent to your email please check.");
                            window.location = '/login';
                        }else{
                            alert(data);;
                            window.location = '/login';
                        }
                    }

                });
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {


        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                name: {
                    required: true
                },
                id: {
                    required: true,
                    uniqueId: true
                },
                department: {
                    required: true
                },
                credit: {
                    required: true,
                    number: true
                },
                subject: {
                    required: true,
                    number: true
                },
                mobile: {
                    required: true,
                    number:true,
                    minlength:10,
                    maxlength:10
                },
                email: {
                    required: true,
                    email: true,
                    uniqueEmail: true
                },
            },

            messages: { // custom messages for radio buttons and checkboxes
                name: {
                    required: "Name is required."
                },
                id: {
                    required: "Id is required.",
                    pattern: "Valid ID format xx-xxxxx-x",
                },
                department: {
                    required: "Department is required."
                },
                credit: {
                    required: "Credit is required."
                },
                subject: {
                    required: "Subject is required."
                },
                mobile: {
                    required: "Mobile number is required."
                },
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                //form.submit();

                $.ajax({
                    type:'POST',
                    url:'/registrationStore',
                    data:$(form).serialize(),

                    success:function(data){

                        if (data == "success") {
                            swal({
                                icon: "success",
                                title: "Success!",
                                text: "Your registration was successfull please wait for admin verification email.",
                                type: "success"
                            }).then(function() {
                                window.location = "redirectURL";
                            });
                        }else{
                            alert(data);
                        }
                    },
                    error:function(data){
                        var errors = data.responseJSON.errors;
                        if (errors.id != null){
                            alert(errors.id[0]);
                            location.reload();
                        }
                      }
                });
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function() {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    var handleEvaluation = function() {

        $('#evaluation_form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                ans1: {
                    required: true
                },
                ans2: {
                    required: true
                },
                ans3: {
                    required: true
                },
                ans4: {
                    required: true
                },
                ans5: {
                    required: true
                },
                ans6: {
                    required: true
                },
                ans7: {
                    required: true
                },
                ans8: {
                    required: true
                },
                ans9: {
                    required: true
                },
                ans10: {
                    required: true
                },
                comment: {
                    required: true,
                    notEqual: "Write Comment here"
                },

            },

            messages: {
                ans1: {
                    required: "*Please add evaluation for above question."
                },
                ans2: {
                    required: "*Please add evaluation for above question."
                },
                ans3: {
                    required: "*Please add evaluation for above question."
                },
                ans4: {
                    required: "*Please add evaluation for above question."
                },
                ans5: {
                    required: "*Please add evaluation for above question."
                },
                ans6: {
                    required: "*Please add evaluation for above question."
                },
                ans7: {
                    required: "*Please add evaluation for above question."
                },
                ans8: {
                    required: "*Please add evaluation for above question."
                },
                ans9: {
                    required: "Please add evaluation for above question."
                },
                ans10: {
                    required: "*Please add evaluation for above question."
                },
                comment: {
                    required: "*Please add comment."
                },
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                //alert("error");
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                //error.insertAfter(element.closest('.input-icon'));
                error.insertAfter( element.parent() );
            },

            submitHandler: function(form) {
                //form.submit();
                //alert("success");
                $.ajax({
                    type:'POST',
                    url:'/addEvaluation',
                    data:$(form).serialize(),

                    success:function(data){

                        if (data == "success") {
                            alert("Your evaluation is successfully added, Thank you for your reply.");
                            window.location = '/';
                        }else{
                            alert(data);;
                            //window.location = '/login';
                        }
                    }

                });
            }
        });

        $('#evaluation_form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#evaluation_form').validate().form()) {
                    $('#evaluation_form').submit();
                }
                return false;
            }
        });

    }

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();
            handleForgetPassword();
            handleRegister();
            handleNewPass();
            handleEvaluation();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});