<?php

function test1() {
    $do = 'yes';
    $interface = 5;
    $null = null;
    $throw = 'ball';
    $if = 'bool';
    $false = false;
    
    echo "spot check that some JS reserved words can be used.<br>\n";
    echo 'result: ' . ($do == 'yes' && $interface == 5 && $null === null && $throw == 'ball' && $if == 'bool' && $false === false ? 'pass' : 'fail') . "<br><br>\n\n";
}


function test2() {

    $break = 1;
    $case = 1;
    $catch = 1;
    $continue = 1;
    $default = 1;
    $delete = 1;
    $do = 1;
    $else = 1;
    $false = 1;
    $finally = 1;
    $for = 1;
    $function = 1;
    $if = 1;
    $in = 1;
    $instanceof = 1;
    $new = 1;
    $null = 1;
    $return = 1;
    $switch = 1;
//    $this = 1;  // illegal.  $this is a PHP reserved variable name.
    $throw = 1;
    $true = 1;
    $try = 1;
    $typeof = 1;
    $var = 1;
    $void = 1;
    $while = 1;
    $with = 1;
        
    // JS 3 reserved words
    $abstract = 1;
    $boolean = 1;
    $byte = 1;
    $char = 1;
    $class = 1;
    $const = 1;
    $debugger = 1;
    $double = 1;
    $enum = 1;
    $export = 1;
    $extends = 1;
    $final = 1;
    $float = 1;
    $goto = 1;
    $implements = 1;
    $import = 1;
    $int = 1;
    $interface = 1;
    $long = 1;
    $native = 1;
    $package = 1;
    $private = 1;
    $protected = 1;
    $public = 1;
    $short = 1;
    $static = 1;
    $super = 1;
    $synchronized = 1;
    $throws = 1;
    $transient = 1;
    $volatile = 1;

    echo "Test that all JS reserved words can be used.<br>\n";
    echo 'result: ' . ('pass') . "<br><br>\n\n";  // If we didn't get a compilation error, then it passes.  :-)
}

test1();
test2();

?>