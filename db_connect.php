<?php
// Load environment variables (requires vlucas/phpdotenv)
// Run "composer require vlucas/phpdotenv" once in your project root

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load the .env file from your project root
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve environment variables, with safe defaults if missing
$servername = $_ENV['DB_SERVER'] ?? 'localhost';
$username   = $_ENV['DB_USER']   ?? 'root';
$password   = $_ENV['DB_PASS']   ?? '';
$database   = $_ENV['DB_NAME']   ?? 'ecodb';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}
?>
