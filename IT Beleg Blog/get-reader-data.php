<?php
$q = $_REQUEST["q"];

$file = fopen($q, "r") or die("Unable to open file!");
$fileContent = fread($file, filesize($q));
echo $fileContent;
fclose($file);