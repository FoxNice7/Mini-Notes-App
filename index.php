<?php
include 'db.php';

$query = "SELECT * FROM notes";
if($result = $mysqli->prepare($query)){
    $result->execute();
    $result->bind_result($id,$title,$content,$status,$created_at);

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
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        <?php 
        while($result->fetch()){
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $title . "</td>";
            echo "<td>" . $content . "</td>";
            echo "<td>" . $status . "</td>";
            echo "<td>" . $created_at . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
$mysqli->close(); 
?>