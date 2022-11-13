<?php
require('dbconnect.php');

// GET 
echo "<pre>";
//print_r($_GET);
echo "</pre>";

// READ
$sql = "
  SELECT * FROM posts
  WHERE id = :id
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['postId']);
$stmt->execute();
$post = $stmt->fetch();
  // echo 'Post';
  echo "<pre>";
  // print_r($post);
  echo "</pre>";


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

    <nav>
        <a href="adminhome.php">Admin</a> |
        <a href="home.php">Back to Main Blog</a> 
    </nav>

    <fieldset>
        <legend><h1><?=htmlentities($post['title'])?></h1></legend>

            <p>
                <i>by <?=htmlentities($post['author'])?></i><br>
                - <?=htmlentities($post['published_date'])?>
                <p><?=htmlentities($post['content'], 50)?></p>
            </p>
    </fieldset>
        

</body>
</html>