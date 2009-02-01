<?php

function test1() {

    require( 'include_1.inc' );
    require_once('include_1.inc');
    
    $result = include_1();
    
    echo "Test require, require_once, and calling a method in required file.<br>\n";
    echo 'result: ' . ($result === 'include_1_included' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();

?>