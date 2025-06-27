<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CPurchaseInsurance {

    /**
     * Loads the insurance purchase form for a logged-in user based on a skipass booking ID.
     * Redirects to home if not logged in or ID not provided.
     * @return void
     */
    public static function buyInsurance() :void{
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
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
        } else {
            CUser::home();
        }
    }

    /**
     * Confirms insurance details from user input, validates date, calculates price,
     * saves insurance temporarily in session, and shows payment section.
     * Redirects to home if user not logged in or required data missing.
     * @return void
     */
    public static function confirmInsurance() :void{
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('date')) && !is_null(UHTTPMethods::post('name')) && 
            !is_null(UHTTPMethods::post('surname')) && !is_null(UHTTPMethods::post('email'))) {
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
                if(!CManageBooking::verifyDate($selectedDate)) {
                    $view->makeAInsuranceForm($user[0], $selectedDate, $period, true);
                }
                $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
                $price = $insuranceTemp[0]->getValue();
                if($period > 1)
                    $price = $price * $period;
                $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
                $insurance->setIdUser($userId);
                $insurance->setIdSkipassBooking($idSkipassBooking);
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
        } else {
            CUser::home();
        }
    }

    /**
     * Confirms insurance details from user input, validates date, calculates price,
     * saves insurance temporarily in session, and shows payment section.
     * Redirects to home if user not logged in or required data missing.
     * @return void
     */
    public static function insurancePayment() :void{
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            if(!is_null(UHTTPMethods::post('cardHolderName')) && !is_null(UHTTPMethods::post('cardHolderSurname')) && 
            !is_null(UHTTPMethods::post('expiryDate')) && !is_null(UHTTPMethods::post('cardNumber')) && !is_null(UHTTPMethods::post('cvv'))) {
                if(UHTTPMethods::post('preferred') == 'on') {
                    $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
                    if($verifyPreferredCreditCard) { 
                        $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                        $creditCard = $creditCard[0];
                        $cond = UHTTPMethods::post('cardHolderName') == $creditCard->getCardHolderName() &&
                        UHTTPMethods::post('cardHolderSurname') == $creditCard->getCardHolderSurname() &&
                        UHTTPMethods::post('expiryDate') == $creditCard->getExpiryDate() && 
                        UHTTPMethods::post('cardNumber') == $creditCard->getCardNumber() &&
                        UHTTPMethods::post('cvv') == $creditCard->getCvv();
                        if(!$cond) {
                            $creditCard->setIdUser(0);
                            FPersistentManager::getInstance()->updateCreditCard($creditCard);
                            $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                            $creditCard->setIdUser($userId);
                            FPersistentManager::getInstance()->uploadObj($creditCard);
                        }
                    } else {
                        $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                        $creditCard->setIdUser($userId);
                        FPersistentManager::getInstance()->updateCreditCard($creditCard);
                    }
                    $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                    $today = new DateTime();
                    $insurance = USession::getSessionElement('insurance');
                    $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($insurance);
                    $retrivedInsurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
                    $payment->setIdExternalObj($retrivedInsurance[0]->getIdInsurance());
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                    USession::unsetSessionElement('insurance');
                    CUser::home();
                } else {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->uploadObj($creditCard);
                    $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCard($creditCard);
                    $today = new DateTime();
                    $insurance = USession::getSessionElement('insurance');
                    $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($insurance);
                    $retrivedInsurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
                    $payment->setIdExternalObj($retrivedInsurance[0]->getIdInsurance());
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                    USession::unsetSessionElement('insurance');
                    CUser::home();
                } 
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }
}

?>
