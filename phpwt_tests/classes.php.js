

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
        
class sibling {
    var siblings = ___array();
    
    function __construct( name ) {
        this->name = name;
    }
    
    function get_name() {
        return this->name;
    }
    
    function add_sibling( sibling s ) {
        this->siblings[] = s;
    }
    
    function get_first_sibling() {
        return this->siblings[0];
    }
}


function test1() {

    class person {
        static pname = 'Mickey Mouse';
        
        function get_name_static() {
            return self::pname;
        }
    }
    
    var p = new person();
    document.write( "verifying class variable init and internal and external access<br>\n");
    document.write( "Result: " + (p->get_name_static() == person::pname && person::pname == 'Mickey Mouse' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test2() {

    class person2 {
        static pname;
        
        function get_name_static() {
            self::pname = 'Daffy Duck';
            return self::pname;
        }
    }
    
    var p = new person2();
    document.write( "verifying delayed assignment of class variable<br>\n");
    document.write( "Result: " + (p->get_name_static() == person2::pname && person2::pname == 'Daffy Duck' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test3() {

    class fruit {
        var type;
        
        function __construct(type) {
            this->type = type;
        }
    }
    
    var p = new fruit('apple');
    document.write( "verifying that constructor gets called and can set object attribute<br>\n");
    document.write( "Result: " + (p->type == 'apple' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test4() {

    class car {
        var type;
        
        function car(type) {
            this->type = type;
        }
    }
    
    var p = new car('toyota');
    document.write( "verifying that php4 style constructor gets called and can set object attribute<br>\n");
    document.write( "Result: " + (p->type == 'toyota' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test5() {

    class airplane {
        static function fastest() {
            return 'blackbird';
        }
        
        function __construct(foo) {
            return 'stuff';
        }
    }
    
    document.write( "verifying static method works<br>\n");
    document.write( "Result: " + (airplane::fastest() == 'blackbird' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test6() {

    var s = new sibling( 'Jake' );
    s->add_sibling( new sibling('John') );
    var john_name = s->get_first_sibling()->get_name();
    
    document.write( "verifying \$foo()->method_call() works<br>\n");
    document.write( "Result: " + (john_name == 'John' ? 'pass' : 'fail') + "<br><br>\n\n");
}


function test7() {
    class test7class {
        const NUM1 = 1;
        const NUM2 = 2;
    }

    document.write( "verifying classname::constvar works<br>\n");
    document.write( "Result: " + (test7class::NUM1 == 1 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test8() {
    class test8class {
        static NUM1 = 1;
    }

    document.write( "verifying classname::\$staticvar works<br>\n");
    document.write( "Result: " + (test8class::NUM1 == 1 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test9() {
    class test9class {
        static function func1() {
            return 'hey';
        }
        
        static function func2() {
            return self::func1();
        }
    }

    document.write( "verifying self::methodcall() works<br>\n");
    document.write( "Result: " + (test9class::func2() == 'hey' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test10() {

    var s = new sibling( 'Jake' );
    var j = new sibling('John');
    j->add_sibling(new sibling('Jane'));
    j->add_sibling(new sibling('Mary'));
    s->add_sibling( j );
    var sibling_count = count( s->get_first_sibling()->siblings );
    
    document.write( "verifying \$foo()->method_call()->property works<br>\n");
    document.write( "Result: " + (sibling_count == 2 ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test11() {

    var type = sibling;
    var o = new type('Jim');
    
    document.write( "verifying new \$class works<br>\n");
    document.write( "Result: " + (o->get_name() == 'Jim' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test12() {

    var type = 'sibling';
    var o = new type('Jim');
    
    document.write( "verifying new \$class works, when \$class is a string.<br>\n");
    document.write( "Result: " + (o->get_name() == 'Jim' ? 'pass' : 'fail') + "<br><br>\n\n");
}

function test13() {
    class test13class {
        const NUM1 = 1;
        const NUM2 = 2;
        
        function add_numbers() {
            return self::NUM1 + self::NUM2;
        }
    }
    
    var obj = new test13class();

    document.write( "verifying self::constvar works<br>\n");
    document.write( "Result: " + (obj->add_numbers() == 3 ? 'pass' : 'fail') + "<br><br>\n\n");
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



