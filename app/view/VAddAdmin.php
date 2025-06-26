<?php

require_once (__DIR__."/../foundation/utility/StartSmarty.php");

class VAddAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function addSkiRun($skiFacilities, $exist) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', $exist);
        $this->smarty->display("admin-addSkiRun.tpl");
    }

    public function addSkiFacility($exist, $errorLen) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->assign('errorLen', $errorLen);
        $this->smarty->display("admin-addSkiFacility.tpl");
    }

    public function addLiftStructure($skiFacilities, $exist) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', $exist);
        $this->smarty->display("admin-addLiftStructure.tpl");
    }

    public function addSkipassTemplate($exist) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->display('admin-addSkipassTemplate.tpl');
    }

    public function addInsuranceTemplate($exist) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->display('admin-addInsuranceTemplate.tpl');
    }

    public function addSubscription($exist) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->display('admin-addSubscription.tpl');
    }

    public function addSkipassObj($skiFacilities, $templates, $exist) {
        $this->smarty->assign('exist', $exist);
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('templates', $templates);
        $this->smarty->display('admin-addSkipassObj.tpl');
    }
}

?>