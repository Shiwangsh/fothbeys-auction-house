<?php
include 'app/header.php';
require_once('db/database_connection.php');
require_once('db/DatabaseTable.php');
include('app/search_bar.php');

if (isset($_POST['submit'])) {

    $searchItem = $_POST['search_field'];
    $auctionTable = new DatabaseTable($pdo, 'auction');
    $sth = $pdo->query("Select * from auction where location like '%$searchItem%'");
    $count = $sth->rowCount();
    try {
        //check if a row is returned 
        if ($count > 0) {
            foreach ($sth as $row) {
                if (!$row['archive']) {
                    echo '<div class="section-bottom">
                        <h1>Your Search Results</h1>
                        <div class="auctions">';
                    echo '<div class="admin-show-auction">';
                    echo '<div class="auction-details">';
                    echo '<h4>Title: ' . $row['title'] . '</h4>';
                    echo '<h4>Date: ' . $row['date'] . '</h4>';
                    echo '<h4>Time: ' . $row['time'] . '</h4>';
                    echo '<h4>Location: ' . $row['location'] . '</h4>';
                    echo '<button class="view-btn" type="submit"><a href="catalouge.php?id=' . $row['id'] . '"><i class="fa fa-eye"></i></a>
                    </button>';
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div class="section-bottom">
                        <h1>Your Search Results</h1>
                        <div class="auctions">';
            echo '<div class="admin-show-auction">';
            echo '<div class="auction-details">';
            echo 'Sorry no such item available';
            echo '</div>';

            echo '</div>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
echo '</div>';
include 'app/footer.php';
