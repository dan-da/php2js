

function ___array() {
  var arr = [];
  for (var i = 0; i < ___array.arguments.length; ++i) {
    var item = ___array.arguments[i];
    if(item instanceof Array) {
        arr[item[0]] = item[1];
    }
    else {
        arr.push( item );
    }
  }
  return arr;
}
        
fruit = 'apple';
var number = 3;
var day = 'monday';
var candy = 'snickers';
var car = 'toyota';
var lotto_numbers = 652352;

var winner = false;
if( day == 'monday' && fruit == 'apple' ) {
	if( number == '2' ) {}
	else if ( !(number == 2) && number < 4 && number > 2 ) {
		if( candy == 'bighunk' ) {}
		else if( candy == 'twix' ) {}
		else if( candy == 'snickers' ) {} {
			if( car = 'toyota' ) {
				if( lotto_numbers = 652352 ) {
					var winner = true;
				}
			}
		}
	}
}

document.write( "Test complicated if/else tree<br>\n");
if( winner ) {
	document.write( "pass");
}
else {
	document.write( "fail");
}
document.write( "<br><br>\n\n");


