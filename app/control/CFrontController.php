<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CFrontController {
    
    public function run($requestUri){
        /* 
        Traduzione della richiesta URI ovvero stringa che viene passata nel browser
        Esempio inseriamo nella barra di ricerca localhost/Slope
        $requestUri = /Slope/
        */

        /*
        Rimuove gli spazi vuoti o i caratteri passati in input all'inizio o alla fine 
        della stringa

        */

        $requestUri = trim($requestUri, '/');


        /*
        Suddivide la stringa dividendola quando incontra il carattere specificato generando così un array di stringhe 
        Esempio 
        $requestUri = Slope/entity/EAdmin --> $uriParts = ["Slope", "entity", "EAdmin"]
        */
        $uriParts = explode('/', $requestUri);

        //Rimuove il primo elemento dalla lista scalando gli elementi rimanenti di un posto verso sinistra
        array_shift($uriParts);

        /*
        $condition è vero se non c'è un secondo blocco dopo lo / 
        Esempio 
        $uriParts = ['Slope']
        array_shift($uriParts) --> $uriParts[0] è vuoto
        $condition = true
        */
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
                /* print("file non esiste");
                print($controllerFile);
                print($controllerClass);
                print(var_export($admin)); */
                //Il metodo non è stato trovato quindi rimanda ad una pagina di errore
                header('Location: /Slope/User/home');
                /* if($admin)
                    header('Location: /Slope/Admin/dashboard');
                else 
                    header('Location: /Slope/User/home'); */       
            }
        } else {
            /* print("controllore non esiste");
            print($controllerFile);
            print($controllerClass); */
            //Il controllore non è stato trovato quindi rimanda ad una pagina di errore
            header('Location: /Slope/User/home');
            /* if($admin)
                header('Location: /Slope/Admin/dashboard');
            else 
                header('Location: /Slope/User/home'); */
        }
    }
}

/*
Analisi del flusso 

La priva volta che accediamo al sito web inseriamo semplicemente il nome che in questo caso è
localhost/Slope.
Per come è strutturato il codice descritto sopra di default utilizzeremo il controllore CUser e chiameremo il metodo home 
per richiedere la pagina web designata come home del sito.
Dunque per continuare l'analisi del codice bisogna passare alla lettura del file CUser (\control\CUser.php)
*/