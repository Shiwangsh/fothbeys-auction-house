<?php
require_once('../db/database_connection.php');
require_once('../db/DatabaseTable.php');
session_start();


if (isset($_SESSION['user']) && isset($_POST['submit'])) {
    if (isset($_POST['auction_id'], $_POST['artist_name'], $_POST['year'], $_POST['classification'], $_POST['description'], $_FILES['image_upload'], $_POST['price'], $_POST['category_name'])) {
        $auctionID = $_POST['auction_id'];
        $artistName = $_POST['artist_name'];
        $year = $_POST['year'];
        $classification = $_POST['classification'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_name = $_POST['category_name'];
        if ($category_name == 'painting') {
            try {
                $paintingTable = new DatabaseTable($pdo, 'painting');
                $fileDestination = $paintingTable->imageCheck($_FILES['image_upload']);
                $newPainting = [
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
                $paintingTable->insert($newPainting);
                echo 'allgood';
                header('location:../admin/add_catalouge.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // // add into drawing table


        if ($category_name == 'drawing') {
            try {
                $drawingTable = new DatabaseTable($pdo, 'drawing');
                $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                $newDrawing = [
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
                $drawingTable->insert($newDrawing);
                header('location:../admin/add_catalouge.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // add into photographic image table
        if ($category_name == 'photographic_image') {
            try {
                $drawingTable = new DatabaseTable($pdo, 'photographic_image');
                $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                $newPhotographicImage = [
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
                $drawingTable->insert($newPhotographicImage);
                header('location:../admin/add_catalouge.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        //add into carving table 

        if ($category_name == 'carving') {
            try {
                $drawingTable = new DatabaseTable($pdo, 'carving');
                $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                $newCarving = [
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
                $drawingTable->insert($newCarving);
                header('location:../admin/add_catalouge.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        //add into sculpture table
        if ($category_name == 'sculpture') {
            try {
                $drawingTable = new DatabaseTable($pdo, 'sculpture');
                $fileDestination = $drawingTable->imageCheck($_FILES['image_upload']);
                $newSculpture = [
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
                $drawingTable->insert($newSculpture);
                header('location:../admin/add_catalouge.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
} else {
    echo '<script>window.alert("invalid input please try again")
                window.location = "../admin/auctions.php"
        </script>';
}
