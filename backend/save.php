<?php

include 'database.php';

if (count($_POST) > 0) {
    $type = $_POST['type'];
    if ($type == 'add_user') {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $role = $_POST['role'];
        $status = $_POST['status'];
        if (!empty($first_name) && !empty($last_name)) {
            $sql = "INSERT INTO `users`(`first_name`, `last_name`,`role`,`status`) VALUES ('$first_name','$last_name','$role','$status')";
            if (mysqli_query($conn, $sql)) {
                $id = mysqli_insert_id($conn);
                echo json_encode(array("statusCode" => 200, "id" => $id, "first_name" => $first_name, "last_name" => $last_name, "role" => $role, "status" => $status, "type" => $type));
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: required field";
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    $type = $_POST['type'];
    if ($type == 'edit_user') {
        $id = $_POST['id'];
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $role = $_POST['role'];
        $status = $_POST['status'];
        if (!empty($first_name) && !empty($last_name)) {
            $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`role`='$role',`status`='$status' WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode" => 200, "id" => $id, "first_name" => $first_name, "last_name" => $last_name, "role" => $role, "status" => $status, "type" => $type));
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: required field";
        }
        mysqli_close($conn);
    }
}

if (count($_POST) > 0) {
    $type = $_POST['type'];
    $error = null;
    if ($type == 'single_delete') {
        $id = $_POST['id'];
        if (!empty($id)) {
            $sql = "DELETE FROM `users` WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode" => 200, "id" => $id, "type" => $type, "error" => $error));
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo json_encode(array("statusCode" => 201, "id" => $id, "type" => $type, "error" => "User not found"));
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
        $status = 1;
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
        $status = 0;
        $sql = "UPDATE `users` SET `status`='$status' WHERE id in ($id)";
        if (mysqli_query($conn, $sql)) {
            echo $id;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
