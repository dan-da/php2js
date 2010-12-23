<?php

class foo{}

function test1() {
    $obj = new foo();
    
    echo "Test new operator and instanceof operator<br>\n";
    echo 'result: ' . ($obj instanceof foo ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    $obj = new foo();
    $obj->age = 2;
    $obj2 = clone $obj;
    $obj2->age = 5;
    
    echo "Test clone operator<br>\n";
    echo 'result: ' . ($obj->age == 2 && $obj2->age == 5 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    $obj = new foo();
    $obj->age = 2;
    $obj2 = clone($obj);
    $obj2->age = 5;
    
    echo "Test clone function call<br>\n";
    echo 'result: ' . ($obj->age == 2 && $obj2->age == 5 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    class magical{ var $attr; function __clone() {$this->attr++;} }
    $magic1 = new magical();
    $magic1->attr = 3;
    $magic2 = clone( $magic1 );
    
    echo "Test __clone magic method. <br>\n";
    echo 'result: ' . ($magic1->attr == 3 && $magic2->attr == 4 ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test5() {
    $obj = new foo();
    $obj->age = 2;
    $obj2 = $obj;
    $obj->age = 5;
    
    echo "Test assignment of class (should be reference unless clone is used)<br>\n";
    echo 'result: ' . ($obj2->age == 5 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test6() {
    // adapted from http://us3.php.net/manual/en/language.operators.php
    $a = 3 * 3 % 5; // (3 * 3) % 5 = 4
    $a = true ? 0 : true ? 1 : 2; // (true ? 0 : true) ? 1 : 2 = 2
    
    $a = 1;
    $b = 2;
    $a = $b += 3; // $a = ($b += 3) -> $a = 5, $b = 5
    
    echo "Test associativity<br>\n";
    echo 'result: ' . ($a == 5 && $b == 5 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test7() {
    // adapted from http://us3.php.net/manual/en/language.operators.bitwise.php
    
    $a = 12 ^ 9; // Outputs '5'
    
    $b = $a << 3;
    
    $c = $b >> 3;
    
    $d = 1 | 2;
    
    $e = ~ $d;
    
    echo "Test bitwise operators<br>\n";
    echo 'result: ' . ($a == 5 && $b == 40 && $c == 5 && $d == 3 && $e == -4  ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test8() {
    $truth = 5 <> 3;
    
    echo "Test <> operator alias for '!='<br>\n";
    echo 'result: ' . ($truth ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test9() {
    $truth = (0 or 1) and 1;
    
    echo "Test 'or' and 'and' operator aliases for '||' and '&&'<br>\n";
    echo 'result: ' . ($truth ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test10() {
    // test adapated from http://us3.php.net/manual/en/language.operators.comparison.php
    $truth = (true?'true':false?'t':'f');
    
    echo "Test ternary operator in non-obvious case<br>\n";
    echo 'result: ' . ($truth == 't' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test11() {
    // test adapated from http://us3.php.net/manual/en/language.operators.errorcontrol.php
    $arr = array('key' => 'value');
    $foo = @$arr['badkey'];
    
    // For javascript, we consider this test to pass if foo has null.  JS has no concept
    // of an error-control operator, so we don't expect to control actual warning output.
    
    echo "Test error control operator<br>\n";
    echo 'result: ' . ($foo == null ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test12() {
    $i = 0;
    $i ++;
    ++$i;
    $i --;
    --$i;
    
    echo "Test ++ and -- operators.  before and after.<br>\n";
    echo 'result: ' . ($i === 0 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test13() {
    // Adapted from http://us3.php.net/manual/en/language.operators.increment.php
    $i = 'W';
    $buf = '';
    for ($n=0; $n<6; $n++) {
        $buf .= ++$i . ", ";
    }
    
    echo "Test ++ on character variables.<br>\n";
    echo 'result: ' . ($buf == 'X, Y, Z, AA, AB, AC, ' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test14() {
    // test adapated from http://us3.php.net/manual/en/language.operators.array.php

    $a = array("a" => "apple", "b" => "banana");
    $b = array("a" => "pear", "b" => "strawberry", "c" => "cherry");
    
    $c = $a + $b; // Union of $a and $b
    echo "Union of \$a and \$b: \n";
    echo $c;
    
    echo "Test + operator on two assoc arrays<br>\n";
    echo 'result: ' . ($foo == null ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test15() {
    // test adapated from http://us3.php.net/manual/en/language.operators.array.php

    $a = array("apple", "banana");
    $b = array("pear", "strawberry", "cherry");
    
    $c = $a + $b; // Union of $a and $b
    echo "Union of \$a and \$b: \n";
    echo $c[0] . "<br>\n";
    echo $c[1] . "<br>\n";
    echo $c[2] . "<br>\n";
    echo $c[3] . "<br>\n";
    
    echo "Test + operator on two assoc arrays<br>\n";
    echo 'result: ' . ($foo == null ? 'pass' : 'fail') . "<br><br>\n\n";
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
test13();
test14();
test15();

?>