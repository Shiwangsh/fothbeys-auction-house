<?php
require_once('../db/database_connection.php');
require_once('../db/databaseTable.php');

session_start();

if (isset($_POST['submit'])) {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['contact']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        try {
            $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $userTable = new DatabaseTable($pdo, 'users');
            $newuser = [
                'first_name' => $_POST['firstname'],
                'last_name' => $_POST['lastname'],
                'email' => $_POST['email'],
                'password' => $hashed_password,
                'address' => $_POST['address'],
                'contact' => $_POST['contact'],
                'user_type' => $_POST['category']
            ];
            $userTable->insert($newuser);
            echo "<script>
    alert('Please wait till your account gets verified')
    window.location = '../signup.php'</script>";
            // header('location:../index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // header('location:../index.php');
    } else {
        echo "
<script>
    alert('Please fill up the required field!')
    window.location = '../signup.php'
</script>
";
    }
}
