

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

    var buf = '';
    var i = 0;
    while( i < 5 ) {
	buf .= ""+i+"";
	i++;
    }
    
    document.write( "Test that while() iterates correctly<br>\n");
    document.write( 'result: ' + (buf === '01234' ? 'pass' : 'fail') + "<br><br>\n\n");

}

test1();


