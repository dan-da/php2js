

function ___array() {
  var arr = [];
  for (var i = 0; i < ___array.arguments.length; ++i) {
    var item = ___array.arguments[i];
    if(item instanceof Array) {
        arr[item[0]] = item[1];
    }
    else {
        arr.push( item );
    }
  }
  return arr;
}
        
class person {
    var mytype = 'person';
    
    function say_hello() {
        return "I am a " + this->mytype;
    }
}

function test1() {
    
    class programmer extends person {
        
        function say_hello() {
            return "I'm a programmer, dude";
        }
    }
    
    var p = new programmer();
    document.write( "verifying method override in subclass<br>\n");
    document.write( "Result: " + (p->say_hello() == "I'm a programmer, dude" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {
    
    class manager extends person {
        var mytype = 'manager';
    }
    
    var p = new manager();
    
    document.write( "verifying variable override in subclass<br>\n");
    document.write( "Result: " + (p->say_hello() == "I am a manager" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {
    
    class user extends person {
        
        function __construct() {
            this->mytype = 'user';
        }
    }
    
    var p = new user();
    
    document.write( "verifying variable override in subclass constructor<br>\n");
    document.write( "Result: " + (p->say_hello() == "I am a user" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {
    
    class nobody extends person {
    }
    
    var p = new nobody();
    
    document.write( "verifying call to parent method works when not defined in subclass<br>\n");
    document.write( "Result: " + (p->say_hello() == "I am a person" ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test5() {
    
    class athlete extends person {
        var mytype = 'athlete';
    }

    class tennisplayer extends athlete {
        var mytype = 'tennis player';
        
        function say_hello(name) {
            return "hello "+name+", I am a {"+this+"->mytype} also.";
        }
    }
    
    var p = new tennisplayer();
    
    document.write( "verifying multiple inheritance levels work<br>\n");
    document.write( "Result: " + (p->say_hello('Mr. Agassi') == "hello Mr. Agassi, I am a tennis player also." ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test6() {
    
    class nobody2 extends person {
        function say_hello() {
            return parent::say_hello();
        }
    }
    
    var p = new nobody2();
    
    document.write( "verifying that parent::method() works.<br>\n");
    document.write( "Result: " + (p->say_hello() == "I am a person" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test7() {

    class animal {
        function identify(type) {
            return "I am a "+type+".";
        }
    }

    
    class cat extends animal {
        function identify(type) {
            return parent::identify(type);
        }
    }

    class lion extends cat{
        function identify() {
            return parent::identify('lion');
        }
    }

    
    var p = new lion();
    
    document.write( "verifying passing arg to parent works, eg: parent::method(\$arg)<br>\n");
    document.write( "Result: " + (p->identify() == "I am a lion." ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test8() {

    class road {
        var type;
        var lanes = 2;
        function __construct(type) {
            this->type = type;
        }
        
        function identify() {
            return "I am a {"+this+"->lanes} lane {"+this+"->type}";
        }
    }
    
    class highway extends road {
        function __construct() {
            parent::__construct( 'highway' );
            this->lanes = 4;
        }
    }
    
    var p = new highway();
    
    document.write( "verify that parent constructor can be called from subclass constructor, with param<br>\n");
    document.write( "Result: " + (p->identify() == "I am a 4 lane highway" ? 'pass' : 'fail') + "<br><br>\n\n");
}

class oldroad {
    var type;
    var lanes = 2;
    function oldroad(type) {
        this->type = type;
    }
    
    function identify() {
        return "I am a {"+this+"->lanes} lane {"+this+"->type}";
    }
}


function test9() {

    class freeway extends oldroad {
        function __construct() {
            parent::__construct( 'freeway' );
            this->lanes = 6;
        }
    }
    
    var p = new freeway();
    
    document.write( "verify that php4 style parent constructor can be called from subclass constructor, using __construct()<br>\n");
    document.write( "Result: " + (p->identify() == "I am a 6 lane freeway" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test10() {

    class alley extends oldroad {
        function __construct() {
            parent::oldroad( 'alley' );
            this->lanes = 1;
        }
    }
    
    var p = new alley();
    
    document.write( "verify that php4 style parent constructor can be called from subclass constructor, using classname()<br>\n");
    document.write( "Result: " + (p->identify() == "I am a 1 lane alley" ? 'pass' : 'fail') + "<br><br>\n\n");
}


    class counter {
        var count = 0;
        function __construct() {
            this->count ++;
        }
    }

    class subcounter extends counter {
        function __construct() {
            parent::__construct();
            this->count ++;
        }
    }

    class subsubcounter extends subcounter {
        function __construct() {
            parent::__construct();
            this->count ++;
        }
    }

    class subsubsubcounter extends subsubcounter {
        function __construct() {
            subcounter::__construct();
//            parent::__construct();
            this->count ++;
        }
    }


function test11() {

    var p = new subsubcounter();
    
    document.write( "verify that >2 levels of constructors can be called<br>\n");
    document.write( "Result: " + (p->count == 3 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test12() {

    var p = new subsubsubcounter();
    
    document.write( "verify that grandfather constructor can be called, skipping parent constructor<br>\n");
    document.write( "Result: " + (p->count == 3 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test13() {
    
    class test13class extends person {
        function say_hello() {
            return person::say_hello();
        }
    }
    
    var p = new test13class();
    
    document.write( "verifying that parentclassname::method() works.<br>\n");
    document.write( "Result: " + (p->say_hello() == "I am a person" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test14() {

    class z {
        function identify(type) {
            return "I am a "+type+".";
        }
    }

    
    class zz extends z {
        function identify() {
            return parent::identify('zz');
        }
    }
    
    var p = new zz();
    
    document.write( "verifying passing arg to parent works, eg: parentclassname::method(\$arg)<br>\n");
    document.write( "Result: " + (p->identify() == "I am a zz." ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test15() {

    class test15class extends person {
        function __construct() {
            this->mytype = 'test15class';
            this->id = this->say_hello();
        }
    }
    var p = new test15class();
    
    document.write( "verifying that method defined in parent class can be called from constructor of subclass<br>\n");
    document.write( "Result: " + (p->id == "I am a test15class" ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test16() {
    class test16parent {
        static function add_numbers() {
            return 1 + 2;
        }
    }
    class test16child extends test16parent {
        function add() {
            return self::add_numbers();
        }
    }
    
    document.write( "verifying self::staticmethod() works when staticmethod defined in parent class only<br>\n");
    document.write( "Result: " + (test16child::add() == 3 ? 'pass' : 'fail') + "<br><br>\n\n");
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



