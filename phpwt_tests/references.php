<?php


function test1() {
    
    function test1_internal( &$foo ) {
        $foo = 6;
    }
    
    $bar = 3;
    test1_internal( $bar );
    
    echo "Test that passing var to function by reference changes referent var.<br>\n";
    echo 'result: ' . ($bar === 6 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    
    class goo {}
    
    function test2_internal( &$foo ) {
        $foo += 3;
    }
    
    $bar = new goo();
    $bar->total = 3;
    test2_internal( $bar->total );
    
    echo "Test passing object attributes by reference.<br>\n";
    echo 'result: ' . ($bar->total === 6 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    
    function test3_internal( &$foo ) {
        $foo += 1;
    }
    
    $baz = array(5);
    test3_internal( $baz[0] );
    
    echo "Test passing array elements by reference.<br>\n";
    echo 'result: ' . ($baz[0] == 6 ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test4() {
    $orig = 6;
    $ref =& $orig;
    
    $orig = 3;
    
    echo "Test that changing original also changes reference.<br>\n";
    echo 'result: ' . ($ref === 3 ? 'pass' : 'fail') . "<br><br>\n\n";
}



test1();
test2();
test3();
test4();

?>