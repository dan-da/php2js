

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
    if(true) {
        var data = 'bar2';
    }
    document.write( "Test that variables are visible in function scope when set inside if<br>\n");
    document.write( 'result: ' + (data == 'bar2' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    while(true) {
        var data = 'bar2';
        break;
    }
    document.write( "Test that variables are visible in function scope when set inside while<br>\n");
    document.write( 'result: ' + (data == 'bar2' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test3() {
    for(i = 0; i < 2; i ++) {
        var data = 'bar2';
        break;
    }
    document.write( "Test that variables are visible in function scope when set inside for<br>\n");
    document.write( 'result: ' + (data == 'bar2' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    var arr = ___array('cat');
    for(var ___key in arr){var val = arr[___key];var data = val;
        break;
    }
    document.write( "Test that variables are visible in function scope when set inside foreach<br>\n");
    document.write( 'result: ' + (data == 'cat' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test5() {
    var my_var = 'hey';
    function foo() {
        var my_var = 'you';
    }
    foo();
    
    document.write( "Test that variables are NOT visible in sub-function scope when set inside parent scope<br>\n");
    document.write( 'result: ' + (my_var == 'hey' ? 'pass' : 'fail') + "<br><br>\n\n");
}

var global_var = 'gvar';
function test6() {
     
    
    document.write( "Test that global variable can be seen in function when global keyword is used.<br>\n");
    document.write( 'result: ' + (global_var == 'gvar' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test7() {
     
    
    global_var = 'newval';
    
    document.write( "Test that global variable can be overridden in function when global keyword is used.<br>\n");
    document.write( 'result: ' + (global_var == 'newval' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test8() {
     
    
    document.write( "Test that global variable was globally overridden in previous test.<br>\n");
    document.write( 'result: ' + (global_var == 'newval' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test9() {
     
    
    function t9sub() {
        var global_var = 'stuff';
    }
    t9sub();
    
    document.write( "Test that locally defined variable does not override global variable.<br>\n");
    document.write( 'result: ' + (global_var == 'newval' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test10() {
    var buf = '';
    if (true) {
        var x=1;
        if (true) {
            x=2;
            buf .= x;
        }
        buf .= x;
    }
    buf .= x;
    
    document.write( "Test that variable has same scope everywhere in function and lives outside sub-braces.<br>\n");
    document.write( 'result: ' + (buf == '222' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test11() {
    
    function t11(arg) {
        if( false ) {
            arg ++;
        }
        else {
        var arg = 'foo';
        }
        return arg;
    }
    var result = t11('hey');
    
    document.write( "Test that variable in function parameter list can be redefined after unary op.<br>\n");
    document.write( 'result: ' + (result == 'foo' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test12() {
    
    function t11(arg) {
        arg /= 3;
        return arg;
    }
    var result = t11(12);
    
    document.write( "Test that variable in function parameter does not get redeclared with 'var '<br>\n");
    document.write( 'result: ' + (result == 4 ? 'pass' : 'fail') + "<br><br>\n\n");
}




test1();
test2();
test3();
test4();
test5();
test6();
test7();
test8();
test9();
test10();
test11();
test12();


