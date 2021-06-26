<?php
include_once("database.php");
$db = new MyDatabase();

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$groups = array("Control", "Test");
$solveTime = array();
foreach($groups as $group) {
    $solveTime[$group] = $db->getSolveTimesForGruppe($group);
}

$output = array();
echo '<table border="1">';
foreach($mappings as $mapping) {
    $i=0;
    foreach($groups as $group) {
        echo '<tr>';
        if ($i == 0) {
            echo '<td rowspan="2">'.$mapping["Name"].'</td>';
        }
        echo '<td>'.$group.'</td>';
        foreach ($solveTime[$group][$mapping["Name"]] as $value) {
            echo '<td>' . $value->getTime() . '</td>';
        }
        echo '</tr>';
        $i++;
    }
}
echo '</table>';
?>