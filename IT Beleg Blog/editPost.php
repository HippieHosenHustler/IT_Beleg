<!-- page to edit posts -->

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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newPost.php">New Post</a></li>
                    <li><a href="uploadPicture.php">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<!-- input form to write new posts -->
<div class="container">
    <div id="toolbar"></div>
    <div id="editor"></div>

    <!-- separator -->
    <div class="col-xs-12" style="height:20px;"></div>

    <button type="button" class="btn btn-primary btn-md pull-right" id="saveDelta">Post</button>
</div>


<!-- php part
 waits for post via ajax
 writes content to file and names it according to current date and time
 -->
<?php
$dir = 'Posts/';

if (!is_dir($dir)) {
    // dir doesn't exist, make it
    mkdir($dir);
}

$files = glob($dir . 'P_*.txt');
$id = count($files);

if ($id > 0) {
    echo '<div class="container">';
    echo '<h2>Posts available for editing:</h2>';
    $i = 0;
    foreach ($files as $post) {
        $file = fopen($post, 'r');
        $json = fread($file, filesize($post));
        $json = json_decode($json);


        // TODO: get title from json to display on button

        // $buttonName = $json->attribute->header;
        // echo '<script>console.log(' . $buttonName . ');</script>';
        echo '<button type="button" class="btn btn-default btn-block" onclick="fileClick(this.id)" id="' . $post . '">' . $post . '</button>';
        fclose($file);
        $i++;
    }
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<h2>No Posts available!</h2>';
    echo '</div>';
}

if (isset($_POST['quillContent'])) {
    $obj = $_POST['quillContent'];
    file_put_contents($dir . 'P_' . $id . '.txt', $obj);
}
?>

<script>
    function fileClick(file) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let obj = JSON.parse(xhttp.responseText);
                quill.setContents(obj);
                $('#saveDelta').prop('disabled', false);
            }
        };
        xhttp.open('GET', file, true);
        xhttp.send();
    }


    $('#saveDelta').ready(function (){
        $('#saveDelta').prop('disabled', true);
    });

    // "Post"-Button click function
    $('#saveDelta').click(function () {
        if ($("#saveDelta").is(":enabled")) {
            // get editor content and convert JSON to String
            window.delta = quill.getContents();
            let JSONString = JSON.stringify(delta);

            // POST ContentString to php via ajax
            $.ajax({
                type: 'POST',
                url: 'editPost.php',
                data: {'quillContent': JSONString},
                success: function () {
                    console.log('JSON object successfully transmitted as string!');
                    // redirect to home
                    window.location.replace("index.php");
                },
                error: function (e) {
                    console.log(e.message);
                }
            });
        }
    });


    // setting up quill editor
    // define toolbar
    let toolbarOptions = [
        [{'font': []}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        ['bold', 'italic', 'underline', 'strike'],
        [{'color': []}, {'background': []}],
        [{'list': 'ordered'}, {'list': 'bullet'}, {'align': []}],
        ['link', 'image']
    ];

    // define other options and set toolbar options
    let editorOptions = {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Write something here...',
        theme: 'snow'
    };

    // create editor with the according options from above
    let quill = new Quill('#editor', editorOptions);
</script>
</body>
</html>