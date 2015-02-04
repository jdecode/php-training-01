<?php

require_once 'classes/config.php';
require_once 'classes/class.utility.php';
require_once 'classes/class.mysql.php';
require_once 'classes/class.user.php';
session_start();



$user = new user();

$action = utility::check_var('action', true);

switch ($action) {
	case 'login':
		// Check if the user is logged in
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;
		if ($logged_in) {
			// If logged in already, take the user to dashboard page, instead of showing the login screen
			header('Location:controller.php?action=dashboard');
		}
		// This will come up only if the user is not already logged in
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$login = utility::check_var('login');
			$password = sha1(utility::check_var('password'));
			if ($user->login($login, $password)) {
				header('Location:controller.php?action=dashboard');
			} else {
				echo 'Invalid username or password';
			}
		}
		include 'login.php';
		break;
	case 'dashboard':
		$user->is_logged_in();
		include_once 'dashboard.php';
		break;
	case 'logout':
		$user->logout();
		break;
	case 'update':
		$user->is_logged_in();
		//echo '<pre>'; print_r($_SESSION['user_info'][0]['id']); die;
		// This will come up only if the user is already logged in
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if($user->update_user()) {
				header('Location:controller.php?action=dashboard');
			} else {
				header('Location:controller.php?action=update_profile');
			}
		}
		break;
	case 'update_profile':
		$user->is_logged_in();
		include_once 'profile.php';
		break;
	default:
		break;
}
