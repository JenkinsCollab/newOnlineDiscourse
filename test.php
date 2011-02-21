<?php

session_start();

$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];

?>
