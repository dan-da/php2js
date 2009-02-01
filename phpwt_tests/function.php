<?php



function test1() {
    
    function say_hi($fname='John', $lname='Doe') {
        return "hi $fname $lname";
    }
    $result1 = say_hi();
    $result2 = say_hi('Daffy', 'Duck');
    
    echo "Test that default function parameters work as expected.<br>\n";
    echo 'result: ' . ($result1 == 'hi John Doe' && $result2 == 'hi Daffy Duck' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test2() {
    
    function func($fname=array('ball') ) {
        return $fname;
    }
    $result1 = func();
    
    echo "Test that empty array default parameter works as expected.<br>\n";
    echo 'result: ' . ($result1[0] == 'ball' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test3() {

    if( true ) {
        function func3() {
            return 'called func3';
        }
    }
    else {
        function func3() {
            return 'did not call func3';
        }
    }
    
    $result1 = func3();
    
    echo "Test that function may be conditionally defined.<br>\n";
    echo 'result: ' . ($result1 == 'called func3' ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test4() {
    
    function func4() {
        function func4a() { return 'hello from func4a'; }
    }
    func4();
    $result1 = func4a();
    
    echo "Test that function may be called outside scope where defined.<br>\n";
    echo 'result: ' . ($result1 == 'hello from func4a' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {
    $func5 = 'var func5';
    
    function func5() {
        return 'hello from func5';
    }
    $result = func5();
    
    echo "Test that function and variable names do not collide.<br>\n";
    echo 'result: ' . ($result == 'hello from func5' && $func5 == 'var func5' ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();
test2();
test3();
test4();
test5();

?>