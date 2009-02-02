


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
function person() {this.name="Mickey Mouse";person.prototype.get_name = function() {
return this.name;
}
} {} /* end class person */
var p = new person;
___echo("verifying static variable init and a basic accessor routine<br>\n");
___echo("Result: "+(p.get_name()=="Mickey Mouse"?"pass":"fail")+"<br><br>\n\n");
}

test1();


