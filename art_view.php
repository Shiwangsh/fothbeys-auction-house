<?php
include 'app/header.php';
require_once('db/database_connection.php');
include('app/search_bar.php');
echo '<div class="section-bottom">';

$categoryName = $_GET['categoryName'];
$id = $_GET['id'];

//query specific item from category table
foreach ($pdo->query("Select * From $categoryName WHERE $categoryName.id= $id") as $row) {
    if ($categoryName == 'painting' || $categoryName == 'drawing') {

        if ($row['framed']) {
            $framed = 'Yes';
        } else {
            $framed = 'No';
        }
        echo '<div class="art-view-main">
               <img src="' . $row['image_dir'] . '" alt="">
               <div class="art-info-main">
               <h3>Artist: ' . $row['artist_name'] . '</h3>
               <h4>Year: ' . $row['year'] . ' </h4>
               <h4>Price: ' . $row['price'] . ' </h4>
               <p>Classification: ' . $row['classification'] . ' </p>
               <p>Description: ' . $row['description'] . ' </p>
               <p>Medium: ' . $row['medium'] . ' </p>
               <p>Framed: ' . $framed . ' </p>
               <p>Dimensions (cm): ' . $row['height'] . ' x ' . $row['length'] . '  </p>';
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'buyer') {
            echo '
               <button class="bid-btn">Bid</button>';
        }
        echo ' </div>';
    } elseif ($categoryName == 'carving' || $categoryName == 'sculpture') {
        echo '<div class="art-view-main">
               <img src="' . $row['image_dir'] . '" alt="">
               <div class="art-info-main">
               <h3>Artist: ' . $row['artist_name'] . '</h3>
               <h4>Year: ' . $row['year'] . ' </h4>
               <h4>Price: ' . $row['price'] . ' </h4>
               <p>Classification: ' . $row['classification'] . ' </p>
               <p>Description: ' . $row['description'] . ' </p>
               <p>Material used: ' . $row['material'] . ' </p>
               <p>Weight (kg): ' . $row['weight'] . ' </p>
               <p>Dimensions (cm): ' . $row['height'] . ' x ' . $row['length'] . '  </p>
    
       </div>';
    } elseif ($categoryName == 'photographic_image') {
        echo '<div class="art-view-main">
               <img src="' . $row['image_dir'] . '" alt="">
               <div class="art-info-main">
               <h3>Artist: ' . $row['artist_name'] . '</h3>
               <h4>Year: ' . $row['year'] . ' </h4>
               <h4>Price: ' . $row['price'] . ' </h4>
               <p>Classification: ' . $row['classification'] . ' </p>
               <p>Description: ' . $row['description'] . ' </p>
               <p>Image Type: ' . $row['type'] . ' </p>
               <p>Dimensions (cm): ' . $row['height'] . ' x ' . $row['length'] . '  </p>
    
       </div>';
    }
}
?>


<?php
echo '</div>';
echo '</div>';

include 'app/footer.php';
