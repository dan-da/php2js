<?php

function test1() {
    $data = '"';
    
    echo "Test Double quotes embedded in a single-quote string.<br>\n";
    echo 'result: ' . ($data === '"' ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test2() {
    $data = "'";
    
    echo "Test single quotes embedded in a double-quote string.<br>\n";
    echo 'result: ' . ($data === "'" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test3() {
    $data = "\n";
    
    echo "Test escaped newline embedded in a double-quote string.<br>\n";
    echo 'result: ' . ($data === "\n" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test4() {
    $data = '\n';
    
    echo "Test escaped newline embedded in a single-quote string.<br>\n";
    echo 'result: ' . ($data === "\\n" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test5() {
    $data = "1
2";
    
    echo "Test real newline in a string. (multi-line string)<br>\n";
    echo 'result: ' . ($data === "1\n2" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test6() {
    $data = "\"";
    
    echo "Test escaped quote in a string. <br>\n";
    echo 'result: ' . ($data === "\"" ? 'pass' : 'fail') . "<br><br>\n\n";
}

function test7() {
    $days = array('monday', 'tuesday');
    $day_idx = 1;
    $animal = 'cat';
    
    $data = <<< END
line1 $days[$day_idx]
line2 kitty_{$animal}
line3
END;
    
    echo "Test heredoc multiline string with embedded variables. <br>\n";
    echo 'result: ' . ($data === "line1 tuesday\nline2 kitty_cat\nline3" ? 'pass' : 'fail') . "<br><br>\n\n";
}


test1();
test2();
test3();
test4();
test5();
test6();
test7();

?>