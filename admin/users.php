<?php
include '../app/header.php';
require_once('../db/database_connection.php');
include('../app/search_bar.php');
include('../app/sidebar-admin.php');


echo '<div class="section-bottom">';
echo '<div class="catalouge-items">';

foreach ($pdo->query("Select * From users") as $row) {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] === 'admin') {
        if ($row) {
            if ($row['verified']) {
                $verified = 'yes';
            } else {
                $verified = 'no';
            }
            echo '
            <div class="art-card">
            <h3>Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>
            <h4>Email: <br>' . $row['email'] . '  </h4>
            <h4>Address: <br>' . $row['address'] . '  </h4>
            <h4>Contact: <br>' . $row['contact'] . '  </h4>

            <h4>User Type: ' . $row['user_type'] . '  </h4>
            
            <h4>Verified: ' . $verified . '  </h4>
            
            ';
            // edit verify delete buttons
            if ($row['user_type'] !== 'admin') {
                echo '<div class="edit-delete-archive-art">';
                echo '<button class="delete-btn" type="submit"><a href="functions/delete_function.php?specificField=users&id=' . $row['id'] . '"><i class="fa fa-trash"></i></a></button>';
                if ($row['verified']) {
                    echo '<button class="archive-btn" type="submit"><a href="functions/verify_user_function.php?&id=' . $row['id'] . '"><i class="fa fa-lock"></i></a></button>';
                    echo '</div>';
                } else {
                    echo '<button class="archive-btn" type="submit"><a href="functions/verify_user_function.php?&id=' . $row['id'] . '"><i class="fa fa-check"></i></a></button>';
                    echo '</div>';
                }
            } else {
                echo '</div>';
            }
        }
    }
};
echo '</div>
</div>
</div>
</div>

';
include('../app/footer.php');
