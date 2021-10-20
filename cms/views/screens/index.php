<?php
$page = 'Screens';
require ADMIN_VIEW . '/layout/header.php';
?>
<!-- Content area -->
<div class="content">
    <?php
    require ADMIN_VIEW . '/layout/alert.php';
    ?>
    <div class="w-100 text-right mb-3">
        <button type="button" class="btn bg-brown" id="get_json" data-href="<?php echo ADMIN_SITE_URL . '/controller/screens/get_json.php' ?>">Create JSON File<i class="icon-file-download2 ml-2"></i></button>
        <!-- <a type="button" class="btn bg-green" href="<?php echo ADMIN_SITE_URL . '/controller/screens/add.php' ?>">Add Screen<i class="icon-plus-circle2 ml-2"></i></a> -->
    </div>
    <style>
        .item {
            height: 400px;
        }

        img.img-fluid {
            height: 100%;
            object-fit: cover;
        }
    </style>
    <div class="row">
        <?php
        foreach ($all_screens as $screen) :
        ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title"><?php echo $screen['name'] ?></h6>
                    </div>

                    <div class="card-img-actions">
                        <div class="owl-carousel owl-theme">
                            <?php
                            foreach ($screen['media'] as $media) :
                            ?>
                                <div class="item">
                                    <img class="img-fluid" src="<?php echo USER_ASSET . '/images/' . $media['name'] ?>" alt="">
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent d-flex justify-content-lg-end justify-content-center">

                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a type="button" href="<?php echo ADMIN_SITE_URL . '/controller/screens/edit.php?id=' . $screen['id'] ?>" class="btn btn-info rounded-round">Edit<i class="icon-pencil ml-2"></i></a>
                            </li>
                            <!-- <li class="list-inline-item">
                                <a type="button" href="<?php echo ADMIN_SITE_URL . '/controller/screens/delete.php?id=' . $screen['id'] ?>" class="btn btn-danger rounded-round">Delete<i class="icon-trash ml-2"></i></a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
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

        $('#get_json').click(function() {
            $.ajax({
                url: $(this).attr('data-href'),
                method: 'GET',
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 1) {
                        swalInit.fire({
                                type: 'success',
                                title: 'Your JSON file is ready to Download!',
                                showCancelButton: true,
                                confirmButtonText: '<i class="icon-file-download2 mr-2"></i> Download JSON file',
                                confirmButtonClass: 'btn btn-success',
                                showLoaderOnConfirm: true,
                                preConfirm: function(login) {
                                    return fetch(admin_url + '/controller/download_json.php?name=screens.json')
                                        .then(function(response) {
                                            console.log(response);
                                            if (!response.ok) {
                                                throw new Error(response.statusText)
                                            }
                                            return response.blob();
                                        }).then(function(blob) {
                                            const url = window.URL.createObjectURL(blob);
                                            const a = document.createElement('a');
                                            a.style.display = 'none';
                                            a.href = url;
                                            a.download = 'screens.json';
                                            document.body.appendChild(a);
                                            a.click();
                                            window.URL.revokeObjectURL(url);
                                        })
                                        .catch(function(error) {
                                            swalInit.showValidationMessage(
                                                'Request failed: ' + error
                                            );
                                        });
                                },
                                allowOutsideClick: false
                            })
                            .then(function(result) {
                                console.log(result);
                                //     if (result.value) {
                                //         swalInit.fire({
                                //             title: 'File Downloaded',
                                //         });
                                //     }
                            });
                    } else {
                        swalInit.fire({
                            title: 'Error!',
                            text: 'JSON file is not created.',
                            type: 'error'
                        })
                    }
                }
            })
        })
    })
</script>

</body>

</html>