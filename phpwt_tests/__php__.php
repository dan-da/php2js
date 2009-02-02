<?php

function test1() {
    
    function __php__say_hi($name) {
        return 'hi ' . $name;
    }
    
    echo "Test that function named __php__funcname is callable as funcname()<br>\n";
    echo 'result: ' . (say_hi('Dave') === 'hi Dave' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();

?>