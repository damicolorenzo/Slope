<?php
 
require_once (__DIR__."/../foundation/utility/StartSmarty.php");

class VUser {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm($phone, $date, $pass, $post = [], $exist) {
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
}

?>