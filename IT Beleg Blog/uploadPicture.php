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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="newPost.php">New Post</a></li>
                    <li><a href="editPost.php">Edit or Delete Post</a></li>
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
$fCount = count($files);

if ($fCount > 0) {
    echo '<div class="container" id="deleteContainer">';
    echo '<h2 style="text-align: center;">Uploaded Pictures</h2>';

    for ($j = $fCount - 1; $j >= 0; $j = $j - 6) {
        echo '<div class="row">';

        for ($i = $j; $i >= $j - 5; $i--) {
            if (isset($files[$i])) {
                echo '<div class="col-sm-2">';
                echo '<div class="row">';
                echo '<img src="' . $files[$i] . '" style="object-fit: cover; width: 180px; height: 180px"/>';
                echo '</div>';
                echo '<div class="col-xs-12" style="height:20px;"></div>';
                echo '<div class="row" style="vertical-align: bottom;">';
                echo '<div class="col-xs-9">';
                echo '<p style="font-size: 12px;">' . date("Y-m-d H:i:s", filectime($files[$i])) . '</p>';
                echo '</div>';
                echo '<div class="col-xs-3">';
                echo '<button type="button" class="btn btn-danger btn-xs" id="' . $files[$i] . '">x</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }

        echo '<div class="col-xs-12" style="height:20px;"></div>';
        echo '</div>';
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

    $name = date('Y-m-d H-i-s');
    $parts = pathinfo($img['name']);
    $name = $name . '.' . $parts['extension'];

    $success = move_uploaded_file($img['tmp_name'], DIR . $name);
    if (!$success) {
        echo '<script>alert(">Unable to save file!");</script>';
        exit;
    }

    //set proper permission on the new file
    chmod(DIR . $name, 0644);
    header("Refresh:0");
}

//delete handle
if (isset($_POST['img'])) {
    $img = $_POST['img'];
    echo '<script>console.log('.$img.');</script>';
    //$d = delete($img);
    if ($d){
        echo '<script>console.log("Image deleted!");</script>';
    }
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

    $('#btnUpload').click(function () {
        $('#imgForm').submit();
    });

    $('#deleteContainer').on('click', 'button', function () {
        let img = this.id;
        $.ajax({
            type: 'POST',
            url: 'uploadPicture.php',
            data: {img: img},
            cache: false,
            success: function () {
                console.log(img);
            },
            error: function (e) {
                console.log(e.message);
            }
        });
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