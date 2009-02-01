<?php

function test1() {

    $arr = array( 'val1', 'key' => 'val2', 'val3', 'val4', 'key2' => 'val5' );
    $buf = '';
    foreach( $arr as $key => $value ) {
        $buf .= $value . ' ';
    }
    
    echo "Test that mixed assoc and indexed values maintain original order<br>\n";
    echo 'Result: ' . (($buf === 'val1 val2 val3 val4 val5 ') ? 'pass' : 'fail') . "<br><br>\n\n";

}

function test2() {

    $arr = array( 'key1' => 'val1', 'key2' => 'val2', 'val3', 'val4', 'key5' => 'val5', 'val6', 'val7', 'val8', 'key9' => 'val9' );
    $buf = '';
    foreach( $arr as $key => $value ) {
        $buf .= "$key:$value ";
    }
    
    echo "Test (again) that mixed assoc and indexed values maintain original order<br>\n";
    echo 'Result: ' . (($buf === 'key1:val1 key2:val2 0:val3 1:val4 key5:val5 2:val6 3:val7 4:val8 key9:val9 ') ? 'pass' : 'fail') . "<br><br>\n\n";

}



test1();
test2();


?>
