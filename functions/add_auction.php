<?php
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');
session_start();

if (isset($_SESSION['user']) && isset($_POST['submit'])) {
    if (isset($_POST['title'], $_POST['date'], $_POST['time'], $_POST['location']) && !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['location'])) {
        try {
            //create auction table instance
            $auctionTable = new DatabaseTable($pdo, 'auction');
            $newAuction = [
                'title' => $_POST['title'],
                'date' => $_POST['date'],
                'time' => $_POST['time'],
                'location' => $_POST['location']
            ];
            //insert into auction table
            $auctionTable->insert($newAuction);
            header('location:../admin/auctions.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<script>window.alert("invalid input please try again")
                window.location = "../admin/auctions.php"
        </script>';
    }
} else {
    echo 'please log in first';
}
