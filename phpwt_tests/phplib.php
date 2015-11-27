<?php

// this function gets removed in translation.
function JSINCLUDE() {}

JSINCLUDE('php.js');
JSINCLUDE('php.extra.js');

function preg_match_test1() {
    // The "i" after the pattern delimiter indicates a case-insensitive search
    $rc = preg_match("/php/i", "PHP is the web scripting language of choice.");
    
    echo "Test case insensitive pattern match.<br>\n";
    echo 'result: ' . ($rc == 1 ? 'pass' : 'fail') . "<br><br>\n\n";
}


function preg_match_test2() {

    $rc1 = preg_match('/\bweb\b/i', "PHP is the web scripting language of choice.");
    $rc2 = preg_match("/\bweb\b/i", "PHP is the website scripting language of choice.");

    echo "Test case insensitive pattern match with word boundary.<br>\n";
    echo 'result: ' . ($rc1 == 1 && $rc2 == 0 ? 'pass' : 'fail') . "<br><br>\n\n";
}    

function preg_match_test3() {

    // get host name from URL
    $rc = preg_match('@^(?:http://)?([^/]+)@i', "http://www.php.net/index.html", $matches);
    if( $rc ) {
        $host = $matches[1];
    }

    echo "Test extracting substring from parens.<br>\n";
    echo 'result: ' . ($rc && $host == 'www.php.net' ? 'pass' : 'fail') . "<br><br>\n\n";
}    


preg_match_test1();
preg_match_test2();
preg_match_test3();


?>
