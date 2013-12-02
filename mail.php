<?php
function sendMyMail($mailto, $link){
	global $config;

	$to = $mailto;
	$subject = '<MAIL_SUBJECT>';
	
	$message = "
	<html>
	 <head>
	  <title>A file has been uploaded ...</title>
	 </head>
	 <body>
	  #HTML_BODY#
	 </body>
	</html>
	";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
	$headers .= 'From: #FROM_FIELD# <#FROM_EMAIL#>' . "\r\n";
	
	mail($to, $subject, $message, $headers);
}
?>
