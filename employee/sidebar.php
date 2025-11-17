<?php
include 'dbconnect.php';
session_start();

// Get employee session data (adjust if your session keys are different)
$emp_id    = $_SESSION['emp_id']    ?? '';

$empRow = null;
if (!empty($emp_id)) {
    $emp_sql = "SELECT * FROM employee WHERE employee_id = '" . mysqli_real_escape_string($conn, $emp_id) . "'";
    $emp_res = mysqli_query($conn, $emp_sql);
    if ($emp_res && mysqli_num_rows($emp_res) > 0) {
        $empRow = mysqli_fetch_assoc($emp_res);
    }
}


$customers = [];
$c_sql = "
    SELECT 
        u.id AS customer_id,
        u.name AS customer_name,
        u.email AS customer_email,
        a.account_number,
        a.deposit AS balance,
        a.status AS account_status
    FROM users u
    LEFT JOIN account a ON a.users_id = u.id
    ORDER BY u.id DESC
    LIMIT 20
";
$c_res = mysqli_query($conn, $c_sql);
if ($c_res && mysqli_num_rows($c_res) > 0) {
    while ($row = mysqli_fetch_assoc($c_res)) {
        $customers[] = $row;
    }
}

// Example stats (you can replace with real queries)
$total_customers = count($customers);

// example pending requests
$pending_requests = 0;
$pending_sql = "SELECT COUNT(*) AS cnt FROM account WHERE status = 'Pending'";
$p_res = mysqli_query($conn, $pending_sql);
if ($p_res && mysqli_num_rows($p_res) > 0) {
    $p_row = mysqli_fetch_assoc($p_res);
    $pending_requests = (int)$p_row['cnt'];
}

// example today approvals (requires a 'approved_at' date column, adjust as needed)
$today_approvals = 0;

// Example flagged accounts
$flagged_accounts = 0;
$flag_sql = "SELECT COUNT(*) AS cnt FROM account WHERE status = 'Flagged'";
$f_res = mysqli_query($conn, $flag_sql);
if ($f_res && mysqli_num_rows($f_res) > 0) {
    $f_row = mysqli_fetch_assoc($f_res);
    $flagged_accounts = (int)$f_row['cnt'];
}

