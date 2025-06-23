<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VPurchaseSubscription {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    public function makeASubscriptionForm($user, $startDate, $endDate) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('startDate', $startDate);
        $this->smarty->assign('endDate', $endDate);
        $this->smarty->display('makeASubscriptionForm.tpl');
    }

    public function subscriptionPaymentSection($subscription, $price, $creditCard) {
        $this->smarty->assign('price', $price);
        $this->smarty->assign('creditCard', $creditCard);
        $this->smarty->assign('subscription', $subscription);
        $this->smarty->display('subscriptionPaymentSection.tpl');
    }

}

?>