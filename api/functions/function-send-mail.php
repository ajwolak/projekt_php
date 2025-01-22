<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/db-connect.php');
require_once(__DIR__ . '/mails/mail-registration.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../', ".env.development");
$dotenv->load();
$dotenv->required(['MAIL_USER', 'MAIL_PASS', 'MAIL_HOST']);


function sendMail(array $address, string $subject, string $body, string $sender_name, string $copy_mail = ''): void
{
    foreach ($address as $adres) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = $_ENV['MAIL_HOST']; //Zależne od hostingu poczty
        $mail->SMTPDebug = 0; // pokazanie logów 
        $mail->Port = 465; //Zależne od hostingu poczty, czasem 587
        $mail->SMTPSecure = 'ssl'; //Jeżeli ma być aktywne szyfrowanie SSL 
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->Username = $_ENV['MAIL_USER']; //Login do skrzynki email często adres
        $mail->Password = $_ENV['MAIL_PASS']; //Hasło do poczty 
        $mail->setFrom($_ENV['MAIL_USER'], $sender_name); //Adres e-mail i nazwa nadawcy 
        $mail->Subject = $subject; //Temat wiadomości
        $mail->Body = $body; //Treść wiadomości
        $mail->AddAddress("$adres"); //Adresy email, do których mają być wysłane maile
        if ($copy_mail != '') {
            $mail->addBCC("$copy_mail"); //Email do kopi
        }
        $mail->Send(); //Wysyłanie maila
    }
}
