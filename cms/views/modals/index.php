<?php
$page = 'Modals';
require ADMIN_VIEW . '/layout/header.php';
?>
<!-- Content area -->
<div class="content">
    <?php
    require ADMIN_VIEW . '/layout/alert.php';
    ?>
    <div class="w-100 text-right mb-3">
        <button type="button" class="btn bg-brown" id="get_json" data-href="<?php echo ADMIN_SITE_URL . '/controller/modals/get_json.php' ?>">Create JSON File<i class="icon-file-download2 ml-2"></i></button>
        <!-- <a type="button" class="btn bg-green" href="<?php echo ADMIN_SITE_URL . '/controller/modals/add.php' ?>">Add Modal<i class="icon-plus-circle2 ml-2"></i></a> -->
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Modals</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($modals as $item) :
                            ?>
                                <tr>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['slug']; ?></td>
                                    <td>
                                        <div class="list-icons">
                                            <a href="<?php echo ADMIN_SITE_URL . '/controller/modals/edit.php?id=' . $item['id'] ?>" class="list-icons-item text-primary-600"><i class="icon-pencil7"></i></a>
                                            <!-- <a href="<?php echo ADMIN_SITE_URL . '/controller/modals/delete.php?id=' . $item['id'] ?>" class="list-icons-item text-danger-600"><i class="icon-trash"></i></a> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
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
                                    return fetch(admin_url + '/controller/download_json.php?name=modals.json')
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
                                            a.download = 'modals.json';
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