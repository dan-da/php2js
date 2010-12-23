<?php

JSINCLUDE('php.js');

class sibling {
    var $siblings = array();
    
    function __construct( $name ) {
        $this->name = $name;
    }
    
    function get_name() {
        return $this->name;
    }
    
    function add_sibling( sibling $s ) {
        $this->siblings[] = $s;
    }
    
    function get_first_sibling() {
        return $this->siblings[0];
    }
}


function test1() {

    class person {
        static $pname = 'Mickey Mouse';
        
        function get_name_static() {
            return self::$pname;
        }
    }
    
    $p = new person();
    echo "verifying class variable init and internal and external access<br>\n";
    echo "Result: " . ($p->get_name_static() == person::$pname && person::$pname == 'Mickey Mouse' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {

    class person2 {
        static $pname;
        
        function get_name_static() {
            self::$pname = 'Daffy Duck';
            return self::$pname;
        }
    }
    
    $p = new person2();
    echo "verifying delayed assignment of class variable<br>\n";
    echo "Result: " . ($p->get_name_static() == person2::$pname && person2::$pname == 'Daffy Duck' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {

    class fruit {
        var $type;
        
        function __construct($type) {
            $this->type = $type;
        }
    }
    
    $p = new fruit('apple');
    echo "verifying that constructor gets called and can set object attribute<br>\n";
    echo "Result: " . ($p->type == 'apple' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {

    class car {
        var $type;
        
        function car($type) {
            $this->type = $type;
        }
    }
    
    $p = new car('toyota');
    echo "verifying that php4 style constructor gets called and can set object attribute<br>\n";
    echo "Result: " . ($p->type == 'toyota' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {

    class airplane {
        static function fastest() {
            return 'blackbird';
        }
        
        function __construct($foo) {
            return 'stuff';
        }
    }
    
    echo "verifying static method works<br>\n";
    echo "Result: " . (airplane::fastest() == 'blackbird' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5a() {

    class tree {
        function type() {
            return 'oak';
        }
    }
    
    echo "verifying static method works when not defined with static keyword<br>\n";
    echo "Result: " . (tree::type() == 'oak' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test6() {

    $s = new sibling( 'Jake' );
    $s->add_sibling( new sibling('John') );
    $john_name = $s->get_first_sibling()->get_name();
    
    echo "verifying \$foo()->method_call() works<br>\n";
    echo "Result: " . ($john_name == 'John' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test7() {
    class test7class {
        const NUM1 = 1;
        const NUM2 = 2;
    }

    echo "verifying classname::constvar works<br>\n";
    echo "Result: " . (test7class::NUM1 == 1 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test8() {
    class test8class {
        static $NUM1 = 1;
    }

    echo "verifying classname::\$staticvar works<br>\n";
    echo "Result: " . (test8class::$NUM1 == 1 ? 'pass' : 'fail') . "<br><br>\n\n";
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

    echo "verifying self::methodcall() works<br>\n";
    echo "Result: " . (test9class::func2() == 'hey' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test10() {

    $s = new sibling( 'Jake' );
    $j = new sibling('John');
    $j->add_sibling(new sibling('Jane'));
    $j->add_sibling(new sibling('Mary'));
    $s->add_sibling( $j );
    $sibling_count = count( $s->get_first_sibling()->siblings );
    
    echo "verifying \$foo()->method_call()->property works<br>\n";
    echo "Result: " . ($sibling_count == 2 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test11() {

    $type = sibling;
    $o = new $type('Jim');
    
    echo "verifying new \$class works<br>\n";
    echo "Result: " . ($o->get_name() == 'Jim' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test12() {

    $type = 'sibling';
    $o = new $type('Jim');
    
    echo "verifying new \$class works, when \$class is a string.<br>\n";
    echo "Result: " . ($o->get_name() == 'Jim' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test13() {
    class test13class {
        const NUM1 = 1;
        const NUM2 = 2;
        
        function add_numbers() {
            return self::NUM1 + self::NUM2;
        }
    }
    
    $obj = new test13class();

    echo "verifying self::constvar works<br>\n";
    echo "Result: " . ($obj->add_numbers() == 3 ? 'pass' : 'fail') . "<br><br>\n\n";
}




test1();
test2();
test3();
test4();
test5();
test5a();
test6();
test7();
test8();
test9();
test10();
test11();
test12();
test13();


?>