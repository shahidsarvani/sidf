<?php
$page = 'Timeline Items';
$sub_page = 'Edit Timeline Item';
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
                    <h5 class="card-title">Edit Timeline Item</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/timelineItems/edit.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <input type="hidden" name="id" value="<?php echo $timeline['id']; ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Title:</label>
                                    <input type="text" name="title" class="form-control" placeholder="1978" value="<?php echo $timeline['title'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position:</label>
                                    <!-- <input type="hidden" name="position" value="<?php echo $timeline['position'] ?>"> -->
                                    <select id="position" class="form-control" name="position">
                                        <option value="">Select Position</option>
                                        <?php
                                        for ($i = 1; $i < 16; $i++) :
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $i == $timeline['position'] ? 'selected' : '' ?>>Position <?php echo $i; ?></option>
                                        <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>English Description:</label>
                            <textarea name="text_eng" class="summernote" id="text_eng"><?php echo $timeline['text_eng'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Arabic Description:</label>
                            <textarea name="text_ar" class="summernote" id="text_ar"><?php echo $timeline['text_ar'] ?></textarea>
                        </div>

                        <div class="form-group" <?php echo $timeline['position'] == '9' ? '' : 'style="display: none;"' ?>>
                            <label>Upload Image:</label>
                            <input type="file" name="image" class="form-input-styled" id="image" accept="image/*">
                            <span>(<?php echo $timeline['image'] ?>)</span>
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
        $('#navlink-timelineItems').addClass('nav-item-open');
        $('#navlink-timelineItems ul').css('display', 'block');
        $('#navlink-timelineItems_index').addClass('active');

        $('#position').change(function() {
            var value = $(this).val();
            if (value == '9') {
                $('#image').attr('required', 'required').parents('.form-group').fadeIn('slow');
            } else {
                $('#image').attr('required', '').parents('.form-group').fadeOut('slow');
            }
        })

        function filepreajax(event, previewId, index) {
            $('#submitBtn').addClass('disabled')
        }

        $('.file-input-overwrite').on(
            "filebatchuploadcomplete",
            function(event, preview, config, tags, extraData) {
                const atts = [{
                    'key': 'type',
                    'value': 'hidden'
                }, {
                    'key': 'name',
                    'value': 'file_keys[]'
                }];
                $('.old-images').remove();
                config.forEach(function(file) {
                    var input = document.createElement('input');
                    atts.forEach(function(value, index) {
                        var att = document.createAttribute(value.key);
                        att.value = value.value;
                        input.setAttributeNode(att);
                    })
                    input.value = file.key;
                    $('#screen-form').append(input);
                })
                $('#submitBtn').removeClass('disabled')
            }
        ).on('filepreajax', filepreajax);

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
                title: {
                    required: true,
                },
                position: {
                    required: true,
                },
                text_eng: {
                    required: true,
                },
                text_ar: {
                    required: true,
                },
                image: {
                    required: function() {
                        return $('#position').val() == 9;
                    }
                }
            },
            messages: {
                title: {
                    required: "Enter title",
                },
                position: {
                    required: 'Select position',
                },
                text_eng: {
                    required: 'Enter English description',
                },
                text_ar: {
                    required: 'Enter Arabic description',
                },
                image: {
                    required: 'Select an image file'
                }
            },
        });
    })
</script>

</body>

</html>