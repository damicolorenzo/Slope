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
            CUser::home();
        } else {
            CUser::home();
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
            header('Location: /Slope/Admin/dashboard');
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
}
?>