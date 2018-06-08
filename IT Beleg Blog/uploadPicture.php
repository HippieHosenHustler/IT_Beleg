<!-- page to upload pictures -->

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

    <title>Upload Picture</title>
</head>
<body>

<!-- Navbar at the top of the page -->
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Upload Picture</a>
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
                    <li><a href="editPost.php">Edit Post</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<div class="container">
    <form id="imgForm" action="" method="post" enctype="multipart/form-data">
        <div id="image_preview">
            <img id="imgPreview" src="#" alt=""
                 style="display: block; margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;"/>
        </div>

        <div class="col-xs-12" style="height:20px;"></div>

        <div id="selectImage">
            <input type="file" id="imgInput" name="img" accept="image/*" style="display: none;">
            <button type="button" class="btn btn-default btn-block" id="btnSelect">Select</button>
            <button type="button" class="btn btn-primary btn-block" id="btnUpload">Upload</button>
        </div>
    </form>
</div>


<?php
$dir = 'Posts/';

if (!is_dir($dir)) {
    // dir doesn't exist, make it
    mkdir($dir);
}

$files = glob($dir . 'I_*.*');
$id = count($files);

if ($id > 0) {
    echo '<div class="container">';
    echo '<h2 style="text-align: center;">Uploaded Pictures</h2>';
    foreach ($files as $img) {
        echo '<img src="' . $img . '" style="margin-left: 0.5%; margin-right: 0.5%; max-width: 9%"/>';
    }
    echo '</div>';
}

if (isset($_POST['img'])) {
    echo '<script>console.log("whatever");</script>';
}
?>


<script>
    $('#btnUpload').ready(function () {
        $('#btnUpload').prop('disabled', true);
    });

    $('#btnSelect').click(function () {
        $('#imgInput').trigger('click');
        $('#imgInput').change(function () {
            readURL(this);
            $('#btnUpload').prop('disabled', false);
        });
    });


    $(document).ready(function () {
        $('#imgForm').on('submit',(function(e) {
            e.preventDefault();
            //let img = new FormData();
            //img.append('img', document.getElementById('imgPreview').src);

            let img = document.getElementById('imgPreview').src;

            $.ajax({
                type: 'POST',
                url: 'uploadPicture.php',
                data: {'img': img},
                cache: false,
                //contentType: false,
                //processData: false,
                success: function () {
                    console.log(img);
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }));
    });


    $('#btnUpload').click(function () {
        $('#imgForm').submit();
    });


    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#imgPreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>