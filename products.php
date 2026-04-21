<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$editMode = false;
$editData = ['id'=>'','name'=>'','description'=>'','price'=>'','discount'=>''];

/* --- ADD PRODUCT --- */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {

    $name = $conn->real_escape_string($_POST['name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $discount = $conn->real_escape_string($_POST['discount']);

    /* IMAGE UPLOAD */
    $imageName = time() . '_' . basename($_FILES["image"]["name"]);
    $targetPath = "uploads/" . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);

    $conn->query("INSERT INTO products (name, price, discount, description, image)
                  VALUES ('$name', '$price', '$discount', '$desc', '$imageName')");

    header("Location: products.php");
    exit();
}

/* --- EDIT PRODUCT --- */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_product'])) {

    $id = $_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $discount = $conn->real_escape_string($_POST['discount']);

    $image = $_POST['old_image']; 

    /* --- NEW IMAGE UPLOAD --- */
    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . '_' . basename($_FILES["image"]["name"]);
        $targetPath = "uploads/" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            // Delete old image to save space
            if (file_exists("uploads/" . $_POST['old_image'])) {
                unlink("uploads/" . $_POST['old_image']);
            }
            $image = $imageName;
        }
    }

    $conn->query("UPDATE products 
                  SET name='$name',
                      description='$desc',
                      price='$price',
                      discount='$discount',
                      image='$image'
                  WHERE id=$id");

    header("Location: products.php");
    exit();
}


/* --- DELETE PRODUCT --- */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: products.php");
    exit();
}

/* --- LOAD EDIT DATA --- */
if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM products WHERE id=$id");
    if ($res->num_rows > 0) $editData = $res->fetch_assoc();
}

/* --- LOAD PRODUCT LIST --- */
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Products Dashboard</title>
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
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: 0.25s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}


.btn-edit {
    background: #4da3ff;
    color: #fff;
    margin-bottom: 5px;
}

.btn-edit:hover {
    background: #1d8bff;
    transform: translateY(-2px);
}

.btn-delete {
    background: #ff5c5c;
    color: white;
}

.btn-delete:hover {
    background: #d63030;
    transform: translateY(-2px);
}

.btn-cancel {
    background: #777;
    color: white;
}

.btn-cancel:hover {
    background: #999;
    transform: translateY(-2px);
}

.btn-add {
    background: #E6D67A;
    color: #1E1E1E;
    font-weight: bold;
    box-shadow: 0 0 0px transparent;
    margin-bottom: 10px;
}

.btn-add:hover {
    background: #fff2a6;
    transform: translateY(-2px);
    box-shadow: 0 0 12px #e6d67a;
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

form input,
form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    margin-top: 4px;
    margin-bottom: 12px;
    background-color: #2b2b2b;
    color: #fff;
}
form input[type="file"] {
    background: none;
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
        <a href="users.php">Users</a>
        <a href="orders.php">Orders</a>
        <a href="feedback.php">Feedback</a>
         <a href="logout.php">Log out</a>
    </div>
</div>

<!-- MAIN PAGE -->
<div class="main">

<h1>Manage Products</h1>

<!-- SHOW ADD FORM BUTTON -->
<button id="showAddFormBtn" class="btn btn-add">
    <img src="imgs/plus.png" alt="" class="icons"> Add New Product
</button>

<!-- ADD PRODUCT FORM -->
<div id="addFormContainer" style="display:none;">
<form method="post" enctype="multipart/form-data">
    <h2>Add Product</h2>

    <label>Product Name:</label>
    <input type="text" name="name" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>Price:</label>
    <input type="number" name="price" step="0.01" required>

    <label>discount:</label>
    <input type="number" name="discount" required>
    <label>Product Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <input type="submit" name="add_product" class="btn btn-add" value="Add Product">
    <button type="button" id="cancelAddForm" class="btn btn-cancel">
        <img src="imgs/cancel.png" alt="" class="icons"> Cancel
    </button>
</form>
</div>

<!-- EDIT PRODUCT FORM -->
<?php if ($editMode): ?>
<form method="post" enctype="multipart/form-data">
    <h2>Edit Product</h2>

    <input type="hidden" name="id" value="<?= $editData['id'] ?>">

    <label>Product Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($editData['name']) ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?= htmlspecialchars($editData['description']) ?></textarea>

    <label>Price:</label>
    <input type="number" name="price" step="0.01" value="<?= $editData['price'] ?>" required>

    <label>Discount:</label>
    <input type="number" name="discount" value="<?= $editData['discount'] ?>" required>

    <label>Product Image:</label>
    <input type="file" name="image" accept="image/*">
    <input type="hidden" name="old_image" value="<?= $editData['image'] ?>">

    <input type="submit" name="edit_product" class="btn btn-edit" value="Update Product">
    <a href="products.php">
        <button type="button" class="btn btn-cancel"><img src="imgs/cancel.png" alt="" class="icons"> Cancel</button>
    </a>
</form>
<?php endif; ?>

<!-- PRODUCT TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th class="desc_th">Description</th>
    <th>Price</th>
    <th>Discount</th>
    <th>Final Price</th>
    <th>Image</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td>$<?= number_format($row['price'], 2) ?></td>
    <td><?= $row['discount'] ?>%</td>
    <td>$<?= number_format($row['price'] * (1 - $row['discount'] / 100), 2) ?></td>
    <td><img src="uploads/<?= $row['image'] ?>" width="70"></td>
    <td>
        <a href="?edit=<?= $row['id'] ?>" class="btn btn-edit"><img src="imgs/edit.png" alt="" class="icons"> Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this product?');">
           <img src="imgs/delete.png" alt="" class="icons"> Delete </a>
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
