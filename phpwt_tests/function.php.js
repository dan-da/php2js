


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
say_hi = function(fname,lname) {
if (typeof fname == "undefined") { fname = "John"; }
if (typeof lname == "undefined") { lname = "Doe"; }
return "hi "+fname+" "+lname+"";
}

var result1;
result1 = say_hi();
var result2;
result2 = say_hi("Daffy","Duck");
___echo("Test that default function parameters work as expected.<br>\n");
___echo("result: "+(result1=="hi John Doe"&&result2=="hi Daffy Duck"?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
func = function(fname) {
if (typeof fname == "undefined") { fname = ___array("ball"); }
return fname;
}

var result1;
result1 = func();
___echo("Test that empty array default parameter works as expected.<br>\n");
___echo("result: "+(result1[0]=="ball"?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
if(true) {
func3 = function() {
return "called func3";
}

}
else {
func3 = function() {
return "did not call func3";
}

}
var result1;
result1 = func3();
___echo("Test that function may be conditionally defined.<br>\n");
___echo("result: "+(result1=="called func3"?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
func4 = function() {
func4a = function() {
return "hello from func4a";
}

}

func4();
var result1;
result1 = func4a();
___echo("Test that function may be called outside scope where defined.<br>\n");
___echo("result: "+(result1=="hello from func4a"?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
var func5;
func5 = "var func5";
func5 = function() {
return "hello from func5";
}

var result;
result = func5();
___echo("Test that function and variable names do not collide.<br>\n");
___echo("result: "+(result=="hello from func5"&&func5=="var func5"?"pass":"fail")+"<br><br>\n\n");
}

test1();
test2();
test3();
test4();
test5();


