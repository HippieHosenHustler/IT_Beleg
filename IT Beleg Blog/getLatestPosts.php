<?php
$files = glob("./Posts/P_*.txt");
rsort($files);
echo json_encode($files);