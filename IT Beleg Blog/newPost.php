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

    <script class="text/javascript" src="newPost.js"></script>
    <link rel="stylesheet" href="main.css">
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
                    <li><a href="#">New Post</a></li>
                    <li><a href="#">Edit Post</a></li>
                    <li><a href="#">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<!-- input form to write new posts -->
<div class="container">
    <div id="toolbar"></div>
    <div id="editor"></div>

    <div class="col-xs-12" style="height:20px;"></div>


    <button type="button" class="btn btn-primary btn-md pull-right" id="saveDelta">Save</button>
</div>


<script>
    var toolbarOptions = [
        [{'font': []}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        ['bold', 'italic', 'underline', 'strike'],
        [{'color': []}, {'background': []}],
        [{'list': 'ordered'}, {'list': 'bullet'}, {'align': []}],
        ['link', 'image']
    ];

    var editorOptions = {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Write something here...',
        theme: 'snow'
    };

    var quill = new Quill('#editor', editorOptions);


    $('#saveDelta').click(function () {
        window.delta = quill.getContents();
        var JSONString = JSON.stringify(delta);

        $.ajax({
            type: 'POST',
            url: 'newPost.php',
            data: {'quillContent': JSONString},
            success: function (data) {
                console.log('JSON object successfully transmitted as string!');
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    });

</script>


<?php
if (isset($_POST['quillContent'])) {
    $obj = $_POST['quillContent'];
    file_put_contents(date("Y-m-d H-i-s") . ".txt", $obj);
}
?>


</body>
</html>