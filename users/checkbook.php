<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['user_email'];
$id = $_SESSION['user_id'];

// Get account number
$sql = "SELECT account_number, full_name FROM account WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$accData = mysqli_fetch_assoc($result);
$account_number = $accData['account_number'];

function CheckRequestID()
{
    $prefix = "CHK";
    $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
    return $prefix . $random;
}
$cid = CheckRequestID();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pages = intval($_POST['pages']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');
    $date = date('Y-m-d H:i:s');

    $pendingCheck = mysqli_query($conn, "SELECT * FROM checkbook WHERE account_number='$account_number' AND status='Pending'");
    if (mysqli_num_rows($pendingCheck) > 0) {
        echo "<script>alert('⚠️ You already have a pending checkbook request. Please wait for approval before submitting another.'); window.location.href='checkbook.php';</script>";
        exit;
    }

    $query = "INSERT INTO checkbook (request_id,users_id,account_number, pages, notes, status, request_time)
              VALUES ('$cid','$id','$account_number', '$pages', '$notes', 'Pending', '$date')";
    mysqli_query($conn, $query);

    echo "<script>alert('✅ Checkbook request submitted successfully.'); window.location.href='checkbook.php';</script>";
    exit;
}

$reqQuery = "SELECT * FROM checkbook WHERE account_number='$account_number' ORDER BY request_time DESC";
$reqResult = mysqli_query($conn, $reqQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Book Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        .checkbook-card {
            perspective: 1000px;
        }

        .checkbook-inner {
            position: relative;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .checkbook-card:hover .checkbook-inner {
            transform: rotateY(180deg);
        }

        .checkbook-front,
        .checkbook-back {
            position: absolute;
            backface-visibility: hidden;
            border-radius: 1rem;
            overflow: hidden;
        }

        .checkbook-back {
            transform: rotateY(180deg);
        }
    </style>
</head>

<body class="bg-gray-50 font-inter">

    <!-- Header -->
    <div class="bg-indigo-600 text-white py-5 px-6 flex justify-between items-center shadow-md">
        <h1 class="text-2xl font-bold flex items-center gap-2">
            <i class="fas fa-book"></i> Check Book Request
        </h1>
        <a href="customer_dash.php"
            class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition">
            ← Back to Dashboard
        </a>
    </div>

    <div class="max-w-5xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-xl">

        <!-- Request Form -->
        <h2 class="text-xl font-bold text-gray-800 mb-4">Request a New Checkbook</h2>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Account Number</label>
                <input type="text" readonly value="<?= htmlspecialchars($account_number) ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Pages</label>
                <select name="pages" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                    <option value="">--Select Pages--</option>
                    <option value="25">25 Pages</option>
                    <option value="50">50 Pages</option>
                    <option value="100">100 Pages</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600"
                    placeholder="Any special instructions..."></textarea>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition flex justify-center items-center gap-2">
                <i class="fas fa-paper-plane"></i> Submit Request
            </button>
        </form>

    
        <h2 class="text-xl font-bold text-gray-800 mt-10 mb-4">My Checkbooks</h2>

        <?php if (mysqli_num_rows($reqResult) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($req = mysqli_fetch_assoc($reqResult)): ?>
                    <?php
                    $statusColor = $req['status'] === 'Approved' ? 'bg-green-500' : ($req['status'] === 'Rejected' ? 'bg-red-500' : 'bg-yellow-500');
                    ?>
                    <div class="checkbook-card">
                        <div class="checkbook-inner">
                            
                            <div class="checkbook-front <?= $statusColor ?> text-white p-6 shadow-lg">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Checkbook Request</h3>
                                    <i class="fas fa-book text-3xl opacity-80"></i>
                                </div>
                                <p class="text-sm mb-2"><strong>Request ID:</strong> <?= $req['request_id'] ?></p>
                                <p class="text-sm mb-2"><strong>Pages:</strong> <?= $req['pages'] ?></p>
                                <p class="text-sm mb-2"><strong>Status:</strong> <?= $req['status'] ?></p>
                                <p class="text-sm"><strong>Requested On:</strong> <?= $req['request_time'] ?></p>
                            </div>

                            
                            <div class="checkbook-back bg-white text-gray-800 p-6 shadow-lg">
                                <h3 class="font-bold text-lg mb-2 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-indigo-600"></i> Request Details
                                </h3>
                                <?php if ($req['notes']): ?>
                                    <p class="text-sm mb-2"><strong>Notes:</strong> <?= htmlspecialchars($req['notes']) ?></p>
                                <?php else: ?>
                                    <p class="text-sm text-gray-500">No special notes added.</p>
                                <?php endif; ?>
                                <?php if ($req['status'] === 'Approved'): ?>
                                    <a href="download.php?id=<?= $req['request_id'] ?>"
                                        class="mt-4 inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                        <i class="fas fa-download"></i> Download Checkbook
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-10 text-gray-500 text-lg">
                No checkbook requests found.
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-center text-gray-500 text-sm mt-10 pb-6">
        © <?= date('Y') ?> AmarJesh Bank. All rights reserved.
    </footer>

</body>

</html>