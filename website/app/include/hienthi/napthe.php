<?php
require_once __DIR__."/../config/database.php";
require_once __DIR__."/../../theme/head.php";
require_once __DIR__."/../../theme/header.php";

if(!isset($_SESSION['user'])){
	header('location: /');
}
 include  "library/phpmailer/src/PHPMailer.php";
include  "library/phpmailer/src/Exception.php";
include  "library/phpmailer/src/OAuth.php";
include  "library/phpmailer/src/POP3.php";
include  "library/phpmailer/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// End
// Mail config
    $mail = new PHPMailer(true);  
    
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Mailer = "smtp";
    $mail->Host = 'smtp.gmail.com';  // host gửi mail 
    $mail->SMTPAuth = true;                               // Kích hoạt tài khoản
    $mail->Username = 'sourcegiare@gmail.com';                 // SMTP tên đăng nhập
    $mail->Password = 'ahihidongu';                           // SMTP Mật khẩu
    $mail->SMTPSecure = 'tls';                            // mã hóa mail
    $mail->Port = 587;  // Port gửi mail 
require_once __DIR__. "/../page/napthe.php";
require_once __DIR__. '/../xuly/napthe.php';
require_once __DIR__. "/../../theme/footer.php";
?>