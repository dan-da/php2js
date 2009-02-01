

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
    var sum = 2;
    sum += 5;
    
    document.write( "Test += operator<br>\n");
    document.write( 'result: ' + (sum == '7' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    var sum = 8;
    sum -= 5;
    
    document.write( "Test -= operator<br>\n");
    document.write( 'result: ' + (sum == '3' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    var sum = 9;
    sum /= 3;
    
    document.write( "Test /= operator<br>\n");
    document.write( 'result: ' + (sum == '3' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    var sum = 4;
    sum *= 3;
    
    document.write( "Test *= operator<br>\n");
    document.write( 'result: ' + (sum == '12' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test5() {
    var str = 'hello ';
    str .= 'world';
    
    document.write( "Test .= operator<br>\n");
    document.write( 'result: ' + (str == 'hello world' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test6() {
    for( i = 0; i < 3; i ++) {
        buf .= '!';
    }
    
    document.write( "Test .= operator applied to undeclared variable, in a loop.<br>\n");
    document.write( 'result: ' + (buf == '!!!' ? 'pass' : 'fail') + "<br><br>\n\n");
}



test1();
test2();
test3();
test4();
test5();
test6();


