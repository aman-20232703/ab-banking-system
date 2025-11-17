<?php
include 'dbconnect.php';
include 'env-loader.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../phpmail/src/Exception.php';
include '../phpmail/src/PHPMailer.php';
include '../phpmail/src/SMTP.php';

header('Content-Type: application/json');

$email = trim($_POST['email'] ?? '');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

$q = mysqli_query($conn, "SELECT name,is_verified FROM users WHERE email='$email'");
if (mysqli_num_rows($q) > 0) {
    $r = mysqli_fetch_assoc($q);
    if ($r['is_verified']) {
        echo json_encode(['success'=>false,'message'=>'Email already verified']);
        exit;
    }
    $name = $r['name'];
} else {
    mysqli_query($conn,"INSERT INTO users (email,is_verified) VALUES('$email',0)");
    // $id = mysqli_insert_id($conn);
}

$otp = rand(100000,999999);
$hash = password_hash($otp, PASSWORD_DEFAULT);
$exp  = date("Y-m-d H:i:s",strtotime("+10 minutes"));
mysqli_query($conn,"UPDATE users SET otp='$hash', otp_expires='$exp' WHERE email='$email'");

$mail = new PHPMailer(true);
loadEnv();
try {
    $mail->isSMTP();
    $mail->Host = $_ENV['mail_Host'];
    $mail->SMTPAuth=true;
    $mail->Username = $_ENV['mail_Username'];
    $mail->Password = $_ENV['mail_Password'];
    $mail->SMTPSecure='tls';
    $mail->Port = $_ENV['mail_Port'];
    $mail->setFrom ($_ENV['mail_From'],$_ENV['mail_from_user']);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject='Your AmarjeshBank OTP';
    $mail->Body="Your OTP is <b>$otp</b>. It expires in 10 minutes.";
    $mail->send();
    echo json_encode(['success'=>true,'message'=>'OTP sent to your email']);
} catch (Exception $e) {
    echo json_encode(['success'=>false,'message'=>'Mailer error']);
}

?>
