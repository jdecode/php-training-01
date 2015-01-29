<?php

require_once 'classes/config.php';
require_once 'classes/class.utility.php';
require_once 'classes/class.mysql.php';
session_start();


$mysql = new mysql();

$action = utility::check_var('action', true);

switch ($action) {
	case 'login':
		
		// Check if the user is logged in
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;
		if($logged_in) {
			// If logged in already, take the user to dashboard page, instead of showing the login screen
			header('Location:controller.php?action=dashboard');
		}

		// This will come up only if the user is not already logged in
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$login = utility::check_var('login');
			$password = sha1(utility::check_var('password'));
			//echo "Login: $login<br />Password: $password<br />";
			$_condition = "username = '$login' AND password = '$password'";
			if ($mysql->select('users', $_condition, '', '', 1)) {
				// Get product information
				if ($mysql->get_number_of_records()) {
					//User is verfied from the database
					$_SESSION['user_info'] = $mysql->rows();
					//utility::pr($_SESSION['user_info']);
					header('Location:controller.php?action=dashboard');
					// Log the user information to server 
					//utility::pr($mysql->rows());
				} else {
					echo 'Invalid username or password';
				}
			}
		}
		include 'login.php';
		break;
	case 'dashboard':
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;
		
		//var_dump($logged_in);
		if($logged_in) {
			include_once 'dashboard.php';
		} else {
			header('Location:controller.php?action=login');
		}
		break;
	case 'logout':
		unset($_SESSION['user_info']);
		header('Location:controller.php?action=login');
		break;
	case 'update':
		
		// Check if the user is logged in
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;

		if(!$logged_in) {
			header('Location:controller.php?action=login');
		}
		
		//echo '<pre>'; print_r($_SESSION['user_info'][0]['id']); die;
		// This will come up only if the user is already logged in
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			//utility::pr($_POST); die;
			
			$id = $_SESSION['user_info'][0]['id'];

			//utility::pr($_POST);
			//utility::pr($_FILES); die;
			$image = $_FILES['image1'];
			$is_image_file_correct = false;
			$_uploaded = false;
			
			//Check the image for any error while uploading
			if($image['error'] == 0) {
			
				// Check if the image is of type "image" only
				if(strstr($image['type'], 'image')) {

					// Check if the image is under 10MB
					$mb10 = 10*1024*1024;
					if($image['size'] < $mb10) {
						$is_image_file_correct = true;
					}
				}
			}
			
			if($is_image_file_correct) {
				// Upload the file in a directory
				$file_name = rand(100,999).'-'.rand(100000,999999).'-'.$image['name'];
				if(move_uploaded_file($image['tmp_name'], 'images_for_dashboard/'.$file_name)) {
					$_uploaded = true;
				}
				// Update the image name in user_details table
			}
			
			// If the file has been uploaded successfully, insert the file name in database
			if($_uploaded) {
				
			}


			// Update first name and last name, in users table
			$first_name = utility::check_var('first_name');
			$last_name = utility::check_var('last_name');
			$phone_number = utility::check_var('phone_number');

			$year = utility::check_var('year');
			$day = utility::check_var('day');
			$month = utility::check_var('month');
			
			$dob = mktime(1, 1, 1, $month, $day, $year);

			if(!empty($first_name) && !empty($last_name)) {
				$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'dob' => $dob,
					'phone_number' => $phone_number
						);
				if($mysql->update('users', $data, "`id` = $id")) {
					$_SESSION['user_info'][0]['first_name'] = $first_name;
					$_SESSION['user_info'][0]['last_name'] = $last_name;
					$_SESSION['user_info'][0]['dob'] = $dob;
					$_SESSION['user_info'][0]['phone_number'] = $phone_number;
					header('Location:controller.php?action=dashboard');
				}
			}
		}
		break;
	
	case 'update_profile':
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;
		
		//var_dump($logged_in);
		if($logged_in) {
			include_once 'profile.php';
		} else {
			header('Location:controller.php?action=login');
		}
		break;
	default:
		break;
}





