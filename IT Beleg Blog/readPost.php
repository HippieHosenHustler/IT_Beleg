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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newPost.php">New Post</a></li>
                    <li><a href="editPost.php">Edit Post</a></li>
                    <li><a href="#">Upload Picture</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1 id="pageTitle"></h1>
    </div>
    <!-- Actual Post -->
    <div class="row">
        <div class="col-sm-8">
            <div id="post"></div>

        </div>

        <!-- Latest 10 Posts -->
        <div class="col-sm-4">
            <h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>
            <ul>
                <li><link>Entry 1</li>
                <li>Entry 2</li>
                <li>Entry 3</li>
                <li>Entry 4</li>
                <li>Entry 5</li>
                <li>Entry 6</li>
                <li>Entry 7</li>
                <li>Entry 8</li>
                <li>Entry 9</li>
                <li>Entry 10</li>
        </div>
    </div>
</div>

<script>
    let editorOptions = {
        theme: 'bubble',
        readOnly: true,
        modules: {
            toolbar: false
        }
    };

    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.status === 200 && this.readyState === 4) {
            let jsonObject = JSON.parse(this.responseText);
            let quill = new Quill('#post', editorOptions);
            quill.setContents(jsonObject);
        }
    };
    xhttp.open("GET", "get-reader-data.php?q=" + localStorage.getItem("fileName"), true);
    xhttp.send();
</script>

</body>
</html>
