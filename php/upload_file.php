<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'config.php'; // Include your database connection file

    // Collect the message text
    $message = $_POST['message'];

    // Check if a file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];

        // Extract file details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Define allowed file types (for security)
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        
        if (in_array($fileType, $allowedTypes)) {
            // Define a directory to store uploaded files
            $uploadDir = 'uploads/';
            
            // Create the uploads directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Create a unique file name to avoid overwriting
            $uniqueFileName = uniqid('', true) . "-" . basename($fileName);
            $filePath = $uploadDir . $uniqueFileName;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpName, $filePath)) {
                // File uploaded successfully, save message and file path to the database
                $stmt = $conn->prepare("INSERT INTO messages (message, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $message, $filePath);
                
                if ($stmt->execute()) {
                    echo "Message and file uploaded successfully!";
                } else {
                    echo "Failed to save message in the database.";
                }
                
                $stmt->close();
            } else {
                echo "Failed to upload the file.";
            }
        } else {
            echo "File type not allowed.";
        }
    } else {
        echo "No file was uploaded or there was an error.";
    }

    $conn->close(); // Close the database connection
}
?>
