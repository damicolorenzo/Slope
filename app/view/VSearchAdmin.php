<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VSearchAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function searchUsers($users) {
        $this->smarty->assign('users', $users);
        $this->smarty->display('admin-searchUser.tpl');
    }

    public function searchStructure($result) {
        $this->smarty->assign('objects', $result);
        $this->smarty->display('admin-searchStructure.tpl');
    }

    public function searchSkipassObjs($skipassObjs) {
        $this->smarty->assign('skipassObjs', $skipassObjs);
        $this->smarty->display('admin-searchSkipassObj.tpl');
    }      

    public function searchSkipassBooking($result) {
        $this->smarty->assign('objects', $result);
        $this->smarty->display('admin-searchSkipassBooking.tpl');
    }

    public function searchSkipassTemps($skipassTemps) {
        $this->smarty->assign('skipassTemps', $skipassTemps);
        $this->smarty->display('admin-searchSkipassTemplate.tpl');
    }

    public function searchInsuranceTemps($insuranceTemps) {
        $this->smarty->assign('insuranceTemps', $insuranceTemps);
        $this->smarty->display('admin-searchInsuranceTemplate.tpl');
    }

    public function searchSubscriptionTemps($subscriptionTemps) {
        $this->smarty->assign('subscriptionTemps', $subscriptionTemps);
        $this->smarty->display('admin-searchSubscriptionTemplate.tpl');
    }



}

?>