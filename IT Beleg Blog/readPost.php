<!-- This page displays a post in full length -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title id="pageTitle">Tom's and Edwin's Blog</title>

</head>
<body>
<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">HOME</a>
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
    <?php
    $fileName = $_GET["fileName"];
    $file = fopen($fileName, "r");
    $fileContent = fread($file, filesize($fileName));
    $jsonContent = json_decode($fileContent, true);

    //Header
    echo "<div class='jumbotron'><h1>";
    echo $jsonContent["title"];
    echo "<br><small>";
    echo $jsonContent["dateOfCreation"];
    echo "</small></h1></div>";

    // Content of the post
    echo "<div class='row'><div class='col-sm-8'><div class='panel panel-primary'><div class='panel-body'><p>";

    // parses markdown
    require_once 'Michelf/Markdown.inc.php';
    $parser = new \Michelf\Markdown();
    $parser->fn_id_prefix = "post22-";
    $myHtml = $parser->transform($jsonContent["content"]);
    echo $myHtml;

    echo "</p></div></div></div>";

    //List of ten latest posts
    echo "<div class='col-sm-4'><h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>";

    // reads every post file into an array
    $files = glob("./Posts/P_*.json");

    $jsonArray = array();

    // parses json for every file, adds fileName, adds everything to array
    foreach ($files as $file) {
        $fileContent = fread(fopen($file, "r"), filesize($file));
        $jsonContent = json_decode($fileContent, true);
        $jsonContent["fileName"] = $file;

        array_push($jsonArray, $jsonContent);
    }

    //Unless there are no posts, sorts by date
    foreach ($jsonArray as $key => $row) {
        $date[$key] = $row["dateOfCreation"];
    }
    if (!empty($jsonArray)) {
        array_multisort($date, SORT_DESC, $jsonArray);
    }

    // in case there are less than 10 posts
    $size = count($jsonArray);
    if ($size >= 10) {
        $linkSize = 10;
    } else {
        $linkSize = $size;
    }

    // generates a link to the ten latest posts and displays their date
    for ($j = 0; $j < $linkSize; $j++) {
        echo "<a href='readPost.php?fileName=" . $jsonArray[$j]['fileName'] . "'>";
        echo $jsonArray[$j]["title"];
        echo "</a><br>";
        echo $jsonArray[$j]["dateOfCreation"];
        echo "<br><br>";
    }

    echo "</div></div>"
    ?>

    <div class="col-sm-8">
        <form action="saveComment.php" method="post">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" title="name" name="name"/>
            </div>

            <div class="form-group">
                <label for="mail">E-Mail</label>
                <input type="email" class="form-control" id="mail" title="mail" name="mail"/>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" title="content" name="content"></textarea>
            </div>



            <?php
            $timestamp = time();
            $date = date("Y-m-d H:i:s", $timestamp);
            echo "<input type='hidden' name='parentPost' value='" . $fileName . "'>";
            echo "<input type='hidden' name='dateOfCreation' value='" . $date . "'>";
            echo "<script>let simpleMDE = new SimpleMDE({element: document.getElementById('content')})</script>";
            ?>
            <input type="submit" class="btn-primary" value="Save">
        </form>

    </div>
    echo '<div class="col-xs-12" style="height:20px;"></div>';

    <?php
    $cFiles = glob('./Posts/C_*.json');
    $commentArray = Array();

    foreach ($cFiles as $cFile){
        $cFileContent = fread(fopen($cFile, "r"), filesize($file));
        $commentContent = json_decode($cFileContent, true);
        if ($commentContent['ParentPost'] == $fileName){
            $commentContent["fileName"] = $file;
            array_push($commentArray, $commentContent);
        }
    }

    echo "<div class='col-sm-8'>";

    foreach ($commentArray as $comment){
        // output goes here
        echo "<div class='row'>";
        echo "<div class='panel panel-default'><div class='panel-heading'>";

        echo "<div class='col-sm-8'>".$comment['name']."</div>";
        echo "<div class='col-sm-4'>".$comment['dateOfCreation']."</div><br>";

        echo "</div><div class='panel-body'><p>";
        echo $comment["content"];
        echo "</p></div></div></div>";
    }

    echo "</div>";
    ?>
</div>
</body>
</html>
