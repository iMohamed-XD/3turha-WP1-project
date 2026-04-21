<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$editMode = false;
$editData = ['id'=>'', 'username'=>'', 'FirstName'=>'', 'LastName'=>'', 'password'=>''];
//` Update user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $username = $conn->real_escape_string($_POST['username']);
    $first = $conn->real_escape_string($_POST['firstname']);
    $last = $conn->real_escape_string($_POST['lastname']);
    $pass = $conn->real_escape_string($_POST['password']);

    $conn->query("UPDATE users SET username='$username', FirstName='$first', 
                  LastName='$last', password='$pass' WHERE id=$id");
    header("Location: users.php");
    exit();
}

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: users.php");
    exit();
}

// Edit request
if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM users WHERE id=$id");
    if ($res->num_rows > 0) $editData = $res->fetch_assoc();
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Users Dashboard</title>
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

/* HEADER + NAV */
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

/* MAIN CONTENT */
.main {
    width: 80%;
    margin: 40px auto;      
    padding: 20px;
}

h1 {
    color: #E6D67A;
    margin-bottom: 20px;
}

/* BUTTONS */
.btn {
    padding: 8px 15px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    transition: 0.2s ease-in-out;
    font-size: 14px;
    text-decoration: none;
}

.btn i { margin-right: 6px; }

.btn-edit { 
    background: #4da3ff; 
    color: #fff; 
}
.btn-delete { 
    background: #ff5c5c; 
    color: #fff; 
}
.btn-cancel { 
    background: #777; 
    color: #fff; 
}

.btn-edit:hover { 
    background: #1d8bff;
    transform: translateY(-2px); 
}
.btn-delete:hover { 
    background: #d63030; 
    transform: translateY(-2px); 
}
.btn-cancel:hover { 
    background: #999; 
    transform: translateY(-2px); 
}

/* FORM */
form {
    background: #3A3838;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}

form label {
    display: block;
    margin-top: 12px;
    color: #E6D67A;
}

form input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    margin-top: 4px;
    margin-bottom: 12px;
}

/* TABLE */
table {
    width: 100%;
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

/* ICONS */
.icons {
    width: 14px;
    height: 14px;
    transform: scale(1.2);
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
        <a href="orders.php">Orders</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php">Log out</a>
    </div>
</div>
<!-- Main Content -->
<div class="main">

<h1>Manage Users</h1>


<?php if ($editMode): ?>
<form method="post">
    <h2>Edit User</h2>
    <input type="hidden" name="id" value="<?= $editData['id'] ?>">

    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($editData['username']) ?>" required>

    <label>First Name:</label>
    <input type="text" name="firstname" value="<?= htmlspecialchars($editData['FirstName']) ?>" required>

    <label>Last Name:</label>
    <input type="text" name="lastname" value="<?= htmlspecialchars($editData['LastName']) ?>" required>

    <input type="submit" name="edit_user" class="btn btn-edit" value="Update User">
    <a href="users.php"><button type="button" class="btn btn-cancel"><img src="imgs/cancel.png" alt="" class="icons"> Cancel</button></a>
</form>
<?php endif; ?>

<table>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['username']) ?></td>
    <td><?= htmlspecialchars($row['FirstName']) ?></td>
    <td><?= htmlspecialchars($row['LastName']) ?></td>
    <td>
        <a href="?edit=<?= $row['id'] ?>" class="btn btn-edit"><img src="imgs/edit.png" alt="" class="icons"> Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this user?');">
            <img src="imgs/delete.png" alt="" class="icons"> Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</div>

<script>
document.getElementById("showAddFormBtn").onclick = () =>
    document.getElementById("addFormContainer").style.display = "block";

document.getElementById("cancelAddForm").onclick = () =>
    document.getElementById("addFormContainer").style.display = "none";
</script>

</body>
</html>

<?php $conn->close(); ?>
