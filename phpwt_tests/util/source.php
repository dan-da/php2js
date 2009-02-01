<?php

$file = basename($_GET['file']);
highlight_file( dirname(__FILE__) . '/../' . $file );

?>