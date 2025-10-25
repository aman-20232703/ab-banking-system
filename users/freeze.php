<?php
include 'dbconnect.php';
session_start();

$email = $_SESSION['user_email'];
$accounts = [];
if ($email) {
    $sql = "SELECT account_number,account_type FROM fd_rd_accounts WHERE email = '$email'
    AND account_number NOT IN (SELECT account_number FROM freeze_accounts WHERE email = '$email')
    union SELECT account_number,account_type FROM account WHERE email = '$email'
    AND account_number NOT IN(SELECT account_number FROM freeze_accounts WHERE email = '$email')
    ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $accounts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freeze Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-8">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-indigo-600 mb-4 text-center">Request to Freeze Account</h2>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block font-semibold mb-1" for="account">Select Account</label>
                <select name="account_number" id="account" required class="w-full border px-4 py-2 rounded">
                    <option value="">-- Select an Account --</option>
                    <?php foreach ($accounts as $acc): ?>
                        <option value="<?= htmlspecialchars($acc['account_number']) ?>">
                            <?= htmlspecialchars($acc['account_number']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1" for="reason">Reason for Freezing</label>
                <select name="reason" id="reason" required class="w-full border px-4 py-2 rounded">
                    <option value="">-- Select Reason --</option>
                    <option value="Lost Access">Lost Access</option>
                    <option value="Suspicious Activity">Suspicious Activity</option>
                    <option value="Temporarily Not in Use">Temporarily Not in Use</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1" for="comments">Additional Comments (optional)</label>
                <textarea name="comments" id="comments" rows="3" class="w-full border px-4 py-2 rounded resize-none"></textarea>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember" required>
                <label for="remember" style="margin: 0;">I confirm that the above information is accurate and I request account freeze.</label>
            </div>

            <div class="text-center">
                <button type="reset"
                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">
                    <a href="customer_dash.php"> Cancel</a>
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded">
                    Freeze Account
                </button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
function generate_id()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomPart = '';
    for ($i = 0; $i < 5; $i++) {
        $randomPart .= $characters[rand(0, strlen($characters) - 1)];
    }

    $referenceId = "UNF-" . $randomPart;
    return $referenceId;
}
$id = generate_id();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user_email'];
    $account = $_POST['account_number'];
    $reason = $_POST['reason'];
    $comment = trim($_POST['comments']) ?? '';

    $check = "SELECT email from freeze_accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $check);
    if (mysqli_num_rows($result) > 1) {
        echo "<script>alert('❌ Already a request is pending.')</script>";
        exit;
    } else {

        $query = "INSERT INTO freeze_accounts(reference_id,email,account_number,reason,comments) 
    VALUES ('$id','$email','$account','$reason','$comment')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('✅ Freeze request submitted successfully.');
         window.location='send_mail.php?type=freeze';</script>";
        } else {
            echo "<script>alert('❌ Failed to submit request.')</script>";
        }
    }
}
?>