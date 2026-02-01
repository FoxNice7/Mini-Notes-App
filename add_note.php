<?php
require_once 'db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = (string) $_POST['title'];
    $content = (string) $_POST['content'];
    $status = (string) $_POST['status'];

    $stmt = $mysqli->prepare("INSERT INTO notes (title, content, status, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss",$title,$content,$status);
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
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title"><br>
        <label for="content">Content</label><br>
        <textarea name="content" id="content" cols="30" rows="10"></textarea><br>
        <select name="status" id="status">
            <option name="draft" value="draft">Draft</option>
            <option name="published" value="published">Published</option>
        </select><br>
        <button type="submit">Add Note</button>
    </form>
</body>
</html>