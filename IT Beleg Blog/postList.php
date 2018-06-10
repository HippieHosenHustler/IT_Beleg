<!-- This page contains a list of all the posts and the options to edit or delete them -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Edit Post</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Edit or Delete Blog Post</a>
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
        // reads all the post files into an array
        $files = glob("./Posts/P_*.json");

        $jsonArray = array();


        // parses the json, adds file name, attaches everything to an array containing all the posts
        foreach ($files as $file) {
            $fileContent = fread(fopen($file, "r"), filesize($file));
            $jsonContent = json_decode($fileContent, true);
            $jsonContent["fileName"] = $file;

            array_push($jsonArray, $jsonContent);
        }

        $size = count($jsonArray);

        // displays a list of every post, containg title, date, and options to edit and delete
        foreach ($jsonArray as $item) {
            echo "<div class='row'>";

            echo "<div class='col-sm-4'>";
            echo $item['title']."<br><br>";
            echo "</div>";

            echo "<div class='col-sm-4'>";
            echo $item["dateOfCreation"];
            echo "</div>";

            echo "<div class='col-sm-2'>";

            // Generates a button to edit the post
            echo "<form action='editPost.php' method='post'>";
            echo "<input type='hidden' name='fileName' value='".$item['fileName']."'>";
            echo "<input type='submit' class='btn-primary' value='Edit'>";
            echo "</form><br>";
            echo "</div>";

            // Generates a button to delete the post
            echo "<div class='col-sm-2'>";
            echo "<form method='post' action='confirmDelete.php'>";
            echo "<input type='hidden' name='fileName' value='".$item['fileName']."'>";
            echo "<input type='submit' class='btn-warning' value='Delete'>";
            echo "</form><br>";
            echo "</div>";

            echo "</div>";
        }

        ?>


    </div>
</div>



</body>