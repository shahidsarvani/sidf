<?php
$page = 'Final Zone Screens';
$sub_page = 'Add Final Zone Screen';
require ADMIN_VIEW . '/layout/header.php';
?>
<!-- Content area -->
<div class="content">
    <?php
    require ADMIN_VIEW . '/layout/alert.php';
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Add Screen</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/finalzone/add.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <div class="form-group">
                            <label>Screen Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Screen 1" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Logo Image (Light):</label>
                                    <input type="file" name="logo_white" accept="image/*" class="form-input-styled" data-fouc>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Logo Image (Dark):</label>
                                    <input type="file" name="logo_black" accept="image/*" class="form-input-styled" data-fouc>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" data-fouc>
                        </div>
                        <input type="hidden" name="video_key" id="video_key" class="modal_media" data-error="#video_error">

                        <div class="text-right">
                            <button type="submit" id="submitBtn" class="btn btn-primary">Add <i class="icon-plus-circle2 ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
<?php
require ADMIN_VIEW . '/layout/footer.php';
?>

<script>
    $(document).ready(function() {
        $('#navlink-finalzone').addClass('active');

        $('.file-input-overwrite-rfid-vid').on('fileuploaded', videoUploaded).on('filepreajax', filepreajax);

        function videoUploaded(event, previewId, index, fileId) {
            $('#video_key').val(fileId)
            $('#video_key-error').css('display', 'none');
            $('#submitBtn').removeClass('disabled')
        }

        function filepreajax(event, previewId, index) {
            $('#submitBtn').addClass('disabled')
        }

        var validator = $("#screen-form").validate({
            ignore: ".select2-search__field", // ignore hidden fields
            errorClass: "validation-invalid-label",
            successClass: "validation-valid-label",
            validClass: "validation-valid-label",
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            submitHandler: function() {
                document.forms["screen-form"].submit();
            },
            // Different components require proper error label placement
            errorPlacement: function(error, element) {
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
                //if element has data-error attr to show error msg somewhere else
                else if (element.attr('data-error')) {
                    var id = element.attr('data-error')
                    $(id).append(error)
                    // console.log(element.attr('data-error'));
                }
                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: {
                    required: true,
                },
                logo_white: {
                    required: true,
                },
                logo_black: {
                    required: true,
                },
                video_key: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Enter screen name",
                },
                logo_white: {
                    required: "Upload Logo (light)",
                },
                logo_black: {
                    required: "Upload Logo (dark)",
                },
                video_key: {
                    required: "Upload video",
                },
            },
        });
    })
</script>

</body>

</html>