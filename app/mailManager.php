<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;

class mailManager
{

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function sendEmail($properties)
    {
        // Composer autoload
        require_once PATH . "/vendor/autoload.php";

        // Get config settings
        require_once PATH . '/settings/config.php';
        $config = config::getInstance();

        // Get errors manager
        require_once PATH . '/app/errorsManager.php';
        $errorsManager = errorsManager::getInstance();

        // Create a new instance of PHPMailer
        $mail = new PHPMailer();

        // Configure SMTP settings
        $mail->SMTPDebug = $config->getMailDebug();
        $mail->isSMTP();
        $mail->Host = $config->getMailHost();
        $mail->SMTPAuth = true;
        $mail->Username = $config->getMailUsername();
        $mail->Password = $config->getMailPassword();
        $mail->SMTPSecure = $config->getMailSMTPSecure();
        $mail->SMTPOptions = $config->getMailSMTPOptions();
        $mail->Port = $config->getMailPort();

        // Set sender and recipient details
        $mail->setFrom($properties['sender'], $properties['sender_display']);
        $mail->addAddress($properties['recipient'], $properties['recipient_display']);

        // Set email content
        $mail->isHTML(true);
        $mail->Subject = $properties['subject'];
        $mail->Body = $properties['body'];
        $mail->AltBody = $properties['alt_body'];

        // Send the email and handle errors if any
        if (!$mail->send()) {
            $errorMessage = 'Mail sending error: ' . $mail->ErrorInfo;
            $errorsManager->throw(10, $errorMessage);
        }
    }

    public function getPHPMailer() {

        // Composer autoload
        require_once PATH . "/vendor/autoload.php";

        // Return real PHPMailer in case on need
        return new PHPMailer();
    }


    // *****************************************
    // *****************************************
    //           Singleton declaration
    // *****************************************
    // *****************************************


    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new mailManager();
        }
        return self::$instance;
    }
}
