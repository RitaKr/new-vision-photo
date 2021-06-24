<?php
  // Преобразуем JSON-данные в массив
  $arr = json_decode($_POST['json'], true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './mail/Exception.php';
require './mail/PHPMailer.php';
require './mail/SMTP.php';


$mail = new PHPMailer;
$mail->CharSet = "utf-8";

$mail->isSMTP();

$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'maksymrylskyi@gmail.com'; // email
$mail->Password = 'A4a>%^cqPYVd^E{E'; // password
$mail->setFrom('maksymrylskyi@gmail.com', 'Сайт про Максима Рильського'); // From email and name
$actuallname = $_POST["name"];
$mail->addAddress($_POST["email"], $actuallname); // to email and name
$mail->Subject = 'Ваше питання щодо Максима Рильського. Ми незабаром обробимо його';
$mail->msgHTML($_POST["message"].' Ваш номер ---'.$_POST["phone"]); //$mail->msgHTML(file_get_contents('contents.html'), DIR); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'Сталася технічна помилка, відправте ще раз, будь ласка.'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
/*if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}*/

if(!$mail->send()){
    echo "alert('Сталася помилка, будь ласка, повторіть запит.')";
}else{
    echo "alert('Прекрасно! Ваш лист надійшов.')";
}

