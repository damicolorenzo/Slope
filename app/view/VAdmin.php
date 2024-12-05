<?php

require_once (__DIR__."\\..\\foundation\\utility\\StartSmarty.php");

class VAdmin {
    
    private $smarty;

    public function __construct() {
        $this->smarty = StartSmarty::configuration();
    }

    public function showLoginForm() {
        $this->smarty->assign('session', false);
        $this->smarty->assign('password', false);
        $this->smarty->display('admin-login.tpl');
    }

    public function loginSessionError() {
        $this->smarty->assign('session', true);
        $this->smarty->assign('password', false);
        $this->smarty->display('admin-login.tpl');
    }

    public function loginPasswordError() {
        $this->smarty->assign('session', false);
        $this->smarty->assign('password', true);
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

    public function modifySkiFacility($id, $name, $status, $price) {
        $this->smarty->assign('name', $name);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('price', $price);
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

    public function prices($prices) {
        $this->smarty->assign('prices', $prices);
        $this->smarty->display('admin-modifyPrices.tpl');
    }



    
}

?>