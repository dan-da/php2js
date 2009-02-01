

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

    var arr = ___array("red","green","blue",1,2,3);
    
    arr[6] = 'this element was added later!';
    
    newarr[7] = 'new arr, new elem';
    newarr[] = 'new elem, added to end of array';
    
    var buf = arr[0] +
           arr[1] + 
           arr[2]+
           arr[3]+
           arr[4]+
           arr[5]+
           arr[6]+
           newarr[7]+
           newarr[8];

    document.write( "Test array initialization, indexed assignment, and append via []<br>\n");
    document.write( 'Result: ' + ((buf === 'redgreenblue123this element was added later!new arr, new elemnew elem, added to end of array') ? 'pass' : 'fail') + "<br><br>\n\n");
       
}

function test2() {
    
    var arr = ___array(___array("foo0", "bar0", "baz0", "toto0", "tintin0"),
            ___array("foo1", "bar1", "baz1", "toto1", "tintin1"),
            ___array("foo2", "bar2", "baz2", "toto2", "tintin2"),
            ___array("foo3", "bar3", "baz3", "toto3", "tintin3"),
            ___array("foo4", "bar4", "baz4", "toto4", "tintin4"));
    
    document.write( "Test nested indexed arrays.<br>\n");
    document.write( 'Result: ' + ((arr[3][3] === 'toto3') ? 'pass' : 'fail') + "<br><br>\n\n");
}

test1();
test2();
       


