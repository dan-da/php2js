

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
        
document.write( "Test that ! operator works.<br>\n");
document.write( 'Result: ' + ((!false == true) ? 'pass' : 'fail') + "<br><br>\n\n");