// Employee photo path if available
$emp_photo = $empRow['photo_path'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - AmarJesh Bank</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .gradient-card {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
        }
        .sidebar-item.active {
            background-color: rgba(255, 255, 255, 0.12);
        }
    </style>
</head>
<body class="bg-slate-100">
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col">
        <!-- Brand -->
        <div class="p-6 flex items-center gap-3 border-b border-white/20">
            <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24">
                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
            </svg>
            <span class="text-2xl font-bold" style="font-family:Brush Script MT,cursive;font-size: 30px; color: #f9fafb;">
                AmarJesh Bank
            </span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            <a href="employee_dash.php"
               class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="checkbook.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">📘</span>
                <span class="font-medium">Checkbook</span>
            </a>
            <a href="review.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">📄</span>
                <span class="font-medium">Review Requests</span>
            </a>
            <a href="card.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">💳</span>
                <span class="font-medium">Card Requests</span>
            </a>
            <a href="pending.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">⏳</span>
                <span class="font-medium">Pending</span>
            </a>

            <div class="mt-3 pt-3 border-t border-white/10 text-xs uppercase tracking-wide text-white/80">
                Operations
            </div>
            <a href="communication.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">✉️</span>
                <span class="font-medium">Communication</span>
            </a>
            <a href="reports.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">📊</span>
                <span class="font-medium">Reports</span>
            </a>
            <a href="documents.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">📁</span>
                <span class="font-medium">Documents</span>
            </a>
            <a href="task.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">✅</span>
                <span class="font-medium">Tasks</span>
            </a>

            <div class="mt-3 pt-3 border-t border-white/10 text-xs uppercase tracking-wide text-white/80">
                Account
            </div>
            <a href="settings.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1">
                <span class="text-xl">⚙️</span>
                <span class="font-medium">Settings</span>
            </a>
            <a href="logout.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mt-2">
                <span class="text-xl">🚪</span>
                <span class="font-medium">Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="flex-1 overflow-y-auto">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-8 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                    Welcome, <span class="text-3xl">👋</span>
                    <?php echo htmlspecialchars($empRow['employee_name']); ?>
                </h1>
                <p class="text-sm text-gray-500">
                    Manage customer accounts, approvals, and branch operations from one place.
                </p>
            </div>

            <div class="flex items-center gap-4">
                <!-- (Optional) application / branch status -->
                <div class="hidden md:block text-right text-xs text-gray-500">
                    <div class="font-semibold text-gray-700">
                        Branch: <?php echo htmlspecialchars($empRow['branch']); ?>
                    </div>
                    <div>Role: Relationship / Operations</div>
                </div>

                <!-- Profile summary on right side -->
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-full border-2 border-white shadow-lg overflow-hidden bg-indigo-600 flex items-center justify-center text-white text-xl font-semibold">
                        <?php
                        if ($emp_photo) {
                            echo '<img src="../employees/' . htmlspecialchars($emp_photo) . '" class="w-full h-full object-cover" alt="Employee Photo">';
                        } else {
                            echo strtoupper(substr($emp_name, 0, 1));
                        }
                        ?>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">
                            <?php echo htmlspecialchars($emp_id); ?>
                        </div>
                        <div class="text-sm text-gray-500">
                            <?php echo htmlspecialchars($empRow['employee_email']); ?>
                        </div>
                        <div class="text-xs text-gray-400">
                            Employee Dashboard
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="pageContent" class="p-8 space-y-8">

            <!-- Top cards: Profile + overview -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Profile / stats card -->
                <div class="bg-white rounded-3xl p-8 shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Profile Overview</h2>
                        <span class="inline-flex items-center text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Active
                        </span>
                    </div>

                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xl font-semibold">
                            <?php echo strtoupper(substr($empRow['employee_name'], 0, 1)); ?>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-800">
                                <?php echo htmlspecialchars($empRow['employee_name'],); ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                Employee ID: <?php echo htmlspecialchars($emp_id); ?>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                Branch: <?php echo htmlspecialchars($empRow['branch']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="space-y-1">
                            <div class="text-gray-500">Total Customers</div>
                            <div class="text-lg font-semibold text-gray-800">
                                <?php echo $total_customers; ?>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-gray-500">Pending Requests</div>
                            <div class="text-lg font-semibold text-amber-500">
                                <?php echo $pending_requests; ?>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-gray-500">Today’s Approvals</div>
                            <div class="text-lg font-semibold text-emerald-500">
                                <?php echo $today_approvals; ?>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-gray-500">Flagged Accounts</div>
                            <div class="text-lg font-semibold text-rose-500">
                                <?php echo $flagged_accounts; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick actions / branch metrics -->
                <div class="bg-white rounded-3xl p-8 shadow-lg">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">Quick Actions</h2>
                    <p class="text-sm text-gray-500 mb-4">
                        Use these shortcuts to quickly handle important banking tasks.
                    </p>

                    <div class="flex flex-col space-y-3 w-64">
                        <a href="pending.php"
                           class="flex items-center justify-center gap-2 bg-indigo-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition">
                            ⏳ View Pending Requests
                        </a>
                        <a href="card.php"
                           class="flex items-center justify-center gap-2 bg-green-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-green-700 transition">
                            💳 Card Approvals
                        </a>
                        <a href="checkbook.php"
                           class="flex items-center justify-center gap-2 bg-yellow-500 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition">
                            📘 Checkbook Approvals
                        </a>
                    </div>
                </div>
            </div>

            <!-- Customer Accounts with Add Cash Button -->
            <div class="bg-white rounded-3xl p-8 shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Customer Accounts</h2>
                        <p class="text-xs text-gray-500 mt-1">
                            View all customers and add cash directly to their accounts when needed.
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input
                            type="text"
                            id="searchCustomer"
                            placeholder="Search customer…"
                            class="w-48 md:w-64 px-3 py-2 rounded-lg border border-gray-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs">
                        <thead>
                        <tr class="border-b border-gray-100 text-gray-500">
                            <th class="text-left py-2 pr-3 font-medium">Customer ID</th>
                            <th class="text-left py-2 pr-3 font-medium">Name</th>
                            <th class="text-left py-2 pr-3 font-medium">Account No.</th>
                            <th class="text-left py-2 pr-3 font-medium">Balance</th>
                            <th class="text-left py-2 pr-3 font-medium">Status</th>
                            <th class="text-left py-2 pr-3 font-medium">Action</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50" id="customerTableBody">
                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $c): ?>
                                <tr class="customer-row">
                                    <td class="py-2 pr-3 text-gray-700">
                                        <?php echo htmlspecialchars($c['customer_id']); ?>
                                    </td>
                                    <td class="py-2 pr-3 text-gray-700">
                                        <?php echo htmlspecialchars($c['customer_name']); ?>
                                    </td>
                                    <td class="py-2 pr-3 text-gray-700">
                                        <?php echo htmlspecialchars($c['account_number'] ?? 'N/A'); ?>
                                    </td>
                                    <td class="py-2 pr-3 text-gray-800 font-semibold">
                                        ₹ <?php echo htmlspecialchars($c['balance'] ?? '0'); ?>
                                    </td>
                                    <td class="py-2 pr-3">
                                        <?php
                                        $status = $c['account_status'] ?? 'Unknown';
                                        $statusClass = 'bg-gray-100 text-gray-600';
                                        if ($status === 'Active')   $statusClass = 'bg-emerald-50 text-emerald-600';
                                        if ($status === 'Pending')  $statusClass = 'bg-amber-50 text-amber-600';
                                        if ($status === 'Flagged')  $statusClass = 'bg-rose-50 text-rose-600';
                                        ?>
                                        <span class="inline-flex text-[10px] px-2 py-0.5 rounded-full <?php echo $statusClass; ?>">
                                            <?php echo htmlspecialchars($status); ?>
                                        </span>
                                    </td>
                                    <td class="py-2 pr-3">
                                        <?php if (!empty($c['account_number'])): ?>
                                            <button
                                                class="add-cash-btn inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-medium bg-indigo-500 text-white hover:bg-indigo-600"
                                                data-customer-id="<?php echo htmlspecialchars($c['customer_id']); ?>"
                                                data-customer-name="<?php echo htmlspecialchars($c['customer_name']); ?>"
                                                data-account-no="<?php echo htmlspecialchars($c['account_number']); ?>"
                                            >
                                                ➕ Add Cash
                                            </button>
                                        <?php else: ?>
                                            <span class="text-[11px] text-gray-400">No account</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-400 text-xs">
                                    No customers found.
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add Cash Modal -->
<div id="addCashModal"
     class="fixed inset-0 bg-slate-900/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4 p-5">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-base font-semibold text-slate-800">
                Add Cash to Customer Account
            </h3>
            <button id="closeModalBtn" class="text-slate-400 hover:text-slate-600">
                ✕
            </button>
        </div>

        <div class="text-xs text-slate-500 mb-3">
            Customer:
            <span class="font-semibold text-slate-700" id="modalCustomerName"></span><br>
            Account No.:
            <span class="font-semibold text-slate-700" id="modalAccountNo"></span>
        </div>

        <form method="POST" class="space-y-3">
            <input type="hidden" name="customer_id" id="modalCustomerId">
            <input type="hidden" name="account_number" id="modalAccountNumber">

            <div class="space-y-1">
                <label for="amount" class="text-xs font-medium text-slate-700">
                    Amount (₹)
                </label>
                <input
                    type="number"
                    name="amount"
                    id="amount"
                    min="1"
                    step="0.01"
                    required
                    class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div class="space-y-1">
                <label for="note" class="text-xs font-medium text-slate-700">
                    Note (optional)
                </label>
                <textarea
                    name="note"
                    id="note"
                    rows="2"
                    class="w-full px-3 py-2 rounded-lg border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="e.g. Cash deposit at branch counter"
                ></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2">
                <button
                    type="button"
                    id="cancelModalBtn"
                    class="px-4 py-1.5 text-xs font-medium rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    name='submit'
                    class="px-4 py-1.5 text-xs font-medium rounded-lg bg-indigo-600 text-white hover:bg-indigo-700"
                >
                    Confirm Add Cash
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Simple search filter for customer table
    document.getElementById('searchCustomer')?.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        document.querySelectorAll('.customer-row').forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });

    // Add Cash modal logic
    function setupAddCashModal() {
        const modal = document.getElementById('addCashModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const addCashButtons = document.querySelectorAll('.add-cash-btn');

        const modalCustomerName = document.getElementById('modalCustomerName');
        const modalAccountNo = document.getElementById('modalAccountNo');
        const modalCustomerId = document.getElementById('modalCustomerId');
        const modalAccountNumber = document.getElementById('modalAccountNumber');

        function openModal(customerId, customerName, accountNo) {
            modalCustomerName.textContent = customerName;
            modalAccountNo.textContent = accountNo;
            modalCustomerId.value = customerId;
            modalAccountNumber.value = accountNo;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        addCashButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const customerId = btn.dataset.customerId;
                const customerName = btn.dataset.customerName;
                const accountNo = btn.dataset.accountNo;
                openModal(customerId, customerName, accountNo);
            });
        });

        closeModalBtn.addEventListener('click', closeModal);
        cancelModalBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    }

    document.addEventListener('DOMContentLoaded', setupAddCashModal);
</script>

</body>
</html>
<?php
//include 'dbconnect.php';

if (isset($_POST['submit'])){
    $account=$_POST['account_number'];
    $amount=$_POST['amount'];

$q = "select * from account where account_number='$account'";
$res = mysqli_query($conn,$q);
if (mysqli_num_rows($res)>0){

    $sql="UPDATE account
    SET deposit = deposit + $amount
    WHERE account_number='$account' ";

    mysqli_query($conn,$sql);
    
            echo "<script>
            alert('✅ Amount deposited.');
            window.location='sidebar.php';
        </script>";
}
else{
            echo "<script>
            alert('❌ Amount not deposited: ');
            window.location='sidebar.php';
        </script>";
}
}
?>