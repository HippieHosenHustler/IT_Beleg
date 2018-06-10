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

<!-- create new input form to upload images -->
<div class="container">
    <form id="imgForm" action="uploadPicture.php" method="post" enctype="multipart/form-data">
        <!-- image preview after selecting and before uploading -->
        <div id="image_preview">
            <img id="imgPreview" src="#" alt=""
                 style="display: block; margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;"/>
        </div>

        <!-- separator -->
        <div class="col-xs-12" style="height:20px;"></div>

        <!-- file input, select and upload button that functions as form submit -->
        <div id="selectImage">
            <input type="file" id="imgInput" name="img" accept="image/*" style="display: none;">
            <button type="button" class="btn btn-default btn-block" id="btnSelect">Select</button>
            <button type="button" class="btn btn-primary btn-block" id="btnUpload">Upload</button>
        </div>
    </form>
</div>

<script>
    // disable upload button on page load
    $('#btnUpload').ready(function () {
        $('#btnUpload').prop('disabled', true);
    });

    // select button handle
    //  trigger click from file input to call explorer
    //  load image to preview
    //  enable upload button
    $('#btnSelect').click(function () {
        $('#imgInput').trigger('click');
        $('#imgInput').change(function () {
            readURL(this);
            $('#btnUpload').prop('disabled', false);
        });
    });

    // form submit is assigned to click event from upload button
    $('#btnUpload').click(function () {
        $('#imgForm').submit();
    });

    // dynamic delete handle
    //  get id of clicked button
    //  post image filepath to php via ajax
    $('#deleteContainer').on('click', 'button', function () {
        let img = this.id;
        $.ajax({
            type: 'POST',
            url: 'uploadPicture.php',
            data: {img: img},
            cache: false,
            success: function () {
                console.log('Success!');
            },
            error: function (e) {
                console.log(e.message);
            }
        });
    });

    // function to load image into preview
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

<?php
// define filepath and create directory if needed
define('DIR', 'Posts/');
if (!is_dir(DIR)) {
    // dir doesn't exist, make it
    mkdir(DIR);
}

// get image files and their number
$files = glob(DIR . '*-*-* *-*-*.*');
$fCount = count($files);

// dynamically create image matrix with date of creation and delete button if any exist
// order is reversed so that the newest image is always the first to be displayed
if ($fCount > 0) {
    echo '<div class="container" id="deleteContainer">';
    echo '<h2 style="text-align: center;">Uploaded Pictures</h2>';

    // create new row for every 6 images --> merely formal
    for ($j = $fCount - 1; $j >= 0; $j = $j - 6) {
        echo '<div class="row">';

        // create img, date and delete button for every image
        for ($i = $j; $i >= $j - 5; $i--) {
            if (isset($files[$i])) {

                // ensure responsive design for image matrix
                echo '<div class="col-lg-2 col-md-4 col-sm-6">';
                echo '<div class="row">';

                // images are cropped to 180x180 px to create equal formats of thumbnails
                echo '<img src="' . $files[$i] . '" class="img-responsive center-block" style="object-fit: cover; width: 180px; height: 180px; margin-left: auto; margin-right: auto;"/>';
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

        // separator
        echo '<div class="col-xs-12" style="height:20px;"></div>';
        echo '</div>';
    }

    echo '</div>';
}

//upload handle
if (isset($_FILES['img'])) {
    $img = $_FILES['img'];

    // throw error if image size exeeds 2mb
    if ($img['size'] > 2097152) {
        echo '<script>alert("File too large!");</script>';
        exit;
    }

    // catch other errors
    if ($img['error'] !== UPLOAD_ERR_OK) {
        echo '<script>alert("An error occurred!");</script>';
        exit;
    }

    // format save name for image
    $name = date('Y-m-d H-i-s');
    $parts = pathinfo($img['name']);
    $name = $name . '.' . $parts['extension'];

    // save image
    $success = move_uploaded_file($img['tmp_name'], DIR . $name);

    // catch save error
    if (!$success) {
        echo '<script>alert(">Unable to save file!");</script>';
        exit;
    }

    // set proper permission on the new file and refresh page
    chmod(DIR . $name, 0644);
    header("Refresh:0");
}

// delete handle
// THIS DOES NOT WORK!
// in theory:
//      1. ajax handle parses image-name and filepath to php via POST -> object name is set to 'img'
//      2. php gets the data from $_POST['img']
//      3. php deletes the image fitting the parsed name using unlink()
// the ajax handle works fine, but for some reason php does not receive the object in $_POST
if (isset($_POST['img'])) {
    $img = $_POST['img'];
    $d = unlink($img);
    if ($d){
        echo '<script>console.log("Image deleted!");</script>';
    }
}
?>
</body>
</html>