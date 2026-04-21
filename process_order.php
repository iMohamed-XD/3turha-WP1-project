<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id'])) {

        $order_id = intval($_POST['order_id']);

        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $order_id);

        if ($stmt->execute()) {
            echo "<script>alert('Order processed and removed successfully!'); window.location.href='orders.php';</script>";
        } else {
            echo "Error deleting order: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
