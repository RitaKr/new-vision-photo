<?php
declare(strict_types = 1);

include_once 'credentials.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$arr = json_decode($_REQUEST['json'], true);
require './mail/Exception.php';
require './mail/PHPMailer.php';
require './mail/SMTP.php';


function write_email(string $to, string $subject, string $text, string $name): bool
{
    $mail = new PHPMailer;
    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL; // email
    $mail->Password = EMAIL_PASSWORD; // password
    $mail->setFrom(EMAIL, 'Сергей New Vision Photo'); // From email and name
    $mail->addAddress($to, $name); // to email and name
    $mail->Subject = $subject;
    $mail->msgHTML($text);
    $mail->AltBody = 'Произошла ошибка, попробуйте указать другой адрес.'; // If html emails is not supported by the receiver, show this body
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
                    )
                );
    if($mail->send()){
        return true;
    }else{
        return false;
    }
}

$to_customer = write_email($arr['email'], 'New Vision Photo Заказ фотосессии', 'Спасибо за ваш выбор! Я свяжусь с вами в ближайшее время для согласования деталей фотосессии. Хорошего вам настроения', $arr['name']);
$to_him = write_email('nvphotosergey@gmail.com', 'Заказ фотосессии', 'Имя: '.$arr['name'].'<br>'.' Кoмментарий: '.$arr['type'].'<br>'.' Адрес: '.$arr['email'].'<br>'.' Телефон: '.$arr['phone'], '');
if($to_customer && $to_him)
    echo 'Ваше письмо с заказом отправлено.';
else 
    echo 'Произошла ошибка при отправке электронного письма.';
