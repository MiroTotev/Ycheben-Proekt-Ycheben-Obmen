<?php

// chat_handler.php

// Function to handle incoming chat messages
function handleChatMessage($message) {
    // Your logic for handling the message goes here
    // For instance, you could save it to a database, send notifications, etc.
    echo "Received message: " . htmlspecialchars($message);
}

// Sample usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $incomingMessage = $_POST['message'] ?? '';
    handleChatMessage($incomingMessage);
}

?>