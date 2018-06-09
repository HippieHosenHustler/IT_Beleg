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

    <!-- markdown -->

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
                    <li><a href="uploadPicture.php">Upload Picture</a></li>
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

            if (empty($_GET["pgNr"])) {
                $pgNr = 0;
            } else {
                $pgNr = $_GET["pgNr"];
            }

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


            echo "<div class='col-sm-8'><h2>Look at our three latest posts!<br><small>They are very good.</small></h2>";

            for ($i = $pgNr * 3; $i < ( $pgNr*3 ) + 3; $i++) {
                if (!empty($jsonArray[$i])){
                    echo "<div class='longPost'><h2>";
                    echo $jsonArray[$i]["title"];
                    echo "<br><small>".$jsonArray[$i]['dateOfCreation']."</small>";
                    echo "</h2><br><p id='content".$i."'>";

                    $substring = substr($jsonArray[$i]["content"], 0, 500);

                    require_once 'Michelf/Markdown.inc.php';

                    $parser = new \Michelf\Markdown();
                    $parser ->fn_id_prefix = "post22-";
                    $myHtml = $parser->transform($substring);
                    echo $myHtml;
                    echo "</p><br><a href='readPost.php?fileName=".$jsonArray[$i]['fileName']."'>read more</a></div>";
                }
            }

            $size = count($jsonArray);

            if ($pgNr != 0) {
                $newer = $pgNr -1;
                echo "<form action='index.php' method='get'><input type='hidden' name='pgNr' value='$newer'><input type='submit' value='Newer Posts'></form>";
            }

            $maxPgNr = ceil($size / 3) - 1;
            if ($pgNr < $maxPgNr) {
                $older = $pgNr + 1;
                echo "<form action='index.php' method='get'><input type='hidden' name='pgNr' value='$older'><input type='submit' value='Older Posts'></form>";
            }

            echo "</div>";

            echo "<div class='com-sm-4'><h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>";

            if ($size >= 10) {
                $linkSize = 10;
            } else {
                $linkSize = $size;
            }

            for ($j = 0; $j < $linkSize; $j++) {
                echo "<a href='readPost.php?fileName=".$jsonArray[$j]['fileName']."'>";
                echo $jsonArray[$j]["title"];
                echo "</a><br>";
                echo $jsonArray[$j]["dateOfCreation"];
                echo "<br><br>";
            }

            echo "</div>";

            ?>

    </div>
</div>

</body>
</html>