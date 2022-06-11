<?php
include 'app/header.php';
require_once('db/database_connection.php');
require_once('db/DatabaseTable.php');
include('app/search_bar.php');

$auctionID = $_GET['id'];
echo '<div class="section-bottom">';

foreach ($pdo->query("Select * From auction WHERE auction.id = $auctionID") as $record) {
}

echo '<div class="catalouge-items">';

$category_table = array('painting', 'drawing', 'sculpture', 'photographic_image', 'carving');
//loop throught category array
foreach ($category_table as $category) {
    //query each of the catergoy table

    foreach ($pdo->query("Select * From $category WHERE $category.auction_id = $auctionID") as $row) {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
            if ($row) {
                echo '
            <div class="art-card">
            <img src= "' . $row['image_dir'] . '" class="art-image" />
            <h3>Artist: ' . $row['artist_name'] . '</h3>
            <h4>Year: ' . $row['year'] . '  </h4>
            <h4>Price: ' . $row['price'] . '  </h4>
            <h4>Category: ' . $category . '  </h4>
            <p>Classification: ' . $row['classification'] . '  </p>
            <a href="art_view.php?categoryName=' . $category . '&id=' . $row['id'] . '" class="link-text">View More about the Art <i class="fa fa-arrow-circle-right"></i></a>';

                //edit archive delete buttons
                echo '<div class="edit-delete-archive-art">
               <button class="edit-btn" type="submit"><a href="functions/edit_art_function.php?categoryName=' . $category . '&id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>
                </button>
                <button class="archive-btn" type="submit"><a href="functions/archive_function.php?specificField=' . $category . '&id=' . $row['id'] . '"><i class="fa fa-archive"></i></a></button>
                <button class="delete-btn" type="submit"><a href="functions/delete_function.php?specificField=' . $category . '&id=' . $row['id'] . '"><i class="fa fa-trash"></i></a></button>
                </div>
                </div>';
            }
        } //if user is not admin check if archived 
        else {
            if ($row && !$row['archive']) {
                echo '
        <div class="art-card">
            <img src= "' . $row['image_dir'] . '" class="art-image" />
            <h3>Artist: ' . $row['artist_name'] . '</h3>
            <h4>Year: ' . $row['year'] . '  </h4>
            <h4>Price: ' . $row['price'] . '  </h4>
            <h4>Art Category: ' . $category . '  </h4>
            <p>Classification: ' . $row['classification'] . '  </p>
            <a href="art_view.php?categoryName=' . $category . '&id=' . $row['id'] . '" class="link-text">View More about the Art <i class="fa fa-arrow-circle-right"></i></a>';
            }
            echo '</div>';
        }
    }
};


?>

</div>
</div>
<?php
include('app/footer.php');
