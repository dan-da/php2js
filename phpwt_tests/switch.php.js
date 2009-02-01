

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
    var color = 'red';
    var buf = '';
    
    switch( color ) {
        case 'red':
            buf = 'hello';
            break;
        default:
            buf = 'Unknown color!';
            break;
    }
    
    document.write( "Test switch.<br>\n");
    document.write( 'result: ' + (buf === 'hello' ? 'pass' : 'fail') + "<br><br>\n\n");
    
}

test1();


