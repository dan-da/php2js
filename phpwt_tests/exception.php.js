

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
        
function test1() {
	var buf = null;
	
	try {
		throw new Exception();
	}
	catch( Exception e ) {
		buf = 'The sky is falling.';
	}
	document.write( "Test try and catch.<br>\n");
	document.write( 'result: ' + (buf == 'The sky is falling.' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test2() {
	var buf = null;
	
	try {
		throw new Exception("The sky is falling.");
	}
	catch( Exception e ) {
		buf = e->getMessage();
	}
	document.write( "Test try, catch and exception with message.<br>\n");
	document.write( 'result: ' + (buf == 'The sky is falling.' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test3() {
	var buf = null;
	
	class CustomException extends Exception {
		function getBlurb() { return "The sky is blue."; }
	}
	
	try {
		throw new CustomException("The sky is falling.");
	}
	catch( CustomException e ) {
		buf = e->getBlurb();
	}
	catch( Exception e ) {
		buf = e->getMessage();
	}
	document.write( "Test custom exception subclass and multiple catch blocks.<br>\n");
	document.write( 'result: ' + (buf == 'The sky is blue.' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();
test2();
test3();



