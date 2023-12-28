<?php
include_once('./connection.php');
session_start();

if (isset($_POST['id']) && $_SESSION['admin_id']) {
    $id = $_POST['id'];

    $id = intval($id);

    $sql = "DELETE FROM book WHERE ID = $id";

    if (mysqli_query($con, $sql)) {
        $response = ['success' => true, 'id' => $id];
    } else {
        $response = ['success' => false];
    }
} else {
    $response = ['success' => false];
}

header('Content-Type: application/json');
echo json_encode($response);
