<?php

function test1() {
	$buf = null;
	
	try {
		throw new Exception();
	}
	catch( Exception $e ) {
		$buf = 'The sky is falling.';
	}
	echo "Test try and catch.<br>\n";
	echo 'result: ' . ($buf == 'The sky is falling.' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test2() {
	$buf = null;
	
	try {
		throw new Exception("The sky is falling.");
	}
	catch( Exception $e ) {
		$buf = $e->getMessage();
	}
	echo "Test try, catch and exception with message.<br>\n";
	echo 'result: ' . ($buf == 'The sky is falling.' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test3() {
	$buf = null;
	
	class CustomException extends Exception {
		function getBlurb() { return "The sky is blue."; }
	}
	
	try {
		throw new CustomException("The sky is falling.");
	}
	catch( CustomException $e ) {
		$buf = $e->getBlurb();
	}
	catch( Exception $e ) {
		$buf = $e->getMessage();
	}
	echo "Test custom exception subclass and multiple catch blocks.<br>\n";
	echo 'result: ' . ($buf == 'The sky is blue.' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();
test2();
test3();


?>
