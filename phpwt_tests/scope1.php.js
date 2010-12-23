


function ___getall(QueryString) {

	var QS, AllElements, CurElement, CurName, CurVal;

	QS = new Object();

		// Determine the string to use
	if ( !QueryString && typeof location != 'undefined') {
		QueryString = location.search;
	};
        if( !QueryString ) {
            return QS;
        }
		// Split the query string on the ampersand (the substring removes the question mark)
	AllElements = QueryString.substring(1).split('&');

		// Loop over the elements
	for( var Cnt = 0; Cnt < AllElements.length; Cnt++) {
			// Split the current element on the equals sign
		CurElement = AllElements[Cnt].split('=');
		CurName = unescape(CurElement[0]).replace(/^\s*|\s*$/g,'');
			// Call the get method to obtain the value
		if ( CurName.length > 0 ) {
			QS[CurName] = getparam(CurName);
		};
	};

		// Return the object
	return QS;
};
_GET = ___getall();

function ___load_cookies() {
  var cr = {};
  if( typeof document == 'undefined' ) {
    return cr;
  }
  if (document.cookie != '') {
  var ck = document.cookie.split('; ');
  
    for (var i=ck.length - 1; i>= 0; i--) {
      var cv = ck[i].split('=');
      cr[cv[0]]=cv[1];
    }
  }
  return cr;
}
_COOKIE = ___load_cookies();

function Exception(msg, code) {
    this.message = msg && msg.length ? msg : 'Unknown exception';
    this.code = code;
    this.file = null;
    this.line = 0;
    
    this.getMessage = function() {
        return this.message;
    }
    this.getCode = function() {
        return this.code;
    }
    this.getFile = function() {
        return this.file;
    }
    this.getLine = function() {
        return this.line;
    }
    this.getTrace = function() {
        return [];
    }
    this.getTraceAsString = function() {
        return '';
    }
    this.__toString = function() {
        return 'Exception: ' + this.message;
    }
}

        

function ___array() {
  var arr = [];
  for (var i = 0; i < ___array.arguments.length; ++i) {
    var item = ___array.arguments[i];
    if(item instanceof Array && item.length == 3 && item[0] == '__kv') {
        arr[item[1]] = item[2];
    }
    else {
        arr.push( item );
    }
  }
  return arr;
}


function getparam(Name, ReturnStyle, QueryString) {

	var AllElements, CurElement, CurName, CurVal, ReturnVal

		// Set the Name
	Name = Name.replace(/^\s*|\s*$/g,'');
		// Init the return
	ReturnVal = null;

		// Determine the string to use
	if ( !QueryString ) {
		QueryString = location.search;
	};
		// Split the query string on the ampersand (the substring removes the question mark)
	AllElements = QueryString.substring(1).split('&');

		// Loop over the string
	for( var Cnt = 0; Cnt < AllElements.length; Cnt++) {
			// Split the current element on the equals sign
		CurElement = AllElements[Cnt].split('=');
			// Unescape and Trim the returned name
		CurName = unescape(CurElement[0]).replace(/^\s*|\s*$/g,'');
		if ( Name == CurName ) {
				// Generate the array if needed
			if ( !ReturnVal ) { ReturnVal = new Array };
				// Get the Value
			CurVal = CurElement[1];
				// Determine how the value should be represented
			if ( CurVal ) {
				CurVal = unescape(CurVal);
			} else {
				CurVal = '';
			};
			ReturnVal[ReturnVal.length] = CurVal;
		};
	};

        return ReturnVal;

};

