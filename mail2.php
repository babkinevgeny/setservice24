<?php

 	include ('mail/recaptchalib.php');

    $privatekey = "6LcW7lcUAAAAALRE92Qk7ZQD5-Ru1AQJ7cv-JPDL";
    $reCaptcha = new ReCaptcha($privatekey);

	$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );

    if (!$response->success) die ('Error. Please try again');



	require 'mail/Exception.php';
	require 'mail/PHPMailer.php';
	require 'mail/SMTP.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


  $mail = new PHPMailer(true);                         // Passing `true` enables exceptions
	try {

      $organization = $_POST['organization'];
      $tel = $_POST['tel'];
	    //Recipients
	    $mail->setFrom('justsomeemail@gmail.com');
	    $mail->addAddress('9290355@gmail.com');     // Add a recipient

	    //Content
	    $mail->isHTML(true);
	    $mail->Subject = 'Заявка с сайта setservice24.ru';
	    $mail->Body    = "Имя или название организации: $organization<br>Телефон: $tel";

      $mail->CharSet = "utf-8";
	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}