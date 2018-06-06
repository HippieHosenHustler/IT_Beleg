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
        <h1>WELCOME TO OUR BLOG!</h1>
        <p>Take a look around, we're sure you'll find something you'll like!</p>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <h2>Look at our three latest posts!<br><small>They are very good.</small></h2>

                <div id="long_post_0" class="longPost"></div>
                <div id="long_post_1" class="longPost"></div>
                <div id="long_post_2" class="longPost"></div>

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

<!-- Fills the three latest posts -->
<script>
    let editorOptions = {
      theme: 'bubble',
      readOnly: true,
      modules: {
          toolbar: false
      }
    };


    for (let i = 0; i < 3; i++) {
        loadDoc(i);
    }

    function loadDoc(postNumber) {
        let xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let jsonObject = JSON.parse(this.responseText);
                document.getElementById("long_post_" + postNumber).innerHTML = jsonObject.toString();
                let quill = new Quill('#long_post_' + postNumber, editorOptions);
                quill.setContents(jsonObject);

                let contentLength = quill.getLength();
                quill.deleteText(500, contentLength - 500);
                quill.insertText(quill.getLength() - 1, "...");

            }
        };
        xhttp.open("GET", "get-post-data.php?q=" + postNumber, true);
        xhttp.send();
    }

</script>

</body>
</html>