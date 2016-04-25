<?php
	require "autoloader.php";
	$error;
	if (isset($_GET['error'])) {
		$error = $_GET['error'];
	}
	$status;
	if (isset($_GET['status'])) {
		$status = $_GET['status'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>DRNK App</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login_style.css"/>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-xs-6 col-xs-offset-3" style="text-align: center;">
				<div class="col-xs-12 highlight">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class=""><font size=“11px">DRNK Business Account</font></h3>

						</div>
						<div class="panel-body">
							<div class="col-xs-6 right-border">
								<form action="submit_account_creation.php" method="POST">
									<div class="form-group">
										<h3>Create Account</h3>
									</div>
									<div class="form-group">
										<label for="email_creation">Email address</label>
										<input type="email" class="form-control" id="email" placeholder="Enter email" name="email_creation">
									</div>
									<div class="form-group">
										<label for="password_creation">Password</label>
										<input type="password" class="form-control" id="password_creation" placeholder="Password" name="password_creation">
									</div>
									<div class="form-group">
										<label for="password_creation_confirm">Confirm Password</label>
										<input type="password" class="form-control" id="password_creation_confirm" placeholder="Password" name="password_creation_confirm">
									</div>
										<button type="submit" class="btn btn-default">Create Account</button>
								</form>
							</div>
							<div class="col-xs-6">
								<form action="submit_login.php" method="POST">
									<div class="form-group">
										<h3>Sign in</h3>
									</div>
									<div class="form-group">
										<label for="email">Email address</label>
										<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control" id="password" placeholder="Password" name="password">
									</div>
										<button type="submit" class="btn btn-default">Login</button>
								</form>
							</div>
						</div>
							<div class="panel-footer">
							 	<p class="text-danger lead" style="display: inline; font-weight: bold;"><?php if (isset($error)) {echo $error;} ?></p>
							 	<p class="text-success lead" style="display: inline; font-weight: bold;"><?php if (isset($status)) {echo $status;} ?></p>
							</div>
					</div>
			</div>
		</div>
	</div>
</body>
</html>
<script src="bootstrap/js/bootstrap.js"></script>