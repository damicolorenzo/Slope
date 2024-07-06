<?php

require_once ("/opt/lampp/htdocs/Slope/app/config/autoloader.php");

$fc = new CFrontController();

$var = $fc->run($_SERVER['REQUEST_URI']);


?>