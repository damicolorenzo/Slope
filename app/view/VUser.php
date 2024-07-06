<?php
require_once ("/opt/lampp/htdocs/Slope/app/foundation/utility/StartSmarty.php");

class VUser {

    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm() {
        $this->smarty->display('registration.tpl');
    }

    public function showRegistrationForm() {
        $this->smarty->display('registration.tpl');
    }

    public function registrationError() {
        $this->smarty->display('registration.tpl');
    }

    public function home(){
        $this->smarty->display('home.tpl');
    }
}

?>