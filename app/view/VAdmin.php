<?php

require_once (__DIR__."/../foundation/utility/StartSmarty.php");

class VAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('admin-login.tpl');
    }

    public function loginSessionError() {
        $this->smarty->display('admin-login.tpl');
    }

    public function loginPasswordError() {
        $this->smarty->display('admin-login.tpl');
    }

    public function dashboard($map, $etichettePie, $valoriPie) {
        $this->smarty->assign('map', $map);
        $this->smarty->assign('etichettePie', $etichettePie);
        $this->smarty->assign('valoriPie', $valoriPie);
        $this->smarty->display('admin-dashboard.tpl');
    }

}

?>