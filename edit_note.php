<?php
require_once 'db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = (string) $_POST['title'];
    $content = (string) $_POST['content'];
    $id = (int) $_GET['id'];
    $stmt = $mysqli->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi",$title,$content,$id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="content">Content</label>
        <input type="text" name="content" id="content">
        <br>
        <button type="submit">UPDATE</button>
    </form>
</body>
</html>