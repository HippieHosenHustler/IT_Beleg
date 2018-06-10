
    <?php
    $title = $_POST["title"];
    $content = $_POST["content"];
    $dateOfCreation = $_POST["dateOfCreation"];


    $array = array(
        "dateOfCreation" => $dateOfCreation,
        "title" => $title,
        "content" => $content
    );

    if (empty($_POST["fileName"])) {
        $postId = count(glob("./Posts/P_*.json"));

        while (file_exists("./Posts/P_".$postId.".json")) {
            $postId++;
        }
        $array["postId"] = $postId;

        $jsonFileContent = json_encode($array);

        file_put_contents("./Posts/P_".$postId.".json", $jsonFileContent);
    } else {
        $fileName = $_POST["fileName"];
        $postId = $_POST["postId"];
        $array["postId"] = $postId;

        $jsonFileContent = json_encode($array);

        file_put_contents($fileName, $jsonFileContent);
    }

    header("Location: index.php");
