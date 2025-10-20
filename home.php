<?php
session_start();

// Securely include database connection
require_once __DIR__ . '/config/db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShroomGrow - Mushroom Greenhouse</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <!-- ✅ HEADER / NAVBAR -->
    <header>
        <div class="logo-container">
            <div class="logo-text">Mushcraft</div>
            <span class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
        </div>

        <!-- Hamburger button (only visible on mobile) -->
        <div class="hamburger" id="hamburgerMenu">&#9776;</div>

        <!-- Navigation -->
        <nav id="navMenu">
            <a href="home.php" class="nav-button <?= ($current_page === 'home.php') ? 'active' : '' ?>"><span></span> Home</a>
            <a href="yield.php" class="nav-button <?= ($current_page === 'yield.php') ? 'active' : '' ?>"><span></span> Yield Records</a>
            <a href="sensor.php" class="nav-button <?= ($current_page === 'sensor.php') ? 'active' : '' ?>"><span></span> Sensor Dashboard</a>
            <a href="auth/logout.php" class="nav-button logout-button" id="logoutBtn"><span>⎋</span> Logout</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Discover Our Mission</h1>
        <p>Learn how we're creating a sustainable future through innovative solutions, community engagement, and environmental stewardship. Together, we can make a difference.</p>
    </section>

    <!-- Content Section 1 -->
    <section class="content-section">
        <div class="section-container">
            <div class="content-text">
                <h2>Building a Greener Tomorrow</h2>
                <p>Our commitment to sustainability drives everything we do. We believe that small actions today create lasting impacts for future generations.</p>
                <p>Through innovative programs and partnerships, we're transforming the way communities interact with their environment, creating positive change at every level.</p>
                <div class="content-features">
                    <div class="feature-item">
                        <div class="feature-text">
                            <h3>Sustainable Practices</h3>
                            <p>Implementing eco-friendly solutions across all operations</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-text">
                            <h3>Community Growth</h3>
                            <p>Empowering communities through education and resources</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-text">
                            <h3>Global Impact</h3>
                            <p>Creating positive environmental change worldwide</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-image">
                <img src="images/m1.jpg" alt="Forest Sustainability">
            </div>
        </div>
    </section>

    <!-- Content Section 2 -->
    <section class="content-section alt">
        <div class="section-container reverse">
            <div class="content-text">
                <h2>Innovation Meets Nature</h2>
                <p>We harness cutting-edge technology to solve environmental challenges. Our research and development team works tirelessly to create sustainable solutions that benefit both people and the planet.</p>
                <p>From renewable energy systems to waste reduction initiatives, our innovative approach sets new standards for environmental responsibility in the modern world.</p>
                <div class="content-features">
                    <div class="feature-item">
                        <div class="feature-icon">💡</div>
                        <div class="feature-text">
                            <h3>Smart Solutions</h3>
                            <p>Technology-driven approaches to sustainability</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">🔬</div>
                        <div class="feature-text">
                            <h3>Research Excellence</h3>
                            <p>Leading environmental research and innovation</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-image">
                <img src="images/m3.jpg" alt="Forest Sustainability">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <h2>Our Impact in Numbers</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500K+</div>
                <div class="stat-label">Trees Planted</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">150+</div>
                <div class="stat-label">Communities Served</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">2M+</div>
                <div class="stat-label">Carbon Offset (tons)</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">95%</div>
                <div class="stat-label">Waste Recycled</div>
            </div>
        </div>
    </section>

    <!-- Info Cards Section -->
    <section class="cards-section">
        <div class="section-header">
            <h2>Explore Our Initiatives</h2>
            <p>Discover the programs and projects that are making a real difference in communities around the world</p>
        </div>
        <div class="cards-grid">
            <div class="info-card">
                <div class="card-image">
                    <img src="images/s1.jpg" alt="Ocean Conservation">
                </div>
                <div class="card-content">
                    <h3>Ocean Conservation</h3>
                    <p>Protecting marine ecosystems through cleanup initiatives and sustainable fishing practices that preserve ocean life for future generations.</p>
                    <a href="#" class="card-link">Learn More →</a>
                </div>
            </div>
            <div class="info-card">
                <div class="card-image">
                    <img src="images/s2.jpg" alt="Forest Restoration">
                </div>
                <div class="card-content">
                    <h3>Forest Restoration</h3>
                    <p>Replanting native forests and protecting woodlands to combat climate change and restore biodiversity.</p>
                    <a href="#" class="card-link">Learn More →</a>
                </div>
            </div>
            <div class="info-card">
                <div class="card-image">
                    <img src="images/s3.jpg" alt="Renewable Energy">
                </div>
                <div class="card-content">
                    <h3>Renewable Energy</h3>
                    <p>Developing clean energy solutions that reduce carbon emissions and provide sustainable power worldwide.</p>
                    <a href="#" class="card-link">Learn More →</a>
                </div>
            </div>
            <div class="info-card">
                <div class="card-image">
                    <img src="images/s4.jpg" alt="Education Programs">
                </div>
                <div class="card-content">
                    <h3>Education Programs</h3>
                    <p>Empowering the next generation with environmental knowledge and leadership in sustainability.</p>
                    <a href="#" class="card-link">Learn More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <h2>Ready to Make a Difference?</h2>
        <p>Join thousands committed to creating a sustainable future. Your journey towards environmental stewardship starts here.</p>
        <div class="cta-buttons">
            <a href="#" class="btn-primary">Get Started Today</a>
            <a href="#" class="btn-secondary">Contact Our Team</a>
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
                <p class="footer-tagline">Leading the future of sustainable mushroom cultivation with innovative greenhouse technology.</p>
                <div class="social-links">
                    <a href="#" class="social-link">f</a>
                    <a href="#" class="social-link">𝕏</a>
                    <a href="#" class="social-link">📷</a>
                    <a href="#" class="social-link">▶</a>
                </div>
            </div>
            <div class="footer-section newsletter">
                <h3>Contact Us</h3>
                <div class="contact-item"><span class="contact-icon">📍</span><div>123 Greenhouse Lane<br>Green Valley, CA 90210</div></div>
                <div class="contact-item"><span class="contact-icon">📞</span><div>(555) 123-GROW</div></div>
                <div class="contact-item"><span class="contact-icon">✉️</span><div>hello@shroomgrow.com</div></div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="copyright">© 2024 ShroomGrow. All rights reserved.</div>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- ✅ JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburgerMenu');
            const navMenu = document.getElementById('navMenu');

            if (hamburger && navMenu) {
                hamburger.addEventListener('click', () => {
                    navMenu.classList.toggle('show');
                });

                document.addEventListener('click', (event) => {
                    if (
                        window.innerWidth <= 420 &&
                        navMenu.classList.contains('show') &&
                        !navMenu.contains(event.target) &&
                        !hamburger.contains(event.target)
                    ) {
                        navMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
    <script src="js/logout.js"></script>
</body>
</html>
