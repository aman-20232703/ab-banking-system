

        // LocalStorage key prefix
        const STORAGE_PREFIX = 'securebank_';

        // Initialize app data
        function initializeData() {
            if (!localStorage.getItem(STORAGE_PREFIX + 'initialized')) {
                const defaultData = {
                    user: {
                        firstName: 'John',
                        lastName: 'Doe',
                        email: 'john@example.com',
                        phone: '+1 (555) 123-4567',
                        address: '123 Main Street, Apt 4B\nNew York, NY 10001'
                    },
                    accounts: [{
                            type: 'Savings',
                            number: '5678',
                            balance: 45230.50
                        },
                        {
                            type: 'Checking',
                            number: '1234',
                            balance: 12450.00
                        },
                        {
                            type: 'Credit Card',
                            number: '9876',
                            balance: 2340.00,
                            limit: 10000
                        }
                    ],
                    settings: {
                        'sms-2fa': true,
                        'email-notif': true,
                        'push-notif': true,
                        'transaction-alert': true,
                        'payment-reminder': true,
                        'security-alert': true,
                        'marketing-email': false,
                        'dark-mode': false,
                        'auto-save': true
                    }
                };

                Object.keys(defaultData).forEach(key => {
                    localStorage.setItem(STORAGE_PREFIX + key, JSON.stringify(defaultData[key]));
                });

                localStorage.setItem(STORAGE_PREFIX + 'initialized', 'true');
            }
        }

        // Call initialize on load
        initializeData();

        // Page Navigation
        const navLinks = document.querySelectorAll('.sidebar-item');
        const pages = document.querySelectorAll('.page-content');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetPage = link.dataset.page;

                if (targetPage === 'logout') {
                    if (confirm('Are you sure you want to logout?')) {
                        showSuccessModal('You have been logged out successfully.');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                    return;
                }

                // Update active nav
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');

                // Show target page
                pages.forEach(p => p.style.display = 'none');
                const targetElement = document.getElementById(targetPage + 'Page');
                if (targetElement) {
                    targetElement.style.display = 'block';
                    targetElement.classList.add('fade-in');
                }

                // Update header title
                const titles = {
                    dashboard: 'Welcome back, John! 👋',
                    accounts: 'My Accounts',
                    transfers: 'Transfer Money',
                    beneficiaries: 'Beneficiaries',
                    loans: 'My Loans',
                    investments: 'Investments',
                    settings: 'Settings'
                };

                document.getElementById('pageTitle').innerHTML = `<h1 class="text-4xl font-bold text-gray-800">${titles[targetPage] || 'SecureBank'}</h1>`;
            });
        });

        // Settings Tabs
        const settingsTabs = document.querySelectorAll('.settings-tab');
        const settingsContents = document.querySelectorAll('.settings-content');

        settingsTabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                const targetTab = tab.dataset.tab;

                settingsTabs.forEach(t => {
                    t.classList.remove('active', 'bg-indigo-50', 'text-indigo-600', 'font-semibold');
                    t.classList.add('hover:bg-gray-50');
                });

                tab.classList.add('active', 'bg-indigo-50', 'text-indigo-600', 'font-semibold');
                tab.classList.remove('hover:bg-gray-50');

                settingsContents.forEach(c => c.style.display = 'none');
                const targetContent = document.getElementById(targetTab + 'Tab');
                if (targetContent) {
                    targetContent.style.display = 'block';
                }
            });
        });

        // Toggle Switches
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            toggle.addEventListener('click', () => {
                toggle.classList.toggle('active');
                const setting = toggle.dataset.setting;
                const isActive = toggle.classList.contains('active');

                // Save to localStorage
                const settings = JSON.parse(localStorage.getItem(STORAGE_PREFIX + 'settings') || '{}');
                settings[setting] = isActive;
                localStorage.setItem(STORAGE_PREFIX + 'settings', JSON.stringify(settings));
            });
        });

        // Load settings from localStorage
        function loadSettings() {
            const settings = JSON.parse(localStorage.getItem(STORAGE_PREFIX + 'settings') || '{}');
            Object.keys(settings).forEach(key => {
                const toggle = document.querySelector(`[data-setting="${key}"]`);
                if (toggle) {
                    if (settings[key]) {
                        toggle.classList.add('active');
                    } else {
                        toggle.classList.remove('active');
                    }
                }
            });
        }
        loadSettings();

        // Modal Functions
        window.closeModal = function(modalId) {
            document.getElementById(modalId).classList.remove('active');
        };

        window.openModal = function(modalId) {
            document.getElementById(modalId).classList.add('active');
        };

        window.showSuccessModal = function(message) {
            document.getElementById('successMessage').textContent = message;
            openModal('successModal');
        };

        // Freeze Account
        document.getElementById('freezeAccountBtn').addEventListener('click', () => {
            openModal('freezeModal');
        });

        window.freezeAccount = function() {
            closeModal('freezeModal');
            showSuccessModal('Your account has been frozen. Contact support to unfreeze.');
        };

        // Transfer Form
        document.getElementById('transferForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const amount = e.target.querySelector('input[type="number"]').value;
            showSuccessModal(`Transfer of $${amount} completed successfully!`);
            e.target.reset();
        });

        // Add Beneficiary
        document.getElementById('addBeneficiaryBtn').addEventListener('click', () => {
            openModal('addBeneficiaryModal');
        });

        document.getElementById('beneficiaryForm').addEventListener('submit', (e) => {
            e.preventDefault();
            closeModal('addBeneficiaryModal');
            showSuccessModal('Beneficiary added successfully!');
            e.target.reset();
        });

        // Loan Calculator
        document.getElementById('calculateLoan').addEventListener('click', () => {
            const amount = parseFloat(document.getElementById('loanAmount').value);
            const rate = parseFloat(document.getElementById('loanRate').value) / 100 / 12;
            const term = parseFloat(document.getElementById('loanTerm').value) * 12;

            const monthlyPayment = (amount * rate * Math.pow(1 + rate, term)) / (Math.pow(1 + rate, term) - 1);
            const totalAmount = monthlyPayment * term;
            const totalInterest = totalAmount - amount;

            document.getElementById('monthlyPayment').textContent = `$${monthlyPayment.toFixed(0)}`;
            document.getElementById('totalInterest').textContent = `$${totalInterest.toFixed(0)}`;
            document.getElementById('totalAmount').textContent = `$${totalAmount.toFixed(0)}`;
        });

        // Click outside modal to close
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        });

        // Balance reveal
        let balanceRevealed = false;
        document.getElementById('revealBalance').addEventListener('click', function() {
            const blurText = document.querySelector('.blur-text');
            if (!balanceRevealed) {
                blurText.style.filter = 'none';
                this.textContent = 'Click to hide';
                balanceRevealed = true;
            } else {
                blurText.style.filter = 'blur(8px)';
                this.textContent = 'Click to reveal';
                balanceRevealed = false;
            }
        });

        // Add Account button
        document.getElementById('addAccountBtn')?.addEventListener('click', () => {
            showSuccessModal('This feature would open a new account application form.');
        });

        // Apply Loan button
        document.getElementById('applyLoanBtn')?.addEventListener('click', () => {
            showSuccessModal('This feature would open a loan application form.');
        });

        // New Investment button
        document.getElementById('newInvestmentBtn')?.addEventListener('click', () => {
            showSuccessModal('This feature would open an investment purchase form.');
        });

        // Logout confirmation
        document.getElementById('confirmLogout')?.addEventListener('click', () => {
            localStorage.clear();
            window.location.reload();
        });

        console.log('SecureBank Application Loaded - All features simulated with localStorage');
 
