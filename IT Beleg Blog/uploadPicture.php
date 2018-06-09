<!-- page to upload pictures -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <form id="imgForm" action="uploadPicture.php" method="post" enctype="multipart/form-data">
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
define('DIR', 'Posts/');

if (!is_dir(DIR)) {
    // dir doesn't exist, make it
    mkdir(DIR);
}

$files = glob(DIR . '*-*-* *-*-*.*');
$i = count($files);

if ($i > 0) {
    echo '<div class="container">';
    echo '<h2 style="text-align: center;">Uploaded Pictures</h2>';
    foreach ($files as $img) {
        echo '<img src="' . $img . '" style="margin-left: 0.5%; margin-right: 0.5%; max-width: 9%"/>';
    }
    echo '</div>';
}

//upload handle
if (isset($_FILES['img'])) {
    $img = $_FILES['img'];

    if ($img['size'] > 2097152) {
        echo '<script>alert("File too large!");</script>';
        exit;
    }

    if ($img['error'] !== UPLOAD_ERR_OK) {
        echo '<script>alert("An error occurred!");</script>';
        exit;
    }

    //ensure a safe filename
    $name = date('Y-m-d H-i-s');

    //preg_replace('/[^A-Z0-9._-]/i', '_', $img['name']);
    $parts = pathinfo($img['name']);
    $name = $name . '.' . $parts['extension'];

    // preserve file form temporary directory
    $success = move_uploaded_file($img['tmp_name'], DIR . $name);
    if (!$success) {
        echo '<script>alert(">Unable to save file!");</script>';
        exit;
    }

    //set proper permission on the new file
    chmod(DIR . $name, 0644);
    header("Refresh:0");
}

// TODO: maximalgroesze 2mb
// TODO: jeder thumbnail hat nen loeschbutton und uploaddatum
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