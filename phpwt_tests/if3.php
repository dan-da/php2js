<?php

$fruit = 'apple';
$number = 3;
$day = 'monday';
$candy = 'snickers';
$car = 'toyota';
$lotto_numbers = 652352;

$winner = false;
if( $day == 'monday' && $fruit == 'apple' ) {
	if( $number == '2' ) {}
	elseif ( !($number == 2) && $number < 4 && $number > 2 ) {
		if( $candy == 'bighunk' ) {}
		else if( $candy == 'twix' ) {}
		else if( $candy == 'snickers' ) {} {
			if( $car = 'toyota' ) {
				if( $lotto_numbers = 652352 ) {
					$winner = true;
				}
			}
		}
	}
}

echo "Test complicated if/else tree<br>\n";
if( $winner ) {
	echo "pass";
}
else {
	echo "fail";
}
echo "<br><br>\n\n";

?>
