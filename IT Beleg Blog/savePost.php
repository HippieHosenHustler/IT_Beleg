<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <title>Post saved.</title>
</head>
<body>
<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="newPost.php">New Blog Post</a>
            <a class="navbar-brand" href="postList.php">Edit Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="postList.php">Edit Post</a></li>
                    <li><a href="uploadPicture.php">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <?php
    $title = $_POST["title"];
    $content = $_POST["content"];
    $dateOfCreation = $_POST["dateOfCreation"];


    $array = array(
        "dateOfCreation" => $dateOfCreation,
        "title" => $title,
        "content" => $content
    );
    $jsonFileContent = json_encode($array);

    if (empty($_POST["fileName"])) {
        $postId = count(glob("./Posts/P_*.json"));

        file_put_contents("./Posts/P_".$postId.".json", $jsonFileContent);
    } else {
        $fileName = $_POST["fileName"];
        file_put_contents($fileName, $jsonFileContent);
    }

    echo "Post saved!"
    ?>
</div>
</body>
