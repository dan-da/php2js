
Notice: Undefined variable: skip_ahead in /home/websites/random/phpwt/translators/php2js/php2js2.php on line 130


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
        <html>
<body>
    
<h3>Page Title</h3>

<a href="http://google.com">Search on Google</a><br/>


document.write( "Page \"content\"");

    
</body>
</html>
