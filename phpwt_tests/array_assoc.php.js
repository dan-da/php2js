


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

        
___array = function() {
    var arr = [];
    for (var i = 0; i < ___array.arguments.length; ++i) {
        var item = ___array.arguments[i];
        if (item instanceof Array && item.length == 3 && item[0] == '__kv') {
            arr[item[1]] = item[2];
        }
        else {
            arr.push(item);
        }
    }
    return arr;

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
var arr = ___array([ "__kv", "colors",___array([ "__kv", "red","Red"],[ "__kv", "green","Green"])],[ "__kv", "car","toyota"],[ "__kv", "candies",___array("twix","snickers","jolly ranchers")],[ "__kv", "holiday","christmas"]);
arr["planet"] = "Earth";
var okay = arr["colors"]["red"]=="Red"&&arr["car"]=="toyota"&&arr["candies"][1]=="snickers"&&arr["holiday"]=="christmas"&&arr["planet"]=="Earth";
___echo("Test that assoc array init and deref works<br>\n");
___echo("Result: "+((okay===true)?"pass":"fail")+"<br><br>\n\n");

}

test1();


