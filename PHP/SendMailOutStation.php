<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("../../PHPMailer/src/PHPMailer.php");
require_once("../../PHPMailer/src/Exception.php");
require_once("../../PHPMailer/src/SMTP.php");
// function smtpmailer($toHallOffice,$ccParent,$ccStudent,$ccWarden,$ccAssistantWarden,$ccWardenGirls,$ccHostelGS,$ccGirlsNominee,$from, $from_name, $subject, $body) 
function smtpmailer($toWarden,$ccHallOffice,$ccAcademic,$ccStudent,$ccWardenGirls="",$ccHostelGS,$ccGirlsNominee,$ccParent,$from, $from_name, $subject, $body) 
{ 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = 'ioms.hostel@iitgoa.ac.in'; 
	$mail->Password = 'hallioms@1';        
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->IsHTML(true);
	$mail->Body = $body;
	$mail->AddAddress($toWarden);
	$mail->AddCC($ccHallOffice);
	$mail->AddCC($ccAcademic);
	// $mail->AddCC($ccAssistantWarden);
	$mail->AddCC($ccHostelGS);
	$mail->AddBCC('ioms.hostel@iitgoa.ac.in');
    //$mail->AddCC($ccWardenBoys);
    if($ccParent!="")
    	$mail->AddCC($ccParent);
    // if($ccWardenGirls!="")
    // 	$mail->AddCC($ccWardenGirls);
    if($ccGirlsNominee!="")
    {
		$mail->AddCC($ccGirlsNominee);
		$mail->AddCC($ccWardenGirls);
	}
    $mail->AddCC($ccStudent);

	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
?>