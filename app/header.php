<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/fothbeys/" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <title>Fothbeys</title>
</head>

<body>
    <div class="navbar">
        <img src="images/logo.png" alt="logo">
        <div class="navbar-contents1">
            <a class='navbar-link' href="index.php">Home</a>
            <a class='navbar-link' href="auctions.php">Auctions</a>
            <a class='navbar-link' href="about.php">About</a>
        </div>
        <div class="navbar-contents2">
            <?php
            if (isset($_SESSION['user'])) {
                echo "<a class='navbar-link' href='logout.php'>Logout</a>";
                echo "<a class='navbar-link' href='user_dashboard.php'>" . $_SESSION['user']['username'] . '</a>';
            } else {
                echo "<a class='navbar-link' href='login.php'>Login</a>
            <a class='navbar-link' href='signup.php'>Signup</a>";
            }
            ?>
        </div>
    </div>