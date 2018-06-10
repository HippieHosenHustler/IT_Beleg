<?php
/**
 * Deletes the post and returns to the post list.
 */
$fileName = $_POST["fileName"];
unlink($fileName);
header("Location: postList.php");