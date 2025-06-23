<?php

require_once (__DIR__."\\..\\config\\autoloader.php");

class CUserOperations {

    public static function sendMail() {
        $name = UHTTPMethods::post('name');
        $email = UHTTPMethods::post('email');
        $subject = UHTTPMethods::post('subject');
        $message = UHTTPMethods::post('message');
        //salvataggio sul db del messaggio scritto dall'utente
        $mail = PMail::invia(
            $email,
            $name,
            "Conferma invio mail a Slope",
            "Grazie per aver condiviso la sua idea"
        );
    }

    /**
     * Method to show the informations about the user 
     * @return void
     */
    public static function profile() : void{
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user[0]->getUsername(); 
            $name = $user[0]->getName();
            $surname = $user[0]->getSurname();
            $email = $user[0]->getEmail();
            $phoneNumber = $user[0]->getPhoneNumber();
            $birthDate = $user[0]->getBirthDate();
            $idImage = $user[0]->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            $insurances = FPersistentManager::getInstance()->retriveInsuranceFromIdUser($userId);
            $insurance = [];
            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
            foreach ($insurances as $i) {
                if($i->getPeriod() > 1)
                    $insurance[] = $i;
            }
            $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
            $insuranceImage = false;
            $subscriptionImage = false;
            $view->profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $insuranceImage, $subscriptionImage, $insurance, $creditCard, $subscription);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to show a page to modify user data
     * @return void
     */
    public static function modifyProfile() : void{
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $username = $user[0]->getUsername(); 
            $name = $user[0]->getName();
            $surname = $user[0]->getSurname();
            $email = $user[0]->getEmail();
            $phoneNumber = $user[0]->getPhoneNumber();
            $birthDate = $user[0]->getBirthDate();
            $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify all the data in the modify form 
     * @return void
     */
    public static function confirmModify() : void{
        if(CUser::isLogged()){
            if(!is_null(UHTTPMethods::post('email')) && !is_null(UHTTPMethods::post('phoneNumber'))) {
                $view = new VUserOperations();
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $username = $user[0]->getUsername(); 
                $name = $user[0]->getName();
                $surname = $user[0]->getSurname();
                $birthDate = $user[0]->getBirthDate();
                $modifiedEmail = UHTTPMethods::post('email');
                $phone_number_validation_regex = "/^\\+?[1-9][0-9]{7,14}$/"; 
                if(!preg_match($phone_number_validation_regex, UHTTPMethods::post('phoneNumber'))) {
                    $phoneError = true;
                } else {
                    $phoneError = false;
                    $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";
                    preg_match_all($extract_phone_number_pattern, UHTTPMethods::post('phoneNumber'), $matches);
                    $modifiedPhoneNumber = implode($matches[0]);
                }
                if($phoneError) 
                    $view->modifyProfile($username, $name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate, $phoneError, false);
                else {
                    if($user[0]->getEmail() != $modifiedEmail && $user[0]->getPhoneNumber() != $modifiedPhoneNumber) {
                        $now = date('Y-m-d H:i:s');
                        $modify = "";
                        if($user[0]->getEmail() != $modifiedEmail)
                            $modify = "Email";
                        if($user[0]->getPhoneNumber() != $modifiedPhoneNumber)
                            $modify = $modify + "Numero di telefono";

                        $mail = PMail::invia(
                            $modifiedEmail,
                            $name,
                            "Conferma modifica della email sul suo account Slope",
                            "Ciao $name,
                            Le modifiche al tuo profilo sono state salvate con successo.
                            Dettagli aggiornati:

                            Data modifica: $now
                            Modifiche effettuate: $modify

                            Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                            Grazie,
                            Il team di Slope"
                        );
                        $person = new EPerson($name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate);
                        $person->setId($userId);
                        FPersistentManager::getInstance()->updatePersonInfo($person);
                        self::profile();
                    } else {
                        self::profile();
                    }   
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    public static function modifyProfileImage() {
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $idImage = $user[0]->getIdImage();
            $image = FPersistentManager::getInstance()->retriveImageOnId($idImage);
            if($idImage == 0)
                $view->modifyProfileImage(false, $image);
            else    
                $view->modifyProfileImage(true, $image);
        } else {
            CUser::home();
        }
    }
 
    /**
     * Method to modify the user image
     * @return void
     */
    public static function modifyImage() : void{
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            if(!is_null(UHTTPMethods::files('image','size'))){
                $uploadedImage = UHTTPMethods::files('image');
                $check = FPersistentManager::getInstance()->checkImage($uploadedImage);
                if($check == 'UPLOAD_ERROR_OK' || $check == 'TYPE_ERROR' || $check == 'SIZE_ERROR') {
                    $checkImageError = true;
                } else {
                    $checkImageError = false;
                }
                if(!$checkImageError) {
                    FPersistentManager::getInstance()->uploadObj($check);
                    if($user[0]->getIdImage() != 0){
                        if(FPersistentManager::getInstance()->deleteImage($user[0]->getIdImage())){
                            $user[0]->setIdImage($check->getId());
                            FPersistentManager::getInstance()->updateUserIdImage($user[0]);
                        }
                        self::profile();
                    }else{
                        $user[0]->setIdImage($check->getId());
                        FPersistentManager::getInstance()->updateUserIdImage($user[0]);
                        CUser::home();
                    }
                } else {
                    $view = new VUserOperations();
                    $userId = USession::getInstance()->getSessionElement('user');
                    $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                    $username = $user[0]->getUsername(); 
                    $name = $user[0]->getName();
                    $surname = $user[0]->getSurname();
                    $email = $user[0]->getEmail();
                    $phoneNumber = $user[0]->getPhoneNumber();
                    $birthDate = $user[0]->getBirthDate();
                    if($user[0]->getIdImage() == 0)
                        $image = false;
                    else    
                        $image = true;
                    $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, true, $image);
                }
            } else {
                $view = new VUserOperations();
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
                $username = $user[0]->getUsername(); 
                $name = $user[0]->getName();
                $surname = $user[0]->getSurname();
                $email = $user[0]->getEmail();
                $phoneNumber = $user[0]->getPhoneNumber();
                $birthDate = $user[0]->getBirthDate();
                if($user[0]->getIdImage() == 0)
                    $image = false;
                else    
                    $image = true;
                $view->modifyProfile($username, $name, $surname, $email, $phoneNumber, $birthDate, false, true, $image);
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Method to delete the user image
     * @return void
     */
    public static function deleteImage() {
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            FPersistentManager::getInstance()->deleteImage($user[0]->getIdImage());
            $user[0]->setIdImage(0);
            FPersistentManager::getInstance()->updateUserIdImage($user[0]);
            self::profile();
        } else {
            CUser::home();
        }
    }

    public static function confirmDeleteImage() {

    }

    /**
     * Method to modify the password
     * @return void
     */
    public static function modifyPassword() : void{
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $view->modifyPassword(false);
        } else {
            CUser::home();
        }
    }

    /**
     * Method to verify the data from modify password form
     * @return void
     */
    public static function setPassword() : void{
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $password_validaiton = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
            if(!preg_match($password_validaiton, UHTTPMethods::post('password'))) {
                $passwordError = true;
            } else {
                $passwordError = false;
            }
            if($passwordError) {
                $view->modifyPassword($passwordError);
            } else {
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                $newPass = password_hash(UHTTPMethods::post('password'), PASSWORD_DEFAULT);
                $user->setPassword($newPass);
                $result = FPersistentManager::getInstance()->updateUserPassword($user);
                if($result) {
                    self::profile();
                } else {
                    $view->modifyPassword($passwordError);
                }
            }   
        } else {
            CUser::home();
        }
    }

    public static function modifyCreditCard() :void {
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveUserOnId($userId);
            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
            $cardHName = $creditCard[0]->getCardHolderName();
            $cardHSurname = $creditCard[0]->getCardHolderSurname();
            $cardNumber = substr($creditCard[0]->getCardNumber(), -4);
            $expirtDate = $creditCard[0]->getExpiryDate();
            $view->modifyCreditCard($cardHName, $cardHSurname, $cardNumber, $expirtDate);
        } else {
            CUser::home();
        }
    }

    public static function deleteCreditCard() {
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            FPersistentManager::getInstance()->deleteCreditCard($userId);
            CUser::home();
        } else {
            CUser::home();
        }
    }


}

?>