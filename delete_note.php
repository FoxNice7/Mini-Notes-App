<?php
require_once 'db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = (int) $_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;

}

?>