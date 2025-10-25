<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['user_email'];
$id = $_SESSION['user_id'];

$sql = "SELECT account_number, full_name FROM account WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$account_number = $user['account_number'];

// Request a checkbook
if (isset($_POST['request_checkbook'])) {
    mysqli_query($conn, "INSERT INTO checkbook (user_id, account_number) VALUES ('$id','$account_number')");
    header("Location: my_checkbook.php");
    exit;
}

// Fetch user's checkbooks
$checks_res = mysqli_query($conn, "SELECT * FROM checkbook WHERE account_number='$account_number' ORDER BY request_time DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Checkbooks</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<h1 class="text-3xl font-bold mb-6">My Checkbooks</h1>

<div class="mb-6 p-6 bg-white rounded-xl shadow-md">
    <form method="POST">
        <button name="request_checkbook" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Request Checkbook</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-md p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th>#</th>
                <th>Account</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; while($row=mysqli_fetch_assoc($checks_res)){ ?>
            <tr class="text-gray-700">
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($row['account_number']) ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <?php if($row['status']=='Approved'){ ?>
                        <a href="download_checkbook.php?id=<?= $row['request_id'] ?>" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Download</a>
                    <?php } else { ?>
                        <span class="text-gray-400">No actions</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
