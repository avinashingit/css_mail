<?php
require("scripts/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();    // set mailer to use SMTP
$mail->Host = "smtp.asia.secureserver.net";    // specify main and backup server
$mail->SMTPAuth = true;    // turn on SMTP authentication
$mail->Username = "admin@samgatha.org";    // SMTP username -- CHANGE --
$mail->Password = "s@mgatha23";    // SMTP password -- CHANGE --
$mail->Port = "465";    // SMTP Port

$mail->From = "admin@samgatha.org";    //From Address -- CHANGE --
$mail->FromName = "Your Company Name";    //From Name -- CHANGE --
$mail->AddAddress("psrk92@gmail.com", "Example");    //To Address -- CHANGE --
$mail->AddReplyTo("admin@samgatha.org", "Your Company Name"); //Reply-To Address -- CHANGE --

$mail->WordWrap = 50;    // set word wrap to 50 characters
$mail->IsHTML(false);    // set email format to HTML

$mail->Subject = "AuthSMTP Test";
$mail->Body    = "AuthSMTP Test Message!";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
?>
