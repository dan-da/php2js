<?php

function test1() {

    $i = 0;
    $buf = '';
    do {
        $buf .= $i;
        $i ++;
    } while( $i < 5 );
    
    echo "Test that do...while() iterates correctly<br>\n";
    echo 'result: ' . ($buf === '01234' ? 'pass' : 'fail') . "<br><br>\n\n";

}

test1();

?>
