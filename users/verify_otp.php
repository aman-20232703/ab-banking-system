<?php
include 'dbconnect.php';
header('Content-Type: application/json');

$email = trim($_POST['email'] ?? '');
$otp   = trim($_POST['otp'] ?? '');

$q = mysqli_query($conn,"SELECT otp,otp_expires,is_verified FROM users WHERE email='$email'");
if (mysqli_num_rows($q)==0) {
    echo json_encode(['success'=>false,'message'=>'Email not found']); exit;
}
$r = mysqli_fetch_assoc($q);
if ($r['is_verified']) { echo json_encode(['success'=>false,'message'=>'Already verified']); exit; }
if (strtotime($r['otp_expires']) < time()) {
    mysqli_query($conn,"UPDATE users SET otp=NULL,otp_expires=NULL WHERE email='$email'");
    echo json_encode(['success'=>false,'message'=>'OTP expired']); exit;
}
if (password_verify($otp,$r['otp'])) {
    mysqli_query($conn,"UPDATE users SET is_verified=1, otp=NULL, otp_expires=NULL WHERE email='$email'");
    echo json_encode(['success'=>true,'message'=>'Email verified']);
} else {
    echo json_encode(['success'=>false,'message'=>'Wrong OTP']);
}
