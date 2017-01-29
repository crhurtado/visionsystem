<?php
/*
 * Title: Secure Contact Form
 * For: Processing form data and sending it to a specified E-mail address.
 * Author: Christiam Hurtado
 * Company: Vision System - http://www.visionsystem.com.ve
 * Last Modified: 2016-14-02
 */

// Main Variables Used Throughout the Script
$domain = "http://www.visionsystem.com.ve" . $_SERVER["HTTP_HOST"]; // Root Domain - http://example.com
$siteName = "Vision System";
$siteEmail = "visionsystemca@gmail.com";
$er = "";

// Check if the web form has been submitted
if (isset($_POST["contactEmail"])){
	
	/*
	 * Process the web form variables
	 * Strip out any malicious attempts at code injection, just to be safe.
	 * All that is stored is safe html entities of code that might be submitted.
	 */
	$contactName = htmlentities(substr($_POST["contactName"], 0, 200), ENT_QUOTES);
	$contactTelf = htmlentities(substr($_POST["contactTelf"], 0, 25), ENT_QUOTES);
	$contactEmail = htmlentities(substr($_POST["contactEmail"], 0, 100), ENT_QUOTES);	
	$messageContent = htmlentities(substr($_POST["messageContent"], 0, 10000), ENT_QUOTES);
	
	/*
	 * Perform some logic on the form data
	 * If the form data has been entered incorrectly, return an Error Message
	 */
	 
	 // Check if the data entered for the E-mail is formatted like an E-mail should be
	if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)){
		$er .= 'Por favor ingrese una direccion de correo electronico válida para contactarle .<br />';
	}
	
	// Check if the data entered for the Telf is formatted like an Ve Telf should be
	if (!preg_match ('/^[0|2|4|+][0-9]{10,15}$/',$contactTelf)){
		$er .= 'Por favor ingrese un teléfono válido para contactarle, si no es un número de Teléfono Venezolano, indicar el codigo internacional, gracias.<br />';
	}
	
	// Check if all of the form fields contain data before we allow it to be submitted successfully
	if ($contactName == "" || $contactTelf == "" || $contactEmail == "" || $messageContent == ""){
		$er .= 'Tu nombre, telefono, correo electronico y mensaje no pueden quedar en blanco, por favor llenalos e intenta de nuevo.<br />';
	}
	
	// IF NO ERROR - START
	if ($er == ''){
		
		// Prepare the E-mail elements to be sent
		$subject = $siteName . ' Contact Form ';
		$message = 
		'<html>
			<head>
			<title>' . $siteName . ': Mensaje desde el Portal Web</title>
			</head>
			<body>
			<p> Mensaje enviado por '.$contactName.'</p>
			<p> Número de Teléfono de Contacto: '.$contactTelf.'</p>
			<p> Email de Contacto: '.$contactEmail.'</p>
			<p> Mensaje: ' .$messageContent. '</p>
			</body>
		</html>';
		
		/*
		 * We are sending the E-mail using PHP's mail function
		 * To make the E-mail appear more legit, we are adding several key headers
		 * You can add additional headers later to futher customize the E-mail
		 */
		
		$to = $siteName . ' Contact Form <' . $siteEmail . '>';
		
		// To send HTML mail, the Content-type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional Headers
		$headers .= 'From: ' . $contactName . ' <' . $contactEmail . '>' . "\r\n";
		$headers .= 'Reply-To: ' . $contactName . ' <' . $contactEmail . '>' . "\r\n";
		$headers .= 'Return-Path: ' . $contactName . ' <' . $contactEmail . '>' . "\r\n";
		$headers .= 'Date: ' . date("r") . "\r\n";
		$headers .= 'X-Mailer: ' . $siteName . "\r\n";
		
		// And now, mail it
		if (mail($to, $subject, $message, $headers)){
			echo '<div id="contactform">Gracias por contactar a ' . $siteName . '. Nuestro equipo leera su mensaje y le contactará a la brevedad posible.</div>';
		}
		else {
			$er .= 'En este momento estamos inhabilitados para enviar su mensaje, por favor escribanos a ' . $siteEmail . '.<br />';
		}
	}
	// IF NO ERROR - END
}

// If web form has not been submitted, show a blank form
else {
	showContactForm();
}

/*
 * If there have been errors, we want to return notification
 * We also want to be nice, and send any data already filled in back so they don't re-enter it
 */

// If there are errors, and the contact E-mail is filled in
if ($er != '' && isset($_POST["contactEmail"])){
	showContactForm($contactName, $contactEmail, $contactTelf, $messageContent, $er);
}

// If there are errors, and the contact E-mail isn't filled in
else if ($er != '' && !isset($_POST["contactEmail"])){
	showContactForm('', '', '', '', $er);
}

// Setup a function to display a contact form
function showContactForm($contactName = "", $contactEmail = "", $messageSubject = "", $messageContent = "", $er = ''){
	echo '
	<div id="contactform">
	<div style="font-weight:bold; margin: 5px 0;">' . $er . '</div>	              	
	<form action="' . $_SERVER["REQUEST_URI"] . '" method="post" name="contactForm">		
			<ul>
				<li>
					<label for="contactName">Nombre y Apellido</label>
					<input name="contactName" type="text" size="20" maxlength="200" value="' . $contactName . '" />
				</li>
				<li>
					<label for="contactTelf">Teléfono</label>
					<input name="contactTelf" type="text" size="20" maxlength="25" value="' . $messageSubject . '" />
				</li>
				<li>
					<label for="contactEmail">Correo Electrónico</label>
					<input name="contactEmail" type="email" size="20" maxlength="100" value="' . $contactEmail . '" />
				</li>				
				<li>
					<label for="messageContent">Mensaje</label>
					<textarea name="messageContent" cols="35" rows="8">' . $messageContent . '</textarea>
				</li>
				
				<input name="submitButton" type="submit" value="Enviar Mensaje" />
			</ul>
			
	</form>
	</div>';
}
?>