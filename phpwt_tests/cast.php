<?php

function test1() {
    $data = (integer)"2";
    
    echo "Test casting numeric string to an int<br>\n";
    echo 'result: ' . ($data === 2 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    $data = (string)2;
    
    echo "Test casting integer to a string<br>\n";
    echo 'result: ' . ($data === '2' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    $data = (int)2.345;
    
    echo "Test casting float to an integer<br>\n";
    echo 'result: ' . ($data === 2 ? 'pass' : 'fail') . "<br><br>\n\n";
}

test1();
test2();
test3();

?>