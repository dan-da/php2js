<?php

function test1() {
    if(true) {
        $data = 'bar2';
    }
    echo "Test that variables are visible in function scope when set inside if<br>\n";
    echo 'result: ' . ($data == 'bar2' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    while(true) {
        $data = 'bar2';
        break;
    }
    echo "Test that variables are visible in function scope when set inside while<br>\n";
    echo 'result: ' . ($data == 'bar2' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test3() {
    for($i = 0; $i < 2; $i ++) {
        $data = 'bar2';
        break;
    }
    echo "Test that variables are visible in function scope when set inside for<br>\n";
    echo 'result: ' . ($data == 'bar2' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    $arr = array('cat');
    foreach($arr as $val) {
        $data = $val;
        break;
    }
    echo "Test that variables are visible in function scope when set inside foreach<br>\n";
    echo 'result: ' . ($data == 'cat' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {
    $my_var = 'hey';
    function foo() {
        $my_var = 'you';
    }
    foo();
    
    echo "Test that variables are NOT visible in sub-function scope when set inside parent scope<br>\n";
    echo 'result: ' . ($my_var == 'hey' ? 'pass' : 'fail') . "<br><br>\n\n";
}

$global_var = 'gvar';
function test6() {
    global $global_var;
    
    echo "Test that global variable can be seen in function when global keyword is used.<br>\n";
    echo 'result: ' . ($global_var == 'gvar' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test7() {
    global $global_var;
    
    $global_var = 'newval';
    
    echo "Test that global variable can be overridden in function when global keyword is used.<br>\n";
    echo 'result: ' . ($global_var == 'newval' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test8() {
    global $global_var;
    
    echo "Test that global variable was globally overridden in previous test.<br>\n";
    echo 'result: ' . ($global_var == 'newval' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test9() {
    global $global_var;
    
    function t9sub() {
        $global_var = 'stuff';
    }
    t9sub();
    
    echo "Test that locally defined variable does not override global variable.<br>\n";
    echo 'result: ' . ($global_var == 'newval' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test10() {
    $buf = '';
    if (true) {
        $x=1;
        if (true) {
            $x=2;
            $buf .= $x;
        }
        $buf .= $x;
    }
    $buf .= $x;
    
    echo "Test that variable has same scope everywhere in function and lives outside sub-braces.<br>\n";
    echo 'result: ' . ($buf == '222' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test11() {
    
    function t11($arg) {
        if( false ) {
            $arg ++;
        }
        else {
        $arg = 'foo';
        }
        return $arg;
    }
    $result = t11('hey');
    
    echo "Test that variable in function parameter list can be redefined after unary op.<br>\n";
    echo 'result: ' . ($result == 'foo' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test12() {
    
    function t11($arg) {
        $arg /= 3;
        return $arg;
    }
    $result = t11(12);
    
    echo "Test that variable in function parameter does not get redeclared with 'var '<br>\n";
    echo 'result: ' . ($result == 4 ? 'pass' : 'fail') . "<br><br>\n\n";
}




test1();
test2();
test3();
test4();
test5();
test6();
test7();
test8();
test9();
test10();
test11();
test12();

?>