<?php

function test1() {

    $arr = array("red","green","blue",1,2,3);
    
    $arr[6] = 'this element was added later!';
    
    $newarr[7] = 'new arr, new elem';
    $newarr[] = 'new elem, added to end of array';
    
    $buf = $arr[0] .
           $arr[1] . 
           $arr[2].
           $arr[3].
           $arr[4].
           $arr[5].
           $arr[6].
           $newarr[7].
           $newarr[8];

    echo "Test array initialization, indexed assignment, and append via []<br>\n";
    echo 'Result: ' . (($buf === 'redgreenblue123this element was added later!new arr, new elemnew elem, added to end of array') ? 'pass' : 'fail') . "<br><br>\n\n";
       
}

function test2() {
    
    $arr = array(array("foo0", "bar0", "baz0", "toto0", "tintin0"),
            array("foo1", "bar1", "baz1", "toto1", "tintin1"),
            array("foo2", "bar2", "baz2", "toto2", "tintin2"),
            array("foo3", "bar3", "baz3", "toto3", "tintin3"),
            array("foo4", "bar4", "baz4", "toto4", "tintin4"));
    
    echo "Test nested indexed arrays.<br>\n";
    echo 'Result: ' . (($arr[3][3] === 'toto3') ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    $arr[][][][] = 'far';
    
    echo "Test nested indexed arrays built with [].<br>\n";
    echo 'Result: ' . (($arr[0][0][0][0] === 'far') ? 'pass' : 'fail') . "<br><br>\n\n";
}

test1();
test2();
test3();
       

?>
