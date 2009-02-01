<?php

function test1() {

    $buf = '';
    for( $i = 0; $i < 5; $i ++ ) {
        $buf .= "$i";
    }
    
    echo "Test that for() iterates correctly<br>\n";
    echo 'result: ' . ($buf === '01234' ? 'pass' : 'fail') . "<br><br>\n\n";

}

test1();



?>
