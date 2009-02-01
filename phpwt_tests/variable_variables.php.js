

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
    var attr = 'color';
    
    document.write( "Test $$ operator<br>\n");
    document.write( 'result: ' + ($attr == 'red' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    class foo { var bar = 'green'; }
    var f = new foo();
    
    var attr = 'bar';
    
    document.write( "Test \$object->\$attr operator<br>\n");
    document.write( 'result: ' + (f->attr == 'green' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    
    function get_name() {return 'sally';}
    var func = 'get_name';
    
    document.write( "Test \$func() operator<br>\n");
    document.write( 'result: ' + (func() == 'sally' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test4() {
    class foo2 { function get_name() { return 'dolly'; } }
    var f = new foo2();
    
    var func = 'get_name';
    
    document.write( "Test \$object->\$func() operator<br>\n");
    document.write( 'result: ' + (f->func() == 'dolly' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();
test2();
test3();
test4();


