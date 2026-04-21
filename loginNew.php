<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3turha";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    
    $username = $conn->real_escape_string($username);

    
    if ($username === "admin" && $password === "admin123456") {
        $_SESSION['username'] = "admin";
        header("Location: users.php");
        exit();
    }

    
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['username'] = $user['username'];
            $_SESSION['FirstName'] = $user['FirstName'];
            $_SESSION['LastName']  = $user['LastName'];

            $_SESSION['user_id'] = $user['id'];

            header("Location: homePage.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Username not found!";
    }
}

$conn->close();
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
    height: 450px;
    box-shadow: 0 0 20px #887a32;
}


.container h1 {
    text-align: center;
    color: #887a32;
    letter-spacing: 1px;
    margin-bottom: -12px;
}


.container form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}


.container input[type="text"],
.container input[type="password"] {
    padding: 12px;
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


.container input[type="submit"] {
    background: #00aaff;
    color: white;
    border: none;
    padding: 12px;
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
    margin-left: 192px;
    margin-bottom: -66px;
    margin-top: 23px;
}

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
        <h1>Login to your Account</h1>
    
        <form method="post" action="">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="submit" value="Login">
            <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        </form>
        </div>
        </div>

</body>
</html>