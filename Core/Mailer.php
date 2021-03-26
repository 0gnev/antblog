<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    public function sendMail($email, $subject, $message)
    {
        require '../Config/MailerConfig.php';
        $mail = new PHPMailer(true);

        try {
            $mail->IsSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->AddAddress($email);
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SetFrom($username, 'Antmodule');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = $message;
            $mail->Send();
        } catch (Exception $ex) {
            echo $msg = "
            " . $ex->errorMessage() . "
            ";
        }
    }
}
