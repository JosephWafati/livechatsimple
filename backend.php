<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "chat_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for incoming message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    $sql = "INSERT INTO chat_messages (message) VALUES ('$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve chat messages
$sql = "SELECT * FROM chat_messages ORDER BY id DESC LIMIT 50";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row["timestamp"] . "</strong> " . $row["message"] . "</p>";
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
