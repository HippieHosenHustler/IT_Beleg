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
            <a class="navbar-brand" href="#">Edit Blog Post</a>
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

<div class="container">
    <div class="jumbotron">
        <h1 id="BIG">Posts to edit</h1>
    </div>
    <div id="postList">
        <?php
        $files = glob("./Posts/P_*.json");

        $jsonArray = array();

        foreach ($files as $file) {
            $fileContent = fread(fopen($file, "r"), filesize($file));
            $jsonContent = json_decode($fileContent, true);

            array_push($jsonArray, $jsonContent);
        }

        $size = count($jsonArray);

        for ($i = 0; $i < $size; $i++) {
            echo "<div class='row'>";

            echo "<div class='col-sm-4'>";
            echo $jsonArray[$i]['title']."<br><br>";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo $jsonArray[$i]["dateOfCreation"];
            echo "</div>";

            echo "<div class='col-sm-2'>";
            echo "<form action='editPost.php' method='get'>";
            //TODO go by actual post id
            echo "<input type='hidden' name='id' value='".$i."'>";
            echo "<input type='submit' class='btn-primary' value='Edit'>";
            echo "</form><br>";
            echo "</div>";

            //TODO actually delete, confirm first
            //TODO go by actual post id
            echo "<div class='col-sm-2'>";
            echo "<form method='get'>";
            echo "<input type='hidden' name='id' value='".$i."'>";
            echo "<input type='submit' class='btn-warning' value='Delete'>";
            echo "</form><br>";
            echo "</div>";

            echo "</div>";


        }

        ?>


    </div>
</div>



</body>