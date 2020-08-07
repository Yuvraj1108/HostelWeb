<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("../../PHPMailer/src/PHPMailer.php");
require_once("../../PHPMailer/src/Exception.php");
require_once("../../PHPMailer/src/SMTP.php");


function smtpmailer($to,$to2="",$ccStudent,$ccHostelGS,$ccGirlNom,$from, $from_name, $subject, $body,$attachment) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = 'csms.hostel@iitgoa.ac.in';//'csms.iitgoa@gmail.com';  
	$mail->Password = 'hallcsms@1';//'CSMS@IITGoaHostel2018';           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if($to2!="")
	{
	    $mail->AddAddress($to2);
	}
	$mail->AddCC($ccStudent);
	$mail->AddCC($ccHostelGS);
	$mail->AddBCC('csms.hostel@iitgoa.ac.in');
	$mail->IsHTML(true);
	if($ccGirlNom!="")
	   $mail->AddCC($ccGirlNom);
	if($attachment!="")
		$mail->addAttachment($attachment);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
?>