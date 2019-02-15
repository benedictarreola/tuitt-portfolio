<?php

	require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	session_start();

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$portfolio_email = 'benarreolasportfolio@gmail.com';
	$portfolio_name = 'Ben\'s Portfolio';

	$ben_email = 'benedictmartinii.arreola@gmail.com';
	$ben_name = 'Ben Arreola';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = $portfolio_email;                 // SMTP username
	    $mail->Password = '09252012';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
		$mail->setFrom($portfolio_email, $portfolio_name);
		$mail->addAddress( $ben_email, $ben_name);     // Add a recipient
		$mail->addAddress( $email, $name);     // Add a recipient

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Ben Arreola | Message from ' . $name;
	    $mail->Body    = $message;
	    $mail->AltBody = $message;

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
