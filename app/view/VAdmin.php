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

    public function manageInterface() {
        $this->smarty->display('admin-manageInterface.tpl');
    }

    public function searchUsers($users) {
        $this->smarty->assign('users', $users);
        $this->smarty->display('admin-searchUser.tpl');
    }

    public function searchStructure($result) {
        $this->smarty->assign('objects', $result);
        $this->smarty->display('admin-searchStructure.tpl');
    }

    public function searchSkipassBooking($result) {
        $this->smarty->assign('objects', $result);
        
        $this->smarty->display('admin-searchSkipassBooking.tpl');
    }

    public function modifySkipassBooking($skipassBooking, $today) {
        $this->smarty->assign('skipassBooking', $skipassBooking);
        $this->smarty->assign('today', $today);
        $this->smarty->display('admin-modifySkipassBooking.tpl');
    } 

    public function modifyProfile($userId ,$username, $name, $surname, $email, $phoneNumber, $birthDate, $phoneError, $dateError) {
        $this->smarty->assign('userId', $userId);
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

    public function modifyProfileImage($userId, $imageError, $image) {
        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('imageError', $imageError);
        $this->smarty->assign('image', $image);
        $this->smarty->display('admin-modifyProfileImage.tpl');
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

    public function modifySkiRun($idSkiRun, $name, $type, $status, $nameSkiFacility, $allNameSkiFacility, $idSkiFacility) {
        $this->smarty->assign('idSkiRun', $idSkiRun);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);  
        $this->smarty->assign('skiFacilities', $allNameSkiFacility);     
        $this->smarty->assign('idSkiFacility', $idSkiFacility);       
        $this->smarty->display('admin-modifySkiRun.tpl');
    }

    public function modifyLiftStructure($idLiftStructure, $name, $type, $status, $seats, $nameSkiFacility, $allNameSkiFacility, $idSkiFacility) {
        $this->smarty->assign('idLiftStructure', $idLiftStructure);
        $this->smarty->assign('name', $name);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('seats', $seats);
        $this->smarty->assign('nameSkiFacility', $nameSkiFacility);
         $this->smarty->assign('skiFacilities', $allNameSkiFacility);     
        $this->smarty->assign('idSkiFacility', $idSkiFacility);  
        $this->smarty->display('admin-modifyLiftStructure.tpl');
    }

    public function addSkipassTemplate() {
        $this->smarty->display('admin-addSkipassTemplate.tpl');
    }

    public function addInsuranceTemplate() {
        $this->smarty->display('admin-addInsuranceTemplate.tpl');
    }

    public function addSubscription() {
        $this->smarty->display('admin-addSubscription.tpl');
    }

    public function addSkipassObj($skiFacilities, $templates) {
        $this->smarty->assign('skiFacilities', $skiFacilities);
        $this->smarty->assign('templates', $templates);
        $this->smarty->display('admin-addSkipassObj.tpl');
    }

    /* public function addPrice($object) {
        $this->smarty->assign('object', $object);
        $this->smarty->display('admin-addPrice.tpl');
    } */

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

    public function searchSkipassObjs($skipassObjs) {
        $this->smarty->assign('skipassObjs', $skipassObjs);
        $this->smarty->display('admin-searchSkipassObj.tpl');
    }

    public function modifySkipassObj($idSkipassObj, $description, $value, $skiFacility, $skipassTemp) {
        $this->smarty->assign('idSkipassObj', $idSkipassObj);
        $this->smarty->assign('description', $description);
        $this->smarty->assign('value', $value);
        $this->smarty->assign('skiFacility', $skiFacility);
        $this->smarty->assign('skipassTemp', $skipassTemp);
        $this->smarty->display('admin-modifySkipassObj.tpl');
    }       

    public function searchSkipassTemps($skipassTemps) {
        $this->smarty->assign('skipassTemps', $skipassTemps);
        $this->smarty->display('admin-searchSkipassTemplate.tpl');
    }

    public function modifyLandingPage($image1, $image2, $image3, $image4, $image5) {
        $this->smarty->assign('image1', $image1);
        $this->smarty->assign('image2', $image2);
        $this->smarty->assign('image3', $image3);
        $this->smarty->assign('image4', $image4);
        $this->smarty->assign('image5', $image5);
        $this->smarty->display('admin-manageInterface.tpl');
    }

    public function modifySkiFacilitiesImages($allSkiFacilities, $map) {
        $this->smarty->assign('skiFacilities', $allSkiFacilities);
        $this->smarty->assign('map', $map);
        $this->smarty->display('admin-modifySkiFacilityImage.tpl');
    }

    public function searchInsuranceTemps($insuranceTemps) {
        $this->smarty->assign('insuranceTemps', $insuranceTemps);
        $this->smarty->display('admin-searchInsuranceTemplate.tpl');
    }

    public function searchSubscriptionTemps($subscriptionTemps) {
        $this->smarty->assign('subscriptionTemps', $subscriptionTemps);
        $this->smarty->display('admin-searchSubscriptionTemplate.tpl');
    }

    public function modifyInsuranceTemp($idInsuranceTemp, $value, $type) {
        $this->smarty->assign('idInsuranceTemp', $idInsuranceTemp);
        $this->smarty->assign('value', $value);
        $this->smarty->assign('type', $type);
        $this->smarty->display('admin-modifyInsuranceTemp.tpl');
    } 

    public function modifySkipassTemplate($idSkipassTemp, $description, $period, $type) {
        $this->smarty->assign('idSkipassTemp', $idSkipassTemp);
        $this->smarty->assign('description', $description);
        $this->smarty->assign('period', $period);
        $this->smarty->assign('type', $type);
        $this->smarty->display('admin-modifySkipassTemp.tpl');
    }
}

?>