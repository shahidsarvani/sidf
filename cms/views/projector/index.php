<?php
$page = 'Projector';
require ADMIN_VIEW . '/layout/header.php';
?>
<!-- Content area -->
<div class="content">
    <?php
    require ADMIN_VIEW . '/layout/alert.php';
    ?>
    <div class="w-75 justify-content-end d-flex mb-3 align-items-center ml-auto" style="gap: 1rem;">
        <input type="text" id="videoUrl" class="form-control" value="<?php echo isset($media['name']) ? $items_config['projector_media_url'] . $media['name'] : ''; ?>">
        <a type="button" style="width: 15rem;" id="copyVideoUrl" class="btn bg-green" href="javascript:void(0);">Copy video link<i class="icon-copy4 ml-2"></i></a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Projector Video</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo ADMIN_SITE_URL . '/controller/projector/add.php' ?>" method="post" enctype="multipart/form-data" id="screen-form">
                        <div class="form-group">
                            <label>Upload Media:</label>
                            <input type="file" name="video" class="file-input-projector-video" accept="video/*" data-fouc>
                        </div>

                        <div class="text-right">
                            <?php
                            if ($projector == false || $media == false) :
                            ?>
                                <button type="submit" class="btn btn-primary submitBtn">Add <i class="icon-plus-circle2 ml-2"></i></button>
                            <?php
                            else :
                            ?>
                                <button type="submit" class="btn btn-primary submitBtn">Update <i class="icon-pencil5 ml-2"></i></button>
                            <?php
                            endif;
                            ?>

                        </div>

                        <input type="hidden" name="media_id" class="old-projector-video" value="<?php echo $media['file_key'] ?? ''; ?>" data-value="<?php echo isset($media['name']) ? $items_config['projector_media_url'] . $media['name'] : ''; ?>" data-caption="<?php echo $media['name'] ?? ''; ?>" data-key="<?php echo $media['file_key'] ?? ''; ?>" data-size="<?php echo $media['size'] ?? ''; ?>" data-type="<?php echo $media['type'] ?? ''; ?>" data-filetype="<?php echo $media['filetype'] ?? ''; ?>">
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
        $('#navlink-projector').addClass('active');

        var swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        $('#copyVideoUrl').click(function(e) {
            e.preventDefault();
            copyVideoUrl();
        })

        function copyVideoUrl() {
            /* Get the text field */
            var copyText = document.getElementById("videoUrl");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            navigator.clipboard.writeText(copyText.value)
                .then(() => {
                    swalInit.fire({
                        text: "Copied the Video URL!",
                        type: 'success',
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-right'
                    });
                })
                .catch(() => {
                    swalInit.fire({
                        text: "Something went wrong!",
                        type: 'warning',
                        toast: true,
                        showConfirmButton: false,
                        position: 'top-right'
                    });
                });

            /* Alert the copied text */
            // alert("Copied the text: " + copyText.value);
            swalInit.fire({
                text: "Copied the Video URL!",
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        }

        function fireAlert() {
            swalInit.fire({
                text: 'File deleted successfuly!',
                type: 'success',
                toast: true,
                showConfirmButton: false,
                position: 'top-right'
            });
        }

        function filepreajax(event, previewId, index) {
            $('.submitBtn').addClass('disabled')
        }

        function videoUploaded(event, previewId, index, fileId) {
            $('.old-projector-video').val(fileId)
            $('.submitBtn').removeClass('disabled')
        }

        function videoDeleted(event, preview, config, tags, extraData) {
            $('.old-projector-video').removeAttr('value');
            $('#videoUrl').removeAttr('value');
            fireAlert()
        }

        $('.file-input-projector-video').on('filepreajax', filepreajax).on('fileuploaded', videoUploaded).on('filedeleted', videoDeleted);
    })
</script>

</body>

</html>