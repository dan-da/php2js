<?php

function test1() {
    $foo = "hello";
    unset( $foo );
    
    echo "Test unset( \$var )   (scalar variable)<br>\n";
    echo 'Result: ' . (($foo == null) ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {

    $arr = array("red","green","blue",1,2,3);
    unset( $arr[1] );

    echo "Test unset() of a numeric array index<br>\n";
    echo 'Result: ' . ((count($arr) === 5 && $arr[1] == null) ? 'pass' : 'fail') . "<br><br>\n\n";
       
}

function test3() {

    $arr = array("red" => 'Red',"green" => 'Green');
    unset( $arr['red'] );
    
    
    echo "Test unset() of a string array index<br>\n";
    echo 'Result: ' . ((count($arr) == 1 && !@$arr['red']) ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {

    class _foo {
        var $name = 'bar';
    }
    $f = new _foo;
    unset( $f->name );
    
    echo "Test unset() of an object property<br>\n";
    echo 'Result: ' . (($f->name == null) ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {

    $arr = array( 'colors' => array( "red","green","blue" ),1,2,3 );
    unset( $arr['colors'][1] );

    echo "Test unset() of a nested array index<br>\n";
    echo 'Result: ' . ((count($arr['colors']) === 2 && $arr['colors'][1] == null) ? 'pass' : 'fail') . "<br><br>\n\n";
       
}


test1();
test2();
test3();
test4();
test5();
       

?>
