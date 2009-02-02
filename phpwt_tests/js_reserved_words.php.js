


function ___getall(QueryString) {

	var QS, AllElements, CurElement, CurName, CurVal

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

        
;

Function.prototype.inheritsFrom = function(parentClassOrObject) {
    p = this.prototype;
    if (parentClassOrObject.constructor == Function)
    {
        this.prototype = new parentClassOrObject;
        this.prototype.constructor = this;
        this.prototype.__parent = parentClassOrObject.prototype;
    }
    else
    {
        this.prototype = parentClassOrObject;
        this.prototype.constructor = this;
        this.prototype.__parent = parentClassOrObject;
    }
    return this;
}

___echo = function(v) {
    if (typeof document == 'undefined') print(v);
    else document.write(v);
}


if (typeof(window) == 'undefined') {
    window = this;
}




test1 = function() {
var _do = "yes";
var _interface = 5;
var _null = null;
var _throw = "ball";
var _if = "bool";
var _false = false;
___echo("spot check that some JS reserved words can be used.<br>\n");
___echo("result: "+(_do=="yes"&&_interface==5&&_null===null&&_throw=="ball"&&_if=="bool"&&_false===false?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
var _break = 1;
var _case = 1;
var _catch = 1;
var _continue = 1;
var _default = 1;
var _delete = 1;
var _do = 1;
var _else = 1;
var _false = 1;
var _finally = 1;
var _for = 1;
var _function = 1;
var _if = 1;
var _in = 1;
var _instanceof = 1;
var _new = 1;
var _null = 1;
var _return = 1;
var _switch = 1;
var _throw = 1;
var _true = 1;
var _try = 1;
var _typeof = 1;
var _var = 1;
var _void = 1;
var _while = 1;
var _with = 1;
var _abstract = 1;
var _boolean = 1;
var _byte = 1;
var _char = 1;
var _class = 1;
var _const = 1;
var _debugger = 1;
var _double = 1;
var _enum = 1;
var _export = 1;
var _extends = 1;
var _final = 1;
var _float = 1;
var _goto = 1;
var _implements = 1;
var _import = 1;
var _int = 1;
var _interface = 1;
var _long = 1;
var _native = 1;
var _package = 1;
var _private = 1;
var _protected = 1;
var _public = 1;
var _short = 1;
var _static = 1;
var _super = 1;
var _synchronized = 1;
var _throws = 1;
var _transient = 1;
var _volatile = 1;
___echo("Test that all JS reserved words can be used.<br>\n");
___echo("result: "+"pass"+"<br><br>\n\n");
}

test1();
test2();


