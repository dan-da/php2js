


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
var _do;
_do = "yes";
var _interface;
_interface = 5;
var _null;
_null = null;
var _throw;
_throw = "ball";
var _if;
_if = "bool";
var _false;
_false = false;
___echo("spot check that some JS reserved words can be used.<br>\n");
___echo("result: "+(_do=="yes"&&_interface==5&&_null===null&&_throw=="ball"&&_if=="bool"&&_false===false?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
var _break;
_break = 1;
var _case;
_case = 1;
var _catch;
_catch = 1;
var _continue;
_continue = 1;
var _default;
_default = 1;
var _delete;
_delete = 1;
var _do;
_do = 1;
var _else;
_else = 1;
var _false;
_false = 1;
var _finally;
_finally = 1;
var _for;
_for = 1;
var _function;
_function = 1;
var _if;
_if = 1;
var _in;
_in = 1;
var _instanceof;
_instanceof = 1;
var _new;
_new = 1;
var _null;
_null = 1;
var _return;
_return = 1;
var _switch;
_switch = 1;
var _throw;
_throw = 1;
var _true;
_true = 1;
var _try;
_try = 1;
var _typeof;
_typeof = 1;
var _var;
_var = 1;
var _void;
_void = 1;
var _while;
_while = 1;
var _with;
_with = 1;
var _abstract;
_abstract = 1;
var _boolean;
_boolean = 1;
var _byte;
_byte = 1;
var _char;
_char = 1;
var _class;
_class = 1;
var _const;
_const = 1;
var _debugger;
_debugger = 1;
var _double;
_double = 1;
var _enum;
_enum = 1;
var _export;
_export = 1;
var _extends;
_extends = 1;
var _final;
_final = 1;
var _float;
_float = 1;
var _goto;
_goto = 1;
var _implements;
_implements = 1;
var _import;
_import = 1;
var _int;
_int = 1;
var _interface;
_interface = 1;
var _long;
_long = 1;
var _native;
_native = 1;
var _package;
_package = 1;
var _private;
_private = 1;
var _protected;
_protected = 1;
var _public;
_public = 1;
var _short;
_short = 1;
var _static;
_static = 1;
var _super;
_super = 1;
var _synchronized;
_synchronized = 1;
var _throws;
_throws = 1;
var _transient;
_transient = 1;
var _volatile;
_volatile = 1;
___echo("Test that all JS reserved words can be used.<br>\n");
___echo("result: "+"pass"+"<br><br>\n\n");
}

test1();
test2();


