<?php

function test1() {

    $i = 5;
    $buf = '';
    if( $i < 10 ) { $buf .= 'ok'; }
    
    if( $i < 2) {}
    elseif( $i < 6) { $buf .= 'ok'; }
    
    if( $i > 10) {}
    elseif($i > 7) {}
    else { $buf .= 'ok'; }
    
    if( $i == 5 ) $buf .= 'ok';
    
    echo "Test that if, else, elseif work correctly<br>\n";
    echo 'result: ' . ($buf === 'okokokok' ? 'pass' : 'fail') . "<br><br>\n\n";
    
}

test1();

?>
