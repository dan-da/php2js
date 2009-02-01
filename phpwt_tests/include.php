<?php

function test1() {

    include( 'include_1.inc' );
    include_once('include_1.inc');
    
    $result = include_1();
    
    echo "Test include, include_once, and calling a method in included file.<br>\n";
    echo 'result: ' . ($result === 'include_1_included' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    // Uncommenting this should cause a php2js compile error because assigning include is not currently supported.
/*
    $result1 = include( 'include_1.inc' );
    $result2 = include_1();
    
    echo "Test include, include_once, and calling a method in included file.<br>\n";
    echo 'result: ' . ($result1 === 'include_2_included' && $result2 === 'include_2_included' ? 'pass' : 'fail') . "<br><br>\n\n";
*/
}

function test3() {
    // Uncommenting this should cause a php2js compile error because include_2 contains a return statement in the global scope, which is
    // not currently supported.
/*
    include( 'include_2.inc' );
    $result1 = include_2();
    
    echo "Test an included file with return statement in global scope.<br>\n";
    echo 'result: ' . ($result1 === 'include_2_included' ? 'pass' : 'fail') . "<br><br>\n\n";
*/
}


test1();
test2();
test3();

?>