<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $last_id = isset($_POST['last_id']) ? intval($_POST['last_id']) : 0;
    $output = "";

    // Query to fetch only new messages
    $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE ((outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}))
            AND msg_id > {$last_id} 
            ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $isOutgoing = $row['outgoing_msg_id'] === $outgoing_id;
            $messageContent = nl2br(htmlspecialchars($row['msg']), false);
            $timestamp = date('h:i a', strtotime($row['date_time']));
            $lastMessageID = $row['msg_id']; // Update the last message ID

            if ($isOutgoing) {
                // Outgoing message
                $output .= '
                    <div class="chat-message">
                    <div class="flex items-end justify-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 items-end">
                            <div>
                                <span class="text-base font-normal px-4 py-2 rounded-2xl inline-block rounded-br-none bg-blue-700 text-white max-w-xs min-w-xs max-h-screen break-all">'
                                    . $messageContent .
                                '</span>
                            </div>';
                if (!empty($row['file_path'])) {
                    $filePath = $baseUrl.'./uploads/'.htmlspecialchars($row['file_path']);
                    // echo $filePath;
                  
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $output .= '<div class="mt-2"><img src="' . $filePath . '" alt="Uploaded image" class="w-32 h-auto rounded"></div>';
                    } else {
                        $output .= '<div class="mt-2"><a href="' . $filePath . '" target="_blank" class="text-blue-500 underline">Download ' . strtoupper($fileExtension) . ' File</a></div>';
                    }
                }
                $output .= '
                            <div class="flex justify-center items-center">
                                <span class="text-xs font-xs text-gray-400">' . $timestamp . '</span>
                                <button class="pl-1" type="button" onclick="delete_msg_fun(' . $row['msg_id'] . ');">
                                    <img class="w-3" src="php/images/delete_btn.svg" alt="delete btn">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            } else {
                // Incoming message
                $output .= '
                    <div class="chat-message">
                    <div class="flex items-end">
                        <img src="php/images/pfp/' . htmlspecialchars($row['img']) . '" alt="Profile image" class="w-6 h-6 rounded-2xl">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 items-start">
                            <div>
                                <span class="text-base font-normal px-4 py-2 rounded-2xl inline-block rounded-bl-none bg-gray-100 text-gray-800">'
                                    . $messageContent .
                                '</span>
                            </div>';
                if (!empty($row['file_path'])) {
                    $filePath = $baseUrl.'/uploads/'.htmlspecialchars($row['file_path']);
                    
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $output .= '<div class="mt-2"><img src="' . $filePath . '" alt="Uploaded image" class="w-32 h-auto rounded"></div>';
                    } else {
                        $output .= '<div class="mt-2"><a href="' . $filePath . '" target="_blank" class="text-blue-500 underline">Download ' . strtoupper($fileExtension) . ' File</a></div>';
                    }
                }
                $output .= '
                            <span class="text-xs font-xs text-gray-400">' . $timestamp . '</span>
                        </div>
                    </div>
                </div>';
            }
        }
    } else {
        $output .= '<div class="text-gray-300">No messages are available. Once you send a message, they will appear here.</div>';
    }

    // Output the chat messages
    echo $output;
} else {
    // Redirect if session doesn't exist
    header("location: /sendbox");
}
