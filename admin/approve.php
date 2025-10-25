<?php
include('../dbconnect.php');
session_start();

$mobile = $_GET['mobile'] ?? '';

if (isset($_POST['approve'])) {
    $manager = $_SESSION['login_user'];
    $sql = "UPDATE account 
            SET status='Approved', reviewed_by='$manager', reviewed_at=NOW() 
            WHERE mobile='$mobile'";
    mysqli_query($conn, $sql);
    echo "<script>
        alert('✅ Application approved successfully!');
        window.location='admin_dash.php';
    </script>";
}

if (isset($_POST['reject'])) {
    $manager = $_SESSION['login_user'];
    $sql = "UPDATE account
            SET status='Rejected', reviewed_by='$manager', reviewed_at=NOW() 
            WHERE mobile='$mobile'";
    mysqli_query($conn, $sql);
    echo "<script>
        alert('❌ Application rejected.');
        window.location='admin_dash.php';
    </script>";
}

$result = mysqli_query($conn, "SELECT * FROM account WHERE mobile ='$mobile'");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter] p-8">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">Approve or Reject Account</h2>

        <div class="space-y-4 text-gray-800 text-[16px]">
            <p><span class="font-semibold">Name:</span> <?= htmlspecialchars($data['full_name']) ?></p>
            <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($data['email']) ?></p>
            <p><span class="font-semibold">Account Type:</span> <?= htmlspecialchars($data['account_type']) ?></p>
            <p><span class="font-semibold">Account Number:</span> <?= htmlspecialchars($data['account_number']) ?></p>
            <p><span class="font-semibold">KYC Status:</span> <?= htmlspecialchars($data['kyc_status']) ?></p>
        </div>

        <form method="POST" class="mt-6 flex flex-col sm:flex-row gap-4 justify-center">
            <button 
                type="submit" 
                name="approve" 
                class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow"
            >
                ✅ Approve
            </button>
            <button 
                type="submit" 
                name="reject" 
                class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow"
            >
                ❌ Reject
            </button>
        </form>
    </div>
</body>
</html>
