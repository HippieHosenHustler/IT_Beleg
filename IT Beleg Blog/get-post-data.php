<?php
$q = $_REQUEST["q"];

$files = glob("./blog/*.txt");
rsort($files);
$file = fopen($files[$q], "r") or die("Unable to open file!");
$fileContent = fread($file, filesize($files[$q]));
$jsonObject = json_encode($fileContent);
echo $fileContent;
fclose($file);