<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (CUser.php)] concatenata con 
"\\..\\config\\autoloader.php" per arrivare alla posizione finale partendo da __DIR__.
I doppi punti sono utilizzati per andare indietro di una cartella quindi da control uscire ed andare a app
*/ 
require_once (__DIR__."\\..\\config\\autoloader.php");

class CUser {

    /*
    Questa funzione viene chiamata di default dal CFrontController se nella barra di ricerca immettiamo 
    semplicemente Slope.
    La porzione commentata all'intero è un copia e incolla del metodo di Agora-main
    */
    public static function home() {
        //creazione di un oggetto VUser
        $view = new VUser();
        //chiamata alla funzione home di VUser (prima di andare avanti con questo file saltare al file VUser \view\VUser.php)
        $view->home();
        /* if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);

            //load all the posts of the users who you follow(post have user attribute) and the profile pic of the author of teh post
            $postInHome = FPersistentManager::getInstance()->loadHomePage($userId);
            
            //load the VIP Users, their profile Images and the foillower number
            $arrayVipUserPropicFollowNumb = FPersistentManager::getInstance()->loadVip();
        
            $view->home($userAndPropic, $postInHome,$arrayVipUserPropicFollowNumb); 
        } */
    }

    /*
    Tutte le funzioni presenti qui sotto sono copiate dal progetto Agora-main poiché effettuano dei compiti 
    identici in qualisiasi progetto quindi non hanno bisogno di molta personalizzazione (C'è poca voglia di riscriverle da zero) 
    */

    public static function registration() {
        $view = new VUser();
        $view->showRegistrationForm();
    }

    public static function checkRegistration() {
        $view = new VUser();
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) == false && FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')) == false) {
            $user = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), UHTTPMethods::post('phoneNumber'), UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT));
            $user->setIdImage(1);
            FPersistentManager::getInstance()->uploadObj($user);
            $view->showLoginForm();
        } else {
            $view->registrationError();
        }
    }
    

    public static function login(){
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            header('Location: /Slope/User/home');
        }
        $view = new VUser();
        $view->showLoginForm();
    }

    

    public static function isLogged() {
        $logged = false;

        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        if(!$logged){
            header('Location: /Slope/User/login');
            exit;
        }
        return true;
    }

    /**
     * check if exist the Username inserted, and for this username check the password. If is everything correct the session is created and
     * the User is redirected in the homepage
     */
    public static function checkLogin(){
        $view = new VUser();
        $username = FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username'));                                            
        if($username){
            $user = FPersistentManager::getInstance()->retriveUserOnUsername(UHTTPMethods::post('username'));
            if(password_verify(UHTTPMethods::post('password'), $user->getPassword())){
                if(USession::getSessionStatus() == PHP_SESSION_NONE){
                    USession::getInstance();
                    USession::setSessionElement('user', $user->getId());
                    header('Location: /Slope/User/home');
                }
            }else{
                $view->loginError();
            }
        }else{
            $view->loginError();
        }
    }

    
}

?>