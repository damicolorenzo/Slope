<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CPurchaseInsurance {

    public static function buyInsurance() {
        if(CUser::isLogged()) {
            $view = new VPurchaseInsurance();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
            $skipassBooking  = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            USession::setSessionElement('idSkipassBooking', $idSkipassBooking);
            $date = $skipassBooking[0]->getStartDate();
            $period = $skipassBooking[0]->getPeriod();
            $view->makeAInsuranceForm($user[0], $date, $period, false);
        } else {
            CUser::home();
        }
    }

    public static function confirmInsurance() {
        if(CUser::isLogged()) {
            $view = new VPurchaseInsurance();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $selectedDate = UHTTPMethods::post('date');
            $name = UHTTPMethods::post('name');
            $surname = UHTTPMethods::post('surname');
            $email = UHTTPMethods::post('email');
            $idSkipassBooking = USession::getSessionElement('idSkipassBooking');
            USession::unsetSessionElement('idSkipassBooking');
            $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
            $type = $skipassBooking[0]->getType();
            $period = $skipassBooking[0]->getPeriod();
            if(!CManageBooking::verifyaDate($selectedDate)) {
                $view->makeAInsuranceForm($user[0], $selectedDate, $period, true);
            }
            $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
            $price = $insuranceTemp[0]->getValue();
            if($period > 1)
                $price = $price * $period;
            $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
            $insurance->setIdUser($userId);
            USession::getInstance()->setSessionElement('insurance', $insurance);
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId); 
            if($verifyPreferredCreditCard) {
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $view->insurancePaymentSection($insurance, $price, $creditCard[0]);
            } else {
                $view->insurancePaymentSection($insurance, $price, null);
            }
        } else {
            CUser::home();
        }
    }

    public static function insurancePayment() {
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
            if($verifyPreferredCreditCard) { 
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                if(!$cond) {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on') 
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->updateCreditCard($creditCard);
                } 
            } else { 
                $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                if(UHTTPMethods::post('preferred') == 'on')
                    $creditCard->setIdUser($userId);
                else 
                    $creditCard->setIdUser(0);
                FPersistentManager::getInstance()->uploadObj($creditCard);
            }
            $today = new DateTime();
            $insurance = USession::getSessionElement('insurance');
            $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
            FPersistentManager::getInstance()->uploadObj($insurance);
            $retrivedInsurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
            $payment->setIdExternalObj($retrivedInsurance[0]->getIdInsurance());
            $payment->setIdCreditCard($creditCard[0]->getIdCreditCard());
            FPersistentManager::getInstance()->uploadObj($payment);
            USession::unsetSessionElement('insurance');
            CUser::home();
        } else {
            CUser::home();
        }
    }
}

?>
