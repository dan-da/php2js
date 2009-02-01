

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
    
    var stuff = _GET['stuff'];
    
    document.write( "Test that \$_GET can be accessed.<br>\n");
    document.write( 'result: ' + (stuff == 'data' ? 'pass' : 'fail') + "<br><br>\n\n");
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

    var stuff = _COOKIE['mycookie'];

    document.write( "Test that \$_COOKIE can be accessed.<br>\n");
    document.write( 'result: ' + (stuff == 'data with spaces' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();
test2();


