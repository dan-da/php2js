<?php

$favorites = array( 'favcolor' => 'red',
                    'favmovie' => 'shawshank',
                    'favsong'  => 'Yellow submarine' );

function test1($favorites) {
    
    $buf = '';
    foreach( $favorites as $fav ) {
        $buf .= $fav;
    }

    echo 'Test foreach($arr as $val)' . "<br>\n";
    echo 'result: ' . ($buf === 'redshawshankYellow submarine' ? 'pass' : 'fail') . "<br><br>\n\n";
}

    
function test2($favorites) {
    $buf = '';
    foreach( $favorites as $key => $val ) {
        $buf .= "$key: $val,";
    }

    echo 'Test foreach($arr as $key => $val)' . "<br>\n";
    echo 'result: ' . ($buf === 'favcolor: red,favmovie: shawshank,favsong: Yellow submarine,' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1( $favorites );
test2( $favorites );

?>
