<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Signup - SIDF</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/colors.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ADMIN_ASSET ?>/css/custom.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?php echo ADMIN_ASSET ?>/js/app.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/js/custom.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content register-cover">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form login-form" action="<?php echo ADMIN_SITE_URL . '/controller/register.php' ?>" method="post" id="signup-form">
					<?php if (isset($errors)) : ?>
						<div class="alert alert-danger border-0 alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">
								<span>×</span>
							</button>
							<?php echo $errors; ?>
						</div>
					<?php endif; ?>
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Create account</h5>
								<span class="d-block text-muted">All fields are required</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="email" class="form-control" placeholder="Email" required>
								<div class="form-control-feedback">
									<i class="icon-mention text-muted"></i>
								</div>
							</div>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="username" class="form-control" placeholder="Username" required>
								<div class="form-control-feedback">
									<i class="icon-user-check text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<span class="px-2">Already have an account?</span>
							</div>

							<div class="form-group">
								<a href="<?php echo ADMIN_SITE_URL . '/controller/login.php' ?>" class="btn btn-light btn-block">Login</a>
							</div>

						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

</html>