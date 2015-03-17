<?php

header("Content-Type: application/json");

$e = $_GET['event'];
$m = $_GET['month'];
$y = $_GET['year'];
$d = $_GET['day'];
$t = $_GET['time'];

echo json_encode(array("event" => $e, "month" => $m, "year" => $y, "day" => $d, "time" => $t));

exit;

?>
