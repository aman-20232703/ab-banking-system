<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Audit Logs</title>
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

        .security-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #d4edda;
            padding: 10px 20px;
            border-radius: 25px;
            border: 2px solid #28a745;
        }

        .security-icon {
            width: 20px;
            height: 20px;
            background: #28a745;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .security-text {
            font-weight: 700;
            color: #155724;
            font-size: 14px;
        }

        .integrity-banner {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .integrity-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .integrity-icon {
            font-size: 48px;
        }

        .integrity-details h3 {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 5px;
        }

        .integrity-details p {
            font-size: 14px;
            opacity: 0.9;
        }

        .verify-btn {
            background: white;
            color: #28a745;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .verify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
            font-size: 32px;
            font-weight: 900;
            color: #dc3545;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .logs-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .log-item {
            padding: 20px 25px;
            border-bottom: 1px solid #f0f0f0;
            display: grid;
            grid-template-columns: 60px 1fr 200px 150px 180px;
            gap: 20px;
            align-items: center;
            transition: background 0.3s;
        }

        .log-item:hover {
            background: #f8f9fa;
        }

        .log-item:last-child {
            border-bottom: none;
        }

        .log-id {
            font-family: monospace;
            color: #dc3545;
            font-weight: 700;
            font-size: 14px;
        }

        .log-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .log-action {
            font-weight: 700;
            color: #333;
            font-size: 16px;
        }

        .log-description {
            font-size: 14px;
            color: #666;
        }

        .log-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .user-id {
            font-size: 12px;
            color: #999;
        }

        .log-timestamp {
            font-size: 13px;
            color: #666;
        }

        .log-hash {
            font-family: monospace;
            font-size: 11px;
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 6px;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hash-verified {
            color: #28a745;
            font-size: 16px;
        }

        .action-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            margin-right: 8px;
        }

        .action-login {
            background: #d4edda;
            color: #155724;
        }

        .action-transaction {
            background: #cce5ff;
            color: #004085;
        }

        .action-admin {
            background: #f8d7da;
            color: #721c24;
        }

        .action-security {
            background: #fff3cd;
            color: #856404;
        }

        .action-system {
            background: #e2e3e5;
            color: #383d41;
        }

        .log-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 20px 25px;
            display: grid;
            grid-template-columns: 60px 1fr 200px 150px 180px;
            gap: 20px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 25px;
            background: white;
            border-radius: 0 0 15px 15px;
        }

        .page-btn {
            padding: 10px 16px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .page-btn:hover {
            border-color: #dc3545;
            color: #dc3545;
        }

        .page-btn.active {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
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
                    <span><a href="">System Settings</a></span>
                </li>
                <li class="menu-item">
                    <span>📊</span>
                    <span><a href="">Reports</a></span>
                </li>
                <li class="menu-item">
                    <span>🔐</span>
                    <span><a href="">Security Center</a></span>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>Audit Logs</h1>
                <div class="security-indicator">
                    <div class="security-icon"></div>
                    <span class="security-text">🔒 TAMPER-PROOF LOGGING ACTIVE</span>
                </div>
            </div>

            <div class="integrity-banner">
                <div class="integrity-info">
                    <div class="integrity-icon">🛡️</div>
                    <div class="integrity-details">
                        <h3>Log Integrity Verified</h3>
                        <p>All logs are cryptographically signed using SHA-256 hashing. Last verification: 2 minutes ago</p>
                    </div>
                </div>
                <button class="verify-btn" onclick="verifyIntegrity()">🔍 Verify Integrity</button>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">47,832</div>
                    <div class="stat-label">Total Logs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">1,247</div>
                    <div class="stat-label">Today</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">89</div>
                    <div class="stat-label">Security Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">23</div>
                    <div class="stat-label">Admin Actions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">100%</div>
                    <div class="stat-label">Integrity</div>
                </div>
            </div>

            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label>Search Logs</label>
                        <input type="text" id="searchLogs" placeholder="User, Action, IP Address">
                    </div>
                    <div class="filter-group">
                        <label>Action Type</label>
                        <select id="actionFilter">
                            <option value="">All Actions</option>
                            <option value="login">Login</option>
                            <option value="transaction">Transaction</option>
                            <option value="admin">Admin Action</option>
                            <option value="security">Security Event</option>
                            <option value="system">System Event</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Date From</label>
                        <input type="date" id="dateFrom">
                    </div>
                    <div class="filter-group">
                        <label>Date To</label>
                        <input type="date" id="dateTo">
                    </div>
                    <div class="filter-group">
                        <label>User ID</label>
                        <input type="text" id="userIdFilter" placeholder="User ID">
                    </div>
                    <div class="filter-group">
                        <label>IP Address</label>
                        <input type="text" id="ipFilter" placeholder="IP Address">
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="applyFilters()">
                        <span>🔍</span> Apply Filters
                    </button>
                    <button class="btn btn-secondary" onclick="resetFilters()">
                        <span>↺</span> Reset
                    </button>
                    <button class="btn btn-secondary" onclick="exportLogs()">
                        <span>📥</span> Export Logs
                    </button>
                    <button class="btn btn-primary" onclick="verifyIntegrity()">
                        <span>🛡️</span> Verify Integrity
                    </button>
                </div>
            </div>

            <div class="logs-container">
                <div class="log-header">
                    <div>LOG ID</div>
                    <div>ACTION & DETAILS</div>
                    <div>USER</div>
                    <div>TIMESTAMP</div>
                    <div>HASH CHECKSUM</div>
                </div>
                
                <div class="log-item">
                    <div class="log-id">#47832</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-admin">ADMIN</span>
                            User Account Suspended
                        </div>
                        <div class="log-description">Admin suspended user #10245 | IP: 192.168.1.15</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">A</div>
                        <div class="user-info">
                            <div class="user-name">Admin User</div>
                            <div class="user-id">ADMIN-001</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:34:22 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        a7f3c9...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47831</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-transaction">TRANSACTION</span>
                            Fund Transfer Completed
                        </div>
                        <div class="log-description">$500.00 transferred to ACC170234567891 | Status: Success</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">J</div>
                        <div class="user-info">
                            <div class="user-name">John Smith</div>
                            <div class="user-id">#10247</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:32:15 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        b8e4d1...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47830</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-security">SECURITY</span>
                            Failed Login Attempt
                        </div>
                        <div class="log-description">Invalid password | IP: 203.45.67.89 | Attempt: 3/5</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">?</div>
                        <div class="user-info">
                            <div class="user-name">Unknown</div>
                            <div class="user-id">203.45.67.89</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:28:43 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        c9f5e2...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47829</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-login">LOGIN</span>
                            User Login Successful
                        </div>
                        <div class="log-description">Browser: Chrome 120 | IP: 192.168.1.45 | Device: Desktop</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">S</div>
                        <div class="user-info">
                            <div class="user-name">Sarah Johnson</div>
                            <div class="user-id">#10246</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:25:18 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        d1a6f3...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47828</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-admin">ADMIN</span>
                            KYC Document Approved
                        </div>
                        <div class="log-description">Verified identity documents for user #10250 | Admin: ADMIN-001</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">A</div>
                        <div class="user-info">
                            <div class="user-name">Admin User</div>
                            <div class="user-id">ADMIN-001</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:20:07 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        e2b7g4...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47827</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-security">SECURITY</span>
                            Account Frozen by User
                        </div>
                        <div class="log-description">Emergency freeze activated | All transactions blocked</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">E</div>
                        <div class="user-info">
                            <div class="user-name">Emily Rodriguez</div>
                            <div class="user-id">#10244</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:15:33 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        f3c8h5...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47826</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-system">SYSTEM</span>
                            Password Changed
                        </div>
                        <div class="log-description">User initiated password reset | 2FA verified</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">D</div>
                        <div class="user-info">
                            <div class="user-name">David Brown</div>
                            <div class="user-id">#10243</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:10:12 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        g4d9i6...
                    </div>
                </div>

                <div class="log-item">
                    <div class="log-id">#47825</div>
                    <div class="log-details">
                        <div class="log-action">
                            <span class="action-badge action-transaction">TRANSACTION</span>
                            New Beneficiary Added
                        </div>
                        <div class="log-description">Beneficiary: Jane Doe (ACC123456) | Cooling period: 4 hours</div>
                    </div>
                    <div class="log-user">
                        <div class="user-avatar">J</div>
                        <div class="user-info">
                            <div class="user-name">John Smith</div>
                            <div class="user-id">#10247</div>
                        </div>
                    </div>
                    <div class="log-timestamp">
                        Jan 15, 2024<br>
                        10:05:45 AM
                    </div>
                    <div class="log-hash">
                        <span class="hash-verified">✓</span>
                        h5e0j7...
                    </div>
                </div>

                <div class="pagination">
                    <button class="page-btn">« Previous</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">5</button>
                    <button class="page-btn">Next »</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            const search = document.getElementById('searchLogs').value;
            const action = document.getElementById('actionFilter').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;
            const userId = document.getElementById('userIdFilter').value;
            const ip = document.getElementById('ipFilter').value;
            
            console.log('Applying filters:', { search, action, dateFrom, dateTo, userId, ip });
            alert('Filtering audit logs...');
            // In production: fetch filtered logs from API
        }

        function resetFilters() {
            document.getElementById('searchLogs').value = '';
            document.getElementById('actionFilter').value = '';
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            document.getElementById('userIdFilter').value = '';
            document.getElementById('ipFilter').value = '';
            // In production: reload all logs
        }

        function exportLogs() {
            alert('Exporting audit logs to encrypted CSV...\n\nThis export will include:\n- All visible log entries\n- Cryptographic signatures\n- Integrity checksums');
            // In production: generate encrypted export
        }

        function verifyIntegrity() {
            alert('🔍 Verifying log integrity...\n\n✓ Checking hash chain consistency\n✓ Validating SHA-256 checksums\n✓ Verifying timestamps\n\n✅ All logs verified successfully!\n\nNo tampering detected.');
            // In production: perform actual cryptographic verification
        }

        // Auto-refresh logs every 30 seconds
        setInterval(() => {
            console.log('Auto-refreshing audit logs...');
            // In production: fetch new logs from API
        }, 30000);
    </script>
</body>
</html>