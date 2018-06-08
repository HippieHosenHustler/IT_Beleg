<?php
$files = glob("./Posts/P_*.json");

$returnArray = array();

foreach ($files as $file){
    $fileContent = fread(fopen($file, "r"), filesize($file));
    $jsonContent = json_decode($fileContent, true);
    $jsonContent["file"] = $file;
    array_push($returnArray, $jsonContent);
}

foreach ($returnArray as $key => $row) {
    $date[$key] = $row["dateOfCreation"];
}

array_multisort($date, SORT_DESC, $returnArray);

echo json_encode($returnArray);