<?php

require_once ("/opt/lampp/htdocs/Slope/app/config/autoloader.php");

class CUser {

    /**
     * load all the Posts in homepage (Posts of the Users that the logged User are following). Also are loaded Information about vip User and
     * about profile Images of all the involved User
     */
    public static function home() {
        /* if(CUser::isLogged()){
            $view = new VUser();

            $userId = USession::getInstance()->getSessionElement('user');
            $userAndPropic = FPersistentManager::getInstance()->loadUsersAndImage($userId);

            //load all the posts of the users who you follow(post have user attribute) and the profile pic of the author of teh post
            $postInHome = FPersistentManager::getInstance()->loadHomePage($userId);
            
            //load the VIP Users, their profile Images and the foillower number
            $arrayVipUserPropicFollowNumb = FPersistentManager::getInstance()->loadVip();
        
            $view->home($userAndPropic, $postInHome,$arrayVipUserPropicFollowNumb);
        }  */
        $view = new VUser();
        $view->showRegistrationForm(); 
    }

    public static function registration() { #$mail, $username
        /* $_POST['email'] = $mail;
        $_POST['username'] = $username;
        $_POST['name'] = 'L';
        $_POST['surname'] = 'D';
        $_POST['phoneNumber'] = '333';
        $_POST['birthDate'] = '2002-10-30';
        $_POST['password'] = 'Lorenzo'; */
        $view = new VUser();
        #print_r($_POST);
        #print(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')));
        if(FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email')) == false && FPersistentManager::getInstance()->verifyUserUsername(UHTTPMethods::post('username')) == false) {
            $user = new EUser(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), UHTTPMethods::post('phoneNumber'), UHTTPMethods::post('birthDate'), UHTTPMethods::post('username'), UHTTPMethods::post('password'));
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

    

    public static function isLogged()
    {
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

    
}

?>