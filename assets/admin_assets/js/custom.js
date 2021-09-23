/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

/* ------------------------------------------------------------------------------
 *
 *  # Login form with validation
 *
 *  Demo JS code for login_validation.html page
 *
 * ---------------------------------------------------------------------------- */

// Setup module
// ------------------------------

var ComponentLoad = (function () {
  // Uniform
  var _componentUniform = function () {
    if (!$().uniform) {
      console.warn("Warning - uniform.min.js is not loaded.");
      return;
    }
    // Initialize
    $(".form-input-styled").uniform();
  };
  var _componentValidate = function () {
    if (!$().validate) {
      console.warn("Warning - validate.min.js is not loaded.");
      return;
    }
  };

  return {
    init: function () {
      _componentUniform();
      _componentValidate();
    },
  };
})();

var LoginValidation = (function () {
  // Validation config
  var _componentValidation = function () {
    // Initialize
    var validator = $("#login-form").validate({
      ignore: "input[type=hidden], .select2-search__field", // ignore hidden fields
      errorClass: "validation-invalid-label",
      successClass: "validation-valid-label",
      validClass: "validation-valid-label",
      highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },
      unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },
      // success: function(label) {
      //     label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
      // },
      submitHandler: function () {
        document.forms["login-form"].submit();
      },
      // Different components require proper error label placement
      errorPlacement: function (error, element) {
        // Unstyled checkboxes, radios
        if (element.parents().hasClass("form-check")) {
          error.appendTo(element.parents(".form-check").parent());
        }

        // Input with icons and Select2
        else if (
          element.parents().hasClass("form-group-feedback") ||
          element.hasClass("select2-hidden-accessible")
        ) {
          error.appendTo(element.parent());
        }

        // Input group, styled file input
        else if (
          element.parent().is(".uniform-uploader, .uniform-select") ||
          element.parents().hasClass("input-group")
        ) {
          error.appendTo(element.parent().parent());
        }

        // Other elements
        else {
          error.insertAfter(element);
        }
      },
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          minlength: 5,
        },
      },
      messages: {
        email: "Enter your email",
        password: {
          required: "Enter your password",
          minlength: jQuery.validator.format(
            "At least {0} characters required"
          ),
        },
      },
    });
  };

  return {
    init: function () {
      _componentValidation();
    },
  };
})();
var RegisterValidation = (function () {
  // Validation config
  var _componentValidation = function () {
    // Initialize
    var validator = $("#signup-form").validate({
      ignore: "input[type=hidden], .select2-search__field", // ignore hidden fields
      errorClass: "validation-invalid-label",
      successClass: "validation-valid-label",
      validClass: "validation-valid-label",
      highlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },
      unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass);
      },
      // success: function(label) {
      //     label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
      // },
      submitHandler: function () {
        document.forms["signup-form"].submit();
      },
      // Different components require proper error label placement
      errorPlacement: function (error, element) {
        // Unstyled checkboxes, radios
        if (element.parents().hasClass("form-check")) {
          error.appendTo(element.parents(".form-check").parent());
        }

        // Input with icons and Select2
        else if (
          element.parents().hasClass("form-group-feedback") ||
          element.hasClass("select2-hidden-accessible")
        ) {
          error.appendTo(element.parent());
        }

        // Input group, styled file input
        else if (
          element.parent().is(".uniform-uploader, .uniform-select") ||
          element.parents().hasClass("input-group")
        ) {
          error.appendTo(element.parent().parent());
        }

        // Other elements
        else {
          error.insertAfter(element);
        }
      },
      rules: {
        email: {
          email: true,
        },
        password: {
          minlength: 5,
        },
      },
      messages: {
        email: {
          required: "Enter your email",
          email: "Please enter a valid email address",
        },
        username: "Enter your username",
        password: {
          required: "Enter your password",
          minlength: jQuery.validator.format(
            "At least {0} characters required"
          ),
        },
      },
    });
  };

  return {
    init: function () {
      _componentValidation();
    },
  };
})();

// Initialize module
// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
  ComponentLoad.init();
  LoginValidation.init();
  RegisterValidation.init();
});
