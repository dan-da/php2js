

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
    var foo = 6;
    JS('foo = 8;');
    
    document.write( "Test single line inline JS() call.<br>\n");
    document.write( 'result: ' + (foo === 8 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    JS('
       for( var i = 0; i < 10; i++) {
        i ++;
       }
       ');
    
    document.write( "Test multi-line JS() code<br>\n");
    document.write( 'result: ' + (i === 10 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    JS(<<< END_JS
       for( var i = 0; i < 10; i++) {
        i ++;
       }
END_JS
    );
    
    document.write( "Test multi-line JS() code inside heredoc<br>\n");
    document.write( 'result: ' + (i === 10 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    JS("
       for( var i = 0; i < 10; i++) {
        i ++;
       }
"
    );
    
    document.write( "Test multi-line JS() code inside double-quoted string<br>\n");
    document.write( 'result: ' + (i === 10 ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test5() {
    // Uncomment to test that php->js compiler correctly throws an exception when string is not constant.
/*    
    $start = 3;
    JS("
       for( var i = $start; i < 10; i++) {
        i ++;
       }
"
    );
    
    echo "Test multi-line JS() code inside double quoted string with embedded var.  Should throw an exception when compiling.<br>\n";
    echo 'result: ' . ($i === 10 ? 'pass' : 'fail') . "<br><br>\n\n";
*/    
}


test1();
test2();
test3();
test4();
test5();


