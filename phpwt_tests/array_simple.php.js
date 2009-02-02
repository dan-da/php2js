


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
var arr = ___array("red","green","blue",1,2,3);
arr[6] = "this element was added later!";
var newarr=[];newarr[7] = "new arr, new elem";
newarr[newarr.length] = "new elem, added to end of array";
var buf = arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+newarr[7]+newarr[8];
___echo("Test array initialization, indexed assignment, and append via []<br>\n");
___echo("Result: "+((buf==="redgreenblue123this element was added later!new arr, new elemnew elem, added to end of array")?"pass":"fail")+"<br><br>\n\n");

}

test2 = function() {
var arr = ___array(___array("foo0","bar0","baz0","toto0","tintin0"),___array("foo1","bar1","baz1","toto1","tintin1"),___array("foo2","bar2","baz2","toto2","tintin2"),___array("foo3","bar3","baz3","toto3","tintin3"),___array("foo4","bar4","baz4","toto4","tintin4"));
___echo("Test nested indexed arrays.<br>\n");
___echo("Result: "+((arr[3][3]==="toto3")?"pass":"fail")+"<br><br>\n\n");
}

test1();
test2();


