

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
    
    function say_hi(fname='John', lname='Doe') {
        return "hi "+fname+" "+lname+"";
    }
    var result1 = say_hi();
    var result2 = say_hi('Daffy', 'Duck');
    
    document.write( "Test that default function parameters work as expected.<br>\n");
    document.write( 'result: ' + (result1 == 'hi John Doe' && result2 == 'hi Daffy Duck' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test2() {
    
    function func(fname=___array('ball') ) {
        return fname;
    }
    result1 = func();
    
    document.write( "Test that empty array default parameter works as expected.<br>\n");
    document.write( 'result: ' + (result1[0] == 'ball' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test3() {

    if( true ) {
        function func3() {
            return 'called func3';
        }
    }
    else {
        function func3() {
            return 'did not call func3';
        }
    }
    
    var result1 = func3();
    
    document.write( "Test that function may be conditionally defined.<br>\n");
    document.write( 'result: ' + (result1 == 'called func3' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test4() {
    
    function func4() {
        function func4a() { return 'hello from func4a'; }
    }
    func4();
    var result1 = func4a();
    
    document.write( "Test that function may be called outside scope where defined.<br>\n");
    document.write( 'result: ' + (result1 == 'hello from func4a' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test5() {
    var func5 = 'var func5';
    
    function func5() {
        return 'hello from func5';
    }
    var result = func5();
    
    document.write( "Test that function and variable names do not collide.<br>\n");
    document.write( 'result: ' + (result == 'hello from func5' && func5 == 'var func5' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();
test2();
test3();
test4();
test5();


