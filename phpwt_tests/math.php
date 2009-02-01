<?php

function add_vars( $var1, $var2 ) {
	return $var1 + $var2;
}

function test1() {

    $left = 1;
    $right = 5;
    
    $buf = "$left plus $right = " . add_vars( $left, $right );
    
    echo "Test addition and embedding integer vars in a string.<br>\n";
    echo 'result: ' . ($buf === '1 plus 5 = 6' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    $left = 1 - 10;
    $right = 5 * 3 / (10 - 7);
    $buf = "$left plus $right = " . add_vars( $left, $right );
    
    echo "Test multiplication, division, subtraction, negative number, and order of operations.<br>\n";
    echo 'result: ' . ($buf === '-9 plus 5 = -4' ? 'pass' : 'fail') . "<br><br>\n\n";
}

test1();
test2();


?>
