


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




function person() {this.mytype="person";person.prototype.say_hello = function() {
return "I am a "+this.mytype;
}
} {} /* end class person */
test1 = function() {
function programmer() {programmer.prototype.say_hello = function() {
return "I'm a programmer, dude";
}
} {programmer.inheritsFrom( person );} /* end class programmer */
var p = new programmer;
___echo("verifying method override in subclass<br>\n");
___echo("Result: "+(p.say_hello()=="I'm a programmer, dude"?"pass":"fail")+"<br><br>\n\n");
}

test2 = function() {
function manager() {this.mytype="manager";} {manager.inheritsFrom( person );} /* end class manager */
var p = new manager;
___echo("verifying variable override in subclass<br>\n");
___echo("Result: "+(p.say_hello()=="I am a manager"?"pass":"fail")+"<br><br>\n\n");
}

test3 = function() {
function user() {
this.mytype = "user";
}
 {user.inheritsFrom( person );} /* end class user */
var p = new user;
___echo("verifying variable override in subclass constructor<br>\n");
___echo("Result: "+(p.say_hello()=="I am a user"?"pass":"fail")+"<br><br>\n\n");
}

test4 = function() {
function nobody() {} {nobody.inheritsFrom( person );} /* end class nobody */
var p = new nobody;
___echo("verifying call to parent method works when not defined in subclass<br>\n");
___echo("Result: "+(p.say_hello()=="I am a person"?"pass":"fail")+"<br><br>\n\n");
}

test5 = function() {
function athlete() {this.mytype="athlete";} {athlete.inheritsFrom( person );} /* end class athlete */
function tennisplayer() {this.mytype="tennis player";tennisplayer.prototype.say_hello = function(name) {
return "hello "+name+", I am a "+this.mytype+" also.";
}
} {tennisplayer.inheritsFrom( athlete );} /* end class tennisplayer */
var p = new tennisplayer;
___echo("verifying multiple inheritance levels work<br>\n");
___echo("Result: "+(p.say_hello("Mr. Agassi")=="hello Mr. Agassi, I am a tennis player also."?"pass":"fail")+"<br><br>\n\n");
}

test6 = function() {
function nobody2() {nobody2.prototype.say_hello = function() {
return person.prototype.say_hello.call(this);
}
} {nobody2.inheritsFrom( person );} /* end class nobody2 */
var p = new nobody2;
___echo("verifying that parent::method() works.<br>\n");
___echo("Result: "+(p.say_hello()=="I am a person"?"pass":"fail")+"<br><br>\n\n");
}

test7 = function() {
function animal() {animal.prototype.identify = function(type) {
return "I am a "+type+".";
}
} {} /* end class animal */
function cat() {cat.prototype.identify = function(type) {
return animal.prototype.identify.call(this,type);
}
} {cat.inheritsFrom( animal );} /* end class cat */
function lion() {lion.prototype.identify = function() {
return cat.prototype.identify.call(this,"lion");
}
} {lion.inheritsFrom( cat );} /* end class lion */
var p = new lion;
___echo("verifying passing arg to parent works, eg: parent::method(\$arg)<br>\n");
___echo("Result: "+(p.identify()=="I am a lion."?"pass":"fail")+"<br><br>\n\n");
}

test8 = function() {
function road(type) {this.type;this.lanes=2;road.prototype.identify = function() {
return "I am a "+this.lanes+" lane "+this.type+"";
}

this.type = type;
}
 {} /* end class road */
function highway() {
road.prototype.constructor.call(this,"highway");
this.lanes = 4;
}
 {highway.inheritsFrom( road );} /* end class highway */
var p = new highway;
___echo("verify that parent constructor can be called from subclass constructor, with param<br>\n");
___echo("Result: "+(p.identify()=="I am a 4 lane highway"?"pass":"fail")+"<br><br>\n\n");
}

