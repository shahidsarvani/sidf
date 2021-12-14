<?php
$page = 'Modals';
$sub_page = 'Edit Modal';
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
                    <h5 class="card-title">Edit Modal</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/modals/edit.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <input type="hidden" name="id" value="<?php echo $modal['id']; ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Modal 1" value="<?php echo $modal['name'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Year:</label>
                                    <select name="timeline_item_id" id="timeline_item_id" class="form-control" disabled>
                                        <option value="">Select Year</option>
                                        <?php
                                        foreach ($timelines as $timeline) :
                                        ?>
                                            <option value="<?php echo $timeline['id']; ?>" <?php echo $modal['timeline_item_id'] == $timeline['id'] ? 'selected' : ''; ?>><?php echo $timeline['title']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Carousel Items</h4>
                        <div class="row sortable-card" id="items">
                            <!-- <h6>Modal Carousel Items</h6> -->
                            <?php
                            $i = 1;
                            foreach ($modal['items'] as $item) :
                            ?>
                                <div class="col-md-12 carousel_item pre_added">
                                    <div class="card item_<?php echo $i ?>">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">Item <?php echo $i ?>:</h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                    <a class="list-icons-item" data-action="move"></a>
                                                    <a class="list-icons-item" data-action="remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title English:</label>
                                                        <input type="text" name="title_eng[]" class="form-control" value="<?php echo $item['title_eng'] ?>" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title Arabic:</label>
                                                        <input type="text" name="title_ar[]" class="form-control" value="<?php echo $item['title_ar'] ?>" placeholder="العنوان">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>English Description:</label>
                                                        <textarea name="text_eng[]" class="summernote" cols="30" rows="3"><?php echo $item['text_eng'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Arabic Description:</label>
                                                        <textarea name="text_ar[]" class="summernote" cols="30" rows="3"><?php echo $item['text_ar'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="old-images-modal" name="old_media_id[]" value="<?php echo $item['media_id']; ?>" data-value="<?php echo isset($item['detail']['name']) ? $items_config['modal_media_url'] . $item['detail']['name'] : '' ?>" data-caption="<?php echo $item['detail']['name'] ?? ''; ?>" data-key="<?php echo $item['detail']['file_key'] ?? ''; ?>" data-size="<?php echo $item['detail']['size'] ?? ''; ?>" data-type="<?php echo $item['detail']['type'] ?? ''; ?>" data-filetype="<?php echo $item['detail']['filetype'] ?? ''; ?>">
                                                <label>Upload Media:</label>
                                                <input type="file" name="media[]" class="file-input-overwrite-modal" data-fouc>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-info" id="add_item">Add Item<i class="icon-plus3 ml-2"></i></button>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update <i class="icon-pencil5 ml-2"></i></button>
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
    function fileUploaded(event, previewId, index, fileId) {
        console.log('File uploaded', previewId, index, fileId);
        // var hiddenInput = '<input type="hidden" name="old_media_id[]" value="' + fileId + '" class="modal_media" >';
        console.log($(this))
        console.log(event.currentTarget);
        $('#' + event.currentTarget.id).parents('.form-group').find('.modal_media').val(fileId);
    }
    $(document).ready(function() {
        $('#navlink-modals').addClass('nav-item-open');
        $('#navlink-modals ul').css('display', 'block');
        $('#navlink-modals_index').addClass('active');

        $('.file-input-overwrite-modal').on('fileuploaded', fileUploaded);

        $('#add_item').click(function() {
            var length = ++$('.carousel_item').length;
            const html = `<div class="col-md-12 carousel_item">
                                    <div class="card item_${length}">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">Item ${length}:</h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                    <a class="list-icons-item" data-action="move"></a>
                                                    <a class="list-icons-item" data-action="remove"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title English:</label>
                                                        <input type="text" name="title_eng[]" class="form-control" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title Arabic:</label>
                                                        <input type="text" name="title_ar[]" class="form-control" placeholder="العنوان">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>English Description:</label>
                                                        <textarea name="text_eng[]" class="summernote" cols="30" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Arabic Description:</label>
                                                        <textarea name="text_ar[]" class="summernote" cols="30" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="old_media_id[]" class="modal_media" >
                                                <label>Upload Media:</label>
                                                <input type="file" name="media[]" class="file-input-overwrite-modal" data-fouc>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
            $('#items').append(html);
            init_fileinput();
            init_summernote();
        })

        $(document).on('click', '.card [data-action=remove]', function() {
            $(this).parents('.carousel_item').remove();
        })
        $(document).on('click', '.card [data-action=collapse]:not(.disabled)', function(e) {
            var $target = $(this),
                slidingSpeed = 150;
            if ($target.parents('.pre_added').get(0) === undefined) {
                e.preventDefault();
                $target.parents('.card').toggleClass('card-collapsed');
                $target.toggleClass('rotate-180');
                $target.closest('.card').children('.card-header').nextAll().slideToggle(slidingSpeed);
            }
        })

        var validator = $("#screen-form").validate({
            ignore: "input[type=hidden], .select2-search__field", // ignore hidden fields
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

                // Other elements
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                name: {
                    required: true,
                },
                timeline_item_id: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Enter name",
                },
                timeline_item_id: {
                    required: "Select Year",
                }
            },
        });

        function init_fileinput() {
            var fileInputElem = $("#items .carousel_item").last().find('.file-input-overwrite-modal');
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

            $('.file-input-overwrite-modal').on('fileuploaded', fileUploaded);
        }

        function init_summernote() {
            var summernoteElem = $("#items .carousel_item").last().find('.summernote');

            summernoteElem.summernote({
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']]
                ]
            });
        }
    })
</script>

</body>

</html>