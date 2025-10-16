<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - SecureBank Admin</title>
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

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .settings-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .settings-card h3 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
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
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #dc3545;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .switch {
            position: relative;
            width: 50px;
            height: 26px;
            background: #ccc;
            border-radius: 13px;
            transition: background 0.3s;
        }

        .switch.active {
            background: #28a745;
        }

        .switch::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: left 0.3s;
        }

        .switch.active::after {
            left: 27px;
        }

        .btn {
            padding: 12px 24px;
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
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 20px; color: #333;">🏦 AmarJesh Bank</div>
        <div class="admin-badge">ADMIN PANEL</div>
        
        <div class="nav-section">
            <div class="nav-title">User Management</div>
            <a href="index (4).html" class="nav-item">📋 Audit logs</a>
            <a href="index (5).html" class="nav-item">👤 KYC Verification</a>
            <a href="index (6).html" class="nav-item active">⚙️ System Settings</a>
            <a href="index (7).html" class="nav-item">📊 Reports</a>
            <a href="index (8).html" class="nav-item">🔒 Security Center</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>System Settings</h1>
        </div>

        <div id="successMessage" class="success-message">Settings saved successfully!</div>

        <div class="settings-grid">
            <div class="settings-card">
                <h3>⚙️ General Settings</h3>
                <form id="generalForm">
                    <div class="form-group">
                        <label>System Name</label>
                        <input type="text" name="system_name" value="AmarJesh Bank Admin Portal" required>
                    </div>
                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" name="admin_email" value="admin@amarjeshbank.com" required>
                    </div>
                    <div class="form-group">
                        <label>Timezone</label>
                        <select name="timezone">
                            <option>UTC-05:00 (Eastern)</option>
                            <option>UTC-06:00 (Central)</option>
                            <option>UTC-07:00 (Mountain)</option>
                            <option>UTC-08:00 (Pacific)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div class="settings-card">
                <h3>🔐 Security Settings</h3>
                <form id="securityForm">
                    <div class="form-group">
                        <label>Session Timeout (minutes)</label>
                        <input type="number" name="session_timeout" value="30" min="5" max="120">
                    </div>
                    <div class="form-group">
                        <label>Password Expiry (days)</label>
                        <input type="number" name="password_expiry" value="90" min="30" max="365">
                    </div>
                    <div class="form-group">
                        <label>Max Login Attempts</label>
                        <input type="number" name="max_attempts" value="5" min="3" max="10">
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>Two-Factor Authentication Required</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div class="settings-card">
                <h3>📧 Email Configuration</h3>
                <form id="emailForm">
                    <div class="form-group">
                        <label>SMTP Server</label>
                        <input type="text" name="smtp_server" value="smtp.securebank.com">
                    </div>
                    <div class="form-group">
                        <label>SMTP Port</label>
                        <input type="number" name="smtp_port" value="587">
                    </div>
                    <div class="form-group">
                        <label>From Email</label>
                        <input type="email" name="from_email" value="noreply@securebank.com">
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>Enable Email Notifications</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div class="settings-card">
                <h3>🔄 Backup Settings</h3>
                <form id="backupForm">
                    <div class="form-group">
                        <label>Backup Frequency</label>
                        <select name="backup_frequency">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Backup Time</label>
                        <input type="time" name="backup_time" value="02:00">
                    </div>
                    <div class="form-group">
                        <label>Retention Period (days)</label>
                        <input type="number" name="retention_days" value="30" min="7" max="365">
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>Automatic Backups Enabled</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div class="settings-card">
                <h3>📊 Logging Settings</h3>
                <form id="loggingForm">
                    <div class="form-group">
                        <label>Log Level</label>
                        <select name="log_level">
                            <option>DEBUG</option>
                            <option>INFO</option>
                            <option selected>WARNING</option>
                            <option>ERROR</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Log Retention (days)</label>
                        <input type="number" name="log_retention" value="90" min="30" max="365">
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>Tamper-Proof Logging</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>Real-time Log Monitoring</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div class="settings-card">
                <h3>🌐 API Settings</h3>
                <form id="apiForm">
                    <div class="form-group">
                        <label>API Rate Limit (requests/minute)</label>
                        <input type="number" name="rate_limit" value="100" min="10" max="1000">
                    </div>
                    <div class="form-group">
                        <label>API Version</label>
                        <select name="api_version">
                            <option>v1</option>
                            <option selected>v2</option>
                            <option>v3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch" onclick="toggleSwitch(this)">
                            <div class="switch active"></div>
                            <span>API Access Enabled</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleSwitch(element) {
            const switchEl = element.querySelector('.switch');
            switchEl.classList.toggle('active');
        }

        // Handle form submissions
        const forms = ['generalForm', 'securityForm', 'emailForm', 'backupForm', 'loggingForm', 'apiForm'];
        
        forms.forEach(formId => {
            document.getElementById(formId).addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const data = Object.fromEntries(formData.entries());
                
                try {
                    const response = await fetch('backend/save-settings.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            section: formId.replace('Form', ''),
                            data: data
                        })
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        const successMsg = document.getElementById('successMessage');
                        successMsg.style.display = 'block';
                        setTimeout(() => {
                            successMsg.style.display = 'none';
                        }, 3000);
                    }
                } catch (error) {
                    console.error('Error saving settings:', error);
                    alert('Error saving settings. Please try again.');
                }
            });
        });
    </script>
</body>
</html>