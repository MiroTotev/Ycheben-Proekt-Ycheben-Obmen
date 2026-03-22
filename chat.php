<?php
// chat.php

// Start a session
session_start();

// Database connection
$servername = "localhost";
$username = "username"; // Update with database username
$password = "password"; // Update with database password
$dbname = "chat_db"; // Update with database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch chat messages
function fetchMessages($conn) {
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    return $messages;
}

// Add new message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $username = $_SESSION['username']; // Assuming username is stored in session
    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();
}

// HTML and JavaScript
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="chat-window">
        <div id="messages">
            <?php foreach (fetchMessages($conn) as $msg): ?>
                <p><strong><?php echo htmlspecialchars($msg['username']); ?>:</strong> <?php echo htmlspecialchars($msg['message']); ?></p>
            <?php endforeach; ?>
        </div>
        <form id="chat-form">
            <input type="text" id="message" name="message" placeholder="Type a message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#chat-form').submit(function(e) {
                e.preventDefault();
                $.post('chat.php', $(this).serialize(), function() {
                    $('#message').val('');
                    loadMessages();
                });
            });
        });
        function loadMessages() {
            $.get('chat.php', function(data) {
                $('#messages').html(data);
            });
        }
    </script>
</body>
</html>
