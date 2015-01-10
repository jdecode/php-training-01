<?php

session_start();
$_SESSION['login'] = $_POST['login'];
$_SESSION['password'] = $_POST['password'];

$_SESSION['status'] = 1;



/*
$s = serialize($_POST);
setcookie('_test', $s);

$arr = unserialize($s);
echo '<pre>';
print_r($arr);
echo '</pre>';

*/
