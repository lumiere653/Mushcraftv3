<?php
include '../config/db_connect.php';
$conn->query("TRUNCATE TABLE yields");
header("Location: ../yield.php");
exit;
?>
