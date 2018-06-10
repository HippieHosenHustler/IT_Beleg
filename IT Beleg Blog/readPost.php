<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Quill -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <title id="pageTitle">Blog von Tom und Edwin</title>

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

    echo "<div class='row'><div class='col-sm-8'><div class='panel panel-primary'><div class='panel-body'><p>";

    require_once 'Michelf/Markdown.inc.php';

    $parser = new \Michelf\Markdown();
    $parser->fn_id_prefix = "post22-";
    $myHtml = $parser->transform($jsonContent["content"]);
    echo $myHtml;

    echo "</p></div></div></div>";

    echo "<div class='col-sm-4'><h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>";

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
    if (!empty($jsonArray)) {
        array_multisort($date, SORT_DESC, $jsonArray);
    }

    $size = count($jsonArray);

    if ($size >= 10) {
        $linkSize = 10;
    } else {
        $linkSize = $size;
    }

    for ($j = 0; $j < $linkSize; $j++) {
        echo "<a href='readPost.php?fileName=" . $jsonArray[$j]['fileName'] . "'>";
        echo $jsonArray[$j]["title"];
        echo "</a><br>";
        echo $jsonArray[$j]["dateOfCreation"];
        echo "<br><br>";
    }

    echo "</div></div>"
    ?>

    <form action="saveComment.php" method="post">
        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" title="content" name="content"></textarea>
        </div>

        <?php
        $timestamp = time();
        $date = date("Y-m-d H:i:s", $timestamp);
        echo "<input type='hidden' name='parentPost' value='" . $jsonContent['fileName'] . "'>";
        echo "<input type='hidden' name='dateOfCreation' value='" . $date . "'>";
        echo "<script>let simpleMDE = new SimpleMDE({element: document.getElementById('content')})</script>";
        ?>
        <input type="submit" class="btn-primary" value="Save">
    </form>

    <?php
    $cFiles = glob('./Posts/C_*.json');
    $commentArray = Array();

    foreach ($cFiles as $cFile){
        $cFileContent = fread(fopen($cFile, "r"), filesize($file));
        $commentContent = json_decode($cFileContent, true);
        if ($commentContent['ParentPost'] == $jsonContent['fileName']){
            $commentContent["fileName"] = $file;
            array_push($commentArray, $commentContent);
        }
    }

    foreach ($commentArray as $comment){
        // output goes here
    }
    ?>
</div>
</body>
</html>
