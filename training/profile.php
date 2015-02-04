<?php
$user_details = array(
	'qualification' => 'Highest Qualification',
	'favorite_movie' => 'Favorite Movie',
		);
$user_details_values = array();

if(count($_SESSION['user_details']) > 0) {
	foreach($_SESSION['user_details'] as $k => $v) {
		$user_details_values[$v['key']] = $v['value'];
	}
}


?>
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
					<div class="col-md-4" style="">
						Hello <?php echo $_SESSION['user_info'][0]['username']; ?>  welcome to your dashboard
						<br />
						<a href="controller.php?action=logout">Logout</a>
						<br />
						<br />
						<br />
						<ul>
							<li>
								<a href="controller.php?action=dashboard">Dashboard</a>
							</li>
							<li>
								<a href="controller.php?action=update_profile">Update Profile</a>
							</li>
						</ul>
						<div class="well">
							<?php
							//echo date('Y/d/m', $_SESSION['user_info'][0]['dob']);
							$year = date('Y', $_SESSION['user_info'][0]['dob']);
							$month = date('m', $_SESSION['user_info'][0]['dob']);
							$day = date('d', $_SESSION['user_info'][0]['dob']);
							?>
							<form method="POST" action="controller.php?action=update" enctype="multipart/form-data">
								<input type="text" name="first_name" value="<?php echo $_SESSION['user_info'][0]['first_name']; ?>" placeholder="First Name" /> <br />
								<input type="text" name="last_name" value="<?php echo $_SESSION['user_info'][0]['last_name']; ?>" placeholder="Last Name" /> <br />
								<input type="file" name="image1" />
								<br />
								<select name="year">
									<?php
									for($i = 1960; $i <= date('Y')-18; $i++) {
										$selected = ($i == $year ? 'selected="selected"' : '');
									?>
									<option <?php echo $selected; ?> value="<?php echo $i ?>"><?php echo $i?></option><?php echo "\n";
									}
									?>
								</select>
								<select name="month">
									<?php
									for($i = 1; $i <= 12; $i++) {
										$mktime = mktime(1, 1, 1, $i, 1, 2015);
										$selected = ($i == $month ? 'selected="selected"' : '');
									?>
									<option <?php echo $selected; ?> value="<?php echo $i ?>"><?php echo date('F', $mktime); ?></option><?php echo "\n";
									}
									?>
								</select>
								<select name="day">
									<?php
									for($i = 1; $i <= 31 ; $i++) {
										$selected = ($i == $day ? 'selected="selected"' : '');
									?>
									<option <?php echo $selected; ?> value="<?php echo $i ?>"><?php echo $i?></option><?php echo "\n";
									}
									?>
								</select>
								<br />
								<input type="text" name="phone_number" value="<?php echo $_SESSION['user_info'][0]['phone_number']; ?>" placeholder="+91-987-654-3210" />
								<br />
								<?php
								if(count($user_details) > 0) {
									foreach($user_details as $k=>$v) {
										?>
										<input type="text" name="ud_<?php echo $k ?>" value="<?php echo $user_details_values[$k] ?>" placeholder="<?php echo $v; ?>" />
										<br />
										<?php
									}
								}
								?>
								<input type="submit" value="Update" class="btn btn-primary" />
							</form>
						</div>
						<style>
							input {
								margin: 5px;
							}
						</style>
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

