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
            <a class="navbar-brand" href="postList.php">Edit Blog Post</a>
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

<div class="container">
    <form action="updatePost.php" method="post">
        Titel: <textarea id="title" type="text" name="title"></textarea><br>
        Inhalt: <textarea id="content" name="content" ></textarea><br>
        <input type="hidden" id="dateTime" name="dateOfCreation">
        <input type="hidden" id="fileName" name="fileName">
        <input type="submit" value="Save">
    </form>
</div>

<script>
    let fileName = localStorage.getItem("fileName");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let jsonObject = JSON.parse(this.responseText);

            document.getElementById("title").innerHTML = jsonObject.post.title;
            document.getElementById("content").innerHTML = jsonObject.post.content;
            document.getElementById("dateTime").value = jsonObject.post.dateOfCreation;
            document.getElementById("fileName").value = fileName;
        }
    };
    xmlhttp.open("GET", "get-reader-data.php?q=" + fileName, true);
    xmlhttp.send();
</script>

</body>
</html>