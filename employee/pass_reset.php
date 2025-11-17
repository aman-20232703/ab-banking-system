<?php
// reset_password.php (procedural approach)
include 'dbconnect.php';
session_start();

$errors  = "";
$success = "";

// Step 1 — User enters ID or email and starts reset
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_link"])) {
    
    $input = trim($_POST["identifier"]);

    if ($input === "") {
        $errors = "Please enter your User ID or Email.";
    } else {
        // ✅ IMPORTANT: make sure this table name matches your DB
        // If your table is actually named `employee`, change BOTH queries to `employee`
        $sql  = "SELECT * FROM employee WHERE employee_email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            // prepare failed – SQL error (wrong table/column/etc.)
            $errors = "Database error (step 1): " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "s", $input);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 0) {
                $errors = "No account found with this User ID or Email.";
            } else {
                $_SESSION["reset_user"] = $input;
                $success = "User verified. Now reset your password below.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

// Step 2 — User sets new password
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_password"])) {

    $new_pass     = trim($_POST["new_password"]);
    $confirm_pass = trim($_POST["confirm_password"]);
    $identifier   = $_SESSION["reset_user"] ?? "";

    if ($identifier === "") {
        $errors = "Session expired. Please start again.";
    } elseif ($new_pass === "" || $confirm_pass === "") {
        $errors = "Both password fields are required.";
    } elseif ($new_pass !== $confirm_pass) {
        $errors = "Passwords do not match.";
    } elseif (strlen($new_pass) < 6) {
        $errors = "Password must be at least 6 characters.";
    } else {
        $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

        // ✅ Same table name as above
        $sql  = "UPDATE employee SET password = ? WHERE employee_email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            $errors = "Database error (step 2): " . mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $hashed, $identifier);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Password reset successfully!";
               // header("Location:login.php");
                unset($_SESSION["reset_user"]);
            } else {
                $errors = "Could not reset password. Try again.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Employee Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Reset Password
        </h1>
        <p class="text-center text-gray-500 mb-6 text-sm">
            Recover access to your employee account
        </p>

        <!-- Errors -->
        <?php if ($errors): ?>
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
            <?= htmlspecialchars($errors) ?>
        </div>
        <?php endif; ?>

        <!-- Success -->
        <?php if ($success): ?>
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
            <?= htmlspecialchars($success) ?>
        </div>
        <?php endif; ?>


        <!-- Step 1: Verify user -->
        <?php if (!isset($_SESSION["reset_user"])): ?>
        <form method="POST" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Enter User ID or Email
                </label>
                <input type="text" name="identifier"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g. employee01 or user@mail.com">
            </div>

            <button type="submit" name="send_link"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                Verify Account
            </button>

            <a href="login.php" class="block text-center text-sm text-gray-600 hover:underline">
                Back to Login
            </a>

        </form>
        <?php endif; ?>


        <!-- Step 2: Reset password -->
        <?php if (isset($_SESSION["reset_user"])): ?>
        <form method="POST" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    New Password
                </label>
                <input type="password" name="new_password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm New Password
                </label>
                <input type="password" name="confirm_password"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit" name="reset_password"
                class="w-full bg-green-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
                Reset Password
            </button>

            <a href="login.php" class="block text-center text-sm text-gray-600 hover:underline">
                Back to Login
            </a>

        </form>
        <?php endif; ?>

    </div>
</body>
</html>
