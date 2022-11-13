<?php
require('dbconnect.php');

//DELETE
if (isset($_POST['postId'])) {
    $sql = "
        DELETE FROM posts 
        WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $_POST['postId']); //binding to placeholder to prevent possible sql injections
    $stmt->execute(); 
} 

//READ
$stmt =$pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll();
// echo "<pre>";
// print_r($posts);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>

<h1>Admin page</h1>

<nav>
  <a href="admincreate.php">Create new post</a> |
  <a href="home.php">Back to Main Blog</a> 
</nav> 

<table id="posts-tbl">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date Published</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($posts as $post) { ?>
                <tr>
                    <td><?=htmlentities($post['id']) ?></td>
                    <td><?=htmlentities($post['title']) ?></td>
                    <td><?=htmlentities($post['author']) ?></td>
                    <td><?=htmlentities($post['published_date']) ?></td>
                    <td>
                        <form action="adminupdate.php" method="GET">
                            <input type="hidden" name="postId" value="<?=htmlentities($post['id']) ?>">
                            <input type="submit" value="Update">
                        </form>
                    
                        <form action="" method="POST">
                            <input type="hidden" name="postId" value="<?=htmlentities($post['id']) ?>">
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            <?php }?>
        </tbody>

</table>
    
</body>
</html>