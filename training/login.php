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
					<div class="col-md-4">
						<form action="controller.php?action=login" method="POST">
							<input type="text" name="login" placeholder="Login" />
							<br />
							<input type="password" name="password" placeholder="Password" />
							<br />
							<input type="submit" name="submit" value="Submit" />
						</form>
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