<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Your Trusted Banking Partner</title>
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
            color: #333;
            overflow-x: hidden;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            color: #667eea;
            letter-spacing: -1px;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 400;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .btn-primary {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 100px 50px 50px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            z-index: 2;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 64px;
            font-weight: 900;
            color: white;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .trust-section {
            background: white;
            padding: 80px 50px;
            text-align: center;
        }

        .trust-section h2 {
            font-size: 48px;
            font-weight: 900;
            color: #333;
            margin-bottom: 60px;
        }

        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 60px;
            flex-wrap: wrap;
        }

        .trust-badge {
            text-align: center;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .trust-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
            transition: transform 0.3s;
        }

        .trust-badge:hover .trust-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .trust-badge h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .trust-badge p {
            color: #666;
            font-size: 16px;
        }

        .services-section {
            padding: 80px 50px;
            background: #f8f9fa;
        }

        .services-section h2 {
            font-size: 48px;
            font-weight: 900;
            color: #333;
            text-align: center;
            margin-bottom: 60px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.1);
            transition: all 0.3s;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);
        }

        .service-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #667eea;
        }

        .service-card p {
            color: #666;
            line-height: 1.6;
        }

        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 100px 50px;
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .stats-counter {
            display: flex;
            justify-content: center;
            gap: 80px;
            margin-top: 60px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.8;
        }

        footer {
            background: #1a1a2e;
            color: white;
            padding: 40px 50px;
            text-align: center;
        }

        .placeholder-img {
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 100px;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero h1 {
                font-size: 40px;
            }

            .hero-image {
                margin-top: 40px;
            }

            .placeholder-img {
                width: 300px;
                height: 300px;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo" style="font-family:Brush Script MT,cursive;font-size: 40px; color: #333;">🏦 AmarJeshBank</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <a href="index (1).html" class="btn-primary">Login</a>
    </nav>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Banking Made Simple & Secure</h1>
            <p>Experience the future of banking with 256-bit encryption, instant transfers, and 24/7 support. Your money, your security, our priority.</p>
            <div class="hero-buttons">
                <a href="#signup" class="btn-primary">Open Account</a>
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
        <a href="#signup" class="btn-secondary">Get Started Now</a>
        
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
        <p>&copy; 2024 SecureBank. All rights reserved. Licensed by Reserve Bank. Deposits insured up to $250,000.</p>
    </footer>

    <script type="module">
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
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>