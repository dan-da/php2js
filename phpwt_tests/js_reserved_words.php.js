

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
    var do = 'yes';
    var interface = 5;
    var null = null;
    var throw = 'ball';
    var if = 'bool';
    var false = false;
    
    document.write( "spot check that some JS reserved words can be used.<br>\n");
    document.write( 'result: ' + (do == 'yes' && interface == 5 && null === null && throw == 'ball' && if == 'bool' && false === false ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test2() {

    var break = 1;
    var case = 1;
    var catch = 1;
    var continue = 1;
    var default = 1;
    var delete = 1;
    var do = 1;
    var else = 1;
    var false = 1;
    var finally = 1;
    var for = 1;
    var function = 1;
    var if = 1;
    var in = 1;
    var instanceof = 1;
    var new = 1;
    var null = 1;
    var return = 1;
    var switch = 1;
//    $this = 1;  // illegal.  $this is a PHP reserved variable name.
    throw = 1;
    var true = 1;
    var try = 1;
    var typeof = 1;
    var var = 1;
    var void = 1;
    var while = 1;
    var with = 1;
        
    // JS 3 reserved words
    abstract = 1;
    var boolean = 1;
    var byte = 1;
    var char = 1;
    var class = 1;
    var const = 1;
    var debugger = 1;
    var double = 1;
    var enum = 1;
    var export = 1;
    var extends = 1;
    var final = 1;
    var float = 1;
    var goto = 1;
    var implements = 1;
    var import = 1;
    var int = 1;
    var interface = 1;
    var long = 1;
    var native = 1;
    var package = 1;
    var private = 1;
    var protected = 1;
    var public = 1;
    var short = 1;
    var static = 1;
    var super = 1;
    var synchronized = 1;
    var throws = 1;
    var transient = 1;
    var volatile = 1;

    document.write( "Test that all JS reserved words can be used.<br>\n");
    document.write( 'result: ' + ('pass') + "<br><br>\n\n");  // If we didn't get a compilation error, then it passes.  :-)
}

test1();
test2();


