 <?php
    include '../app/header.php';
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
        require_once('../db/DatabaseTable.php');
        require_once('../db/database_connection.php');
        include '../app/sidebar-admin.php';
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
            $stmt = $pdo->query('SELECT * FROM auction');
            foreach ($stmt as $record) {

                echo '<option value=' . $record[' id'] . '>' . $record['id'] . '</option>';
            }
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
