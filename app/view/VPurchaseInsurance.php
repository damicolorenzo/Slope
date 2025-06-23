<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VPurchaseInsurance {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    public function makeAInsuranceForm($user, $today, $period, $dateWarning) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('period', $period);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->display('makeAInsuranceForm.tpl');
    }

    public function insurancePaymentSection($insurance, $price, $creditCard) {
        $this->smarty->assign('price', $price);
        $this->smarty->assign('creditCard', $creditCard);
        $this->smarty->assign('insurance', $insurance);
        $this->smarty->display('insurancePaymentSection.tpl');
    }

}

?>