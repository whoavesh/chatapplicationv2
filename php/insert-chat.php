<?php 
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Check if a message or a file is being sent
    if (!empty($message) || !empty($_FILES['file']['name'])) {
        // Handle text message insertion
        if (!empty($message)) {
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(mysqli_error($conn));
        }

        // Handle file upload
        if (!empty($_FILES['file']['name'])) {
            // Define upload directory
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create the uploads directory if it doesn't exist
            }

            // Get file information
            $fileName = basename($_FILES['file']['name']);
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            // Define allowed file types
            $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain'];
            $maxFileSize = 2 * 1024 * 1024; // 2MB file size limit

            // Validate file type and size
            if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
                // Generate a unique name for the file to avoid collisions
                $uniqueFileName = uniqid() . "_" . $fileName;
                $uploadFilePath = $uploadDir . $uniqueFileName;

                // Move the uploaded file to the upload directory
                if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
                    // Insert the file details into the messages table
                    $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file_path)
                                                VALUES ({$incoming_id}, {$outgoing_id}, '', '{$uniqueFileName}')") or die(mysqli_error($conn));
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                echo "Invalid file type or file size exceeds the limit.";
            }
        }

        // Update the latest message ID in the friends table
        $sql2 = "SELECT msg_id FROM `messages` WHERE outgoing_msg_id = $outgoing_id ORDER BY msg_id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql2);
        if ($row = mysqli_fetch_assoc($result)) {
            $latest_id = $row['msg_id'];
            $sql3 = mysqli_query($conn, "UPDATE `friends` SET `last_msg_id` = '$latest_id' WHERE `unique_id` = $incoming_id OR `friend_id` = $incoming_id") or die(mysqli_error($conn));
        }
    } else {
        header("location: /sendbox");
    }
} else {
    header("location: /sendbox");
}
?>
