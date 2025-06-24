<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VManageBooking {

    private $smarty;

    public function __construct() {
        //viene configurato Smarty tramite la chiamata alla funzione configuration dichiarata nel file StartSmary.php
        $this->smarty = StartSmarty::configuration();
    }

    public function showDetails($idSkiFacility, $nameSkiFacility, $skiRuns, $liftStructures) {
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);
        $this->smarty->assign('skiRuns', $skiRuns);
        $this->smarty->assign('liftStructures', $liftStructures);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);
        $this->smarty->display('skiRunsAndLiftsDetails.tpl');
    }

    public function makeABookingForm($idSkiFacility, $user, $today, $map, $dateWarning, $status) {
        $this->smarty->assign('user', $user);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('map', $map);
        $this->smarty->display('makeABookingForm.tpl');
    }

    public function paymentSection($cart, $totalPrice, $creditCard, $today) {
        $this->smarty->assign('totalPrice', $totalPrice);
        $this->smarty->assign('creditCard', $creditCard);
        $this->smarty->assign('cart', $cart);
        $this->smarty->assign('today', $today);
        $this->smarty->display('paymentSection.tpl');
    }

    public function modifySkipassBooking($skipassBooking, $today, $dateWarning, $insurance) {
        $this->smarty->assign('skipassBooking', $skipassBooking);
        $this->smarty->assign('today', $today);
        $this->smarty->assign('dateWarning', $dateWarning);
        $this->smarty->assign('insurance', $insurance);
        $this->smarty->display('modifySkipassBooking.tpl');
    }

    public function showBookings($allBookings, $monthName, $year, $calendar, $prevMonth, $prevYear, $nextMonth, $nextYear, $bookedArray, $idForDate, $oAFB) {
        $this->smarty->assign('bookings', $allBookings);
        $this->smarty->assign('monthName', $monthName);
        $this->smarty->assign('year', $year);
        $this->smarty->assign('calendar', $calendar);
        $this->smarty->assign('prevMonth', $prevMonth);
        $this->smarty->assign('prevYear', $prevYear);
        $this->smarty->assign('nextMonth', $nextMonth);
        $this->smarty->assign('nextYear', $nextYear);
        $this->smarty->assign('bookedDates', $bookedArray);
        $this->smarty->assign('idForDate', $idForDate);
        $this->smarty->assign('oldBookings', $oAFB);
        $this->smarty->display('showBookings.tpl');
    }

}

?>