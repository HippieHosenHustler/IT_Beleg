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
            <a class="navbar-brand" href="postList.php">Edit or Delete Blog Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
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
    $fileName = $_POST["fileName"];
    $file = fopen($fileName, "r");
    $fileContent = fread($file, filesize($fileName));
    $jsonContent = json_decode($fileContent, true);

    /**
     * Generates a form containing input fields for the post Title and content.
     * Passes on the information to savePost.php
     */
    echo "<form action='savePost.php' method='post'>";
    echo "<div class='form-group'>";
    echo "<label for='title'>Titel</label>";
    // input for the title, already contains the previous title
    echo "<input type='text' title='title' id='title' name='title' class='form-control' value='".$jsonContent['title']."'>";
    echo "</div><div class='form-group'>";
    echo "<label for='content'>Inhalt</label>";
    // input for the content, already contains the previous input
    echo "<textarea title='content' id='content' name='content'>".$jsonContent['content']."</textarea><br>";
    echo "</div>";
    // passes on the original date of creation, as this should not change
    echo "<input type='hidden' name='dateOfCreation' value='".$jsonContent['dateOfCreation']."'>";
    // passes on the original file name, as this should not change
    echo "<input type='hidden' id='fileName' name='fileName' value='$fileName'>";
    // passes on the original post id, as this should not change
    echo "<input type='hidden' id='postId' name='postId' value='".$jsonContent['postId']."'>";
    echo "<input type='submit' value='Save'>";
    echo "</form>"

    ?>
</div>

<script>
    /**
     * Replaces the Content textbox with a markdown editor.
     * @type {SimpleMDE}
     */
    let markdown = new SimpleMDE({element: document.getElementById("content")});
</script>

</body>
</html>