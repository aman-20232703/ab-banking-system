<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Your Trusted Banking Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <style>
        @keyframes fadeInDropdown {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-dropdown {
            animation: fadeInDropdown 0.2s ease-out;
        }
    </style>

</head>

<body>
    <nav class="navbar flex items-center justify-between p-4 bg-gray-100 shadow">
        <div class="logo font-[Brush Script MT,cursive] text-4xl text-gray-800 flex items-center gap-2">
            🏦 AmarJeshBank
        </div>
        <ul class="nav-links flex gap-6 text-gray-700 font-medium">
            <li><a href="#" class="hover:text-indigo-600">Home</a></li>
            <li><a href="#services" class="hover:text-indigo-600">Services</a></li>
            <li><a href="#about" class="hover:text-indigo-600">About</a></li>
            <li><a href="#contact" class="hover:text-indigo-600">Contact</a></li>
        </ul>
        <div class="relative inline-block text-left">
            <button id="loginBtn"
                class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition flex items-center gap-2">
                <span>Login</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>


            <div id="loginDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border fade-in-dropdown">
                
                <a href="admin/login.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-indigo-100">
                    👨‍💼 Manager
                </a>
                <a href="employee/login.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-green-100">
                    👷 Employee
                </a>
                <a href="users/index.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-indigo-100">
                    👤 User
                </a>
            </div>
        </div>

    </nav>



    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Banking Made Simple & Secure</h1>
            <p>Experience the future of banking with 256-bit encryption, instant transfers, and 24/7 support. Your money, your security, our priority.</p>
            <div class="hero-buttons">
                <a href="users/index.php" class="btn-primary">Open Account</a>
                <a href="#services" class="btn-secondary">Learn More</a>
            </div>
        </div>
        <div class="hero-image">
            <div class="placeholder-img">💳</div>
        </div>
    </section>

    <section class="trust-section">
        <h2>Why Trust SecureBank?</h2>
        <div class="trust-badges">
            <div class="trust-badge">
                <div class="trust-icon">🔒</div>
                <h3>256-bit Encryption</h3>
                <p>Bank-grade security for all transactions</p>
            </div>
            <div class="trust-badge">
                <div class="trust-icon">⚡</div>
                <h3>Instant Transfers</h3>
                <p>IMPS, NEFT, RTGS in seconds</p>
            </div>
            <div class="trust-badge">
                <div class="trust-icon">📱</div>
                <h3>24/7 Access</h3>
                <p>Bank anytime, anywhere</p>
            </div>
            <div class="trust-badge">
                <div class="trust-icon">🛡️</div>
                <h3>Fraud Protection</h3>
                <p>Advanced AI-powered security</p>
            </div>
        </div>
    </section>

    <section class="services-section" id="services">
        <h2>Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <h3>Savings Account</h3>
                <p>Earn competitive interest rates with zero minimum balance. Access your money anytime with our seamless digital platform.</p>
            </div>
            <div class="service-card">
                <h3>Fixed Deposits</h3>
                <p>Lock in high interest rates for guaranteed returns. Flexible tenures from 7 days to 10 years.</p>
            </div>
            <div class="service-card">
                <h3>Personal Loans</h3>
                <p>Quick approval, competitive rates, and flexible repayment options. Get funds within 24 hours.</p>
            </div>
            <div class="service-card">
                <h3>Credit Cards</h3>
                <p>Enjoy cashback, rewards, and zero annual fees. Build your credit score with responsible usage.</p>
            </div>
            <div class="service-card">
                <h3>Investment Plans</h3>
                <p>Grow your wealth with our expert-managed investment portfolios and mutual funds.</p>
            </div>
            <div class="service-card">
                <h3>Business Banking</h3>
                <p>Comprehensive solutions for businesses of all sizes. From payments to payroll management.</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <h2>Join 2 Million+ Happy Customers</h2>
        <p>Open your account in just 5 minutes</p>
        <a href="users/index.php" class="btn-secondary">Get Started Now</a>

        <div class="stats-counter">
            <div class="stat-item">
                <div class="stat-number" data-target="2000000">0</div>
                <div class="stat-label">Active Users</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="5000000">0</div>
                <div class="stat-label">Transactions Daily</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="150">0</div>
                <div class="stat-label">Countries Served</div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 SecureBank. All rights reserved. Licensed by Reserve Bank.</p>
    </footer>

    <script>
        const loginBtn = document.getElementById('loginBtn');
        const loginDropdown = document.getElementById('loginDropdown');


        loginDropdown.classList.add('hidden');

        loginBtn.addEventListener('click', (e) => {
            e.stopPropagation();

            if (loginDropdown.classList.contains('hidden')) {
                loginDropdown.classList.remove('hidden');
                loginDropdown.classList.add('fade-in-dropdown');
            } else {
                loginDropdown.classList.add('hidden');
            }
        });

        document.addEventListener('click', function(e) {
            if (!loginDropdown.contains(e.target) && !loginBtn.contains(e.target)) {
                loginDropdown.classList.add('hidden');
            }
        });


        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                loginDropdown.classList.add('hidden');
            }
        });



        // Counter Animation
        const counters = document.querySelectorAll('.stat-number');
        const speed = 200;

        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / speed;

            const updateCount = () => {
                const count = parseInt(counter.innerText);
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 10);
                } else {
                    counter.innerText = target.toLocaleString();
                }
            };

            updateCount();
        };

        // Intersection Observer for counter animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    animateCounter(counter);
                    observer.unobserve(counter);
                }
            });
        });

        counters.forEach(counter => observer.observe(counter));

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>