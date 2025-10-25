<?php
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="form-side">
            <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 40px; color: #333;">🏦 AmarJeshBank</div>

            <div class="tabs">
                <div class="tab active" data-tab="login">Update Password</div>
            </div>

            <div class="form-content active" id="login-form">
                <form method="POST">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Set New Password</label>
                        <input type="password" id="login-password" name="password" required placeholder="Enter your new password">
                    </div>
                    <button type="submit" class="btn">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {
        $email = mysqli_real_escape_string($conn, $email);

        $check_sql = "SELECT id, is_verified FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $check_sql);

        if (!$result) {
            $message = "Database error: " . mysqli_error($conn);
        } elseif (mysqli_num_rows($result) == 0) {
            $message = "Email not found. Please register again.";
        } else {
            $user = mysqli_fetch_assoc($result);

            if ($user['is_verified'] != 1) {
                $message = "Email is not verified yet.";
            } else {

                $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password='$hash_pass' WHERE email='$email'";
                $update_result = mysqli_query($conn, $update_sql);

                if ($update_result) {
                    // $message = "Password updated successfully!";
                    ?><script>
                        alert ("Password updated successfully!");
                        window.location.href='index.php';
                    </script>
                    <?php
                } else {
                    $message = "Error updating password: " . mysqli_error($conn);
                }
            }
        }
    }
}?>

<?php if (!empty($message)) : ?>
<script>
    alert("<?php echo addslashes($message); ?>");
</script>
<?php endif; ?>


