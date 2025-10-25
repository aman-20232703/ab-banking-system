<?php
include 'dbconnect.php';
session_start();

$sql = "SELECT * FROM freeze_accounts WHERE status = 'un_freezed'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Un_Freeze Account Applications Awaiting Approval</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter] p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-indigo-600 mb-6 text-center">UN_Freeze Account Applications Awaiting Approval</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-300 text-sm">
                <thead class="bg-gray-100 text-left text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-3">Refrence_Id</th>
                        <th class="px-4 py-3">Account No</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Reason</th>
                        <th class="px-4 py-3">Comment</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50 border-t">
                            <?php $id = $row['reference_id']?>
                            <?php $email = $row['email'] ?>
                            <?php $account = $row['account_number'] ?>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['reference_id']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['account_number']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['reason']) ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($row['comments']) ?></td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" class="mt-6 flex flex-col sm:flex-row gap-4 justify-center">
                                    <button
                                        type="submit"
                                        name="approve"
                                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">
                                        ✅ Approve
                                    </button>
                                    <button
                                        type="submit"
                                        name="reject"
                                        class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow">
                                        ❌ Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['approve'])) {
    $query = "DELETE FROM freeze_accounts WHERE reference_id = '$id';
    UPDATE account SET status = 'Approved' WHERE account_number = '$account' and email = '$email';
    ";
    $conn->multi_query($query);
    // multi_query($conn, $query);
    echo "<script>
        alert('✅ Application approved successfully!');
        window.location='admin_dash.php';
    </script>";
}

if (isset($_POST['reject'])) {
    $query = "DELETE FROM freeze_accounts WHERE reference_id = '$id';
    UPDATE account SET status = 'Freeze' WHERE account_number = '$account';
    ";
    $conn->multi_query($query);
    // mysqli_query($conn, $query);
    echo "<script>
        alert('❌ Application rejected.');
        window.location='admin_dash.php';
    </script>";
}
?>