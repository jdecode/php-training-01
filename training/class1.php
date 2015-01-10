<?php


require_once 'class.math.php';

$m = new math(4,7);

$s = clone $m;

$m->num1 = 10;


echo $m->add();

echo '<br />';

echo $s->add();

echo '<br />';

echo $m->mul();

echo '<br />';

//echo $m->div(3,5);

/*
function add($a = 0, $b = 0) {
	return $a + $b;
}
$a = 7;
echo $a;
echo '<br />';

echo add(3,5);
echo '<br />';
echo $a;
*/