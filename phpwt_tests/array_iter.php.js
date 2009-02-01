

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

    var arr = ___array( 'val1', ['key' , 'val2'], 'val3', 'val4', ['key2' , 'val5' ]);
    var buf = '';
    for(var key in arr){var value = arr[key];buf .= value + ' ';
    }
    
    document.write( "Test that mixed assoc and indexed values maintain original order<br>\n");
    document.write( 'Result: ' + ((buf === 'val1 val2 val3 val4 val5 ') ? 'pass' : 'fail') + "<br><br>\n\n");

}

function test2() {

    var arr = ___array( ['key1' , 'val1'], ['key2' , 'val2'], 'val3', 'val4', ['key5' , 'val5'], 'val6', 'val7', 'val8', ['key9' , 'val9' ]);
    var buf = '';
    for(var key in arr){var value = arr[key];buf .= ""+key+":"+value+" ";
    }
    
    document.write( "Test (again) that mixed assoc and indexed values maintain original order<br>\n");
    document.write( 'Result: ' + ((buf === 'key1:val1 key2:val2 0:val3 1:val4 key5:val5 2:val6 3:val7 4:val8 key9:val9 ') ? 'pass' : 'fail') + "<br><br>\n\n");

}



test1();
test2();



