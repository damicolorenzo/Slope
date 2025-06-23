<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm($error) {
        $this->smarty->assign('error', $error);
        $this->smarty->display('admin-login.tpl');
    }

    public function loginSessionError() {
        $this->smarty->display('admin-login.tpl');
    }

    public function loginPasswordError() {
        $this->smarty->display('admin-login.tpl');
    }

    public function dashboard($map, $etichettePie, $valoriPie) {
        $this->smarty->assign('map', $map);
        $this->smarty->assign('etichettePie', $etichettePie);
        $this->smarty->assign('valoriPie', $valoriPie);
        $this->smarty->display('admin-dashboard.tpl');
    }

    /* public function manageInterface() {
        $this->smarty->display('admin-manageInterface.tpl');
    } */

    public function confirmSkiRun() {
        
    }

    public function confirmSkiFacility() {
    
    }

    /* public function addPrice($object) {
        $this->smarty->assign('object', $object);
        $this->smarty->display('admin-addPrice.tpl');
    } */

    /* public function prices($nPrices, $prices, $allSFNames) {
        $this->smarty->assign('nPrices', $nPrices);
        $this->smarty->assign('prices', $prices);
        $this->smarty->assign('skiFacilityNames', $allSFNames);
        $this->smarty->display('admin-modifyPrices.tpl');
    }

    public function searchPrices($prices) {
        $this->smarty->assign('prices', $prices);
        $this->smarty->display('admin-searchPrice.tpl');
    }

    public function modifyPrice($idPrice, $description, $full, $reduced, $nameSkiFacility, $idSkiFacility, $allSFNames) {
        $this->smarty->assign('idPrice', $idPrice);
        $this->smarty->assign('description', $description);
        $this->smarty->assign('full', $full);
        $this->smarty->assign('reduced', $reduced);
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);  
        $this->smarty->assign('skiFacilityNames', $allSFNames);
        $this->smarty->assign('exist', false);
        $this->smarty->display('admin-modifyPrice.tpl');
    }

    public function priceAlreadyExist() {
        $this->smarty->assign('exist', true);
        $this->smarty->display('admin-modifyPrice.tpl');
    } */

}

?>