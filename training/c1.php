<?php
$s = $_COOKIE['_test'];
$arr = unserialize($s);
echo '<pre>';
print_r($arr);