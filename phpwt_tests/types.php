<?php

$tvar = 1.234567;
echo "Test that float works, using $tvar.<br>\n";
echo 'Result: ' . (($tvar === 1.234567) ? 'pass' : 'fail') . "<br><br>\n\n";

$tvar = 'silly putty string';
echo "Test that string works, using '$tvar'.<br>\n";
echo 'Result: ' . (($tvar === 'silly putty string') ? 'pass' : 'fail') . "<br><br>\n\n";

$tvar = 1234567;
echo "Test that int works, using $tvar.<br>\n";
echo 'Result: ' . (($tvar === 1234567) ? 'pass' : 'fail') . "<br><br>\n\n";

$tvar = true;
echo "Test that bool works, using $tvar.<br>\n";
echo 'Result: ' . (($tvar === true) ? 'pass' : 'fail') . "<br><br>\n\n";

$tvar = null;
echo "Test that null works, using $tvar.<br>\n";
echo 'Result: ' . (($tvar === null) ? 'pass' : 'fail') . "<br><br>\n\n";

?>
