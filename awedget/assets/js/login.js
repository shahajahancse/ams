$(document).ready(function() {
   $.validator.addMethod("noSpace", function(value, element) { 
      return value.indexOf(" ") < 0 && value != ""; 
   }, "No space please and don't leave it empty");

   $('#registration_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         full_name: {
            required: true
         },
         day: {
            required: true
         },
         month: {
            required: true
         },
         year: {
            required: true
         },
         identity: {
            required: true, 
            noSpace: true,
            minlength: 3,
            remote: {
               url: hostname +"registration/ajax_exists_identity/",
               type: "post",
               data: {
                  inputData: function() {
                     return $( "#identity" ).val();
                  }
               }
            }         
         },   
         phone:{
            required: true,
            number: true,
            minlength: 11,
            maxlength: 11
         },
         gender: {
            required: true
         },
         password: {
            required: true,
            minlength: 8
         },
         password_confirm: {
            required: true,                
            equalTo: "#password-field"
         },
      },

      messages: {
         full_name: "Enter you full name required.",
         identity: {
            required: "Enter email or username required.",
            minlength: jQuery.format("Enter at least {0} characters"),
            remote: jQuery.format("Already in use! Please try again.")
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight
      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         form.submit(); 
      }
   });

   $('#login_validate').validate({
      // focusInvalid: false, 
      ignore: "",
      rules: {
         identity: {
            required: true
         },
         password: {
            required: true,
            minlength: 6
         }
      },

      invalidHandler: function (event, validator) {
         //display error alert on form submit    
      },

      errorPlacement: function (label, element) { // render error placement for each input type   
         $('<span class="error" style="position: absolute; top:38px;"></span>').insertAfter(element).append(label)
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('success-control').addClass('error-control');
      },

      highlight: function (element) { // hightlight error inputs
         var parent = $(element).parent();
         parent.removeClass('success-control').addClass('error-control'); 
      },

      unhighlight: function (element) { // revert the change done by hightlight
      },

      success: function (label, element) {
         var parent = $(element).parent('.input-with-icon');
         parent.removeClass('error-control').addClass('success-control'); 
      },

      submitHandler: function (form) {
         form.submit(); 
      }
   });

   $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
         input.attr("type", "text");
      }else {
         input.attr("type", "password");
      }
   });

   $(".toggle-password-confirm").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
         input.attr("type", "text");
      }else {
         input.attr("type", "password");
      }
   });


});   
