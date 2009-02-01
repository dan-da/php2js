

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

    var arr = ___array(['colors' , ___array(["red" , 'Red'], ['green' , "Green"])],
                 ['car' , 'toyota'],
                 ['candies' , ___array('twix','snickers', 'jolly ranchers')],
                 ['holiday' , 'christmas'
                 ]);
    
    arr['planet'] = 'Earth';

    var okay = arr['colors']['red'] == 'Red' &&
            arr['car'] == 'toyota' &&
            arr['candies'][1] == 'snickers' &&
            arr['holiday'] == 'christmas' &&
            arr['planet'] == 'Earth';
    
    document.write( "Test that assoc array init and deref works<br>\n");
    document.write( 'Result: ' + ((okay === true) ? 'pass' : 'fail') + "<br><br>\n\n");

}

test1();


