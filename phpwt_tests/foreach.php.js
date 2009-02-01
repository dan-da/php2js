

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
        
favorites = ___array( ['favcolor' , 'red'],
                    ['favmovie' , 'shawshank'],
                    ['favsong'  , 'Yellow submarine' ]);

function test1(favorites) {
    
    var buf = '';
    for(var ___key in favorites){var fav = favorites[___key];buf .= fav;
    }

    document.write( 'Test foreach($arr as $val)' + "<br>\n");
    document.write( 'result: ' + (buf === 'redshawshankYellow submarine' ? 'pass' : 'fail') + "<br><br>\n\n");
}

    
function test2(favorites) {
    var buf = '';
    for(var key in favorites){var val = favorites[key];buf .= ""+key+": "+val+",";
    }

    document.write( 'Test foreach($arr as $key => $val)' + "<br>\n");
    document.write( 'result: ' + (buf === 'favcolor: red,favmovie: shawshank,favsong: Yellow submarine,' ? 'pass' : 'fail') + "<br><br>\n\n");
}


test1( favorites );
test2( favorites );


