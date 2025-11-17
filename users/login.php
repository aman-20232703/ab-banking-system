<?php
include 'dbconnect.php';
session_start();
?>

<?php
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

function respond($success, $message)
{
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if (!$email || !$password){
    respond(false,'All fields are required.');
}
if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $sql = "SELECT s.id,s.name,s.email,s.password FROM users s WHERE email = '$email'";
    //$sql = "SELECT s.id,s.name,s.email,s.password,a.account_number,a.photo_path FROM users s ,account a where s.email = '$email' ";
}
else{
    $sql = "SELECT s.id,s.name,s.email,s.password FROM users s WHERE email = '$email'";
    //$sql = "SELECT s.id,s.name,s.email,s.password,a.account_number,a.photo_path FROM users s ,account a where s.email = '$email' ";
}

$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);

    if(password_verify($password,$user['password'])){
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];
        //$_SESSION['user_account'] = $user['account_number'];
        //$_SESSION['user_photo'] = $user['photo_path'];
        respond(true,'Login Successful.');
    }
    else{
        respond(false,'Invalid Password.');
    }
}
else{
    respond(false,'User not found.' );
}

?>