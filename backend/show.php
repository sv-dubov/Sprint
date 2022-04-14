<?php

include 'database.php';

$sql = "SELECT * FROM users";
//execute query
$result = mysqli_query($conn, $sql);

$rows = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo 'No users yet';
}
