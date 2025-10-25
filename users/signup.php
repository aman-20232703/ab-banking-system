<?php
include 'dbconnect.php';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm'] ?? '';

function respond($success, $message)
{
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if (!$name || !$email || !$phone || !$password || !$confirm) {
    respond(false, 'All fields are required.');
}

if ($password !== $confirm) {
    respond(false, 'Passwords do not match.');
}

if (strlen($password) < 8) {
    respond(false, 'Password is too short.');
}

function generateId($name) {
    $base = strtoupper(preg_replace("/\s+/", "", $name));
    $prefix = substr($base, 0, 3);
    $randomNumber = rand(1000, 9999);
    return $prefix . $randomNumber;
}

$hash_pass = password_hash($password, PASSWORD_DEFAULT);
$sql = "SELECT id, is_verified, password FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    respond(false, 'Database error during email check.');
}

if (mysqli_num_rows($result) == 0) {
    respond(false, 'Email not found. Please verify your email first.');
}

$user = mysqli_fetch_assoc($result);
if ($user['is_verified'] != 1) {
    respond(false, 'Email is not verified. Please complete OTP verification.');
}

if (!empty($user['password'])) {
    respond(false, 'This account has already completed registration.');
}

$uid = generateId($name);


$update_sql = "UPDATE users SET id='$uid', name='$name', phone='$phone', password='$hash_pass' WHERE email='$email'";
$update_result = mysqli_query($conn, $update_sql);

if ($update_result) {
    respond(true, 'Registration completed successfully.');
} else {
    respond(false, 'Error during registration.');
}
?>
