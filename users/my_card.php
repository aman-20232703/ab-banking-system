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

if (isset($_POST['card_type'])) {
    $card_type = $_POST['card_type'];
    mysqli_query($conn, "INSERT INTO cards (user_id, account_number, card_type, status, created_at) VALUES ('$id','$account_number', '$card_type', 'Pending', NOW())");
    $msg = "Card request submitted successfully!";
    header("Location: my_card.php");
    exit;
}

if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    mysqli_query($conn, "DELETE FROM cards WHERE request_id=$cancel_id AND account_number='$account_number' AND status='Pending'");
    header("Location: my_card.php");
    exit;
}

$cards_res = mysqli_query($conn, "SELECT * FROM cards WHERE account_number='$account_number' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <div class="bg-indigo-600 bg-opacity-75 text-white py-5 px-6 flex justify-between items-center shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">My Cards</h1>
        <a href="customer_dash.php"
            class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition">
            ← Back to Dashboard
        </a>
    </div><br>
   

    <?php if (isset($msg)) { ?>
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded"><?= $msg ?></div>
    <?php } ?>

    <!-- Request New Card -->
    <div class="mb-8 p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-4">Request New Card</h2>
        <form method="POST" class="flex flex-col md:flex-row gap-4">
            <select name="card_type" required class="flex-1 border rounded p-2">
                <option value="">Select Card Type</option>
                <option value="Virtual Debit Card">Virtual Debit Card</option>
                <option value="Physical Debit Card">Physical Debit Card</option>
                <option value="Credit Card">Credit Card</option>
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition font-semibold">
                Request Card
            </button>
        </form>
    </div>

    <!-- Display Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while ($card = mysqli_fetch_assoc($cards_res)) {
            // Set card colors based on type
            $bgColor = $card['card_type'] === 'Virtual Debit Card' ? 'bg-indigo-600' : ($card['card_type'] === 'Physical Debit Card' ? 'bg-green-600' : 'bg-yellow-500');
            $textColor = 'text-white';
        ?>
            <div class="<?= $bgColor ?> <?= $textColor ?> rounded-2xl shadow-lg p-6 relative overflow-hidden hover:scale-105 transform transition duration-300">
                <div class="flex justify-between items-center mb-6">
                    <div class="text-xl font-bold"><?= htmlspecialchars($card['card_type']) ?></div>
                    <?php
                    if ($card['card_type'] === 'Virtual Debit Card') echo '<i class="fa fa-mobile-screen-button text-2xl"></i>';
                    elseif ($card['card_type'] === 'Physical Debit Card') echo '<i class="fa fa-credit-card text-2xl"></i>';
                    elseif ($card['card_type'] === 'Credit Card') echo '<i class="fa fa-cc-visa text-2xl"></i>';
                    ?>
                </div>

                <!-- Card Number -->
                <div class="text-lg tracking-widest mb-4">
                    <?php
                    if ($card['card_number']) {
                        $masked = str_repeat('*', 12) . substr($card['card_number'], -4);
                        echo $masked;
                    } else {
                        echo '**** **** **** ****';
                    }
                    ?>
                </div>

                <!-- CVV and Expiry -->
                <div class="flex justify-between mb-4 text-sm">
                    <div>CVV: <?= $card['cvv'] ? '***' : '***' ?></div>
                    <div>Expiry: <?= $card['expiry_date'] ?? 'MM/YY' ?></div>
                </div>

                <!-- Status -->
                <div class="text-sm mb-4">
                    Status:
                    <?php if ($card['status'] == 'Pending') { ?>
                        <span class="font-semibold text-yellow-200"><i class="fa fa-clock me-1"></i>Pending</span>
                    <?php } elseif ($card['status'] == 'Approved') { ?>
                        <span class="font-semibold text-green-200"><i class="fa fa-check me-1"></i>Approved</span>
                    <?php } else { ?>
                        <span class="font-semibold text-red-200"><i class="fa fa-times me-1"></i>Rejected</span>
                    <?php } ?>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-2">
                    <?php if ($card['status'] == 'Pending') { ?>
                        <a href="?cancel_id=<?= $card['request_id'] ?>" class="w-full text-center bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                            Cancel Request
                        </a>
                    <?php } elseif ($card['status'] == 'Approved') { ?>
                        <button onclick="showDetails('<?= $card['card_number'] ?>','<?= $card['cvv'] ?>','<?= $card['expiry_date'] ?>')" class="w-full bg-indigo-700 text-white py-2 rounded-lg font-semibold hover:bg-indigo-800 transition">
                            View Details
                        </button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (mysqli_num_rows($cards_res) == 0) { ?>
            <div class="col-span-full text-center text-gray-500 font-semibold">
                No cards available.
            </div>
        <?php } ?>
    </div>

    <!-- Modal for Card Details -->
    <div id="cardModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-xl p-6 w-80 relative">
            <span onclick="closeModal()" class="absolute top-3 right-4 cursor-pointer text-gray-600 text-lg">&times;</span>
            <h2 class="text-xl font-semibold mb-4">Card Details</h2>
            <p><strong>Card Number:</strong> <span id="modalCardNumber"></span></p>
            <p><strong>CVV:</strong> <span id="modalCVV"></span></p>
            <p><strong>Expiry Date:</strong> <span id="modalExpiry"></span></p>
        </div>
    </div>

    <script>
        function showDetails(number, cvv, expiry) {
            document.getElementById('modalCardNumber').textContent = number;
            document.getElementById('modalCVV').textContent = cvv;
            document.getElementById('modalExpiry').textContent = expiry;
            document.getElementById('cardModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('cardModal').classList.add('hidden');
        }
    </script>

</body>

</html>