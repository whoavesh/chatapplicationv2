<?php

session_start();
if (isset($_POST['login'])) {
    include_once "../php/config.php";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the entered password using md5
    $hashedPassword = md5($password);

    // Check for admin user with the hashed password
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword' AND is_admin = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['unique_id'];
        header("Location: admin_dashboard.php");
    } else {
        echo "Invalid username or password.";
    }
}
?>
<html>
    <head>
        <style> <?php include '../css/admin_login.css';?></style>
        
    </head>
    <body>
<form method="POST">
    <input type="text" name="username" placeholder="Admin Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
</body>
</html>