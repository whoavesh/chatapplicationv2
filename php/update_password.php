<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php';

    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);]
    $encrypt_pass = md5($newPassword);

    $query = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
    $query->execute([$token]);
    $user = $query->fetch();

    if ($user) {
        // Update the password
        $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        if ($update->execute([$encrypt_pass, $token])) {
            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Invalid token.";
    }
}
?>
