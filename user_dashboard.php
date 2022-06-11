<?php
include 'app/header.php';
require_once('db/DatabaseTable.php');
require_once('db/database_connection.php');

// User session check
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user']['username'];
    echo '<div class="auction-main">';
    foreach ($pdo->query("Select * From users where email = '$email' ") as $row) {
        if ($_SESSION['user']['user_type'] === 'admin') {
            include 'app/sidebar-admin.php';
        }
        echo '
        <div class="art-card">
             <h3>Name: ' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>
             <h4>Email: <br>' . $row['email'] . '  </h4>
             <h4>Address: <br>' . $row['address'] . '  </h4>
             <h4>Contact: <br>' . $row['contact'] . '  </h4>

             <h4>User Type: ' . $row['user_type'] . '  </h4>
             </div>
             </div>

';
    }
} else {
    echo 'please login first';
}
include 'app/footer.php';
