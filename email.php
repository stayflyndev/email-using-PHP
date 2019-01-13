<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';
require 'vendor/autoload.php';

// require '.env';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$email = $_POST['emails'];
$message = $_POST['message'];



$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
$option = env('USERNAME'); 


try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = option;                 // SMTP username
    $mail->Password = PASSWORD;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('aretee64@gmail.com', 'Mailer');
    $mail->addAddress('torir.adams@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('info@yourtechsis.com');               // Name is optional
    $mail->addReplyTo('info@yourtechsis.com', 'Information');

    //Content
    $mail->isHTML(true);    
    // Set email format to HTML
    $mail->Subject = 'Here is the subject';

    $mail->Body    = "<html> name: $email<br> $message </html>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>