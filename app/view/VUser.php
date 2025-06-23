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

    public function showLoginForm($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm($phone = false, $date = false, $pass = false, $post = [], $exist = false) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->assign('phoneError', $phone);
        $this->smarty->assign('dateError', $date);
        $this->smarty->assign('passwordError', $pass);
        $this->smarty->assign('name', isset($post['name']) ? $post['name'] : "");
        $this->smarty->assign('surname', isset($post['surname']) ? $post['surname'] : "");
        $this->smarty->assign('email', isset($post['email']) ? $post['email'] : "");
        $this->smarty->assign('username', isset($post['username']) ? $post['username'] : "");
        $this->smarty->assign('phoneNumber', isset($post['phoneNumber']) ? $post['phoneNumber'] : "");
        $this->smarty->assign('birthDate', isset($post['birthDate']) ? $post['birthDate'] : "");
        $this->smarty->display('registration.tpl');
    }

    public function loggedHome($map) {
        $this->smarty->assign('map', $map);
        $this->smarty->display('loggedHome.tpl');
    }

    public function home($allSkiFacility, $skipassObj, $images){
        $this->smarty->assign('skiFacilities', $allSkiFacility);
        $this->smarty->assign('skipassObj', $skipassObj);
        for($i = 1; $i <= count($images); $i++) {
            $this->smarty->assign('image'.$i, $images[$i-1]);
        }
        $this->smarty->display('home.tpl'); 
    }

    public function confirmPage() {
        $this->smarty->display('confirmPage.tpl');
    }

    /* public function someError($phone, $date, $pass, $post) {
        $this->smarty->assign('exist', false);
        $this->smarty->assign('phoneError', $phone);
        $this->smarty->assign('dateError', $date);
        $this->smarty->assign('passwordError', $pass);
        $this->smarty->assign('name', $post['name']);
        $this->smarty->assign('surname', $post['surname']);
        $this->smarty->assign('email', $post['email']);
        $this->smarty->assign('username', $post['username']);
        $this->smarty->assign('phoneNumber', $post['phoneNumber']);
        $this->smarty->assign('birthDate', $post['birthDate']);
        $this->smarty->display('registration.tpl');
    } */

    /* public function userAlreadyExist($phone, $date, $pass, $post) {
        $this->smarty->assign('exist', true);
        $this->smarty->assign('phoneError', $phone);
        $this->smarty->assign('dateError', $date);
        $this->smarty->assign('passwordError', $pass);
        $this->smarty->assign('name', $post['name']);
        $this->smarty->assign('surname', $post['surname']);
        $this->smarty->assign('email', $post['email']);
        $this->smarty->assign('username', $post['username']);
        $this->smarty->assign('phoneNumber', $post['phoneNumber']);
        $this->smarty->assign('birthDate', $post['birthDate']);
        $this->smarty->display('registration.tpl');
    } */
}

?>