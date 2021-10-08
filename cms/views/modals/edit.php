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
                                    <label>Position:</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="">Select Position</option>
                                        <?php
                                        for ($i = 1; $i < 14; $i++) :
                                        ?>
                                            <option value="<?php echo $i; ?>" <?php echo $modal['position'] == $i ? 'selected' : ''; ?>>Position <?php echo $i; ?></option>
                                        <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="items">
                            <h6>Modal Carousel Items</h6>
                            <?php
                            foreach ($modal['items'] as $item) :
                            ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title English:</label>
                                            <input type="text" name="title_eng[]" class="form-control" value="<?php echo $item['title_eng'] ?>" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label>English Description:</label>
                                            <textarea name="text_eng[]" class="form-control" cols="30" rows="3"><?php echo $item['text_eng'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title Arabic:</label>
                                            <input type="text" name="title_ar[]" class="form-control" value="<?php echo $item['title_ar'] ?>" placeholder="العنوان">
                                        </div>
                                        <div class="form-group">
                                            <label>Arabic Description:</label>
                                            <textarea name="text_ar[]" class="form-control" cols="30" rows="3"><?php echo $item['text_ar'] ?></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="old_media[]" value="<?php echo $item['media']; ?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Upload Media:</label>
                                            <input type="file" name="media[]" class="form-input-styled">
                                        </div>
                                    </div>
                                </div>
                            <?php
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
    $(document).ready(function() {
        $('#navlink-modals').addClass('nav-item-open');
        $('#navlink-modals ul').css('display', 'block');
        $('#navlink-modals_index').addClass('active');

        $('.file-input-ajax2').on(
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

        $('#add_item').click(function() {
            const html = `<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title English:</label>
                                        <input type="text" name="title_eng[]" class="form-control" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label>English Description:</label>
                                        <textarea name="text_eng[]" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title Arabic:</label>
                                        <input type="text" name="title_ar[]" class="form-control" placeholder="العنوان">
                                    </div>
                                    <div class="form-group">
                                        <label>Arabic Description:</label>
                                        <textarea name="text_ar[]" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Media:</label>
                                        <input type="file" name="media[]" class="form-input-styled">
                                    </div>
                                </div>
                            </div>`
            $('#items').append(html);
            $(".form-input-styled").uniform();
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
                position: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Enter name",
                },
                position: {
                    required: "Select position",
                }
            },
        });
    })
</script>

</body>

</html>