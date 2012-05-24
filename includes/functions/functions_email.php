<?php

/** this function sends a custom email **/ 
function send_generic($recipient, $sender, $subject, $message, $search = "", $replace = "") 
{
	/** decode subject and email for sending **/
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$message = htmlspecialchars_decode($message, ENT_QUOTES);

	/** replace variables in subject and message **/
	$subject = str_replace($search, $replace, $subject);
	$message = str_replace($search, $replace, $message);

	/** encode subject for UTF8 **/
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";

	/** replace carriage returns with breaks **/
	$message = str_replace("\n", "<br>", $message);

	/** set headers **/
	$headers = "MIME-Version: 1.0"."\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\n";
	$headers .= "Content-Transfer-Encoding: 8bit"."\n";
	$headers .= "From: $sender"."\n";
	$headers .= "Return-Path: $sender"."\n";
	$headers .= "Reply-To: $sender";

	/** send mail **/
	mail($recipient, $subject, $message, $headers);

	return true;
}

?>