<?php if (isset($errors) || isset($_SESSION['errors'])) : ?>
    <div class="alert alert-danger border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <?php echo $errors ?? ''; ?>
        <?php echo $_SESSION['errors'] ?? ''; ?>
    </div>
<?php endif; ?>
<?php if (isset($success) || isset($_SESSION['success'])) : ?>
    <div class="alert alert-success border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <?php echo $success ?? ''; ?>
        <?php echo $_SESSION['success'] ?? ''; ?>
    </div>
<?php endif; ?>