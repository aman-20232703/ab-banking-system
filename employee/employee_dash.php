<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: #F8F9FA;
        }

        .gradient-card {
            background: linear-gradient(135deg, #5B6FD8 0%, #7B68D6 50%, #9B5FD4 100%);
        }

        .sidebar-item {
            transition: all 0.2s ease;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }

        .sidebar-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid white;
        }

        .btn-primary {
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(91, 111, 216, 0.2);
        }

        .item-row {
            transition: all 0.2s ease;
        }

        .item-row:hover {
            background: #F8F9FA;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-approved {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-rejected {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge-processing {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 32px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
        }

        .chat-message {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 12px;
            max-width: 80%;
        }

        .chat-message.sent {
            background: #5B6FD8;
            color: white;
            margin-left: auto;
        }

        .chat-message.received {
            background: #F3F4F6;
            color: #1F2937;
        }

        .notification-dot {
            width: 8px;
            height: 8px;
            background: #EF4444;
            border-radius: 50%;
            position: absolute;
            top: 8px;
            right: 8px;
        }

        .progress-bar {
            height: 8px;
            background: #E5E7EB;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #5B6FD8, #9B5FD4);
            transition: width 0.5s ease;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #D1D5DB;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .task-checkbox:hover {
            border-color: #5B6FD8;
        }

        .task-checkbox.checked {
            background: #5B6FD8;
            border-color: #5B6FD8;
        }

        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }

            .sidebar {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                z-index: 999;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                width: 64;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-container {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col sidebar">
            <!-- Logo -->
            <div class="p-6 flex items-center gap-3">
                <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                </svg>
                <span class="text-2xl font-bold">SecureBank</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 overflow-y-auto">
                <a href="#" class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="dashboard">
                    <span class="text-xl">🏠</span>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2 relative" data-page="communication">
                    <span class="text-xl">💬</span>
                    <span class="font-medium">Communication</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2 relative" data-page="cards">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">Cards</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="card.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2 relative" data-page="checkbook request">
                    <span class="text-xl">📧</span>
                    <span class="font-medium">Checkbook Request</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="card.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2 relative">
                    <span class="text-xl">🗝️</span>
                    <span class="font-medium">Pending</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="card.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2 relative">
                    <span class="text-xl">🖋️</span>
                    <span class="font-medium">Review Request</span>
                    <span class="notification-dot"></span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="customers">
                    <span class="text-xl">👥</span>
                    <span class="font-medium">Customers</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="loans">
                    <span class="text-xl">💰</span>
                    <span class="font-medium">Loan Operations</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="accounts">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">Account Requests</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="reports">
                    <span class="text-xl">📊</span>
                    <span class="font-medium">Reports</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="documents">
                    <span class="text-xl">📁</span>
                    <span class="font-medium">Documents</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="tasks">
                    <span class="text-xl">✅</span>
                    <span class="font-medium">Tasks</span>
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="settings">
                    <span class="text-xl">⚙️</span>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-white border-opacity-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-indigo-600 font-bold">
                        SK
                    </div>
                    <div>
                        <div class="font-semibold text-sm">Sarah Kumar</div>
                        <div class="text-xs opacity-75">Senior Associate</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto main-container">
            <!-- Header -->
            <div class="bg-white border-b border-gray-200 px-4 md:px-8 py-4 md:py-6 flex justify-between items-center sticky top-0 z-50">
                <button class="sidebar-toggle md:hidden text-2xl">☰</button>
                <div id="pageTitle" class="flex items-center gap-3">
                    <h1 class="text-2xl md:text-4xl font-bold text-gray-800">Welcome, Sarah!</h1>
                    <span class="text-2xl md:text-3xl">👋</span>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    <button class="relative p-2 md:p-3 hover:bg-gray-100 rounded-lg text-xl md:text-2xl">
                        🔔
                        <span class="notification-dot"></span>
                    </button>
                    <button class="bg-indigo-600 text-white px-3 md:px-6 py-2 md:py-3 rounded-lg font-semibold btn-primary text-sm md:text-base">
                        Actions
                    </button>
                </div>
            </div>

            <!-- Page Content -->
            <div id="pageContent" class="p-4 md:p-8">
                <!-- Dashboard Page (Default) -->
                <div id="dashboardPage" class="page-content fade-in">
                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                        <div class="stat-card bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">CUSTOMERS TODAY</div>
                            <div class="text-3xl md:text-4xl font-bold text-indigo-600 mb-2">24</div>
                            <div class="text-sm text-green-600 font-medium">↑ 12% from yesterday</div>
                        </div>

                        <div class="stat-card bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">PENDING REQUESTS</div>
                            <div class="text-3xl md:text-4xl font-bold text-amber-600 mb-2">8</div>
                            <div class="text-sm text-gray-600 font-medium">5 urgent items</div>
                        </div>

                        <div class="stat-card bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">LOAN APPROVALS</div>
                            <div class="text-3xl md:text-4xl font-bold text-purple-600 mb-2">6</div>
                            <div class="text-sm text-gray-600 font-medium">Awaiting verification</div>
                        </div>

                        <div class="stat-card bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">AVG SERVICE TIME</div>
                            <div class="text-3xl md:text-4xl font-bold text-teal-600 mb-2">12m</div>
                            <div class="text-sm text-green-600 font-medium">↓ 3min improved</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Today's Schedule -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Today's Schedule</h3>
                                <div class="space-y-4">
                                    <div class="flex items-start gap-4 p-4 bg-indigo-50 rounded-lg">
                                        <div class="text-center">
                                            <div class="text-sm font-semibold text-indigo-600">10:00</div>
                                            <div class="text-xs text-gray-500">AM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">Team Meeting</div>
                                            <div class="text-sm text-gray-600">Weekly performance review with Branch Manager</div>
                                        </div>
                                        <span class="text-xs bg-indigo-600 text-white px-3 py-1 rounded-full">In 30 min</span>
                                    </div>

                                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="text-center">
                                            <div class="text-sm font-semibold text-gray-600">11:30</div>
                                            <div class="text-xs text-gray-500">AM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">Customer Appointment</div>
                                            <div class="text-sm text-gray-600">John Smith - Loan consultation</div>
                                        </div>
                                        <span class="text-xs bg-gray-200 text-gray-700 px-3 py-1 rounded-full">Scheduled</span>
                                    </div>

                                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="text-center">
                                            <div class="text-sm font-semibold text-gray-600">2:00</div>
                                            <div class="text-xs text-gray-500">PM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">Document Verification</div>
                                            <div class="text-sm text-gray-600">Process KYC documents for 5 new accounts</div>
                                        </div>
                                        <span class="text-xs bg-gray-200 text-gray-700 px-3 py-1 rounded-full">Scheduled</span>
                                    </div>

                                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="text-center">
                                            <div class="text-sm font-semibold text-gray-600">4:30</div>
                                            <div class="text-xs text-gray-500">PM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">Training Session</div>
                                            <div class="text-sm text-gray-600">New banking software training</div>
                                        </div>
                                        <span class="text-xs bg-gray-200 text-gray-700 px-3 py-1 rounded-full">Optional</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Metrics -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">This Week's Performance</h3>
                                <div class="space-y-6">
                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="text-sm font-semibold text-gray-700">Loans Processed</span>
                                            <span class="text-sm font-bold text-indigo-600">18/20</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 90%"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="text-sm font-semibold text-gray-700">KYC Verifications</span>
                                            <span class="text-sm font-bold text-green-600">34/40</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 85%"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between mb-2">
                                            <span class="text-sm font-semibold text-gray-700">Account Openings</span>
                                            <span class="text-sm font-bold text-purple-600">12/15</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 80%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats & Messages -->
                        <div class="space-y-8">
                            <div class="bg-gradient-card rounded-2xl p-6 text-white shadow-lg">
                                <h3 class="text-lg font-bold mb-4">Quick Stats</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-sm opacity-90">Tasks Completed</span>
                                        <span class="font-bold">7/10</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm opacity-90">Pending Reviews</span>
                                        <span class="font-bold text-yellow-300">3</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm opacity-90">Approval Rate</span>
                                        <span class="font-bold text-green-300">92%</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Messages Preview -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Messages</h3>
                                <div class="space-y-3 text-sm">
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <div class="font-semibold text-gray-800">Manager</div>
                                        <div class="text-gray-600 text-xs mt-1">Review the policy doc...</div>
                                    </div>
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <div class="font-semibold text-gray-800">Team Lead</div>
                                        <div class="text-gray-600 text-xs mt-1">Great work on the KYC...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Communication Page -->
                <div id="communicationPage" class="page-content" style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Chat List -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-96 md:h-full flex flex-col">
                            <div class="p-4 border-b border-gray-200">
                                <h3 class="font-bold text-gray-800">Messages</h3>
                            </div>
                            <div class="flex-1 overflow-y-auto">
                                <div class="p-3 space-y-2">
                                    <div class="p-3 bg-indigo-50 rounded-lg cursor-pointer hover:bg-indigo-100">
                                        <div class="font-semibold text-sm text-gray-800">Admin Manager</div>
                                        <div class="text-xs text-gray-600">Latest message...</div>
                                    </div>
                                    <div class="p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                                        <div class="font-semibold text-sm text-gray-800">Team Lead</div>
                                        <div class="text-xs text-gray-600">Team meeting update...</div>
                                    </div>
                                    <div class="p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                                        <div class="font-semibold text-sm text-gray-800">HR Department</div>
                                        <div class="text-xs text-gray-600">Policy update...</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Window -->
                        <div class="md:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col">
                            <!-- Chat Header -->
                            <div class="p-6 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                                        AM
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">Admin Manager</div>
                                        <div class="text-sm text-green-600">● Online</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div class="flex-1 p-6 overflow-y-auto">
                                <div class="space-y-4">
                                    <div class="chat-message received">
                                        <div class="text-sm">Please review the new policy documents for personal loan interest rates. They need to be implemented by end of this week.</div>
                                        <div class="text-xs opacity-75 mt-1">10:45 AM</div>
                                    </div>

                                    <div class="chat-message sent">
                                        <div class="text-sm">Understood. I'll review them today and update all my pending loan applications accordingly.</div>
                                        <div class="text-xs opacity-75 mt-1">10:47 AM</div>
                                    </div>

                                    <div class="chat-message received">
                                        <div class="text-sm">Great! Also, please prioritize the 3 urgent KYC verifications that are pending since yesterday.</div>
                                        <div class="text-xs opacity-75 mt-1">10:48 AM</div>
                                    </div>

                                    <div class="chat-message sent">
                                        <div class="text-sm">Will do. I'll complete them before lunch and send you the update.</div>
                                        <div class="text-xs opacity-75 mt-1">10:50 AM</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Input -->
                            <div class="p-6 border-t border-gray-200">
                                <div class="flex gap-3">
                                    <input type="text" placeholder="Type your message..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 input-field text-sm">
                                    <button class="bg-indigo-600 text-white px-4 md:px-6 py-3 rounded-lg font-semibold btn-primary text-sm">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customers Page -->
                <div id="customersPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Customer Management</h2>

                        <!-- Search Bar -->
                        <div class="flex flex-col md:flex-row gap-4 mb-6">
                            <input type="text" placeholder="Search by name, account number, or mobile..." class="flex-1 px-4 md:px-6 py-3 md:py-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 input-field text-sm md:text-base">
                            <button class="bg-indigo-600 text-white px-6 md:px-8 py-3 md:py-4 rounded-lg font-semibold btn-primary">Search</button>
                        </div>
                    </div>

                    <!-- Customer List -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm md:text-base">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left py-4 px-4 md:px-6 font-semibold text-gray-600">Customer</th>
                                        <th class="text-left py-4 px-4 md:px-6 font-semibold text-gray-600 hidden sm:table-cell">Account</th>
                                        <th class="text-left py-4 px-4 md:px-6 font-semibold text-gray-600 hidden md:table-cell">Type</th>
                                        <th class="text-left py-4 px-4 md:px-6 font-semibold text-gray-600">Status</th>
                                        <th class="text-right py-4 px-4 md:px-6 font-semibold text-gray-600 hidden lg:table-cell">Balance</th>
                                        <th class="text-center py-4 px-4 md:px-6 font-semibold text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-t border-gray-100 item-row">
                                        <td class="py-4 px-4 md:px-6">
                                            <div class="flex items-center gap-2 md:gap-3">
                                                <div class="w-8 md:w-10 h-8 md:h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xs md:text-sm">
                                                    JS
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-800 text-sm">John Smith</div>
                                                    <div class="text-xs text-gray-500">john.smith@email.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-gray-800 hidden sm:table-cell text-sm">●●●● 1234</td>
                                        <td class="py-4 px-4 md:px-6 text-gray-600 hidden md:table-cell text-sm">Savings</td>
                                        <td class="py-4 px-4 md:px-6">
                                            <span class="badge badge-approved text-xs">Verified</span>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-right font-semibold text-gray-800 hidden lg:table-cell text-sm">$45,230</td>
                                        <td class="py-4 px-4 md:px-6 text-center">
                                            <button class="text-indigo-600 font-semibold text-xs md:text-sm hover:underline">View</button>
                                        </td>
                                    </tr>

                                    <tr class="border-t border-gray-100 item-row">
                                        <td class="py-4 px-4 md:px-6">
                                            <div class="flex items-center gap-2 md:gap-3">
                                                <div class="w-8 md:w-10 h-8 md:h-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs md:text-sm">
                                                    EM
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-800 text-sm">Emily Martinez</div>
                                                    <div class="text-xs text-gray-500">emily.m@email.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-gray-800 hidden sm:table-cell text-sm">●●●● 5678</td>
                                        <td class="py-4 px-4 md:px-6 text-gray-600 hidden md:table-cell text-sm">Checking</td>
                                        <td class="py-4 px-4 md:px-6">
                                            <span class="badge badge-pending text-xs">Pending</span>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-right font-semibold text-gray-800 hidden lg:table-cell text-sm">$12,840</td>
                                        <td class="py-4 px-4 md:px-6 text-center">
                                            <button class="text-indigo-600 font-semibold text-xs md:text-sm hover:underline">View</button>
                                        </td>
                                    </tr>

                                    <tr class="border-t border-gray-100 item-row">
                                        <td class="py-4 px-4 md:px-6">
                                            <div class="flex items-center gap-2 md:gap-3">
                                                <div class="w-8 md:w-10 h-8 md:h-10 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xs md:text-sm">
                                                    RJ
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-800 text-sm">Robert Johnson</div>
                                                    <div class="text-xs text-gray-500">r.johnson@email.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-gray-800 hidden sm:table-cell text-sm">●●●● 9012</td>
                                        <td class="py-4 px-4 md:px-6 text-gray-600 hidden md:table-cell text-sm">Savings</td>
                                        <td class="py-4 px-4 md:px-6">
                                            <span class="badge badge-approved text-xs">Verified</span>
                                        </td>
                                        <td class="py-4 px-4 md:px-6 text-right font-semibold text-gray-800 hidden lg:table-cell text-sm">$67,450</td>
                                        <td class="py-4 px-4 md:px-6 text-center">
                                            <button class="text-indigo-600 font-semibold text-xs md:text-sm hover:underline">View</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Loans Page -->
                <div id="loansPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <h2 class="text-3xl font-bold text-gray-800">Loan Operations</h2>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary">
                            📊 EMI Calculator
                        </button>
                    </div>

                    <!-- Loan Applications -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Pending Loan Applications</h3>
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4 md:p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <h4 class="font-bold text-lg text-gray-800 mb-2">Personal Loan</h4>
                                        <span class="badge badge-pending">Pending Verification</span>
                                    </div>
                                    <div class="md:text-right">
                                        <div class="text-sm text-gray-500">Loan Amount</div>
                                        <div class="text-2xl font-bold text-indigo-600">$50,000</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-4 text-sm">
                                    <div>
                                        <div class="text-xs text-gray-500">Applicant</div>
                                        <div class="font-semibold text-gray-800">John Smith</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Interest Rate</div>
                                        <div class="font-semibold text-gray-800">8.5% p.a.</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Tenure</div>
                                        <div class="font-semibold text-gray-800">5 years</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Applied On</div>
                                        <div class="font-semibold text-gray-800">Oct 20, 2025</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-sm font-semibold text-gray-700 mb-2">Document Status</div>
                                    <div class="flex gap-2 flex-wrap">
                                        <span class="badge badge-approved text-xs">✓ Income Proof</span>
                                        <span class="badge badge-approved text-xs">✓ ID Proof</span>
                                        <span class="badge badge-pending text-xs">⏳ Address Proof</span>
                                        <span class="badge badge-approved text-xs">✓ Bank Statement</span>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row gap-3">
                                    <button class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold btn-primary">✓ Approve</button>
                                    <button class="flex-1 bg-amber-600 text-white py-3 rounded-lg font-semibold btn-primary">📋 Request</button>
                                    <button class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold btn-primary">✗ Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Statistics -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">This Month</div>
                            <div class="text-3xl font-bold text-indigo-600 mb-1">18</div>
                            <div class="text-sm text-gray-600">Loans Processed</div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Total Amount</div>
                            <div class="text-3xl font-bold text-green-600 mb-1">$2.4M</div>
                            <div class="text-sm text-gray-600">Disbursed</div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Pending</div>
                            <div class="text-3xl font-bold text-amber-600 mb-1">6</div>
                            <div class="text-sm text-gray-600">Awaiting Approval</div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Approval Rate</div>
                            <div class="text-3xl font-bold text-teal-600 mb-1">87%</div>
                            <div class="text-sm text-gray-600">This Quarter</div>
                        </div>
                    </div>
                </div>

                <!-- Account Requests Page -->
                <div id="accountsPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Account Opening Requests</h2>
                        <p class="text-gray-600 mt-2">Review and verify new account applications</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="space-y-6">
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 md:w-16 h-12 md:h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg md:text-xl">
                                            DL
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-lg text-gray-800">David Lee</h4>
                                            <div class="text-sm text-gray-600">david.lee@email.com • +1 (555) 234-5678</div>
                                            <div class="text-xs text-gray-500 mt-1">Applied: Oct 22, 2025</div>
                                        </div>
                                    </div>
                                    <span class="badge badge-pending">Pending Review</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 text-sm">
                                    <div>
                                        <div class="text-xs text-gray-500">Account Type</div>
                                        <div class="font-semibold text-gray-800">Savings Account</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Initial Deposit</div>
                                        <div class="font-semibold text-gray-800">$5,000</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Branch</div>
                                        <div class="font-semibold text-gray-800">Downtown</div>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row gap-3">
                                    <button class="flex-1 bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">📄 View</button>
                                    <button class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold btn-primary">✓ Approve</button>
                                    <button class="flex-1 bg-amber-600 text-white py-3 rounded-lg font-semibold btn-primary">📋 Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports Page -->
                <div id="reportsPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Reports & Analytics</h2>
                        <p class="text-gray-600 mt-2">Track your performance and generate reports</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <button class="bg-white p-6 rounded-2xl shadow-lg text-left hover:shadow-xl transition">
                            <div class="text-3xl mb-3">📅</div>
                            <h3 class="font-bold text-gray-800 mb-2">Daily Report</h3>
                            <p class="text-sm text-gray-600">Today's activities and tasks</p>
                        </button>

                        <button class="bg-white p-6 rounded-2xl shadow-lg text-left hover:shadow-xl transition">
                            <div class="text-3xl mb-3">📊</div>
                            <h3 class="font-bold text-gray-800 mb-2">Weekly Report</h3>
                            <p class="text-sm text-gray-600">Week performance summary</p>
                        </button>

                        <button class="bg-white p-6 rounded-2xl shadow-lg text-left hover:shadow-xl transition">
                            <div class="text-3xl mb-3">📈</div>
                            <h3 class="font-bold text-gray-800 mb-2">Monthly Report</h3>
                            <p class="text-sm text-gray-600">Complete month overview</p>
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Performance Summary</h3>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 md:gap-6 mb-8">
                            <div>
                                <div class="text-sm text-gray-500 mb-2">Customers</div>
                                <div class="text-2xl md:text-3xl font-bold text-indigo-600">142</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-2">Loans</div>
                                <div class="text-2xl md:text-3xl font-bold text-green-600">18</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-2">Accounts</div>
                                <div class="text-2xl md:text-3xl font-bold text-purple-600">38</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 mb-2">Rating</div>
                                <div class="text-2xl md:text-3xl font-bold text-amber-600">4.8/5</div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm font-semibold text-gray-700">Task Completion Rate</span>
                                    <span class="text-sm font-bold text-indigo-600">92%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 92%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm font-semibold text-gray-700">Response Time</span>
                                    <span class="text-sm font-bold text-green-600">8 mins avg</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 88%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm font-semibold text-gray-700">Customer Satisfaction</span>
                                    <span class="text-sm font-bold text-purple-600">96%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 96%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Page -->
                <div id="documentsPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">Document Management</h2>
                            <p class="text-gray-600 mt-2">Access forms and manage documents</p>
                        </div>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary">
                            📤 Upload
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Bank Forms & Templates</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">📄</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">KYC Form</div>
                                        <div class="text-xs text-gray-500 mb-3">Individual verification</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">📋</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">Loan Application</div>
                                        <div class="text-xs text-gray-500 mb-3">Personal & home loans</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">💳</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">Account Opening</div>
                                        <div class="text-xs text-gray-500 mb-3">Savings & checking</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">🔄</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">Transfer Forms</div>
                                        <div class="text-xs text-gray-500 mb-3">Domestic & international</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">📝</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">Complaint Form</div>
                                        <div class="text-xs text-gray-500 mb-3">Customer grievance</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition cursor-pointer">
                                <div class="flex items-start gap-3">
                                    <span class="text-3xl">🏢</span>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-800 mb-1">Business Account</div>
                                        <div class="text-xs text-gray-500 mb-3">Corporate opening</div>
                                        <button class="text-indigo-600 text-sm font-semibold hover:underline">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasks Page -->
                <div id="tasksPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <h2 class="text-3xl font-bold text-gray-800">Task Management</h2>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary">
                            + New Task
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Today's Tasks</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Complete KYC verification for 3 accounts</div>
                                            <div class="text-sm text-gray-600">Priority: High • Due: Today 5:00 PM</div>
                                        </div>
                                        <span class="badge badge-pending text-xs">Urgent</span>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox checked"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800 line-through opacity-50">Review loan application #PL-2025-1234</div>
                                            <div class="text-sm text-gray-600">Priority: High • Completed</div>
                                        </div>
                                        <span class="badge badge-approved text-xs">Done</span>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Follow up with customer - John Smith</div>
                                            <div class="text-sm text-gray-600">Priority: Medium • Due: Today 3:00 PM</div>
                                        </div>
                                        <span class="badge badge-processing text-xs">Today</span>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Update customer account notes</div>
                                            <div class="text-sm text-gray-600">Priority: Low • Due: Tomorrow</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox checked"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800 line-through opacity-50">Send daily report to admin</div>
                                            <div class="text-sm text-gray-600">Priority: Medium • Completed</div>
                                        </div>
                                        <span class="badge badge-approved text-xs">Done</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Upcoming This Week</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Attend training session on new software</div>
                                            <div class="text-sm text-gray-600">Priority: Medium • Due: Oct 26</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Process month-end reports</div>
                                            <div class="text-sm text-gray-600">Priority: High • Due: Oct 31</div>
                                        </div>
                                        <span class="badge badge-pending text-xs">Important</span>
                                    </div>

                                    <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg item-row">
                                        <div class="task-checkbox"></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-semibold text-gray-800">Customer satisfaction survey follow-ups</div>
                                            <div class="text-sm text-gray-600">Priority: Low • Due: Oct 28</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Task Summary</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Total Tasks</span>
                                        <span class="text-2xl font-bold text-gray-800">8</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Completed</span>
                                        <span class="text-2xl font-bold text-green-600">2</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">In Progress</span>
                                        <span class="text-2xl font-bold text-amber-600">4</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Pending</span>
                                        <span class="text-2xl font-bold text-red-600">2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-card rounded-2xl p-6 text-white shadow-lg">
                                <h3 class="text-lg font-bold mb-4">🔔 Reminders</h3>
                                <div class="space-y-3">
                                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                                        <div class="font-semibold text-sm">Team Meeting</div>
                                        <div class="text-xs opacity-90">In 30 minutes</div>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                                        <div class="font-semibold text-sm">Loan Deadline</div>
                                        <div class="text-xs opacity-90">Today 5:00 PM</div>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                                        <div class="font-semibold text-sm">KYC Review</div>
                                        <div class="text-xs opacity-90">2 hours remaining</div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Completion Rate</h3>
                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">This Week</span>
                                        <span class="font-bold text-indigo-600">75%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Page -->
                <div id="settingsPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Settings & Profile</h2>
                        <p class="text-gray-600 mt-2">Manage your account preferences</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Employee Profile</h3>

                                <div class="mb-6 flex justify-center">
                                    <div class="relative">
                                        <div class="w-20 md:w-24 h-20 md:h-24 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-2xl md:text-3xl">
                                            SK
                                        </div>
                                        <button class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-indigo-600 border-2 border-indigo-600">
                                            📷
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                        <input type="text" value="Sarah" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                        <input type="text" value="Kumar" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input type="email" value="sarah.kumar@securebank.com" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                    <input type="tel" value="+1 (555) 987-6543" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Department</label>
                                    <input type="text" value="Customer Service" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" disabled>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Employee ID</label>
                                    <input type="text" value="EMP-2024-1567" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" disabled>
                                </div>

                                <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">
                                    Save Changes
                                </button>
                            </div>

                            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Security Settings</h3>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                                    <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                    <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                                    <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                </div>

                                <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary mb-4">
                                    Update Password
                                </button>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-gray-700 font-semibold">Two-Factor Authentication</span>
                                        <button class="w-12 h-6 bg-indigo-600 rounded-full relative">
                                            <div class="absolute top-1 right-1 w-4 h-4 bg-white rounded-full"></div>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-600">Enhance your account security with 2FA</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Notifications</h3>
                                <div class="space-y-4">
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" checked class="w-4 h-4">
                                        <span class="text-gray-700 text-sm">Email Notifications</span>
                                    </label>
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" checked class="w-4 h-4">
                                        <span class="text-gray-700 text-sm">Push Notifications</span>
                                    </label>
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" class="w-4 h-4">
                                        <span class="text-gray-700 text-sm">SMS Notifications</span>
                                    </label>
                                    <label class="flex items-center gap-3">
                                        <input type="checkbox" checked class="w-4 h-4">
                                        <span class="text-gray-700 text-sm">Task Reminders</span>
                                    </label>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Preferences</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Theme</label>
                                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                            <option>Light</option>
                                            <option>Dark</option>
                                            <option>Auto</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Language</label>
                                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                            <option>English</option>
                                            <option>Spanish</option>
                                            <option>French</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Actions</h3>
                                <button class="w-full text-red-600 py-2 rounded-lg font-semibold border border-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Page Navigation
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        const pageContents = document.querySelectorAll('.page-content');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContainer = document.querySelector('.main-container');

        // Toggle sidebar on mobile
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                mainContainer.classList.toggle('w-full');
            });
        }

        sidebarItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                // Remove active class from all sidebar items
                sidebarItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                // Hide all pages
                pageContents.forEach(page => page.style.display = 'none');

                // Show selected page
                const pageId = item.getAttribute('data-page') + 'Page';
                document.getElementById(pageId).style.display = '';

                // Close sidebar on mobile
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('active');
                }
            });
        });

        // Task checkbox functionality
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                this.classList.toggle('checked');
            });
        });

        // Form input handling
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.outline = 'none';
            });
        });

        // Button click handlers
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                // Prevent default form submission
                if (this.tagName === 'BUTTON' && this.type !== 'submit') {
                    // Handle button actions
                    console.log('Button clicked:', this.textContent);
                }
            });
        });

        // Responsive behavior
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>

</html>