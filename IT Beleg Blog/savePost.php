<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Post saved.</title>
</head>
<body>
<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="newPost.php">New Blog Post</a>
            <a class="navbar-brand" href="postList.php">Edit or Delete Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
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

    if (empty($_POST["fileName"])) {
        $postId = count(glob("./Posts/P_*.json"));

        while (file_exists("./Posts/P_".$postId.".json")) {
            $postId++;
        }
        $array["postId"] = $postId;

        $jsonFileContent = json_encode($array);

        file_put_contents("./Posts/P_".$postId.".json", $jsonFileContent);
    } else {
        $fileName = $_POST["fileName"];
        $postId = $_POST["postId"];
        $array["postId"] = $postId;

        $jsonFileContent = json_encode($array);

        file_put_contents($fileName, $jsonFileContent);
    }

    echo "Post saved!"
    ?>
</div>
</body>
