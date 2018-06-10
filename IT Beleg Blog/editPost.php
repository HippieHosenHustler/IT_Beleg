<!-- page to edit posts -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- markdown -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

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
    echo "<div class='form-group'>";
    echo "<label for='title'>Titel</label>";
    echo "<input type='text' title='title' id='title' name='title' class='form-control' value='".$jsonContent['title']."'>";
    echo "</div><div class='form-group'>";
    echo "<label for='content'>Inhalt</label>";
    echo "<textarea title='content' id='content' name='content'>".$jsonContent['content']."</textarea><br>";
    echo "</div>";
    echo "<input type='hidden' name='dateOfCreation' value='".$jsonContent['dateOfCreation']."'>";
    echo "<input type='hidden' id='fileName' name='fileName' value='$fileName'>";
    echo "<input type='submit' value='Save'>";

    ?>
</div>

<script>
    let markdown = new SimpleMDE({element: document.getElementById("content")});
</script>

</body>
</html>