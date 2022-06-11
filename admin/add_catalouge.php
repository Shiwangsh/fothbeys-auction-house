<?php
include '../app/header.php';
require_once('../db/database_connection.php');

if ($_SESSION['user'] && $_SESSION['user']['user_type'] === 'admin') {
    include '../app/sidebar-admin.php';
    echo '
    <div class="section-bottom">
    <div class="admin-add-catalouge">
        <h1>Add new item for auction</h1>
        <form method="post" id="input-form" action="functions/add_catalouge_function.php" enctype="multipart/form-data">
            <div class="input">
                <label>Auction Id:</label>
                <select class="input-category" name="auction_id">';

    $stmt = $pdo->query('SELECT * FROM auction');
    foreach ($stmt as $record) {

        echo '<option value=' . $record['id'] . '>' . $record['id'] . '</option>';
    }

    echo '</select>
            </div>
            <div class="input">
                <label>Name of Artist:</label>
                <input type="text" name=" artist_name">
            </div>
            <div class="input">
                <label>Year</label>
                <input type="text" name="year">
            </div>
            <div class="input">
                <label>Classification</label>
                <input type="text" name="classification">
            </div>
            <div class="input">
                <label>Descripton</label>
                <textarea type="text" name="description"></textarea>
            </div>
            <div class="input">
                <label>Price</label>
                <input type="text" name="price">
            </div>
            <div class="input">
                <label>Add a picture</label>
                <input class="add-picture" type="file" name="image_upload">
            </div>

            <div class="input">
                <label>Category:</label>
                <select id="category" onchange="displayOptions(this.value)" class="input-category" name="category_name">
                    <option value="">Select category</option>
                    <option value="painting">Painting</option>
                    <option value="drawing">Drawing</option>
                    <option value="photographic_image">Photographic Image</option>
                    <option value="sculpture">Sculpture</option>
                    <option value="carving">Carving</option>
                </select>
                <div class="category-specific">

                </div>
            </div>
            <div class="input">
                <button type="submit" class="btn" name="submit">Add auction</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
<script src="script/displayOption.js">
</script>';

    include '../app/footer.php';
}
