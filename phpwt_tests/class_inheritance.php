<?php

class person {
    var $mytype = 'person';
    
    function say_hello() {
        return "I am a " . $this->mytype;
    }
}

function test1() {
    
    class programmer extends person {
        
        function say_hello() {
            return "I'm a programmer, dude";
        }
    }
    
    $p = new programmer();
    echo "verifying method override in subclass<br>\n";
    echo "Result: " . ($p->say_hello() == "I'm a programmer, dude" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    
    class manager extends person {
        var $mytype = 'manager';
    }
    
    $p = new manager();
    
    echo "verifying variable override in subclass<br>\n";
    echo "Result: " . ($p->say_hello() == "I am a manager" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    
    class user extends person {
        
        function __construct() {
            $this->mytype = 'user';
        }
    }
    
    $p = new user();
    
    echo "verifying variable override in subclass constructor<br>\n";
    echo "Result: " . ($p->say_hello() == "I am a user" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    
    class nobody extends person {
    }
    
    $p = new nobody();
    
    echo "verifying call to parent method works when not defined in subclass<br>\n";
    echo "Result: " . ($p->say_hello() == "I am a person" ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test5() {
    
    class athlete extends person {
        var $mytype = 'athlete';
    }

    class tennisplayer extends athlete {
        var $mytype = 'tennis player';
        
        function say_hello($name) {
            return "hello $name, I am a {$this->mytype} also.";
        }
    }
    
    $p = new tennisplayer();
    
    echo "verifying multiple inheritance levels work<br>\n";
    echo "Result: " . ($p->say_hello('Mr. Agassi') == "hello Mr. Agassi, I am a tennis player also." ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test6() {
    
    class nobody2 extends person {
        function say_hello() {
            return parent::say_hello();
        }
    }
    
    $p = new nobody2();
    
    echo "verifying that parent::method() works.<br>\n";
    echo "Result: " . ($p->say_hello() == "I am a person" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test7() {

    class animal {
        function identify($type) {
            return "I am a $type.";
        }
    }

    
    class cat extends animal {
        function identify($type) {
            return parent::identify($type);
        }
    }

    class lion extends cat{
        function identify() {
            return parent::identify('lion');
        }
    }

    
    $p = new lion();
    
    echo "verifying passing arg to parent works, eg: parent::method(\$arg)<br>\n";
    echo "Result: " . ($p->identify() == "I am a lion." ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test8() {

    class road {
        var $type;
        var $lanes = 2;
        function __construct($type) {
            $this->type = $type;
        }
        
        function identify() {
            return "I am a {$this->lanes} lane {$this->type}";
        }
    }
    
    class highway extends road {
        function __construct() {
            parent::__construct( 'highway' );
            $this->lanes = 4;
        }
    }
    
    $p = new highway();
    
    echo "verify that parent constructor can be called from subclass constructor, with param<br>\n";
    echo "Result: " . ($p->identify() == "I am a 4 lane highway" ? 'pass' : 'fail') . "<br><br>\n\n";
}

class oldroad {
    var $type;
    var $lanes = 2;
    function oldroad($type) {
        $this->type = $type;
    }
    
    function identify() {
        return "I am a {$this->lanes} lane {$this->type}";
    }
}


function test9() {

    class freeway extends oldroad {
        function __construct() {
            parent::__construct( 'freeway' );
            $this->lanes = 6;
        }
    }
    
    $p = new freeway();
    
    echo "verify that php4 style parent constructor can be called from subclass constructor, using __construct()<br>\n";
    echo "Result: " . ($p->identify() == "I am a 6 lane freeway" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test10() {

    class alley extends oldroad {
        function __construct() {
            parent::oldroad( 'alley' );
            $this->lanes = 1;
        }
    }
    
    $p = new alley();
    
    echo "verify that php4 style parent constructor can be called from subclass constructor, using classname()<br>\n";
    echo "Result: " . ($p->identify() == "I am a 1 lane alley" ? 'pass' : 'fail') . "<br><br>\n\n";
}


    class counter {
        var $count = 0;
        function __construct() {
            $this->count ++;
        }
    }

    class subcounter extends counter {
        function __construct() {
            parent::__construct();
            $this->count ++;
        }
    }

    class subsubcounter extends subcounter {
        function __construct() {
            parent::__construct();
            $this->count ++;
        }
    }

    class subsubsubcounter extends subsubcounter {
        function __construct() {
            subcounter::__construct();
//            parent::__construct();
            $this->count ++;
        }
    }


function test11() {

    $p = new subsubcounter();
    
    echo "verify that >2 levels of constructors can be called<br>\n";
    echo "Result: " . ($p->count == 3 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test12() {

    $p = new subsubsubcounter();
    
    echo "verify that grandfather constructor can be called, skipping parent constructor<br>\n";
    echo "Result: " . ($p->count == 3 ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test13() {
    
    class test13class extends person {
        function say_hello() {
            return person::say_hello();
        }
    }
    
    $p = new test13class();
    
    echo "verifying that parentclassname::method() works.<br>\n";
    echo "Result: " . ($p->say_hello() == "I am a person" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test14() {

    class z {
        function identify($type) {
            return "I am a $type.";
        }
    }

    
    class zz extends z {
        function identify() {
            return parent::identify('zz');
        }
    }
    
    $p = new zz();
    
    echo "verifying passing arg to parent works, eg: parentclassname::method(\$arg)<br>\n";
    echo "Result: " . ($p->identify() == "I am a zz." ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test15() {

    class test15class extends person {
        function __construct() {
            $this->mytype = 'test15class';
            $this->id = $this->say_hello();
        }
    }
    $p = new test15class();
    
    echo "verifying that method defined in parent class can be called from constructor of subclass<br>\n";
    echo "Result: " . ($p->id == "I am a test15class" ? 'pass' : 'fail') . "<br><br>\n\n";
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
    
    echo "verifying self::staticmethod() works when staticmethod defined in parent class only<br>\n";
    echo "Result: " . (test16child::add() == 3 ? 'pass' : 'fail') . "<br><br>\n\n";
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


?>