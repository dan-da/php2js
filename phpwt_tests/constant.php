<?php

JSINCLUDE('php.js');

define( 'GLOBAL_CONST', 'globals_r_bad');

function test1() {
    
    define( 'APPLE_COLOR', 'red');

    echo "Test define works correctly with a string<br>\n";
    echo 'result: ' . (APPLE_COLOR === 'red' ? 'pass' : 'fail') . "<br><br>\n\n";

}

function test2() {
    
    define( 'APPLE_COUNT', 3);

    echo "Test define works correctly with an integer<br>\n";
    echo 'result: ' . (APPLE_COUNT === 3 ? 'pass' : 'fail') . "<br><br>\n\n";

}

function test3() {
    
    echo "Test global define works correctly<br>\n";
    echo 'result: ' . (GLOBAL_CONST === 'globals_r_bad' ? 'pass' : 'fail') . "<br><br>\n\n";

}


test1();
test2();
test3();



?>
