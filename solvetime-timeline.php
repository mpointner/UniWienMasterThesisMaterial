<?php
include_once("database.php");
$db = new MyDatabase();

$latex = '';

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$dates = array("2020-12-04", "2020-12-11", "2020-12-07", "2020-12-14", "2020-12-18", "2020-12-21");
$solveTime = array();
foreach($dates as $date) {
    $solveTime[$date] = $db->getSolveTimesForDate($date);
}

include_once("solvetime-base.php");

printStats($dates, $solveTime, $mappings);
?>

<?php
/*
?>
<html>
<head>
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2;}

        tr:hover {background-color: #ddd;}

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
            position: sticky;
            top: 0;
            bottom: 0;
        }
        
        .center {
            text-align: center;
        }

        .line-header {
            position: sticky;
            left: 0;
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
<?php
include_once("database.php");
$db = new MyDatabase();

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$dates = array("2020-12-04", "2020-12-11", "2020-12-07", "2020-12-14", "2020-12-18", "2020-12-21");

$solveTime = array();
echo 'Units: Minute:Seconds (Count)';
echo '<table>';
echo '<tr>';
echo '<th class="line-header">Error</th>';
$sumSolveTime = array();
$sumSolveRuns = array();
$sumDivider = array();
foreach($dates as $date) {
    echo '<th colspan="3" class="center">'.$date.'</th>';
    $solveTime[$date] = $db->getSolveTimesForDate($date);
    $sumSolveTime[$date] = 0;
    $sumSolveRuns[$date] = 0;
    $sumDivider[$date] = 0;
}
echo '</tr>';

echo '<tr>';
echo '<th class="line-header">&nbsp;</th>';
$sumSolveTime = array();
$sumSolveRuns = array();
$sumDivider = array();
foreach($dates as $date) {
    echo '<th class="center">Average/Median <br>Solve Time</th>';
    echo '<th class="center">Average/Median # Runs <br>needed to solve</th>';
    echo '<th class="center">Occurrence for <br># students</th>';
}
echo '</tr>';

foreach ($mappings as $mapping) {
    echo '<tr>';
    echo '<td class="line-header">'.$mapping["Name"].'</td>';
    foreach($dates as $date) {
        $list = $solveTime[$date][$mapping["Name"]];
        if (count($list) > 0) {
            $sumTime = 0;
            $sumRuns = 0;
            $concatTime = "";
            $concatRuns = "";
            $timeArray = array();
            $runArray = array();
            foreach ($list as $time) {
                $timeArray[] = $time->getTime();
                $runArray[] = $time->getRun();
                $sumTime += $time->getTime();
                $sumRuns += $time->getRun();
                $concatTime .= date("i:s", $time->getTime()) . ", ";
                $concatRuns .= $time->getRun() . ", ";
            }
            $seconds = round($sumTime / count($list));
            $runs = round($sumRuns / count($list), 1);
            $sumSolveTime[$date] += $seconds;
            $sumSolveRuns[$date] += $runs;
            $sumDivider[$date] += 1;
            echo '<td class="center" title="'.$concatTime.'">a: ' . date("i:s", $seconds) . '<br>m: ' . date("i:s", median($timeArray)) . '</td>';
            echo '<td class="center" title="'.$concatRuns.'">a: ' . $runs . '<br>m: ' . median($runArray) . '</td>';
            echo '<td class="center">'.count($list).'</td>';
        } else {
            echo '<td class="center" colspan="3"> - </td>';
        }
    }
    echo '</tr>';
}

echo '<tr><th class="line-header">Average:</th>';
foreach($dates as $date) {
    if ($sumDivider[$date] > 0) {
        $averageTime = round($sumSolveTime[$date] / $sumDivider[$date]);
        $averageRuns = round($sumSolveRuns[$date] / $sumDivider[$date], 1);
        echo '<th class="center">' . date("i:s", $averageTime) . '</th>';
        echo '<th class="center">' . $averageRuns . '</th>';
        echo '<th class="center">&nbsp;</th>';
    } else {
        echo '<th class="center" colspan="3"> - </th>';
    }

}
echo '</tr>';

echo '</table>';


function median($arr){
    if($arr){
        $count = count($arr);
        sort($arr);
        $mid = floor(($count-1)/2);
        return ($arr[$mid]+$arr[$mid+1-$count%2])/2;
    }
    return 0;
}
?>
</body>
</html>
<?php
*/
?>