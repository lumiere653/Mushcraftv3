<?php
declare(strict_types=1);

// Use Composer’s autoloader (modern PHP practice)
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

// Create database connection using namespaced class
$db = new Database();
$conn = $db->getConnection();

// Clear the yields table
$conn->query("TRUNCATE TABLE yields");

// Redirect back to yield page
header("Location: ../yield.php");
exit;
?>
