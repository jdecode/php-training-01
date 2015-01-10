<!DOCTYPE html>
<html>
	<head>
		<title>
			Test Form 1
		</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/custom.css" rel="stylesheet" />

		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/custom.js"></script>
	</head>
	<body>
		<div class="row border">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-1"></div>
					<div class="col-md-1"></div>
					<div class="col-md-1"></div>
					<div class="col-md-4" style="color:green;">
						Hello <?php echo $_SESSION['user_info'][0]['username']; ?>  welcome to your dashboard
						<br />
						<a href="controller.php?action=logout">Logout</a>

					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<!--
			<div class="col-md-2">Two</div>
			<div class="col-md-3">Three</div>
			<div class="col-md-4">Four</div>
			<div class="col-md-5">Five</div>
			<div class="col-md-6">Six</div>
			-->
		</div>
	</body>
</html>

