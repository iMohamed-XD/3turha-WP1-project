<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // إعادة التوجيه إلى صفحة تسجيل الدخول إذا لم يكن المستخدم مسجلاً الدخول
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle account deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentUser = $_SESSION['username'];
    
    $sql = "DELETE FROM users WHERE username='$currentUser'";
    if ($conn->query($sql) === TRUE) {
        session_destroy(); // إنهاء الجلسة بعد حذف الحساب
        header("Location: register.php"); // إعادة التوجيه إلى صفحة التسجيل
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Account</h1>
    <p>Are you sure you want to delete your account?</p>
    <form method="post" action="">
        <input type="submit" value="Delete Account">
    </form>
    <a href="login.php">Cancel</a>
</body>
</html>