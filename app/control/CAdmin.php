<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CAdmin {

    /**
     * Method to retrive the login form
     * Call the showLoginForm() method from VAdmin
     * @return void
     */
    public static function login() : void{
        if(USession::getSessionStatus() == PHP_SESSION_NONE){
            USession::getInstance();
        }
        if(USession::isSetSessionElement('ad')){
            CAdmin::dashboard();
        }
        $view = new VAdmin();
        $view->showLoginForm(false);
    }

    /**
     * Method to logout
     * Unset the session
     * @return void
     */
    public static function logout() : void{
        USession::getInstance();
        if(USession::isSetSessionElement('ad')){
            USession::unsetSession();
            USession::destroySession();
            header('Location: /Slope/');
        }
    }

    /**
     * Method to check if an admin is logged
     * Check in the session array
     * @return bool
     */
    public static function isLogged() : bool{
        if(USession::getSessionStatus() == PHP_SESSION_NONE) {
            USession::getInstance(); 
        }
        return USession::isSetSessionElement('ad');
    }

    /**
     * Method to verify all the data in the login form
     * @return void
     */
    public static function checkLogin() : void{
        $view = new VAdmin();
        if(!CAdmin::isLogged()) { //if Not logged
            if((!empty(UHTTPMethods::post('username')) && !empty(UHTTPMethods::post('password')))) { //From login form 
                $username = FPersistentManager::getInstance()->verifyAdminUsername(UHTTPMethods::post('username'));
                if($username)
                    $admin = FPersistentManager::getInstance()->retriveAdminOnUsername(UHTTPMethods::post('username'));
                else
                    $admin = [];
                if($username && count($admin) == 1) {
                    if(password_verify(UHTTPMethods::post('password'), $admin[0]->getPassword())) {
                        if(USession::getSessionStatus() == PHP_SESSION_NONE) {
                            USession::getInstance();
                            USession::setSessionElement('ad', $admin[0]->getIdAdmin());
                            CAdmin::dashboard();
                        } else {
                            USession::setSessionElement('ad', $admin[0]->getIdAdmin());
                            CAdmin::dashboard();
                        }
                    } else {
                        $view->showLoginForm(true);
                    }
                } else {
                    $view->showLoginForm(true);
                }
            } else { //Not from login form
                CAdmin::login();
            }
        } else { //if logged
            CAdmin::dashboard();
        }
        
    }

    /**
     * Method to retrive from the database all the data showed in the dashboard
     * @return void
     */
    public static function dashboard() : void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $map = [];
            $skipassBookings = FPersistentManager::retriveAllSkipassBookingAllUsers();
            foreach ($skipassBookings as $element) {
                $skipassObj = FPersistentManager::retriveSkipassObjOnId($element->getIdSkipassObj());
                $idSkiFacility = $skipassObj[0]->getIdSkiFacility();
                $skiFacility = FPersistentManager::getInstance()->retriveSkiFacilityOnId($idSkiFacility);
                $nameSkiFacility = $skiFacility[0]->getName();
                $date = new DateTime($element->getStartDate());
                $month = $date->format("Y-m");
                if(isset($map[$month][$nameSkiFacility])) {
                    $map[$month][$nameSkiFacility] += 1; 
                } else {
                    $map[$month][$nameSkiFacility] = 1; 
                }
            }
            $utenti = FPersistentManager::getInstance()->retriveAllUsers();
            $countUsers = 0;
            $countSubUsers = 0;
            foreach ($utenti as $element) {
                $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($element->getIdUser());
                if(count($subscription) > 0)
                    $countSubUsers += 1;
                else   
                    $countUsers += 1;
            }
            $labelsPie = json_encode(["Utenti Abbonati", "Utenti Non Abbonati"]);
            $datiPie = json_encode([$countSubUsers, $countUsers]);
            $map = json_encode($map);
            $view->dashboard($map, $labelsPie, $datiPie);
        } else {
            CAdmin::login();
        }
    }
   
    
    

    /* ADD FUNCTIONS */

    

    /* MODIFY FUNCTIONS */

    

    /* CONFIRM FUNCTIONS */

    

    /* DELETE FUNCTIONS */

    

    

    

    /* public static function manageInterface() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->manageInterface($landingImage1);
        }
    } */

    /**
     * Method to retrive all the data in the add lift structure form 
     * @return void
     */
    /* public static function addPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $allSkipassTemp = FPersistentManager::getInstance()->retriveAllSkipassTemp();
            $allInsuranceTemp = FPersistentManager::getInstance()->retriveAllInsuranceTemp();
            $allSkiFacilities = FPersistentManager::getInstance()->retriveAllSkiFacilities();
            $object['skipassTemp'] = $allSkipassTemp;
            $object['insuranceTemp'] = $allInsuranceTemp;
            $object['skiFacility'] = $allSkiFacilities;
            $view->addPrice($object);
        } else {
            CAdmin::dashboard();
        }
    } */

    /* public static function confirmPrice() {
        if(CAdmin::isLogged()) {
            $description = UHTTPMethods::post('description');
            $skipassObj = FPersistentManager::getInstance()->retriveIdSkipassObj($description, UHTTPMethods::post('period'), UHTTPMethods::post('type'));
            $idSkipassObj = $skipassObj->getIdSkipassObj();
            $skiFacilityName = UHTTPMethods::post('skiFacility');
            $price = UHTTPMethods::post('price');
            $idSkiFacility = FPersistentManager::getInstance()->retriveIdSkiFacilityFromName($skiFacilityName);
            $description = $description . " " . $skiFacilityName;
            $price = new EPrice($description, $price);
            $price->setIdSkiFacility($idSkiFacility);
            $price->setIdSkipassObj($idSkipassObj);
            FPersistentManager::getInstance()->uploadObj($price);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    /* public static function modifyPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idPrice = UHTTPMethods::post('idPrice');
            $price = FPersistentManager::getInstance()->retrivePriceOnId($idPrice);
            $description = $price[0]->getDescription();
            $value = $price[0]->getValue();
            $idExtObj = $price[0]->getIdExtObj();
            $extClass = $price[0]->getExtClass();
            $class = substr($extClass, 1);
            $obj = FPersistentManager::getInstance()->retriveObj($class, $idExtObj);
            $view->modifyPrice($idPrice, $description, );
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    /* public static function confirmModifyPrice() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $idPrice = UHTTPMethods::post('idPrice');
            $idSkiFacility = UHTTPMethods::post('idSkiFacility');
            $price = new EPrice(UHTTPMethods::post('description'), UHTTPMethods::post('full'), UHTTPMethods::post('reduced'));
            $price->setIdPrice($idPrice);
            $price->setIdSkiFacility($idSkiFacility);
            FPersistentManager::getInstance()->updatePrice($price);
            header('Location: /Slope/Admin/dashboard'); 
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    /* public static function searchPrices() {
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            if(UHTTPMethods::post("description") !== NULL) {
                $description = (UHTTPMethods::post("description") !== NULL) ? UHTTPMethods::post("description") : "";
                $prices = FPersistentManager::getInstance()->retrivePriceFromDesc($description);
                $view->searchPrices($prices);
            } else {
                $prices = FPersistentManager::getInstance()->retriveAllPricesForSearch();
                $view->searchPrices($prices);
            }
        } else {
            $view = new VAdmin();
            $view->showLoginForm();
        }
    } */

    /**
     * Method to retrive all the data in the add skipass template form 
     * @return void
     */
    /* public static function addSkipass() :void{
        if(CAdmin::isLogged()) {
            $view = new VAdmin();
            $view->addSkipass();
        } else {
            CAdmin::dashboard();
        }
    } */

    /**
     * Method to verify all the data in the modify skipass object form 
     * @return void
     */
    /* public static function confirmModifySkipass() :void{
        if(CAdmin::isLogged()) {
            if(!is_null(UHTTPMethods::post('idSkipassObj')) && !is_null(UHTTPMethods::post('description')) && !is_null(UHTTPMethods::post('period')) && !is_null(UHTTPMethods::post('type'))) {
                $idSkipassObj = UHTTPMethods::post('idSkipassObj');
                $skipass = new ESkipassObj(UHTTPMethods::post('description'), UHTTPMethods::post('period'), UHTTPMethods::post('type'));
                $skipass->setIdSkipassObj($idSkipassObj);
                FPersistentManager::getInstance()->updateSkipassObj($skipass);
                CAdmin::dashboard();
            } else {
                CAdmin::dashboard();
            }
        } else {
            CAdmin::dashboard();
        }
    } */
}
?>