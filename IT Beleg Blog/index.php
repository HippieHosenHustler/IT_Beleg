<!-- This is the Blog's homepage. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
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

            <?php

            echo "<div class='row'>";

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

            if (count($jsonArray) != 0) {
                array_multisort($date, SORT_DESC, $jsonArray);
            }


            echo "<div class='col-sm-8'>";

            for ($i = $pgNr * 3; $i < ( $pgNr*3 ) + 3; $i++) {
                if (!empty($jsonArray[$i])){
                    echo "<div class='panel panel-primary'><div class='panel-heading'><h2>";
                    echo $jsonArray[$i]["title"];
                    echo "</h2><br>".$jsonArray[$i]['dateOfCreation'];
                    echo "</div><div class='panel-body'><p id='content".$i."'>";

                    $substring = substr($jsonArray[$i]["content"], 0, 500);

                    require_once 'Michelf/Markdown.inc.php';

                    $parser = new \Michelf\Markdown();
                    $parser ->fn_id_prefix = "post22-";
                    $myHtml = $parser->transform($substring);
                    echo $myHtml;
                    echo "</p><br><a href='readPost.php?fileName=".$jsonArray[$i]['fileName']."'>read more</a></div></div>";
                }
            }

            $size = count($jsonArray);





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

            echo "</div></div>";

            echo "<div class='row'><div class='col-sm-4'>";
            if ($pgNr != 0) {
                $newer = $pgNr -1;
                echo "<form action='index.php' method='get'><input type='hidden' name='pgNr' value='$newer'>
                        <input type='submit' class='btn-primary' value='Newer Posts'></form>";
            }
            echo "</div><div class='col-sm-4'>";
            $maxPgNr = ceil($size / 3) - 1;
            if ($pgNr < $maxPgNr) {
                $older = $pgNr + 1;
                echo "<form action='index.php' method='get'><input type='hidden' name='pgNr' value='$older'>
                        <input type='submit' class='btn-primary' value='Older Posts'></form>";
            }
            echo "</div></div>"


            ?>

</div>

</body>
</html>