<?php

function test1() {

    $buf = '';
    $i = 0;
    while( $i < 5 ) {
	$buf .= "$i";
	$i++;
    }
    
    echo "Test that while() iterates correctly<br>\n";
    echo 'result: ' . ($buf === '01234' ? 'pass' : 'fail') . "<br><br>\n\n";

}

test1();

?>
