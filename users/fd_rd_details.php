<?php
include 'dbconnect.php';
session_start();
$email = $_SESSION['user_email'];
$type = $_GET['type'] ?? '';

$sql = "SELECT * FROM fd_rd_accounts WHERE email = '$email' AND account_type = '$type'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your <?= htmlspecialchars($type) ?> Accounts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Inter] p-8">
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-6 text-indigo-600">Your <?= strtoupper(htmlspecialchars($type)) ?> Accounts</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border text-sm text-gray-700">
                    <thead class="bg-indigo-100 text-gray-800 font-semibold">
                        <tr>
                            <th class="py-3 px-4 border">Status</th>
                            <th class="py-3 px-4 border">Account Number</th>
                            <th class="py-3 px-4 border">Name</th>
                            <th class="py-3 px-4 border">DOB</th>
                            <th class="py-3 px-4 border">Email</th>
                            <th class="py-3 px-4 border">Phone</th>
                            <th class="py-3 px-4 border">Amount</th>
                            <th class="py-3 px-4 border">Maturity_date</th>
                            <th class="py-3 px-4 border">Maturity_amount</th>
                            <th class="py-3 px-4 border">Nominee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($result)): ?>
                            <?php $status = $data['status'];
                            $amount = $data['amount']?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['status']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['account_number']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['name']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['dob']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['email']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['phone']) ?></td>
                                <td class="py-2 px-4 border">₹<?= htmlspecialchars($data['amount']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['maturity_date']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['maturity_amount']) ?></td>
                                <td class="py-2 px-4 border"><?= htmlspecialchars($data['nominee']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 mt-4">No <?= strtoupper(htmlspecialchars($type)) ?> accounts found.</p>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <a href="accounts.php" class="inline-block px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                Go Back
            </a>
        </div>
    </div>
</body>
</html>
<?php
if($status === 'freeze' && strtotime($data['maturity_date'])<(date('Y-m-d'))){
   $q = "DELETE FROM fd_rd_accounts WHERE status = 'freeze';
    UPDATE account SET deposit = deposit + $amount WHERE email = '$email';";
    $conn->multi_query($q);
}else if($status === 'freeze' && strtotime($data['maturity_date'])>=(date('Y-m-d'))){
     $q = "DELETE FROM fd_rd_accounts WHERE status = 'freeze';
    UPDATE account SET deposit = deposit + {$data['maturity_amount']} WHERE email = '$email';";
    $conn->multi_query($q);
}
?>