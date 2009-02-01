

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
        
define( 'GLOBAL_CONST', 'globals_r_bad');

function test1() {
    
    define( 'APPLE_COLOR', 'red');

    document.write( "Test define works correctly with a string<br>\n");
    document.write( 'result: ' + (APPLE_COLOR === 'red' ? 'pass' : 'fail') + "<br><br>\n\n");

}

function test2() {
    
    define( 'APPLE_COUNT', 3);

    document.write( "Test define works correctly with an integer<br>\n");
    document.write( 'result: ' + (APPLE_COUNT === 3 ? 'pass' : 'fail') + "<br><br>\n\n");

}

function test3() {
    
    document.write( "Test global define works correctly<br>\n");
    document.write( 'result: ' + (GLOBAL_CONST === 'globals_r_bad' ? 'pass' : 'fail') + "<br><br>\n\n");

}


test1();
test2();
test3();




