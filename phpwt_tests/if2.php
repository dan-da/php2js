<?php

function get_magic_num() { return 5; }

$i = 5;
echo "Test || and order of operations with parens.<br>\n";
if( ($i < 10 && $i > 6) || $i == 5 ) { echo "pass"; } else { echo "fail"; }
echo "<br><br>\n\n";

echo "Test method call inside if gets evaluated correctly<br>\n";
if( ($i < 10 && $i > 6) || $i == get_magic_num() ) { echo "pass"; } else { echo "fail"; }
echo "<br><br>\n\n";

$success = false;
if(false){
}
else{
        if(true) {
                $success = true;
        }
}
echo "Test 'if() {} else{ if() {} }' works correctly.<br>\n";
if( $success ) {
    echo "pass";
}
else {
    echo "fail";
}
echo "<br><br>\n\n";

?>
