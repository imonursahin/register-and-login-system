<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


function sendMail($mailAddress, $name, $activationCode, $message)
{

    try {
        if (empty($message)) {
            $message = ' <a href="localhost/400432/aktiflestir.php?mail=' . $mailAddress . '&kod=' . $activationCode . '">Hesabı Aktifleştirin</a>';
        }

        //Server settings
        $mail = new PHPMailer(true);
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;                    // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.onursahin.net';
        $mail->Username   = 'info@onursahin.net';                     // SMTP username
        $mail->Password   = 'onur1903+';                               // SMTP password
        $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('info@onursahin.net', 'onursahin');
        $mail->addAddress($mailAddress, $name);     // Add a recipient


        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'onursahin';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return 'mail adresinize gönderildi.';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
