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

    <!-- separator -->
    <div class="col-xs-12" style="height:20px;"></div>

    <button type="button" class="btn btn-primary btn-md pull-right" id="saveDelta">Post</button>
</div>


<!-- hidden input element to load file via dialog and access content -->
<input id="fileInput" accept='text/plain' type="file" name="name" style="display: none;"/>


<script>
    // prompt .txt-file selection dialog on load by triggering a click on the input element
    $('#selectPost').ready(function () {
        $('#fileInput').trigger('click');

        // get content from selected file
        $('#fileInput').change(function (event) {
            var input = event.target;

            // create FileReader to access content
            var reader = new FileReader();
            reader.onload = function () {
                // convert String back to JSON to enable correct parsing to editor
                var obj = JSON.parse(reader.result)
                quill.setContents(obj);
            };
            // execute reader for first and only first file in FileList
            reader.readAsText(input.files[0]);
        });
    });


    // setting up quill editor
    // define toolbar
    var toolbarOptions = [
        [{'font': []}],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        ['bold', 'italic', 'underline', 'strike'],
        [{'color': []}, {'background': []}],
        [{'list': 'ordered'}, {'list': 'bullet'}, {'align': []}],
        ['link', 'image']
    ];

    // define other options and set toolbar options
    var editorOptions = {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Write something here...',
        theme: 'snow'
    };

    // create editor with the according options from above
    var quill = new Quill('#editor', editorOptions);


    // "Post"-Button click function
    $('#saveDelta').click(function () {
        // get editor content and convert JSON to String
        window.delta = quill.getContents();
        var JSONString = JSON.stringify(delta);

        // POST ContentString to php via AJAX
        $.ajax({
            type: 'POST',
            url: 'newPost.php',
            data: {'quillContent': JSONString},
            success: function (data) {
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
if (isset($_POST['quillContent'])) {
    $obj = $_POST['quillContent'];
    file_put_contents(date("Y-m-d H-i-s") . ".txt", $obj);
}
?>


</body>
</html>