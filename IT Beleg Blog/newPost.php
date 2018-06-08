<!-- page to create new posts -->

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

    <title>Create New Post</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">New Blog Post</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="editPost.php">Edit Post</a></li>
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


<script>
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

    // "Post"-Button click function
    $('#saveDelta').click(function () {
        // get editor content and convert JSON to String
        window.delta = quill.getContents();

        let JSONString = JSON.stringify(delta);

        // POST ContentString to php via AJAX
        $.ajax({
            type: 'POST',
            url: 'newPost.php',
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
    });
</script>


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

$id = count(glob($dir . 'P_*.txt'));

if (isset($_POST['quillContent'])) {
    $obj = $_POST['quillContent'];
    file_put_contents($dir . 'P_' . $id . '.txt', $obj);
}
?>


</body>
</html>