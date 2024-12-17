<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'config.php'; // Your database connection

    $email = $_POST['email'];
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(50)); // Generate a unique token
        echo($token);
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

        // Store token in the database
        $update = $conn->prepare("UPDATE users SET reset_token = '{$token}', reset_expires = '{$expires}' WHERE email = '{$email}'");
        // $update->execute([$token, $expires, $email]);

        // Create the reset link
        $resetLink = "https://example.org/reset_password.php?token=$token";

        // Send email to the user
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Failed to send the email.";
        }
    } else {
        echo "Email address not found.";
    }
}
?>
