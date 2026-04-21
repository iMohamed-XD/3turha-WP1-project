<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Products</title>

    <style>

/*  PRODUCT CARDS  */
.products-container {
    padding: 40px 50px;
    display: grid;
    grid-template-columns: repeat(4, 1fr); 
    gap: 25px;
}

.product-card {
    width: 100%;
    max-width: 260px; 
    height: 380px;    
    margin: 0 auto;   
    background-color: #2B2B2B;
    border: 2px solid #444;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s ease;
    cursor: pointer;
}

.product-card:hover {
    border-color: #d7c150;
    transform: translateY(-5px);
}



.product-img {
    width: 100%;
    height: 220px; 
    object-fit: cover;
    border-bottom: 2px solid #444;
}


.price-box {
    margin-top: 10px;
}

.old-price {
    text-decoration: line-through;
    color: #b8b8b8;
    font-size: 14px;
}

.new-price {
    color: #E8D575;
    font-size: 20px;
    font-weight: bold;
}

.product-info {
    padding: 15px;
}

.product-info h3 {
    margin-bottom: 8px;
    color: #E8D575;
    font-size: 20px;
}



@media (max-width: 1100px) {
    .products-container {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 800px) {
    .products-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 500px) {
    .products-container {
        grid-template-columns: repeat(1, 1fr);
    }
}

    </style>

</head>
<body>


 <div id="scroll-progress"></div>
<div class="header">
    <div class="logo">
        <img src="imagesforHome/3turha-high-resolution-logo-transparent (1).png" alt="3turha Logo">
    </div>
    
    <div class="nav">
        <a href="homePage.php">Home</a>
        <a href="aboutUS.php">About Us</a>
        <a href="logout.php">Logout</a>
    </div>
    
</div>


<h1 style="text-align:center; margin-top:30px; color:#E8D575;">Our Products</h1>

<div class="products-container">
    <?php while($row = $products->fetch_assoc()): ?>
        <div class="product-card" onclick="location.href='productDetails.php?id=<?= $row['id'] ?>'">
            
            <img class="product-img" src="uploads/<?= $row['image'] ?>" alt="Product Image">

            <div class="product-info">
                <h3><?= $row['name'] ?></h3>

                <div class="price-box">
                    <?php 
                        $price = $row['price'];
                        $discount = $row['discount']; 
                        $newPrice = $price - ($price * ($discount / 100));
                    ?>

                    <?php if ($discount > 0): ?>
                        <span class="new-price">$<?= number_format($newPrice, 2) ?></span>
                        <?php else: ?>
                            <span class="new-price">$<?= number_format($price, 2) ?></span>
                            <?php endif; ?>
                            <span class="old-price">$<?= number_format($price, 2) ?></span><br>
                </div>
            </div>

        </div>
    <?php endwhile; ?>
</div>

<div class="footer">

    <div class="footer-column">
        <h3>About Company</h3>
        <p>
            3turha! provides premium perfume experiences designed around your identity
            — The Essence of You.
        </p>
    </div>

    <div class="footer-column">
        <h3>Latest News</h3>
        <ul class="news-list">
            <li><a href="#">New fragrance collection launched</a></li>
            <li><a href="#">Upcoming event next month</a></li>
            <li><a href="#">Special discounts available</a></li>
        </ul>
    </div>

    <div class="footer-column" id="Contacts">
    <h3>Contact</h3>
    <p>Email: support@3turha.com</p>
    <p>Phone: +963 954 454 234</p>

    
    <div class="Socials">
        <a href="#" aria-label="Instagram"><img src="imgs/instagram (3).png" alt="Instagram"></a>
        <a href="#" aria-label="X"><img src="imgs/twitter (2).png" alt="X"></a>
        <a href="#" aria-label="Telegram"><img src="imgs/telegram.png" alt="Telegram"></a>
    </div>

    <div class="google-forms">
        <a href="contactForm.php" title="Fill the contact form">
            <img src="imgs/google-forms.png" alt="Google Forms">
        </a>
        <a class="form-text" href="contactForm.php">Or fill a form.</a>
    </div>
</div>
</div>
<button id="backTop">↑</button>

<script src="JS/main.js"></script>
</body>
</html>
