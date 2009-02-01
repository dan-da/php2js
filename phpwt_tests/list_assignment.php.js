

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
    
    var foo = ___array( 5, 6, 7, 8 );
    list( a, b, c ) = foo;

    document.write( "Test that list(\$a, \$b, \$c) work correctly<br>\n");
    document.write( 'result: ' + (a === 5 && b == 6 && c == 7 ? 'pass' : 'fail') + "<br><br>\n\n");

}

test1();


