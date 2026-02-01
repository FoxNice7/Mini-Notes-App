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
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $stmt = $mysqli->prepare("SELECT title, content FROM notes WHERE id = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($title,$content);
    if($stmt->fetch()){
        $_POST['title'] = $title;
        $_POST['content'] = $content;
    }
    $stmt->close();
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
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
        <br>
        <label for="content">Content</label><br>
        <textarea name="content" id="content" cols="30" rows="10"><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
        <br>
        <button type="submit">UPDATE</button>
    </form>
</body>
</html>