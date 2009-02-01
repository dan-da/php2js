

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
        
function get_magic_num() { return 5; }

var i = 5;
document.write( "Test || and order of operations with parens.<br>\n");
if( (i < 10 && i > 6) || i == 5 ) { document.write( "pass"); } else { document.write( "fail"); }
document.write( "<br><br>\n\n");

document.write( "Test method call inside if gets evaluated correctly<br>\n");
if( (i < 10 && i > 6) || i == get_magic_num() ) { document.write( "pass"); } else { document.write( "fail"); }
document.write( "<br><br>\n\n");

var success = false;
if(false){
}
else{
        if(true) {
                var success = true;
        }
}
document.write( "Test 'if() {} else{ if() {} }' works correctly.<br>\n");
if( success ) {
    document.write( "pass");
}
else {
    document.write( "fail");
}
document.write( "<br><br>\n\n");


