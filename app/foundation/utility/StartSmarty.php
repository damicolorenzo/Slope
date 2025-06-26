<?php

/*
richiediamo il file Smarty.class.php posizionato nella macrocartella libs 
libs sta per librerie quindi tutte le librerie esterne utilizzate (in questo caso solo Smarty)
*/
require(__DIR__.'/../../../libs/Smarty/Smarty.class.php');

class StartSmarty {

    static function configuration() {
        /*
        In questa funzione vengono impostate le posizioni delle cartelle che Smarty utilizza per 
        svolgere le sue funzioni.
        L'unica cartella che ci interessa è templates nel quale caricheremo i file con estensione
        .tpl per specificare i template delle varie pagine del sito
        */
        $smarty = new Smarty();
        $smarty->template_dir = __DIR__.'/../../../libs/Smarty/templates/';
        $smarty->compile_dir = __DIR__.'/../../../libs/Smarty/templates_c/';
        $smarty->config_dir = __DIR__.'/../../../libs/Smarty/configs/';
        $smarty->cache_dir = __DIR__.'/../../../libs/Smarty/cache/';
        return $smarty;
    }

}

?>