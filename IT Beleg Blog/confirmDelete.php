<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Delete Post?</title>
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
                    <li><a href="#">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="jumbotron">
        <h1>Are you sure you want to delete?</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="deletePost.php">
                <?php
                $fileName = $_POST["fileName"];

                echo "<input type='hidden' name='fileName' value='$fileName'>";
                ?>
                <input type="submit" class="btn-warning" value="Yes, delete">
            </form>
        </div>
        <div class="col-sm-6">
            <form action="postList.php">
                <input type="submit" class="btn-success" value="No, better not">
            </form>
        </div>
    </div>

</div>
</body>
