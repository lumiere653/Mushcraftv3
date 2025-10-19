<?php
session_start();
include("../config/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Save both user_id and name
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["first_name"];

            echo "<script>
                alert('Welcome back, " . $user["first_name"] . "!'); 
                window.location='../home.php';
            </script>";
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.');</script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <div class="logo-text">Mushcraft</div>
        </div>
        <nav>
            <a href="../index.php" class="nav-button home-button">Home</a>
            <a href="register.php" class="nav-button login-button">Sign Up</a>
        </nav>
    </header>

    <div class="auth-container">
    <div class="auth-box">
        <div class="auth-header">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Login to continue your eco-friendly journey</p>
        </div>

        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
            </div>

            <div class="form-checkbox">
                <input type="checkbox" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-submit">Login</button>

            <div class="auth-switch">
                Don't have an account? <a href="register.php">Sign Up</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
