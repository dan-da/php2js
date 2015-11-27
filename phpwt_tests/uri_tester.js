


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
set_include_path(get_include_path()+PATH_SEPARATOR+dirname(dirname("__FILE__")));
{ /* begin class Inspekt_Error */
function Inspekt_Error() {

}
Inspekt_Error.prototype.raiseError = function(msg,type) {
if (typeof type == "undefined") { type = E_USER_WARNING; }
Inspekt_Error.raiseErrorPHP4(msg,type);
}
Inspekt_Error.raiseError = Inspekt_Error.prototype.raiseError;
Inspekt_Error.prototype.raiseErrorPHP4 = function(msg,type) {
if (typeof type == "undefined") { type = null; }
if(isset(type)) {
trigger_error(msg);
}
else {
trigger_error(msg,type);
}
}
Inspekt_Error.raiseErrorPHP4 = Inspekt_Error.prototype.raiseErrorPHP4;
} /* end class Inspekt_Error */


define("ISPK_ARRAY_PATH_SEPARATOR","/");
define("ISPK_RECURSION_MAX",10);
{ /* begin class Inspekt_Cage */
function Inspekt_Cage() {this._source=null;this._autofilter_conf=null;

}
Inspekt_Cage.prototype.Factory = function(source,conf_file,conf_section,strict) {
if (typeof conf_file == "undefined") { conf_file = null; }
if (typeof conf_section == "undefined") { conf_section = null; }
if (typeof strict == "undefined") { strict = TRUE; }
if(!is_array(source)) {
user_error("$source "+source+" is not an array",E_USER_NOTICE);
}

var cage;
cage = new Inspekt_Cage;
cage._setSource(source);
cage._parseAndApplyAutoFilters(conf_file,conf_section);
if(strict) {
source = null;
}

return cage;
}
Inspekt_Cage.Factory = Inspekt_Cage.prototype.Factory;
Inspekt_Cage.prototype._setSource = function(newsource) {
if(!is_array(newsource)) {
user_error("$source is not an array",E_USER_NOTICE);
}

this._source = newsource;
}
Inspekt_Cage._setSource = Inspekt_Cage.prototype._setSource;
Inspekt_Cage.prototype._parseAndApplyAutoFilters = function(conf_file,conf_section) {
if(isset(conf_file)) {
var conf;
conf = parse_ini_file(conf_file,true);
if(conf_section) {
if(isset(conf[conf_section])) {
this._autofilter_conf = conf[conf_section];
}

}
else {
this._autofilter_conf = conf;
}
this._applyAutoFilters();
}

}
Inspekt_Cage._parseAndApplyAutoFilters = Inspekt_Cage.prototype._parseAndApplyAutoFilters;
Inspekt_Cage.prototype._applyAutoFilters = function() {
if(isset(this._autofilter_conf)&&is_array(this._autofilter_conf)) {
var key;
var filters;
var uni_filters;
var this_filter;
var val;
for(var key in this._autofilter_conf) {
filters=this._autofilter_conf[key];
if(key=="*") {
uni_filters = explode(",",this._autofilter_conf[key]);
array_walk(uni_filters,"trim");
for(var ____idx in uni_filters) {
this_filter=uni_filters[____idx];
for(var key in this._source) {
val=this._source[key];
this._source[key] = this[eval("this_filter")](key);
}
}

}
else if(val = this.keyExists(key)) {
filters = explode(",",this._autofilter_conf[key]);
array_walk(filters,"trim");
for(var ____idx in filters) {
this_filter=filters[____idx];
this._setValue(key,this[eval("this_filter")](key));
}

}

}
}

}
Inspekt_Cage._applyAutoFilters = Inspekt_Cage.prototype._applyAutoFilters;
Inspekt_Cage.prototype.getAlpha = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getAlpha(this._getValue(key));
}
Inspekt_Cage.getAlpha = Inspekt_Cage.prototype.getAlpha;
Inspekt_Cage.prototype.getAlnum = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getAlnum(this._getValue(key));
}
Inspekt_Cage.getAlnum = Inspekt_Cage.prototype.getAlnum;
Inspekt_Cage.prototype.getDigits = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getDigits(this._getValue(key));
}
Inspekt_Cage.getDigits = Inspekt_Cage.prototype.getDigits;
Inspekt_Cage.prototype.getDir = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getDir(this._getValue(key));
}
Inspekt_Cage.getDir = Inspekt_Cage.prototype.getDir;
Inspekt_Cage.prototype.getInt = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getInt(this._getValue(key));
}
Inspekt_Cage.getInt = Inspekt_Cage.prototype.getInt;
Inspekt_Cage.prototype.getPath = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.getPath(this._getValue(key));
}
Inspekt_Cage.getPath = Inspekt_Cage.prototype.getPath;
Inspekt_Cage.prototype.getRaw = function(key) {
if(!this.keyExists(key)) {
return false;
}

return this._getValue(key);
}
Inspekt_Cage.getRaw = Inspekt_Cage.prototype.getRaw;
Inspekt_Cage.prototype.testAlnum = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isAlnum(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testAlnum = Inspekt_Cage.prototype.testAlnum;
Inspekt_Cage.prototype.testAlpha = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isAlpha(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testAlpha = Inspekt_Cage.prototype.testAlpha;
Inspekt_Cage.prototype.testBetween = function(key,min,max,inc) {
if (typeof inc == "undefined") { inc = TRUE; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isBetween(this._getValue(key),min,max,inc)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testBetween = Inspekt_Cage.prototype.testBetween;
Inspekt_Cage.prototype.testCcnum = function(key,type) {
if (typeof type == "undefined") { type = null; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isCcnum(this._getValue(key),type)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testCcnum = Inspekt_Cage.prototype.testCcnum;
Inspekt_Cage.prototype.testDate = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isDate(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testDate = Inspekt_Cage.prototype.testDate;
Inspekt_Cage.prototype.testDigits = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isDigits(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testDigits = Inspekt_Cage.prototype.testDigits;
Inspekt_Cage.prototype.testEmail = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isEmail(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testEmail = Inspekt_Cage.prototype.testEmail;
Inspekt_Cage.prototype.testFloat = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isFloat(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testFloat = Inspekt_Cage.prototype.testFloat;
Inspekt_Cage.prototype.testGreaterThan = function(key,min) {
if (typeof min == "undefined") { min = null; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isGreaterThan(this._getValue(key),min)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testGreaterThan = Inspekt_Cage.prototype.testGreaterThan;
Inspekt_Cage.prototype.testHex = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isHex(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testHex = Inspekt_Cage.prototype.testHex;
Inspekt_Cage.prototype.testHostname = function(key,allow) {
if (typeof allow == "undefined") { allow = ISPK_HOST_ALLOW_ALL; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isHostname(this._getValue(key),allow)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testHostname = Inspekt_Cage.prototype.testHostname;
Inspekt_Cage.prototype.testInt = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isInt(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testInt = Inspekt_Cage.prototype.testInt;
Inspekt_Cage.prototype.testIp = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isIp(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testIp = Inspekt_Cage.prototype.testIp;
Inspekt_Cage.prototype.testLessThan = function(key,max) {
if (typeof max == "undefined") { max = null; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isLessThan(this._getValue(key),max)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testLessThan = Inspekt_Cage.prototype.testLessThan;
Inspekt_Cage.prototype.testOneOf = function(key,allowed) {
if (typeof allowed == "undefined") { allowed = null; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isOneOf(this._getValue(key),allowed)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testOneOf = Inspekt_Cage.prototype.testOneOf;
Inspekt_Cage.prototype.testPhone = function(key,country) {
if (typeof country == "undefined") { country = "US"; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isPhone(this._getValue(key),country)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testPhone = Inspekt_Cage.prototype.testPhone;
Inspekt_Cage.prototype.testRegex = function(key,pattern) {
if (typeof pattern == "undefined") { pattern = null; }
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isRegex(this._getValue(key),pattern)) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testRegex = Inspekt_Cage.prototype.testRegex;
Inspekt_Cage.prototype.testUri = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isUri(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testUri = Inspekt_Cage.prototype.testUri;
Inspekt_Cage.prototype.testZip = function(key) {
if(!this.keyExists(key)) {
return false;
}

if(Inspekt.isZip(this._getValue(key))) {
return this._getValue(key);
}

return FALSE;
}
Inspekt_Cage.testZip = Inspekt_Cage.prototype.testZip;
Inspekt_Cage.prototype.noTags = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.noTags(this._getValue(key));
}
Inspekt_Cage.noTags = Inspekt_Cage.prototype.noTags;
Inspekt_Cage.prototype.noPath = function(key) {
if(!this.keyExists(key)) {
return false;
}

return Inspekt.noPath(this._getValue(key));
}
Inspekt_Cage.noPath = Inspekt_Cage.prototype.noPath;
Inspekt_Cage.prototype.keyExists = function(key) {
if(strpos(key,ISPK_ARRAY_PATH_SEPARATOR)!==FALSE) {
key = trim(key,ISPK_ARRAY_PATH_SEPARATOR);
var keys;
keys = explode(ISPK_ARRAY_PATH_SEPARATOR,key);
return this._keyExistsRecursive(keys,this._source);
}
else {
return array_key_exists(key,this._source);
}
}
Inspekt_Cage.keyExists = Inspekt_Cage.prototype.keyExists;
Inspekt_Cage.prototype._keyExistsRecursive = function(keys,data_array) {
var thiskey;
thiskey = current(keys);
if(is_numeric(thiskey)) {
thiskey = parseInt(thiskey);
}

if(array_key_exists(thiskey,data_array)) {
if(sizeof(keys)==1) {
return true;
}
else if(is_array(data_array[thiskey])) {
unset(keys[key(keys)]);
return this._keyExistsRecursive(keys,data_array[thiskey]);
}

}
else {
return false;
}
}
Inspekt_Cage._keyExistsRecursive = Inspekt_Cage.prototype._keyExistsRecursive;
Inspekt_Cage.prototype._getValue = function(key) {
if(strpos(key,ISPK_ARRAY_PATH_SEPARATOR)!==FALSE) {
key = trim(key,ISPK_ARRAY_PATH_SEPARATOR);
var keys;
keys = explode(ISPK_ARRAY_PATH_SEPARATOR,key);
return this._getValueRecursive(keys,this._source);
}
else {
return this._source[key];
}
}
Inspekt_Cage._getValue = Inspekt_Cage.prototype._getValue;
Inspekt_Cage.prototype._getValueRecursive = function(keys,data_array,level) {
if (typeof level == "undefined") { level = 0; }
var thiskey;
thiskey = current(keys);
if(is_numeric(thiskey)) {
thiskey = parseInt(thiskey);
}

if(array_key_exists(thiskey,data_array)) {
if(sizeof(keys)==1) {
return data_array[thiskey];
}
else if(is_array(data_array[thiskey])) {
if(level<ISPK_RECURSION_MAX) {
unset(keys[key(keys)]);
return this._getValueRecursive(keys,data_array[thiskey],level+1);
}
else {
trigger_error("Recursion limit met",E_USER_WARNING);
return false;
}
}

}
else {
return false;
}
}
Inspekt_Cage._getValueRecursive = Inspekt_Cage.prototype._getValueRecursive;
Inspekt_Cage.prototype._setValue = function(key,val) {
if(strpos(key,ISPK_ARRAY_PATH_SEPARATOR)!==FALSE) {
key = trim(key,ISPK_ARRAY_PATH_SEPARATOR);
var keys;
keys = explode(ISPK_ARRAY_PATH_SEPARATOR,key);
return this._setValueRecursive(keys,this._source);
}
else {
this._source[key] = val;
return this._source[key];
}
}
Inspekt_Cage._setValue = Inspekt_Cage.prototype._setValue;
Inspekt_Cage.prototype._setValueRecursive = function(keys,val,data_array,level) {
if (typeof level == "undefined") { level = 0; }
var thiskey;
thiskey = current(keys);
if(is_numeric(thiskey)) {
thiskey = parseInt(thiskey);
}

if(array_key_exists(thiskey,data_array)) {
if(sizeof(keys)==1) {
data_array[thiskey] = val;
return data_array[thiskey];
}
else if(is_array(data_array[thiskey])) {
if(level<ISPK_RECURSION_MAX) {
unset(keys[key(keys)]);
return this._setValueRecursive(keys,val,data_array[thiskey],level+1);
}
else {
trigger_error("Recursion limit met",E_USER_WARNING);
return false;
}
}

}
else {
return false;
}
}
Inspekt_Cage._setValueRecursive = Inspekt_Cage.prototype._setValueRecursive;
} /* end class Inspekt_Cage */


{ /* begin class Inspekt_Cage_Session */
function Inspekt_Cage_Session() {}
Inspekt_Cage_Session.inheritsFrom( Inspekt_Cage );
Inspekt_Cage_Session.prototype.Factory = function(source,conf_file,conf_section,strict) {
if (typeof conf_file == "undefined") { conf_file = null; }
if (typeof conf_section == "undefined") { conf_section = null; }
if (typeof strict == "undefined") { strict = TRUE; }
if(!is_array(source)) {
user_error("$source "+source+" is not an array",E_USER_NOTICE);
}

var cage;
cage = new Inspekt_Cage_Session;
cage._setSource(source);
var conf;
cage._parseAndApplyAutoFilters(conf);
if(ini_get("session.use_cookies")||ini_get("session.use_only_cookies")) {
var _COOKIE;
var cookie;
if(isset(_COOKIE)&&isset(_COOKIE[session_name()])) {
session_id(_COOKIE[session_name()]);
}
else if(cookie = Inspekt.makeSessionCage()) {
session_id(cookie.getAlnum(session_name()));
}

}
else {
var _GET;
if(isset(_GET)&&isset(_GET[session_name()])) {
session_id(_GET[session_name()]);
}
else if(cookie = Inspekt.makeSessionCage()) {
session_id(cookie.getAlnum(session_name()));
}

}
if(strict) {
source = null;
}

return cage;
register_shutdown_function();
register_shutdown_function(___array(this,"_repopulateSession"));

}
Inspekt_Cage_Session.Factory = Inspekt_Cage_Session.prototype.Factory;
Inspekt_Cage_Session.prototype._repopulateSession = function() {
var _SESSION;
_SESSION = ___array();
_SESSION = this._source;

}
Inspekt_Cage_Session._repopulateSession = Inspekt_Cage_Session.prototype._repopulateSession;
} /* end class Inspekt_Cage_Session */




{ /* begin class Inspekt_Supercage */
function Inspekt_Supercage() {this.get;this.post;this.cookie;this.env;this.files;this.session;this.server;

}
Inspekt_Supercage.prototype.Factory = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }
var sc;
sc = new Inspekt_Supercage;
sc._makeCages(strict,config_file);
if(strict) {
var _REQUEST;
_REQUEST = null;
}

return sc;

}
Inspekt_Supercage.Factory = Inspekt_Supercage.prototype.Factory;
Inspekt_Supercage.prototype._makeCages = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }
this.get = Inspekt.makeGetCage(config_file,strict);
this.post = Inspekt.makePostCage(config_file,strict);
this.cookie = Inspekt.makeCookieCage(config_file,strict);
this.env = Inspekt.makeEnvCage(config_file,strict);
this.files = Inspekt.makeFilesCage(config_file,strict);
this.server = Inspekt.makeServerCage(config_file,strict);
}
Inspekt_Supercage._makeCages = Inspekt_Supercage.prototype._makeCages;
} /* end class Inspekt_Supercage */


define("ISPK_HOST_ALLOW_DNS",1);
define("ISPK_HOST_ALLOW_IP",2);
define("ISPK_HOST_ALLOW_LOCAL",4);
define("ISPK_HOST_ALLOW_ALL",7);
define("ISPK_URI_ALLOW_COMMON",1);
define("ISPK_DNS_VALID","/^(?:[^\\W_]((?:[^\\W_]|-){0,61}[^\\W_])?\\.)+[a-zA-Z]{2,6}\\.?$/");
define("ISPK_EMAIL_VALID","/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,6}$/");
{ /* begin class Inspekt */
function Inspekt() {}Inspekt.prototype.makeServerCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _SERVER;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_SERVER,config_file,"_SERVER",strict);
}

var GLOBALS;
GLOBALS["HTTP_SERVER_VARS"] = null;
return _instance;
}
Inspekt.makeServerCage = Inspekt.prototype.makeServerCage;
Inspekt.prototype.makeGetCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _GET;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_GET,config_file,"_GET",strict);
}

var GLOBALS;
GLOBALS["HTTP_GET_VARS"] = null;
return _instance;
}
Inspekt.makeGetCage = Inspekt.prototype.makeGetCage;
Inspekt.prototype.makePostCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _POST;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_POST,config_file,"_POST",strict);
}

var GLOBALS;
GLOBALS["HTTP_POST_VARS"] = null;
return _instance;
}
Inspekt.makePostCage = Inspekt.prototype.makePostCage;
Inspekt.prototype.makeCookieCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _COOKIE;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_COOKIE,config_file,"_COOKIE",strict);
}

var GLOBALS;
GLOBALS["HTTP_COOKIE_VARS"] = null;
return _instance;
}
Inspekt.makeCookieCage = Inspekt.prototype.makeCookieCage;
Inspekt.prototype.makeEnvCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _ENV;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_ENV,config_file,"_ENV",strict);
}

var GLOBALS;
GLOBALS["HTTP_ENV_VARS"] = null;
return _instance;
}
Inspekt.makeEnvCage = Inspekt.prototype.makeEnvCage;
Inspekt.prototype.makeFilesCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _instance;
var _FILES;
if(!isset(_instance)) {
_instance = Inspekt_Cage.Factory(_FILES,config_file,"_FILES",strict);
}

var GLOBALS;
GLOBALS["HTTP_POST_FILES"] = null;
return _instance;
}
Inspekt.makeFilesCage = Inspekt.prototype.makeFilesCage;
Inspekt.prototype.makeSessionCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }
trigger_error("makeSessionCage is disabled in this version",E_USER_ERROR);

var _SESSION;
if(!isset(_SESSION)) {
return null;
}

var _instance;
if(!isset(_instance)) {
_instance = Inspekt_Cage_Session.Factory(_SESSION,config_file,"_SESSION",strict);
}

var GLOBALS;
GLOBALS["HTTP_SESSION_VARS"] = null;
return _instance;
}
Inspekt.makeSessionCage = Inspekt.prototype.makeSessionCage;
Inspekt.prototype.makeSuperCage = function(config_file,strict) {
if (typeof config_file == "undefined") { config_file = null; }
if (typeof strict == "undefined") { strict = TRUE; }

var _scinstance;
if(!isset(_scinstance)) {
_scinstance = Inspekt_Supercage.Factory(strict,config_file);
}

return _scinstance;

}
Inspekt.makeSuperCage = Inspekt.prototype.makeSuperCage;
Inspekt.prototype._walkArray = function(input,method) {
if(!is_array(input)) {
user_error("$input must be an array",E_USER_ERROR);
return FALSE;
}

if(!is_callable(___array("Inspekt",method))) {
user_error("$inspektor "+method+" is invalid",E_USER_ERROR);
return FALSE;
}

var key;
var val;
for(var key in input) {
val=input[key];
if(is_array(val)) {
input[key] = Inspekt._walkArray(val,method);
}
else {
val = Inspekt[eval("method")](val);
input[key] = val;
}
}
return input;
}
Inspekt._walkArray = Inspekt.prototype._walkArray;
Inspekt.prototype.getAlpha = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getAlpha");
}
else {
return preg_replace("/[^[:alpha:]]/","",value);
}
}
Inspekt.getAlpha = Inspekt.prototype.getAlpha;
Inspekt.prototype.getAlnum = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getAlnum");
}
else {
return preg_replace("/[^[:alnum:]]/","",value);
}
}
Inspekt.getAlnum = Inspekt.prototype.getAlnum;
Inspekt.prototype.getDigits = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getDigits");
}
else {
return preg_replace("/[^\\d]/","",value);
}
}
Inspekt.getDigits = Inspekt.prototype.getDigits;
Inspekt.prototype.getDir = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getDir");
}
else {
return dirname(value);
}
}
Inspekt.getDir = Inspekt.prototype.getDir;
Inspekt.prototype.getInt = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getInt");
}
else {
return parseInt(value);
}
}
Inspekt.getInt = Inspekt.prototype.getInt;
Inspekt.prototype.getPath = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"getPath");
}
else {
return realpath(value);
}
}
Inspekt.getPath = Inspekt.prototype.getPath;
Inspekt.prototype.isAlnum = function(value) {
return ctype_alnum(value);
}
Inspekt.isAlnum = Inspekt.prototype.isAlnum;
Inspekt.prototype.isAlpha = function(value) {
return ctype_alpha(value);
}
Inspekt.isAlpha = Inspekt.prototype.isAlpha;
Inspekt.prototype.isBetween = function(value,min,max,inc) {
if (typeof inc == "undefined") { inc = TRUE; }
if(value>min&&value<max) {
return TRUE;
}

if(inc&&value>=min&&value<=max) {
return TRUE;
}

return FALSE;
}
Inspekt.isBetween = Inspekt.prototype.isBetween;
Inspekt.prototype.isCcnum = function(value,type) {
if (typeof type == "undefined") { type = null; }
value = Inspekt.getDigits(value);
var length;
length = strlen(value);
if(length<13||length>19) {
return FALSE;
}

var sum;
sum = 0;
var weight;
weight = 2;
var i;
var digit;
for(i = length-2;i>=0;i--) {
digit = weight*value[i];
sum+=floor(digit/10)+digit%10;
weight = weight%2+1;
}
var mod;
mod = (10-sum%10)%10;
return (mod==value[length-1]);
}
Inspekt.isCcnum = Inspekt.prototype.isCcnum;
Inspekt.prototype.isDate = function(value) {
var year;
var month;
var day;
var ____i = 0;____tmp = sscanf(value,"%d-%d-%d");year = ____tmp[____i++];month = ____tmp[____i++];day = ____tmp[____i++];;
return checkdate(month,day,year);
}
Inspekt.isDate = Inspekt.prototype.isDate;
Inspekt.prototype.isDigits = function(value) {
return ctype_digit(String(value));
}
Inspekt.isDigits = Inspekt.prototype.isDigits;
Inspekt.prototype.isEmail = function(value) {
return preg_match(ISPK_EMAIL_VALID,value);
}
Inspekt.isEmail = Inspekt.prototype.isEmail;
Inspekt.prototype.isFloat = function(value) {
var locale;
locale = localeconv();
value = str_replace(locale["decimal_point"],".",value);
value = str_replace(locale["thousands_sep"],"",value);
return (strval(floatval(value))==value);
}
Inspekt.isFloat = Inspekt.prototype.isFloat;
Inspekt.prototype.isGreaterThan = function(value,min) {
return (value>min);
}
Inspekt.isGreaterThan = Inspekt.prototype.isGreaterThan;
Inspekt.prototype.isHex = function(value) {
return ctype_xdigit(value);
}
Inspekt.isHex = Inspekt.prototype.isHex;
Inspekt.prototype.isHostname = function(value,allow) {
if (typeof allow == "undefined") { allow = ISPK_HOST_ALLOW_ALL; }
if(!is_numeric(allow)||!is_int(allow)) {
user_error("Illegal value for $allow; expected an integer",E_USER_WARNING);
}

if(allow<ISPK_HOST_ALLOW_DNS||ISPK_HOST_ALLOW_ALL<allow) {
user_error("Illegal value for $allow; expected integer between "+ISPK_HOST_ALLOW_DNS+" and "+ISPK_HOST_ALLOW_ALL,E_USER_WARNING);
}

var status;
status = Inspekt.isIp(value);
if(status) {
if((allow&ISPK_HOST_ALLOW_IP)==0) {
return FALSE;
}

return TRUE;
}

status = preg_match("/^(?:[^\\W_]((?:[^\\W_]|-){0,61}[^\\W_])?\\.)+[a-zA-Z]{2,6}\\.?$/",value);
if(status===false) {
user_error("Internal error: DNS validation failed",E_USER_WARNING);
}

if(status==1&&(allow&ISPK_HOST_ALLOW_DNS)!=0) {
return TRUE;
}

if((allow&ISPK_HOST_ALLOW_LOCAL)==0) {
return FALSE;
}

status = preg_match("/^(?:[^\\W_](?:[^\\W_]|-){0,61}[^\\W_]\\.)*(?:[^\\W_](?:[^\\W_]|-){0,61}[^\\W_])\\.?$/",value);
if(status===FALSE) {
user_error("Internal error: local network name validation failed",E_USER_WARNING);
}

if(status==0) {
return FALSE;
}
else {
return TRUE;
}
}
Inspekt.isHostname = Inspekt.prototype.isHostname;
Inspekt.prototype.isInt = function(value) {
var locale;
locale = localeconv();
value = str_replace(locale["decimal_point"],".",value);
value = str_replace(locale["thousands_sep"],"",value);
return (strval(intval(value))==value);
}
Inspekt.isInt = Inspekt.prototype.isInt;
Inspekt.prototype.isIp = function(value) {
return ip2long(value);
}
Inspekt.isIp = Inspekt.prototype.isIp;
Inspekt.prototype.isLessThan = function(value,max) {
return (value<max);
}
Inspekt.isLessThan = Inspekt.prototype.isLessThan;
Inspekt.prototype.isOneOf = function(value,allowed) {
if (typeof allowed == "undefined") { allowed = null; }
return in_array(value,allowed);
}
Inspekt.isOneOf = Inspekt.prototype.isOneOf;
Inspekt.prototype.isPhone = function(value,country) {
if (typeof country == "undefined") { country = "US"; }
if(!ctype_digit(value)) {
return FALSE;
}

switch(country) {
case "US":
if(strlen(value)!=10) {
return FALSE;
}

var areaCode;
areaCode = substr(value,0,3);
var areaCodes;
areaCodes = ___array(201,202,203,204,205,206,207,208,209,210,212,213,214,215,216,217,218,219,224,225,226,228,229,231,234,239,240,242,246,248,250,251,252,253,254,256,260,262,264,267,268,269,270,276,281,284,289,301,302,303,304,305,306,307,308,309,310,312,313,314,315,316,317,318,319,320,321,323,325,330,334,336,337,339,340,345,347,351,352,360,361,386,401,402,403,404,405,406,407,408,409,410,412,413,414,415,416,417,418,419,423,424,425,430,432,434,435,438,440,441,443,445,450,469,470,473,475,478,479,480,484,501,502,503,504,505,506,507,508,509,510,512,513,514,515,516,517,518,519,520,530,540,541,555,559,561,562,563,564,567,570,571,573,574,580,585,586,600,601,602,603,604,605,606,607,608,609,610,612,613,614,615,616,617,618,619,620,623,626,630,631,636,641,646,647,649,650,651,660,661,662,664,670,671,678,682,684,700,701,702,703,704,705,706,707,708,709,710,712,713,714,715,716,717,718,719,720,724,727,731,732,734,740,754,757,758,760,763,765,767,769,770,772,773,774,775,778,780,781,784,785,786,787,800,801,802,803,804,805,806,807,808,809,810,812,813,814,815,816,817,818,819,822,828,829,830,831,832,833,835,843,844,845,847,848,850,855,856,857,858,859,860,863,864,865,866,867,868,869,870,876,877,878,888,900,901,902,903,904,905,906,907,908,909,910,912,913,914,915,916,917,918,919,920,925,928,931,936,937,939,940,941,947,949,951,952,954,956,959,970,971,972,973,978,979,980,985,989);
return in_array(areaCode,areaCodes);
break;
default:
user_error("isPhone() does not yet support this country.",E_USER_WARNING);
return FALSE;
break;
}
}
Inspekt.isPhone = Inspekt.prototype.isPhone;
Inspekt.prototype.isRegex = function(value,pattern) {
if (typeof pattern == "undefined") { pattern = null; }
return preg_match(pattern,value);
}
Inspekt.isRegex = Inspekt.prototype.isRegex;
Inspekt.prototype.isUri = function(value,mode) {
if (typeof mode == "undefined") { mode = ISPK_URI_ALLOW_COMMON; }
var regex;
regex = "";
switch(mode) {
case ISPK_URI_ALLOW_COMMON:
regex+="&";
regex+="^(ftp|http|https):";
regex+="(//)";
regex+="([-a-z0-9/~;:@=+$,.!*()\\']+@)?";
regex+="(";
regex+="((?:[^\\W_]((?:[^\\W_]|-){0,61}[^\\W_])?\\.)+[a-zA-Z]{2,6}\\.?)";
regex+="|";
regex+="([0-9]{1,3}(\\.[0-9]{1,3})?(\\.[0-9]{1,3})?(\\.[0-9]{1,3})?)";
regex+=")";
regex+="(:([0-9]*))?";
regex+="(/((%[0-9a-f]{2}|[-a-z0-9/~;:@=+$,.!*()\\'\\&]*)*)/?)?";
regex+="(\\?[^#]*)?";
regex+="(#([-a-z0-9_]*))?";
regex+="$&i";
break;
case ISPK_URI_ALLOW_ABSOLUTE:
user_error("isUri() for ISPK_URI_ALLOW_ABSOLUTE has not been implemented.",E_USER_WARNING);
return FALSE;
break;
}
var result;
var subpatterns;
result = preg_match(regex,value,subpatterns);
return result;
}
Inspekt.isUri = Inspekt.prototype.isUri;
Inspekt.prototype.isZip = function(value) {
return preg_match("/(^\\d{5}$)|(^\\d{5}-\\d{4}$)/",value);
}
Inspekt.isZip = Inspekt.prototype.isZip;
Inspekt.prototype.noTags = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"noTags");
}
else {
return strip_tags(value);
}
}
Inspekt.noTags = Inspekt.prototype.noTags;
Inspekt.prototype.noPath = function(value) {
if(is_array(value)) {
return Inspekt._walkArray(value,"noPath");
}
else {
return basename(value);
}
}
Inspekt.noPath = Inspekt.prototype.noPath;
} /* end class Inspekt */


var URIs;
URIs = ___array("//lessthan","ftp://funky7:boooboo@123.444.999.12/","http://spinaltap.micro.umn.edu/00/Weather/California/Los%lngeles","http://funkatron.com/////////12341241","http://funkatron.com:12","http://funkatron.com:8000/#foo","https://funkatron.com","https://funkatron.com:42/funky.php?foo[]=bar","http://www.w3.org/2001/XMLSchema");
var uri;
var rs;
for(var ____idx in URIs) {
uri=URIs[____idx];
___echo("Testing "+uri+"<br/>");
rs = Inspekt.isUri(uri);
___echo("<pre>");
___echo(var_dump(rs));
___echo("</pre>\n");
___echo("<hr>");
}

