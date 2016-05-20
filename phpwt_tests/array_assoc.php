<?php

function test1() {

    $arr = array('colors' => array("red" => 'Red', 'green' => "Green"),
                 'candies' => array('twix','snickers', 'jolly ranchers'),
                 'holiday' => 'christmas'
                 );
    
    $arr['planet'] = 'Earth';

    $okay = $arr['colors']['red'] == 'Red' &&
            $arr['candies'][1] == 'snickers' &&
            $arr['holiday'] == 'christmas'; 
    
    echo "Test that assoc array init and deref works<br>\n";
    echo 'Result: ' . (($okay === true) ? 'pass' : 'fail') . "\n\n";

}

test1();

?>
