<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

/* Load orders list */
$result = $conn->query("SELECT * FROM `orders`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Orders Dashboard</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #1E1E1E;
    color: #FFFFFF;
}

.header {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    padding: 20px 50px;
    background-color: #2D2D2D;
    border-bottom: 1px solid #d7c150;
    position: sticky;
    top: 0;
    z-index: 999;
}

.logo img {
    height: 75px;
}

/* NAVIGATION BAR */
.nav {
    display: flex;
    align-items: center;
    justify-content: space-around;
    background-color: rgb(32, 29, 29);
    padding: 10px 20px;
    border-radius: 10px;
    height: 60px;
}

.nav a {
    text-decoration: none;
    color: #E8D575;
    font-size: 18px;
    font-weight: bold;
    transition: 0.3s;
}

.nav a:hover {
    color: #FFFFFF;
    transform: scale(1.1);
}

/* MAIN PAGE */
.main {
    padding: 40px;
    display: flex;
    flex-direction: column;
}

h1 {
    color: #E6D67A;
    margin-bottom: 20px;
    margin-left: 120px;
}

/* TABLE */
table {
    width: 85%;
    margin: 0 auto;    
    background: #3A3838;
    border-radius: 12px;
    overflow: hidden;
    border-collapse: collapse;
}

table th {
    background: #444242;
    color: #E6D67A;
    padding: 12px;
}

table td {
    padding: 12px;
    text-align: center;
}

/* BUTTONS */
.btn {
    padding: 8px 15px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: 0.2s ease-in-out;
}

.btn-process {
    background: #4da3ff;
    color: #fff;
}

.btn-process:hover {
    background: #1d8bff;
    transform: translateY(-2px);
}

</style>
</head>

<body>

<div class="header">
    <div class="logo">
        <img src="imagesforHome/3turha-high-resolution-logo-transparent (1).png" alt="3turha Logo">
    </div>

    <div class="nav">
        <a href="products.php">Products</a>
        <a href="users.php">Users</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php">Log out</a>
    </div>
</div>

<!-- MAIN PAGE -->
<div class="main">

<h1>Manage Orders</h1>

<!-- ORDER TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Product ID</th>
    <th>User ID</th>
    <th>Total Price</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['product_id'] ?></td>
    <td><?= $row['user_id'] ?></td>
    <td>$<?= number_format($row['total_price'], 2) ?></td>

    <td>
        <form method="POST" action="process_order.php" style="display:inline;">
            <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
            <button type="submit" class="btn btn-process">Process</button>
        </form>

    </td>
</tr>
<?php endwhile; ?>

</table>

</div>

</body>
</html>

<?php $conn->close(); ?>
