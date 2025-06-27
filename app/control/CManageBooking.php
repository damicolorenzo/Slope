<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CManageBooking {

    /**
     * Method to retrive details of a ski facility
     * @return void
     */
    public static function skiFacilityDetails($nameSkiFacility = null) : void{
        if(CUser::isLogged()){
            $view = new VManageBooking();
            if(!is_null($nameSkiFacility)) {
                $nameSkiFacility = htmlspecialchars(urldecode($nameSkiFacility), ENT_QUOTES, 'UTF-8');
                $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
                $cond = false;
                foreach ($allSkiFacilities as $obj) {
                    if($obj->getName() == $nameSkiFacility)
                        $cond = true;
                }
                if($cond) {
                    $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($nameSkiFacility);
                    $skiRuns = FPersistentManager::getInstance()->retriveAllSkiRun($idSkiFacility[0]);
                    $liftStructures = FPersistentManager::getInstance()->retriveAllLiftStructures($idSkiFacility[0]);
                    $view->showDetails($idSkiFacility[0], $nameSkiFacility, $skiRuns, $liftStructures);
                } else {
                    CUser::home();
                }
            } else {
                CUser::home();
            }
        }
    }

    /**
     * Method to generate the booking form page for a given ski facility, 
     * if a valid facility ID is provided and the user is logged in.
     * The form includes available skipass types and their respective periods.
     * If the facility ID is invalid or missing, the user is redirected to the home page.
     * 
     * @param int|null $idSkiFacility The optional ID of the ski facility to book
     * @return void
     */
    public static function makeABookingPage($idSkiFacility = null) : void{
        if(CUser::isLogged()){
            if(!is_null($idSkiFacility)) {
                $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
                $cond = false;
                foreach ($allSkiFacilities as $obj) {
                    if($obj->getIdSkiFacility() == $idSkiFacility)
                        $cond = true;
                }
                if($cond) {
                    $view = new VManageBooking();
                    $userId = USession::getInstance()->getSessionElement('user');
                    $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                    $today = date("Y-m-d");
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                    $status = $skiFacility[0]->getStatus();
                    $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                    $mapSkipassTemp = [];
                    foreach ($skipassObjs as $element) {
                        $id = $element->getIdSkipassTemp();
                        $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                        $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
                    }
                    $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, false, $status, false);
                } else {
                    CUser::home();
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to check if a given date is within the current ski season (Oct-Mar).
     * @param string|null $selectedDate
     * @return bool|null
     */
    public static function verifyDate($selectedDate = null) {
        if(!is_null($selectedDate)) {
            $selectedDate = new DateTime($selectedDate);
            $today = new DateTime();
            $currentYear = (int)$today->format('Y');
            $currentMonth = (int)$today->format('m');
        
            if($currentMonth >= 1 && $currentMonth <=3) {
                // Calcola i due range accettabili:
                // 1. Stagione invernale attuale (ottobre anno corrente -> marzo anno successivo)
                $startCurrentSeason = new DateTime(($currentYear - 1). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear) . "-03-31");
            
                if (($selectedDate >= $startCurrentSeason && $selectedDate <= $endCurrentSeason)) {
                    return true;
                } else 
                    return false;
            } elseif($currentMonth >= 4 && $currentMonth <= 12) {
                $startCurrentSeason = new DateTime(($currentYear). "-10-01");
                $endCurrentSeason = new DateTime(($currentYear + 1) . "-03-31");
            
                if (($selectedDate >= $startCurrentSeason && $selectedDate <= $endCurrentSeason)) {
                    return true;
                } else 
                    return false;
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to check if the ski facility is closed today.
     * @param string|null $selectedDate
     * @param int|null $idSkiFacility
     * @return bool|null
     */
    public static function warningToday($selectedDate = null, $idSkiFacility = null) {
        if(!is_null($selectedDate) && !is_null($idSkiFacility)) {
            $today = new DateTime();
            if($selectedDate == $today) {
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $status = $skiFacility[0]->getStatus();
                return $status;
            } else {
                return false;
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify if a user's subscription is valid on a given date.
     * @param string|null $selectedDate
     * @param int|null $userId
     * @return bool|null
     */
    public static function verifySubscription($selectedDate = null, $userId = null) {
        if(!is_null($selectedDate) && !is_null($userId)) {
            $subscriptionV = FPersistentManager::getInstance()->verifySubscriptionFromUserId($userId);
            if($subscriptionV) {
                $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
                $startSubscription = $subscription[0]->getStartDate();
                $endSubscription = $subscription[0]->getEndDate();
                if($selectedDate >= $startSubscription && $selectedDate <= $endSubscription)
                    return true;
                else    
                    return false;
            } else 
                return false;
        } else {
            CUser::home();
        }
        
    }

    /**
     * Method to confirm a booking by validating input data, checking date and subscription,
     * applying discounts, and preparing the payment section.
     * @return void
     */
    public static function confirmBooking() : void{
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkiFacility')) && !is_null(UHTTPMethods::post('date')) &&
            !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname')) && !is_null(UHTTPMethods::post('email')) &&
            !is_null(UHTTPMethods::post('period'))) {
                list($period, $type) = explode('|', UHTTPMethods::post('period'));
                $verifyBooking = FPersistentManager::getInstance()->verifySkipassBooking(USession::getInstance()->getSessionElement('user'), UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('email'), $period, $type, UHTTPMethods::post('date'), UHTTPMethods::post('idSkiFacility'));
                if(!$verifyBooking) {
                    $view = new VManageBooking();  
                    $userId = USession::getInstance()->getSessionElement('user');
                    $idSkiFacility = UHTTPMethods::post('idSkiFacility');
                    $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                    $today = date("Y-m-d");  
                    $selectedDate = UHTTPMethods::post('date');
                    if(!self::verifyDate($selectedDate) || self::warningToday($selectedDate, $idSkiFacility)) {
                        $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                        $mapSkipassTemp = [];
                        foreach ($skipassObjs as $element) {
                            $id = $element->getIdSkipassTemp();
                            $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                            $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
                        }
                        $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, true, true, false);
                    } else {
                        $name = UHTTPMethods::post('name');
                        $surname = UHTTPMethods::post('surname');
                        $email = UHTTPMethods::post('email');
                        list($period, $type) = explode('|', UHTTPMethods::post('period'));
                        $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                        foreach ($skipassObjs as $element) {
                            $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($element->getIdSkipassTemp());
                            if($skipassTemp[0]->getType() == $type && $skipassTemp[0]->getPeriod() == $period) {
                                $value = $element->getValue();
                                $idSkipassObj = $element->getIdSkipassObj();
                                
                            }
                        }
                        $skipassBooking = new ESkipassBooking($name, $surname, $selectedDate, $type, $email, $period, $value);
                        $skipassBooking->setIdUser($userId);
                        $skipassBooking->setIdSkipassObj($idSkipassObj);
                        $cart['skipassBooking'] = $skipassBooking;
                        $totalPrice = $skipassBooking->getValue(); 
                        $subscriptionV = FPersistentManager::getInstance()->verifySubscriptionFromUserId($userId);
                        if($subscriptionV && self::verifySubscription($selectedDate, $userId)) {
                            $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
                            $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId($subscription[0]->getIdSubscriptionTemp());
                            $discount = $subscriptionTemp[0]->getDiscount();
                            $totalPrice = $totalPrice - (($totalPrice * $discount)/100);
                            $cart['subscription'] = $subscriptionTemp[0];
                        }
                        if(UHTTPMethods::post('insurance') == 'on') {
                            $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
                            $price = $insuranceTemp[0]->getValue();
                            if($period > 1)
                                $price = $price * $period;
                            $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
                            $insurance->setIdUser($userId);
                            $totalPrice = $totalPrice + $price;
                            $cart['insurance'] = $insurance;
                        }
                        $verifyPreferredCreditCard = FPersistentManager::getInstance()->verifyPCreditCard($userId);
                        USession::getInstance()->setSessionElement('cart', $cart);
                        if($verifyPreferredCreditCard) {
                            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                            $view->paymentSection($cart, $totalPrice, $creditCard[0], null);
                        } else {
                            $today = date('YYYY-mm');
                            $view->paymentSection($cart, $totalPrice, null, $today);
                        }
                    }
                } else {
                    $view = new VManageBooking();
                    $userId = USession::getInstance()->getSessionElement('user');
                    $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                    $today = date("Y-m-d");
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId(UHTTPMethods::post('idSkiFacility'));
                    $status = $skiFacility[0]->getStatus();
                    $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility(UHTTPMethods::post('idSkiFacility'));
                    $mapSkipassTemp = [];
                    foreach ($skipassObjs as $element) {
                        $id = $element->getIdSkipassTemp();
                        $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                        $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
                    }
                    $view->makeABookingForm(UHTTPMethods::post('idSkiFacility'), $user[0], $today, $mapSkipassTemp, false, $status, true);
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to process payment, update credit card info, save bookings and payments,
     * send confirmation email, and clear the shopping cart.
     * @return void
     */
    public static function payment() :void{
        if(CUser::isLogged()){ 
            if(!is_null(UHTTPMethods::post('cardHolderName')) && !is_null(UHTTPMethods::post('cardHolderSurname')) && !is_null(UHTTPMethods::post('expiryDate')) 
            && !is_null(UHTTPMethods::post('cardNumber')) && !is_null(UHTTPMethods::post('cvv'))) {
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
                        $newCreditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                        $newCreditCard->setIdCreditCard($creditCard[0]->getIdCreditCard());
                        if(UHTTPMethods::post('preferred') == 'on') 
                            $newCreditCard->setIdUser($userId);
                        else 
                            $newCreditCard->setIdUser(0);
                        FPersistentManager::getInstance()->updateCreditCard($newCreditCard);
                        $creditCard = $newCreditCard;
                    } else {
                        $creditCard = $creditCard[0];
                    } 
                } else { 
                    $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                    if(UHTTPMethods::post('preferred') == 'on')
                        $creditCard->setIdUser($userId);
                    else 
                        $creditCard->setIdUser(0);
                    FPersistentManager::getInstance()->uploadObj($creditCard);
                }
                if(USession::getInstance()->isSetSessionElement('cart')) {
                    $cart = USession::getInstance()->getSessionElement('cart');
                    $skipassBooking = $cart['skipassBooking'];
                    $today = new DateTime();
                    $price = $skipassBooking->getValue();
                    if(isset($cart['subscription']) && $cart['subscription'] instanceof ESubscriptionTemp) {
                        $subscription = $cart['subscription'];
                        $discount = $subscription->getDiscount();
                        $price = $price - (($price * $discount)/100);
                    }
                    $payment = new EPayment(get_class($skipassBooking), $price, $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($skipassBooking);
                    $retrivedSkipassBooking = FPersistentManager::getInstance()->retriveSkipassBooking($skipassBooking);
                    $idSkipassBooking = $retrivedSkipassBooking[0]->getIdSkipassBooking();
                    $retrivedCreditCard = FPersistentManager::getInstance()->retriveCreditCard($creditCard);
                    $idCreditCard = $retrivedCreditCard[0]->getIdCreditCard();
                    $creditCard->setIdCreditCard($idCreditCard);
                    $payment->setIdExternalObj($idSkipassBooking);
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment); 
                    if(isset($cart['insurance']) && $cart['insurance'] instanceof EInsurance) {
                        $insurance = $cart['insurance'];
                        $insurance->setIdSkipassBooking($idSkipassBooking);
                        $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
                        FPersistentManager::getInstance()->uploadObj($insurance);
                        $retrivedInsurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
                        $payment->setIdExternalObj($retrivedInsurance[0]->getIdInsurance());
                        $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                        FPersistentManager::getInstance()->uploadObj($payment);
                    }
                    $mailer = UPMail::getInstance();
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($retrivedSkipassBooking[0]->getIdSkipassObj());
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                    $mailer->sendMail($retrivedSkipassBooking[0]->getEmail(), "Prenotazione {$retrivedSkipassBooking[0]->getStartDate()} a {$skiFacility[0]->getName()}", "
                    La informiamo che la sua prenotazione per lo skipass è stata confermata con successo.   
                    Dettagli della prenotazione:
                    • Data di inizio: {$retrivedSkipassBooking[0]->getStartDate()}
                    • Periodo: {$retrivedSkipassBooking[0]->getPeriod()} giorni
                    • Tipo di skipass: {$retrivedSkipassBooking[0]->getType()}
                    • Numero prenotazione: {$retrivedSkipassBooking[0]->getIdSkipassBooking()}
                    La ringraziamo per aver scelto i nostri servizi. Per qualsiasi necessità, non esiti a contattarci.");
                    USession::getInstance()->unsetSessionElement('cart');
                    CUser::home();
                } else {
                    CUser::home();
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to retrieve and display current and past bookings for the logged-in user.
     * @return void
     */
    public static function showBookings() :void{
        if(CUser::isLogged()){ 
            $view = new VManageBooking();  
            $userId = USession::getInstance()->getSessionElement('user');
            $allBookings = FPersistentManager::getInstance()->retriveAllSkipassBooking($userId); 
            $today = new DateTime();
            $bookings = [];
            $oldBookings = [];
            if($allBookings instanceof ESkipassBooking) {
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($allBookings->getIdSkipassObj());
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                $idUser = $allBookings->getIdUser();
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserIdSkipassBookingAndDate($idUser, $allBookings->getIdSkipassBooking(), $allBookings->getStartDate());
                if($allBookings->getStartDate() > $today->format('Y-m-d'))
                    $bookings[] = [$allBookings, $skiFacility[0], $insurance[0]]; 
                else   
                    $oldBookings[] = [$allBookings, $skiFacility[0], $insurance[0]];
            } elseif (count($allBookings) > 0) {
                foreach ($allBookings as $element) {
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($element->getIdSkipassObj());
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                    $idUser = $element->getIdUser();
                    $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserIdSkipassBookingAndDate($idUser, $element->getIdSkipassBooking(), $element->getStartDate());
                    if(count($insurance) > 0) {
                        if($element->getStartDate() > $today->format('Y-m-d')) 
                        $bookings[] = [$element, $skiFacility[0], $insurance[0]]; 
                        else    
                        $oldBookings[] = [$element, $skiFacility[0], $insurance[0]]; 
                    } else {
                        if($element->getStartDate() > $today->format('Y-m-d')) 
                            $bookings[] = [$element, $skiFacility[0], $insurance]; 
                        else
                            $oldBookings[] = [$element, $skiFacility[0], $insurance]; 
                    }
                }
            } 
            $view->showBookings($bookings, $oldBookings);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to load the skipass booking and related insurance for editing by the logged-in user.
     * @return void
     */
    public static function modifySkipassBooking() :void{
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
                $view = new VManageBooking();
                $userId = USession::getInstance()->getSessionElement('user');
                $idSkipassBooking = UHTTPMethods::post('idSkipassBooking');
                $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
                $today = new DateTime();
                if($skipassBooking !== null)
                    USession::getInstance()->setSessionElement('skipassBooking', $skipassBooking);
                $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'), false, $insurance);
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Confirms the modification of a skipass booking if the date is valid.
     * Updates booking and insurance info, sends confirmation email, else reloads edit form.
     * @return void
     */
    public static function confirmModifyBooking() : void{
        if(CUser::isLogged()){
            if(!is_null(UHTTPMethods::post('date')) && !is_null(UHTTPMethods::post('name')) && !is_null(UHTTPMethods::post('surname'))) {
                $view = new VManageBooking();
                $userId = USession::getInstance()->getSessionElement('user');
                if(self::verifyDate(UHTTPMethods::post('date'))) {
                    $skipassBooking = USession::getSessionElement('skipassBooking');
                    //bisogna modificare questo oggetto sul db
                    $newSkipassBooking = new ESkipassBooking(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), UHTTPMethods::post('date'), $skipassBooking[0]->getType(), $skipassBooking[0]->getEmail(), $skipassBooking[0]->getPeriod(), $skipassBooking[0]->getValue());
                    $newSkipassBooking->setIdSkipassBooking($skipassBooking[0]->getIdSkipassBooking());
                    $newSkipassBooking->setIdSkipassObj($skipassBooking[0]->getIdSkipassObj());
                    $newSkipassBooking->setIdUser($skipassBooking[0]->getIdUser());
                    FPersistentManager::getInstance()->updateSkipassBookingInfo($newSkipassBooking);
                    
                    $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerIdSkipassBookingAndDate($userId, $skipassBooking[0]->getIdSkipassBooking(), $skipassBooking[0]->getStartDate());
                    if(count($insurance) > 0) {
                        $newInsurance = new EInsurance(UHTTPMethods::post('name'), UHTTPMethods::post('surname'), $insurance[0]->getEmail(), $insurance[0]->getType(), $insurance[0]->getPeriod(), $insurance[0]->getPrice(), UHTTPMethods::post('date'));
                        $newInsurance->setIdInsurance($insurance[0]->getIdInsurance());
                        $newInsurance->setIdUser($skipassBooking[0]->getIdUser());
                        $newInsurance->setIdUser($skipassBooking[0]->getIdSkipassBooking());
                        FPersistentManager::getInstance()->updateInsuranceInfo($newInsurance);
                    }
                    USession::getInstance()->unsetSessionElement('skipassBooking');
                    $mailer = UPMail::getInstance();
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($newSkipassBooking->getIdSkipassObj());
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                    $mailer->sendMail($newSkipassBooking->getEmail(), "Prenotazione {$newSkipassBooking->getStartDate()} a {$skiFacility[0]->getName()}", "
                    La informiamo che la sua prenotazione per lo skipass è stata MODIFICATA con successo.   
                    Dettagli della prenotazione:
                    • Data di inizio: {$newSkipassBooking->getStartDate()}
                    • Periodo: {$newSkipassBooking->getPeriod()} giorni
                    • Tipo di skipass: {$newSkipassBooking->getType()}
                    • Numero prenotazione: {$newSkipassBooking->getIdSkipassBooking()}
                    La ringraziamo per aver scelto i nostri servizi. Per qualsiasi necessità, non esiti a contattarci.");
                    CUser::home();
                } else {
                    $view = new VManageBooking();
                    $userId = USession::getInstance()->getSessionElement('user');
                    $skipassBooking = USession::getSessionElement('skipassBooking');
                    $idSkipassBooking = $skipassBooking[0]->getIdSkipassBooking();
                    $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId($idSkipassBooking);
                    $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
                    $today = new DateTime();
                    $view->modifySkipassBooking($skipassBooking[0], $today->format('Y-m-d'), false, $insurance);
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Deletes a skipass booking by ID for the logged-in user and sends a confirmation email.
     * Redirects to home if not logged in or ID not provided.
     * @return void
     */
    public static function deleteSkipassBooking() :void{
        if(CUser::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassBooking'))) {
                $skipassBooking = FPersistentManager::getInstance()->retriveSkipassBookingOnId(UHTTPMethods::post('idSkipassBooking'));
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($skipassBooking[0]->getIdSkipassObj());
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                FPersistentManager::getInstance()->deleteSkipassBooking(UHTTPMethods::post('idSkipassBooking'));
                $mailer = UPMail::getInstance();
                $mailer->sendMail($skipassBooking[0]->getEmail(), "Prenotazione {$skipassBooking[0]->getStartDate()} a {$skiFacility[0]->getName()}", "
                    La informiamo che la sua prenotazione per lo skipass è stata ELIMINATA con successo.   
                    Dettagli della prenotazione:
                    • Data di inizio: {$skipassBooking[0]->getStartDate()}
                    • Periodo: {$skipassBooking[0]->getPeriod()} giorni
                    • Tipo di skipass: {$skipassBooking[0]->getType()}
                    • Numero prenotazione: {$skipassBooking[0]->getIdSkipassBooking()}
                    La ringraziamo per aver scelto i nostri servizi. Per qualsiasi necessità, non esiti a contattarci.");
                CUser::home();
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }  
}

?>