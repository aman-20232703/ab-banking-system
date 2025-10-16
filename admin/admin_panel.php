<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .admin-dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 30px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            font-size: 24px;
            font-weight: 900;
            padding: 0 30px;
            margin-bottom: 10px;
        }

        .admin-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            margin: 0 30px 30px;
            display: inline-block;
            font-weight: 700;
        }

        .menu {
            list-style: none;
        }

        .menu a{
            text-decoration: none;
            color: white;
        }

        .menu-item {
            padding: 15px 30px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 16px;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        .header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 900;
            color: #333;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 18px;
        }

        .admin-details {
            text-align: right;
        }

        .admin-name {
            font-weight: 700;
            color: #333;
        }

        .admin-role {
            font-size: 12px;
            color: #dc3545;
            font-weight: 600;
        }

        .filters-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-weight: 600;
            font-size: 14px;
            color: #666;
        }

        .filter-group input,
        .filter-group select {
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #dc3545;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .users-table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table thead {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .users-table th {
            padding: 20px;
            text-align: left;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .users-table td {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .users-table tbody tr {
            transition: background 0.3s;
        }

        .users-table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-suspended {
            background: #fff3cd;
            color: #856404;
        }

        .status-frozen {
            background: #cce5ff;
            color: #004085;
        }

        .action-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-btn {
            background: #6c757d;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .dropdown-btn:hover {
            background: #5a6268;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 180px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 100;
            border-radius: 8px;
            overflow: hidden;
            right: 0;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 14px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
        }

        .dropdown-item.danger {
            color: #dc3545;
        }

        .dropdown-item.danger:hover {
            background: #f8d7da;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: modalSlideUp 0.3s ease;
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #dc3545;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            flex: 1;
        }

        .btn-submit {
            background: #dc3545;
            color: white;
            flex: 1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-value {
            font-size: 36px;
            font-weight: 900;
            color: #dc3545;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .permission-warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            color: #856404;
        }
        .menu-item-active{
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="sidebar">
        <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 20px; color: #333;">🏦 AmarJesh Bank</div>
            <div class="admin-badge">ADMIN PANEL</div>
            <ul class="menu">
                <li class="menu-item-active">
                    <span>👥</span>
                    <span><a href="index (3).html">User Management</a></span>
                </li>
                <li class="menu-item">
                    <span>📋</span>
                    <span><a href="index (4).html">Audit logs</a></span>
                </li>
                <li class="menu-item">
                    <span>🔍</span>
                    <span><a href="index (5).html">KYC Verification</a></span>
                </li>
                <li class="menu-item">
                    <span>⚙️</span>
                    <span><a href="index (6).html">System Settings</a></span>
                </li>
                <li class="menu-item">
                    <span>📊</span>
                    <span><a href="index (7).html">Reports</a></span>
                </li>
                <li class="menu-item">
                    <span>🔐</span>
                    <span><a href="index (8).html">Security Center</a></span>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>User Management</h1>
                <div class="admin-info">
                    <div class="admin-details">
                        <div class="admin-name">Admin User</div>
                        <div class="admin-role">SUPER ADMIN</div>
                    </div>
                    <div class="admin-avatar">A</div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">1,247</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">1,189</div>
                    <div class="stat-label">Active Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">35</div>
                    <div class="stat-label">Suspended</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">23</div>
                    <div class="stat-label">Frozen Accounts</div>
                </div>
            </div>

            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label>Search User</label>
                        <input type="text" id="searchUser" placeholder="Name, Email, Account #">
                    </div>
                    <div class="filter-group">
                        <label>Status Filter</label>
                        <select id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                            <option value="frozen">Frozen</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Account Type</label>
                        <select id="accountTypeFilter">
                            <option value="">All Types</option>
                            <option value="savings">Savings</option>
                            <option value="current">Current</option>
                            <option value="fixed">Fixed Deposit</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Registration Date</label>
                        <input type="date" id="dateFilter">
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="openCreateUserModal()">
                        <span>➕</span> Create New User
                    </button>
                    <button class="btn btn-secondary" onclick="applyFilters()">
                        <span>🔍</span> Apply Filters
                    </button>
                    <button class="btn btn-secondary" onclick="resetFilters()">
                        <span>↺</span> Reset
                    </button>
                    <button class="btn btn-success" onclick="exportData()">
                        <span>📥</span> Export Data
                    </button>
                </div>
            </div>

            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>USER ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ACCOUNT #</th>
                            <th>STATUS</th>
                            <th>BALANCE</th>
                            <th>REGISTERED</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <tr>
                            <td>#10247</td>
                            <td>John Smith</td>
                            <td>john.smith@email.com</td>
                            <td>ACC170234567890</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>$12,450.00</td>
                            <td>Jan 15, 2024</td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">Actions ▼</button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" onclick="viewUser(10247)">👁️ View Details</div>
                                        <div class="dropdown-item" onclick="editUser(10247)">✏️ Edit User</div>
                                        <div class="dropdown-item" onclick="suspendUser(10247)">⏸️ Suspend</div>
                                        <div class="dropdown-item" onclick="freezeAccount(10247)">❄️ Freeze Account</div>
                                        <div class="dropdown-item danger" onclick="deleteUser(10247)">🗑️ Delete</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#10246</td>
                            <td>Sarah Johnson</td>
                            <td>sarah.j@email.com</td>
                            <td>ACC170234567891</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>$8,320.00</td>
                            <td>Jan 14, 2024</td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">Actions ▼</button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" onclick="viewUser(10246)">👁️ View Details</div>
                                        <div class="dropdown-item" onclick="editUser(10246)">✏️ Edit User</div>
                                        <div class="dropdown-item" onclick="suspendUser(10246)">⏸️ Suspend</div>
                                        <div class="dropdown-item" onclick="freezeAccount(10246)">❄️ Freeze Account</div>
                                        <div class="dropdown-item danger" onclick="deleteUser(10246)">🗑️ Delete</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#10245</td>
                            <td>Michael Chen</td>
                            <td>m.chen@email.com</td>
                            <td>ACC170234567892</td>
                            <td><span class="status-badge status-suspended">Suspended</span></td>
                            <td>$5,670.00</td>
                            <td>Jan 13, 2024</td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">Actions ▼</button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" onclick="viewUser(10245)">👁️ View Details</div>
                                        <div class="dropdown-item" onclick="editUser(10245)">✏️ Edit User</div>
                                        <div class="dropdown-item" onclick="activateUser(10245)">▶️ Activate</div>
                                        <div class="dropdown-item" onclick="freezeAccount(10245)">❄️ Freeze Account</div>
                                        <div class="dropdown-item danger" onclick="deleteUser(10245)">🗑️ Delete</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#10244</td>
                            <td>Emily Rodriguez</td>
                            <td>emily.r@email.com</td>
                            <td>ACC170234567893</td>
                            <td><span class="status-badge status-frozen">Frozen</span></td>
                            <td>$15,890.00</td>
                            <td>Jan 12, 2024</td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">Actions ▼</button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" onclick="viewUser(10244)">👁️ View Details</div>
                                        <div class="dropdown-item" onclick="editUser(10244)">✏️ Edit User</div>
                                        <div class="dropdown-item" onclick="unfreezeAccount(10244)">🔥 Unfreeze</div>
                                        <div class="dropdown-item danger" onclick="deleteUser(10244)">🗑️ Delete</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#10243</td>
                            <td>David Brown</td>
                            <td>david.brown@email.com</td>
                            <td>ACC170234567894</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>$22,150.00</td>
                            <td>Jan 11, 2024</td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="dropdown-btn" onclick="toggleDropdown(this)">Actions ▼</button>
                                    <div class="dropdown-content">
                                        <div class="dropdown-item" onclick="viewUser(10243)">👁️ View Details</div>
                                        <div class="dropdown-item" onclick="editUser(10243)">✏️ Edit User</div>
                                        <div class="dropdown-item" onclick="suspendUser(10243)">⏸️ Suspend</div>
                                        <div class="dropdown-item" onclick="freezeAccount(10243)">❄️ Freeze Account</div>
                                        <div class="dropdown-item danger" onclick="deleteUser(10243)">🗑️ Delete</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create/Edit User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">Create New User</div>
            <form id="userForm">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="userName" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="userEmail" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" id="userPhone" required>
                </div>
                <div class="form-group">
                    <label>Account Type</label>
                    <select id="userAccountType" required>
                        <option value="savings">Savings Account</option>
                        <option value="current">Current Account</option>
                        <option value="fixed">Fixed Deposit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Initial Balance</label>
                    <input type="number" id="userBalance" value="1000" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select id="userStatus" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div class="permission-warning">
                    ⚠️ <strong>RBAC Notice:</strong> This action requires SUPER ADMIN privileges. All changes will be logged in the audit trail.
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-submit">Create User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle dropdown menu
        function toggleDropdown(btn) {
            const dropdown = btn.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-content').forEach(d => {
                if (d !== dropdown) d.classList.remove('show');
            });
            
            dropdown.classList.toggle('show');
        }

        // Close dropdowns when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                document.querySelectorAll('.dropdown-content').forEach(d => {
                    d.classList.remove('show');
                });
            }
        }

        // Modal functions
        function openCreateUserModal() {
            document.getElementById('userModal').classList.add('show');
        }

        function closeModal() {
            document.getElementById('userModal').classList.remove('show');
        }

        // User actions
        function viewUser(userId) {
            alert('Viewing details for User ID: ' + userId);
            // In production: fetch user details and display in modal
        }

        function editUser(userId) {
            alert('Editing User ID: ' + userId);
            // In production: load user data into form modal
        }

        function suspendUser(userId) {
            if (confirm('Are you sure you want to suspend this user? This action will be logged.')) {
                alert('User ID ' + userId + ' has been suspended');
                // In production: make API call to suspend user
            }
        }

        function activateUser(userId) {
            if (confirm('Activate this user account?')) {
                alert('User ID ' + userId + ' has been activated');
                // In production: make API call to activate user
            }
        }

        function freezeAccount(userId) {
            if (confirm('Freeze this account? User will not be able to perform any transactions.')) {
                alert('Account frozen for User ID ' + userId);
                // In production: make API call to freeze account
            }
        }

        function unfreezeAccount(userId) {
            if (confirm('Unfreeze this account?')) {
                alert('Account unfrozen for User ID ' + userId);
                // In production: make API call to unfreeze account
            }
        }

        function deleteUser(userId) {
            const confirmText = prompt('Type DELETE to confirm deletion of User ID ' + userId + ':');
            if (confirmText === 'DELETE') {
                alert('User ID ' + userId + ' has been permanently deleted');
                // In production: make API call to delete user
            }
        }

        // Filter functions
        function applyFilters() {
            const search = document.getElementById('searchUser').value;
            const status = document.getElementById('statusFilter').value;
            const accountType = document.getElementById('accountTypeFilter').value;
            const date = document.getElementById('dateFilter').value;
            
            alert('Applying filters...\nSearch: ' + search + '\nStatus: ' + status + '\nAccount Type: ' + accountType + '\nDate: ' + date);
            // In production: fetch filtered users from API
        }

        function resetFilters() {
            document.getElementById('searchUser').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('accountTypeFilter').value = '';
            document.getElementById('dateFilter').value = '';
            // In production: reload all users
        }

        function exportData() {
            alert('Exporting user data to CSV...');
            // In production: generate CSV export
        }

        // Form submission
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const userData = {
                name: document.getElementById('userName').value,
                email: document.getElementById('userEmail').value,
                phone: document.getElementById('userPhone').value,
                accountType: document.getElementById('userAccountType').value,
                balance: document.getElementById('userBalance').value,
                status: document.getElementById('userStatus').value
            };
            
            alert('Creating user: ' + userData.name);
            console.log('User data:', userData);
            
            // In production: send to API
            // fetch('/api/admin/create-user', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify(userData)
            // });
            
            closeModal();
        });
    </script>
</body>
</html>