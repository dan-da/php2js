

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
        
tvar = 1.234567;
document.write( "Test that float works, using "+tvar+".<br>\n");
document.write( 'Result: ' + ((tvar === 1.234567) ? 'pass' : 'fail') + "<br><br>\n\n");

var tvar = 'silly putty string';
document.write( "Test that string works, using '"+tvar+"'.<br>\n");
document.write( 'Result: ' + ((tvar === 'silly putty string') ? 'pass' : 'fail') + "<br><br>\n\n");

tvar = 1234567;
document.write( "Test that int works, using "+tvar+".<br>\n");
document.write( 'Result: ' + ((tvar === 1234567) ? 'pass' : 'fail') + "<br><br>\n\n");

tvar = true;
document.write( "Test that bool works, using "+tvar+".<br>\n");
document.write( 'Result: ' + ((tvar === true) ? 'pass' : 'fail') + "<br><br>\n\n");

tvar = null;
document.write( "Test that null works, using "+tvar+".<br>\n");
document.write( 'Result: ' + ((tvar === null) ? 'pass' : 'fail') + "<br><br>\n\n");


