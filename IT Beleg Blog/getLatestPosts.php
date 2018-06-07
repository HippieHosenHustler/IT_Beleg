<?php
$files = glob("./blog/*.txt");
rsort($files);
echo json_encode($files);