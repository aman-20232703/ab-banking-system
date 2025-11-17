<?php
include 'dbconnect.php';
include 'env-loader.php';
session_start();
$email = $_SESSION['user_email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../phpmail/src/Exception.php';
include '../phpmail/src/PHPMailer.php';
include '../phpmail/src/SMTP.php';

function sendMail($to, $toName, $subject, $body)
{
    $mail = new PHPMailer(true);
    loadEnv();
    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['mail_Host'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['mail_Username'];
        $mail->Password = $_ENV['mail_Password'];
        $mail->SMTPSecure = 'tls';
        $mail->Port = $_ENV['mail_Port'];
        $mail->setFrom($_ENV['mail_From'], $_ENV['mail_from_user']);
        $mail->addAddress($to, $toName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Mailer Error']);
        return false;
    }
}

$type = strtoupper($_GET['type'] ?? 'saving');
if ($type === 'FD' || $type === 'RD') {
    $sql = "SELECT * FROM fd_rd_accounts WHERE email = '$email' and account_type='$type' ORDER BY start_date DESC LIMIT 1";
} elseif ($type === 'FREEZE') {
    $sql = "SELECT * FROM freeze_accounts WHERE email = '$email'";
} else {
    $sql = "SELECT * FROM account WHERE email = '$email'";
}

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("No data found for this user.");
}

$name = $data['name'] ?? $data['full_name'] ?? '';
$account = $data['account_number'] ?? '';
$to = $email;
$toName = $name;

switch ($type) {
    case 'FD':
        $amount = $data['amount'];
        $start_date = $data['start_date'];
        $maturity = $data['maturity_date'];
        $maturity_amount = $data['maturity_amount'];

        $subject = "Your Fixed Deposit Account is Opened";
        $body = "Dear $name,<br><br>
        Congratulations! Your FD account has been successfully created.<br>
        <strong>Account Number:</strong> $account<br>
        <strong>FD Amount:</strong> ₹$amount<br>
        <strong>Start Date:</strong> $start_date<br>
        <strong>Maturity Date:</strong> $maturity<br><br>
        <strong>Maturity Amount:</strong> ₹$maturity_amount<br><br>
        Please keep this information safe.<br><br>
        Best Regards,<br>
        Amarjesh Bank.";
        break;


    case 'RD':
        $amount = $data['amount'];
        $start_date = $data['start_date'];
        $maturity = $data['maturity_date'];
        $maturity_amount = $data['maturity_amount'];

        $subject = "Your Recurring Deposit Account is Opened";
        $body = "Dear $name,<br><br>
        Congratulations! Your RD account has been successfully created.<br>
        <strong>Account Number:</strong> $account<br>
        <strong>RD Amount Monthly:</strong> ₹$amount<br>
        <strong>Start Date:</strong> $start_date<br>
        <strong>Maturity Date:</strong> $maturity<br><br>
        <strong>Maturity Amount:</strong> ₹$maturity_amount<br><br>
        Please keep this information safe.<br><br>
        Best Regards,<br>
        Amarjesh Bank.";
        break;

    case 'FREEZE':
        $reason = $data['reason'] ?? '';
        $comment = $data['comments'] ?? '';
        $subject = "Your Account Freeze Request Received";
        $body = "Dear Customer,<br><br>
        We have successfully received your request to freeze the following account.<br>
        <strong>Account Number:</strong> $account<br>
        <strong>Reason:</strong>$reason<br>
        <strong>Your comment is :</strong>$comment<br>
        Best Regards,<br>
        Amarjesh Bank.";
        break;

    default:
        $subject = "You opened a Saving Account at Amarjesh Bank";
        $body = "Dear $name,<br><br>
        Congratulations! Your Saving account has been successfully opened.<br>
        <strong>Account Number:</strong> $account<br><br>
        Please keep this information safe.<br><br>
        Best Regards,<br>
        Amarjesh Bank.";
        break;
}

$sent = sendMail($to, $toName, $subject, $body);
if ($sent) {
    echo "<script>
            alert('✅ Email send successfully.');
            window.location='customer_dash.php';
        </script>";
} else {
    echo "❌ Failed to send email.";
}
