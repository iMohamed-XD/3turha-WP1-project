<!DOCTYPE html>
<html lang="en" style="
    scroll-behavior: smooth;
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
     <style>
        
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
    margin: 60px 0 20px;
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
.faq-container {
    width: 90%;
    max-width: 800px;
    margin: 40px auto;
}

.faq-item {
    background-color: #2D2D2D;
    border: 1px solid #E8D575;
    border-radius: 8px;
    margin-bottom: 10px;
    padding: 15px 20px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.faq-item:hover {
    background-color: #3A3A3A;
}

.faq-question {
    font-size: 18px;
    color: #E8D575;
    font-weight: bold;
}

.faq-answer {
    color: #E0E0E0;
    margin-top: 10px;
    font-size: 15px;
    display: none;  
}


.faq-answer.show {
    display: block;
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}




.slider {
    position: relative;
    width: 800px;
    height: 600px;
    overflow: hidden;
    border-bottom: 2px solid #E8D575;
    margin-top: 20px;
    border-radius: 10px;
    margin: 20px auto;
}

.slider img.img11 {
    width: 800px;
    height: 600px;
    object-fit: scale-down;
    display: none;
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



/* Large tablets / smaller desktops */
@media (max-width: 1024px) {
    .slider {
        width: 450px;
        height: 350px;
    }
    .slider img.img11 {
        width: 450px;
        height: 350px;
    }
}

/* Tablets / medium screens */
@media (max-width: 768px) {
    .slider {
        width: 90%;          
        height: 300px;
    }
    .slider img.img11 {
        width: 100%;
        height: 300px;
    }

    .slider-prev,
    .slider-next {
        font-size: 30px;
        padding: 8px;
    }
}

/* Small tablets / large phones */
@media (max-width: 600px) {
    .slider {
        width: 95%;
        height: 250px;
    }
    .slider img.img11 {
        width: 100%;
        height: 250px;
    }

    .slider-prev,
    .slider-next {
        font-size: 25px;
        padding: 6px;
    }
}

/* Phones / very small screens */
@media (max-width: 480px) {
    .slider {
        width: 100%;
        height: 200px;
        margin: 15px auto;
    }
    .slider img.img11 {
        width: 100%;
        height: 200px;
    }

    .slider-prev,
    .slider-next {
        font-size: 20px;
        padding: 5px;
    }
}

     </style>
    <title>3turha</title>
</head>
<body>
    <div id="scroll-progress"></div>
<div class="header">
    <div class="logo">
        <img src="imagesforHome/3turha-high-resolution-logo-transparent (1).png" alt="3turha Logo">
    </div>

    <div class="nav">
        
        <a href="userProducts.php">Products</a>
        <a href="aboutUS.php">About Us</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
<h2 id="rotating">Perfumes designed for you...</h2>

<h2 class="section-title">Latest Products</h2>
<div class="slider">
   
        <img src="imagesforHome/perfum1.png" alt="Slide 1"class="img11">
        <img src="imagesforHome/perfum2.png" alt="Slide 2"class="img11">
        <img src="imagesforHome/perfum3.png" alt="Slide 3"class="img11">
        <div class="slider-prev" onclick="slider(-1)">&#10094;</div>
        <div class="slider-next" onclick="slider(1)">&#10095;</div>
</div>
<h2 class="section-title">Frequently Asked Questions</h2>

<div class="faq-container">
    <div class="faq-item">
        <div class="faq-question">Are your perfumes original?</div>
        <div class="faq-answer">Yes, all our perfumes are 100% authentic and sourced from approved suppliers.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">How long does delivery take?</div>
        <div class="faq-answer">Delivery usually takes 2–5 business days depending on your location.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Do you offer returns or exchanges?</div>
        <div class="faq-answer">Yes, unopened perfumes can be returned within 7 days of purchase.</div>
    </div>

    <div class="faq-item">
        <div class="faq-question">Can I sample a perfume before buying?</div>
        <div class="faq-answer">We offer small testers for selected fragrances. Contact support for details.</div>
    </div>
</div>



<div class="map-section">
    <h2 class="section-title">Our Location</h2>

    <div class="map-frame">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3326.5222197314833!2d36.2765333!3d33.5138057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e0b2fd166793%3A0x1e5a4e39ab5956f3!2z2LPYp9it2Kkg2KfZhNij2YXZiNmK2YrZhg!5e0!3m2!1sar!2s!4v1765529494053!5m2!1sar!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </iframe>
    </div>
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