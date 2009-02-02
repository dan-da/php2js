


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

prepare_str_concat = function(v) {
    if (v == undefined) v = '';
    return v;
}

___echo = function(v) {
    if (typeof document == 'undefined') print(v);
    else document.write(v);
}


if (typeof(window) == 'undefined') {
    window = this;
}




test1 = function() {
var sum = 2;
sum+=5;
___echo("Test += operator<br>\n");
___echo("result: "+(sum=="7"?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
var sum = 8;
sum-=5;
___echo("Test -= operator<br>\n");
___echo("result: "+(sum=="3"?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
var sum = 9;
sum/=3;
___echo("Test /= operator<br>\n");
___echo("result: "+(sum=="3"?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
var sum = 4;
sum*=3;
___echo("Test *= operator<br>\n");
___echo("result: "+(sum=="12"?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
var str = "hello ";
str+="world";
___echo("Test .= operator<br>\n");
___echo("result: "+(str=="hello world"?"pass":"fail")+"<br><br>\n\n");
}

test6 = function() {
var i; for(i = 0;i<3;i++) {
var buf=prepare_str_concat(buf);buf+="!";
}
___echo("Test .= operator applied to undeclared variable, in a loop.<br>\n");
___echo("result: "+(buf=="!!!"?"pass":"fail")+"<br><br>\n\n");
}

test1();
test2();
test3();
test4();
test5();
test6();


