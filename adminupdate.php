<?php
require('dbconnect.php');

$titleError   = "";
$authorError  = "";
$contentError = "";
$messageSuccess     = "";

//$title = trim($_POST["title"]);
//$author = trim($_POST["author"]);
//$content = trim($_POST["content"]);

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$content = trim($_POST['content'] ?? '');

// UPDATE
if (isset($_POST['updatePostBtn'])) {

        if (empty($title)) {
            $titleError = '
                <div id="error_msg">Title is required.</div>';
        }
        if (empty($author)) {
            $authorError = '
                <div id="error_msg">Author is required.</div>';
            }
        if (empty($content)) {
            $contentError = '
                <div id="error_msg">Content is required.</div>';
        } 
        
        if ($titleError =="" && $authorError =="" && $contentError == "") {
            $sql = " UPDATE posts
                SET title = :title, author = :author, content = :content
                WHERE id = :id
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['postId']);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':content', $content);
            $stmt->execute();

            $messageSuccess = '
                <div id="success_msg">Your blog is now updated!</div>';
        }
}


// FETCH
$sql = "
    SELECT * FROM posts
    WHERE id = :id
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['postId']);
$stmt->execute();
$post = $stmt->fetch();
    //echo 'Post';
    echo "<pre>";
    //print_r($post);
    echo "</pre>";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog Admin</title>
</head>
<body>

    <nav>
        <a href="adminhome.php">Admin</a> |
        <a href="home.php">Back to Main Blog</a> 
    </nav>

    <form method="POST" action="#">
        <fieldset>
            <legend><h1>Update post</h1></legend>
            
                <?=$titleError ?>
                <?=$authorError ?>
                <?=$contentError ?>
                <?=$messageSuccess ?>

                <p>
                    <label for="input1">Title:</label> <br>
                    <input type="text" class="text" name="title" value="<?=htmlentities($post['title'])?>">
                </p>

                <p>
                    <label for="input1">Author:</label> <br>
                    <input type="text" class="text" name="author" value="<?=htmlentities($post['author'])?>">
                </p>

                <p>
                    <label for="input2">Content:</label> <br>
                    <textarea id="subject" name="content"><?=htmlentities($post['content'])?></textarea>
                </p>

                <p>
                    <input type="submit" name="updatePostBtn" value="Update"> | 
                    <a href="adminhome.php">Back</a>
                </p>
            
        </fieldset>
    </form>

    
</body>
</html>