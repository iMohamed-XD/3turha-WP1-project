<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to purchase a product.");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$product_id = intval($_POST['product_id']);
$user_id = intval($_POST['user_id']);
$total_price = floatval($_POST['total_price']);

$stmt = $conn->prepare("INSERT INTO orders (product_id, user_id, total_price) VALUES (?, ?, ?)");
$stmt->bind_param("iid", $product_id, $user_id, $total_price);

if ($stmt->execute()) {
    echo "<script>alert('Purchase successful!'); window.location.href='userProducts.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
