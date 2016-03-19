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
          required: true,
          equalTo: "#signupPassword"
        },
        title: "required",
        name: "required",
        phoneNumber: {
          required: true
        },
        addressLine1: {
          required: true
        },
        postal: {
          required: true
        },
        faculty: {
          required: true
        },
        agreeTerms: "required"
      },
      messages: {
        username: {
          required: "The email address field cannot be empty.",
          email: "The email address you entered is not valid."
        },
        signupPassword: {
          required: "The password field cannot be empty.",
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16."
        },
        confirmPassword: {
          required: "The password field cannot be empty.",
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16.",
          equalTo: "The confirm password you entered doesn't match the password above."
        },
        agreeTerms: "You must confirm that you have read and agree to the Terms & Conditions."
      }
    });
    
    $('#add_fa_form').validate({
      rules: {
        facilityImageFile: {
          required: true,
          accept: "image/jpg, image/jpeg, image/pjpeg, image/png"
        },
        facility_name: {
          maxlength: 50
        }
      },
      messages: {
        facilityImageFile: {
          required: "You forget to select an image for this facility.",
          accept: "Only image types of JPG, JPEG, PNG and PJPEG are accepted."
        },
        facility_name: {
          maxlength: "The maximum name length is 50."
        }
      }
    });

    $('#profile_form').validate({
      rules: {
        newPassword: {
          minlength: 6,
          maxlength: 16
        },
        confirmNewPass: {
          minlength: 6,
          maxlength: 16,
          equalTo: "#newPassword"
        }
      },
      messages: {
        newPassword: {
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16."
        },
        confirmNewPass: {
          minlength: "The minimum password length is 6.",
          maxlength: "The maximum password length is 16.",
          equalTo: "The confirm password you entered doesn't match the password above."
        }
      }
    });
});


