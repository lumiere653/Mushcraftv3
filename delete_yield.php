<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

// Initialize database connection
$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Cast to integer for safety

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM yields WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to yield page
header("Location: ../yield.php");
exit;
?>
