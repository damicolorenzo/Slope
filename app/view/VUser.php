<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (VUser.php)] concatenata con 
"\\..\\foundation\\utility\\StartSmarty.php" per arrivare alla posizione finale partendo da __DIR__.
Nella cartella foundation è presente una cartella utility che permette di gestire tra le varie cose anche 
il caricamento delle pagine tramite Smarty.
Nel file StartSmarty.php sono specificate le posizioni delle 4 cartelle di funzionamento di Smarty
posizionate nella cartella libs (leggere il codice di StartSmarty \foundation\utility\StartSmarty.php) 
*/ 
require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VUser {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    /*
    Nella fase iniziale l'unica funzione che ci interessa è home che permette di mostrare la pagina descritta tramite il 
    template home.tpl 
    [Piccola specifica per home.tpl]
    Questo file è molto simile ad un file .html ma contiene dei tag particolari che permettono di passare parametri aggiuntivi
    e quindi tramite dei costrutti condizionale come if o cicli come for permettono di rendere la pagina più dinamica 
    Esempio 
    passando un parametro $nomeUtente possiamo visualizzare il nome dell'utente nella pagina web in modo tale che ogni volta che 
    un utente fa il login possa poi riconoscere il suo nome sullo schermo (nome diverso per ogni utente altrimenti si chiamano tutti
    user)
    Di fatto nella pagina html non c'è un modo per passare dei dati se non tramite file php quindi il file .tpl è una versione intelligente
    del file html 
    */
    public function home(){
        $this->smarty->display('home.tpl');
    }

    public function showLoginForm() {
        $this->smarty->assign('projectPath');
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm() {
        $this->smarty->assign('projectPath');
        $this->smarty->display('registration.tpl');
    }

    public function registrationError() {
        $this->smarty->assign('projectPath');
        $this->smarty->display('registration.tpl');
    }

    
}

?>