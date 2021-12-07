<?php
$page = 'Tokens';
$sub_page = 'Add Token';
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
                    <h5 class="card-title">Add Token</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/tokens/add.php' ?>" method="post" enctype="multipart/form-data" id="token-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Token Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Sabic" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Card ID:</label>
                                    <input type="text" name="rfid_card_id" class="form-control" placeholder="Card ID" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="logo_error">
                            <label>Upload Logo:</label>
                            <input type="file" name="logo" class="file-input-overwrite-rfid-img" accept="image/*" data-show-preview="false" data-fouc>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Token Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" accept="video/*" data-fouc>
                        </div>
                        <div class="form-group" id="loader_video_error">
                            <label>Upload Preloader Video:</label>
                            <input type="file" name="loader_video" class="file-input-overwrite-rfid-loadervid" accept="video/*" data-fouc>
                        </div>
                        <input type="hidden" name="logo_key" id="logo_key" class="modal_media" data-error="#logo_error">
                        <input type="hidden" name="video_key" id="video_key" class="modal_media" data-error="#video_error">
                        <input type="hidden" name="loader_video_key" id="loader_video_key" class="modal_media" data-error="#loader_video_error">

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Add <i class="icon-plus-circle2 ml-2"></i></button>
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

        function logoUploaded(event, previewId, index, fileId) {
            console.log('File uploaded', previewId, index, fileId);
            $('#logo_key').val(fileId)
            $('#logo_key-error').css('display', 'none');
        }

        function videoUploaded(event, previewId, index, fileId) {
            console.log('File uploaded', previewId, index, fileId);
            $('#video_key').val(fileId)
            $('#video_key-error').css('display', 'none');
        }

        function loadervideoUploaded(event, previewId, index, fileId) {
            console.log('File uploaded', previewId, index, fileId);
            $('#loader_video_key').val(fileId)
            $('#loader_video_key-error').css('display', 'none');
        }

        $('.file-input-overwrite-rfid-img').on('fileuploaded', logoUploaded);
        $('.file-input-overwrite-rfid-vid').on('fileuploaded', videoUploaded);
        $('.file-input-overwrite-rfid-loadervid').on('fileuploaded', loadervideoUploaded);

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
                    required: "Enter Card ID",
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