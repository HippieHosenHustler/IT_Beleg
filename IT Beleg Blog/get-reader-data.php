<?php
$q = $_REQUEST("q");

$file = fopen("./blog/".$q, "r") or die("Unable to open file!");
$fileContent = fread($file, filesize($file));
echo json_encode($fileContent);
fclose($file);