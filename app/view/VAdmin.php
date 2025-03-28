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

    public function dashboard() {
        $this->smarty->display('admin-dashboard.tpl');
    }

    public function searchUsers($users) {
        $this->smarty->assign('users', $users);
        $this->smarty->display('admin-searchUser.tpl');
    }

    public function searchStructure($result) {
        $this->smarty->assign('objects', $result);
        $this->smarty->display('admin-searchStructure.tpl');
    }

    public function modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError, $dateError) {
        $this->smarty->assign('username', $username);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('surname', $surname);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('phoneNumber', $phoneNumber);
        $this->smarty->assign('birthDate', $birthDate);
        $this->smarty->assign('phoneError', $phoneError);
        $this->smarty->assign('dateError', $dateError);
        $this->smarty->display('admin-modifyProfile.tpl');
    }

    public function addSkiRun($skiFacilities) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', false);
        $this->smarty->display("admin-addSkiRun.tpl");
    }

    public function skiRunAlreadyExist() {
        $this->smarty->assign('exist', true);
        $this->smarty->display('admin-addSkiRun.tpl');
    }

    public function confirmSkiRun() {
        
    }

    public function addSkiFacility() {
        $this->smarty->display("admin-addSkiFacility.tpl");
    }

    public function confirmSkiFacility() {
    
    }

    public function addLiftStructure($skiFacilities) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('exist', false);
        $this->smarty->display("admin-addLiftStructure.tpl");
    }

    public function liftStructureAlreadyExist() {
        $this->smarty->assign('exist', true);
        $this->smarty->display('admin-addLiftStructure.tpl');
    }

    public function modifySkiFacility($id, $name, $status, $description) {
        $this->smarty->assign('name', $name);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('description', $description);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('exist', false);
        $this->smarty->display('admin-modifySkiFacility.tpl');
    }

    public function skiFacilityAlreadyExist() {
        $this->smarty->assign('exist', true);
        $this->smarty->display('admin-modifySkiFacility.tpl');
    }

    public function modifySkiRun($idSkiRun, $name, $type, $status, $nameSkiFacility, $idSkiFacility) {
        $this->smarty->assign('idSkiRun', $idSkiRun);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);       
        $this->smarty->assign('idSkiFacility', $idSkiFacility);       
        $this->smarty->display('admin-modifySkiRun.tpl');
    }

    public function modifyLiftStructure($idLiftStructure, $name, $type, $status, $seats, $nameSkiFacility, $idSkiFacility) {
        $this->smarty->assign('idLiftStructure', $idLiftStructure);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('seats', $seats);
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);
        $this->smarty->assign('idSkiFacility', $idSkiFacility);  
        $this->smarty->display('admin-modifyLiftStructure.tpl');
    }

    public function addSkipassTemplate() {
        $this->smarty->display('admin-addSkipassTemplate.tpl');
    }

    public function addInsuranceTemplate() {
        $this->smarty->display('admin-addInsuranceTemplate.tpl');
    }

    public function addPrice($object) {
        $this->smarty->assign('object', $object);
        $this->smarty->display('admin-addPrice.tpl');
    }

    public function prices($nPrices, $prices, $allSFNames) {
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
    }

    public function addSkipass() {
        $this->smarty->display('admin-addSkipass.tpl');
    }

    public function searchSkipassObjs($skipassObjs) {
        $this->smarty->assign('skipassObjs', $skipassObjs);
        $this->smarty->display('admin-searchSkipass.tpl');
    }

    public function modifySkipassObj($idSkipassObj, $description, $period, $type) {
        $this->smarty->assign('idSkipassObj', $idSkipassObj);
        $this->smarty->assign('description', $description);
        $this->smarty->assign('period', $period);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('exist', false);
        $this->smarty->display('admin-modifySkipass.tpl');
    }       

    
}

?>