<?php
session_start();
include("../config/db_connect.php");

$error = ""; // store error message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["first_name"];

            echo "<script>
                window.location='../home.php';
            </script>";
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
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
    <style>
        .error-text {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
            text-align: left;
            padding-left: 2px;
        }
    </style>
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

            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                    <?php if (!empty($error)) echo "<p class='error-text'>$error</p>"; ?>
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
