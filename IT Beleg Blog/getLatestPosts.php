<?php
$files = glob("./Posts/P_*.json");

$jsonArray = array();

/**
for ($i = 0; $i < count($files); $i++) {
    $fileContent = fread(fopen($files[$i], "r"), filesize($files[$i]));
    $jsonContent = json_decode($fileContent, true);
    $jsonContent["file"] = $files[$i];
}
**/

foreach ($files as $file){
    $fileContent = fread(fopen($file, "r"), filesize($file));
    $jsonContent = json_decode($fileContent, true);
    $jsonContent["file"] = $file;

    array_push($jsonArray, $jsonContent);
}

foreach ($jsonArray as $key => $row) {
    $date[$key] = $row["dateOfCreation"];
}

array_multisort($date, SORT_DESC, $jsonArray);

$returnArray = array();

for ($i = 0; $i < count($files); $i++) {
    $returnArray["post"][] = $jsonArray[$i];
}

echo json_encode($returnArray);