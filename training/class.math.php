<?php

class math {

	public $num1;
	public $num2;

	function __construct($a, $b) {
		$this->num1 = $a;
		$this->num2 = $b;
	}
	
	function add() {
		return $this->num1 + $this->num2;
	}
	function mul() {
		return $this->num1 * $this->num2;
	}
	function div($num1 = 1, $num2 = 1) {
		return $num1/$num2;
	}
}

