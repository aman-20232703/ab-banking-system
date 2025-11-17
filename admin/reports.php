<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - SecureBank Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #dc3545;
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 0 20px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 700;
        }

        .admin-badge {
            background: rgba(255,255,255,0.2);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin: 0 20px 20px;
            display: inline-block;
            letter-spacing: 0.5px;
        }

        .nav-section {
            margin-bottom: 10px;
        }

        .nav-title {
            padding: 15px 20px 10px;
            font-size: 13px;
            font-weight: 600;
            opacity: 0.9;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            text-decoration: none;
            color: white;
        }

        .nav-item:hover {
            background: rgba(0,0,0,0.1);
        }

        .nav-item.active {
            background: rgba(0,0,0,0.2);
            border-left: 4px solid white;
            padding-left: 16px;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 36px;
            color: #2c3e50;
        }

        .filter-bar {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            gap: 16px;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .filter-group {
            flex: 1;
        }

        .filter-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background: #c82333;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .stat-card h3 {
            font-size: 32px;
            color: #dc3545;
            margin-bottom: 8px;
        }

        .stat-card p {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .reports-grid {
            display: grid;
            gap: 24px;
        }

        .report-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .report-header h3 {
            font-size: 20px;
            color: #2c3e50;
        }

        .btn-download {
            background: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #555;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #333;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .chart-container {
            height: 300px;
            position: relative;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 20px; color: #333;">🏦 AmarJesh Bank</div>
        <div class="admin-badge">ADMIN PANEL</div>
        
        <div class="nav-section">
            <a href="admin_dash.php" class="nav-item">👥 User Management</a>
            <a href="audit.php" class="nav-item">📋 Audit logs</a>
            <a href="kyc.php" class="nav-item">🔍 KYC Verification</a>
            <a href="setting.php" class="nav-item">🔰 Accounts Approval</a>
            <a href="reports.php" class="nav-item active">❌ Freeze Request</a>
            <a href="security.php" class="nav-item">✅ Unfreeze Request</a>
            <a href="setting.php" class="nav-item">⚙️ System Settings</a>
            <a href="reports.php" class="nav-item active">📊 Reports</a>
            <a href="security.php" class="nav-item">🔒 Security Center</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Reports</h1>
        </div>

        <div class="filter-bar">
            <div class="filter-group">
                <label>Report Type</label>
                <select id="reportType">
                    <option>All Reports</option>
                    <option>Transaction Reports</option>
                    <option>User Activity</option>
                    <option>Security Reports</option>
                    <option>Compliance Reports</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Date From</label>
                <input type="date" id="dateFrom" value="2025-10-01">
            </div>
            <div class="filter-group">
                <label>Date To</label>
                <input type="date" id="dateTo" value="2025-10-13">
            </div>
            <div class="filter-group" style="display: flex; align-items: flex-end;">
                <button class="btn btn-primary" onclick="generateReports()">Generate Report</button>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>156</h3>
                <p>Reports Generated</p>
            </div>
            <div class="stat-card">
                <h3>$2.4M</h3>
                <p>Total Transaction Value</p>
            </div>
            <div class="stat-card">
                <h3>1,847</h3>
                <p>Active Users</p>
            </div>
            <div class="stat-card">
                <h3>98.5%</h3>
                <p>System Uptime</p>
            </div>
        </div>

        <div class="reports-grid">
            <div class="report-card">
                <div class="report-header">
                    <h3>📈 Transaction Summary</h3>
                    <a href="#" class="btn-download" onclick="downloadReport('transactions')">⬇ Download CSV</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction Type</th>
                            <th>Count</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTable">
                        <tr>
                            <td>2025-10-13</td>
                            <td>Wire Transfer</td>
                            <td>342</td>
                            <td>$458,920</td>
                            <td><span class="badge badge-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>2025-10-13</td>
                            <td>ACH Payment</td>
                            <td>567</td>
                            <td>$234,150</td>
                            <td><span class="badge badge-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>2025-10-13</td>
                            <td>International Transfer</td>
                            <td>89</td>
                            <td>$892,340</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>2025-10-12</td>
                            <td>Wire Transfer</td>
                            <td>298</td>
                            <td>$389,450</td>
                            <td><span class="badge badge-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>2025-10-12</td>
                            <td>Check Deposit</td>
                            <td>156</td>
                            <td>$98,720</td>
                            <td><span class="badge badge-danger">Failed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <h3>👥 User Activity Report</h3>
                    <a href="#" class="btn-download" onclick="downloadReport('users')">⬇ Download CSV</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Last Login</th>
                            <th>Actions Today</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>USR-10234</td>
                            <td>John Anderson</td>
                            <td>2025-10-13 22:45</td>
                            <td>47</td>
                            <td><span class="badge badge-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>USR-10235</td>
                            <td>Sarah Mitchell</td>
                            <td>2025-10-13 21:30</td>
                            <td>23</td>
                            <td><span class="badge badge-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>USR-10236</td>
                            <td>Michael Chen</td>
                            <td>2025-10-13 19:15</td>
                            <td>89</td>
                            <td><span class="badge badge-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>USR-10237</td>
                            <td>Emily Davis</td>
                            <td>2025-10-12 16:22</td>
                            <td>0</td>
                            <td><span class="badge badge-warning">Inactive</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="report-card">
                <div class="report-header">
                    <h3>🔒 Security Events</h3>
                    <a href="#" class="btn-download" onclick="downloadReport('security')">⬇ Download CSV</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Event Type</th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Severity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>22:58</td>
                            <td>Failed Login Attempt</td>
                            <td>unknown@email.com</td>
                            <td>192.168.1.45</td>
                            <td><span class="badge badge-warning">Medium</span></td>
                        </tr>
                        <tr>
                            <td>22:45</td>
                            <td>Password Changed</td>
                            <td>john.anderson@bank.com</td>
                            <td>10.0.0.23</td>
                            <td><span class="badge badge-success">Low</span></td>
                        </tr>
                        <tr>
                            <td>22:30</td>
                            <td>Suspicious Activity Detected</td>
                            <td>sarah.mitchell@bank.com</td>
                            <td>172.16.0.12</td>
                            <td><span class="badge badge-danger">High</span></td>
                        </tr>
                        <tr>
                            <td>22:15</td>
                            <td>2FA Enabled</td>
                            <td>michael.chen@bank.com</td>
                            <td>10.0.0.45</td>
                            <td><span class="badge badge-success">Low</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        async function generateReports() {
            const reportType = document.getElementById('reportType').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            try {
                const response = await fetch('backend/generate-report.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        type: reportType,
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    alert('Report generated successfully!');
                    location.reload();
                }
            } catch (error) {
                console.error('Error generating report:', error);
            }
        }

        async function downloadReport(reportType) {
            try {
                const response = await fetch(`backend/download-report.php?type=${reportType}`, {
                    method: 'GET'
                });

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `${reportType}-report-${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            } catch (error) {
                console.error('Error downloading report:', error);
                alert('Error downloading report');
            }
        }
    </script>
</body>
</html>