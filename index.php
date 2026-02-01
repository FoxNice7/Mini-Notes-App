<?php
include 'db.php';

$query = "SELECT * FROM notes";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if ($result = $mysqli->prepare($query)): ?>
            <?php
            $result->execute();
            $result->bind_result($id, $title, $content, $status, $created_at);
            ?>
            <?php while ($result->fetch()): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($id) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($title) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($content) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($status) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($created_at) ?>
                    </td>
                    <td><a href="edit.php?id=<?= $id ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?= $id ?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>
    <h1>SEARCH</h1>
    <form method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <input type="submit" name="search_title" value="Search Title">
    </form>
    <form method="post">
        <label for="content">Content</label>
        <input type="text" name="content" id="content">
        <input type="submit" name="search_content" value="Search Content">
    </form>
    <div class="box">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['title'])) {
                $title = (string) $_POST['title'];
                $stmt = $mysqli->prepare("SELECT * FROM notes WHERE title = ?");
                $stmt->bind_param("s", $title);
                $stmt->execute();
                $stmt->bind_result($id, $title, $content2, $status, $created_at);
                if ($stmt->fetch()) {
                    echo "ID: " . $id . " TITLE: " . $title . " CONTENT: " . $content . " STATUS: " . $status . " CREATED AT: " . $created_at;
                } else {
                    echo "No notes found with the given title.";
                }
                $stmt->close();
            }
            if (isset($_POST['content'])) {
                $content = (string) $_POST['content'];
                $stmt = $mysqli->prepare("SELECT * FROM notes WHERE content LIKE ?");
                $content = "%$content%";
                $stmt->bind_param("s", $content);
                $stmt->execute();
                $stmt->bind_result($id, $title, $content2, $status, $created_at);
                if ($stmt->fetch()) {
                    echo "ID: " . $id . " TITLE: " . $title . " CONTENT: " . $content . " STATUS: " . $status . " CREATED AT: " . $created_at;
                } else {
                    echo "No notes found with the given content.";
                }
                $stmt->close();
            }
        }
        ?>


    </div>
</body>

</html>
<?php
$mysqli->close();
?>