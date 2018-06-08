<!-- This is the Blog's homepage. -->

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
        <h1 id="BIG">WELCOME TO OUR BLOG!</h1>
        <p>Take a look around, we're sure you'll find something you'll like!</p>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <h2>Look at our three latest posts!<br><small>They are very good.</small></h2>

            <div class="longPost">
                <h2 id="preview-title-0"></h2>
                <br>
                <p id="preview-text-0"></p>
                <br>
                <a id="preview-link-0">read more</a>
            </div>
            <div class="longPost">
                <h2 id="preview-title-1"></h2>
                <br>
                <p id="preview-text-1"></p>
                <br>
                <a id="preview-link-1">read more</a>
            </div>
            <div class="longPost">
                <h2 id="preview-title-2"></h2>
                <br>
                <p id="preview-text-2"></p>
                <br>
                <a id="preview-link-2">read more</a>
            </div>

            <!-- Fills the three latest posts -->
            <script src="postPreview.js"></script>

        </div>
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
            <!-- Fills the list of ten latest posts -->
            <script src="fillLatestPostLinks.js"></script>
        </div>
    </div>
</div>

</body>
</html>