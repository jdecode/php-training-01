<?php

/**
 * Description of class
 *
 * @author JD
 */
class utility {

	static function pr($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}

	static function check($var) {
		if (trim($var) != '') {
			return $var;
		}
		return '';
	}

	/**
	 * 
	 * @param string $var The variable that needs to be checked before performing any action on it
	 * @param boolean $get The method that is used to pass information. Default to get, can be post. If Get, pass boolean true.
	 * @return string In case the variable exists as GET or POST, return the checked version, false otherwise
	 */
	static function check_var($var, $get = false) {
		if (!$get) {
			if (isset($_POST[$var])) {
				return utility::check($_POST[$var]);
			}
		} else {
			if (isset($_GET[$var])) {
				return utility::check($_GET[$var]);
			}
		}
		return false;
	}

}
