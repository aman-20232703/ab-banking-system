<?php
include 'dbconnect.php';
session_start();
$email = $_SESSION['user_email'] ?? '';
$id = $_SESSION['user_id'] ?? '';

$approved = false;
$kycStatus = false;
$kycButton = false;
if ($email) {
    $sql = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $kycButton = $row['show_kyc_button'];
        $kycStatus = $row['kyc_status'];
        if ($row['status'] === 'Approved') {
            $approved = true;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Banking Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@heroicons/vue@2.0.18/24/outline/index.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="customer_dash.css">
    <script src="customer_dash.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('status.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById("application-status").innerHTML = data;
                })
                .catch(error => {
                    console.error("Error fetching status:", error);
                    document.getElementById("application-status").innerHTML = "<p class='text-danger'>Failed to load status.</p>";
                });
        });
    </script>
</head>

<body>
    <div class="flex h-screen overflow-hidden">

        <div class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col">

            <div class="p-6 flex items-center gap-3">
                <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                </svg>
                <span class="text-2xl font-bold" style="font-family:Brush Script MT,cursive;font-size: 30px; color: #333;">AmarJesh Bank</span>
            </div>


            <nav class="flex-1 px-3 py-4">
                <a href="#" class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="dashboard">
                    <span class="text-xl">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="account_open.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="open">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">Open Account</span>
                </a>
                <a href="unfreeze.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="freeze">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">UN_Freeze Account</span>
                </a>
                <?php if ($approved) { ?>
                    <a href="freeze.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="freeze">
                        <span class="text-xl">💳</span>
                        <span class="font-medium">Freeze Account</span>
                    </a>
                    <a href="accounts.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="accounts">
                        <span class="text-xl">💳</span>
                        <span class="font-medium"> FD/RD Accounts</span>
                    </a>
                    <a href="transfers.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="transfers">
                        <span class="text-xl">💸</span>
                        <span class="font-medium">Transfers</span>
                    </a>
                    <a href="beneficiary.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="beneficiaries">
                        <span class="text-xl">👥</span>
                        <span class="font-medium">Beneficiaries</span>
                    </a>
                    <!-- <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="loans">
                        <span class="text-xl">💰</span>
                        <span class="font-medium">Loans</span>
                    </a> -->
                    <!-- <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="investments">
                        <span class="text-xl">📈</span>
                        <span class="font-medium">Investments</span>
                    </a> -->
                    <!-- <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="settings">
                        <span class="text-xl">⚙️</span>
                        <span class="font-medium">Settings</span>
                    </a> -->
                <?php } ?>
                <a href="logout.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="logout">
                    <span class="text-xl">🚪</span>
                    <span class="font-medium">Logout</span>
                </a>

            </nav>
        </div>


        <div class="flex-1 overflow-y-auto">

            <div class="bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
                <div id="pageTitle" class="flex items-center gap-3">
                    <h1 class="text-4xl font-bold text-gray-800">Welcome,<span class="text-3xl">👋</span>
                        <?php echo $_SESSION['user_name'] ?? 'Guest' ?></h1>
                </div>

                <?php if ($kycStatus === 'Initiated'): ?>
                    <div class="kyc-section">
                        <a href="kyc_form.php" class="btn btn-primary">Complete Online KYC</a>
                    </div>
                <?php elseif ($kycStatus === 'Submitted'): ?>
                    <button class="btn btn-secondary" disabled></button>
                <?php endif; ?>

                <div class="flex items-center gap-4">
                    <div id="application-status" class="mt-4">
                        Loading your application status...
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-full border-2 border-white shadow-lg overflow-hidden">
                            <a href="profile.php">
                                <img
                                    src="../users/<?php echo htmlspecialchars($row['photo_path']); ?>"
                                    alt="User Photo"
                                    class="w-full h-full object-cover">
                            </a>

                        </div>
                        <div>
                            <div class="font-semibold text-gray-800"><?php echo $_SESSION['user_id'] ?? '' ?></div>
                            <div class="text-sm text-gray-500"><?php echo $_SESSION['user_email'] ?? '' ?></div>
                            <div class="text-sm text-gray-500"><?php if (!empty($row) && ($row['status'] ?? '') !== 'Freeze' && ($row['status'] ?? '') !== 'UN_freeze') {
                                                                    echo $row['account_number'] ?? '';
                                                                } else {
                                                                    echo 'No account opened or account inactive';
                                                                } ?></div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="pageContent" class="p-8">

                <div id="dashboardPage" class="page-content fade-in">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                        <div class="gradient-card rounded-3xl p-8 text-white shadow-lg">
                            <div class="text-sm font-medium mb-2 opacity-90">SAVINGS ACCOUNT</div>
                            <div class="text-lg mb-4"><?php if (!empty($row) && ($row['status'] ?? '') !== 'Freeze' && ($row['status'] ?? '') !== 'UN_freeze') {
                                                            echo $row['account_number'] ?? '';
                                                        } else {
                                                            echo 'No account opened or account inactive';
                                                        } ?></div>

                            <div class="text-sm opacity-90">Available Balance</div>
                            <div class="text-lg font-bold mb-2">₹<?php if (!empty($row) && ($row['status'] ?? '') !== 'Freeze' && ($row['status'] ?? '') !== 'UN_freeze') {
                                                                        echo $row['deposit'] ?? '';
                                                                    } else {
                                                                        echo ' ';
                                                                    } ?></div>
                        </div>


                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <div class="flex flex-col space-y-3 w-64 mx-auto mt-8">


                                <a href="mpassbook.php"
                                    class="flex items-center justify-center gap-2 bg-indigo-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 5h18M8 5v14m8-14v14M5 19h14a2 2 0 002-2V5H3v12a2 2 0 002 2z" />
                                    </svg>
                                    M-Passbook
                                </a>


                                <a href="my_card.php"
                                    class="flex items-center justify-center gap-2 bg-green-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 8.25h19.5m-19.5 0V6.375A2.625 2.625 0 014.875 3.75h14.25A2.625 2.625 0 0121.75 6.375V8.25m-19.5 0v9.375A2.625 2.625 0 004.875 20.25h14.25a2.625 2.625 0 002.625-2.625V8.25m-15 5.25h5.25" />
                                    </svg>
                                    Card Request
                                </a>


                                <a href="checkbook.php"
                                    class="flex items-center justify-center gap-2 bg-yellow-500 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 6.75h15M4.5 12h7.5m-7.5 5.25h15M3 4.5v15a1.5 1.5 0 001.5 1.5h15A1.5 1.5 0 0021 19.5v-15A1.5 1.5 0 0019.5 3h-15A1.5 1.5 0 003 4.5z" />
                                    </svg>
                                    Check Book Request
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Transactions</h3>
                            <div class="space-y-3">
                                <?php
                                $q = "SELECT * FROM transfers WHERE users_id = '$id'";
                                $res = mysqli_query($conn, $q);
                                $grouped = [];

                                if (mysqli_num_rows($res) > 0) {
                                    while ($data = mysqli_fetch_assoc($res)) {
                                        $type = $data['type'];
                                        $amount = (float) $data['amount'];
                                        if (!isset($grouped[$type])) {
                                            $grouped[$type] = 0;
                                        }
                                        $grouped[$type] += $amount;


                                ?>
                                        <div class="transaction-item flex justify-between items-center p-3 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">↑</div>
                                                <div>
                                                    <div class="font-semibold text-gray-800"><?= $data['type'] ?? '' ?></div>
                                                    <div class="text-sm text-gray-500"><?= $data['time'] ?? '' ?></div>
                                                </div>
                                            </div>
                                            <div class="font-bold text-red-600">₹<?= $data['amount'] ?? '' ?></div>
                                        </div>
                                <?php }
                                }
                                $labels_json = json_encode(array_keys($grouped));
                                $values_json = json_encode(array_values($grouped));
                                ?>
                            </div>
                        </div>
                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Account Type Distribution</h2>
                            <canvas id="myPieChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                    <script>
                        const ctx = document.getElementById('myPieChart').getContext('2d');
                        const myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: <?php echo $labels_json; ?>,
                                datasets: [{
                                    data: <?php echo $values_json; ?>,
                                    backgroundColor: [
                                        '#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0',
                                        '#9966FF', '#FF9F40'
                                    ],
                                    borderColor: '#fff',
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Account Types by Amount'
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
</body>

</html>