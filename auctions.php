<?php
include 'app/header.php';
require_once('db/database_connection.php');
require_once('db/DatabaseTable.php');
include('app/search_bar.php');
?>
<div class="section-bottom">
    <h1>Upcoming Auctions..</h1>
    <div class="auctions">
        <?php
        // Query auctions table
        $stmt = $pdo->query('SELECT * FROM auction');
        foreach ($stmt as $record) {
            if (!$record['archive']) {
                echo '<div class="admin-show-auction">';
                echo '<div class="auction-details">';
                echo '<h4>Title: ' . $record['title'] . '</h4>';
                echo '<h4>Date: ' . $record['date'] . '</h4>';
                echo '<h4>Time: ' . $record['time'] . '</h4>';
                echo '<h4>Location: ' . $record['location'] . '</h4>';
                echo '<button class="view-btn" type="submit"><a href="catalouge.php?id=' . $record['id'] . '"><i class="fa fa-eye"></i></a>
                    </button>';
                echo '</div>';

                echo '</div>';
            }
        }
        ?>
    </div>
</div>





<?php
include 'app/footer.php';
