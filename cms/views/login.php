<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - SIDF</title>

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
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/global_assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="<?php echo ADMIN_ASSET ?>/js/app.js"></script>
	<script src="<?php echo ADMIN_ASSET ?>/js/custom.js"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Page content -->
	<div class="page-content login-cover">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form login-form" action="<?php echo ADMIN_SITE_URL . '/controller/login.php' ?>" method="post" id="login-form">
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
								<i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>
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

							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
										Remember
									</label>
								</div>

								<!-- <a href="login_password_recover.html" class="ml-auto">Forgot password?</a> -->
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<span class="px-2">Don't have an account?</span>
							</div>

							<div class="form-group">
								<a href="<?php echo ADMIN_SITE_URL . '/controller/register.php' ?>" class="btn btn-light btn-block">Sign up</a>
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