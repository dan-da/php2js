<?php

function test1() {

    $arr = array('colors' => array("red" => 'Red', 'green' => "Green"),
                 'car' => 'toyota',
                 'candies' => array('twix','snickers', 'jolly ranchers'),
                 'holiday' => 'christmas'
                 );
    
    $arr['planet'] = 'Earth';

    $okay = $arr['colors']['red'] == 'Red' &&
            $arr['car'] == 'toyota' &&
            $arr['candies'][1] == 'snickers' &&
            $arr['holiday'] == 'christmas' &&
            $arr['planet'] == 'Earth';
    
    echo "Test that assoc array init and deref works<br>\n";
    echo 'Result: ' . (($okay === true) ? 'pass' : 'fail') . "<br><br>\n\n";

}

test1();

?>
