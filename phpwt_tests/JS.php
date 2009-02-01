<?php

function test1() {
    $foo = 6;
    JS('foo = 8;');
    
    echo "Test single line inline JS() call.<br>\n";
    echo 'result: ' . ($foo === 8 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    JS('
       for( var i = 0; i < 10; i++) {
        i ++;
       }
       ');
    
    echo "Test multi-line JS() code<br>\n";
    echo 'result: ' . ($i === 10 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    JS(<<< END_JS
       for( var i = 0; i < 10; i++) {
        i ++;
       }
END_JS
    );
    
    echo "Test multi-line JS() code inside heredoc<br>\n";
    echo 'result: ' . ($i === 10 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    JS("
       for( var i = 0; i < 10; i++) {
        i ++;
       }
"
    );
    
    echo "Test multi-line JS() code inside double-quoted string<br>\n";
    echo 'result: ' . ($i === 10 ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test5() {
    // Uncomment to test that php->js compiler correctly throws an exception when string is not constant.
/*    
    $start = 3;
    JS("
       for( var i = $start; i < 10; i++) {
        i ++;
       }
"
    );
    
    echo "Test multi-line JS() code inside double quoted string with embedded var.  Should throw an exception when compiling.<br>\n";
    echo 'result: ' . ($i === 10 ? 'pass' : 'fail') . "<br><br>\n\n";
*/    
}


test1();
test2();
test3();
test4();
test5();

?>