<?php
include 'dbconnect.php';
session_start();

$email = $_SESSION['user_email'];
$total_fd = 0;
$total_rd = 0;
//$penalty = 0.02;
$today = date('Y-m-d');
if ($email) {

    $sql_fd = "SELECT * FROM fd_rd_accounts WHERE email = '$email' and account_type='FD'";
    $result_fd = mysqli_query($conn, $sql_fd);
    

    if($result_fd && mysqli_num_rows($result_fd)>0){
    while ($data_fd = mysqli_fetch_assoc($result_fd)) {
        if ($data_fd['maturity_date'] === $today) {
            $total_fd += $data_fd['maturity_amount'];
        } else {
            $total_fd += $data_fd['amount'];
        }
    }
    }
    $sql_rd = "SELECT * FROM fd_rd_accounts WHERE email='$email' and account_type='RD'";
    $result_rd = mysqli_query($conn, $sql_rd);
    while($data_rd = mysqli_fetch_assoc($result_rd)){
        if ($data_rd['maturity_date'] === $today){
            $total_rd += $data_rd['maturity_amount'];
        }else{
            $total_rd += $data_rd['amount'];
        }
    }
}
else {
    echo "<p class='text-center text-danger'>User not logged in.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="customer_dash.css">
    <script src="customer_dash.js"></script>
</head>

<body>

    
    <div id="accountsPage" class="page-content">
        <div class="mb-6 flex justify-between items-center p-4">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addAccountBtn">
                <a href="customer_dash.php">Back</a></button>
            <h2 class="text-3xl font-bold text-gray-800">My Accounts</h2>

            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addAccountBtn">
                <a href="fd_form.php">+ Open FD/RD</a></button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="fd_rd_details.php?type=FD">
                <div class="rounded-2xl p-6 text-white shadow-lg bg-gradient-to-r from-purple-600 to-blue-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="text-sm opacity-90 mb-1">FIXED DEPOSIT ACCOUNT</div>
                            <div class="text-xs opacity-75"></div>
                        </div>
                        <div class="text-2xl">💰</div>
                    </div>
                    <div class="text-3xl font-bold mb-2">₹<?=$total_fd?></div>
                    <div class="text-xs opacity-90">Available Balance</div>
                </div>
            </a>

            <a href="fd_rd_details.php?type=RD">
                <div class="account-card bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="text-sm opacity-90 mb-1">RECURRING DEPOSIT ACCOUNT</div>
                            <div class="text-xs opacity-75"></div>
                        </div>
                        <div class="text-2xl">💳</div>
                    </div>
                    <div class="text-3xl font-bold mb-2">₹<?= $total_rd ?></div>
                    <div class="text-xs opacity-90">Available Balance</div>
                </div>
            </a>
        </div>

        <div class="mt-8 bg-white rounded-2xl p-6 shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Transaction History</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Date</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Description</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600">Account</th>
                            <th class="text-right py-3 px-4 font-semibold text-gray-600">Amount</th>
                            <th class="text-right py-3 px-4 font-semibold text-gray-600">Balance</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        <?php $q = "SELECT * FROM fd_rd_accounts WHERE email = '$email'";
                        $res = mysqli_query($conn,$q);
                        while ($data = mysqli_fetch_assoc($res)){
                        ?>
                        <tr class="border-b border-gray-100 transaction-item">
                            <td class="py-3 px-4 text-gray-600"><?=$data['start_date']??''?></td>
                            <td class="py-3 px-4 font-semibold text-gray-800"><?=$data['account_type']??''?></td>
                            <td class="py-3 px-4 text-gray-600"><?=$data['account_number']??''?></td>
                            <td class="py-3 px-4 text-right font-bold text-red-600"><?=$data['amount']??''?></td>
                            <td class="py-3 px-4 text-right text-gray-800"><?=$data['maturity_amount']??''?></td>
                        </tr>
                       <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>