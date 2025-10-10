<?php
include("../config/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, password)
            VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! You can now login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: Email already exists or invalid data.');</script>";
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

        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="">
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
            </div>

            <div class="form-checkbox">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the Terms and Conditions</label>
            </div>

            <button type="submit" class="btn-submit">Create Account</button>

            <div class="auth-switch">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>