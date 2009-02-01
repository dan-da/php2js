

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
        
function add_vars( var1, var2 ) {
	return var1 + var2;
}

function test1() {

    var left = 1;
    var right = 5;
    
    var buf = ""+left+" plus "+right+" = " + add_vars( left, right );
    
    document.write( "Test addition and embedding integer vars in a string.<br>\n");
    document.write( 'result: ' + (buf === '1 plus 5 = 6' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    var left = 1 - 10;
    var right = 5 * 3 / (10 - 7);
    var buf = ""+left+" plus "+right+" = " + add_vars( left, right );
    
    document.write( "Test multiplication, division, subtraction, negative number, and order of operations.<br>\n");
    document.write( 'result: ' + (buf === '-9 plus 5 = -4' ? 'pass' : 'fail') + "<br><br>\n\n");
}

test1();
test2();



