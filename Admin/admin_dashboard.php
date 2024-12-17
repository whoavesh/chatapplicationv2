<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include_once "../php/config.php";

// Fetch analytics
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users"))['count'];
$active_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE status='online'"))['count'];
$total_messages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM messages"))['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Total Users: <?= $total_users ?></p>
    <p>Active Users: <?= $active_users ?></p>
    <p>Total Messages: <?= $total_messages ?></p>
    <a href="manage_users.php">Manage Users</a>
    <a href="moderate_messages.php">Moderate Messages</a>
    <a href="logout.php" class="logout-btn">Logout</a>
    <footer>
        <p>&copy; 2024 Chat Application. All rights reserved.</p>
    </footer>
</body>
</html>
