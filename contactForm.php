<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
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

.slider {
    display: grid;
    grid-template-columns: 1fr;
    margin-top: 20px;
}

.slider .slide img {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-bottom: 2px solid #E8D575;
}

.section-title {
    color: #E8D575;
    font-size: 28px;
    text-align: center;
    margin: 40px 0 20px;
}

.products {
    padding: 20px 50px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
}

.product-card {
    background-color: #2D2D2D;
    padding: 15px;
    border-radius: 10px;
    border: 1px solid #E8D575;
    text-align: center;
    transition: 0.3s;
}

.product-card:hover {
    transform: scale(1.04);
}

.product-card img {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 10px;
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

.footer {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 30px;
    padding: 40px 50px;
    background-color: #2D2D2D;
    border-top: 2px solid #E8D575;
}

.footer-column h3 {
    color: #E8D575;
    margin-bottom: 12px;
    font-size: 20px;
}

.footer-column p,
.footer-column a,
.footer-column li {
    color: #E0E0E0;
    list-style: none;
    text-decoration: none;
    margin-bottom: 8px;
    font-size: 14px;
}

.footer-column a:hover {
    color: #FFFFFF;
}

.footer-column iframe {
    border-radius: 8px;
    border: 1px solid #E8D575;
}
.Socials{
    display: flex;
    gap: 10px;
    margin-top: 10px;
}
.Socials a img {
    width: 25px;
    height: 25px;
    cursor: pointer;
    filter: grayscale(100%); 
    transition: 0.3s ease;
}

.Socials a img:hover {
    filter: grayscale(0%); 
    transform: scale(1.1); 
}
.slider {
    position: relative;
    width: 500px;
    height: 400px;
    overflow: hidden;
    border-bottom: 2px solid #E8D575;
    margin-top: 20px;
    border-radius: 10px;
    margin: 20px auto;
}

.slider img.img11 {
    width: 500px;
    height: 400px;
    object-fit: scale-down;
    display: none;
    /* نخفي الصور بشكل افتراضي */
    transition: opacity 0.6s ease-in-out;
    border-radius: 5px;
}

.slider img.active {
    display: block;
    opacity: 1;
}

/* أزرار التنقل */
.slider-prev,
.slider-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    color: #E8D575;
    cursor: pointer;
    padding: 10px;
    background: rgba(0, 0, 0, 0.4);
    border-radius: 50%;
    transition: 0.3s;
}

.slider-prev:hover,
.slider-next:hover {
    background: rgba(0, 0, 0, 0.7);
}

/* السهم اليسار */
.slider-prev {
    left: 20px;
}

/* السهم اليمين */
.slider-next {
    right: 20px;
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
/* Contact Form Container */
.content form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

/* Labels */
.content label {
    font-size: 16px;
    color: #E8D575;
    font-weight: bold;
}

/* Inputs */
.content input[type="text"],
.content input[type="email"],
.content textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #E8D575;
    background-color: #2D2D2D;
    color: white;
    font-size: 15px;
    transition: 0.3s;
}

/* Input hover/focus */
.content input:focus,
.content textarea:focus {
    outline: none;
    border-color: #fff;
    box-shadow: 0 0 8px #E8D575;
}

/* Submit Button */
.content input[type="submit"] {
    background-color: #E8D575;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    color: black;
}

.content input[type="submit"]:hover {
    background-color: #fff;
    transform: scale(1.05);
}

@media (max-width: 1024px) {
    .header {
        grid-template-columns: 1fr;
        justify-items: center;
        row-gap: 15px;
    }

    .nav {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .slider .slide img {
        height: 250px;
    }

    .section-title {
        font-size: 24px;
    }
}

@media (max-width: 480px) {
    .slider .slide img {
        height: 200px;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .footer {
        grid-template-columns: 1fr;
    }
}

.google-forms a img {
    width: 30px;
    height: 30px;
    filter: grayscale(100%);
    transition: 0.25s ease;
    border-radius: 6px;
    display: inline-block;
}

.google-forms a img:hover {
    filter: grayscale(0%);
    transform: scale(1.05);
}


.google-forms .form-text {
    color: #E8D575;
    text-decoration: none;
    font-size: 14px;
    margin-left: 6px;
}
    </style>
</head>
<body>
    <div class="header">
    <div class="logo">
        <img src="imagesforHome/3turha-high-resolution-logo-transparent (1).png" alt="3turha Logo">
    </div>

    <div class="nav">
        <a href="#">Home</a>
        <a href="#">Products</a>
        <a href="sign.html">sign</a>
        <a href="logout.php">Logout</a>
        <a href="aboutUS.php">About US</a>
    </div>
</div>
    <div class="content">
        <h1>Contact Us</h1>
        <p>If you have any questions or inquiries, please fill out the form below to get in touch with us.</p>
        <form action="submitContact.php" method="post">

    <label for="name">Username:</label>
    <input type="text" id="name" name="name" value="<?php echo $username; ?>" readonly>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="6" required></textarea>

    <input type="submit" value="Submit">
</form>

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

    <div class="footer-column">
        <h3>Map</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d...yourmap..." width="100%" height="130"
            style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
    <div class="footer-column">
        
    </div>

</div>
</body>
</html>