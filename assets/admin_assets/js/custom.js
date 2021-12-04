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
  var _componentSummernote = function () {
    if (!$().summernote) {
      console.warn('Warning - summernote.min.js is not loaded.');
      return;
    }
  }
  var _componentSortable = function () {
    if (!$().sortable) {
      console.warn('Warning - jquery_ui.js components are not loaded.');
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
      _componentSummernote();
      _componentSortable();
    },
  };
})();

var LoginValidation = (function () {
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
      submitHandler: function () {
        document.forms["login-form"].submit();
      },
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
  var _componentValidation = function () {
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
  var _componentImageAddUpload = function () {
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

    var previewZoomButtonClasses = {
      toggleheader: "btn btn-light btn-icon btn-header-toggle btn-sm",
      fullscreen: "btn btn-light btn-icon btn-sm",
      borderless: "btn btn-light btn-icon btn-sm",
      close: "btn btn-light btn-icon btn-sm",
    };

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
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
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
    $(".file-input-ajax2").fileinput({
      browseLabel: "Browse",
      uploadUrl: "upload_media.php", // server upload action
      enableResumableUpload: true,
      maxFileCount: 5,
      initialPreviewAsData: true,
      allowedFileTypes: ["image", "video"],
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
  var _componentImageEditUpload = function () {

    var initialPreview = [];
    var initialPreviewConfig = [];
    var images = document.querySelectorAll('.old-images');
    images.forEach(function (image, index) {
      initialPreview.push(image.dataset.value);
      initialPreviewConfig.push({
        caption: image.dataset.caption,
        size: parseInt(image.dataset.size),
        key: image.dataset.key,
        filetype: image.dataset.filetype,
        type: image.dataset.type,
        url: 'media_delete.php',
      })
    })
    console.log(initialPreviewConfig)
    console.log(initialPreview)
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
      autoOrientImage: false,
      allowedFileTypes: ["image", "video"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreview,
      initialPreviewConfig: initialPreviewConfig,
      initialPreviewAsData: true,
      overwriteInitial: false,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      fileActionSettings: {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
      },
      deleteUrl: "media_delete.php"
    });
    $('.file-input-overwrite-modal').fileinput({
      browseLabel: 'Browse',
      uploadUrl: "upload_media.php", // server upload action
      enableResumableUpload: true,
      autoOrientImage: false,
      allowedFileTypes: ["image", "video"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreview,
      initialPreviewConfig: initialPreviewConfig,
      initialPreviewAsData: true,
      overwriteInitial: false,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      fileActionSettings: {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
      },
      deleteUrl: "media_delete.php"
    });
  };

  return {
    init: function () {
      _componentImageEditUpload();
    },
  };
})();
var ImageUploadToken = (function () {
  var _componentImageUploadToken = function () {

    var initialPreviewLogo = [];
    var initialPreviewConfigLogo = [];
    var initialPreviewVideo = [];
    var initialPreviewConfigVideo = [];
    var initialPreviewLoaderVideo = [];
    var initialPreviewConfigLoaderVideo = [];
    var logo = document.querySelector('.old-logo');
    var video = document.querySelector('.old-video');
    var loader_video = document.querySelector('.old-loader-video');
    if(logo) {
      initialPreviewLogo.push(logo.dataset.value);
      initialPreviewConfigLogo.push({
        caption: logo.dataset.caption,
        size: parseInt(logo.dataset.size),
        key: logo.dataset.key,
        filetype: logo.dataset.filetype,
        type: logo.dataset.type,
        url: 'media_delete.php',
      })
    }
    if(video) {
        initialPreviewVideo.push(video.dataset.value);
        initialPreviewConfigVideo.push({
          caption: video.dataset.caption,
          size: parseInt(video.dataset.size),
          key: video.dataset.key,
          filetype: video.dataset.filetype,
          type: video.dataset.type,
          url: 'media_delete.php',
        })
    }
    if(loader_video) {
        initialPreviewLoaderVideo.push(loader_video.dataset.value);
        initialPreviewConfigLoaderVideo.push({
          caption: loader_video.dataset.caption,
          size: parseInt(loader_video.dataset.size),
          key: loader_video.dataset.key,
          filetype: loader_video.dataset.filetype,
          type: loader_video.dataset.type,
          url: 'media_delete.php',
        })
    }
    console.log(initialPreviewConfigLogo)
    console.log(initialPreviewLogo)
    console.log(initialPreviewConfigVideo)
    console.log(initialPreviewVideo)
    console.log(initialPreviewConfigLoaderVideo)
    console.log(initialPreviewLoaderVideo)
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

    $('.file-input-overwrite-rfid-img').fileinput({
      browseLabel: 'Browse',
      uploadUrl: "upload_media.php", // server upload action
      enableResumableUpload: true,
      autoOrientImage: false,
      allowedFileTypes: ["image"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreviewLogo,
      initialPreviewConfig: initialPreviewConfigLogo,
      initialPreviewAsData: true,
      overwriteInitial: false,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      fileActionSettings: {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
      },
      deleteUrl: "media_delete.php"
    });
    $('.file-input-overwrite-rfid-vid').fileinput({
      browseLabel: 'Browse',
      uploadUrl: "upload_media.php", // server upload action
      enableResumableUpload: true,
      autoOrientImage: false,
      allowedFileTypes: ["video"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreviewVideo,
      initialPreviewConfig: initialPreviewConfigVideo,
      initialPreviewAsData: true,
      overwriteInitial: false,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      fileActionSettings: {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
      },
      deleteUrl: "media_delete.php"
    });
    $('.file-input-overwrite-rfid-loadervid').fileinput({
      browseLabel: 'Browse',
      uploadUrl: "upload_media.php", // server upload action
      enableResumableUpload: true,
      autoOrientImage: false,
      allowedFileTypes: ["video"],
      browseIcon: '<i class="icon-file-plus mr-2"></i>',
      uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
      removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
      layoutTemplates: {
        icon: '<i class="icon-file-check"></i>',
        modal: modalTemplate
      },
      initialPreview: initialPreviewLoaderVideo,
      initialPreviewConfig: initialPreviewConfigLoaderVideo,
      initialPreviewAsData: true,
      overwriteInitial: false,
      previewZoomButtonClasses: previewZoomButtonClasses,
      previewZoomButtonIcons: previewZoomButtonIcons,
      fileActionSettings: {
        zoomClass: '',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'p-2',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: '',
        removeErrorClass: 'text-danger',
        removeIcon: '<i class="icon-bin"></i>',
        indicatorNew: '<i class="icon-file-plus text-success"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
      },
      deleteUrl: "media_delete.php"
    });
  };

  return {
    init: function () {
      _componentImageUploadToken();
    },
  };
})();
var OwlCarousel = (function () {
  var _componentOwlCarousel = function () {
    var owl = $('.owl-carousel');

    owl.owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      video: true,
      animateOut: 'fadeOut',
      lazyLoad: true,
      items: 1,
      navText: [
        `<img src="${user_asset}/img/arrow_left.svg">`,
        `<img src="${user_asset}/img/arrow_right.svg">`,
      ],
      onInitialized: initialized,
      onTranslated: translated,
    })
    function translated(e) {
      var i = e.currentTarget;
      // var item = $(i).find('.owl-item.active .img-fluid')
      $(i).find('.owl-item video').each(function (index, value) {
        this.pause();
        this.currentTime = 0;
      });
      $(i).find('.owl-item.active video').each(function (index, value) {
        this.play();
      });
    }
    function initialized(e) {
      var i = e.currentTarget;
      var item = $(i).find('.owl-item.active .img-fluid')
      if (item[0].nodeName == 'VIDEO') {
        item[0].play()
      }
    }

  };

  return {
    init: function () {
      _componentOwlCarousel();
    }
  };
})();
var Summernote = function () {
  var _componentSummernote = function () {
    $('.summernote').summernote({
      toolbar: [
        ['style', ['style', 'bold', 'italic', 'clear']],
        ['para', ['paragraph']]
      ]
    });
  };
  return {
    init: function () {
      _componentSummernote();
    }
  }
}();
var CardsDraggable = function () {
  var _componentSortable = function () {
    $('.sortable-card').sortable({
      connectWith: '.card-sortable',
      items: '.card',
      helper: 'original',
      cursor: 'move',
      revert: 100,
      containment: '.content-wrapper',
      forceHelperSize: true,
      placeholder: 'sortable-placeholder',
      forcePlaceholderSize: true,
      tolerance: 'pointer',
      start: function (e, ui) {
        ui.placeholder.height(ui.item.outerHeight());
      },
      update: function (e, ui) {
        console.log(ui);
      }
    });
  };

  return {
    init: function () {
      _componentSortable();
    }
  }
}();

// Initialize module
// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
  ComponentLoad.init();
  LoginValidation.init();
  RegisterValidation.init();
  ImageAddUpload.init();
  ImageEditUpload.init();
  ImageUploadToken.init();
  OwlCarousel.init();
  Summernote.init();
  CardsDraggable.init();
});
