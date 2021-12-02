<?php
$page = 'Sections';
require ADMIN_VIEW . '/layout/header.php'; ?>
<!-- Content area -->
<div class="content">
<?php require ADMIN_VIEW . '/layout/alert.php'; ?>
    <div class="w-100 text-right mb-3">
        <button type="button" class="btn bg-brown" id="get_json" data-href="<?php echo ADMIN_SITE_URL . '/controller/sections/get_json.php' ?>">Create JSON File<i class="icon-file-download2 ml-2"></i></button>
        <!--<a type="button" class="btn bg-green" href="<?php //echo ADMIN_SITE_URL . '/controller/sections/add.php' ?>">Add Section <i class="icon-plus-circle2 ml-2"></i></a>-->
    </div>
    <div class="row">
        <div class="card w-100">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Section Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr> 
                                <th width="7%"> # </th> 
								<th width="13%"> Title (En) </th>
								<th width="13%"> Title (Ar) </th>
								<th width="10%"> Slug </th>
								<th width="8%"> Order </th>
								<th width="12%"> Bg Video </th>
                                <th width="9%"> Status </th>
                                <th width="13%"> Updated On </th>
                                <th width="8%"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						$sr_no = 1;
						if(isset($rows)){
                            foreach($rows as $row){ ?>
							 	<tr>
									<td> <?php echo $sr_no; ?> </td> 
									<td> <?php echo $row['en_title']; ?> </td>
                                    <td> <?php echo $row['ar_title']; ?> </td>
									<td> <?php echo $row['slug']; ?> </td>
                                    <td> <?php echo $row['sort_order']; ?> </td>
                                    <td> <?php echo $row['bg_video']; ?> </td>
									<td> <?php echo ($row['status'] == 1) ? 'Active' : 'Inactive'; ?> </td>
                                    <td> <?php echo date('d-M-Y H:i:s', strtotime($row['updated_on'])); ?> </td>
                                    <td>
                                        <div class="list-icons"> <a href="<?php echo ADMIN_SITE_URL . '/controller/sections/edit.php?id=' . $row['id'] ?>" class="list-icons-item text-primary-600"> <i class="icon-pencil7"></i></a> 
                                        </div>
                                    </td>
                                </tr>
                            <?php
								$sr_no++;
                            }
						}else{ ?>
							<tr>
								<td colspan="9" style="text-align:center"> <strong> No record found! </strong></td>
							</tr>
						
						<?php } ?> 
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
        $('#navlink-sectionItems').addClass('nav-item-open');
        $('#navlink-sectionItems ul').css('display', 'block');
        $('#navlink-sectionItems_index').addClass('active');


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
                                    return fetch(admin_url + '/controller/download_json.php?name=sections.json')
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
                                            a.download = 'sections.json';
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
                },
                error: function(result) {
                    console.log(result.responseText);
                    swalInit.fire({
                        title: 'Error!',
                        text: 'JSON file is not created.',
                        type: 'error'
                    })
                }
            })
        })
    })
</script>

</body>

</html>