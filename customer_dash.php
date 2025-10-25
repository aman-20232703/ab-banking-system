<?php
include 'dbconnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Banking Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="customer_dash.css">
    <script src="customer_dash.js"></script>
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 text-white flex flex-col">
            <!-- Logo -->
            <div class="p-6 flex items-center gap-3">
                <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                </svg>
                <span class="text-2xl font-bold" style="font-family:Brush Script MT,cursive;font-size: 30px; color: #333;">AmarJesh Bank</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4">
                <a href="#" class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="dashboard">
                    <span class="text-xl">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="account_open.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="open">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">Open Account</span>
                </a>
                <a href="status.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="status">
                    <span class="text-xl">💳</span>
                    <span class="font-medium">Check Status</span>
                </a>

                <?php if ($approved) { ?>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="accounts">
                        <span class="text-xl">💳</span>
                        <span class="font-medium">Accounts</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="transfers">
                        <span class="text-xl">💸</span>
                        <span class="font-medium">Transfers</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="beneficiaries">
                        <span class="text-xl">👥</span>
                        <span class="font-medium">Beneficiaries</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="loans">
                        <span class="text-xl">💰</span>
                        <span class="font-medium">Loans</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="investments">
                        <span class="text-xl">📈</span>
                        <span class="font-medium">Investments</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="settings">
                        <span class="text-xl">⚙️</span>
                        <span class="font-medium">Settings</span>
                    </a>
                <?php } ?>
                    <a href="logout.php" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2" data-page="logout">
                        <span class="text-xl">🚪</span>
                        <span class="font-medium">Logout</span>
                    </a>

            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <!-- Header -->
            <div class="bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
                <div id="pageTitle" class="flex items-center gap-3">
                    <h1 class="text-4xl font-bold text-gray-800">Welcome back, John!</h1>
                    <span class="text-3xl">👋</span>
                </div>
                <div class="flex items-center gap-4">
                    <button id="freezeAccountBtn" class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold btn-primary flex items-center gap-2">
                        <span>❄️</span>
                        Freeze Account
                    </button>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            JD
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">Aman Kumar</div>
                            <div class="text-sm text-gray-500">aman@example.com</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div id="pageContent" class="p-8">
                <!-- Dashboard Page (Default) -->
                <div id="dashboardPage" class="page-content fade-in">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Savings Account Card -->
                        <div class="gradient-card rounded-3xl p-8 text-white shadow-lg">
                            <div class="text-sm font-medium mb-2 opacity-90">SAVINGS ACCOUNT</div>
                            <div class="blur-text text-lg mb-4">●●●● ●●●● ●●●● 5678</div>
                            <div class="text-sm mb-2 opacity-90 cursor-pointer hover:opacity-100" id="revealBalance">Click to reveal</div>
                            <div class="text-5xl font-bold mb-2">$45,230.50</div>
                            <div class="text-sm opacity-90">Available Balance</div>
                        </div>

                        <!-- Monthly Income Card -->
                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">MONTHLY INCOME</div>
                            <div class="text-5xl font-bold text-indigo-600 mb-2">$8,450</div>
                            <div class="text-sm text-green-600 font-medium">+12% from last month</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Monthly Expenses Card -->
                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <div class="text-sm font-medium text-gray-500 mb-2">MONTHLY EXPENSES</div>
                            <div class="text-5xl font-bold text-indigo-600 mb-2">$3,280</div>
                            <div class="text-sm text-red-600 font-medium">-5% from last month</div>
                        </div>

                        <!-- Recent Transactions -->
                        <div class="bg-white rounded-3xl p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Transactions</h3>
                            <div class="space-y-3">
                                <div class="transaction-item flex justify-between items-center p-3 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">↓</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Salary Deposit</div>
                                            <div class="text-sm text-gray-500">Oct 1, 2025</div>
                                        </div>
                                    </div>
                                    <div class="font-bold text-green-600">+$8,450</div>
                                </div>
                                <div class="transaction-item flex justify-between items-center p-3 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">↑</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Rent Payment</div>
                                            <div class="text-sm text-gray-500">Oct 5, 2025</div>
                                        </div>
                                    </div>
                                    <div class="font-bold text-red-600">-$1,500</div>
                                </div>
                                <div class="transaction-item flex justify-between items-center p-3 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">↑</div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Grocery Shopping</div>
                                            <div class="text-sm text-gray-500">Oct 8, 2025</div>
                                        </div>
                                    </div>
                                    <div class="font-bold text-red-600">-$245</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accounts Page -->
                <div id="accountsPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex justify-between items-center">
                        <h2 class="text-3xl font-bold text-gray-800">My Accounts</h2>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addAccountBtn">+ Add Account</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Savings Account -->
                        <div class="account-card gradient-card rounded-2xl p-6 text-white shadow-lg">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-sm opacity-90 mb-1">SAVINGS ACCOUNT</div>
                                    <div class="text-xs opacity-75">●●●● 5678</div>
                                </div>
                                <div class="text-2xl">💰</div>
                            </div>
                            <div class="text-3xl font-bold mb-2">$45,230.50</div>
                            <div class="text-xs opacity-90">Available Balance</div>
                        </div>

                        <!-- Checking Account -->
                        <div class="account-card bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-sm opacity-90 mb-1">CHECKING ACCOUNT</div>
                                    <div class="text-xs opacity-75">●●●● 1234</div>
                                </div>
                                <div class="text-2xl">💳</div>
                            </div>
                            <div class="text-3xl font-bold mb-2">$12,450.00</div>
                            <div class="text-xs opacity-90">Available Balance</div>
                        </div>

                        <!-- Credit Card -->
                        <div class="account-card bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="text-sm opacity-90 mb-1">CREDIT CARD</div>
                                    <div class="text-xs opacity-75">●●●● 9876</div>
                                </div>
                                <div class="text-2xl">💎</div>
                            </div>
                            <div class="text-3xl font-bold mb-2">$2,340.00</div>
                            <div class="text-xs opacity-90">Current Balance | Limit: $10,000</div>
                        </div>
                    </div>

                    <!-- Transaction History -->
                    <div class="mt-8 bg-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Transaction History</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Date</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Description</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Account</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Amount</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionTableBody">
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4 text-gray-600">Oct 13, 2025</td>
                                        <td class="py-3 px-4 font-semibold text-gray-800">Online Purchase</td>
                                        <td class="py-3 px-4 text-gray-600">Checking ●●●● 1234</td>
                                        <td class="py-3 px-4 text-right font-bold text-red-600">-$89.99</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$12,450.00</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4 text-gray-600">Oct 10, 2025</td>
                                        <td class="py-3 px-4 font-semibold text-gray-800">ATM Withdrawal</td>
                                        <td class="py-3 px-4 text-gray-600">Savings ●●●● 5678</td>
                                        <td class="py-3 px-4 text-right font-bold text-red-600">-$200.00</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$45,230.50</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4 text-gray-600">Oct 8, 2025</td>
                                        <td class="py-3 px-4 font-semibold text-gray-800">Grocery Shopping</td>
                                        <td class="py-3 px-4 text-gray-600">Credit Card ●●●● 9876</td>
                                        <td class="py-3 px-4 text-right font-bold text-red-600">-$245.00</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$2,340.00</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4 text-gray-600">Oct 5, 2025</td>
                                        <td class="py-3 px-4 font-semibold text-gray-800">Rent Payment</td>
                                        <td class="py-3 px-4 text-gray-600">Checking ●●●● 1234</td>
                                        <td class="py-3 px-4 text-right font-bold text-red-600">-$1,500.00</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$12,539.99</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4 text-gray-600">Oct 1, 2025</td>
                                        <td class="py-3 px-4 font-semibold text-gray-800">Salary Deposit</td>
                                        <td class="py-3 px-4 text-gray-600">Checking ●●●● 1234</td>
                                        <td class="py-3 px-4 text-right font-bold text-green-600">+$8,450.00</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$14,039.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Transfers Page -->
                <div id="transfersPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Transfer Money</h2>
                        <p class="text-gray-600 mt-2">Send money to your accounts or other beneficiaries</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Transfer Form -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">New Transfer</h3>
                            <form id="transferForm">
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">From Account</label>
                                    <select class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        <option>Savings Account (●●●● 5678) - $45,230.50</option>
                                        <option>Checking Account (●●●● 1234) - $12,450.00</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Transfer Type</label>
                                    <select id="transferType" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        <option value="own">To My Account</option>
                                        <option value="beneficiary">To Beneficiary</option>
                                        <option value="external">External Transfer</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">To Account</label>
                                    <select class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        <option>Checking Account (●●●● 1234)</option>
                                        <option>Credit Card (●●●● 9876)</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Amount</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 text-gray-600 text-lg">$</span>
                                        <input type="number" class="input-field w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" placeholder="0.00" step="0.01" required>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                                    <textarea class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" rows="3" placeholder="Add a note..."></textarea>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-lg font-bold text-lg btn-primary">
                                    Transfer Now
                                </button>
                            </form>
                        </div>

                        <!-- Recent Transfers -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Recent Transfers</h3>
                            <div class="space-y-4">
                                <div class="p-4 border border-gray-200 rounded-lg transaction-item">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <div class="font-semibold text-gray-800">To Checking Account</div>
                                            <div class="text-sm text-gray-500">Oct 10, 2025 • 2:30 PM</div>
                                        </div>
                                        <div class="font-bold text-indigo-600">$500.00</div>
                                    </div>
                                    <div class="text-xs text-gray-600">From: Savings ●●●● 5678</div>
                                    <div class="text-xs text-gray-600">To: Checking ●●●● 1234</div>
                                    <div class="mt-2 inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</div>
                                </div>

                                <div class="p-4 border border-gray-200 rounded-lg transaction-item">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <div class="font-semibold text-gray-800">To brijesh kumar</div>
                                            <div class="text-sm text-gray-500">Oct 8, 2025 • 11:15 AM</div>
                                        </div>
                                        <div class="font-bold text-indigo-600">$250.00</div>
                                    </div>
                                    <div class="text-xs text-gray-600">From: Checking ●●●● 1234</div>
                                    <div class="text-xs text-gray-600">Dinner split payment</div>
                                    <div class="mt-2 inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</div>
                                </div>

                                <div class="p-4 border border-gray-200 rounded-lg transaction-item">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <div class="font-semibold text-gray-800">Credit Card Payment</div>
                                            <div class="text-sm text-gray-500">Oct 5, 2025 • 9:00 AM</div>
                                        </div>
                                        <div class="font-bold text-indigo-600">$1,000.00</div>
                                    </div>
                                    <div class="text-xs text-gray-600">From: Checking ●●●● 1234</div>
                                    <div class="text-xs text-gray-600">To: Credit Card ●●●● 9876</div>
                                    <div class="mt-2 inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Completed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Beneficiaries Page -->
                <div id="beneficiariesPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">Beneficiaries</h2>
                            <p class="text-gray-600 mt-2">Manage your saved beneficiaries</p>
                        </div>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="addBeneficiaryBtn">+ Add Beneficiary</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white rounded-2xl p-6 shadow-lg card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    SJ
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">⋮</button>
                            </div>
                            <div class="font-bold text-gray-800 text-lg mb-1">brijesh kumar</div>
                            <div class="text-sm text-gray-500 mb-3">brijesh@email.com</div>
                            <div class="text-xs text-gray-600 mb-4">Account: ●●●● 7890</div>
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                                Send Money
                            </button>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    MB
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">⋮</button>
                            </div>
                            <div class="font-bold text-gray-800 text-lg mb-1">suraj sahu</div>
                            <div class="text-sm text-gray-500 mb-3">suraj@email.com</div>
                            <div class="text-xs text-gray-600 mb-4">Account: ●●●● 4567</div>
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                                Send Money
                            </button>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    EW
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">⋮</button>
                            </div>
                            <div class="font-bold text-gray-800 text-lg mb-1">aashu</div>
                            <div class="text-sm text-gray-500 mb-3">aashu@email.com</div>
                            <div class="text-xs text-gray-600 mb-4">Account: ●●●● 3456</div>
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                                Send Money
                            </button>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    DL
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">⋮</button>
                            </div>
                            <div class="font-bold text-gray-800 text-lg mb-1">sahil kumar</div>
                            <div class="text-sm text-gray-500 mb-3">sahil@email.com</div>
                            <div class="text-xs text-gray-600 mb-4">Account: ●●●● 8901</div>
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                                Send Money
                            </button>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg card">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    JM
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">⋮</button>
                            </div>
                            <div class="font-bold text-gray-800 text-lg mb-1">vikash kumar</div>
                            <div class="text-sm text-gray-500 mb-3">vikash@email.com</div>
                            <div class="text-xs text-gray-600 mb-4">Account: ●●●● 2345</div>
                            <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100 transition">
                                Send Money
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Loans Page -->
                <div id="loansPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">My Loans</h2>
                            <p class="text-gray-600 mt-2">Track and manage your loans</p>
                        </div>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="applyLoanBtn">Apply for Loan</button>
                    </div>

                    <!-- Active Loans -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Active Loans</h3>
                        <div class="space-y-6">
                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Home Mortgage</h4>
                                        <p class="text-sm text-gray-500">Loan ID: #HL-2023-001</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500">Monthly Payment</div>
                                        <div class="text-2xl font-bold text-indigo-600">$2,450</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <div class="text-xs text-gray-500">Loan Amount</div>
                                        <div class="font-semibold text-gray-800">$350,000</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Outstanding</div>
                                        <div class="font-semibold text-gray-800">$287,500</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Interest Rate</div>
                                        <div class="font-semibold text-gray-800">3.75%</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Next Payment</div>
                                        <div class="font-semibold text-gray-800">Nov 1, 2025</div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Progress</span>
                                        <span class="font-semibold text-gray-800">17.9% paid</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="loan-progress bg-gradient-to-r from-indigo-600 to-purple-600 h-3 rounded-full" style="width: 17.9%"></div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-4">
                                    <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg font-semibold btn-primary">Make Payment</button>
                                    <button class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-200">View Details</button>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl p-6 shadow-lg">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Car Loan</h4>
                                        <p class="text-sm text-gray-500">Loan ID: #CL-2024-045</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500">Monthly Payment</div>
                                        <div class="text-2xl font-bold text-indigo-600">$580</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <div class="text-xs text-gray-500">Loan Amount</div>
                                        <div class="font-semibold text-gray-800">$28,000</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Outstanding</div>
                                        <div class="font-semibold text-gray-800">$15,680</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Interest Rate</div>
                                        <div class="font-semibold text-gray-800">4.25%</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Next Payment</div>
                                        <div class="font-semibold text-gray-800">Nov 1, 2025</div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Progress</span>
                                        <span class="font-semibold text-gray-800">44% paid</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="loan-progress bg-gradient-to-r from-emerald-500 to-teal-600 h-3 rounded-full" style="width: 44%"></div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-4">
                                    <button class="flex-1 bg-indigo-600 text-white py-2 rounded-lg font-semibold btn-primary">Make Payment</button>
                                    <button class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-200">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loan Calculator -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Loan Calculator</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Loan Amount ($)</label>
                                    <input type="number" id="loanAmount" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" value="50000">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Interest Rate (%)</label>
                                    <input type="number" id="loanRate" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" value="5.5" step="0.1">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Loan Term (years)</label>
                                    <input type="number" id="loanTerm" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" value="5">
                                </div>
                                <button id="calculateLoan" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">Calculate</button>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-sm text-gray-500 mb-2">Estimated Monthly Payment</div>
                                    <div id="monthlyPayment" class="text-5xl font-bold text-indigo-600 mb-4">$953</div>
                                    <div class="text-sm text-gray-600">
                                        <div>Total Interest: <span id="totalInterest" class="font-semibold">$7,180</span></div>
                                        <div>Total Amount: <span id="totalAmount" class="font-semibold">$57,180</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Investments Page -->
                <div id="investmentsPage" class="page-content" style="display: none;">
                    <div class="mb-6 flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800">Investments</h2>
                            <p class="text-gray-600 mt-2">Track your investment portfolio</p>
                        </div>
                        <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary" id="newInvestmentBtn">+ New Investment</button>
                    </div>

                    <!-- Portfolio Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
                            <div class="text-sm opacity-90 mb-2">Total Portfolio Value</div>
                            <div class="text-3xl font-bold">$125,450</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Total Gain/Loss</div>
                            <div class="text-3xl font-bold text-green-600">+$12,340</div>
                            <div class="text-sm text-green-600 font-medium">+10.9%</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Monthly Return</div>
                            <div class="text-3xl font-bold text-green-600">+$2,150</div>
                            <div class="text-sm text-green-600 font-medium">+1.7%</div>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <div class="text-sm text-gray-500 mb-2">Total Investments</div>
                            <div class="text-3xl font-bold text-gray-800">12</div>
                        </div>
                    </div>

                    <!-- Investment Holdings -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Your Holdings</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Asset</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-600">Type</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Quantity</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Price</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Value</th>
                                        <th class="text-right py-3 px-4 font-semibold text-gray-600">Gain/Loss</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-800">Apple Inc.</div>
                                            <div class="text-sm text-gray-500">AAPL</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">Stock</td>
                                        <td class="py-3 px-4 text-right text-gray-800">50</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$178.50</td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-800">$8,925</td>
                                        <td class="py-3 px-4 text-right font-bold text-green-600">+$1,425 (19%)</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-800">Microsoft Corp.</div>
                                            <div class="text-sm text-gray-500">MSFT</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">Stock</td>
                                        <td class="py-3 px-4 text-right text-gray-800">30</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$335.20</td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-800">$10,056</td>
                                        <td class="py-3 px-4 text-right font-bold text-green-600">+$2,056 (26%)</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-800">S&P 500 ETF</div>
                                            <div class="text-sm text-gray-500">SPY</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">ETF</td>
                                        <td class="py-3 px-4 text-right text-gray-800">100</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$445.80</td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-800">$44,580</td>
                                        <td class="py-3 px-4 text-right font-bold text-green-600">+$4,580 (11%)</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-800">Tesla Inc.</div>
                                            <div class="text-sm text-gray-500">TSLA</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">Stock</td>
                                        <td class="py-3 px-4 text-right text-gray-800">25</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$245.60</td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-800">$6,140</td>
                                        <td class="py-3 px-4 text-right font-bold text-red-600">-$360 (-5.5%)</td>
                                    </tr>
                                    <tr class="border-b border-gray-100 transaction-item">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-gray-800">Bitcoin</div>
                                            <div class="text-sm text-gray-500">BTC</div>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">Crypto</td>
                                        <td class="py-3 px-4 text-right text-gray-800">0.5</td>
                                        <td class="py-3 px-4 text-right text-gray-800">$67,890</td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-800">$33,945</td>
                                        <td class="py-3 px-4 text-right font-bold text-green-600">+$8,945 (36%)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Investment Opportunities -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Recommended Investments</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="border border-gray-200 rounded-xl p-6 card">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-lg">
                                        📊
                                    </div>
                                    <div class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-semibold">Low Risk</div>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Index Fund Portfolio</h4>
                                <p class="text-sm text-gray-600 mb-4">Diversified portfolio tracking major indices with stable returns.</p>
                                <div class="text-sm text-gray-600 mb-4">
                                    <div>Expected Return: <span class="font-semibold text-green-600">7-9% annually</span></div>
                                </div>
                                <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100">Learn More</button>
                            </div>

                            <div class="border border-gray-200 rounded-xl p-6 card">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 font-bold text-lg">
                                        💎
                                    </div>
                                    <div class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full font-semibold">Medium Risk</div>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Growth Stocks</h4>
                                <p class="text-sm text-gray-600 mb-4">High-potential technology and growth companies.</p>
                                <div class="text-sm text-gray-600 mb-4">
                                    <div>Expected Return: <span class="font-semibold text-green-600">12-18% annually</span></div>
                                </div>
                                <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100">Learn More</button>
                            </div>

                            <div class="border border-gray-200 rounded-xl p-6 card">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-lg">
                                        🚀
                                    </div>
                                    <div class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full font-semibold">High Risk</div>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Cryptocurrency</h4>
                                <p class="text-sm text-gray-600 mb-4">Digital assets with high volatility and growth potential.</p>
                                <div class="text-sm text-gray-600 mb-4">
                                    <div>Expected Return: <span class="font-semibold text-green-600">20-50% annually</span></div>
                                </div>
                                <button class="w-full bg-indigo-50 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-100">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Page -->
                <div id="settingsPage" class="page-content" style="display: none;">
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">Settings</h2>
                        <p class="text-gray-600 mt-2">Manage your account preferences</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Settings Navigation -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg h-fit">
                            <nav class="space-y-2">
                                <a href="#" class="settings-tab active flex items-center gap-3 px-4 py-3 rounded-lg bg-indigo-50 text-indigo-600 font-semibold" data-tab="profile">
                                    <span>👤</span>
                                    Profile
                                </a>
                                <a href="#" class="settings-tab flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50" data-tab="security">
                                    <span>🔒</span>
                                    Security
                                </a>
                                <a href="#" class="settings-tab flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50" data-tab="notifications">
                                    <span>🔔</span>
                                    Notifications
                                </a>
                                <a href="#" class="settings-tab flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50" data-tab="preferences">
                                    <span>⚙️</span>
                                    Preferences
                                </a>
                            </nav>
                        </div>

                        <!-- Settings Content -->
                        <div class="lg:col-span-2">
                            <!-- Profile Tab -->
                            <div id="profileTab" class="settings-content bg-white rounded-2xl p-8 shadow-lg">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6">Profile Information</h3>
                                <form>
                                    <div class="mb-6 flex justify-center">
                                        <div class="relative">
                                            <div class="w-24 h-24 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-3xl">
                                                AB
                                            </div>
                                            <button type="button" class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-indigo-600 border-2 border-indigo-600">
                                                📷
                                            </button>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                            <input type="text" value="Aman" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                            <input type="text" value="Brijesh" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                        <input type="email" value="brijesh@example.com" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" value="+91 8102140053" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                                        <textarea class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" rows="3">kalkaji , 110019</textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">
                                        Save Changes
                                    </button>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div id="securityTab" class="settings-content bg-white rounded-2xl p-8 shadow-lg" style="display: none;">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6">Security Settings</h3>

                                <div class="mb-8">
                                    <h4 class="font-bold text-gray-800 mb-4">Change Password</h4>
                                    <form>
                                        <div class="mb-4">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                                            <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                                            <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                                            <input type="password" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                        </div>
                                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold btn-primary">
                                            Update Password
                                        </button>
                                    </form>
                                </div>

                                <div class="mb-8">
                                    <h4 class="font-bold text-gray-800 mb-4">Two-Factor Authentication</h4>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">SMS Authentication</div>
                                            <div class="text-sm text-gray-600">Receive codes via SMS</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="sms-2fa"></div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-gray-800 mb-4">Active Sessions</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="text-2xl">💻</div>
                                                <div>
                                                    <div class="font-semibold text-gray-800">Chrome on Windows</div>
                                                    <div class="text-sm text-gray-600">New York, USA • Current session</div>
                                                </div>
                                            </div>
                                            <div class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">Active</div>
                                        </div>
                                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                            <div class="flex items-center gap-3">
                                                <div class="text-2xl">📱</div>
                                                <div>
                                                    <div class="font-semibold text-gray-800">iPhone 14 Pro</div>
                                                    <div class="text-sm text-gray-600">New York, USA • 2 hours ago</div>
                                                </div>
                                            </div>
                                            <button class="text-red-600 font-semibold text-sm">Revoke</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notifications Tab -->
                            <div id="notificationsTab" class="settings-content bg-white rounded-2xl p-8 shadow-lg" style="display: none;">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6">Notification Preferences</h3>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Email Notifications</div>
                                            <div class="text-sm text-gray-600">Receive updates via email</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="email-notif"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Push Notifications</div>
                                            <div class="text-sm text-gray-600">Receive push notifications on your devices</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="push-notif"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Transaction Alerts</div>
                                            <div class="text-sm text-gray-600">Get notified for every transaction</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="transaction-alert"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Payment Reminders</div>
                                            <div class="text-sm text-gray-600">Reminders for upcoming payments</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="payment-reminder"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Security Alerts</div>
                                            <div class="text-sm text-gray-600">Important security notifications</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="security-alert"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Marketing Emails</div>
                                            <div class="text-sm text-gray-600">Promotional offers and updates</div>
                                        </div>
                                        <div class="toggle-switch" data-setting="marketing-email"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Preferences Tab -->
                            <div id="preferencesTab" class="settings-content bg-white rounded-2xl p-8 shadow-lg" style="display: none;">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6">Account Preferences</h3>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Language</label>
                                        <select class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                            <option>English (US)</option>
                                            <option>Spanish</option>
                                            <option>French</option>
                                            <option>German</option>
                                            <option>Chinese</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Currency</label>
                                        <select class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                            <option>USD ($)</option>
                                            <option>EUR (€)</option>
                                            <option>GBP (£)</option>
                                            <option>JPY (¥)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Timezone</label>
                                        <select class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600">
                                            <option>Eastern Time (ET)</option>
                                            <option>Central Time (CT)</option>
                                            <option>Mountain Time (MT)</option>
                                            <option>Pacific Time (PT)</option>
                                        </select>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Dark Mode</div>
                                            <div class="text-sm text-gray-600">Use dark theme</div>
                                        </div>
                                        <div class="toggle-switch" data-setting="dark-mode"></div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-semibold text-gray-800">Auto-save Beneficiaries</div>
                                            <div class="text-sm text-gray-600">Automatically save transfer recipients</div>
                                        </div>
                                        <div class="toggle-switch active" data-setting="auto-save"></div>
                                    </div>

                                    <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">
                                        Save Preferences
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logout Page -->
                <div id="logoutPage" class="page-content" style="display: none;">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white rounded-3xl p-12 shadow-xl text-center max-w-md">
                            <div class="text-6xl mb-6">👋</div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">See you soon!</h2>
                            <p class="text-gray-600 mb-8">Are you sure you want to logout of your SecureBank account?</p>
                            <div class="space-y-3">
                                <button id="confirmLogout" class="w-full bg-indigo-600 text-white py-4 rounded-lg font-bold text-lg btn-primary">
                                    Logout
                                </button>
                                <button class="w-full bg-gray-100 text-gray-700 py-4 rounded-lg font-bold text-lg hover:bg-gray-200" data-page="dashboard">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Beneficiary Modal -->
    <div id="addBeneficiaryModal" class="modal">
        <div class="modal-content">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Add New Beneficiary</h3>
            <form id="beneficiaryForm">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Account Number</label>
                    <input type="text" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bank Name</label>
                    <input type="text" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600" required>
                </div>
                <div class="flex gap-3">
                    <button type="button" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300" onclick="closeModal('addBeneficiaryModal')">Cancel</button>
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-lg font-semibold btn-primary">Add Beneficiary</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content text-center">
            <div class="text-6xl mb-4">✅</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Success!</h3>
            <p id="successMessage" class="text-gray-600 mb-6">Your transaction has been completed successfully.</p>
            <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold btn-primary" onclick="closeModal('successModal')">Close</button>
        </div>
    </div>

    <!-- Freeze Account Modal -->
    <div id="freezeModal" class="modal">
        <div class="modal-content text-center">
            <div class="text-6xl mb-4">❄️</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Freeze Account?</h3>
            <p class="text-gray-600 mb-6">This will temporarily disable all transactions on your account. You can unfreeze it at any time.</p>
            <div class="flex gap-3">
                <button class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300" onclick="closeModal('freezeModal')">Cancel</button>
                <button class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold btn-primary" onclick="freezeAccount()">Freeze Account</button>
            </div>
        </div>
    </div>

</body>

</html>
