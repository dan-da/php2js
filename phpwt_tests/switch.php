<?php


function test1() {
    $color = 'red';
    $buf = '';
    
    switch( $color ) {
        case 'red':
            $buf = 'hello';
            break;
        default:
            $buf = 'Unknown color!';
            break;
    }
    
    echo "Test switch.<br>\n";
    echo 'result: ' . ($buf === 'hello' ? 'pass' : 'fail') . "<br><br>\n\n";
    
}

test1();

?>
