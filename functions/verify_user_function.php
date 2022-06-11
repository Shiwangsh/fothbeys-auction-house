<?php
session_start();
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');


if ($_SESSION['user'] && $_SESSION['user']['user_type'] === 'admin') {
    $id = $_GET['id'];

    foreach ($pdo->query("Select * From users where users.id = $id") as $record) {
        try {
            if ($record['verified']) {
                $stmt = $pdo->query("Update users SET verified = 0 where users.id = $id ");
                echo '<script>
                    window.alert("User is now not verified");
                    window.history.go(-1)
                </script>';
            } elseif (!$record['verified']) {
                $stmt = $pdo->query("Update users SET verified = 1 where users.id = $id ");
                echo '<script>
                    window.alert("User is now verified");
                    window.history.go(-1)
                </script>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
