<?php

if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_start();
    session_destroy();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
