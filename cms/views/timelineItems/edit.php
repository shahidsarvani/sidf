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
                                    <select name="position" id="position" class="form-control">
                                        <option value="">Select Position</option>
                                        <?php
                                        for ($i = 1; $i < 14; $i++) :
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
                            <textarea name="text_eng" class="form-control" id="text_eng" cols="30" rows="3"><?php echo $timeline['text_eng'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Arabic Description:</label>
                            <textarea name="text_ar" class="form-control" id="text_ar" cols="30" rows="3"><?php echo $timeline['text_ar'] ?></textarea>
                        </div>

                        <!-- <div class="form-group">
                            <label>Upload Images:</label>
                            <input type="file" name="images" class="file-input-overwrite" multiple="multiple" data-fouc>
                        </div> -->

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update <i class="icon-pencil5 ml-2"></i></button>
                        </div>
                        <?php
                        // foreach ($screen['media'] as $media) :
                        ?>
                            <!-- <input type="hidden" name="file_keys[]" class="old-images" value="<?php echo USER_ASSET . '/images/' . $media['name']; ?>" data-caption="<?php echo $media['name']; ?>" data-key="<?php echo $media['file_key']; ?>" data-size="<?php echo $media['size']; ?>"> -->
                        <?php
                        // endforeach;
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
        $('#navlink-timelineItems').addClass('nav-item-open');
        $('#navlink-timelineItems ul').css('display', 'block');
        $('#navlink-timelineItems_index').addClass('active');

        $('.file-input-overwrite').on(
            "filebatchuploadcomplete",
            function(event, preview, config, tags, extraData) {
                console.log(config);
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
            }
        );

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