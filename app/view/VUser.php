<?php
require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VUser {

    private $smarty;

    public function __construct() {
        $this->projectPath = 'Slope';
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm() {
        $this->smarty->assign('projectPath', $this->projectPath);
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm() {
        $this->smarty->assign('projectPath', $this->projectPath);
        $this->smarty->display('registration.tpl');
    }

    public function registrationError() {
        $this->smarty->assign('projectPath', $this->projectPath);
        $this->smarty->display('registration.tpl');
    }

    public function home(){
        $this->smarty->assign('projectPath', $this->projectPath);
        $this->smarty->display('home.tpl');
    }
}

?>