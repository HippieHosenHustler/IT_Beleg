<!-- page to edit posts -->

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

    <title>Edit Post</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="postList.php">Edit Blog Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newPost.php">New Post</a></li>
                    <li><a href="uploadPicture.php">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron">
    <h1 id="BIG">Edit Post</h1>
</div>

<div class="container">
    <?php
    $id = $_GET["id"];
    $fileName = "./Posts/P_".$id.".json";
    $file = fopen($fileName, "r");
    $fileContent = fread($file, filesize($fileName));
    $jsonContent = json_decode($fileContent, true);

    echo "<form action='savePost.php' method='post'>";
    echo "Titel: <textarea title='title' id='title' name='title'>".$jsonContent["title"]."</textarea><br>";
    echo "Inhalt: <textarea title='content' id='content' name='content'>".$jsonContent['content']."</textarea><br>";
    echo "<input type='hidden' name='dateOfCreation' value='".$jsonContent['dateOfCreation']."'>";
    echo "<input type='hidden' id='fileName' name='fileName' value='$fileName'>";
    echo "<input type='submit' value='Save'>";

    ?>
</div>

</body>
</html>