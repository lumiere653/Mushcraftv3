<?php
include '../config/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM yields WHERE id = $id");
}

header("Location: ../yield.php");
exit;
?>
