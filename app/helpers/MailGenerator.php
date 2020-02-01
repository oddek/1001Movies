<?php
//This is a mailLibrary found at github
//https://raw.github.com/PHPMailer/PHPMailer/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require LIB . DIRECTORY_SEPARATOR .  'PHPMailer/src/Exception.php';
require LIB . DIRECTORY_SEPARATOR .  'PHPMailer/src/PHPMailer.php';
require LIB . DIRECTORY_SEPARATOR .  'PHPMailer/src/SMTP.php';
class MailGenerator
{
	private $configs;
	private static $senderAddress = 'odde.adm@gmail.com';
	private static $senderName = 'ExamAdmin';
	private static $host = 'smtp.gmail.com';
	private static $originURL = 'localhost';


	public static function resetPassword($user, $token)
	{
		$this->configs = include('config.php');
		$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;
		// Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = self::$host;                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = self::$senderAddress;                     // SMTP username
	    $mail->Password   = $this->configs['mailPassword'];;                               // SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom(self::$senderAddress, self::$senderName);
	    $mail->addAddress($user->Email, $user->FirstName . $user->LastName);     //


	    // Content
	    $mail->isHTML(true);                                  
	    // Setemail format to HTML
	    $mail->Subject = 'PasswordReset from ExamAdmin';
	    
	    $mail->Body = "Hi there, click on this <a href=\"" . self::$originURL . "/login/resetPassword/" . $token . "\">link</a> to reset your password on our site";
	    /*$mail->Body    = '<h1>Hei ' . $user->FirstName . ' ' . $user->LastName'</h1><br><p><a href"/login/resetPassword/' . $token .'">Click here to reset your password</a></p><br><p>If you have not requested a reset, please ignore this email.</p>';*/
	    $mail->AltBody = 'Hei $user->FirstName $user->LastName. Click here to reset your password: If you have not requested a reset, please ignore this email.</p>';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
		}
}