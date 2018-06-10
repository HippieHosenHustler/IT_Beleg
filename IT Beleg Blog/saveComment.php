<div class="container">
    <?php
    $parentPost = $_POST['parentPost'];
    $content = $_POST["content"];
    $dateOfCreation = $_POST["dateOfCreation"];

    $array = array(
        'ParentPost' => $parentPost,
        "dateOfCreation" => $dateOfCreation,
        "content" => $content
    );
    $jsonFileContent = json_encode($array);

    $commentId = count(glob("./Posts/C_*.json"));
    file_put_contents("./Posts/C_".$commentId.".json", $jsonFileContent);

    echo 'Comment saved!';
    ?>
</div>