<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(__DIR__.'/../../../libs/PHPMailer-master/src/PHPMailer.php');
require(__DIR__.'/../../../libs/PHPMailer-master/src/SMTP.php');
require(__DIR__.'/../../../libs/PHPMailer-master/src/Exception.php');
require_once(__DIR__."/../../config/config.php");

class UPMail {

    private static $instance = null;
    private $mail;

    private function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'slope.website.mail@gmail.com';
        $this->mail->Password = 'ztkl ynqe vcna ssxg'; // App password
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
    }

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendMail($destinatario, $oggetto, $corpoHtml) {
        try {
            // Configurazione del mittente e del destinatario
            $this->mail->setFrom('slope.website.mail@gmail.com');
            $this->mail->addAddress($destinatario);

            // Contenuto dell'email
            $this->mail->isHTML(true);
            $this->mail->Subject = $oggetto;
            $this->mail->Body = $corpoHtml;

            // Inviare l'email
            $this->mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            // Gestione degli errori
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}



?>
