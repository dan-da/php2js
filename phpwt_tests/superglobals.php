<?php

function test1() {
    
    $stuff = $_GET['stuff'];
    
    echo "Test that \$_GET can be accessed.<br>\n";
    echo 'result: ' . ($stuff == 'data' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {

    // $_COOKIE is read-only in JS.  We'll use this javascript to set a real cookie.
    JS('
        function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
        }
        createCookie( "mycookie", "data with spaces");
        
        // Re-init the superglobal _COOKIE
        _COOKIE = ___load_cookies();  // undocumented.
        '
    );

    $stuff = $_COOKIE['mycookie'];

    echo "Test that \$_COOKIE can be accessed.<br>\n";
    echo 'result: ' . ($stuff == 'data with spaces' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();
test2();

?>