<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (index.php)] concatenata con 
"\\app\\config\\autoloader.php" per arrivare alla posizione finale partendo da __DIR__
*/ 
require_once (__DIR__."\\app\\config\\autoloader.php");

//la variabile $fc punta ad un oggetto del front controller (control\CFrontController.php) 
$fc = new CFrontController();
/*
nella variabile var viene salvato il valore restituito dalla funzione run dichiarata 
nel front controller al quale viene passato l'URI ovvero la stringa inserita nel browser
Esempio:
http://localhost/dashboard/
*/
$var = $fc->run($_SERVER['REQUEST_URI']);
?>