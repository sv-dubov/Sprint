<?php

include 'database.php';

if (count($_POST) > 0) {
    if ($_POST['type'] == 'add_user') {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "INSERT INTO `users`(`first_name`, `last_name`,`role`,`status`) 
		VALUES ('$first_name','$last_name','$role','$status')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    if ($_POST['type'] == 'edit_user') {
        $id = $_POST['id'];
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`role`='$role',`status`='$status' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    if ($_POST['type'] === 'single_delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM `users` WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    if ($_POST['type'] === 'multiple_delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM `users` WHERE id in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    if ($_POST['type'] === 'multiple_set_active') {
        $id = $_POST['id'];
        $status = true;
        $sql = "UPDATE `users` SET `status`='$status' WHERE id in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    if ($_POST['type'] === 'multiple_set_inactive') {
        $id = $_POST['id'];
        $status = false;
        $sql = "UPDATE `users` SET `status`='$status' WHERE id in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
