<?php

require_once 'class.mysql.php';
require_once 'class.utility.php';

/**
 * Description of class
 *
 * @author JD
 */
class user {

	var $mysql = true;

	function __construct() {
		$this->mysql = new mysql();
	}

	function login($login, $password) {
		$_condition = "username = '$login' AND password = '$password'";
		if ($this->mysql->select('users', $_condition, '', '', 1)) {
			// Get product information
			if ($this->mysql->get_number_of_records()) {
				//User is verfied from the database
				$_SESSION['user_info'] = $this->mysql->rows();
				return true;
			}
		}
		return false;
	}

	function is_logged_in() {
		$logged_in = isset($_SESSION['user_info'][0]) && is_numeric($_SESSION['user_info'][0]['id']) ? true : false;
		if (!$logged_in) {
			header('Location:controller.php?action=login');
		}
	}

	function logout() {
		unset($_SESSION['user_info']);
		// Write some code here to save the time of logging out in database
		header('Location:controller.php?action=login');
	}

	function update_user() {
		$id = $_SESSION['user_info'][0]['id'];

		$image = $_FILES['image1'];
		$is_image_file_correct = false;
		$_uploaded = false;

		//Check the image for any error while uploading
		if ($image['error'] == 0) {

			// Check if the image is of type "image" only
			if (strstr($image['type'], 'image')) {

				// Check if the image is under 10MB
				$mb10 = 10 * 1024 * 1024;
				if ($image['size'] < $mb10) {
					$is_image_file_correct = true;
				}
			}
		}

		if ($is_image_file_correct) {
			// Upload the file in a directory
			$file_name = rand(100, 999) . '-' . rand(100000, 999999) . '-' . $image['name'];
			if (move_uploaded_file($image['tmp_name'], 'images_for_dashboard/' . $file_name)) {
				$_uploaded = true;
			}
			// Update the image name in user_details table
		}

		// If the file has been uploaded successfully, insert the file name in database
		if ($_uploaded) {
			
		}


		// Update first name and last name, in users table
		$first_name = utility::check_var('first_name');
		$last_name = utility::check_var('last_name');
		$phone_number = utility::check_var('phone_number');

		$year = utility::check_var('year');
		$day = utility::check_var('day');
		$month = utility::check_var('month');

		$dob = mktime(1, 1, 1, $month, $day, $year);

		if (!empty($first_name) && !empty($last_name)) {
			$data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'dob' => $dob,
				'phone_number' => $phone_number
			);
			if ($this->mysql->update('users', $data, "`id` = $id")) {
				$_SESSION['user_info'][0]['first_name'] = $first_name;
				$_SESSION['user_info'][0]['last_name'] = $last_name;
				$_SESSION['user_info'][0]['dob'] = $dob;
				$_SESSION['user_info'][0]['phone_number'] = $phone_number;
				
				$this->update_extra_fields();
				
				header('Location:controller.php?action=dashboard');
			}
		}
	}
	
	function update_extra_fields() {
		//utility::pr($_POST);
		$post = $_POST;
		$_ud_fields = array();
		if(count($post)) {
			foreach($post as $k => $v) {
				if(substr($k, 0,3) == 'ud_') {
					$_ud_fields[substr($k,3)] = $v;
				}
			}
		}
		utility::pr($_ud_fields); die;
		$id = $_SESSION['user_info'][0]['id'];
		
	}

}
