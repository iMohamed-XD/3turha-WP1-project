<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>About US</title>
      <style>
.products {
    padding: 20px 50px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
}



.map-section {
    padding: 40px 50px;
}

.map-frame iframe {
    width: 100%;
    height: 350px;
    border: 2px solid #E8D575;
    border-radius: 10px;
}


.content {
    max-width: 800px;
    margin: 50px auto;
    background-color: black;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    gap: 20px;
}
.content h1,p{
    margin: 10px;
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
        <a href="userProducts.php">Products</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

    <div class="content">
        <h1>About Us</h1>
    <p>Welcome to 3turha!</p> 
    <p> We are dedicated to providing the finest perfumes sourced from around the world.
        Our mission is to offer a diverse selection of fragrances that cater to every individual's unique taste. At 3turha,
         quality and customer satisfaction are our top priorities.
    </p> <br>
    <p>Thank you for choosing us for your fragrance needs!</p>
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