<?php

function test1() {
    $sum = 2;
    $sum += 5;
    
    echo "Test += operator<br>\n";
    echo 'result: ' . ($sum == '7' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    $sum = 8;
    $sum -= 5;
    
    echo "Test -= operator<br>\n";
    echo 'result: ' . ($sum == '3' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    $sum = 9;
    $sum /= 3;
    
    echo "Test /= operator<br>\n";
    echo 'result: ' . ($sum == '3' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    $sum = 4;
    $sum *= 3;
    
    echo "Test *= operator<br>\n";
    echo 'result: ' . ($sum == '12' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {
    $str = 'hello ';
    $str .= 'world';
    
    echo "Test .= operator<br>\n";
    echo 'result: ' . ($str == 'hello world' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test6() {
    for( $i = 0; $i < 3; $i ++) {
        $buf .= '!';
    }
    
    echo "Test .= operator applied to undeclared variable, in a loop.<br>\n";
    echo 'result: ' . ($buf == '!!!' ? 'pass' : 'fail') . "<br><br>\n\n";
}



test1();
test2();
test3();
test4();
test5();
test6();

?>