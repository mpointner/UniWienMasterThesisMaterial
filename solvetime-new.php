<?php
include_once("database.php");
$db = new MyDatabase();

$latex = '';

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$groups = array("Control", "Test");
$solveTime = array();
foreach($groups as $group) {
    $solveTime[$group] = $db->getSolveTimesForUsersOfGroup($group);
}

print_r(key($solveTime["Test"]));

$namesUserId = $db->getUserIdsStudentNames();
$namesDistinct = $db->getStudentNamesDistinct();

include_once("solvetime-base-new.php");

printStats($groups, $solveTime, $mappings, $namesUserId, $namesDistinct);
?>