<?php

function test1() {
    $color = 'red';
    $attr = 'color';
    
    echo "Test $$ operator<br>\n";
    echo 'result: ' . ($$attr == 'red' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    class foo { var $bar = 'green'; }
    $f = new foo();
    
    $attr = 'bar';
    
    echo "Test \$object->\$attr operator<br>\n";
    echo 'result: ' . ($f->$attr == 'green' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    
    function get_name() {return 'sally';}
    $func = 'get_name';
    
    echo "Test \$func() operator<br>\n";
    echo 'result: ' . ($func() == 'sally' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test4() {
    class foo2 { function get_name() { return 'dolly'; } }
    $f = new foo2();
    
    $func = 'get_name';
    
    echo "Test \$object->\$func() operator<br>\n";
    echo 'result: ' . ($f->$func() == 'dolly' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();
test2();
test3();
test4();

?>