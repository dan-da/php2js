


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

___clone = function(o) {
    function c(o) {
        for (var i in o) {
            this[i] = o[i];
        }
    }
    var d = new c(o);
    if (d.__clone) {
        d.__clone();
    }
    return d;

}


if (typeof(window) == 'undefined') {
    window = this;
}




function foo() {} {} /* end class foo */
test1 = function() {
var obj = new foo;
___echo("Test new operator and instanceof operator<br>\n");
___echo("result: "+(obj instanceof foo?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
var obj = new foo;
obj.age = 2;
var obj2 = ___clone(obj);
obj2.age = 5;
___echo("Test clone operator<br>\n");
___echo("result: "+(obj.age==2&&obj2.age==5?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
var obj = new foo;
obj.age = 2;
var obj2 = ___clone(obj);
obj2.age = 5;
___echo("Test clone function call<br>\n");
___echo("result: "+(obj.age==2&&obj2.age==5?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
function magical() {this.attr;magical.prototype.__clone = function() {
this.attr++;
}
} {} /* end class magical */
var magic1 = new magical;
magic1.attr = 3;
var magic2 = ___clone(magic1);
___echo("Test __clone magic method. <br>\n");
___echo("result: "+(magic1.attr==3&&magic2.attr==4?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
var obj = new foo;
obj.age = 2;
var obj2 = obj;
obj.age = 5;
___echo("Test assignment of class (should be reference unless clone is used)<br>\n");
___echo("result: "+(obj2.age==5?"pass":"fail")+"<br><br>\n\n");
}

test6 = function() {
var a = 3*3%5;
a = ((true?0:true)?1:2);
a = 1;
var b = 2;
a = b+=3;
___echo("Test associativity<br>\n");
___echo("result: "+(a==5&&b==5?"pass":"fail")+"<br><br>\n\n");
}

test7 = function() {
var a = 12^9;
var b = a<<3;
var c = b>>3;
var d = 1|2;
var e = ~d;
___echo("Test bitwise operators<br>\n");
___echo("result: "+(a==5&&b==40&&c==5&&d==3&&e==-4?"pass":"fail")+"<br><br>\n\n");
}

test8 = function() {
var truth = 5!=3;
___echo("Test <> operator alias for '!='<br>\n");
___echo("result: "+(truth?"pass":"fail")+"<br><br>\n\n");
}

test9 = function() {
var truth; truth = (0||1)&&1;
___echo("Test 'or' and 'and' operator aliases for '||' and '&&'<br>\n");
___echo("result: "+(truth?"pass":"fail")+"<br><br>\n\n");
}

test10 = function() {
var truth = ((true?"true":false)?"t":"f");
___echo("Test ternary operator in non-obvious case<br>\n");
___echo("result: "+(truth=="t"?"pass":"fail")+"<br><br>\n\n");
}

test11 = function() {
var arr = ___array([ "__kv", "key","value"]);
var foo = arr["badkey"];
___echo("Test error control operator<br>\n");
___echo("result: "+(foo==null?"pass":"fail")+"<br><br>\n\n");
}

test12 = function() {
var i = 0;
i++;
++i;
i--;
--i;
___echo("Test ++ and -- operators.  before and after.<br>\n");
___echo("result: "+(i===0?"pass":"fail")+"<br><br>\n\n");
}

test13 = function() {
var i = "W";
var buf = "";
var n; for(n = 0;n<6;n++) {
buf+=++i+", ";
}
___echo("Test ++ on character variables.<br>\n");
___echo("result: "+(buf=="X, Y, Z, AA, AB, AC, "?"pass":"fail")+"<br><br>\n\n");
}

test14 = function() {
var a = ___array([ "__kv", "a","apple"],[ "__kv", "b","banana"]);
var b = ___array([ "__kv", "a","pear"],[ "__kv", "b","strawberry"],[ "__kv", "c","cherry"]);
var c = a+b;
___echo("Union of \$a and \$b: \n");
___echo(c);
___echo("Test + operator on two assoc arrays<br>\n");
___echo("result: "+(foo==null?"pass":"fail")+"<br><br>\n\n");
}

test15 = function() {
var a = ___array("apple","banana");
var b = ___array("pear","strawberry","cherry");
var c = a+b;
___echo("Union of \$a and \$b: \n");
___echo(c[0]+"<br>\n");
___echo(c[1]+"<br>\n");
___echo(c[2]+"<br>\n");
___echo(c[3]+"<br>\n");
___echo("Test + operator on two assoc arrays<br>\n");
___echo("result: "+(foo==null?"pass":"fail")+"<br><br>\n\n");
}

test16 = function() {
var orig = 6;
var ref = orig;
orig = 3;
___echo("Test that changing original also changes reference.<br>\n");
___echo("result: "+(ref===3?"pass":"fail")+"<br><br>\n\n");
}

test17 = function() {
test17_internal = function(foo) {
foo = 6;
}

var bar = 3;
test17_internal(bar);
___echo("Test that passing var to function by reference changes referent var.<br>\n");
___echo("result: "+(bar===6?"pass":"fail")+"<br><br>\n\n");
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
test13();
test14();
test15();
test16();
test17();


