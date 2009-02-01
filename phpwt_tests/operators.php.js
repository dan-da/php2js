

function ___array() {
  var arr = [];
  for (var i = 0; i < ___array.arguments.length; ++i) {
    var item = ___array.arguments[i];
    if(item instanceof Array) {
        arr[item[0]] = item[1];
    }
    else {
        arr.push( item );
    }
  }
  return arr;
}
        
class foo{}

function test1() {
    var obj = new foo();
    
    document.write( "Test new operator and instanceof operator<br>\n");
    document.write( 'result: ' + (obj instanceof foo ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    var obj = new foo();
    obj->age = 2;
    var obj2 = clone obj;
    obj2->age = 5;
    
    document.write( "Test clone operator<br>\n");
    document.write( 'result: ' + (obj->age == 2 && obj2->age == 5 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    var obj = new foo();
    obj->age = 2;
    var obj2 = clone(obj);
    obj2->age = 5;
    
    document.write( "Test clone function call<br>\n");
    document.write( 'result: ' + (obj->age == 2 && obj2->age == 5 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    class magical{ var attr; function __clone() {this->attr++;} }
    var magic1 = new magical();
    magic1->attr = 3;
    var magic2 = clone( magic1 );
    
    document.write( "Test __clone magic method. <br>\n");
    document.write( 'result: ' + (magic1->attr == 3 && magic2->attr == 4 ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test5() {
    var obj = new foo();
    obj->age = 2;
    var obj2 = obj;
    obj->age = 5;
    
    document.write( "Test assignment of class (should be reference unless clone is used)<br>\n");
    document.write( 'result: ' + (obj2->age == 5 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test6() {
    // adapted from http://us3.php.net/manual/en/language.operators.php
    a = 3 * 3 % 5; // (3 * 3) % 5 = 4
    a = true ? 0 : true ? 1 : 2; // (true ? 0 : true) ? 1 : 2 = 2
    
    a = 1;
    var b = 2;
    var a = b += 3; // $a = ($b += 3) -> $a = 5, $b = 5
    
    document.write( "Test associativity<br>\n");
    document.write( 'result: ' + (a == 5 && b == 5 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test7() {
    // adapted from http://us3.php.net/manual/en/language.operators.bitwise.php
    
    a = 12 ^ 9; // Outputs '5'
    
    b = a << 3;
    
    var c = b >> 3;
    
    var d = 1 | 2;
    
    var e = ~ d;
    
    document.write( "Test bitwise operators<br>\n");
    document.write( 'result: ' + (a == 5 && b == 40 && c == 5 && d == 3 && e == -4  ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test8() {
    var truth = 5 <> 3;
    
    document.write( "Test <> operator alias for '!='<br>\n");
    document.write( 'result: ' + (truth ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test9() {
    var truth = (0 or 1) and 1;
    
    document.write( "Test 'or' and 'and' operator aliases for '||' and '&&'<br>\n");
    document.write( 'result: ' + (truth ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test10() {
    // test adapated from http://us3.php.net/manual/en/language.operators.comparison.php
    truth = (true?'true':false?'t':'f');
    
    document.write( "Test ternary operator in non-obvious case<br>\n");
    document.write( 'result: ' + (truth == 't' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test11() {
    // test adapated from http://us3.php.net/manual/en/language.operators.errorcontrol.php
    arr = ___array(['key' , 'value']);
    var foo = @arr['badkey'];
    
    // For javascript, we consider this test to pass if foo has null.  JS has no concept
    // of an error-control operator, so we don't expect to control actual warning output.
    
    document.write( "Test error control operator<br>\n");
    document.write( 'result: ' + (foo == null ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test12() {
    var i = 0;
    i ++;
    ++i;
    i --;
    --i;
    
    document.write( "Test ++ and -- operators.  before and after.<br>\n");
    document.write( 'result: ' + (i === 0 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test13() {
    // Adapted from http://us3.php.net/manual/en/language.operators.increment.php
    i = 'W';
    var buf = '';
    for (n=0; n<6; n++) {
        buf .= ++i + ", ";
    }
    
    document.write( "Test ++ on character variables.<br>\n");
    document.write( 'result: ' + (buf == 'X, Y, Z, AA, AB, AC, ' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test14() {
    // test adapated from http://us3.php.net/manual/en/language.operators.array.php

    a = ___array(["a" , "apple"], ["b" , "banana"]);
    var b = ___array(["a" , "pear"], ["b" , "strawberry"], ["c" , "cherry"]);
    
    var c = a + b; // Union of $a and $b
    document.write( "Union of \$a and \$b: \n");
    document.write( c);
    
    document.write( "Test + operator on two assoc arrays<br>\n");
    document.write( 'result: ' + (foo == null ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test15() {
    // test adapated from http://us3.php.net/manual/en/language.operators.array.php

    a = ___array("apple", "banana");
    var b = ___array("pear", "strawberry", "cherry");
    
    var c = a + b; // Union of $a and $b
    document.write( "Union of \$a and \$b: \n");
    document.write( c[0] + "<br>\n");
    document.write( c[1] + "<br>\n");
    document.write( c[2] + "<br>\n");
    document.write( c[3] + "<br>\n");
    
    document.write( "Test + operator on two assoc arrays<br>\n");
    document.write( 'result: ' + (foo == null ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test16() {
    var orig = 6;
    var ref =& orig;
    
    orig = 3;
    
    document.write( "Test that changing original also changes reference.<br>\n");
    document.write( 'result: ' + (ref === 3 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test17() {
    
    function test17_internal( &foo ) {
        var foo = 6;
    }
    
    var bar = 3;
    test17_internal( bar );
    
    document.write( "Test that passing var to function by reference changes referent var.<br>\n");
    document.write( 'result: ' + (bar === 6 ? 'pass' : 'fail') + "<br><br>\n\n");
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
test16();
test17();


