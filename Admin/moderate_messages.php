<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include_once "../php/config.php";

// Delete messages
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM messages WHERE msg_id=$id");
}

$messages = mysqli_query($conn, "SELECT * FROM messages");
?>
<!DOCTYPE html>
<html>
<head><title>Moderate Messages</title>
<link href="../css/moderate_messages.css" rel="stylesheet"></link>
</head>
<body>
    <h1>Moderate Messages</h1>
    <table>
        <tr>
            <th>ID</th><th>Sender</th><th>Message</th><th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($messages)): ?>
        <tr>
            <td><?= $row['msg_id'] ?></td>
            <td><?= $row['outgoing_msg_id'] ?></td>
            <td><?= htmlspecialchars($row['msg']) ?></td>
            <td>
                <a href="?delete_id=<?= $row['msg_id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
