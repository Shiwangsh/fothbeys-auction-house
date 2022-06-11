<?php
include '../app/header.php';
require_once('../db/DatabaseTable.php');
require_once('../db/database_connection.php');
include '../app/sidebar-admin.php';
$auctionID = $_GET['id'];
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
    if (isset($_POST['submit'])) {
        if (isset($_POST['title'], $_POST['date'], $_POST['time'], $_POST['location'])) {
            try {
                $auctionTable = new DatabaseTable($pdo, 'auction');
                $newAuction = [
                    'id' => $auctionID,
                    'title' => $_POST['title'],
                    'date' => $_POST['date'],
                    'time' => $_POST['time'],
                    'location' => $_POST['location']
                ];
                $auctionTable->update($newAuction, 'id');
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
        echo '<div class="admin-auction-section-right">
    <h1> Edit Auction</h1>';
        foreach ($pdo->query("Select * FROM auction WHERE auction.id = $auctionID") as $record) {

            echo '<div class="admin-add-auction">
            <form method="post" action="functions/edit_auction_function.php?id=' . $record['id'] . '">
                <div class="input">
                    <label>Title</label>
                    <input type="text" name="title" value="' . $record['title'] . '">
                </div>
                <div class="input">
                    <label>Date(YYYY/MM/DD)</label>
                    <input type="text" name=" date"  value="' . $record['date'] . '">
                </div>
                <div class="input">
                    <label>Time</label>
                    <input type="time" name="time"  value="' . $record['time'] . '">
                </div>
                <div class="input">
                    <label>Location</label>
                    <input type="text" name="location"  value="' . $record['location'] . '">
                </div>
                <div class="input">
                    <button type="submit" class="btn" name="submit">Edit auction</button>
                </div>
        </div>
    </div>
    </div>';
        }
    }

    include('../app/footer.php');
} else {
    echo "Please login first";
}
