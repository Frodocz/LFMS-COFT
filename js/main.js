$(document).ready(function(){
    //toggle the tooltip to show tips when a href or button is hovered
    $('[data-toggle="tooltip"]').tooltip();

    //popup a confirmation clock to ask user whether or not delete an item
    $('.confirmationDelete').on('click', function () {
        return confirm('Are you sure you want to delete this?');
    });

    $.validator.setDefaults({
      highlight: function(element) {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
      },
      unhighlight: function(element) {
        var id_attr = "#" + $( element ).attr("id") + "1";
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');         
      },
      errorElement: 'span',
      errorClass: 'help-block',
      errorPlacement: function(error, element) {
        if(element.length) {
          error.insertAfter(element);
        } else {
          error.insertAfter(element);                  
        }
      } 
    });
    $('#login_form').validate({
      rules: {
        username: {
          required: true,
          email: true
        },
        loginPassword: {
          minlength: 6,
          maxlength: 16,
          required: true
        }
      },
      messages: {
        username: {
          required: "The email address field cannot be empty.",
          email: "The email address you entered is not valid."
        },
        loginPassword: {
          required: "The password field cannot be empty.",
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16."
        },
        confirmPassword: {
          minlength: 6,
          maxlength: 16,
          required: true,

        },
        title: {

        },
        name: {

        },
        phoneNumber: {

        },
        addressLine1: {

        },
        postal: {

        },
        faculty: {

        }
      },
    });
    $('#signup_form').validate({
      rules: {
        username: {
          required: true,
          email: true
        },
        signupPassword: {
          minlength: 6,
          maxlength: 16,
          required: true
        },
        confirmPassword: {
          minlength: 6,
          maxlength: 16,
          required: true
        },
        title: {

        },
        name: {

        },
        phoneNumber: {

        },
        addressLine1: {

        },
        postal: {

        },
        faculty: {

        },
        // 'facility_access[]': {
        //   required: true,
        //   minlength: 1
        // }
      },
      messages: {
        username: {
          required: "The email address field cannot be empty.",
          email: "The email address you entered is not valid."
        },
        loginPassword: {
          required: "The password field cannot be empty.",
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16."
        },
        // 'facility_access[]': {
        //   required: "",
        //   minlength: "Please check at least {0} option."
        // }
      },
    });


});


