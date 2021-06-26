<?php
include_once("database.php");
$db = new MyDatabase();

$latex = '';

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$groups = array("Control", "Test");
$solveTime = array();
foreach($groups as $group) {
    $solveTime[$group] = $db->getSolveTimesForGruppe($group);
}

include_once("solvetime-base.php");

printStats($groups, $solveTime, $mappings);
?>