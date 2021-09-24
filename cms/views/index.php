<?php
$page = 'Dashboard';
require ADMIN_VIEW.'/layout/header.php';
?>
<!-- Content area -->
<div class="content">

<h4>Admin Dashboard</h4>

</div>
<!-- /content area -->
<?php
require ADMIN_VIEW.'/layout/footer.php';
?>

<script>
    $(document).ready(function() {
        $('#navlink-dashboard').addClass('active');
    })
</script>

</body>

</html>