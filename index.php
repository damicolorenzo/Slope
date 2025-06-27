<?php
 
require_once (__DIR__."\\app\\config\\autoloader.php");

$fc = new CFrontController();

$var = $fc->run($_SERVER['REQUEST_URI']);
?>