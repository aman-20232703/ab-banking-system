<?php
include 'dbconnect.php';
session_start();

// Check if admin is logged in
// if (!isset($_SESSION['admin_email'])) {
//     header("Location: admin_login.php");
//     exit;
// }

// Fetch all card requests
$res = mysqli_query($conn, "SELECT cr.*, a.full_name, a.email FROM cards cr JOIN account a ON cr.account_number = a.account_number ORDER BY cr.created_at DESC");

// Handle Approve/Reject
if (isset($_GET['action'], $_GET['id'])) {
    $id = intval($_GET['id']);
    $action_param = $_GET['action'];

    // Fetch the card row first
    $card_res = mysqli_query($conn, "SELECT * FROM cards WHERE request_id=$id");
    $card_row = mysqli_fetch_assoc($card_res);

    if ($action_param === 'approve') {
        $action = 'Approved';

        // Generate virtual debit card details only for Virtual Debit Card
        if ($card_row['card_type'] === 'Virtual Debit Card') {
            $card_number = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT);
            $cvv = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $expiry_date = date('Y-m-d', strtotime('+3 years'));

            mysqli_query($conn, "UPDATE cards SET status='$action', card_number='$card_number', cvv='$cvv', expiry_date='$expiry_date' WHERE request_id=$id");
        } else {
            mysqli_query($conn, "UPDATE cards SET status='$action' WHERE request_id=$id");
        }
    } else {
        $action = 'Rejected';
        mysqli_query($conn, "UPDATE cards SET status='$action' WHERE request_id=$id");
    }

    header("Location: card.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Card Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Card Requests Dashboard</h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Account</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Card Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Requested At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $i = 1;
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $i++ ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['full_name']) ?> <br> <span class="text-gray-400 text-sm"><?= $row['account_number'] ?></span></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $row['card_type'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($row['status'] == 'Pending') { ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fa fa-clock me-2"></i> Pending
                                </span>
                            <?php } elseif ($row['status'] == 'Approved') { ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fa fa-check me-2"></i> Approved
                                </span>
                            <?php } else { ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fa fa-times me-2"></i> Rejected
                                </span>
                            <?php } ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $row['created_at'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <?php if ($row['status'] == 'Pending') { ?>
                                <a href="?action=approve&id=<?= $row['request_id'] ?>" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm"><i class="fa fa-check"></i> Approve</a>
                                <a href="?action=reject&id=<?= $row['request_id'] ?>" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm"><i class="fa fa-times"></i> Reject</a>
                            <?php } else { ?>
                                <span class="text-gray-400 text-sm">No actions</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>