function oldroad(type) {this.type;this.lanes=2;oldroad.prototype.identify = function() {
return "I am a "+this.lanes+" lane "+this.type+"";
}

this.type = type;
}
 {} /* end class oldroad */
test9 = function() {
function freeway() {
oldroad.prototype.constructor.call(this,"freeway");
this.lanes = 6;
}
 {freeway.inheritsFrom( oldroad );} /* end class freeway */
var p = new freeway;
___echo("verify that php4 style parent constructor can be called from subclass constructor, using __construct()<br>\n");
___echo("Result: "+(p.identify()=="I am a 6 lane freeway"?"pass":"fail")+"<br><br>\n\n");
}

test10 = function() {
function alley() {
oldroad.prototype.constructor.call(this,"alley");
this.lanes = 1;
}
 {alley.inheritsFrom( oldroad );} /* end class alley */
var p = new alley;
___echo("verify that php4 style parent constructor can be called from subclass constructor, using classname()<br>\n");
___echo("Result: "+(p.identify()=="I am a 1 lane alley"?"pass":"fail")+"<br><br>\n\n");
}

function counter() {this.count=0;
this.count++;
}
 {} /* end class counter */
function subcounter() {
counter.prototype.constructor.call(this);
this.count++;
}
 {subcounter.inheritsFrom( counter );} /* end class subcounter */
function subsubcounter() {
subcounter.prototype.constructor.call(this);
this.count++;
}
 {subsubcounter.inheritsFrom( subcounter );} /* end class subsubcounter */
function subsubsubcounter() {
subcounter.prototype.constructor.call(this);
this.count++;
}
 {subsubsubcounter.inheritsFrom( subsubcounter );} /* end class subsubsubcounter */
test11 = function() {
var p = new subsubcounter;
___echo("verify that >2 levels of constructors can be called<br>\n");
___echo("Result: "+(p.count==3?"pass":"fail")+"<br><br>\n\n");
}

test12 = function() {
var p = new subsubsubcounter;
___echo("verify that grandfather constructor can be called, skipping parent constructor<br>\n");
___echo("Result: "+(p.count==3?"pass":"fail")+"<br><br>\n\n");
}

test13 = function() {
function test13class() {test13class.prototype.say_hello = function() {
return person.prototype.say_hello.call(this);
}
} {test13class.inheritsFrom( person );} /* end class test13class */
var p = new test13class;
___echo("verifying that parentclassname::method() works.<br>\n");
___echo("Result: "+(p.say_hello()=="I am a person"?"pass":"fail")+"<br><br>\n\n");
}

test14 = function() {
function z() {z.prototype.identify = function(type) {
return "I am a "+type+".";
}
} {} /* end class z */
function zz() {zz.prototype.identify = function() {
return z.prototype.identify.call(this,"zz");
}
} {zz.inheritsFrom( z );} /* end class zz */
var p = new zz;
___echo("verifying passing arg to parent works, eg: parentclassname::method(\$arg)<br>\n");
___echo("Result: "+(p.identify()=="I am a zz."?"pass":"fail")+"<br><br>\n\n");
}

test15 = function() {
function test15class() {
this.mytype = "test15class";
this.id = this.say_hello();
}
 {test15class.inheritsFrom( person );} /* end class test15class */
var p = new test15class;
___echo("verifying that method defined in parent class can be called from constructor of subclass<br>\n");
___echo("Result: "+(p.id=="I am a test15class"?"pass":"fail")+"<br><br>\n\n");
}

test16 = function() {
function test16parent() {} {test16parent.add_numbers = function() {
return 1+2;
}
} /* end class test16parent */
function test16child() {test16child.prototype.add = function() {
return test16child.add_numbers();
}
} {test16child.inheritsFrom( test16parent );} /* end class test16child */
___echo("verifying self::staticmethod() works when staticmethod defined in parent class only<br>\n");
___echo("Result: "+(test16child.add()==3?"pass":"fail")+"<br><br>\n\n");
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


