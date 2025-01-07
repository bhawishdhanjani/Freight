<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['Contact-Name-2']);
    $email = htmlspecialchars($_POST['Contact-Email-2']);
    $phone = htmlspecialchars($_POST['Contact-Phone-2']);
    $company = htmlspecialchars($_POST['Contact-Company-2']);
    $message = htmlspecialchars($_POST['Contact-Message-2']);

    $mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bhawishdhanjanii@gmail.com';                     //SMTP username
    $mail->Password   = '########';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to
    //Recipients
    $mail->setFrom('bhawishdhanjanii@gmail.com', 'Bhawish Sender');
    $mail->addAddress('bhawishdhanjanitemp@gmail.com', 'Bhawish Reciver');  //Add a recipient
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "New Contact Form Submission";
        $mail->Body = "
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Message:</strong><br>$message</p>
        ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    http_response_code(200);
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    http_response_code(500);
}
}
else{
    http_response_code(400);
    echo "Invalid request.";
}
?>