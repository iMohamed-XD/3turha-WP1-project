<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

$firstErr = $lastErr = $userErr = $passErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = test_input($_POST['firstname']);
    $lastname  = test_input($_POST['lastname']);
    $username  = test_input($_POST['username']);
    $rawPassword = test_input($_POST['password']);

    // Validation
    if (!preg_match("/^[A-Za-z]{2,20}$/", $firstname)) {
        $firstErr = "Only letters (2–20)";
    }

    if (!preg_match("/^[A-Za-z]{2,20}$/", $lastname)) {
        $lastErr = "Only letters (2–20)";
    }

    if (!preg_match("/^[A-Za-z0-9_]{4,16}$/", $username)) {
        $userErr = "4–16 chars (letters, numbers, _)";
    }

    if (strlen($rawPassword) < 6) {
        $passErr = "Password must be at least 6 characters";
    }

    // Only proceed if all validation is good
    if ($firstErr == "" && $lastErr == "" && $userErr == "" && $passErr == "") {

        $firstname = $conn->real_escape_string($firstname);
        $lastname  = $conn->real_escape_string($lastname);
        $username  = $conn->real_escape_string($username);

        $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

        $checkQuery = "SELECT id FROM users WHERE username = '$username' LIMIT 1";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            $userErr = "Username already exists";
        } else {

            $sql = "INSERT INTO users (username, FirstName, LastName, password)
                    VALUES ('$username', '$firstname', '$lastname', '$hashedPassword')";

            if ($conn->query($sql) === TRUE) {

                header("Location: loginNew.php");
                exit();  
            } else {
                $userErr = "Database error, try again.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign</title>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #1E1E1E;
    color: white;
    display: grid;
    place-items: center;
    min-height: 100vh;
}

/*  CONTAINER  */
.container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;

    background: #202020dc;
    padding: 40px 50px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);

    width: 550px;
    height: 600px;
    box-shadow: 0 0 20px #887a32;
}

/*  TITLE  */
.container h1 {
    text-align: center;
    color: #887a32;
    letter-spacing: 1px;
    margin-bottom: -12px;
}

/*  FORM  */
.container form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

/*  INPUTS  */
.container input[type="text"],
.container input[type="password"] {
    padding: 18px;
    font-size: 16px;
    border-radius: 10px;
    border: none;
    outline: none;
    background: rgba(255, 255, 255, 0.12);
    color: white;
    transition: 0.2s;
    border: 1px solid transparent;
}

.container input[type="text"]:focus,
.container input[type="password"]:focus {
    border-color: #E8D575;
    box-shadow: 0 0 10px #887a32;
}

/*  SUBMIT BUTTON  */
.container input[type="submit"] {
    background: #00aaff;
    color: white;
    border: none;
    padding: 15px;
    font-size: 17px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s;
    font-weight: bold;
}

.container input[type="submit"]:hover {
    background: #E8D575;
    box-shadow: 0 0 10px #887a32;
}
.img11 {
    width: 160px;
    display: block;
    margin: 10px auto 5px auto; 
}
a{
     color: #E6D67A;
    font-size: 14px;
    text-decoration: none;
    text-align: center;
}
/* TABLETS (max-width: 900px) */
@media (max-width: 900px) {
    .container {
        width: 80%;
        height: auto;
        padding: 30px 35px;
    }

    .container h1 {
        font-size: 26px;
    }

    .img11 {
        width: auto;
        max-width: 200px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: -12px;
        display: block;
    }
}

/*  SMALL TABLETS & LARGE PHONES (max-width: 600px)  */
@media (max-width: 600px) {
    body {
        padding: 20px;
    }

    .container {
        width: 100%;
        padding: 25px 25px;
    }

    .container h1 {
        font-size: 24px;
    }

    .container input[type="text"],
    .container input[type="password"] {
        font-size: 15px;
        padding: 11px;
    }

    .img11 {
        width: auto;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: -1px;
    }
}

/*  PHONES (max-width: 430px)  */
@media (max-width: 430px) {
    .container {
        padding: 20px 20px;
    }

    .container h1 {
        font-size: 22px;
    }

    .container input[type="text"],
    .container input[type="password"],
    .container input[type="submit"] {
        font-size: 14px;
        padding: 10px;
    }

    .img11 {
        width: auto;
        margin-bottom: -30px;
    }
}

    </style>
</head>
<body>
    <body>
        <div class="container">
        <img class="img11" src="imgs/3turha-high-resolution-logo-transparent (1).png" alt="logo not found">
        <h1>Create Account</h1>
    
        <form method="post" action="">

    <input type="text" name="firstname" placeholder="First Name" >
    <p style="color:red; margin:0;"><?= $firstErr ?></p>
        
            <input type="text" name="lastname" placeholder="Last Name" >
            <p style="color:red; margin:0;"><?= $lastErr ?></p>
        
            <input type="text" name="username" placeholder="Choose Username" >
            <p style="color:red; margin:0;"><?= $userErr ?></p>
        
            <input type="password" name="password" placeholder="Create Password" >
            <p style="color:red; margin:0;"><?= $passErr ?></p>
        
            <input type="submit" value="Register">
        
            <a href="loginNew.php">Already have an account? Login</a>
        
            <p style="color:#E6D67A;"><?= $success ?></p>
        </div>
        </div>

</body>
</html>