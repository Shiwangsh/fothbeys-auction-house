<?php
session_start();
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');


if (isset($_POST['submit'])) {
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $userTable = new DatabaseTable($pdo, 'users');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // foreach ($userTable->select('email', $_POST['email']) as $user) {

            $sql = $pdo->query("select * from users where email = '$email'");
            $count = $sql->rowCount();
            if ($count > 0) {
                foreach ($sql as $user) {
                    $verified = password_verify($password, $user["password"]);
                    if ($verified) {
                        if ($user['verified']) {
                            $_SESSION['user'] = [
                                "username" => $email,
                                "user_type" => $user['user_type']
                            ];
                            header('location:../index.php');
                        } else {
                            echo 'User not verified <br>';
                            echo '<a href="../login.php">Try again</a>';
                        }
                    } else {
                        echo "Wrong Password<br>";
                        echo '<a href="../login.php">Try again</a>';
                    }
                }
            } else {
                echo 'Invalid email <br>';
                echo '<a href="../login.php">Try again</a>';
            }
        } else {
            echo "Invalid Email format <br>";
            echo '<a href="../login.php">Try again</a>';
        }
    }
} else {
    echo "Please fill in all the fields ";
    echo '<br><a href="../login.php">Try again</a>';
}
