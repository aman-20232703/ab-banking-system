<?php
// login.php (procedural PHP)
include 'dbconnect.php';
session_start();

$errors  = "";
$success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Login button clicked
    if (isset($_POST["login"])) {
        $user_id  = trim($_POST["user_id"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($user_id === "" || $password === "") {
            $errors = "User ID and Password are required.";
        } else {
            // IMPORTANT: use the correct column name (user_id vs employee_id)
            // and use prepared statements
            $sql  = "SELECT * FROM employee WHERE employee_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                //echo $row['password'];
               
                // If you stored HASHED passwords (recommended)
                if (password_verify($password, $row['password'])) {
                    // Login success
                    $_SESSION['emp_id'] = $row['employee_id'];
                    $_SESSION['employee_name']=$row['employee_name'];
                    // optionally also store role, name, etc.
                    header("Location: sidebar.php");
                    exit;
                } else {
                    // Wrong password
                    $errors = "Invalid User ID or Password.";
                }
            } else {
                // No such user
                $errors = "Invalid User ID or Password.";
            }
        }
    }

    // Reset Password button clicked
    if (isset($_POST["reset"])) {
        header("Location: pass_reset.php");
        exit;
    }

    // Signup clicked
    if (isset($_POST["signup"])) {
        header("Location: emp_form.php");
        exit;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">
            Employee Login
        </h1>
        <p class="text-sm text-gray-500 mb-6 text-center">
            Sign in with your Employee ID to access the banking system.
        </p>

        <!-- Messages -->
        <?php if ($errors): ?>
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" action="" class="space-y-4">
            <!-- User ID -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">
                    User ID
                </label>
                <input
                    type="text"
                    id="user_id"
                    name="user_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your Employee ID"

                    required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter your password"
                    required>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col gap-3 mt-4">
                <!-- Login -->
                <button
                    type="submit"
                    name="login"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg text-sm transition">
                    Login
                </button>

                <!-- Reset Password -->
                <button
                    type="submit"
                    name="reset"
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 rounded-lg text-sm transition">
                    Reset Password
                </button>
            </div>

            <!-- Signup -->
            <div class="mt-4 text-center text-sm text-gray-600">
                New user?
                <button
                    type="submit"
                    name="signup"
                    class="text-indigo-600 font-semibold hover:underline">
                    Sign up here
                </button>
            </div>
        </form>
    </div>

</body>

</html>