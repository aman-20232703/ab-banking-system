<?php
include 'dbconnect.php';
session_start();

$mobile = $_GET['mobile']??'';
if (isset($_POST['verify'])) {
    $employee =  $_SESSION['employee_name'];
    $sql = "UPDATE account SET status='verified', reviewed_by='$employee', reviewed_at=NOW()
     WHERE mobile = '$mobile'";
    mysqli_query($conn, $sql);
    echo "<script>
        alert('Application verified and sent to Manager for approval.');
        window.location='employee_dash.php';
    </script>";
}

$result = mysqli_query($conn, "SELECT * FROM account WHERE mobile = '$mobile'");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Review Application</h2>

        <div class="space-y-4">
            <p><strong>Name:</strong> <?= htmlspecialchars($data['full_name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
            <p><strong>Account Type:</strong> <?= htmlspecialchars($data['account_type']) ?></p>
            <p><strong>Deposit:</strong> ₹<?= htmlspecialchars($data['deposit']) ?></p>

            <!-- ID Proof -->
            <p><strong>ID Proof:</strong>
                <?php if (!empty($data['id_proof'])): ?>
                    <a href="../users/files/<?= $data['id_proof'] ?>" class="text-blue-600 underline" target="_blank">📄 View</a> |
                    <a href="../users/files/<?= $data['id_proof'] ?>" class="text-blue-600 underline" download>⬇️ Download</a>
                <?php else: ?>
                    <span class="text-red-600">Not uploaded</span>
                <?php endif; ?>
            </p>

            <!-- Address Proof -->
            <p><strong>Address Proof:</strong>
                <?php if (!empty($data['address_proof'])): ?>
                    <a href="../users/files/<?= $data['address_proof'] ?>" class="text-blue-600 underline" target="_blank">📄 View</a> |
                    <a href="../users/files/<?= $data['address_proof'] ?>" class="text-blue-600 underline" download>⬇️ Download</a>
                <?php else: ?>
                    <span class="text-red-600">Not uploaded</span>
                <?php endif; ?>
            </p>

            <!-- KYC Status -->
            <p><strong>KYC Status:</strong>
                <span class="px-2 py-1 rounded bg-gray-200"><?= $data['kyc_status'] ?? 'Not Started' ?></span>
            </p>

            <!-- Sign -->
            <p><strong>Sign:</strong>
                <?php if (!empty($data['sign_path'])): ?>
                    <a href="../users/<?= $data['sign_path'] ?>" class="text-blue-600 underline" target="_blank">📄 View</a>
                <?php else: ?>
                    <span class="text-red-600">Not uploaded</span>
                <?php endif; ?>
            </p>

            <!-- Photo -->
            <p><strong>Photo:</strong>
                <?php if (!empty($data['photo_path'])): ?>
                    <a href="../users/<?= $data['photo_path'] ?>" class="text-blue-600 underline" target="_blank">📄 View</a>
                <?php else: ?>
                    <span class="text-red-600">Not uploaded</span>
                <?php endif; ?>
            </p>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex space-x-4">
            <form method="POST">
                <button type="submit" name="initiate_kyc"
                    class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600 disabled:opacity-50"
                    <?php if ($data['kyc_status'] === 'Submitted') echo 'disabled'; ?>>
                    📢 Initiate KYC
                </button>
            </form>

            <form method="POST">
                <button type="submit" name="verify"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                    ✅ Verify & Send to Manager
                </button>
            </form>
        </div>
    </div>

</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../phpmail/src/Exception.php';
include '../phpmail/src/PHPMailer.php';
include '../phpmail/src/SMTP.php';

if (isset($_POST['initiate_kyc'])) {
    $employee = $_SESSION['employee_name'];
    $email = $data['email'];
    $full_name = $data['full_name'];

    $update_kyc = "UPDATE account SET kyc_status='Initiated', show_kyc_button=TRUE, reviewed_by='$employee', reviewed_at=NOW() WHERE mobile = '$mobile'";
    mysqli_query($conn, $update_kyc);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ramanujan2709@gmail.com';
        $mail->Password = 'qgbqqmfzekiniuww'; // Consider using env vars or safer storage.
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('ramanujan2709@gmail.com', 'Amarjesh Bank');
        $mail->addAddress($email, $full_name);
        $mail->isHTML(true);
        $mail->Subject = 'KYC Initiation - Amarjesh Bank';
        $mail->Body = "Dear $full_name,<br><br>
        Your KYC process has been initiated. Please login and complete KYC as per instructions.
        <br><br>Regards,<br>Amarjesh Bank";

        $mail->send();

        echo "<script>
            alert('✅ KYC initiated and user notified.');
            window.location='employee_dash.php';
        </script>";
    } catch (Exception $e) {
        echo "<script>
            alert('KYC initiated, but email failed: " . $mail->ErrorInfo . "');
            window.location='employee_dash.php';
        </script>";
    }
}
?>
