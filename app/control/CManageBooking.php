<?php

class CManageBooking {

    /*
    Permette di visualizzare l'insieme delle prenotazioni dell'utente 
    */
    public static function viewBooking() {
        //Prelevare informazioni utente tramite sessione 
    }

    /*
    Permette di richiedere la compilazione di n prenotazioni  
    */
    public static function makeABooking($n) {
        if(CUser::isLogged()) {
            $userId = USession::getInstance()->getSessionElement('user');
            
        }
    }

    /*
    Permette di confermare una prenotazione e quindi effettuare gli update sul db 
    */
    public static function confirmBooking($idSkipassBooking) {}

    /*
    Permette di mostrare la conferma della prenotazione quindi tutti i dettagli della stessa 
    */
    public static function confirmRecapBooking($idSkipassBooking) {}

    /*
    Permette di selezionare una prenotazione (Esempio quando bisogno modificarne una)
    */
    public static function selectBooking($idSkipassBooking) {}

    /*
    Permette di eliminare una prenotazione  
    */
    public static function deleteBoooking($idSkipassBooking) {}

    /*
    Permette di creare una prenotazione 
    */
    public static function bookingData() {}

    /*
    Permette di modificare una prenotazione 
    */
    public static function modifyDataBooking() {}

    /*
    Permette di salvare i dati della carta  
    */
    public static function cardData() {}
}

?>