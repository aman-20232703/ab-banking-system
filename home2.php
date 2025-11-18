<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmarJeshBank - Your Trusted Banking Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home2.css">
</head>

<body>
    <nav class="navbar flex items-center justify-between p-4 bg-gray-100 shadow">
        <div class="logo font-[Brush Script MT,cursive] text-4xl text-gray-800 flex items-center gap-2">
            🏦 AmarJeshBank
        </div>
        <ul class="nav-links flex gap-6 text-gray-700 font-medium">
            <li><a href="#home" class="hover:text-indigo-600">Home</a></li>
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
        <h2>Why Trust AmarJeshBank?</h2>
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
        <h2>Our Banking Services</h2>
        <p class="services-subtitle">Comprehensive financial solutions tailored to meet all your banking needs</p>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">💰</div>
                <h3>Savings Account</h3>
                <p>Earn competitive interest rates with zero minimum balance. Access your money anytime with our seamless digital platform.</p>
                <ul class="service-features">
                    <li>Up to 7% annual interest</li>
                    <li>Free debit card & checkbook</li>
                    <li>Mobile & Internet banking</li>
                    <li>No monthly charges</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">📈</div>
                <h3>Fixed Deposits</h3>
                <p>Lock in high interest rates for guaranteed returns. Flexible tenures from 7 days to 10 years.</p>
                <ul class="service-features">
                    <li>Interest up to 8.5% p.a.</li>
                    <li>Auto-renewal facility</li>
                    <li>Loan against FD</li>
                    <li>Premature withdrawal option</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">💵</div>
                <h3>Personal Loans</h3>
                <p>Quick approval, competitive rates, and flexible repayment options. Get funds within 24 hours.</p>
                <ul class="service-features">
                    <li>Loan up to ₹50 lakhs</li>
                    <li>Interest from 10.5%</li>
                    <li>Tenure up to 7 years</li>
                    <li>Minimal documentation</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">💳</div>
                <h3>Credit Cards</h3>
                <p>Enjoy cashback, rewards, and zero annual fees. Build your credit score with responsible usage.</p>
                <ul class="service-features">
                    <li>Up to 5% cashback</li>
                    <li>Reward points on every spend</li>
                    <li>EMI conversion facility</li>
                    <li>Fuel surcharge waiver</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>Investment Plans</h3>
                <p>Grow your wealth with our expert-managed investment portfolios and mutual funds.</p>
                <ul class="service-features">
                    <li>Mutual fund investments</li>
                    <li>Systematic Investment Plans</li>
                    <li>Tax saving options</li>
                    <li>Expert advisory services</li>
                </ul>
            </div>
            <div class="service-card">
                <div class="service-icon">🏢</div>
                <h3>Business Banking</h3>
                <p>Comprehensive solutions for businesses of all sizes. From payments to payroll management.</p>
                <ul class="service-features">
                    <li>Current account facilities</li>
                    <li>Business loans & overdraft</li>
                    <li>Cash management services</li>
                    <li>Trade finance solutions</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="about-section" id="about">
        <div class="about-container">
            <div class="about-content">
                <h2>About AmarJeshBank</h2>
                <p>Founded in 2025, AmarJeshBank has been serving millions of customers with excellence and integrity. We are committed to providing world-class banking services with a personal touch.</p>
                <p>Our mission is to empower individuals and businesses through innovative financial solutions, while maintaining the highest standards of security and customer service.</p>
                <p>With a network spanning across the nation and cutting-edge digital banking platforms, we make banking accessible, secure, and convenient for everyone.</p>
                <div class="about-stats">
                    <div class="about-stat">
                        <div class="about-stat-number">29+</div>
                        <div class="about-stat-label">Years of Service</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">500+</div>
                        <div class="about-stat-label">Branches</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">2M+</div>
                        <div class="about-stat-label">Happy Customers</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">24/7</div>
                        <div class="about-stat-label">Customer Support</div>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <div class="about-placeholder">🏦</div>
            </div>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <h2>Get In Touch</h2>
        <p class="contact-subtitle">We're here to help you with all your banking needs. Reach out to us anytime!</p>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Contact Information</h3>
                
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-details">
                        <h4>Phone Numbers</h4>
                        <p>Customer Care: 1800-XXX-XXXX (Toll Free)</p>
                        <p>WhatsApp Banking: +91-98765-43210</p>
                        <p>International: +91-11-4567-8900</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-details">
                        <h4>Email Addresses</h4>
                        <p>General Inquiries: info@amarjeshbank.com</p>
                        <p>Customer Support: support@amarjeshbank.com</p>
                        <p>Grievance: grievance@amarjeshbank.com</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">🏢</div>
                    <div class="contact-details">
                        <h4>Head Office</h4>
                        <p>AmarJesh Tower, Connaught Place<br>
                        New Delhi - 110001, India<br>
                        Mon - Fri: 9:30 AM - 5:30 PM<br>
                        Sat: 9:30 AM - 2:00 PM</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">⏰</div>
                    <div class="contact-details">
                        <h4>Customer Service Hours</h4>
                        <p>Phone Support: 24/7 Available</p>
                        <p>Email Support: Response within 24 hours</p>
                        <p>Branch Timings: 9:30 AM - 4:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <div id="successMessage" class="success-message">
                    ✓ Thank you! Your message has been sent successfully. We'll get back to you within 24 hours.
                </div>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required placeholder="your.email@example.com">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required placeholder="+91-XXXXX-XXXXX">
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <select id="subject" name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="account">Account Related Query</option>
                            <option value="loan">Loan Inquiry</option>
                            <option value="card">Credit/Debit Card Issue</option>
                            <option value="complaint">Complaint/Grievance</option>
                            <option value="feedback">Feedback/Suggestion</option>
                            <option value="investment">Investment Services</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" required placeholder="Please describe your query in detail..."></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
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
                <div class="stat-number" data-target="500">0</div>
                <div class="stat-label">Branches Nationwide</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-target="150">0</div>
                <div class="stat-label">Countries Served</div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#about">Our Story</a></li>
                    <li><a href="#about">Leadership Team</a></li>
                    <li><a href="#about">Careers</a></li>
                    <li><a href="#about">Awards & Recognition</a></li>
                    <li><a href="#about">Press Release</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Banking Services</h3>
                <ul>
                    <li><a href="#services">Savings Account</a></li>
                    <li><a href="#services">Current Account</a></li>
                    <li><a href="#services">Fixed Deposits</a></li>
                    <li><a href="#services">Loans</a></li>
                    <li><a href="#services">Credit Cards</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#contact">Branch Locator</a></li>
                    <li><a href="#contact">FAQs</a></li>
                    <li><a href="#contact">Customer Grievance</a></li>
                    <li><a href="#contact">Security Tips</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Legal</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Interest Rates</a></li>
                    <li><a href="#">Service Charges</a></li>
                    <li><a href="#">Regulatory Disclosures</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AmarJeshBank. All rights reserved. Licensed by Reserve Bank of India.</p>
            <p style="margin-top: 10px; font-size: 14px;">ISO 27001:2013 Certified | Member of DICGC</p>
        </div>
    </footer>

    <script>
        // Login Dropdown
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

        // Contact Form Submission
        const contactForm = document.getElementById('contactForm');
        const successMessage = document.getElementById('successMessage');

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message
            successMessage.style.display = 'block';
            
            // Reset form
            contactForm.reset();
            
            // Scroll to success message
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
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
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close dropdown if open
                    loginDropdown.classList.add('hidden');
                }
            });
        });

        // Form validation enhancement
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('invalid', function(e) {
                e.preventDefault();
                this.classList.add('error');
            });

            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            e.target.value = value;
        });
    </script>
</body>

</html>