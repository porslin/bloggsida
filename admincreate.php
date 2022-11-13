<?php
    require('dbconnect.php');

    // echo '$_POST';
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // echo '$_GET';
    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";

    $titleError   = "";
    $authorError  = "";
    $contentError = "";
    $messageSuccess     = "";

    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // CREATE
    if (isset($_POST['addPostBtn'])) {

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
            $sql = "
                INSERT INTO posts (title, author, content) 
                VALUES (:title, :author, :content);
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":title", $_POST['title']);
            $stmt->bindParam(":author", $_POST['author']);
            $stmt->bindParam(":content", $_POST['content']);
            $stmt->execute(); 

            $messageSuccess = '
                        <div id="success_msg">Your post has been created!</div>';

        }
}

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
            <legend><h1>Create new post</h1></legend>

            <?=$titleError ?>
            <?=$authorError ?>
            <?=$contentError ?>
            <?=$messageSuccess ?>
            
            <p>
                <label for="input1">Title:</label> <br>
                <input type="text" class="text" name="title">
            </p>

            <p>
                <label for="input1">Author:</label> <br>
                <input type="text" class="text" name="author">
            </p>

            <p>
                <label for="input2">Content:</label> <br>
                <textarea id="subject" name="content"></textarea>
            </p>

            <p>
                <input type="submit" name="addPostBtn" value="Create Post"> | 
                <a href="adminhome.php">Back</a>
            </p>
        </fieldset>
    </form>
    
</body>
</html>