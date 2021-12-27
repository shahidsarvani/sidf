<?php
$page = 'Tokens';
$sub_page = 'Edit Token';
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
                    <h5 class="card-title">Edit Token</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/tokens/edit.php' ?>" method="post" enctype="multipart/form-data" id="token-form">
                        <input type="hidden" name="id" value="<?php echo $token['id']; ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Token Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Token Name" value="<?php echo $token['name'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sort Order:</label>
                                    <input type="text" name="sort_order" class="form-control" placeholder="Sort Order" value="<?php echo $token['sort_order'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Card ID 1:</label>
                                    <input type="text" name="rfid_card_id" class="form-control" placeholder="Card ID 1" value="<?php echo $token['rfid_card_id'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Card ID 2:</label>
                                    <input type="text" name="rfid_card_id2" class="form-control" placeholder="Card ID 2" value="<?php echo $token['rfid_card_id2'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="logo_error">
                            <label>Upload Logo:</label>
                            <input type="file" name="logo" class="file-input-overwrite-rfid-img" accept="image/*" data-fouc>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Token Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" accept="video/*" data-fouc>
                        </div>
                        <div class="form-group" id="loader_video_error">
                            <label>Upload Preloader Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-loadervid" accept="video/*" data-fouc>
                        </div>
                        <input type="hidden" name="logo_key" id="logo_key" class="modal_media old-logo" data-error="#logo_error" value="<?php echo $logo['file_key'] ?? ''; ?>" data-value="<?php echo isset($logo['name']) ? $items_config['rfid_media_url'] . $logo['name'] : ''; ?>" data-caption="<?php echo $logo['name'] ?? ''; ?>" data-key="<?php echo $logo['file_key'] ?? ''; ?>" data-size="<?php echo $logo['size'] ?? ''; ?>" data-type="<?php echo $logo['type'] ?? ''; ?>" data-filetype="<?php echo $logo['filetype'] ?? ''; ?>">
                        <input type="hidden" name="video_key" id="video_key" class="modal_media old-video" data-error="#video_error" value="<?php echo $video['file_key'] ?? ''; ?>" data-value="<?php echo isset($video['name']) ? $items_config['rfid_media_url'] . $video['name'] : ''; ?>" data-caption="<?php echo $video['name'] ?? ''; ?>" data-key="<?php echo $video['file_key'] ?? ''; ?>" data-size="<?php echo $video['size'] ?? ''; ?>" data-type="<?php echo $video['type'] ?? ''; ?>" data-filetype="<?php echo $video['filetype'] ?? ''; ?>">
                        <input type="hidden" name="loader_video_key" id="loader_video_key" class="modal_media old-loader-video" data-error="#loader_video_error" value="<?php echo $loader_video['file_key'] ?? ''; ?>" data-value="<?php echo isset($loader_video['name']) ? $items_config['rfid_loadermedia_url'] . $loader_video['name'] : ''; ?>" data-caption="<?php echo $loader_video['name'] ?? ''; ?>" data-key="<?php echo $loader_video['file_key'] ?? ''; ?>" data-size="<?php echo $loader_video['size'] ?? ''; ?>" data-type="<?php echo $loader_video['type'] ?? ''; ?>" data-filetype="<?php echo $loader_video['filetype'] ?? ''; ?>">

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
        $('#navlink-tokens').addClass('nav-item-open');
        $('#navlink-tokens ul').css('display', 'block');
        $('#navlink-tokens_add').addClass('active');

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

        function logoUploaded(event, previewId, index, fileId) {
            $('#logo_key').val(fileId)
            $('#logo_key-error').css('display', 'none');
            $('#submitBtn').removeClass('disabled')
        }

        function videoUploaded(event, previewId, index, fileId) {
            $('#video_key').val(fileId)
            $('#video_key-error').css('display', 'none');
            $('#submitBtn').removeClass('disabled')
        }

        function loadervideoUploaded(event, previewId, index, fileId) {
            $('#loader_video_key').val(fileId)
            $('#loader_video_key-error').css('display', 'none');
            $('#submitBtn').removeClass('disabled')
        }

        function logoDeleted(event, preview, config, tags, extraData) {
            $('#logo_key').removeAttr('value');
            fireAlert()
        }

        function videoDeleted(event, preview, config, tags, extraData) {
            $('#video_key').removeAttr('value');
            fireAlert()
        }

        function loadervideoDeleted(event, preview, config, tags, extraData) {
            $('#loader_video_key').removeAttr('value');
            fireAlert()
        }
        
        function filepreajax(event, previewId, index) {
            $('#submitBtn').addClass('disabled')
        }

        $('.file-input-overwrite-rfid-img').on('filepreajax', filepreajax).on('fileuploaded', logoUploaded).on('filedeleted', logoDeleted);
        $('.file-input-overwrite-rfid-vid').on('filepreajax', filepreajax).on('fileuploaded', videoUploaded).on('filedeleted', videoDeleted);
        $('.file-input-overwrite-rfid-loadervid').on('filepreajax', filepreajax).on('fileuploaded', loadervideoUploaded).on('filedeleted', loadervideoDeleted);

        var validator = $("#token-form").validate({
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
                document.forms["token-form"].submit();
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
                rfid_card_id: {
                    required: true,
                },
                rfid_card_id2: {
                    required: true,
                },
                sort_order: {
                    required: true,
                },
                logo_key: {
                    required: true,
                },
                video_key: {
                    required: true,
                },
                loader_video_key: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Enter token name",
                },
                rfid_card_id: {
                    required: "Enter Card ID 1",
                },
                rfid_card_id2: {
                    required: "Enter Card ID 2",
                },
                sort_order: {
                    required: "Enter Sort order",
                },
                logo_key: {
                    required: "Add logo",
                },
                video_key: {
                    required: "Add token video",
                },
                loader_video_key: {
                    required: "Add preloader video",
                },
            },
        });
    })
</script>

</body>

</html>