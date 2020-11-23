<?php
include_once("header.php");
$db = new MyDatabase();

echo "Execute:";

$runId = $db->insertRun("task", "code", "output");
?>