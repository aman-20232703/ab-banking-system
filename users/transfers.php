<?php
include 'dbconnect.php';
session_start();
$uid = $_SESSION['user_id'];


if (isset($_GET['ajax']) && $_GET['ajax'] === 'getBeneficiaryById' && isset($_GET['id'])) {
    header('Content-Type: application/json');
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $result = mysqli_query($conn, "SELECT account_number, full_name FROM beneficiaries WHERE beneficiary_id = '$id'");
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'account_number' => $data['account_number'],
            'full_name' => $data['full_name']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Beneficiary not found']);
    }
    exit; 
}

$email = $_SESSION['user_email'];
$sql = "SELECT account_number FROM account WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

$res = mysqli_query($conn, "SELECT * FROM transfers WHERE users_id = '$uid' ORDER BY time DESC LIMIT 3");

$prefillBeneficiary = null;
if (isset($_GET['type']) && $_GET['type'] === 'beneficiary' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $bQuery = "SELECT account_number, full_name FROM beneficiaries WHERE beneficiary_id = '$id'";
    $bResult = mysqli_query($conn, $bQuery);
    if ($bResult && mysqli_num_rows($bResult) > 0) {
        $prefillBeneficiary = mysqli_fetch_assoc($bResult);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="customer_dash.css">
    <script src="customer_dash.js"></script>
</head>

<body>

    <div id="transfersPage" class="page-content">
        <div class="mb-6 flex justify-between items-center p-8">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addAccountBtn">
                <a href="customer_dash.php">Back</a></button>
            <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
                <h2 class="text-3xl font-bold text-gray-800">
                    Transfer Money <br>
                    <span class="text-gray-600 font-normal">
                        Send money to your accounts or other beneficiaries
                    </span>
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-xl font-bold text-gray-800 mb-6">New Transfer</h3>
                <form id="transferForm" method="post">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">From Account</label>
                        <select name="from" readonly class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                            <option value=" ">--Select Account Number--</option>
                            <option value="<?= $data['account_number'] ?>"><?= $data['account_number'] ?></option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Transfer Type</label>
                        <select id="transferType" name="type" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                            <option value=" ">--Select Account Type--</option>
                            <option value="own">To RD Account</option>
                            <option value="beneficiary">To Beneficiary</option>
                            <!-- <option value="external">External Transfer</option> -->
                        </select>

                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">To Account</label>
                        <select id="toAccount" name="to" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                            <option value="">--Select Account Number--</option>
                        </select>
                        <p id="accountHolder" class="mt-2 text-sm text-gray-600 font-semibold"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Amount</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-600 text-lg">₹</span>
                            <input type="number" id="availableAmount" name="amount" class="input-field w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" placeholder="0.00" step="0.01" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                        <textarea name="descript" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" rows="3" placeholder="Add a note..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-lg font-bold text-lg btn-primary">
                        Transfer Now
                    </button>
                </form>
            </div>

            <!-- Recent Transfers -->

            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Recent Transfers</h3>
                <div class="space-y-4">
                    <?php while ($d = mysqli_fetch_assoc($res)) { ?>
                        <div class="p-4 border border-gray-200 rounded-lg transaction-item">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="font-semibold text-gray-800">To <?= $d['type'] ?></div>
                                    <div class="text-sm text-gray-500"><?= $d['time'] ?></div>
                                </div>
                                <div class="font-bold text-indigo-600">₹<?= $d['amount'] ?></div>
                            </div>
                            <div class="text-xs text-gray-600">From:<?= $d['from'] ?></div>
                            <div class="text-xs text-gray-600">To:<?= $d['to'] ?></div>
                            <div class="text-xs text-gray-600">Reason:<?= $d['description'] ?></div>
                            <div class="mt-2 inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            const transferType = document.getElementById("transferType");
            const toAccount = document.getElementById("toAccount");
            const accountHolder = document.getElementById("accountHolder");
            const availableAmount = document.getElementById("availableAmount");

            let accountData = {}; // Store account_number => amount (for "own" type)

            // ✅ Prefill data if coming from beneficiary page
            const urlParams = new URLSearchParams(window.location.search);
            const prefillType = urlParams.get("type");
            const prefillId = urlParams.get("id");

            // If coming from beneficiary page
            if (prefillType === "beneficiary" && prefillId) {
                try {
                    // const response = await fetch(`getBeneficiaryById.php?id=${encodeURIComponent(prefillId)}`);
                    const response = await fetch(`transfers.php?ajax=getBeneficiaryById&id=${encodeURIComponent(prefillId)}`);
                    const data = await response.json();

                    if (data.success) {
                        // Autofill transfer type
                        transferType.value = "beneficiary";

                        // Create account option
                        const option = document.createElement("option");
                        option.value = data.account_number;
                        option.textContent = data.account_number;
                        option.dataset.name = data.full_name;

                        toAccount.appendChild(option);
                        toAccount.value = data.account_number;

                        // Display name
                        accountHolder.textContent = `Account Holder: ${data.full_name}`;
                    } else {
                        console.warn("Beneficiary not found:", data.message);
                    }
                } catch (error) {
                    console.error("Error fetching beneficiary:", error);
                }
            }

            // ✅ When transfer type changes (manual use)
            transferType.addEventListener("change", async function() {
                const type = transferType.value.trim();
                toAccount.innerHTML = '<option value="">--Select Account Number--</option>';
                accountHolder.textContent = "";
                availableAmount.value = "";

                if (!type) return;

                try {
                    const response = await fetch(`getTransfers.php?type=${encodeURIComponent(type)}`);
                    const data = await response.json();

                    if (!data.success) {
                        alert(data.message || "No accounts found.");
                        return;
                    }

                    accountData = {};

                    if (type === "own" && data.data) {
                        // Array of objects [{account_number, amount}, ...]
                        data.data.forEach(item => {
                            const option = document.createElement("option");
                            option.value = item.account_number;
                            option.textContent = item.account_number;
                            toAccount.appendChild(option);
                            accountData[item.account_number] = item.amount;
                        });
                    }

                    if (type === "beneficiary" && data.data) {
                        Object.entries(data.data).forEach(([name, acc]) => {
                            const option = document.createElement("option");
                            option.value = acc;
                            option.textContent = acc;
                            option.dataset.name = name;
                            toAccount.appendChild(option);
                        });
                    }

                } catch (error) {
                    console.error("Error fetching accounts:", error);
                    alert("Error fetching account list.");
                }
            });

            // ✅ When user selects "To Account"
            toAccount.addEventListener("change", function() {
                const selectedOption = toAccount.options[toAccount.selectedIndex];
                if (!selectedOption || selectedOption.value === "") {
                    accountHolder.textContent = "";
                    availableAmount.value = "";
                    return;
                }

                const type = transferType.value.trim();

                if (type === "own") {
                    const amount = accountData[selectedOption.value] || "";
                    availableAmount.value = amount;
                    accountHolder.textContent = "";
                } else if (type === "beneficiary") {
                    const name = selectedOption.dataset.name || "";
                    accountHolder.textContent = name ? `Account Holder: ${name}` : "";
                    availableAmount.value = "";
                }
            });
        });
    </script>


</body>

</html>

<?php

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $res = mysqli_query($conn, "SELECT account_number,full_name FROM beneficiaries WHERE beneficiary_id = '$id'");
//     $data = mysqli_fetch_assoc($res);
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['from'];
    $type = $_POST['type'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];
    $descript = $_POST['descript'] ?? ' ';


    $res = mysqli_query($conn, "SELECT deposit FROM account  WHERE account_number = '$from' ");
    $data = mysqli_fetch_assoc($res);
    if ($data['deposit'] <= $amount) {
        echo "<script>
        alert('❌ You don\'t have sufficient amount.');
        </script>";
        exit;
    } else {

        $query = "INSERT INTO transfers(`users_id`,`from`,`type`,`to`,`amount`,`description`)
    VALUES('$uid','$from','$type','$to','$amount','$descript')";
        mysqli_query($conn, $query);

        if ($type === 'own') {
            $q = "UPDATE fd_rd_accounts SET amount = amount + $amount WHERE account_number = '$to';
        UPDATE account SET deposit = deposit - $amount WHERE account_number = '$from';
        ";
            $conn->multi_query($q);
        } else if ($type === 'beneficiary') {
            $q = "UPDATE account SET deposit = deposit + $amount WHERE account_number = '$to';
        UPDATE account SET deposit = deposit - $amount WHERE account_number = '$from';
         ";
            $conn->multi_query($q);
        }
        echo "<script>
            alert('✅ Amount Transfer Successfully.');
            window.location = 'transfers.php';
        </script>";
    }
}

?>