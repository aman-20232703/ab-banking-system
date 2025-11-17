<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - KYC Verification</title>
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

        .menu a {
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 900;
            color: #333;
        }

        .encryption-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 36px;
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

        .pending-highlight {
            color: #ffc107;
        }

        .tabs-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid #f0f0f0;
            padding: 0 25px;
        }

        .tab {
            padding: 20px 30px;
            cursor: pointer;
            font-weight: 700;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
            bottom: -2px;
        }

        .tab.active {
            color: #dc3545;
            border-bottom-color: #dc3545;
        }

        .tab-badge {
            background: #ffc107;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: 8px;
            font-weight: 900;
        }

        .kyc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            padding: 25px;
        }

        .kyc-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .kyc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: #dc3545;
        }

        .kyc-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-avatar-large {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 24px;
        }

        .kyc-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-verified {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .kyc-user-info {
            margin-bottom: 20px;
        }

        .user-name {
            font-size: 20px;
            font-weight: 900;
            color: #333;
            margin-bottom: 5px;
        }

        .user-details {
            font-size: 14px;
            color: #666;
        }

        .kyc-documents {
            margin-bottom: 20px;
        }

        .doc-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .doc-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .doc-icon {
            font-size: 20px;
        }

        .doc-name {
            flex: 1;
            font-weight: 600;
            color: #333;
        }

        .doc-size {
            font-size: 12px;
            color: #999;
        }

        .kyc-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-approve {
            background: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-reject {
            background: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .btn-review {
            background: #667eea;
            color: white;
        }

        .btn-review:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            max-width: 900px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 900;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-body {
            padding: 40px;
        }

        .verification-section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 900;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .document-viewer {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .document-preview {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .document-preview:hover {
            border-color: #667eea;
            background: #f0f3ff;
        }

        .preview-icon {
            font-size: 64px;
        }

        .preview-title {
            font-weight: 700;
            color: #333;
        }

        .preview-subtitle {
            font-size: 14px;
            color: #666;
        }

        .encrypted-badge {
            background: #28a745;
            color: white;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .notes-section {
            margin-top: 30px;
        }

        .notes-textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            resize: vertical;
        }

        .notes-textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 0 0 20px 20px;
        }

        .btn-large {
            flex: 1;
            padding: 16px;
            font-size: 16px;
        }

        .security-warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>

<body>
    <div class="admin-dashboard">
        <div class="sidebar">
            <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 20px; color: #333;">🏦 AmarJesh Bank</div>
            <div class="admin-badge">ADMIN PANEL</div>
            <ul class="menu">
                <li class="menu-item">
                    <span>👥</span>
                    <span><a href="admin_dash.php">User Management</a></span>
                </li>
                <li class="menu-item">
                    <span>📋</span>
                    <span><a href="audit.php">Audit logs</a></span>
                </li>
                <li class="menu-item">
                    <span>🔍</span>
                    <span><a href="kyc.php">KYC Verification</a></span>
                </li>
                <li class="menu-item">
                    <span>🔰</span>
                    <span><a href="approve.php">Account Approval</a></span>
                </li>
                <li class="menu-item">
                    <span>❌</span>
                    <span><a href="freeze.php">Freeze Request</a></span>
                </li>
                <li class="menu-item">
                    <span>✅</span>
                    <span><a href="un_freeze.php">Unfreeze Request</a></span>
                </li>
                <li class="menu-item">
                    <span>⚙️</span>
                    <span><a href="setting.php">System Settings</a></span>
                </li>
                <li class="menu-item">
                    <span>📊</span>
                    <span><a href="reports.php">Reports</a></span>
                </li>
                <li class="menu-item">
                    <span>🔐</span>
                    <span><a href="security.php">Security Center</a></span>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>KYC Verification Portal</h1>
                <div class="encryption-badge">
                    🔒 AES-256 Encryption Active
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value pending-highlight">24</div>
                    <div class="stat-label">Pending Review</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">1,189</div>
                    <div class="stat-label">Verified</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">34</div>
                    <div class="stat-label">Rejected</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">97.2%</div>
                    <div class="stat-label">Approval Rate</div>
                </div>
            </div>

            <div class="tabs-container">
                <div class="tabs">
                    <div class="tab active">
                        Pending <span class="tab-badge">24</span>
                    </div>
                    <div class="tab">
                        Approved
                    </div>
                    <div class="tab">
                        Rejected
                    </div>
                    <div class="tab">
                        All Applications
                    </div>
                </div>

                <div class="kyc-grid">
                    <div class="kyc-card" onclick="openVerificationModal(1)">
                        <div class="kyc-card-header">
                            <div class="user-avatar-large">JS</div>
                            <span class="kyc-status status-pending">⏳ PENDING</span>
                        </div>
                        <div class="kyc-user-info">
                            <div class="user-name">BRIJESH KUMAR</div>
                            <div class="user-details">
                                User ID: #10247<br>
                                Account: ACC170234567890<br>
                                Submitted: 2 hours ago
                            </div>
                        </div>
                        <div class="kyc-documents">
                            <div class="doc-label">Submitted Documents</div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">National ID Card</span>
                                <span class="doc-size">2.4 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">Proof of Address</span>
                                <span class="doc-size">1.8 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">🤳</span>
                                <span class="doc-name">Selfie Verification</span>
                                <span class="doc-size">1.2 MB</span>
                            </div>
                        </div>
                        <div class="kyc-actions">
                            <button class="btn btn-review" onclick="event.stopPropagation(); openVerificationModal(1)">
                                🔍 Review Now
                            </button>
                        </div>
                    </div>

                    <div class="kyc-card" onclick="openVerificationModal(2)">
                        <div class="kyc-card-header">
                            <div class="user-avatar-large">MR</div>
                            <span class="kyc-status status-pending">⏳ PENDING</span>
                        </div>
                        <div class="kyc-user-info">
                            <div class="user-name">AMAN KUMAR</div>
                            <div class="user-details">
                                User ID: #10251<br>
                                Account: ACC170234567895<br>
                                Submitted: 5 hours ago
                            </div>
                        </div>
                        <div class="kyc-documents">
                            <div class="doc-label">Submitted Documents</div>
                            <div class="doc-item">
                                <span class="doc-icon">🛂</span>
                                <span class="doc-name">Passport</span>
                                <span class="doc-size">3.1 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">Utility Bill</span>
                                <span class="doc-size">2.2 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">🤳</span>
                                <span class="doc-name">Live Photo</span>
                                <span class="doc-size">1.5 MB</span>
                            </div>
                        </div>
                        <div class="kyc-actions">
                            <button class="btn btn-review" onclick="event.stopPropagation(); openVerificationModal(2)">
                                🔍 Review Now
                            </button>
                        </div>
                    </div>

                    <div class="kyc-card" onclick="openVerificationModal(3)">
                        <div class="kyc-card-header">
                            <div class="user-avatar-large">AK</div>
                            <span class="kyc-status status-pending">⏳ PENDING</span>
                        </div>
                        <div class="kyc-user-info">
                            <div class="user-name">SAHIL KUMAR</div>
                            <div class="user-details">
                                User ID: #10252<br>
                                Account: ACC170234567896<br>
                                Submitted: 1 day ago
                            </div>
                        </div>
                        <div class="kyc-documents">
                            <div class="doc-label">Submitted Documents</div>
                            <div class="doc-item">
                                <span class="doc-icon">🪪</span>
                                <span class="doc-name">Driver License</span>
                                <span class="doc-size">2.7 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">Bank Statement</span>
                                <span class="doc-size">1.9 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">🤳</span>
                                <span class="doc-name">Selfie with ID</span>
                                <span class="doc-size">2.1 MB</span>
                            </div>
                        </div>
                        <div class="kyc-actions">
                            <button class="btn btn-review" onclick="event.stopPropagation(); openVerificationModal(3)">
                                🔍 Review Now
                            </button>
                        </div>
                    </div>

                    <div class="kyc-card" onclick="openVerificationModal(4)">
                        <div class="kyc-card-header">
                            <div class="user-avatar-large">LC</div>
                            <span class="kyc-status status-pending">⏳ PENDING</span>
                        </div>
                        <div class="kyc-user-info">
                            <div class="user-name">SURAJ SAHU</div>
                            <div class="user-details">
                                User ID: #10253<br>
                                Account: ACC170234567897<br>
                                Submitted: 1 day ago
                            </div>
                        </div>
                        <div class="kyc-documents">
                            <div class="doc-label">Submitted Documents</div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">National ID</span>
                                <span class="doc-size">2.3 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">📄</span>
                                <span class="doc-name">Residence Proof</span>
                                <span class="doc-size">1.7 MB</span>
                            </div>
                            <div class="doc-item">
                                <span class="doc-icon">🤳</span>
                                <span class="doc-name">Verification Photo</span>
                                <span class="doc-size">1.4 MB</span>
                            </div>
                        </div>
                        <div class="kyc-actions">
                            <button class="btn btn-review" onclick="event.stopPropagation(); openVerificationModal(4)">
                                🔍 Review Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Modal -->
    <div id="verificationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">KYC Verification Review</div>
                <button class="close-btn" onclick="closeModal()">×</button>
            </div>

            <div class="modal-body">
                <div class="verification-section">
                    <div class="section-title">👤 Applicant Information</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Full Name</span>
                            <span class="info-value">BRIJESH KUMAR</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Date of Birth</span>
                            <span class="info-value">March 15, 2004</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email Address</span>
                            <span class="info-value">brijeshkumar@email.com</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone Number</span>
                            <span class="info-value">+91 9856235461</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Address</span>
                            <span class="info-value">kalkaji, 110019</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Account Number</span>
                            <span class="info-value">ACC170234567890</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Application Date</span>
                            <span class="info-value">January 15, 2024, 10:30 AM</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">IP Address</span>
                            <span class="info-value">192.168.1.45</span>
                        </div>
                    </div>
                </div>

                <div class="verification-section">
                    <div class="section-title">📄 Submitted Documents (Encrypted at Rest)</div>
                    <div class="document-viewer">
                        <div class="document-preview" onclick="viewDocument('id-card')">
                            <div class="preview-icon">📄</div>
                            <div class="preview-title">National ID Card</div>
                            <div class="preview-subtitle">ID: US-123456789</div>
                            <div class="preview-subtitle">Expires: Dec 2028</div>
                            <span class="encrypted-badge">🔒 AES-256</span>
                        </div>

                        <div class="document-preview" onclick="viewDocument('address')">
                            <div class="preview-icon">🏠</div>
                            <div class="preview-title">Proof of Address</div>
                            <div class="preview-subtitle">Utility Bill - Jan 2024</div>
                            <div class="preview-subtitle">Address Verified</div>
                            <span class="encrypted-badge">🔒 AES-256</span>
                        </div>

                        <div class="document-preview" onclick="viewDocument('selfie')">
                            <div class="preview-icon">🤳</div>
                            <div class="preview-title">Selfie Verification</div>
                            <div class="preview-subtitle">Live photo with ID</div>
                            <div class="preview-subtitle">Face match pending</div>
                            <span class="encrypted-badge">🔒 AES-256</span>
                        </div>

                        <div class="document-preview" onclick="viewDocument('signature')">
                            <div class="preview-icon">✍️</div>
                            <div class="preview-title">Signature Sample</div>
                            <div class="preview-subtitle">Digital signature</div>
                            <div class="preview-subtitle">Verified</div>
                            <span class="encrypted-badge">🔒 AES-256</span>
                        </div>
                    </div>
                </div>

                <div class="verification-section">
                    <div class="section-title">✅ Verification Checklist</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Identity Document</span>
                            <span class="info-value">✓ Valid & Clear</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Face Match</span>
                            <span class="info-value">✓ 98% Match</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Address Proof</span>
                            <span class="info-value">✓ Current (within 3 months)</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Document Expiry</span>
                            <span class="info-value">✓ Valid until 2028</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fraud Check</span>
                            <span class="info-value">✓ No flags detected</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sanctions Screening</span>
                            <span class="info-value">✓ Clear</span>
                        </div>
                    </div>
                </div>

                <div class="notes-section">
                    <div class="section-title">📝 Reviewer Notes</div>
                    <textarea class="notes-textarea" placeholder="Add verification notes, observations, or reasons for approval/rejection..."></textarea>
                </div>

                <div class="security-warning">
                    🔐 <strong>Security Notice:</strong> All documents are encrypted at rest using AES-256 encryption. Access to these documents is logged and monitored. Only authorized personnel can view KYC documents.
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn btn-reject btn-large" onclick="rejectKYC()">
                    ❌ Reject Application
                </button>
                <button class="btn btn-approve btn-large" onclick="approveKYC()">
                    ✅ Approve & Verify
                </button>
            </div>
        </div>
    </div>

    <script>
        function openVerificationModal(userId) {
            document.getElementById('verificationModal').classList.add('show');
            console.log('Opening verification for user:', userId);
        }

        function closeModal() {
            document.getElementById('verificationModal').classList.remove('show');
        }

        function viewDocument(docType) {
            alert('🔒 Opening encrypted document: ' + docType + '\n\nDocument viewer would display:\n- Full resolution image\n- Zoom/pan controls\n- Metadata information\n- Encryption status\n\nAccess logged to audit trail.');
        }

        function approveKYC() {
            const notes = document.querySelector('.notes-textarea').value;

            if (confirm('✅ Approve this KYC application?\n\nThis action will:\n- Verify the user account\n- Grant full banking access\n- Be permanently logged in audit trail\n\nProceed with approval?')) {
                alert('✅ KYC Application APPROVED\n\n✓ User account verified\n✓ Full access')
            }
        }