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

var Profile = function() {

	var handleProfile = function() {


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
                    minlength:11,
                    maxlength:11
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
                    required: "Id is required."
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
                            alert("Your registration was successfull please wait for admin verification email");
                            location.reload();
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

    var handlePassword = function() {

        $('#changePass').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block col-md-offset-4 col-md-7', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                oldPass: {
                    required: true
                },
                newPass: {
                    required: true
                },
                newRePass: {
                	required: true,
                    equalTo: "#newPass"
                }
            },

            messages: {
                oldPass: {
                    required: "Old Password is required."
                },
                newPass: {
                    required: "New Password is required."
                },
                newRePass: {
                    equalTo: "Enter new password again."
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

                $('#userId').val($('#user_id').val());

                $.ajax({
                    type:'POST',
                    url:'/updatePassword',
                    data:$(form).serialize(),

                    success:function(data){

                        if (data == "success") {
                            alert("Password changed successfully");
                            document. getElementById("changePass"). reset();
                        }else{
                            alert("Password update failed");
                            window.location = '/logout';
                        }
                    }

                });
            }
        });

        $('#changePass input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#changePass').validate().form()) {
                    $('#changePass').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    
    return {
        //main function to initiate the module
        init: function() {

            handleProfile();
            handlePassword();

        }

    };

}();

jQuery(document).ready(function() {
    Profile.init();
});