<?php
session_start();
include 'config/db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_yield'])) {
    $date = $_POST['date'];
    $bags = intval($_POST['bags']);
    $harvested_kg = floatval($_POST['harvested_kg']);
    $notes = $_POST['notes'];
    $yield_per_bag = $bags > 0 ? $harvested_kg / $bags : 0;

    $stmt = $conn->prepare("INSERT INTO yields (user_id, date, bags, harvested_kg, yield_per_bag, notes, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("isddds", $user_id, $date, $bags, $harvested_kg, $yield_per_bag, $notes);

    if ($stmt->execute()) {
        $_SESSION['yield_message'] = "Record saved successfully!";
        header("Location: yield.php");
        exit;
    } else {
        $yield_message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch user's yield records
$records = [];
$res = $conn->query("SELECT * FROM yields WHERE user_id = $user_id ORDER BY id DESC");
while ($row = $res->fetch_assoc()) {
    $records[] = $row;
}

// Calculate stats
$totalBags = array_sum(array_column($records, 'bags'));
$totalKg = array_sum(array_column($records, 'harvested_kg'));
$avgYield = $totalBags > 0 ? round($totalKg / $totalBags, 2) : 0;
$today = date('Y-m-d');
$todayRecords = count(array_filter($records, fn($r) => $r['date'] === $today));
$weekAgo = date('Y-m-d', strtotime('-7 days'));
$weekHarvest = array_sum(array_map(fn($r) => $r['date'] >= $weekAgo ? $r['harvested_kg'] : 0, $records));
$bestYield = $records ? max(array_column($records, 'yield_per_bag')) : 0;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, device-scale=1.0">
    <title>Yield Records - Mushcraft</title>
    <link rel="stylesheet" href="css/yield.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-container">
            <div class="logo-text">Mushcraft</div>
        </div>
        <nav>
            <a href="home.php" class="nav-button home-button"> Return</a>
            <a href="auth/logout.php" class="nav-button login-button"> Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Yield Records Management</h1>
            <p class="page-subtitle">Track and manage your harvest data efficiently</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card green">
                <div class="stat-label">Total Bags</div>
                <div class="stat-value"><?= $totalBags ?? 0 ?></div>
                <div class="stat-trend">All time records</div>
            </div>
            <div class="stat-card yellow">
                <div class="stat-label">Total Harvested</div>
                <div class="stat-value"><?= $totalKg ?? 0 ?> kg</div>
                <div class="stat-trend">Cumulative yield</div>
            </div>
            <div class="stat-card blue">
                <div class="stat-label">Average Yield</div>
                <div class="stat-value"><?= $avgYield ?? 0 ?> kg</div>
                <div class="stat-trend">Per bag average</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Input Form -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📝</div>
                    <h2 class="card-title">Add New Record</h2>
                </div>

                <?php if (!empty($_SESSION['yield_message'])): ?>
                    <div class="success-message" style="display:block;">
                        <?= $_SESSION['yield_message'] ?>
                    </div>
                    <?php unset($_SESSION['yield_message']); ?>
                <?php endif; ?>

                <?php if (!empty($yield_message)): ?>
                    <div class="success-message" style="display:block; background:#fee2e2; color:#ef4444;">
                        <?= $yield_message ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="yield-form">
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-inputd" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Number of Fruiting Bags</label>
                        <input type="number" name="bags" class="form-input" min="1" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harvested Weight</label>
                        <div class="input-group">
                            <input type="number" name="harvested_kg" class="form-input" step="0.01" min="0.01" required style="padding-right:50px;">
                            <span class="input-suffix">kg</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Notes (Optional)</label>
                        <input type="text" name="notes" class="form-input">
                    </div>

                    <button type="submit" name="submit_yield" class="btn-save">💾 Save Record</button>
                </form>
            </div>

            <!-- Summary Card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">📊</div>
                    <h2 class="card-title">Quick Summary</h2>
                </div>

                <div style="display: flex; flex-direction: column; gap: 25px;">
                    <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 8px; font-weight: 600;">Today's Records</div>
                        <div style="font-size: 32px; font-weight: 700; color: #16a34a;"><?= $todayRecords ?? 0 ?></div>
                    </div>

                    <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 8px; font-weight: 600;">This Week's Harvest</div>
                        <div style="font-size: 32px; font-weight: 700; color: #16a34a;"><?= $weekHarvest ?? 0 ?> kg</div>
                    </div>

                    <div style="padding: 20px; background: #f9fafb; border-radius: 12px;">
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 8px; font-weight: 600;">Best Yield Per Bag</div>
                        <div style="font-size: 32px; font-weight: 700; color: #16a34a;"><?= $bestYield ?? 0 ?> kg</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Table -->
        <div class="history-card">
            <div class="history-header">
                <div class="card-header" style="margin: 0;">
                    <div class="card-icon">📋</div>
                    <h2 class="card-title">Yield History</h2>
                </div>
                <a href="yield/clear_yield.php" class="btn-clear">🗑️ Clear All</a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Bags</th>
                            <th>Harvested (kg)</th>
                            <th>Yield/Bag</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if (!empty($records)): ?>
        <?php foreach ($records as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= date('M d, Y', strtotime($row['date'])) ?></td>
                <td><?= $row['bags'] ?></td>
                <td><?= $row['harvested_kg'] ?></td>
                <td><?= $row['yield_per_bag'] ?></td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
                <td>
                    <a href="yield/delete_yield.php?id=<?= $row['id'] ?>" class="action-btn">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <div class="empty-state-text">No records yet. Start adding your yield data!</div>
                </div>
            </td>
        </tr>
    <?php endif; ?>
</tbody>

                </table>
            </div>
        </div>
    </div>
</body>
</html>

