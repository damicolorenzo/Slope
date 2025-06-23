<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CManageBooking {

    /**
     * Method to retrive details of a ski facility
     * @return void
     */
    public static function skiFacilityDetails() : void{
        if(CUser::isLogged()){
            $view = new VManageBooking();
            if(UHTTPMethods::allPost() == []) {
                header('Location: /Slope/User/');
            } else {
                $nameSkiFacility = UHTTPMethods::post('nameSkiFacility');
                $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($nameSkiFacility);
                $skiRuns = FPersistentManager::getInstance()->retriveAllSkiRun($idSkiFacility[0]);
                $liftStructures = FPersistentManager::getInstance()->retriveAllLiftStructures($idSkiFacility[0]);
                $view->showDetails($idSkiFacility[0], $nameSkiFacility, $skiRuns, $liftStructures);
            }
        } else {
            CUser::home();
        }
    }

    public static function makeABookingPage() {
        if(CUser::isLogged()){
            $view = new VManageBooking();
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");
            $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
            $mapSkipassTemp = [];
            foreach ($skipassObjs as $element) {
                $id = $element->getIdSkipassTemp();
                $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
            }
            $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, false);
        } else {
            CUser::home();
        }
    }

    public static function verifyaDate($selectedDate) {
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
    }

    public static function warningToday($selectedDate, $idSkiFacility) {
        $today = new DateTime();
        if($selectedDate == $today) {
            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
            $status = $skiFacility[0]->getStatus();
            //0 è true per il php ma è chiuso per il database
            //se $status è 0 ovvero chiuso warningToday ritorna true
            //se $status è 1 ovvero aperto warningToday ritorna false
            return $status;
        } else {
            return false;
        }
    }

    public static function verifySubscription($selectedDate, $userId) {
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
    }

    //DA MODIFICARE in base ai prezzi e ai pagamenti
    public static function confirmBooking() {
        if(CUser::isLogged()) {
            //controllare se la data scelta per la prenotazione appartiene alla finestra delle stagioni (verifyDate)
            //se la data scelta è oggi bisogna avvisare l'utente nel caso l'impianto scelto sia chiuso 
            //controllare se la copertura dell'abbonamento copre la data scelta e applicare lo sconto

            $view = new VManageBooking();  
            $userId = USession::getInstance()->getSessionElement('user');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            $today = date("Y-m-d");  
            $selectedDate = UHTTPMethods::post('date');
            
            if(!self::verifyaDate($selectedDate) || self::warningToday($selectedDate, $idSkiFacility)) {
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                $mapSkipassTemp = [];
                foreach ($skipassObjs as $element) {
                    $id = $element->getIdSkipassTemp();
                    $skipassTemps = FPersistentManager::getInstance()->retriveSkipassTempOnId($id);
                    $mapSkipassTemp[] =  [$skipassTemps[0]->getPeriod(), $skipassTemps[0]->getType()];
                }
                $view->makeABookingForm($idSkiFacility, $user[0], $today, $mapSkipassTemp, true);
            } else {
                $name = UHTTPMethods::post('name');
                $surname = UHTTPMethods::post('surname');
                $email = UHTTPMethods::post('email');
                $period = UHTTPMethods::post('period');
                $type = UHTTPMethods::post('type');
                $skipassObjs = FPersistentManager::getInstance()->retriveSkipassObjOnSkiFacility($idSkiFacility);
                foreach ($skipassObjs as $element) {
                    $skipassTemp = FPersistentManager::getInstance()->retriveSkipassTempOnId($element->getIdSkipassTemp());
                    if($skipassTemp[0]->getType() == UHTTPMethods::post('type') && $skipassTemp[0]->getPeriod() == UHTTPMethods::post('period')) {
                        $value = $element->getValue();
                        $idSkipassObj = $element->getIdSkipassObj();
                    }
                }
                $skipassBooking = new ESkipassBooking($name, $surname, $selectedDate, $type, $email, $period, $value);
                $skipassBooking->setIdUser($userId);
                $skipassBooking->setIdSkipassObj($idSkipassObj);
                $cart[] = $skipassBooking;
                $totalPrice = $skipassBooking->getValue(); 
                $subscriptionV = FPersistentManager::getInstance()->verifySubscriptionFromUserId($userId);
                if($subscriptionV && self::verifySubscription($selectedDate, $userId)) {
                    $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
                    $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId($subscription[0]->getIdSubscriptionTemp());
                    $discount = $subscriptionTemp[0]->getDiscount();
                    $totalPrice = $totalPrice - (($totalPrice * $discount)/100);
                    $cart[] = $subscriptionTemp[0];
                }
                if(UHTTPMethods::post('insurance') == 'on') {
                    $insuranceTemp = FPersistentManager::getInstance()->retriveInsuranceTempFromType($type);  
                    $price = $insuranceTemp[0]->getValue();
                    if($period > 1)
                        $price = $price * $period;
                    $insurance = new EInsurance($name, $surname, $email, $type, $period, $price, $selectedDate);
                    $insurance->setIdUser($userId);
                    $totalPrice = $totalPrice + $price;
                    $cart[] = $insurance;
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
            /* if(FPersistentManager::getInstance()->verifyBooking()) {
                
            } else {
                $view->bokkingError();
            } */
        } else {
            CUser::home();
        }
    }

    public static function payment() {
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
                $skipassBooking = $cart[0];
                $today = new DateTime();
                $price = $skipassBooking->getValue();
                if($cart[1] instanceof ESubscriptionTemp) {
                    $subscription = $cart[1];
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

                if($cart[2] != null && $cart[2] instanceof EInsurance) {
                    $insurance = $cart[2];
                    $payment = new EPayment(get_class($insurance), $insurance->getPrice(), $today->format('Y-m-d'));
                    FPersistentManager::getInstance()->uploadObj($insurance);
                    $insurance = FPersistentManager::getInstance()->retriveInsurance($insurance);
                    $payment->setIdExternalObj($insurance[0]->getIdInsurance());
                    $payment->setIdCreditCard($retrivedCreditCard[0]->getIdCreditCard());
                    FPersistentManager::getInstance()->uploadObj($payment);
                }
                
                USession::getInstance()->unsetSessionElement('cart');
            } 
            CUser::home();
        } else {
            CUser::home();
        }
    }

    public static function showBookings() {
        if(CUser::isLogged()){ 
            $bookedArray = [];
            $view = new VManageBooking();  
            $userId = USession::getInstance()->getSessionElement('user');
            $allBookings = FPersistentManager::getInstance()->retriveAllSkipassBooking($userId);
           
            $bookings = [];
            if($allBookings instanceof ESkipassBooking) {
                $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($allBookings->getIdSkipassObj());
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                $idUser = $allBookings->getIdUser();
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserAndDate($idUser, $allBookings->getStartDate());
                $bookings[]['bookings'] = [$allBookings, $skiFacility[0], $insurance[0]]; 
                $bookedArray[] = $allBookings->getStartDate();
            } elseif (count($allBookings) > 0) {
                foreach ($allBookings as $element) {
                    $bookedArray[] = $element->getStartDate();
                    $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($element->getIdSkipassObj());
                    $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                    $idUser = $element->getIdUser();
                    $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUserAndDate($idUser, $element->getStartDate());
                    if(count($insurance) > 0)
                    $bookings[]['bookings'] = [$element, $skiFacility[0], $insurance[0]]; 
                    else   
                    $bookings[]['bookings'] = [$element, $skiFacility[0], $insurance]; 
                }
            }
            
            $month = isset($_POST['month']) ? $_POST['month'] : date('m');
            $year = isset($_POST['year']) ? $_POST['year'] : date('Y');

            // Converto a interi
            $month = (int)$month;
            $year = (int)$year;

            // Mese precedente
            $prevMonth = $month - 1;
            $prevYear = $year;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }

            // Mese successivo
            $nextMonth = $month + 1;
            $nextYear = $year;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }

            // Genera calendario
            $firstDay = mktime(0, 0, 0, $month, 1, $year);
            $daysInMonth = date('t', $firstDay);

            // Inizia da lunedì: trasformiamo il valore di date('w')
            $startDay = date('w', $firstDay); // 0 = Sunday, ..., 6 = Saturday
            $startDay = ($startDay == 0) ? 6 : $startDay - 1; // Ora 0 = Monday, ..., 6 = Sunday

            $monthName = date('F', $firstDay);

            // Calcola i giorni del mese precedente
            $daysInPrevMonth = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));

            $calendar = [];
            $week = array_fill(0, 7, '');

            // Aggiungi i giorni del mese precedente (es. 28, 29, 30...)
            for ($i = $startDay - 1; $i >= 0; $i--) {
                $week[$i] = $daysInPrevMonth - ($startDay - 1 - $i);
            }

            // Aggiungi i giorni del mese corrente
            $day = 1;
            for ($i = $startDay; $day <= $daysInMonth; $i++) {
                $week[$i % 7] = $day++;

                // Quando raggiungi domenica (indice 6), aggiungi la settimana e ricomincia
                if ($i % 7 == 6 || $day > $daysInMonth) {
                    $calendar[] = $week;
                    $week = array_fill(0, 7, '');
                }
            }

            $highlightDays = [];
            $idForDate = [];
            
            foreach ($bookedArray as $dateStr) {
                $timestamp = strtotime($dateStr);
                $inputYear = (int)date('Y', $timestamp);
                $inputMonth = (int)date('m', $timestamp);
                $inputDay = (int)date('d', $timestamp);

                // Se è nel mese/anno visualizzato, aggiungi il giorno da evidenziare
                if ($inputYear === $year && $inputMonth === $month) {
                    $highlightDays[] = $inputDay;
                    $idForDate[$inputDay] = [];
                    foreach ($bookings as $i) {
                        $booking = $i['bookings'][0];
                        $bookingYear = substr($booking->getStartDate(), 0, 4);
                        $bookingMonth = substr($booking->getStartDate(), 5, 2);
                        $bookingDay = substr($booking->getStartDate(), 8, 2);
                        if($inputDay == $bookingDay && $inputMonth == $bookingMonth && $inputYear == $bookingYear) {
                            $skipassObj = FPersistentManager::getInstance()->retriveSkipassObjOnId($booking->getIdSkipassObj());
                            $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($skipassObj[0]->getIdSkiFacility());
                            $idForDate[$inputDay] = [$booking->getIdSkipassBooking(), $skiFacility[0]->getName()];
                        }
                        
                    }
                }
            }
            $today = new DateTime();
            $oldBookings = [];
            $futureBookings = [];
            foreach ($bookings as $element) {
                if(new DateTime($element['bookings'][0]->getStartDate()) >= $today)
                    $futureBookings[] = $element;
                else
                    $oldBookings[] = $element;
            }
        //print_r($highlightDays);
        $view->showBookings($futureBookings, $monthName, $year, $calendar, $prevMonth, $prevYear, $nextMonth, $nextYear, $highlightDays, $idForDate, $oldBookings);
        } else {
            CUser::home();
        }
    }

    public static function modifySkipassBooking() {
        if(CUser::isLogged()) {
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
    }

    public static function confirmModifyBooking() : void{
        if(CUser::isLogged()){
            $view = new VManageBooking();
            $userId = USession::getInstance()->getSessionElement('user');
            if(self::verifyaDate(UHTTPMethods::post('date'))) {
                $skipassBooking = USession::getSessionElement('skipassBooking');
                //bisogna modificare questo oggetto sul db
                $newSkipassBooking = new ESkipassBooking($skipassBooking[0]->getName(), $skipassBooking[0]->getSurname(), UHTTPMethods::post('date'), $skipassBooking[0]->getType(), $skipassBooking[0]->getEmail(), $skipassBooking[0]->getPeriod(), $skipassBooking[0]->getValue());
                $newSkipassBooking->setIdSkipassBooking($skipassBooking[0]->getIdSkipassBooking());
                $newSkipassBooking->setIdSkipassObj($skipassBooking[0]->getIdSkipassObj());
                $newSkipassBooking->setIdUser($skipassBooking[0]->getIdUser());
                FPersistentManager::getInstance()->updateSkipassBookingInfo($newSkipassBooking);
                
                $insurance = FPersistentManager::getInstance()->retriveInsuranceFromIdUSerAndDate($userId, $skipassBooking[0]->getStartDate());
                if(count($insurance) > 0) {
                    $newInsurance = new EInsurance($insurance[0]->getName(), $insurance[0]->getSurname(), $insurance[0]->getEmail(), $insurance[0]->getType(), $insurance[0]->getPeriod(), $insurance[0]->getPrice(), UHTTPMethods::post('date'));
                    $newInsurance->setIdInsurance($insurance[0]->getIdInsurance());
                    $newInsurance->setIdUser($skipassBooking[0]->getIdUser());
                    FPersistentManager::getInstance()->updateInsuranceInfo($newInsurance);
                }
                USession::getInstance()->unsetSessionElement('skipassBooking');
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
    }

    public static function deleteSkipassBooking() {
        if(CUser::isLogged()) {
            FPersistentManager::getInstance()->deleteSkipassBooking(UHTTPMethods::post('idSkipassBooking'));
            CUser::home();
        } else {
            CUser::home();
        }
    }  

    public static function confirmDeleteSkipassBooking () {
        
    }




}

?>