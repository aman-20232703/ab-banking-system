<?php
include 'dbconnect.php';
// admin_employee_requests.php

// ---- DB CONNECTION (procedural) ----


// ---- HANDLE FORM SUBMIT (CREATE CREDENTIALS) ----
$success_message = "";
$error_message   = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "create_credentials") {

    $request_id = intval($_POST["request_id"]);
    $user_id    = trim($_POST["user_id"]);
    $password   = trim($_POST["password"]);

    if ($request_id <= 0 || $user_id === "" || $password === "") {
        $error_message = "All fields are required.";
    } else {
        // Fetch request details
        $sql_req = "SELECT * FROM employee WHERE id = $request_id AND status = 'pending'";
        $result_req = mysqli_query($conn, $sql_req);

        if ($result_req && mysqli_num_rows($result_req) === 1) {
            $req_data = mysqli_fetch_assoc($result_req);
            $role     = mysqli_real_escape_string($conn, $req_data["role"]);
            $user_id_esc = mysqli_real_escape_string($conn, $user_id);
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert into employees table
            $sql_insert_emp = "
                UPDATE employee SET employee_id='$user_id_esc', password='$password_hash'WHERE 
              id = $request_id
            ";

            if (mysqli_query($conn, $sql_insert_emp)) {
                // Update request status to approved
                $sql_update_req = "
                    UPDATE employee
                    SET status = 'approved'
                    WHERE id = $request_id
                ";
                mysqli_query($conn, $sql_update_req);

                $success_message = "Credentials created and request approved successfully.";
            } else {
                if (mysqli_errno($conn) == 1062) {
                    $error_message = "User ID already exists. Please choose another.";
                } else {
                    $error_message = "Error creating credentials: " . mysqli_error($conn);
                }
            }
        } else {
            $error_message = "Request not found or already processed.";
        }
    }
}

// ---- FETCH PENDING REQUESTS ----
$sql_pending = "SELECT * FROM employee WHERE status = 'pending' ORDER BY created_at DESC";
$result_pending = mysqli_query($conn, $sql_pending);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Employee Access Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Page Wrapper -->
    <div class="max-w-6xl mx-auto py-8 px-4">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Admin Panel – Employee ID Requests
        </h1>

        <!-- Flash Messages (Tailwind modals / alerts) -->
        <?php if ($success_message): ?>
            <div class="mb-4">
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline font-semibold">✅ <?php echo htmlspecialchars($success_message); ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove()">
                        ✖
                    </span>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline font-semibold">❌ <?php echo htmlspecialchars($error_message); ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove()">
                        ✖
                    </span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Pending Requests Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Pending Requests</h2>
                <span class="text-sm text-gray-500">
                    <?php echo mysqli_num_rows($result_pending); ?> pending
                </span>
            </div>

            <?php if ($result_pending && mysqli_num_rows($result_pending) > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Employee</th>
                               
                                <th class="px-6 py-3">Department</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Requested At</th>
                                <th class="px-6 py-3">Create Credentials</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_pending)): ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-3">
                                        <div class="font-semibold"><?php echo htmlspecialchars($row["employee_name"]); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row["employee_email"]); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row["phone"]); ?></div>
                                    </td>
                                    <td class="px-6 py-3">
                                        <?php echo htmlspecialchars($row["department"]); ?>
                                    </td>
                                    <td class="px-6 py-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                            <?php echo htmlspecialchars($row["role"]); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-xs text-gray-500">
                                        <?php echo htmlspecialchars($row["created_at"]); ?>
                                    </td>
                                    <td class="px-6 py-3">
                                        <!-- Inline form to create credentials -->
                                        <form method="post" class="flex flex-col gap-2 md:flex-row md:items-center">
                                            <input type="hidden" name="action" value="create_credentials">
                                            <input type="hidden" name="request_id"
                                                   value="<?php echo intval($row["id"]); ?>">

                                            <input
                                                type="text"
                                                name="user_id"
                                                required
                                                placeholder="User ID"
                                                class="px-2 py-1 border border-gray-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                            >

                                            <input
                                                type="text"
                                                name="password"
                                                required
                                                placeholder="Temp Password"
                                                class="px-2 py-1 border border-gray-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                            >

                                            <button
                                                type="submit"
                                                class="mt-1 md:mt-0 inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded bg-green-600 text-white hover:bg-green-700 focus:outline-none"
                                            >
                                                Create & Approve
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="px-6 py-4">
                    <p class="text-gray-500 text-sm">No pending requests right now.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
