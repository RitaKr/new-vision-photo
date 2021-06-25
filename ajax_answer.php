<?php
$arr = json_decode($_REQUEST['json'], true);
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
$mail->Username = ''; // email
$mail->Password = ''; // password
$mail->setFrom('maksymrylskyi@gmail.com', 'Сайт про Максима Рильського'); // From email and name
$mail->addAddress($arr["email"], $arr['name']); // to email and name
$mail->Subject = 'Ваше питання щодо Максима Рильського. Ми незабаром обробимо його';
$mail->msgHTML($arr["type"].' Ваш номер ---'.$arr["phone"]); //$mail->msgHTML(file_get_contents('contents.html'), DIR); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'Сталася технічна помилка, відправте ще раз, будь ласка.'; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if($mail->send()){
    echo "Cпасибо за ваш заказ!";
}else{
    echo "Увы, произошла ошибка при отправке электрнного письма.";
}


