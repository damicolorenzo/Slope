<?php

require_once (__DIR__ . '/../config/autoloader.php');

class CUserOperations {

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
            $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
            $subscription = FPersistentManager::getInstance()->retriveSubscriptionFromUserId($userId);
            if(count($subscription) > 0) 
                if($subscription[0]->getEndDate() > new DateTime())
                    $rebuySub = true;
                else
                    $rebuySub = false;
            else    
                $rebuySub = false;
            $subscriptionTemp = FPersistentManager::getInstance()->retriveSubscriptionTempFromId(1);
            $value = $subscriptionTemp[0]->getValue();
            $discount = $subscriptionTemp[0]->getDiscount();
            $view->profileInfo($username, $name, $surname, $email, $phoneNumber, $birthDate, $image, $creditCard, $subscription, $rebuySub, $value, $discount);
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
                if($phoneError) {
                    $view->modifyProfile($username, $name, $surname, $modifiedEmail, $modifiedPhoneNumber, $birthDate, $phoneError, false);
                } else {
                    if($user[0]->getEmail() != $modifiedEmail || $user[0]->getPhoneNumber() != $modifiedPhoneNumber) {
                        $now = date('Y-m-d H:i:s');
                        $modify = "";
                        if($user[0]->getEmail() != $modifiedEmail)
                            $modify = "Email";
                        if($user[0]->getPhoneNumber() != $modifiedPhoneNumber)
                            $modify = $modify . "Numero di telefono";
                        $mailer = UPMail::getInstance();
                        $mailer->sendMail(
                            $modifiedEmail,
                            "Conferma modifica della email sul suo account Slope",
                            "Ciao,
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

    /**
     * Loads the current user's profile image for modification. If no image exists (ID is 0),
     * it notifies the view accordingly. Redirects to home if the user is not logged in.
     * @return void
     */
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
            $mailer = UPMail::getInstance();
            $now = date('Y-m-d H:i:s');
            $modify = "Eliminazione immagine profilo";
            $mailer->sendMail(
                $user[0]->getEmail(),
                "Conferma modifica della email sul suo account Slope",
                "Ciao,
                Le modifiche al tuo profilo sono state salvate con successo.
                Dettagli aggiornati:

                Data modifica: $now
                Modifiche effettuate: $modify

                Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                Grazie,
                Il team di Slope"
            );
            self::profile();
        } else {
            CUser::home();
        }
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
     * Displays the password recovery view for non-logged-in users. 
     * Redirects to home if the user is already logged in.
     * @return void
     */
    public static function lostPassword() : void {
        if(!CUser::isLogged()){
            $view = new VUserOperations();
            $view->lostPassword();
        } else {
            CUser::home();
        }
    }

    /**
     * Verifies if the provided email exists in the system and initiates the password recovery process by generating and emailing a token.
     * Redirects to home if the email is not provided or invalid.
     * @return void
     */
    public static function checkLostUser() : void {
        if(!empty(UHTTPMethods::post('email'))) {
            $checkEmail = FPersistentManager::getInstance()->verifyUserEmail(UHTTPMethods::post('email'));
            $view = new VUserOperations();
            if($checkEmail) {
                $user = FPersistentManager::getInstance()->retriveUserOnEmail(UHTTPMethods::post('email'));
                $token = bin2hex(random_bytes(32));
                $createdAt = date('Y-m-d H:i:s'); // es: 2025-06-24 14:30:00
                $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));
                $tokenObj = new EToken($token, $expiresAt, $createdAt);
                $tokenObj->setUserId($user[0]->getIdUser());
                FPersistentManager::getInstance()->uploadObj($tokenObj);
                $mailer = UPMail::getInstance();
                $mailer->sendMail(UHTTPMethods::post('email'), "Recupero password Slope", "Recupera la tua mail qui https://localhost/Slope/UserOperations/resetPassword utilizzando il token: token={$token}");
                $view->checkLostUser(true);
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Displays the form for setting a new password during the password recovery process.
     * @return void
     */
    public static function resetPassword() : void{
        $view = new VUserOperations();
        $view->newPasswordForm();
    }
 
    /**
     * Validates and sets a new password for a user based on a valid recovery token.
     * Ensures the token is valid, not expired or used, and the password meets complexity requirements.
     * If all checks pass, updates the user's password and marks the token as used.
     * @return void
     */
    public static function setNewPassword() {
        if(!is_null(UHTTPMethods::post('password')) && !is_null(UHTTPMethods::post('token'))) {
            $password = UHTTPMethods::post('password');
            $token = UHTTPMethods::post('token');
            $retrivedToken = FPersistentManager::getInstance()->retriveTokenFromToken($token);
            $view = new VUserOperations();
            if(count($retrivedToken) > 0) {
                $view->newPasswordForm();
            }
            $now = new DateTime();                   // ora attuale
            $created = new DateTime($retrivedToken[0]->getCreatedAt());
            $expires = new DateTime($retrivedToken[0]->getExpiresAt());
            if(!($now >= $created && $now < $expires)) {
                $view->newPasswordForm();
            } 
            if($retrivedToken[0]->getUsed()) {
                $view->newPasswordForm();
            }
            $password_validaiton = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
            if(!preg_match($password_validaiton, $password)) {
                $passwordError = true;
            } else {
                $passwordError = false;
            }
            if($passwordError) {
                $view->newPasswordForm();
            } else {
                $newPass = password_hash($password, PASSWORD_DEFAULT);
                $userId = $retrivedToken[0]->getUserId();
                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                $user[0]->setPassword($newPass);
                $result = FPersistentManager::getInstance()->updateUserPassword($user[0]);
                $newToken = new EToken($token, $retrivedToken[0]->getExpiresAt(), $retrivedToken[0]->getCreatedAt());
                $newToken->setId($retrivedToken[0]->getId());
                $newToken->setUserId($userId);
                $newToken->setUsed(1);
                FPersistentManager::getInstance()->updateToken($newToken);
                if($result) {
                    CUser::home();
                } else {
                    $view->newPasswordForm();
                }
            }
        }
    }

    /**
     * Method to verify the data from modify password form
     * @return void
     */
    public static function setPassword() : void{
        if(CUser::isLogged()){
            if(!is_null(UHTTPMethods::post('password'))) {
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
                    $user[0]->setPassword($newPass);
                    $result = FPersistentManager::getInstance()->updateUserPassword($user[0]);
                    if($result) {
                        $mailer = UPMail::getInstance();
                        $now = date('Y-m-d H:i:s');
                        $modify = "Modifica password profilo";
                        $mailer->sendMail(
                            $user[0]->getEmail(),
                            "Conferma modifica della password sul suo account Slope",
                            "Ciao,
                            Le modifiche al tuo profilo sono state salvate con successo.
                            Dettagli aggiornati:

                            Data modifica: $now
                            Modifiche effettuate: $modify

                            Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                            Grazie,
                            Il team di Slope"
                        );
                        self::profile();
                    } else {
                        $view->modifyPassword($passwordError);
                    }
                }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Shows the form to modify the user's credit card info.
     * Fetches card details (name, surname, last 4 digits, expiry) if user is logged in.
     * Redirects to home if not logged in.
     */
    public static function modifyCreditCard() :void {
        if(CUser::isLogged()){
            $view = new VUserOperations();
            $userId = USession::getInstance()->getSessionElement('user');
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

    /**
     * Processes credit card modification if user is logged in and form data is complete.
     * Checks if new data differs from existing card; updates and sends confirmation email if changed.
     * Redirects to profile or home accordingly.
     */
    public static function confirmModifyCreditCard() :void {
        if(CUser::isLogged()){
            if(!is_null(UHTTPMethods::post('cardHolderName')) && !is_null(UHTTPMethods::post('cardHolderSurname')) && 
            !is_null(UHTTPMethods::post('cardHolderSurname')) && !is_null(UHTTPMethods::post('cardNumber')) && 
            !is_null(UHTTPMethods::post('expiryDate')) && !is_null(UHTTPMethods::post('cvv'))) {
                $userId = USession::getInstance()->getSessionElement('user');
                $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
                $creditCard = FPersistentManager::getInstance()->retriveCreditCardFromUserId($userId);
                $cond = UHTTPMethods::post('cardHolderName') == $creditCard[0]->getCardHolderName() &&
                    UHTTPMethods::post('cardHolderSurname') == $creditCard[0]->getCardHolderSurname() &&
                    UHTTPMethods::post('expiryDate') == $creditCard[0]->getExpiryDate() && 
                    UHTTPMethods::post('cardNumber') == $creditCard[0]->getCardNumber() &&
                    UHTTPMethods::post('cvv') == $creditCard[0]->getCvv();
                    if(!$cond) {
                        $creditCard = new ECreditCard(UHTTPMethods::post('cardHolderName'), UHTTPMethods::post('cardHolderSurname'), UHTTPMethods::post('expiryDate'), UHTTPMethods::post('cardNumber'), UHTTPMethods::post('cvv'));
                        $creditCard->setIdUser($userId);
                        FPersistentManager::getInstance()->updateCreditCard($creditCard);
                        $mailer = UPMail::getInstance();
                        $now = date('Y-m-d H:i:s');
                        $modify = "Modifica carta di credito";
                        $mailer->sendMail(
                            $user[0]->getEmail(),
                            "Conferma modifica dei dati della carta di credito sul suo account Slope",
                            "Ciao,
                            Le modifiche al tuo profilo sono state salvate con successo.
                            Dettagli aggiornati:

                            Data modifica: $now
                            Modifiche effettuate: $modify

                            Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                            Grazie,
                            Il team di Slope"
                        );
                    } else {
                        self::profile();
                    }
            } else {
                CUser::home();
            }
        } else {
            CUser::home();
        }
    }

    /**
     * Deletes user's credit card if logged in, sends confirmation email, then redirects to profile/home.
     */
    public static function deleteCreditCard() {
        if(CUser::isLogged()){
            $userId = USession::getInstance()->getSessionElement('user');
            $user = FPersistentManager::getInstance()->retriveObj(EUser::getEntity(), $userId);
            FPersistentManager::getInstance()->deleteCreditCard($userId);
            $mailer = UPMail::getInstance();
            $now = date('Y-m-d H:i:s');
            $modify = "Eliminazione carta di credito";
            $mailer->sendMail(
                $user[0]->getEmail(),
                "Conferma eliminazione della carta di credito dal suo account Slope",
                "Ciao,
                Le modifiche al tuo profilo sono state salvate con successo.
                Dettagli aggiornati:

                Data modifica: $now
                Modifiche effettuate: $modify

                Se non hai effettuato tu queste modifiche, contattaci immediatamente.
                Grazie,
                Il team di Slope"
            );
            self::profile();
            CUser::home();
        } else {
            CUser::home();
        }
    }


}

?>