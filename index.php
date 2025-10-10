<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mushcraft - Mushroom Greenhouse</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-container">
            <div class="logo-text">Mushcraft</div>
        </div>
        <nav>
        <a href="index.php" class="nav-button home-button"><span></span> Home</a>
        <a href="auth/login.php" class="nav-button login-button"><span>➜</span> Login</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Mushcraft<br>Greenhouse</h1>
            <p class="hero-subtitle">Experience the future of sustainable mushroom cultivation with our state-of-the-art greenhouse technology.</p>
            <div class="hero-buttons">
            <button id="btnExplore" class="btn-primary">Explore Our Facility →</button>
            <button id="btnLearn" class="btn-secondary">Learn More</button>

            </div>
        </div>
        <div class="hero-image">
            <img src="images/m2.jpg" alt="Mushroom cultivation">
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="about-header">
            <h2 class="about-title">About Our Greenhouse</h2>
            <p class="about-description">Our cutting-edge facility combines traditional mushroom growing wisdom with modern technology to create the perfect environment for premium mushroom cultivation.</p>
        </div>
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">🌱</div>
                <h3 class="feature-title">Sustainable Growing</h3>
                <p class="feature-description">We use eco-friendly practices and renewable resources to minimize our environmental impact while maximizing mushroom quality.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌡️</div>
                <h3 class="feature-title">Climate Control</h3>
                <p class="feature-description">Advanced climate control systems maintain optimal temperature, humidity, and air circulation for perfect growing conditions.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👁️</div>
                <h3 class="feature-title">24/7 Monitoring</h3>
                <p class="feature-description">Continuous monitoring ensures optimal growing conditions and early detection of any issues that might affect mushroom quality.</p>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery">
        <div class="about-header">
            <h2 class="about-title">About Our Greenhouse</h2>
            <p class="about-description">Our cutting-edge facility combines traditional mushroom growing wisdom with modern technology to create the perfect environment for premium mushroom cultivation.</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="images/m1.jpg" alt="Mushroom close-up"></div>
            <div class="gallery-item"><img src="images/m3.jpg" alt="Oyster mushrooms"></div>
            <div class="gallery-item"><img src="images/m4.jpg" alt="Greenhouse interior"></div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo-container">
                    <div class="footer-logo">🍄</div>
                    <div class="footer-logo-text">ShroomGrow</div>
                </div>
                <p class="footer-tagline">Leading the future of sustainable mushroom cultivation with innovative greenhouse technology and eco-friendly practices.</p>
                <div class="social-links">
                    <a href="#" class="social-link">f</a>
                    <a href="#" class="social-link">𝕏</a>
                    <a href="#" class="social-link">📷</a>
                    <a href="#" class="social-link">▶</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <div class="footer-links">
                    <a href="#">About Us</a>
                    <a href="#">Our Services</a>
                    <a href="#">Sustainability</a>
                    <a href="#">Research & Development</a>
                    <a href="#">Careers</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Our Products</h3>
                <div class="footer-links">
                    <a href="#">Oyster Mushrooms</a>
                    <a href="#">Shiitake Mushrooms</a>
                    <a href="#">Lion's Mane</a>
                    <a href="#">Reishi Mushrooms</a>
                    <a href="#">Custom Cultivation</a>
                </div>
            </div>

            <div class="footer-section newsletter">
                <h3>Contact Us</h3>
                <div class="contact-item"><span class="contact-icon">📍</span><div>123 Greenhouse Lane<br>Green Valley, CA 90210</div></div>
                <div class="contact-item"><span class="contact-icon">📞</span><div>(555) 123-GROW</div></div>
                <div class="contact-item"><span class="contact-icon">✉️</span><div>hello@shroomgrow.com</div></div>
                <h3 style="margin-top: 30px;">Stay Updated</h3>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Your email">
                    <button type="submit" class="newsletter-button">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">© 2024 ShroomGrow. All rights reserved. | Growing sustainably since 2020.</div>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
                <a href="#">Support</a>
            </div>
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>
