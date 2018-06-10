    <?php
    $parentPost = $_POST['parentPost'];
    $content = $_POST["content"];
    $dateOfCreation = $_POST["dateOfCreation"];
    $name = $_POST["name"];
    $mail = $_POST["mail"];

    $array = array(
        'ParentPost' => $parentPost,
        "dateOfCreation" => $dateOfCreation,
        "content" => $content,
        "name" => $name,
        "mail" => $mail
    );
    $jsonFileContent = json_encode($array);

    $commentId = count(glob("./Posts/C_*.json"));
    file_put_contents("./Posts/C_".$commentId.".json", $jsonFileContent);

    header("Location: readPost.php?fileName=$parentPost");
