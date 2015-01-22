<?php
require("class.phpmailer.php");
echo "START";
$mail = new PHPMailer();
echo "1";
$mail->IsSMTP();    // set mailer to use SMTP
$mail->Host = "smtp.gmail.com";    // specify main and backup server
$mail->SMTPAuth = true;    // turn on SMTP authentication
$mail->Username = "samgatha.iiitdm@gmail.com";    // SMTP username -- CHANGE --
$mail->Password = "s@mgatha24";    // SMTP password -- CHANGE --
$mail->Port = 587;    // SMTP Port
$mail->SMTPSecure = "tls";
echo "2";
$mail->From = "samgatha.iiitdm@gmail.com";    //From Address -- CHANGE --
$mail->FromName = "IIITD&M";    //From Name -- CHANGE --
$mail->AddAddress("psrk92@gmail.com");//, "Example");    //To Address -- CHANGE --
$mail->AddReplyTo("admin@samgatha.org", "Your Company Name"); //Reply-To Address -- CHANGE --
echo "3";
$mail->WordWrap = 50;    // set word wrap to 50 characters
$mail->IsHTML(false);    // set email format to HTML
echo "4";
$mail->Subject = "AuthSMTP Test";
$mail->Body    = "AuthSMTP Test Message!";
echo "5nsdjdn";
if(!$mail->Send())
{
   echo "5.5";
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
echo "6";
echo "Message has been sent";
?>
