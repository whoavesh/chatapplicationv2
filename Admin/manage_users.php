<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include_once "../php/config.php";

// Delete users
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($_GET['action'] === 'delete') {
        // Delete user and messages in a transaction
        mysqli_begin_transaction($conn);
        
        try {
            $stmt1 = $conn->prepare("DELETE FROM users WHERE unique_id = ?");
            $stmt1->bind_param("i", $id);
            $stmt1->execute();

            // Delete user-related messages
            $stmt2 = $conn->prepare("DELETE FROM messages WHERE outgoing_msg_id = ? OR incoming_msg_id = ?");
            $stmt2->bind_param("ii", $id, $id);
            $stmt2->execute();

            mysqli_commit($conn); // Commit transaction
        } catch (Exception $e) {
            mysqli_roll_back($conn); // Rollback if there's an error
            echo "Failed to delete user: " . $e->getMessage();
        }
    }
}

$users = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link href="../css/manage_users.css" rel="stylesheet"></link>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <table>
            <tr>
                <th>ID</th><th>Username</th><th>Email</th><th>Status</th><th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= htmlspecialchars($row['unique_id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <a href="?action=delete&id=<?= $row['unique_id'] ?>" 
                       onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
