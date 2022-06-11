<?php
include '../app/header.php';
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
    require_once('../db/DatabaseTable.php');
    require_once('../db/database_connection.php');
    include '../app/sidebar-admin.php';

    if (isset($_POST['submit'])) {
        $categoryName = $_GET['categoryName'];
        $id = $_GET['id'];
        if (isset($_POST['artist_name'], $_POST['year'], $_POST['classification'], $_POST['description'], $_FILES['image_upload'], $_POST['price'], $_POST['category_name'])) {
            $auctionID = $_POST['auction_id'];
            $artistName = $_POST['artist_name'];
            $year = $_POST['year'];
            $classification = $_POST['classification'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $categoryName = $_POST['category_name'];


            if ($categoryName == 'painting') {
                try {
                    $paintingTable = new DatabaseTable($pdo, 'painting');
                    $fileDestination = $paintingTable->imageCheck($_FILES['image_upload']);
                    $newPainting = [
                        'id' => $id,
                        'artist_name' => $artistName,
                        'year' => $year,
                        'classification' => $classification,
                        'description' => $description,
                        'price' => $price,
                        'image_dir' => $fileDestination,
                        'medium' => $_POST['medium_used'],
                        'framed' => filter_var($_POST['framed'], FILTER_VALIDATE_BOOLEAN),
                        'height' => $_POST['height'],
                        'length' => $_POST['length']
                    ];
                    $paintingTable->update($newPainting, 'id');
                    echo '<script>
                        window.alert("Art sucessfully edited")
                        window.location = "catalouge.php?id=' . $auctionID . '"
                        </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            // // add into drawing table


            if ($categoryName == 'drawing') {
                try {
                    $drawingTable = new DatabaseTable($pdo, 'drawing');
                    $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                    $newDrawing = [
                        'id' => $id,
                        'auction_id' => $auctionID,
                        'artist_name' => $artistName,
                        'year' => $year,
                        'classification' => $classification,
                        'description' => $description,
                        'price' => $price,
                        'image_dir' => $fileDestination,
                        'medium' => $_POST['medium_used'],
                        'framed' => filter_var($_POST['framed'], FILTER_VALIDATE_BOOLEAN),
                        'height' => $_POST['height'],
                        'length' => $_POST['length']
                    ];
                    $drawingTable->update($newDrawing, 'id');
                    echo '<script>
                        window.alert("Art sucessfully edited")
                        window.location = "catalouge.php?id=' . $auctionID . '"
                        </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            // add into photographic image table
            if ($categoryName == 'photographic_image') {
                try {
                    $drawingTable = new DatabaseTable($pdo, 'photographic_image');
                    $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                    $newPhotographicImage = [
                        'id' => $id,
                        'auction_id' => $auctionID,
                        'artist_name' => $artistName,
                        'year' => $year,
                        'classification' => $classification,
                        'description' => $description,
                        'price' => $price,
                        'image_dir' => $fileDestination,
                        'type' => $_POST['image_type'],
                        'height' => $_POST['height'],
                        'length' => $_POST['length']
                    ];
                    $drawingTable->update($newPhotographicImage, 'id');
                    echo '<script>
                        window.alert("Art sucessfully edited")
                       window.location = "catalouge.php?id=' . $auctionID . '"
                        </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            //add into carving table 

            if ($categoryName == 'carving') {
                try {
                    $drawingTable = new DatabaseTable($pdo, 'carving');
                    $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                    $newCarving = [
                        'id' => $id,
                        'auction_id' => $auctionID,
                        'artist_name' => $artistName,
                        'year' => $year,
                        'classification' => $classification,
                        'description' => $description,
                        'price' => $price,
                        'image_dir' => $fileDestination,
                        'material' => $_POST['medium_used'],
                        'weight' => $_POST['weight'],
                        'height' => $_POST['height'],
                        'length' => $_POST['length']
                    ];
                    $drawingTable->update($newCarving, 'id');
                    echo '<script>
                        window.alert("Art sucessfully edited")
                       window.location = "catalouge.php?id=' . $auctionID . '"
                        </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            //add into sculpture table
            if ($categoryName == 'sculpture') {
                try {
                    $drawingTable = new DatabaseTable($pdo, 'sculpture');
                    $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                    $newSculpture = [
                        'id' => $id,
                        'auction_id' => $auctionID,
                        'artist_name' => $artistName,
                        'year' => $year,
                        'classification' => $classification,
                        'description' => $description,
                        'price' => $price,
                        'image_dir' => $fileDestination,
                        'material' => $_POST['medium_used'],
                        'weight' => $_POST['weight'],
                        'height' => $_POST['height'],
                        'length' => $_POST['length']
                    ];
                    $drawingTable->update($newSculpture, 'id');
                    echo '<script>
                        window.alert("Art sucessfully edited")
                       window.location = "catalouge.php?id=' . $auctionID . '"
                        </script>';
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo 'error';
            echo '<script>
                        window.alert("Please enter all the fields correctly")
                        </script>';
        }
    } else {
        $categoryName = $_GET['categoryName'];
        $id = $_GET['id'];
        foreach ($pdo->query("Select * From $categoryName WHERE $categoryName.id = $id") as $row) {
            echo '<div class="section-bottom">
     <div class="admin-add-catalouge">
         <h1>Edit art</h1>
         <form method="post" id="input-form" action="functions/edit_art_function.php?categoryName=' . $categoryName . '&id=' . $id . '" enctype="multipart/form-data">
             <div class="input">
                 <label>Auction Id:</label>
                 <select class="input-category" name="auction_id">';
            echo '<option value=' . $row['auction_id'] . '>' . $row['auction_id'] . '</option>';
            echo '
            </select>
            </div>
            <div class="input">
                <label>Name of Artist:</label>
                <input type="text" name="artist_name" value="' . $row['artist_name'] . '">
            </div>
            <div class="input">
                <label>Year</label>
                <input type="text" name="year" value="' . $row['year'] . '">
            </div>
            <div class="input">
                <label>Classification</label>
                <input type="text" name="classification"  value="' . $row['classification'] . '">
            </div>
            <div class="input">
                <label>Descripton</label>
                <textarea type="text" name="description">' . $row['description'] . '</textarea>
            </div>
            <div class="input">
                <label>Price</label>
                <input type="text" name="price"  value="' . $row['price'] . '">
            </div>
            <div class="input">
                <label>Add a picture</label>
                <input class="add-picture" type="file" name="image_upload"  value="' . $row['image_dir'] . '">
            </div>

            <div class="input">
                <label>Category:</label>
                <select id="category" onchange="displayOptions(this.value)" class="input-category" name="category_name">
                    <option value="">Select category</option>
                    <option value="' . $categoryName . '">' . $categoryName . '</option>
                </select>
                <div class="category-specific">

                </div>
            </div>
            <div class="input">
                <button type="submit" class="btn" name="submit">Edit Art</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
<script src="script/displayOption.js">
</script>';
        }
    }
} else {
    echo 'Please log in first';
}

include '../app/footer.php';
