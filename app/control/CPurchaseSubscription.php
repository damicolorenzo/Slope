<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CPurchaseSubscription {

    /**
     * Confirms insurance details from user input, validates date, calculates price,
     * saves insurance temporarily in session, and shows payment section.
     * Redirects to home if user not logged in or required data missing.
     * @return void
     */
    public static function buySubscription() {
        if(CUser::isLogged()) {
            $view = new VPurchaseSubscription();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = new DateTime();
            $currentYear = (int)$today->format('Y');
            $currentMonth = (int)$today->format('m');
        
            if($currentMonth >= 1 && $currentMonth <=3) {
                // Calcola i due range accettabili:
                // 1. Stagione invernale attuale (ottobre anno precedente -> marzo anno corrente)
                $startCurrentSeason = new DateTime(($currentYear - 1). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear) . "-03-31");
            
            } elseif($currentMonth >= 4 && $currentMonth <= 12) {
                // 1. Stagione invernale successiva o attuale  (ottobre anno corrente-> marzo anno successivo)
                $startCurrentSeason = new DateTime(($currentYear). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear + 1) . "-03-31");
            
            }
            $view->makeASubscriptionForm($user[0], $startCurrentSeason->format("d-m-y"), $endCurrentSeason->format("d-m-y"));
        } else {
            CUser::home();
        }
    }

    /**
     * Prepares subscription renewal form for the logged-in user by calculating the correct seasonal period
     * based on the current month and displays the form with the valid date range.
     * Redirects to home if user is not logged in.
     * @return void
     */
    public static function rebuySubscription() {
        if(CUser::isLogged()) {
            $view = new VPurchaseSubscription();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = new DateTime();
            $currentYear = (int)$today->format('Y');
            $currentMonth = (int)$today->format('m');
        
            if($currentMonth >= 1 && $currentMonth <=3) {
                // Calcola i due range accettabili:
                // 1. Stagione invernale attuale (ottobre anno precedente -> marzo anno corrente)
                $startCurrentSeason = new DateTime(($currentYear - 1). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear) . "-03-31");
            
            } elseif($currentMonth >= 4 && $currentMonth <= 12) {
                // 1. Stagione invernale successiva o attuale  (ottobre anno corrente-> marzo anno successivo)
                $startCurrentSeason = new DateTime(($currentYear). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear + 1) . "-03-31");
            
            }
            $view->makeASubscriptionForm($user[0], $startCurrentSeason->format("d-m-y"), $endCurrentSeason->format("d-m-y"));
        } else {
            CUser::home();
        }
    }

    /**
     * Handles the confirmation of a subscription purchase by creating a subscription object,
     * storing it in the session, and showing the payment section with the preferred credit card if available.
     * Redirects to home if required POST data is missing or user is not logged in.
     * @return void
     */
    public static function confirmSubscription() {
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname')) &&
            !is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('startDate')) && !is_null(UHTTPMethods::post('endDate'))) {
                $view = new VPurchaseSubscription();
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                $name = UHTTPMethods::post('name');
                $surname = UHTTPMethods::post('surname');
                $email = UHTTPMethods::post('email');
                $startDate = UHTTPMethods::post('startDate');
                $endDate = UHTTPMethods::post('endDate');
                $subscription = new ESubscription($name, $surname, $email, $startDate, $endDate);
                $subscription->setIdUser($userId);
                $subscription->setIdSubscriptionTemp(1);
                $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
                $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
                USession::getInstance()->setSessionElement('subscription', $subscription);
                if($verifyPreferredCreditCard) {
                    $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                    $view->subscriptionPaymentSection($subscription, $subscriptionTemp[0]->getValue(), $creditCard[0]);
                } else {
                    $view->subscriptionPaymentSection($subscription, $subscriptionTemp[0]->getValue(), null);
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    } 

    /**
     * Processes the subscription payment by handling credit card validation and storage,
     * creating the payment record, and finalizing the subscription. Supports preferred and non-preferred credit cards.
     * Redirects to home if user is not logged in or required POST data is missing.
     * @return void
     */
    public static function subscriptionPayment() {
        if(CUser::isLogged()){ 
            $userId = USession::getInstance()->getSessionElement('user');
            if(!is_null(UHTTPMethods::post('cardHolderName')) && !is_null(UHTTPMethods::post('cardHolderSurname')) && 
            !is_null(UHTTPMethods::post('expiryDate')) && !is_null(UHTTPMethods::post('cardNumber')) && 
            !is_null(UHTTPMethods::post('cvv')))  {
                if(UHTTPMethods::post('preferred') == 'on') {
                    $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
                    if($verifyPreferredCreditCard) { 
                        $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                        $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                        UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                        UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                        UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                        UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                        if(!$cond) {
                            $creditCard[0]->setIdUser(0);
                            FPersistentManager::getInstance()->updateCreditCard($creditCard[0]);
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
                    $subscription = USession::getSessionElement('subscription');
                    $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
                    $payment = new EPayment(get_class($subscription), $subscriptionTemp[0]->getValue(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($subscription);
                    $retrivedSubscription = FPersistentManager::getInstance()->retriveSubscription($subscription);
                    $payment->setIdExternalObj($retrivedSubscription[0]->getIdSubscription());
                    $payment->setIdCreditCard($creditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                    USession::unsetSessionElement('subscription');
                    CUser::home();
                } else {
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->uploadObj($creditCard);
                    $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCard($creditCard);
                    $today = new DateTime();
                    $subscription = USession::getSessionElement('subscription');
                    $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
                    $payment = new EPayment(get_class($subscription), $subscriptionTemp[0]->getValue(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($subscription);
                    $retrivedSubscription = FPersistentManager::getInstance()->retriveSubscription($subscription);
                    $payment->setIdExternalObj($retrivedSubscription[0]->getIdSubscription());
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                    USession::unsetSessionElement('subscription');
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