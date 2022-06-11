<?php
include '../app/header.php';
require_once('../db/database_connection.php');

if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
    include '../app/sidebar-admin.php';
    echo '<div class="admin-auction-section-right">
    <h1>Auctions</h1>';
    $stmt = $pdo->query('SELECT * FROM auction');
    foreach ($stmt as $record) {
        echo '<div class="admin-show-auction">
                <p>' . $record['title'] . '</p>
                <button class="edit-btn" type="submit"><a href="functions/edit_auction_function.php?id=' . $record['id'] . '"><i class="fa fa-edit"></i></a>
                </button>
                <button class="archive-btn" type="submit"><a href="functions/archive_function.php?specificField=auction&id=' . $record['id'] . '"><i class="fa fa-archive"></i></a></button>
                <button class="delete-btn" type="submit"><a href="functions/delete_function.php?specificField=auction&id=' . $record['id'] . '"><i class="fa fa-trash"></i></a></button>        
        </div>';
    }
    echo '<hr>';

    echo '<div class="admin-add-auction">
        <h1>Add new Auctions</h1>
        <form method="post" action="functions/add_auction.php">
            <div class="input">
                <label>Title</label>
                <input type="text" name="title">
            </div>
            <div class="input">
                <label>Date(YYYY/MM/DD)</label>
                <input type="text" name=" date">
            </div>
            <div class="input">
                <label>Time</label>
                <input type="time" name="time">
            </div>
            <div class="input">
                <label>Location</label>
                <input type="text" name="location">
            </div>
            <div class="input">
                <button type="submit" class="btn" name="submit">Add auction</button>
            </div>
    </div>
</div>
</div>';
    include('../app/footer.php');
} else {
    echo "Please login first";
}
