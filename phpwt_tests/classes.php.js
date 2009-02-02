


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


count = function(mixed_var,mode) {
    var key,
    cnt = 0;

    if (mode == 'COUNT_RECURSIVE') mode = 1;
    if (mode != 1) mode = 0;

    for (key in mixed_var) {
        cnt++;
        if (mode == 1 && mixed_var[key] && (mixed_var[key].constructor === Array || mixed_var[key].constructor === Object)) {
            cnt += count(mixed_var[key], 1);
        }
    }

    return cnt;

}



function sibling(name) {this.siblings=___array();sibling.prototype.get_name = function() {
return this.name;
}
sibling.prototype.add_sibling = function(s) {
this.siblings[this.siblings.length] = s;
}
sibling.prototype.get_first_sibling = function() {
return this.siblings[0];
}

this.name = name;
}
 {} /* end class sibling */
test1 = function() {
function person() {person.prototype.get_name_static = function() {
return person.pname;
}
} {person.pname="Mickey Mouse";} /* end class person */
var p = new person;
___echo("verifying class variable init and internal and external access<br>\n");
___echo("Result: "+(p.get_name_static()==person.pname&&person.pname=="Mickey Mouse"?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
function person2() {person2.prototype.get_name_static = function() {
person2.pname = "Daffy Duck";
return person2.pname;
}
} {person2.pname;} /* end class person2 */
var p = new person2;
___echo("verifying delayed assignment of class variable<br>\n");
___echo("Result: "+(p.get_name_static()==person2.pname&&person2.pname=="Daffy Duck"?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
function fruit(type) {this.type;
this.type = type;
}
 {} /* end class fruit */
var p = new fruit("apple");
___echo("verifying that constructor gets called and can set object attribute<br>\n");
___echo("Result: "+(p.type=="apple"?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
function car(type) {this.type;
this.type = type;
}
 {} /* end class car */
var p = new car("toyota");
___echo("verifying that php4 style constructor gets called and can set object attribute<br>\n");
___echo("Result: "+(p.type=="toyota"?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
function airplane(foo) {
return "stuff";
}
 {airplane.fastest = function() {
return "blackbird";
}
} /* end class airplane */
___echo("verifying static method works<br>\n");
___echo("Result: "+(airplane.fastest()=="blackbird"?"pass":"fail")+"<br><br>\n\n");
}

test6 = function() {
var s = new sibling("Jake");
s.add_sibling(new sibling("John"));
var john_name = s.get_first_sibling().get_name();
___echo("verifying \$foo()->method_call() works<br>\n");
___echo("Result: "+(john_name=="John"?"pass":"fail")+"<br><br>\n\n");
}

test7 = function() {
function test7class() {} {test7class.NUM1=1;test7class.NUM2=2;} /* end class test7class */
___echo("verifying classname::constvar works<br>\n");
___echo("Result: "+(test7class.NUM1==1?"pass":"fail")+"<br><br>\n\n");
}

test8 = function() {
function test8class() {} {test8class.NUM1=1;} /* end class test8class */
___echo("verifying classname::\$staticvar works<br>\n");
___echo("Result: "+(test8class.NUM1==1?"pass":"fail")+"<br><br>\n\n");
}

test9 = function() {
function test9class() {} {test9class.func1 = function() {
return "hey";
}
test9class.func2 = function() {
return test9class.func1();
}
} /* end class test9class */
___echo("verifying self::methodcall() works<br>\n");
___echo("Result: "+(test9class.func2()=="hey"?"pass":"fail")+"<br><br>\n\n");
}

test10 = function() {
var s = new sibling("Jake");
var j = new sibling("John");
j.add_sibling(new sibling("Jane"));
j.add_sibling(new sibling("Mary"));
s.add_sibling(j);
var sibling_count = count(s.get_first_sibling().siblings);
___echo("verifying \$foo()->method_call()->property works<br>\n");
___echo("Result: "+(sibling_count==2?"pass":"fail")+"<br><br>\n\n");
}

test11 = function() {
var type = sibling;
var o = new (eval(type))("Jim");
___echo("verifying new \$class works<br>\n");
___echo("Result: "+(o.get_name()=="Jim"?"pass":"fail")+"<br><br>\n\n");
}

test12 = function() {
var type = "sibling";
var o = new (eval(type))("Jim");
___echo("verifying new \$class works, when \$class is a string.<br>\n");
___echo("Result: "+(o.get_name()=="Jim"?"pass":"fail")+"<br><br>\n\n");
}

test13 = function() {
function test13class() {test13class.prototype.add_numbers = function() {
return test13class.NUM1+test13class.NUM2;
}
} {test13class.NUM1=1;test13class.NUM2=2;} /* end class test13class */
var obj = new test13class;
___echo("verifying self::constvar works<br>\n");
___echo("Result: "+(obj.add_numbers()==3?"pass":"fail")+"<br><br>\n\n");
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


