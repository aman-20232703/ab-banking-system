<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['user_email'];

// Get account number
$sql = "SELECT account_number FROM account WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$accData = mysqli_fetch_assoc($result);
$account_number = $accData['account_number'];

// Fetch transactions (transfers)
$query = "
    SELECT `from`, `to`, `amount`, `type`, `description`, `time`
    FROM transfers
    WHERE `from` = '$account_number' OR `to` = '$account_number'
    ORDER BY time DESC
";
$res = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Passbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-inter">

    <!-- Header -->
    <div class="bg-indigo-600 text-white py-5 px-6 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold">📘 M-Passbook</h1>
        <a href="customer_dash.php"
           class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Content -->
    <div class="max-w-5xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-xl">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Account Number: <span class="text-indigo-600"><?= htmlspecialchars($account_number) ?></span>
        </h2>

        <?php if (mysqli_num_rows($res) > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date & Time</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">From</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">To</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Amount</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php while ($row = mysqli_fetch_assoc($res)): 
                            $isCredit = ($row['to'] == $account_number);
                        ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-600"><?= $row['time'] ?></td>
                            <td class="px-4 py-3 text-sm font-medium <?= $isCredit ? 'text-green-600' : 'text-red-600' ?>">
                                <?= $isCredit ? 'Credit' : 'Debit' ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600"><?= $row['from'] ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600"><?= $row['to'] ?></td>
                            <td class="px-4 py-3 text-sm text-right font-semibold <?= $isCredit ? 'text-green-600' : 'text-red-600' ?>">
                                <?= $isCredit ? '+₹' . number_format($row['amount'], 2) : '-₹' . number_format($row['amount'], 2) ?>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600"><?= htmlspecialchars($row['description']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-10 text-gray-500 text-lg">
                No transactions found yet.
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm mt-10 pb-6">
        © <?= date('Y') ?> YourBank. All rights reserved.
    </footer>

</body>
</html>
