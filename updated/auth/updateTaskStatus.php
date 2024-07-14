<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Method not allowed');
    }
    require_once('auth.php');
    $db = Database::getInstance();
    $_POST = json_decode(file_get_contents('php://input'), true);
    $db->updateTaskStatus($_POST['task_id'], $_POST['status']);
    echo json_encode(array('status' => 'success'));
?>
