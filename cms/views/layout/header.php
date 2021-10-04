<!-- Page header -->
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="<?php echo ADMIN_SITE_URL . '/controller/dashboard.php'; ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <?php
                if (isset($page)) :
                ?>
                    <span class="breadcrumb-item active"><?php echo $page; ?></span>
                <?php
                endif;
                if (isset($sub_page)) :
                ?>
                    <span class="breadcrumb-item active"><?php echo $sub_page; ?></span>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->