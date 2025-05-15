<?php

/*
richiede il file nella posizione __DIR__ [ovvero posizione di questo specifico file (VUser.php)] concatenata con 
"\\..\\foundation\\utility\\StartSmarty.php" per arrivare alla posizione finale partendo da __DIR__.
Nella cartella foundation è presente una cartella utility che permette di gestire tra le varie cose anche 
il caricamento delle pagine tramite Smarty.
Nel file StartSmarty.php sono specificate le posizioni delle 4 cartelle di funzionamento di Smarty
posizionate nella cartella libs (leggere il codice di StartSmarty \foundation\utility\StartSmarty.php) 
*/ 
require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VUser {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    /*
    Nella fase iniziale l'unica funzione che ci interessa è home che permette di mostrare la pagina descritta tramite il 
    template home.tpl 
    [Piccola specifica per home.tpl]
    Questo file è molto simile ad un file .html ma contiene dei tag particolari che permettono di passare parametri aggiuntivi
    e quindi tramite dei costrutti condizionale come if o cicli come for permettono di rendere la pagina più dinamica 
    Esempio 
    passando un parametro $nomeUtente possiamo visualizzare il nome dell'utente nella pagina web in modo tale che ogni volta che 
    un utente fa il login possa poi riconoscere il suo nome sullo schermo (nome diverso per ogni utente altrimenti si chiamano tutti
    user)
    Di fatto nella pagina html non c'è un modo per passare dei dati se non tramite file php quindi il file .tpl è una versione intelligente
    del file html 
    */
    public function home($allSkiFacilities, $skipassObj, $images){
        $this->smarty->assign('skiFacilities', $allSkiFacilities);
        $this->smarty->assign('skipassObj', $skipassObj);
        for($i = 1; $i <= count($images); $i++) {
            $this->smarty->assign('image'.$i, $images[$i-1]);
        }
        $this->smarty->display('home-copy.tpl'); 
    }

    public function showLoginForm($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

    public function showRegistrationForm() {
        $this->smarty->assign('exist', false);
        $this->smarty->assign('phoneError', false);
        $this->smarty->assign('dateError', false);
        $this->smarty->assign('passwordError', false);
        $this->smarty->assign('name', "");
        $this->smarty->assign('surname', "");
        $this->smarty->assign('email', "");
        $this->smarty->assign('username', "");
        $this->smarty->assign('phoneNumber', "");
        $this->smarty->assign('birthDate', "");
        $this->smarty->display('registration.tpl');
    }

    public function userAlreadyExist() {
        $this->smarty->assign('exist', true);
        $this->smarty->display('registration.tpl');
    }

    public function someError($phone, $date, $pass, $post) {
        $this->smarty->assign('exist', false);
        $this->smarty->assign('phoneError', $phone);
        $this->smarty->assign('dateError', $date);
        $this->smarty->assign('passwordError', $pass);
        $this->smarty->assign('name', $post['name']);
        $this->smarty->assign('surname', $post['surname']);
        $this->smarty->assign('email', $post['email']);
        $this->smarty->assign('username', $post['username']);
        $this->smarty->assign('phoneNumber', $post['phoneNumber']);
        $this->smarty->assign('birthDate', $post['birthDate']);
        $this->smarty->display('registration.tpl');
    }

    public function profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $insuranceImage, $subscriptionImage, $insurance) {
        $this->smarty->assign('username', $username);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('surname', $surname);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('phoneNumber', $phoneNumber);
        $this->smarty->assign('birthDate', $birthDate);
        $this->smarty->assign('image', $image);
        $this->smarty->assign('insuranceImage', $insuranceImage);
        $this->smarty->assign('subscriptionImage', $subscriptionImage);
        $this->smarty->assign('insurance', $insurance);
        $this->smarty->display('profileInfo.tpl');
    }

    public function loggedHome($map) {
        $this->smarty->assign('map', $map);
        $this->smarty->display('loggedHome.tpl');
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

    public function showDetails($idSkiFacility, $nameSkiFacility, $skiRuns, $liftStructures) {
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);
        $this->smarty->assign('skiRuns', $skiRuns);
        $this->smarty->assign('liftStructures', $liftStructures);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);
        $this->smarty->display('skiRunsAndLiftsDetails.tpl');
    }

    public function makeABookingForm($idSkiFacility, $user, $today, $map, $dateWarning) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);
        $this->smarty->assign('map', $map);
        $this->smarty->display('makeABookingForm.tpl');
    }

    public function paymentSection($cart, $totalPrice, $creditCard) {
        $this->smarty->assign('totalPrice', $totalPrice);
        $this->smarty->assign('creditCard', $creditCard);
        $this->smarty->assign('cart', $cart);
        $this->smarty->display('paymentSection.tpl');
    }

    public function showBookings($allBookings, $monthName, $year, $calendar, $prevMonth, $prevYear, $nextMonth, $nextYear, $bookedArray) {
        $this->smarty->assign('bookings', $allBookings);
        $this->smarty->assign('monthName', $monthName);
        $this->smarty->assign('year', $year);
        $this->smarty->assign('calendar', $calendar);
        $this->smarty->assign('prevMonth', $prevMonth);
        $this->smarty->assign('prevYear', $prevYear);
        $this->smarty->assign('nextMonth', $nextMonth);
        $this->smarty->assign('nextYear', $nextYear);
        $this->smarty->assign('bookedDates', $bookedArray);
        $this->smarty->display('showBookings.tpl');
    }

    public function blankPage() {
        $this->smarty->display('blankPage.tpl');
    }

    public function modifySkipassBooking($skipassBooking, $today, $dateWarning, $insurance) {
        $this->smarty->assign('skipassBooking', $skipassBooking);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->assign('insurance', $insurance);
        $this->smarty->display('modifySkipassBooking.tpl');
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

    public function makeASubscriptionForm($user, $today, $dateWarning) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->display('makeASubscriptionForm.tpl');
    }

    public function confirmPage() {
        $this->smarty->display('confirmPage.tpl');
    }

}

?>