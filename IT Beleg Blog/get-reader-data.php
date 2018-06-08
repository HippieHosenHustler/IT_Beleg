<?php
$q = $_REQUEST["q"];

$file = fopen($q, "r") or die("Unable to open file!");
$fileContent = fread($file, filesize($q));
$returnArray = array();
$jsonArray = json_decode($fileContent);
$returnArray["post"] = $jsonArray;

echo json_encode($returnArray);
fclose($file);