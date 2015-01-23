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
			$id = $_SESSION['user_info'][0]['id'];
			$first_name = utility::check_var('first_name');
			$last_name = utility::check_var('last_name');
			
			if(!empty($first_name) && !empty($last_name)) {
				$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name
						);
				if($mysql->update('users', $data, "`id` = $id")) {
					header('Location:controller.php?action=dashboard');
				}
			}
		}
		break;
	default:
		break;
}





