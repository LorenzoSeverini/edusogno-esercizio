<?php
// email configuration 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// load composer autoload
require '../vendor/autoload.php';

// new instance of PHPMailer
$mail = new PHPMailer(true);

// debug 
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

// SMTP configuration
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = 'lorenzoseverini122@gmail.com';
$mail->Password = 'borf xygn lowi xghr';

$mail->isHtml(true);

return $mail;
