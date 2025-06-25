<?php

require_once (__DIR__."/../foundation/utility/StartSmarty.php");

class VAddAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function addSkiRun($skiFacilities) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', false);
        $this->smarty->display("admin-addSkiRun.tpl");
    }

    public function addSkiFacility() {
        $this->smarty->display("admin-addSkiFacility.tpl");
    }

    public function addLiftStructure($skiFacilities) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', false);
        $this->smarty->display("admin-addLiftStructure.tpl");
    }

    public function addSkipassTemplate() {
        $this->smarty->display('admin-addSkipassTemplate.tpl');
    }

    public function addInsuranceTemplate() {
        $this->smarty->display('admin-addInsuranceTemplate.tpl');
    }

    public function addSubscription() {
        $this->smarty->display('admin-addSubscription.tpl');
    }

    public function addSkipassObj($skiFacilities, $templates) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('templates', $templates);
        $this->smarty->display('admin-addSkipassObj.tpl');
    }
}

?>