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
                                    <input type="text" name="name_eng" class="form-control" value="<?php echo $company['name_eng'] ?>" placeholder="Sabic">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name (Arabic):</label>
                                    <input type="text" name="name_ar" class="form-control" value="<?php echo $company['name_ar'] ?>" placeholder="سابك">
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
                            <input type="file" name="logo" class="file-input-overwrite-rfid-img" accept="image/*" data-fouc>
                        </div>
                        <div class="form-group" id="video_error">
                            <label>Upload Video:</label>
                            <input type="file" name="video" class="file-input-overwrite-rfid-vid" accept="video/*" data-fouc>
                        </div>
                        <input type="hidden" name="logo_key" id="logo_key" class="modal_media old-logo" data-error="#logo_error" value="<?php echo isset($logo) ? $logo['file_key'] : ''; ?>" data-value="<?php echo isset($logo) ? $items_config['rfid_media_url'] . $logo['name'] : ''; ?>" data-caption="<?php echo isset($logo) ? $logo['name'] : ''; ?>" data-key="<?php echo isset($logo) ? $logo['file_key'] : ''; ?>" data-size="<?php echo isset($logo) ? $logo['size'] : ''; ?>" data-type="<?php echo isset($logo) ? $logo['type'] : ''; ?>" data-filetype="<?php echo isset($logo) ? $logo['filetype'] : ''; ?>">
                        <input type="hidden" name="video_key" id="video_key" class="modal_media old-video" data-error="#video_error" value="<?php echo isset($video) ? $video['file_key'] : ''; ?>" data-value="<?php echo isset($video) ? $items_config['rfid_media_url'] . $video['name'] : ''; ?>" data-caption="<?php echo isset($video) ? $video['name'] : ''; ?>" data-key="<?php echo isset($video) ? $video['file_key'] : ''; ?>" data-size="<?php echo isset($video) ? $video['size'] : ''; ?>" data-type="<?php echo isset($video) ? $video['type'] : ''; ?>" data-filetype="<?php echo isset($video) ? $video['filetype'] : ''; ?>">
                        <hr>
                        <h4>Icons</h4>

                        <div class="row sortable-card" id="items">

                            <?php
                            if ($icon_array) :
                                $i = 1;
                                foreach ($icon_array as $icon) :
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Title (English):</label>
                                                            <input type="text" name="title_eng[]" value="<?php echo $icon['title_eng'] ?>" class="form-control" placeholder="Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Title (Arabic):</label>
                                                            <input type="text" name="title_ar[]" value="<?php echo $icon['title_ar'] ?>" class="form-control" placeholder="العنوان">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Icon:</label>
                                                            <input type="file" name="icon[]" class="file-input-overwrite-rfid-icon" data-fouc>
                                                            <input type="hidden" class="old-icons" name="icon_key[]" value="<?php echo $icon['icon_detail']['file_key']; ?>" data-value="<?php echo $icon['icon_detail']['name'] != '' ? $items_config['rfid_media_url'] . $icon['icon_detail']['name'] : ''; ?>" data-caption="<?php echo $icon['icon_detail']['name']; ?>" data-key="<?php echo $icon['icon_detail']['file_key']; ?>" data-size="<?php echo $icon['icon_detail']['size']; ?>" data-type="<?php echo $icon['icon_detail']['type']; ?>" data-filetype="<?php echo $icon['icon_detail']['filetype']; ?>">
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
        $('#navlink-companies_index').addClass('active');

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

        function iconUploaded(event, previewId, index, fileId) {
            var hiddenInput = '<input type="hidden" name="icon_key[]" value="' + fileId + '" class="old-icons" >';
            $('#' + event.currentTarget.id).parents('.form-group').find('.old-icons').remove();
            $('#' + event.currentTarget.id).parents('.form-group').append(hiddenInput);
            $('#submitBtn').removeClass('disabled')
        }

        function logoDeleted(event, preview, config, tags, extraData) {
            $('#logo_key').removeAttr('value')
            fireAlert()
        }

        function videoDeleted(event, preview, config, tags, extraData) {
            $('#video_key').removeAttr('value')
            fireAlert()
        }

        function fileDeleted(event, preview, config, tags, extraData) {
            fireAlert()
        }
        
        function filepreajax(event, previewId, index) {
            $('#submitBtn').addClass('disabled')
        }

        $('.file-input-overwrite-rfid-img').on('fileuploaded', logoUploaded).on('filedeleted', logoDeleted).on('filepreajax', filepreajax);
        $('.file-input-overwrite-rfid-vid').on('fileuploaded', videoUploaded).on('filedeleted', videoDeleted).on('filepreajax', filepreajax);
        $('.file-input-overwrite-rfid-icon').on('fileuploaded', iconUploaded).on('filedeleted', fileDeleted).on('filepreajax', filepreajax);

        var validator = $("#company-form").validate({
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
                document.forms["company-form"].submit();
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
                company_token_id: {
                    required: true,
                },
                name_eng: {
                    required: true,
                },
                name_ar: {
                    required: true,
                },
                info_eng: {
                    required: true,
                },
                info_ar: {
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
                company_token_id: {
                    required: "Select Token",
                },
                name_eng: {
                    required: "Enter Name (eng)",
                },
                name_ar: {
                    required: "Enter Name (ar)",
                },
                info_eng: {
                    required: "Enter Description (eng)",
                },
                info_ar: {
                    required: "Enter Description (ar)",
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title (English):</label>
                                                    <input type="text" name="title_eng[]" class="form-control" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title (Arabic):</label>
                                                    <input type="text" name="title_ar[]" class="form-control" placeholder="العنوان">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Icon:</label>
                                                    <input type="file" name="icon[]" class="file-input-overwrite-rfid-icon" accept="image/*" data-show-preview="false" data-fouc>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            $('#items').append(html);
            init_fileinput();
        })

        function init_fileinput() {
            var fileInputElem = $("#items .menu_item").last().find('.file-input-overwrite-rfid-icon');
            console.log(fileInputElem)
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

            fileInputElem.fileinput({
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
                // initialPreview: initialPreview,
                // initialPreviewConfig: initialPreviewConfig,
                initialPreviewAsData: true,
                overwriteInitial: true,
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

            $('.file-input-overwrite-rfid-icon').on('fileuploaded', iconUploaded);
        }

        $(document).on('click', '.list-icons-item', function() {
            $(this).attr('data-action') === 'remove' && $(this).parents('.menu_item').remove();
        })
    })
</script>

</body>

</html>