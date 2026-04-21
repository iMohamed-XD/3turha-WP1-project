<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

if (!isset($_GET['id']))
    die("Product not found!");

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product)
    die("Product does not exist!");

$price = $product["price"];
$discount = $product["discount"];
$newPrice = ($discount > 0) ? $price - ($price * ($discount / 100)) : $price;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title><?= $product['name'] ?> - Details</title>

    <style>
      

        .details-wrapper {
            padding: 40px 60px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 40px;
            background-color: #2B2B2B;
            padding: 30px;
            border-radius: 18px;
            border: 2px solid #B2950D;
            min-height: 480px;
        }

        .product-image {
            width: 85%;
            height: 80%;          
            object-fit: cover;      
            border-radius: 15px;    
            border: 2px solid #d4ae07ff; 
            display: block;        
        }

        .product-info-box h1 {
            color: #E8D575;
            font-size: 32px;
            margin-bottom: 15px;
        }

        .price-box {
            margin: 20px 0;
        }

        .new-price {
            color: #E8D575;
            font-size: 28px;
            font-weight: bold;
            display: inline-block;
        }

        .old-price {
            text-decoration: line-through;
            color: #b8b8b8;
            font-size: 18px;
            margin-left: 8px;
        }

        .discount-badge {
            display: inline-block;
            background-color: #E8D575;
            color: #1E1E1E;
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: bold;
            margin-left: 8px;
        }

        /* DESCRIPTION */
        .description {
            margin-top: 25px;
            line-height: 1.7;
            font-size: 16px;
            color: #dddddd;
        }

        /* BUTTON */
        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #E8D575;
            color: #1E1E1E;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background-color: #fff;
            transform: scale(1.05);
        }
        .purchase-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #E8D575;
            color: #1E1E1E;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 17px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .purchase-btn:hover {
            background-color: #fff;
            transform: scale(1.05);
        }


        @media (max-width: 1024px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 380px;
            }
        }

        @media (max-width: 600px) {
            .details-wrapper {
                padding: 20px;
            }

            .details-grid {
                padding: 20px;
            }

            .product-image {
                height: 300px;
            }

            .product-info-box h1 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
            <div id="scroll-progress"></div>
    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="imagesforHome/3turha-high-resolution-logo-transparent (1).png" alt="3turha Logo">
        </div>

        <div class="nav">
            <a href="homePage.php">Home</a>
            <a href="aboutUS.php">About Us</a>
            <a href="userProducts.php">Products</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- PRODUCT DETAILS GRID -->
    <div class="details-wrapper">
        <div class="details-grid">

            <!-- LEFT IMAGE -->
            <img class="product-image" src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">

            <!-- RIGHT CONTENT -->
            <div class="product-info-box">
                <h1><?= $product['name'] ?></h1>

                <div class="price-box">
                    <?php if ($discount > 0): ?>
                        <span class="new-price">$<?= number_format($newPrice, 2) ?></span>
                        <span class="old-price">$<?= number_format($price, 2) ?></span>
                        <span class="discount-badge">-<?= $discount ?>%</span>
                    <?php else: ?>
                        <span class="new-price">$<?= number_format($price, 2) ?></span>
                    <?php endif; ?>
                </div>

                <div class="description">
                    <h3 style="color:#E8D575; margin-bottom: 8px;">Description:</h3>
                    <p><?= nl2br($product['description']) ?></p>
                </div>
                <form action="purchase.php" method="POST">
                     <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="total_price" value="<?= $newPrice ?>">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <button type="submit" class="purchase-btn">Purchase</button>
                </form>

                <a href="userProducts.php" class="back-btn">← Back to Products</a>
            </div>

        </div>
    </div>
    <button id="backTop">↑</button>
    <script src="JS/main.js"></script>
</body>