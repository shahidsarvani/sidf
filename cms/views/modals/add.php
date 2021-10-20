<?php
$page = 'Modals';
$sub_page = 'Add Modal';
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
                    <h5 class="card-title">Add Modal</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/modals/add.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Modal 1" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Year:</label>
                                    <select name="timeline_item_id" id="timeline_item_id" class="form-control">
                                        <option value="">Select Year</option>
                                        <?php
                                        foreach ($timelines as $timeline) :
                                        ?>
                                            <option value="<?php echo $timeline['id']; ?>"><?php echo $timeline['title']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="items">
                            <!-- <h6>Modal Carousel Items</h6> -->
                            <div class="row carousel_item">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <h6>Carousel Item:</h6>
                                </div>
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
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-info" id="add_item">Add Item<i class="icon-plus3 ml-2"></i></button>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit <i class="icon-plus-circle2 ml-2"></i></button>
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
        $('#navlink-modals_add').addClass('active');

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
            // var count = ++$('#items').find('div.row').length;
            // console.log(count)
            const html = `<div class="row carousel_item">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Carousel Item:</h6>
                                    <button type="button" class="btn btn-danger remove_item"">Remove Item<i class="icon-trash ml-2"></i></button>
                                </div>
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

        $(document).on('click', '.remove_item', function() {
            $(this).parents('.carousel_item').remove();
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
                    required: "Select year",
                }
            },
        });
    })
</script>

</body>

</html>