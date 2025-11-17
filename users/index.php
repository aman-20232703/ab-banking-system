<?php
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Login & Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex">
        <!-- Form Side -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center p-8">
            <div class="text-4xl font-bold mb-6 text-center">🏦 AmarJeshBank</div>

            <!-- Tabs -->
            <div class="flex justify-center mb-6 space-x-4">
                <button class="tab px-4 py-2 font-semibold border-b-2 border-blue-500 text-blue-500" data-tab="login">Login</button>
                <button class="tab px-4 py-2 font-semibold border-b-2 border-transparent text-gray-500" data-tab="signup">Sign Up</button>
            </div>

            <div id="alert" class="hidden p-2 mb-4 text-white rounded"></div>

            <!-- Login Form -->
            <div class="form-content" id="login-form">
                <form id="loginForm" class="space-y-4">
                    <div>
                        <label for="login-email" class="block text-gray-700">Email or Account Number</label>
                        <input type="text" id="login-email" name="email" required
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your email or account number">
                    </div>
                    <div>
                        <label for="login-password" class="block text-gray-700">Password</label>
                        <input type="password" id="login-password" name="password" required
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your password">
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4">
                            <span class="text-gray-700 text-sm">Remember me</span>
                        </label>
                        <a href="forgot_pass.php" class="text-blue-500 text-sm">Forgot Password?</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Login Securely</button>
                </form>
            </div>

            <!-- Signup Form -->
            <div class="form-content hidden" id="signup-form">
                <form id="signupForm" class="space-y-4">
                    <div>
                        <label for="signup-name" class="block text-gray-700">Full Name</label>
                        <input type="text" id="signup-name" name="name" required placeholder="Enter your full name"
                            disabled
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="signup-email" class="block text-gray-700">Email Address</label>
                        <input type="email" id="signup-email" name="email" required
                            placeholder="Enter your email"
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="button" id="sendOtpBtn"
                            class="mt-2 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">Send
                            OTP</button>
                    </div>
                    <div id="otpSection" class="hidden">
                        <label for="otp" class="block text-gray-700">Enter OTP</label>
                        <input type="text" id="otp" name="otp"
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter OTP">
                        <button type="button" id="verifyOtpBtn"
                            class="mt-2 w-full bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">Verify
                            OTP</button>
                    </div>
                    <div>
                        <label for="signup-phone" class="block text-gray-700">Phone Number</label>
                        <input type="tel" id="signup-phone" name="phone" required placeholder="Enter your phone number"
                            disabled
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="signup-password" class="block text-gray-700">Password</label>
                        <input type="password" id="signup-password" name="password" required
                            placeholder="Create a strong password" disabled
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="passwordHelp" class="hidden text-red-600 text-sm mt-1">
                            Password must be at least 8 characters, including uppercase, lowercase, number & special
                            character.
                        </p>
                    </div>
                    <div>
                        <label for="signup-confirm" class="block text-gray-700">Confirm Password</label>
                        <input type="password" id="signup-confirm" name="confirm" required
                            placeholder="Re-enter your password" disabled
                            class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" id="terms" name="terms" required disabled class="h-4 w-4">
                        <span class="text-gray-700 text-sm">I agree to Terms & Conditions</span>
                    </label>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition"
                        disabled>Create Account</button>
                </form>
            </div>
        </div>

        <!-- Info Side -->
        <div class="hidden md:flex w-1/2 bg-blue-50 p-8 flex-col justify-center">
            <h2 class="text-3xl font-bold mb-4">Welcome to Secure Banking</h2>
            <p class="mb-6">Experience banking with military-grade security and 24/7 access to your funds.</p>

            <ul class="space-y-4">
                <li class="flex items-center space-x-3">
                    <div class="text-xl">🔒</div>
                    <div>256-bit SSL Encryption</div>
                </li>
                <li class="flex items-center space-x-3">
                    <div class="text-xl">📱</div>
                    <div>Two-Factor Authentication</div>
                </li>
                <li class="flex items-center space-x-3">
                    <div class="text-xl">⚡</div>
                    <div>Instant Account Access</div>
                </li>
                <li class="flex items-center space-x-3">
                    <div class="text-xl">🛡️</div>
                    <div>Fraud Protection Guarantee</div>
                </li>
            </ul>

            <div class="mt-8 flex items-center space-x-2 text-gray-700">
                <span>🔐</span>
                <span>Bank-Grade Security Certified</span>
            </div>
        </div>
    </div>

    <script type="module">
        // Tabs
        const tabs = document.querySelectorAll('.tab');
        const forms = document.querySelectorAll('.form-content');
        const alertBox = document.getElementById('alert');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabName = tab.dataset.tab;
                tabs.forEach(t => {
                    t.classList.remove('border-blue-500', 'text-blue-500');
                    t.classList.add('border-transparent', 'text-gray-500');
                });
                tab.classList.add('border-blue-500', 'text-blue-500');

                forms.forEach(f => f.classList.add('hidden'));
                document.getElementById(`${tabName}-form`).classList.remove('hidden');
                alertBox.classList.add('hidden');
            });
        });

        function showAlert(message, type) {
            alertBox.textContent = message;
            alertBox.className = `p-2 mb-4 rounded ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
            alertBox.classList.remove('hidden');
            setTimeout(() => alertBox.classList.add('hidden'), 5000);
        }

        // Login
        document.getElementById('loginForm').addEventListener('submit', async e => {
            e.preventDefault();
            const formData = new FormData(e.target);
            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.success) {
                    showAlert('Login successful! Redirecting...', 'success');
                    setTimeout(() => window.location = 'customer_dash.php', 2000);
                } else {
                    showAlert(data.message || 'Invalid credentials', 'error');
                }
            } catch {
                showAlert('Login failed!', 'error');
            }
        });

        // Signup OTP
        let emailVerified = false;
        const signupForm = document.getElementById('signupForm');
        const signupFields = signupForm.querySelectorAll('input, button[type=submit]');
        const passwordInput = document.getElementById('signup-password');
        const passwordHelp = document.getElementById('passwordHelp');

        function enableSignupFields() {
            signupFields.forEach(field => field.disabled = false);
        }

        document.getElementById('sendOtpBtn').addEventListener('click', async () => {
            const email = document.getElementById('signup-email').value.trim();
            if (!email) { alert('Enter email first!'); return; }

            const formData = new FormData();
            formData.append('email', email);
            const response = await fetch('send_otp.php', { method: 'POST', body: formData });
            const result = await response.json();
            if (result.success) {
                alert('✅ ' + result.message);
                document.getElementById('otpSection').classList.remove('hidden');
            } else { alert('❌ ' + result.message); }
        });

        document.getElementById('verifyOtpBtn').addEventListener('click', async () => {
            const otp = document.getElementById('otp').value.trim();
            const email = document.getElementById('signup-email').value.trim();
            if (!otp) { alert('Enter OTP!'); return; }

            const formData = new FormData();
            formData.append('otp', otp);
            formData.append('email', email);
            const response = await fetch('verify_otp.php', { method: 'POST', body: formData });
            const result = await response.json();
            if (result.success) {
                alert('✅ OTP verified!');
                emailVerified = true;
                enableSignupFields();
                document.getElementById('signup-email').readOnly = true;
                document.getElementById('sendOtpBtn').disabled = true;
                document.getElementById('verifyOtpBtn').disabled = true;
                document.getElementById('otpSection').classList.add('hidden');
            } else {
                alert('❌ ' + (result.message || 'Invalid/expired OTP'));
            }
        });

        // Password Validation
        function validatePassword(password) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(password);
        }

        let passwordTouched = false;
        passwordInput.addEventListener('input', () => {
            passwordTouched = true;
            const isValid = validatePassword(passwordInput.value);
            passwordHelp.classList.toggle('hidden', isValid || !passwordTouched);
        });

        // Signup Submission
        signupForm.addEventListener('submit', async e => {
            e.preventDefault();
            if (!emailVerified) { alert('Please verify email first!'); return; }

            const formData = new FormData(signupForm);
            const password = formData.get('password');
            const confirm = formData.get('confirm');

            if (!validatePassword(password)) {
                alert('Password must be at least 8 characters, include uppercase, lowercase, number & special char.');
                return;
            }
            if (password !== confirm) { alert('Passwords do not match!'); return; }
            const response = await fetch('signup.php', { method: 'POST', body: formData });
            const data = await response.json();

            if (data.success) {
                alert('Account created successfully!');
                setTimeout(() => {
                    document.querySelector('[data-tab="login"]').click();
                    signupForm.reset();
                    emailVerified = false;
                    signupFields.forEach(f => f.disabled = true);
                    passwordHelp.classList.add('hidden');
                    document.getElementById('signup-email').readOnly = false;
                    document.getElementById('sendOtpBtn').disabled = false;
                    document.getElementById('verifyOtpBtn').disabled = false;
                    document.getElementById('otpSection').classList.add('hidden');
                }, 2000);
            } else {
                alert(data.message || 'Registration failed');
            }
        });
    </script>
</body>

</html>
