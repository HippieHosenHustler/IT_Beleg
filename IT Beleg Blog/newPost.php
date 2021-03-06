<!-- page to create new posts -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Markdown editor -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <title>Create New Post</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">New Blog Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="postList.php">Edit or Delete Post</a></li>
                    <li><a href="uploadPicture.php">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<!-- input form to write new posts -->
<div class="container">

    <!-- A form that contains fields for the Title and Content of a post -->
    <form action="savePost.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" title="title" id="title" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" title="content" name="content"></textarea>
        </div>

        <?php
        // A hidden input passing the date of Creation
        $timestamp = time();
        $date = date("Y-m-d H:i:s", $timestamp);
        echo "<input type='hidden' name='dateOfCreation' value='".$date."'>";

        // changes the textArea for the content to a markdown editor
        echo "<script>let simpleMDE = new SimpleMDE({element: document.getElementById('content')})</script>";
        ?>

        <!-- separator -->
        <div class="col-xs-12" style="height:20px;"></div>
        <input type="submit" class="btn-primary" value="Save">
    </form>


</div>
</body>
</html>