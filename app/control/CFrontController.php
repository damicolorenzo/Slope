<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CFrontController {
    
    public function run($requestUri){ 
        //Traduzione della richiesta URI ovvero stringa che viene passata nel browser
        

        /*
        Rimuove gli spazi vuoti o i caratteri passati in input all'inizio o alla fine 
        della stringa
        */
        $requestUri = trim($requestUri, '/');


        //Suddivide la stringa dividendola quando incontra il carattere specificato generando così un array di stringhe 
        $uriParts = explode('/', $requestUri);

        //Rimuove il primo elemento dalla lista scalando gli elementi rimanenti di un posto verso sinistra
        array_shift($uriParts);

        $condition = empty($uriParts[0]);

        if (!$condition) {
            //Rende maiuscolo il primo carattere della stringa 
            $controllerName = ucfirst($uriParts[0]);
        } else {
            $controllerName = 'User';
        }

        $condition = empty($uriParts[1]);

        if (!$condition) {
            $methodName = $uriParts[1];
        } else {
            $methodName = 'home';
        }
        
        //Il punto indica il concatenamento delle stringhe
        $controllerClass = 'C' . $controllerName;

        //La riga seguente coincide con $controllerFile = __DIR__ . '/' . $controllerClass . ".php";
        $controllerFile = __DIR__ . "/{$controllerClass}.php";

        //Controlla se il file esiste 
        if (file_exists($controllerFile)) {
            //Nel caso esiste lo richiede
            require_once $controllerFile;

            //Controlla se nel file è presente il metodo specificato
            if (method_exists($controllerClass, $methodName)) {
                /*
                Rimuove i primi due elementi dalla lista (avendo passato 2, altrimenti rimuove n elementi dalla lista)
                In params vogliamo mettere eventuali parametri passati nell'URI
                */

                $params = array_slice($uriParts, 2);

                //Chiama la funzione $methodName all'interno del file $controllerClass passando come parametri $params 
                call_user_func_array([$controllerClass, $methodName], $params);
            } else {

                //Il metodo non è stato trovato quindi rimanda ad una pagina di default
                header('Location: /Slope/User/home');    
            }
        } else {

            //Il controllore non è stato trovato quindi rimanda ad una pagina di default
            header('Location: /Slope/User/home');
        }
    }
}
