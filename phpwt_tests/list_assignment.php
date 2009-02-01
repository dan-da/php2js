<?php

function test1() {
    
    $foo = array( 5, 6, 7, 8 );
    list( $a, $b, $c ) = $foo;

    echo "Test that list(\$a, \$b, \$c) work correctly<br>\n";
    echo 'result: ' . ($a === 5 && $b == 6 && $c == 7 ? 'pass' : 'fail') . "<br><br>\n\n";

}

test1();

?>
