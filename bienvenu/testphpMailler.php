<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
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
$mail->addAddress('bienvenuacclombessi8@gmail.com', 'ACCLOMBESSI Bienvenu');
$mail->Subject = 'Nebstan essai';
$mail->isHTML(true);
$mail->addAttachment("img/1.jpg");
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body = 'Bonjour <h1> monsieur </h1> c\'est juste moi <a href="expashoping.fr">Bonjour</a> veillez me contacter ';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
} else {
    echo 'Le message a été envoyé.';
    header("location: index.php");
}
?>