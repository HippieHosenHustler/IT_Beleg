<!-- This is the Blog's homepage. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Tom's and Edwin's Blog</title>
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
                    <li><a href="postList.php">Edit or Delete Post</a></li>
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

            // if the page number is not given, it is set to 0.
            if (empty($_GET["pgNr"])) {
                $pgNr = 0;
            } else {
                $pgNr = $_GET["pgNr"];
            }

            // Reads all the post files into an array
            $files = glob("./Posts/P_*.json");

            $jsonArray = array();

            // parses the content of each file into an array, adds fileName to it, and then adds it to an array containing every post
            foreach ($files as $file) {
                $fileContent = fread(fopen($file, "r"), filesize($file));
                $jsonContent = json_decode($fileContent, true);
                $jsonContent["fileName"] = $file;

                array_push($jsonArray, $jsonContent);
            }

            // unless there are no posts at all, they are sorted by age.
            foreach ($jsonArray as $key => $row) {
                $date[$key] = $row["dateOfCreation"];
            }
            if (count($jsonArray) != 0) {
                array_multisort($date, SORT_DESC, $jsonArray);
            }


            //The three previews of the posts
            echo "<div class='col-sm-8'>";

            //This chooses which posts are being displayed
            for ($i = $pgNr * 3; $i < ( $pgNr*3 ) + 3; $i++) {
                if (!empty($jsonArray[$i])){
                    // Creates a panes for each post, the heading contains the title and date of creation
                    echo "<div class='panel panel-primary'><div class='panel-heading'><h2>";
                    echo $jsonArray[$i]["title"];
                    echo "</h2><br>".$jsonArray[$i]['dateOfCreation'];

                    //The body contains the first 500 characters of the post, as well as a link to its full form
                    echo "</div><div class='panel-body'><p id='content".$i."'>";

                    $substring = substr($jsonArray[$i]["content"], 0, 500);

                    // parses the markdown
                    require_once 'Michelf/Markdown.inc.php';
                    $parser = new \Michelf\Markdown();
                    $parser ->fn_id_prefix = "post22-";
                    $myHtml = $parser->transform($substring);
                    echo $myHtml;
                    echo "</p><br><a href='readPost.php?fileName=".$jsonArray[$i]['fileName']."'>read more</a></div></div>";
                }
            }
            echo "</div>";

            $size = count($jsonArray);

            echo "<div class='com-sm-4'><h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>";

            // in case there are less than 10 posts
            if ($size >= 10) {
                $linkSize = 10;
            } else {
                $linkSize = $size;
            }

            // creates up to ten links to posts and their date of creation
            for ($j = 0; $j < $linkSize; $j++) {
                echo "<a href='readPost.php?fileName=".$jsonArray[$j]['fileName']."'>";
                echo $jsonArray[$j]["title"];
                echo "</a><br>";
                echo $jsonArray[$j]["dateOfCreation"];
                echo "<br><br>";
            }

            echo "</div></div>";

            // Generates the "Newer Posts" button, given that there are newer posts to display
            echo "<div class='row'><div class='col-sm-4'>";
            if ($pgNr != 0) {
                $newer = $pgNr -1;
                echo "<form action='index.php' method='get'><input type='hidden' name='pgNr' value='$newer'>
                        <input type='submit' class='btn-primary' value='Newer Posts'></form>";
            }
            echo "</div><div class='col-sm-4'>";

            // Generates the "Older Posts" button, given that there are older posts to display
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