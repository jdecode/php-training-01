<?php

// For dpja18@gmail.com

//$f2 = file_get_contents('b.txt');
//echo nl2br($f2);
//file_put_contents('b.txt', file_get_contents('b.txt')."\n Data");

//exit();
define('NL', "\n");

// Write some content to a file
$f1 = fopen('b.txt', 'a');

fwrite($f1, NL . rand(). ' : Test');

fclose($f1);


// Following code is used to read the file line by line
$f = @fopen('b.txt', 'r');
//$f2 = fopen('a.txt', 'r');

if($f) {
	$i = 1;
	$str = '';
	while($row = fgets($f)) {
		//echo $i." : ". '<i>'.$row.'</i>';
		echo $row;
		echo '<br />';
		//$i++;
		//$str .= $row;
	}
	//echo nl2br($str);
	fclose($f);
} else {
	// Run the code for file not being able to read
}
//echo '<br />';
//echo ($f2);
