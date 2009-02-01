

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
    var data = '"';
    
    document.write( "Test Double quotes embedded in a single-quote string.<br>\n");
    document.write( 'result: ' + (data === '"' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    var data = "'";
    
    document.write( "Test single quotes embedded in a double-quote string.<br>\n");
    document.write( 'result: ' + (data === "'" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    var data = "\n";
    
    document.write( "Test escaped newline embedded in a double-quote string.<br>\n");
    document.write( 'result: ' + (data === "\n" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    var data = '\n';
    
    document.write( "Test escaped newline embedded in a single-quote string.<br>\n");
    document.write( 'result: ' + (data === "\\n" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test5() {
    var data = "1
2";
    
    document.write( "Test real newline in a string. (multi-line string)<br>\n");
    document.write( 'result: ' + (data === "1\n2" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test6() {
    var data = "\"";
    
    document.write( "Test escaped quote in a string. <br>\n");
    document.write( 'result: ' + (data === "\"" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test7() {
    var days = ___array('monday', 'tuesday');
    var day_idx = 1;
    var animal = 'cat';
    
    var data = <<< END
line1 days[day_idx]
line2 kitty_{animal}
line3
END;
    
    document.write( "Test heredoc multiline string with embedded variables. <br>\n");
    document.write( 'result: ' + (data === "line1 tuesday\nline2 kitty_cat\nline3" ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1();
test2();
test3();
test4();
test5();
test6();
test7();


