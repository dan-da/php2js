

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

    require( 'include_1.inc' );
    require_once('include_1.inc');
    
    var result = include_1();
    
    document.write( "Test require, require_once, and calling a method in required file.<br>\n");
    document.write( 'result: ' + (result === 'include_1_included' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();


