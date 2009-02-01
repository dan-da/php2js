

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
        
function say_hello( title, fname, lname ) {
	var x;
	x = 5;
	return "hello "+title+" "+fname+" "+lname+"!";
}

function get_last_name() {
	return 'Libby';
}

function test1() {
	var buf = say_hello('Mr', 'Daniel',  'Day' + ' ' + get_last_name());
 
	document.write( "Test a few basic things.  :-)<br>\n");
	document.write( 'result: ' + (buf === 'hello Mr Daniel Day Libby!' ? 'pass' : 'fail') + "<br><br>\n\n");
}

test1();



