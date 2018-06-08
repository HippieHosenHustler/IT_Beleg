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
        <h1 id="post-title"></h1>
    </div>
    <!-- Actual Post -->
    <div class="row">
        <div class="col-sm-8">
            <p id="post-content"></p>

        </div>
        <!-- Displays the blog post -->
        <script>
            let fileName = localStorage.getItem("fileName");

            let xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    let responseTextJson = JSON.parse(this.responseText);

                    document.getElementById("post-title").innerHTML = responseTextJson.post.title;
                    document.getElementById("post-content").innerHTML = responseTextJson.post.Content;
                }
            };
            xhttp.open("GET", "get-reader-data.php?q=" + fileName, true);
            xhttp.send();

        </script>

        <!-- Latest 10 Posts -->
        <div class="col-sm-4">
            <h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>

            <a id="recent-post-link-0" href="#"></a>
            <br>
            <a id="recent-post-link-1" href="#"></a>
            <br>
            <a id="recent-post-link-2" href="#"></a>
            <br>
            <a id="recent-post-link-3" href="#"></a>
            <br>
            <a id="recent-post-link-4" href="#"></a>
            <br>
            <a id="recent-post-link-5" href="#"></a>
            <br>
            <a id="recent-post-link-6" href="#"></a>
            <br>
            <a id="recent-post-link-7" href="#"></a>
            <br>
            <a id="recent-post-link-8" href="#"></a>
            <br>
            <a id="recent-post-link-9" href="#"></a>
        </div>
    </div>
</div>
<!-- Fills the list of ten latest posts -->
<script src="fillLatestPostLinks.js">
</script>
</body>
</html>
