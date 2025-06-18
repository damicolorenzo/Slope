<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(__DIR__.'\\..\\..\\..\\libs\\PHPMailer-master\\src\\PHPMailer.php');
require(__DIR__.'\\..\\..\\..\\libs\\PHPMailer-master\\src\\SMTP.php');
require(__DIR__.'\\..\\..\\..\\libs\\PHPMailer-master\\src\\Exception.php');
require_once(__DIR__."\\..\\..\\config\\config.php");

class PMail {

    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if(self::$instance == null) {
            $mail = new PHPMailer(true);

            // Configurazione SMTP comune
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'slope.website.mail@gmail.com';
            $mail->Password = 'yfbe pwah tqfl ezyy'; // App password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Mittente predefinito
            $mail->setFrom('slope.website.mail@gmail.com', 'Slope');
            $mail->isHTML(true);

            self::$instance = $mail;
        }
        return self::$instance;
    }

    public static function invia($destinatario, $nome, $oggetto, $corpoHtml) {
        try {
            $mail = self::getInstance();
            $mail->clearAddresses(); // Importante se riutilizzi l’oggetto!
            $mail->addAddress($destinatario, $nome);
            $mail->Subject = $oggetto;
            $mail->Body = $corpoHtml;
            $mail->AltBody = strip_tags($corpoHtml);

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Errore nell'invio dell'email: {$mail->ErrorInfo}";
            return false;
        }
    }
}



?>