<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VUserOperations {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    public function profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $creditCard, $subscription, $rebuySub) {
        $this->smarty->assign('username', $username);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('surname', $surname);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('phoneNumber', $phoneNumber);
        $this->smarty->assign('birthDate', $birthDate);
        $this->smarty->assign('image', $image);
        $this->smarty->assign('creditCard', $creditCard);
        $this->smarty->assign('subscription', $subscription); 
        $this->smarty->assign('rebuySub', $rebuySub);
        $this->smarty->display('profileInfo.tpl');
    }

    public function modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError) {
        $this->smarty->assign('username', $username);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('surname', $surname);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('phoneNumber', $phoneNumber);
        $this->smarty->assign('birthDate', $birthDate);
        $this->smarty->assign('phoneError', $phoneError);
        $this->smarty->display('modifyProfile.tpl');
    }

    public function modifyProfileImage($imageError, $image) {
        $this->smarty->assign('imageError', $imageError);
        $this->smarty->assign('image', $image);
        $this->smarty->display('modifyProfileImage.tpl');
    }

    public function modifyPassword($passError) {
        $this->smarty->assign('passwordError', $passError);
        $this->smarty->display('modifyPassword.tpl');
    }

    public function modifyCreditCard($cardHName, $cardHSurname, $cardNumber, $expirtDate) {
        $this->smarty->assign("cardHName", $cardHName);
        $this->smarty->assign("cardHSurname", $cardHSurname);
        $this->smarty->assign("cardNumber", $cardNumber);
        $this->smarty->assign("expiryDate", $expirtDate);
        $this->smarty->display("modifyCreditCard.tpl");
    }

    public function buySubscription($user) {
        $this->smarty->assign('user', $user);
        $this->smarty->display('buySubscription.tpl');
    }

    public function buyInsurance($user, $skipassBooking) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('skipassBooking', $skipassBooking);
        $this->smarty->display('buyInsurance.tpl');
    }

}
?>