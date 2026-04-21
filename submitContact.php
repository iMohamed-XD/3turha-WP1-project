<?php
session_start();

// Get logged-in username
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// DB connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$message = $_POST['message'];

// Insert into database
$stmt = $conn->prepare("INSERT INTO feedback (username, feedback) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $message);

if ($stmt->execute()) {
    echo "<script>alert('Message sent successfully!'); window.location='contactForm.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
