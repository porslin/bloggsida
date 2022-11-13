<?php
require('dbconnect.php');

//READ
$stmt =$pdo->query("SELECT * FROM posts;");
$posts = $stmt->fetchAll();
echo "<pre>";
// print_r($posts);
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

    <h1>Home page</h1>

    <nav>
        <a href="adminhome.php">Admin</a>
    </nav>

        <ul id="list-group">
            <?php foreach($posts as $post) { ?>
              <li id="list-group-item">

                <p>
                  <h2><?=htmlentities($post['title']) ?></h2> 
                  <i>by <?=htmlentities($post['author']) ?></i><br>
                  - <?=htmlentities($post['published_date']) ?>
                  <p><?php echo mb_strimwidth($post['content'], 0, 100,) ?>...</p>
                </p>

                <form action="post.php" method="GET">
                    <input type="hidden" name="postId" value="<?=htmlentities($post['id']) ?>">
                    <input type="submit" value="Read more">
                </form>
                
              </li>
            <?php } ?>
        </ul>

</body>
</html>