<?php
session_start();
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');
$tableName = $_GET['specificField'];
$id = $_GET['id'];

if ($_SESSION['user'] && $_SESSION['user']['user_type'] === 'admin') {
    try {

        $pdo->query("Delete From $tableName WHERE $tableName.id = $id");
        echo '<script>
                 window.alert("Item deleted");
                    window.history.go(-1)
                </script>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
