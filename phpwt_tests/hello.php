<?php

function say_hello( $title, $fname, $lname ) {
	$x;
	$x = 5;
	return "hello $title $fname $lname!";
}

function get_last_name() {
	return 'Libby';
}

function test1() {
	$buf = say_hello('Mr', 'Daniel',  'Day' . ' ' . get_last_name());
 
	echo "Test a few basic things.  :-)<br>\n";
	echo 'result: ' . ($buf === 'hello Mr Daniel Day Libby!' ? 'pass' : 'fail') . "<br><br>\n\n";
}

test1();


?>
