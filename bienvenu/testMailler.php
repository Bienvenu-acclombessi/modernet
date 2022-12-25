<?php
use PHPMailer\PHPMailer\PHPMailer;
include("database.php");
require 'vendor/autoload.php';
$emails=$db->query('SELECT * from user');
while($email=$emails->fetch()){
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.fr';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'nebstan@expashoping.fr';
$mail->Password = '96989470Welcom@';
$mail->setFrom('nebstan@expashoping.fr', 'NEBSTAN COMPANY');
$mail->addReplyTo('nebstan@expashoping.fr', 'Nebstan Company');
    $mail->addAddress($email['email'], 'nebstan');
    $mail->Subject = utf8_decode('Bonne et heureuse année');
    $mail->isHTML(true);
    $mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = utf8_decode('Bonjour '.$email['nom'].' '.$email['prenom'].' Toute l\'equipe de nebstan vous souhaite une bonne et heureuse année 2022');
    $mail->addAttachment('img/1.jpg');
    if (!$mail->send()) {
        echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
    } else {
        echo 'Le message a été envoyé.';
       
    }
}
 header("location: index.php");
?>