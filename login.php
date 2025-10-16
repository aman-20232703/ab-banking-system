<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Login & Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            display: flex;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-side {
            flex: 1;
            padding: 60px;
        }

        .info-side {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .info-side::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -200px;
            right: -200px;
        }

        .logo {
            font-size: 32px;
            font-weight: 900;
            color: #667eea;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab {
            padding: 15px 0;
            font-size: 18px;
            font-weight: 700;
            color: #999;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
            bottom: -2px;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .info-side h2 {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 20px;
            z-index: 1;
        }

        .info-side p {
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.9;
            z-index: 1;
            margin-bottom: 30px;
        }

        .info-features {
            list-style: none;
            z-index: 1;
        }

        .info-features li {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-features .icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 20px;
            margin-top: 20px;
            font-size: 14px;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .info-side {
                order: -1;
                padding: 40px 30px;
            }

            .form-side {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-side">
        <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 40px; color: #333;">🏦 AmarJeshBank</div>
            
            <div class="tabs">
                <div class="tab active" data-tab="login">Login</div>
                <div class="tab" data-tab="signup">Sign Up</div>
            </div>

            <div id="alert" class="alert"></div>

            <!-- Login Form -->
            <div class="form-content active" id="login-form">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="login-email">Email or Account Number</label>
                        <input type="text" id="login-email" name="email" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password" required placeholder="Enter your password">
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" style="margin: 0;">Remember me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#forgot">Forgot Password?</a>
                    </div>
                    <!-- <button type="submit" class="btn">Login Securely</button> -->
                    <button type="submit" class="btn"><a href="index (2).html" style="text-decoration:none; color:white">Login Securely </a></button>

                </form>
            </div>

            <!-- Signup Form -->
            <div class="form-content" id="signup-form">
                <form id="signupForm">
                    <div class="form-group">
                        <label for="signup-name">Full Name</label>
                        <input type="text" id="signup-name" name="name" required placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Email Address</label>
                        <input type="email" id="signup-email" name="email" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="signup-phone">Phone Number</label>
                        <input type="tel" id="signup-phone" name="phone" required placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Password</label>
                        <input type="password" id="signup-password" name="password" required placeholder="Create a strong password">
                    </div>
                    <div class="form-group">
                        <label for="signup-confirm">Confirm Password</label>
                        <input type="password" id="signup-confirm" name="confirm" required placeholder="Re-enter your password">
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms" style="margin: 0;">I agree to Terms & Conditions</label>
                    </div>
                    <button type="submit" class="btn">Create Account</button>
                </form>
            </div>
        </div>

        <div class="info-side">
            <h2>Welcome to Secure Banking</h2>
            <p>Experience banking with military-grade security and 24/7 access to your funds.</p>
            
            <ul class="info-features">
                <li>
                    <div class="icon">🔒</div>
                    <div>256-bit SSL Encryption</div>
                </li>
                <li>
                    <div class="icon">📱</div>
                    <div>Two-Factor Authentication</div>
                </li>
                <li>
                    <div class="icon">⚡</div>
                    <div>Instant Account Access</div>
                </li>
                <li>
                    <div class="icon">🛡️</div>
                    <div>Fraud Protection Guarantee</div>
                </li>
            </ul>

            <div class="security-badge">
                <span>🔐</span>
                <span>Bank-Grade Security Certified</span>
            </div>
        </div>
    </div>

    <script type="module">
        // Tab Switching
        const tabs = document.querySelectorAll('.tab');
        const forms = document.querySelectorAll('.form-content');
        const alert = document.getElementById('alert');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabName = tab.dataset.tab;
                
                tabs.forEach(t => t.classList.remove('active'));
                forms.forEach(f => f.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(`${tabName}-form`).classList.add('active');
                
                alert.style.display = 'none';
            });
        });

        // Show Alert
        function showAlert(message, type) {
            alert.textContent = message;
            alert.className = `alert ${type}`;
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        }

        // Login Form Submission
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            // In production, send to PHP backend
            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.success) {
                    showAlert('Login successful! Redirecting...', 'success');
                    setTimeout(() => {
                        window.location.href = 'dashboard.html';
                    }, 2000);
                } else {
                    showAlert(data.message || 'Invalid credentials', 'error');
                }
            } catch (error) {
                // Demo mode
                showAlert('Login successful! (Demo Mode)', 'success');
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 2000);
            }
        });

        // Signup Form Submission
        document.getElementById('signupForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            const password = formData.get('password');
            const confirm = formData.get('confirm');
            
            if (password !== confirm) {
                showAlert('Passwords do not match!', 'error');
                return;
            }
            
            if (password.length < 8) {
                showAlert('Password must be at least 8 characters long!', 'error');
                return;
            }
            
            // In production, send to PHP backend
            try {
                const response = await fetch('signup.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.success) {
                    showAlert('Account created successfully! Please login.', 'success');
                    setTimeout(() => {
                        document.querySelector('[data-tab="login"]').click();
                        e.target.reset();
                    }, 2000);
                } else {
                    showAlert(data.message || 'Registration failed', 'error');
                }
            } catch (error) {
                // Demo mode
                showAlert('Account created! (Demo Mode)', 'success');
                setTimeout(() => {
                    document.querySelector('[data-tab="login"]').click();
                    e.target.reset();
                }, 2000);
            }
        });
    </script>
</body>
</html>