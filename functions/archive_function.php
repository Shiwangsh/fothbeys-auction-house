<?php
session_start();
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');

if ($_SESSION['user'] && $_SESSION['user']['user_type'] === 'admin') {
    $tableName = $_GET['specificField'];
    $id = $_GET['id'];

    foreach ($pdo->query("Select * From $tableName WHERE $tableName.id = $id") as $record) {
        try {
            if ($record['archive']) {
                $stmt = $pdo->query("Update $tableName SET archive = 0 where $tableName.id = $id ");
                echo '<script>
                    window.alert("Item un-archived");
                    window.history.go(-1)
                </script>';
            } elseif (!$record['archive']) {
                $stmt = $pdo->query("Update $tableName SET archive = 1 where $tableName.id = $id ");
                echo '<script>
                 window.alert("Item archived");
                    window.history.go(-1)
                </script>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
