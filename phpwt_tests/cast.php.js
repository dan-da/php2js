

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
    var data = (integer)"2";
    
    document.write( "Test casting numeric string to an int<br>\n");
    document.write( 'result: ' + (data === 2 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    var data = (string)2;
    
    document.write( "Test casting integer to a string<br>\n");
    document.write( 'result: ' + (data === '2' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    var data = (int)2.345;
    
    document.write( "Test casting float to an integer<br>\n");
    document.write( 'result: ' + (data === 2 ? 'pass' : 'fail') + "<br><br>\n\n");
}

test1();
test2();
test3();


