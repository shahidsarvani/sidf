<?php
$page = 'Companies Information';
$sub_page = 'Edit Company Information';
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
                    <h5 class="card-title">Edit Company Information</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/companies/edit.php' ?>" method="post" enctype="multipart/form-data" id="company-form">
                        <input type="hidden" name="id" value="<?php echo $company['id']; ?>" />
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company Token:</label>
                                    <select name="company_token_id" id="company_token_id" class="form-control">
                                        <option value="">Select Company Token</option>
                                        <?php
                                        foreach ($tokens as $token) :
                                        ?>
                                            <option value="<?php echo $token['id']; ?>" <?php echo $token['id'] == $company['company_token_id'] ? 'selected' : '' ?>><?php echo $token['name']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name (English):</label>
                                    <input type="text" name="name_eng" class="form-control" value="<?php echo $company['name_eng'] ?>" placeholder="Sabic" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name (Arabic):</label>
                                    <input type="text" name="name_ar" class="form-control" value="<?php echo $company['name_ar'] ?>" placeholder="سابك" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description (English):</label>
                                    <textarea name="info_eng" class="summernote" id="info_eng"><?php echo $company['info_eng'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description (Arabic):</label>
                                    <textarea name="info_ar" class="summernote" id="info_ar"><?php echo $company['info_ar'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="logo_error">
                            <label>Upload Logo:</label>
                            <input type="file" name="logo" class="file-input-overwrite-rfid-img" accept="image/*" data-show-preview="false" data-fouc>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" accept="video/*" data-fouc>
                        </div>
                        <input type="hidden" name="logo_key" id="logo_key" class="modal_media old-logo" data-error="#logo_error" value="<?php echo $logo['file_key']; ?>" data-value="<?php echo $items_config['rfid_media_url'] . $logo['name']; ?>" data-caption="<?php echo $logo['name']; ?>" data-key="<?php echo $logo['file_key']; ?>" data-size="<?php echo $logo['size']; ?>" data-type="<?php echo $logo['type']; ?>" data-filetype="<?php echo $logo['filetype']; ?>">
                        <input type="hidden" name="video_key" id="video_key" class="modal_media old-video" data-error="#video_error" value="<?php echo $video['file_key']; ?>" data-value="<?php echo $items_config['rfid_media_url'] . $video['name']; ?>" data-caption="<?php echo $video['name']; ?>" data-key="<?php echo $video['file_key']; ?>" data-size="<?php echo $video['size']; ?>" data-type="<?php echo $video['type']; ?>" data-filetype="<?php echo $video['filetype']; ?>">
                        <hr>
                        <h4>Icons</h4>

                        <div class="row sortable-card" id="items">

                            <?php
                            if ($icons) :
                                $i = 1;
                                foreach ($icons as $icon) :
                            ?>
                                    <div class="col-md-12 menu_item">
                                        <div class="card item_<?php echo $i ?>">
                                            <div class="card-header header-elements-inline">
                                                <h6 class="card-title">Icon <?php echo $i ?>:</h6>
                                                <div class="header-elements">
                                                    <div class="list-icons">
                                                        <a class="list-icons-item" data-action="move"></a>
                                                        <a class="list-icons-item" data-action="remove"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Title (English):</label>
                                                            <input type="text" name="title_eng[]" value="<?php echo $icon['title_eng'] ?>" class="form-control" placeholder="Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Title (Arabic):</label>
                                                            <input type="text" name="title_ar[]" value="<?php echo $icon['title_ar'] ?>" class="form-control" placeholder="العنوان">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Icon Class:</label>
                                                            <input type="text" name="icon[]" value="<?php echo $icon['icon'] ?>" class="form-control" placeholder="fa fa-car">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-info" id="add_icon">Add Icon<i class="icon-plus3 ml-2"></i></button>
                        </div>

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

        $('.file-input-overwrite-rfid-img').on('fileuploaded', logoUploaded);
        $('.file-input-overwrite-rfid-vid').on('fileuploaded', videoUploaded);

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
                logo_key: {
                    required: true,
                },
                video_key: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Enter token name",
                },
                logo_key: {
                    required: "Add logo",
                },
                video_key: {
                    required: "Add video",
                },
            },
        });


        $('#add_icon').click(function() {
            var length = ++$('.menu_item').length;
            const html = `<div class="col-md-12 menu_item">
                                <div class="card item_${length}">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title">Icon ${length}:</h6>
                                        <div class="header-elements">
                                            <div class="list-icons">
                                                <a class="list-icons-item" data-action="move"></a>
                                                <a class="list-icons-item" data-action="remove"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Title (English):</label>
                                                    <input type="text" name="title_eng[]" class="form-control" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Title (Arabic):</label>
                                                    <input type="text" name="title_ar[]" class="form-control" placeholder="العنوان">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Icon Class:</label>
                                                    <input type="text" name="icon[]" class="form-control" placeholder="fa fa-car">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            $('#items').append(html);
        })
        $(document).on('click', '.list-icons-item', function() {
            $(this).attr('data-action') === 'remove' && $(this).parents('.menu_item').remove();
        })
    })
</script>

</body>

</html>