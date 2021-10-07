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
  var _componentFileUpload = function () {
    if (!$().fileinput) {
      console.warn("Warning - fileinput.min.js is not loaded.");
      return;
    }
  };
  var _componentOwlCarousel = function () {
    if (!$().owlCarousel) {
      console.warn("Warning - owl.carousel.js is not loaded.");
      return;
    }
  };
  var _componentSweetAlert = function () {
    if (typeof swal == 'undefined') {
      console.warn('Warning - sweet_alert.min.js is not loaded.');
      return;
    }
  };

  return {
    init: function () {
      _componentUniform();
      _componentValidate();
      _componentFileUpload();
      _componentOwlCarousel();
      _componentSweetAlert();
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
var ImageAddUpload = (function () {
  // Bootstrap file upload
  var _componentImageAddUpload = function () {
    // Modal template
    var modalTemplate =
      '<div class="modal-dialog modal-lg" role="document">\n' +
      '  <div class="modal-content">\n' +
      '    <div class="modal-header align-items-center">\n' +
      '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
      '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
      "    </div>\n" +
      '    <div class="modal-body">\n' +
      '      <div class="floating-buttons btn-group"></div>\n' +
      '      <div class="kv-zoom-body file-zoom-content"></div>\n' +
      "{prev} {next}\n" +
      "    </div>\n" +
      "  </div>\n" +
      "</div>\n";

    // Buttons inside zoom modal
    var previewZoomButtonClasses = {
      toggleheader: "btn btn-light btn-icon btn-header-toggle btn-sm",
      fullscreen: "btn btn-light btn-icon btn-sm",
      borderless: "btn btn-light btn-icon btn-sm",
      close: "btn btn-light btn-icon btn-sm",
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
      prev: '<i class="icon-arrow-left32"></i>',
      next: '<i class="icon-arrow-right32"></i>',
      toggleheader: '<i class="icon-menu-open"></i>',
      fullscreen: '<i class="icon-screen-full"></i>',
      borderless: '<i class="icon-alignment-unalign"></i>',
      close: '<i class="icon-cross2 font-size-base"></i>',
    };

    $(".file-input-ajax").fileinput({
      browseLabel: "Browse",
      uploadUrl: "upload_images.php", // server upload action
      enableResumableUpload: true,
      maxFileCount: 5,
      maxFileSize: 15360,
      initialPreviewAsData: true,
      allowedFileTypes: ["image"],
      overwriteInitial: true,
      autoOrientImage: false,
      // initialPreview: [],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      fileActionSettings: {
        removeIcon: '<i class="icon-bin"></i>',
        removeClass: "",
        uploadIcon: '<i class="icon-upload"></i>',
        uploadClass: "",
        zoomIcon: '<i class="icon-zoomin3"></i>',
        zoomClass: "",
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess:
          '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
      },
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate,
      },
      initialCaption: "No file selected",
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      // deleteUrl: "file_delete.php"
    });
  };

  return {
    init: function () {
      _componentImageAddUpload();
    },
  };
})();
var ImageEditUpload = (function () {
  // Bootstrap file upload
  var _componentImageEditUpload = function () {

    var initialPreview = [];
    var initialPreviewConfig = [];
    var images = document.querySelectorAll('.old-images');
    images.forEach(function (image) {
      initialPreview.push(image.value);
      initialPreviewConfig.push({
        caption: image.dataset.caption,
        key: image.dataset.key,
        size: image.dataset.size,
        url: '{$url}',
      })
    })

    // Modal template
    var modalTemplate =
      '<div class="modal-dialog modal-lg" role="document">\n' +
      '  <div class="modal-content">\n' +
      '    <div class="modal-header align-items-center">\n' +
      '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
      '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
      "    </div>\n" +
      '    <div class="modal-body">\n' +
      '      <div class="floating-buttons btn-group"></div>\n' +
      '      <div class="kv-zoom-body file-zoom-content"></div>\n' +
      "{prev} {next}\n" +
      "    </div>\n" +
      "  </div>\n" +
      "</div>\n";

    // Buttons inside zoom modal
    var previewZoomButtonClasses = {
      toggleheader: "btn btn-light btn-icon btn-header-toggle btn-sm",
      fullscreen: "btn btn-light btn-icon btn-sm",
      borderless: "btn btn-light btn-icon btn-sm",
      close: "btn btn-light btn-icon btn-sm",
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
      prev: '<i class="icon-arrow-left32"></i>',
      next: '<i class="icon-arrow-right32"></i>',
      toggleheader: '<i class="icon-menu-open"></i>',
      fullscreen: '<i class="icon-screen-full"></i>',
      borderless: '<i class="icon-alignment-unalign"></i>',
      close: '<i class="icon-cross2 font-size-base"></i>',
    };

    $('.file-input-overwrite').fileinput({
      browseLabel: 'Browse',
      uploadUrl: "upload_images.php", // server upload action
      enableResumableUpload: true,
      maxFileCount: 5,
      maxFileSize: 15360,
      initialPreviewAsData: true,
      autoOrientImage: false,
      allowedFileTypes: ["image"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      fileActionSettings: {
        // removeIcon: '<i class="icon-bin"></i>',
        // removeClass: "",
        // uploadIcon: '<i class="icon-upload"></i>',
        // uploadClass: "",
        zoomIcon: '<i class="icon-zoomin3"></i>',
        zoomClass: "",
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess:
          '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
      },
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreview,
      initialPreviewConfig: initialPreviewConfig,
      overwriteInitial: true,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons
    });
  };

  return {
    init: function () {
      _componentImageEditUpload();
    },
  };
})();
var OwlCarousel = (function () {
  // Owl Carousel
  var _componentOwlCarousel = function () {
    $('.owl-carousel').owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      animateOut: 'fadeOut',
      items: 1,
      navText: [
        `<img src="${user_asset}/img/arrow_left.svg">`,
        `<img src="${user_asset}/img/arrow_right.svg">`,
      ]
    })
  };

  return {
    init: function () {
      _componentOwlCarousel();
    },
  };
})();

// Initialize module
// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
  ComponentLoad.init();
  LoginValidation.init();
  RegisterValidation.init();
  ImageAddUpload.init();
  ImageEditUpload.init();
  OwlCarousel.init();
});
