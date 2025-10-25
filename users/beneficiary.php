<?php
include 'dbconnect.php';
session_start();

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM beneficiaries WHERE users_id = '$id'";
$result = mysqli_query($conn, $sql);

function logo($name)
{
    $words = explode(" ", trim($name));
    $log = "";
    foreach ($words as $word) {
        if (!empty($word)) {
            $log .= strtoupper($word[0]);
        }
    }
    return $log;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="customer_dash.css">
    <script src="customer_dash.js"></script>
</head>

<body>
    <div id="beneficiariesPage" class="page-content">
        <div class="mb-6 flex justify-between items-center p-4">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addAccountBtn">
                <a href="customer_dash.php">Back</a></button>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Beneficiaries</h2>
                <p class="text-gray-600 mt-2">Manage your saved beneficiaries</p>
            </div>
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addBeneficiaryBtn">
                <a href="add_beneficiary.php">+ Add Beneficiary</a></button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <div class="bg-white rounded-2xl p-6 shadow-lg card">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                            <?php $name = $data['full_name'] ?? '';
                            echo logo($name); ?>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600">⋮</button>
                    </div>
                    <div class="text-xs text-gray-600 mb-4"><?= $data['beneficiary_id'] ?? '' ?></div>
                    <div class="font-bold text-gray-800 text-lg mb-1"><?= strtoupper($data['full_name'] ?? '') ?></div>
                    <div class="text-sm text-gray-500 mb-3"><?= $data['email'] ?? '' ?></div>
                    <div class="text-xs text-gray-600 mb-4"><?= $data['account_number'] ?? '' ?></div>
                    <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                    <a href="transfers.php?type=beneficiary&id=<?=urlencode($data['beneficiary_id'])?>">  Send Money</a>
                    </button>
                </div>
            <?php } ?>

        </div>

</body>

</html>