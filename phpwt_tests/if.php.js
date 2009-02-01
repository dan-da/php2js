

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

    var i = 5;
    var buf = '';
    if( i < 10 ) { buf .= 'ok'; }
    
    if( i < 2) {}
    else if( i < 6) { buf .= 'ok'; }
    
    if( i > 10) {}
    else if(i > 7) {}
    else { buf .= 'ok'; }
    
    if( i == 5 ) buf .= 'ok';
    
    document.write( "Test that if, else, elseif work correctly<br>\n");
    document.write( 'result: ' + (buf === 'okokokok' ? 'pass' : 'fail') + "<br><br>\n\n");
    
}

test1();


