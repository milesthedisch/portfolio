<?php
date_default_timezone_set('Etc/UTC');
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

// this is an ENV var 
// Check for empty fields
// if(empty($_POST['name'])  		||
//    empty($_POST['email']) 		||
//    empty($_POST['phone']) 		||
//    empty($_POST['message'])	||
//    !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
//    {
// 	echo "No arguments Provided!";
// 	return false;
//    }
	

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = getenv("GMAIL_USERNAME");
//Password to use for SMTP authentication
$mail->Password = getenv("GMAIL_PASSWORD");
//Set who the message is to be sent from
$mail->setFrom($_POST['email'], $_POST['name']);
//Set an alternative reply-to address
$mail->addReplyTo(getenv("GMAIL_USERNAME"), 'Miles Disch');

$mail->Subject = $_POST['phone'];
//Set who the message is to be sent to
$mail->addAddress(getenv("GMAIL_USERNAME"), 'Miles Disch');

$mail->AltBody = 'This is a plain-text message body';

$mail->msgHTML($_POST['message']);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}