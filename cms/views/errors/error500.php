<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ADMIN_ASSET ?>/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?php echo ADMIN_ASSET ?>/global_assets/js/main/jquery.min.js"></script>
    <script src="<?php echo ADMIN_ASSET ?>/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?php echo ADMIN_ASSET ?>/js/app.js"></script>
    <!-- /theme JS files -->

</head>

<body>


    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Container -->
                <div class="flex-fill">

                    <!-- Error title -->
                    <div class="text-center mb-3">
                        <h1 class="error-title">500</h1>
                        <h5><?php echo $_SESSION['error_msg']; ?></h5>
                    </div>
                    <!-- /error title -->


                    <!-- Error content -->
                    <div class="row">
                        <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">


                            <!-- Buttons -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i> Back</a>
                                </div>
                            </div>
                            <!-- /buttons -->

                        </div>
                    </div>
                    <!-- /error wrapper -->

                </div>
                <!-- /container -->

            </div>
            <!-- /content area -->


        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>

</html>