Function.prototype.inheritsFrom = function( parentClassOrObject ){
        p = this.prototype;
	if ( parentClassOrObject.constructor == Function ) 
	{
	    for( x in parentClassOrObject ) {
	      this[x] = parentClassOrObject[x];
	    }
            /* Normal Inheritance */
            this.prototype = new parentClassOrObject;
            this.prototype.constructor = this;
            this.prototype.__parent = parentClassOrObject.prototype;
	} 
	else 
	{ 
            /* Pure Virtual Inheritance */
            this.prototype = parentClassOrObject;
            this.prototype.constructor = this;
            this.prototype.__parent = parentClassOrObject;
	} 
	return this;
}
function prepare_str_concat(v) {if(v==undefined) v='';return v;}
function ___echo(v) {if(typeof document=='undefined') print(v); else document.write(v);}

function ___clone (o) {
    function c(o) {
        for (var i in o) {
            this[i] = o[i];
        }
    }
    var d = new c(o);
    if( d.__clone ) {
        d.__clone();
    }
    return d;
}
test1 = function() {
if(true) {
var data;
data = "bar2";
}

___echo("Test that variables are visible in function scope when set inside if<br>\n");
___echo("result: "+(data=="bar2"?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
while(true) {
var data;
data = "bar2";
break;
}
___echo("Test that variables are visible in function scope when set inside while<br>\n");
___echo("result: "+(data=="bar2"?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
var i;
var data;
for(i = 0;i<2;i++) {
data = "bar2";
break;
}
___echo("Test that variables are visible in function scope when set inside for<br>\n");
___echo("result: "+(data=="bar2"?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
var arr;
arr = ___array("cat");
var val;
var data;
for(var ____idx in arr) {
val=arr[____idx];
data = val;
break;
}
___echo("Test that variables are visible in function scope when set inside foreach<br>\n");
___echo("result: "+(data=="cat"?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
var my_var;
my_var = "hey";
foo = function() {
var my_var;
my_var = "you";
}

foo();
___echo("Test that variables are NOT visible in sub-function scope when set inside parent scope<br>\n");
___echo("result: "+(my_var=="hey"?"pass":"fail")+"<br><br>\n\n");
}

var global_var;
global_var = "gvar";
test6 = function() {

___echo("Test that global variable can be seen in function when global keyword is used.<br>\n");
___echo("result: "+(global_var=="gvar"?"pass":"fail")+"<br><br>\n\n");
}

test7 = function() {

global_var = "newval";
___echo("Test that global variable can be overridden in function when global keyword is used.<br>\n");
___echo("result: "+(global_var=="newval"?"pass":"fail")+"<br><br>\n\n");
}

test8 = function() {

___echo("Test that global variable was globally overridden in previous test.<br>\n");
___echo("result: "+(global_var=="newval"?"pass":"fail")+"<br><br>\n\n");
}

test9 = function() {

t9sub = function() {
var global_var;
global_var = "stuff";
}

t9sub();
___echo("Test that locally defined variable does not override global variable.<br>\n");
___echo("result: "+(global_var=="newval"?"pass":"fail")+"<br><br>\n\n");
}

test10 = function() {
var buf;
buf = "";
if(true) {
var x;
x = 1;
if(true) {
x = 2;
buf+=x;
}

buf+=x;
}

buf+=x;
___echo("Test that variable has same scope everywhere in function and lives outside sub-braces.<br>\n");
___echo("result: "+(buf=="222"?"pass":"fail")+"<br><br>\n\n");
}

test11 = function() {
t11 = function(arg) {
if(false) {
arg++;
}
else {
arg = "foo";
}
return arg;
}

var result;
result = t11("hey");
___echo("Test that variable in function parameter list can be redefined after unary op.<br>\n");
___echo("result: "+(result=="foo"?"pass":"fail")+"<br><br>\n\n");
}

test12 = function() {
t11 = function(arg) {
arg/=3;
return arg;
}

var result;
result = t11(12);
___echo("Test that variable in function parameter does not get redeclared with 'var '<br>\n");
___echo("result: "+(result==4?"pass":"fail")+"<br><br>\n\n");
}

test1();
test2();
test3();
test4();
test5();
test6();
test7();
test8();
test9();
test10();
test11();
test12();


