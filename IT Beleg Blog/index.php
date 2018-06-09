<!-- This is the Blog's homepage. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <title>Blog von Tom und Edwin</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newPost.php">New Post</a></li>
                    <li><a href="postList.php">Edit Post</a></li>
                    <li><a href="#">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
    <div class="jumbotron">
        <h1 id="BIG">WELCOME TO OUR BLOG!</h1>
        <p>Take a look around, we're sure you'll find something you'll like!</p>
    </div>
    <div class="row">

            <?php
            $files = glob("./Posts/P_*.json");

            $jsonArray = array();

            foreach ($files as $file) {
                $fileContent = fread(fopen($file, "r"), filesize($file));
                $jsonContent = json_decode($fileContent, true);
                $jsonContent["fileName"] = $file;

                array_push($jsonArray, $jsonContent);
            }

            foreach ($jsonArray as $key => $row) {
                $date[$key] = $row["dateOfCreation"];
            }

            array_multisort($date, SORT_DESC, $jsonArray);

            $size = count($jsonArray);
            if ($size >= 3) {
                $previewSize = 3;
            } else {
                $previewSize = $size;
            }
            echo "<div class='col-sm-8'><h2>Look at our three latest posts!<br><small>They are very good.</small></h2>";

            for ($i = 0; $i < $previewSize; $i++) {
                echo "<div class='longPost'><h2>";
                echo $jsonArray[$i]["title"];
                echo "</h2><br><p>";
                echo $jsonArray[$i]["content"];
                echo "</h2><br><a href='readPost.php?id=$i'>read more</a></div>";
            }

            echo "</div>";

            echo "<div class='com-sm-4'><h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>";

            if ($size >= 10) {
                $linkSize = 10;
            } else {
                $linkSize = $size;
            }

            for ($j = 0; $j < $linkSize; $j++) {
                echo "<a href='readPost.php?id=$j'>";
                echo $jsonArray[$j]["title"];
                echo "</a><br>";
            }

            echo "</div>"

            ?>

        </div>
    </div>
</div>

</body>
</html>