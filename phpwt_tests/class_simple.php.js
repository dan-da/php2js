

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

    class person {
        var name = 'Mickey Mouse';
        
        function get_name() {
            return this->name;
        }
    }
    
    var p = new person();
    
    document.write( "verifying static variable init and a basic accessor routine<br>\n");
    document.write( "Result: " + (p->get_name() == 'Mickey Mouse' ? 'pass' : 'fail') + "<br><br>\n\n");
}

test1();



