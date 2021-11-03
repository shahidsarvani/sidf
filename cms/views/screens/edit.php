<?php
$page = 'Screens';
$sub_page = 'Edit Screen';
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
                    <h5 class="card-title">Edit Screen</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/screens/edit.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <input type="hidden" name="id" value="<?php echo $screen['id']; ?>" />
                        <div class="form-group">
                            <label>Screen Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Screen 1" value="<?php echo $screen['name'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Images:</label>
                            <input type="file" name="images" id="file-input-overwrite" class="file-input-overwrite" multiple="multiple" data-fouc>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update <i class="icon-pencil5 ml-2"></i></button>
                        </div>
                        <?php
                        foreach ($screen['media'] as $media) :
                        ?>
                            <input type="hidden" name="file_keys[]" class="old-images" value="<?php echo $media['file_key']; ?>" data-value="<?php echo $items_config['images_url'] . $media['name']; ?>" data-caption="<?php echo $media['name']; ?>" data-key="<?php echo $media['file_key']; ?>" data-size="<?php echo $media['size']; ?>" data-type="<?php echo $media['type']; ?>" data-filetype="<?php echo $media['filetype']; ?>">
                        <?php
                        endforeach;
                        ?>
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
        $('#navlink-screens').addClass('nav-item-open');
        $('#navlink-screens ul').css('display', 'block');
        $('#navlink-screens_index').addClass('active');

        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        $('.file-input-overwrite')
            .on("filebatchuploadcomplete", function(event, preview, config, tags, extraData) {
                console.log(config);
                const atts = [{
                    'key': 'type',
                    'value': 'hidden'
                }, {
                    'key': 'name',
                    'value': 'file_keys[]'
                }, {
                    'key': 'class',
                    'value': 'old-images'
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
            })
            .on('filesorted', function(event, params) {
                console.log(params);
                console.log('File sorted ', params.previewId, params.oldIndex, params.newIndex, params.stack);
                $('.old-images').remove();
                var stack = params.stack;
                const atts = [{
                    'key': 'type',
                    'value': 'hidden'
                }, {
                    'key': 'name',
                    'value': 'file_keys[]'
                }, {
                    'key': 'class',
                    'value': 'old-images'
                }];
                stack.forEach(function(file) {
                    var input = document.createElement('input');
                    atts.forEach(function(value, index) {
                        var att = document.createAttribute(value.key);
                        att.value = value.value;
                        input.setAttributeNode(att);
                    })
                    input.value = file.key;
                    $('#screen-form').append(input);
                })
            })
            .on('filebeforedelete', function(event, previewId) {
                console.log(previewId);
                return new Promise(function(resolve, reject) {
                    swalInit.fire({
                            type: 'warning',
                            title: 'Confirmation!',
                            text: 'Are you sure you want to delete this file?',
                            showCancelButton: true,
                            confirmButtonText: '<i class="icon-trash mr-2"></i> Yes',
                            confirmButtonClass: 'btn btn-danger',
                            showLoaderOnConfirm: true,
                        })
                        .then(function(result) {
                            console.log(result);
                            if (result.value) {
                                resolve();
                                var old_images = document.querySelectorAll('.old-images')
                                old_images.forEach(function(image) {
                                    if(image.dataset.key == previewId) {
                                        image.remove();
                                        // console.log(image)
                                    }
                                })
                            }
                        });
                });
            })
            .on('filedeleted', function(event, preview, config, tags, extraData) {
                setTimeout(function() {
                    swalInit.fire({
                        title: 'File deleted successfuly!',
                    });
                }, 200);
            });;

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
            },
            messages: {
                name: {
                    required: "Enter screen name",
                },
            },
        });
    })
</script>

</body>

</html>