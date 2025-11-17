<?php
include 'dbconnect.php';
session_start();

$res = mysqli_query($conn, "SELECT cb.*, a.full_name, a.email FROM checkbook cb JOIN account a ON cb.account_number = a.account_number ORDER BY cb.request_time DESC");


if(isset($_GET['action'], $_GET['id'])){
    $id = $_GET['id'];
    $action = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';
    mysqli_query($conn, "UPDATE checkbook SET status='$action' WHERE request_id='$id'");
    header("Location: checkbook.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Checkbook Requests</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<h1 class="text-3xl font-bold mb-6">Checkbook Requests Dashboard</h1>

<div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th>#</th>
                <th>Account</th>
                <th>Email</th>
                <th>Pages</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; while($row=mysqli_fetch_assoc($res)){ ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($row['full_name']) ?> <br><span class="text-gray-400"><?= $row['account_number'] ?></span></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= $row['pages'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['request_time'] ?></td>
                <td>
                    <?php if($row['status']=='Pending'){ ?>
                        <a href="?action=approve&id=<?= $row['request_id'] ?>" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Approve</a>
                        <a href="?action=reject&id=<?= $row['request_id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Reject</a>
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
