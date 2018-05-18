<!-- This is the Blog's homepage. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Blog von Tom und Edwin</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
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


<div class="container">
    <div class="jumbotron">
        <h1>WELCOME TO OUR BLOG!</h1>
        <p>Take a look around, we're sure you'll find something you'll like!</p>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <h2>Look at our last three posts!<br><small>They are very good.</small></h2>
            <div id="post-excerpt-1">
                Post 1
            </div>
            <div id="post-excerpt-2">
                Post 2
            </div>
            <div id="post-excerpt-3">
                Post 3
            </div>
        </div>
        <div class="col-sm-4">
            <h2>Look at this list of posts!<br><small>They are all terrific.</small></h2>
            <ul>
                <li id="recent-post-link-1">Entry 1</li>
                <li id="recent-post-link-2">Entry 2</li>
                <li id="recent-post-link-3">Entry 3</li>
                <li id="recent-post-link-4">Entry 4</li>
                <li id="recent-post-link-5">Entry 5</li>
                <li id="recent-post-link-6">Entry 6</li>
                <li id="recent-post-link-7">Entry 7</li>
                <li id="recent-post-link-8">Entry 8</li>
                <li id="recent-post-link-9">Entry 9</li>
                <li id="recent-post-link-10">Entry 10</li>
            </ul>
        </div>
    </div>
</div>



<div id="newest posts">

</div>

<div id="list of posts">

</div>
</body>
</html>