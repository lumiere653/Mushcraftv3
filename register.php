<?php
include_once "../config/db_connect.php"; // Fixed: removed parentheses and used include_once

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Use prepared statements for security
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! You can now login.'); window.location='login.php';</script>";
            exit;
        } else {
            $error = "Error: Email already exists or invalid data.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/auth.css">
    <style>
        .error-text {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
            text-align: left;
            padding-left: 2px;
        }
        .form-input.error {
            border: 1px solid red;
        }
    </style>
   <script>
        // Client-side password confirmation check
        function validateForm(event) {
            const password = document.querySelector('input[name="password"]');
            const confirm = document.querySelector('input[name="confirm_password"]');
            const errorText = document.getElementById('passwordError');

            if (password.value !== confirm.value) {
                event.preventDefault();
                errorText.textContent = "Passwords do not match.";
                confirm.classList.add('error');
                return false;
            } else {
                errorText.textContent = "";
                confirm.classList.remove('error');
                return true;
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="logo-container">
            <div class="logo-text">Mushcraft</div>
        </div>
        <nav>
            <a href="../index.php" class="nav-button home-button">Home</a>
            <a href="login.php" class="nav-button login-button">Login</a>
        </nav>
    </header>
    <div class="auth-container">
        <div class="auth-box">
            <div class="auth-header">
                <h1 class="auth-title">Create Account</h1>
                <p class="auth-subtitle">Join us in making a sustainable future</p>
            </div>

            <form method="POST" action="" onsubmit="validateForm(event)">
                <div class="name-group">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-input" placeholder="First name" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-input" placeholder="Last name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-input" placeholder="Confirm your password" required>
                    <p id="passwordError" class="error-text">
                        <?php if (!empty($error) && $error === "Passwords do not match.") echo $error; ?>
                    </p>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <span class="terms-link" id="openModal">Terms and Conditions</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit">Create Account</button>

                <div class="auth-switch">
                    Already have an account? <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Terms and Conditions</h2>
            
            <p><strong>Last Updated:</strong> October 19, 2025</p>
            
            <h3>1. Acceptance of Terms</h3>
            <p>By accessing and using this service, you accept and agree to be bound by the terms and provision of this agreement.</p>
            
            <h3>2. Use License</h3>
            <p>Permission is granted to temporarily download one copy of the materials for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose</li>
                <li>Attempt to decompile or reverse engineer any software</li>
                <li>Remove any copyright or other proprietary notations</li>
            </ul>
            
            <h3>3. User Responsibilities</h3>
            <p>You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.</p>
            
            <h3>4. Privacy Policy</h3>
            <p>Your use of our service is also governed by our Privacy Policy. Please review our Privacy Policy, which also governs the site and informs users of our data collection practices.</p>
            
            <h3>5. Disclaimer</h3>
            <p>The materials on our service are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
            
            <h3>6. Limitations</h3>
            <p>In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use our service.</p>
            
            <h3>7. Modifications</h3>
            <p>We may revise these terms of service at any time without notice. By using this service you are agreeing to be bound by the then current version of these terms of service.</p>
            
            <h3>8. Contact Information</h3>
            <p>If you have any questions about these Terms and Conditions, please contact us.</p>
        </div>
    </div>

    <script>
        // Terms and Conditions Modal Script
        const modal = document.getElementById('termsModal');
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');

        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('active');
        });

        closeBtn.addEventListener('click', function() {
            modal.classList.remove('active');
        });

        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                modal.classList.remove('active');
            }
        });
    </script>
</body>
</html>
