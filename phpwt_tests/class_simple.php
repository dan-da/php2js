<?php

function test1() {

    class person {
        var $name = 'Mickey Mouse';
        
        function get_name() {
            return $this->name;
        }
    }
    
    $p = new person();
    
    echo "verifying static variable init and a basic accessor routine<br>\n";
    echo "Result: " . ($p->get_name() == 'Mickey Mouse' ? 'pass' : 'fail') . "<br><br>\n\n";
}

test1();


?>