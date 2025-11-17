<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Center - SecureBank Admin</title>
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
            margin-bottom: 20px;
        }

        h1 {
            font-size: 36px;
            color: #2c3e50;
        }

        .status-banner {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 24px 30px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(40,167,69,0.3);
        }

        .status-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .status-icon {
            font-size: 48px;
        }

        .status-text h2 {
            font-size: 24px;
            margin-bottom: 6px;
        }

        .status-text p {
            opacity: 0.9;
            font-size: 14px;
        }

        .btn-scan {
            background: white;
            color: #28a745;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .security-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .security-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .security-card h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .metric {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .metric-label {
            font-size: 14px;
            color: #666;
        }

        .metric-value {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
        }

        .metric-value.success {
            color: #28a745;
        }

        .metric-value.danger {
            color: #dc3545;
        }

        .metric-value.warning {
            color: #ffc107;
        }

        .threats-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 22px;
            color: #2c3e50;
        }

        .threat-item {
            padding: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .threat-item.critical {
            border-color: #dc3545;
            background: #fff5f5;
        }

        .threat-item.warning {
            border-color: #ffc107;
            background: #fffbf0;
        }

        .threat-item.info {
            border-color: #17a2b8;
            background: #f0f9fa;
        }

        .threat-info {
            flex: 1;
        }

        .threat-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #2c3e50;
        }

        .threat-desc {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .threat-time {
            font-size: 12px;
            color: #999;
        }

        .threat-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-critical {
            background: #dc3545;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #333;
        }

        .badge-info {
            background: #17a2b8;
            color: white;
        }

        .btn-action {
            padding: 8px 16px;
            margin-left: 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-resolve {
            background: #28a745;
            color: white;
        }

        .activity-log {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .log-item {
            padding: 16px 0;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            gap: 16px;
        }

        .log-item:last-child {
            border-bottom: none;
        }

        .log-icon {
            font-size: 24px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 50%;
        }

        .log-content {
            flex: 1;
        }

        .log-title {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .log-desc {
            font-size: 13px;
            color: #666;
        }

        .log-time {
            font-size: 12px;
            color: #999;
            white-space: nowrap;
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
            <a href="reports.php" class="nav-item">📊 Reports</a>
            <a href="security.php" class="nav-item active">🔒 Security Center</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Security Center</h1>
        </div>

        <div class="status-banner">
            <div class="status-content">
                <div class="status-icon">🛡️</div>
                <div class="status-text">
                    <h2>All Systems Secure</h2>
                    <p>No critical threats detected. Last security scan: 5 minutes ago</p>
                </div>
            </div>
            <button class="btn-scan" onclick="runSecurityScan()">Run Security Scan</button>
        </div>

        <div class="security-grid">
            <div class="security-card">
                <h3>🔒 Firewall Status</h3>
                <div class="metric">
                    <span class="metric-label">Status</span>
                    <span class="metric-value success">Active</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Blocked Attempts</span>
                    <span class="metric-value">1,247</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Last Update</span>
                    <span class="metric-value" style="font-size: 14px;">2 hours ago</span>
                </div>
            </div>

            <div class="security-card">
                <h3>🔐 Authentication</h3>
                <div class="metric">
                    <span class="metric-label">2FA Enabled</span>
                    <span class="metric-value success">94.3%</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Failed Logins</span>
                    <span class="metric-value warning">23</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Active Sessions</span>
                    <span class="metric-value">847</span>
                </div>
            </div>

            <div class="security-card">
                <h3>🛡️ Intrusion Detection</h3>
                <div class="metric">
                    <span class="metric-label">Status</span>
                    <span class="metric-value success">Monitoring</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Threats Blocked</span>
                    <span class="metric-value">89</span>
                </div>
                <div class="metric">
                    <span class="metric-label">False Positives</span>
                    <span class="metric-value">12</span>
                </div>
            </div>

            <div class="security-card">
                <h3>📊 Data Encryption</h3>
                <div class="metric">
                    <span class="metric-label">Encryption Level</span>
                    <span class="metric-value success">AES-256</span>
                </div>
                <div class="metric">
                    <span class="metric-label">SSL/TLS</span>
                    <span class="metric-value success">Valid</span>
                </div>
                <div class="metric">
                    <span class="metric-label">Certificate Expiry</span>
                    <span class="metric-value" style="font-size: 14px;">234 days</span>
                </div>
            </div>
        </div>

        <div class="threats-section">
            <div class="section-header">
                <h2>🚨 Security Threats & Alerts</h2>
            </div>

            <div class="threat-item critical">
                <div class="threat-info">
                    <div class="threat-title">Multiple Failed Login Attempts Detected</div>
                    <div class="threat-desc">IP Address 192.168.45.123 has attempted 8 failed logins in the past hour</div>
                    <div class="threat-time">5 minutes ago</div>
                </div>
                <span class="threat-badge badge-critical">Critical</span>
                <button class="btn-action btn-resolve" onclick="resolveThread(this)">Block IP</button>
            </div>

            <div class="threat-item warning">
                <div class="threat-info">
                    <div class="threat-title">Unusual Transaction Pattern</div>
                    <div class="threat-desc">User USR-10456 has initiated 15 large transactions in rapid succession</div>
                    <div class="threat-time">15 minutes ago</div>
                </div>
                <span class="threat-badge badge-warning">Warning</span>
                <button class="btn-action btn-resolve" onclick="resolveThread(this)">Investigate</button>
            </div>

            <div class="threat-item info">
                <div class="threat-info">
                    <div class="threat-title">Security Policy Update Available</div>
                    <div class="threat-desc">New security patches are available for the authentication system</div>
                    <div class="threat-time">1 hour ago</div>
                </div>
                <span class="threat-badge badge-info">Info</span>
                <button class="btn-action btn-resolve" onclick="resolveThread(this)">Update Now</button>
            </div>

            <div class="threat-item warning">
                <div class="threat-info">
                    <div class="threat-title">Weak Password Detected</div>
                    <div class="threat-desc">3 users are still using passwords that don't meet security requirements</div>
                    <div class="threat-time">2 hours ago</div>
                </div>
                <span class="threat-badge badge-warning">Warning</span>
                <button class="btn-action btn-resolve" onclick="resolveThread(this)">Force Reset</button>
            </div>
        </div>

        <div class="activity-log">
            <div class="section-header">
                <h2>📝 Recent Security Activity</h2>
            </div>

            <div class="log-item">
                <div class="log-icon">🔒</div>
                <div class="log-content">
                    <div class="log-title">Firewall Rule Updated</div>
                    <div class="log-desc">Admin updated firewall rules to block suspicious IP range</div>
                </div>
                <div class="log-time">10 min ago</div>
            </div>

            <div class="log-item">
                <div class="log-icon">✅</div>
                <div class="log-content">
                    <div class="log-title">Security Scan Completed</div>
                    <div class="log-desc">System-wide security scan completed with no issues found</div>
                </div>
                <div class="log-time">25 min ago</div>
            </div>

            <div class="log-item">
                <div class="log-icon">🚫</div>
                <div class="log-content">
                    <div class="log-title">IP Address Blocked</div>
                    <div class="log-desc">IP 185.220.101.45 blocked after multiple failed authentication attempts</div>
                </div>
                <div class="log-time">1 hour ago</div>
            </div>

            <div class="log-item">
                <div class="log-icon">🔐</div>
                <div class="log-content">
                    <div class="log-title">2FA Enforcement Activated</div>
                    <div class="log-desc">Two-factor authentication is now required for all admin accounts</div>
                </div>
                <div class="log-time">2 hours ago</div>
            </div>

            <div class="log-item">
                <div class="log-icon">📊</div>
                <div class="log-content">
                    <div class="log-title">Security Report Generated</div>
                    <div class="log-desc">Monthly security compliance report generated and sent to stakeholders</div>
                </div>
                <div class="log-time">3 hours ago</div>
            </div>
        </div>
    </div>

<script>
    // Function to handle the security scan animation (left as is)
    async function runSecurityScan() {
        const banner = document.querySelector('.status-banner');
        banner.style.background = 'linear-gradient(135deg, #ffc107 0%, #ff9800 100%)';
        banner.querySelector('h2').textContent = 'Security Scan Running...';
        banner.querySelector('p').textContent = 'Scanning all systems for vulnerabilities and threats';

        // Simulate a successful scan after 3 seconds
        setTimeout(() => {
            banner.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            banner.querySelector('h2').textContent = 'All Systems Secure';
            banner.querySelector('p').textContent = 'No critical threats detected. Last security scan: Just now';
        }, 3000);
    }
    
    // --- UPDATED RESOLVE THREAD FUNCTION ---
    /**
     * Simulates resolving a threat by removing the threat item from the DOM.
     * @param {HTMLElement} buttonElement - The specific button that was clicked (passed as 'this' from HTML).
     */
    function resolveThread(buttonElement) {
        
        // Use .closest() to find the nearest ancestor element with the class 'threat-item'
        const threatItem = buttonElement.closest('.threat-item'); 
        
        if (threatItem) {
            // Optional: Provide temporary visual feedback before removal
            threatItem.style.opacity = '0.0';
            threatItem.style.height = '0';
            threatItem.style.paddingTop = '0';
            threatItem.style.paddingBottom = '0';
            threatItem.style.marginBottom = '0';
            threatItem.style.transition = 'all 0.5s ease-out';

            // Wait for the transition to complete, then remove the element entirely
            setTimeout(() => {
                threatItem.remove();
                
                // Optional: Update the "All Systems Secure" banner 
                checkIfThreatsRemain();

            }, 500); // 500ms matches the transition time
            
        } else {
            console.error('Error: Could not find the parent threat-item container.');
            alert('Resolution failed. Check console for error.');
        }
    }

    // Helper function to check if the threat list is empty
    function checkIfThreatsRemain() {
        const threatsContainer = document.querySelector('.threats-section');
        const remainingThreats = threatsContainer.querySelectorAll('.threat-item');
        const statusBanner = document.querySelector('.status-banner');

        if (remainingThreats.length === 0) {
            // Change status to indicate success
            statusBanner.querySelector('h2').textContent = 'All Threats Resolved';
            statusBanner.querySelector('p').textContent = 'Security dashboard is clear. Last activity: Threat Resolution.';
            // Optionally, change the banner icon or color if you want a different look
        }
    }
</script>
</body>
</html>