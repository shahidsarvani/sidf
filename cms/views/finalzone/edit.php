<?php
$page = 'Final Zone Screens';
$sub_page = 'Edit Final Zone Screen';
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
                    <h5 class="card-title">Edit Final Zone Screen</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/finalzone/edit.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <input type="hidden" name="id" value="<?php echo $screen['id']; ?>" />
                        <div class="form-group">
                            <label>Screen Name:</label>
                            <input type="text" name="name" value="<?php echo $screen['name']; ?>" class="form-control" placeholder="Screen 1" disabled>
                        </div>
                        <div class="form-group">
                            <label>Upload Logo Image:</label>
                            <input type="file" name="logo" id="logo" accept="image/*" class="form-input-styled" value="<?php echo $screen['logo'] ?>" data-fouc>
                            <span><?php echo $screen['logo'] != '' ? '(' . $screen['logo'] . ')' : '' ?></span>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" data-fouc>
                        </div>
                        <input type="hidden" name="video_key" id="video_key" class="modal_media old-video" data-error="#video_error" value="<?php echo isset($video) ? $video['file_key'] : ''; ?>" data-value="<?php echo isset($video) ? $items_config['finalzone_video_media_url'] . $video['name'] : ''; ?>" data-caption="<?php echo isset($video) ? $video['name'] : ''; ?>" data-key="<?php echo isset($video) ? $video['file_key'] : ''; ?>" data-size="<?php echo isset($video) ? $video['size'] : ''; ?>" data-type="<?php echo isset($video) ? $video['type'] : ''; ?>" data-filetype="<?php echo isset($video) ? $video['filetype'] : ''; ?>">
                        <div class="text-right">
                            <button type="submit" id="submitBtn" class="btn btn-primary">Update <i class="icon-pencil5 ml-2"></i></button>
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

        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        function fireAlert() {
            swalInit.fire({
                text: 'File deleted successfuly!',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        }

        function videoDeleted(event, preview, config, tags, extraData) {
            $('#video_key').removeAttr('value')
            fireAlert()
        }

        function videoUploaded(event, previewId, index, fileId) {
            $('#video_key').val(fileId)
            $('#video_key-error').css('display', 'none');
            $('#submitBtn').removeClass('disabled')
        }

        function filepreajax(event, previewId, index) {
            $('#submitBtn').addClass('disabled')
        }

        $('.file-input-overwrite-rfid-vid').on('fileuploaded', videoUploaded).on('filedeleted', videoDeleted).on('filepreajax', filepreajax);

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
                //if element has data-error attr to show error msg somewhere else
                else if (element.attr('data-error')) {
                    var id = element.attr('data-error')
                    $(id).append(error)
                    // console.log(element.attr('data-error'));
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
                // name: {
                //     required: true,
                // },
                logo: {
                    required: function(e) {
                        var logo = $(e).parent().siblings('span').html();
                        if (logo.length > 0) {
                            return false
                        }
                        return true
                    },
                },
                video_key: {
                    required: true,
                },
            },
            messages: {
                // name: {
                //     required: "Enter screen name",
                // },
                logo: {
                    required: "Upload Logo (light)",
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