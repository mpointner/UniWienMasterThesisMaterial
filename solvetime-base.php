<?php
function printStats($groups, $solveTime, $mappings) {
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

    echo 'Units: Minute:Seconds (Count)';
    echo '<table>';
    echo '<tr>';
    echo '<th class="line-header">Error</th>';
    $sumSolveTime = array();
    $sumSolveTimeMedian = array();
    $sumSolveRuns = array();
    $sumSolveRunsMedian = array();
    $sumDivider = array();
    $occurrenceSum = array();
    foreach($groups as $group) {
        echo '<th colspan="5" class="center">'.$group.'</th>';
        $sumSolveTime[$group] = 0;
        $sumSolveTimeMedian[$group] = 0;
        $sumSolveRuns[$group] = 0;
        $sumSolveRunsMedian[$group] = 0;
        $sumDivider[$group] = 0;
        $occurrenceSum[$group] = 0;
    }
    echo '</tr>';

    echo '<tr>';
    echo '<th class="line-header">&nbsp;</th>';
    $sumSolveTime = array();
    $sumSolveRuns = array();
    $sumDivider = array();
    $latex = '\begin{tabular}{ l{0.2\textwidth}';
    foreach($groups as $group) {
        $latex .= ' c c c';
    }
    $latex .= '}<br>\hline<br>';
    foreach($groups as $group) {
        echo '<th class="center">Average Solve Time</th>';
        echo '<th class="center">Median Solve Time</th>';
        echo '<th class="center">Average # Runs needed to solve</th>';
        echo '<th class="center">Median # Runs needed to solve</th>';
        echo '<th class="center">Occurrence for # students</th>';
        $latex .= ' & Average Solve Time & Average/Median \# Runs needed to solve & Occurrence for \# students';
    }
    echo '</tr>';

    foreach ($mappings as $mapping) {
        echo '<tr>';
        echo '<td class="line-header">'.$mapping["Name"].'</td>';
        $latex .= '\\\\<br>\hline<br>' . $mapping["Name"];
        foreach($groups as $group) {
            $list = $solveTime[$group][$mapping["Name"]];
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
                $sumSolveTime[$group] += $seconds;
                $sumSolveTimeMedian[$group] += median($timeArray);
                $sumSolveRuns[$group] += $runs;
                $sumSolveRunsMedian[$group] += median($runArray);
                $sumDivider[$group] += 1;
                $occurrenceSum[$group] += count($list);
                echo '<td class="center" title="'.$concatTime.'">' . $seconds . '</td>';
                echo '<td class="center" title="'.$concatTime.'">' . median($timeArray) . '</td>';
                echo '<td class="center" title="'.$concatRuns.'">' . $runs . '</td>';
                echo '<td class="center" title="'.$concatRuns.'">' . median($runArray) . '</td>';
                echo '<td class="center">'.count($list).'</td>';

                $latex .= ' & ' . $seconds . ' & ' . $runs . ' & ' . count($list);
            } else {
                echo '<td class="center" colspan="5"> - </td>';
                $latex .= ' & - & - & - ';
            }
        }
        echo '</tr>';
    }

    /*echo '<tr><th class="line-header">Average:</th>';
    $latex .= '\\\\<br>\hline<br> Average: ';
    foreach($groups as $group) {
        if ($sumDivider[$group] > 0) {
            $averageTime = round($sumSolveTime[$group] / $sumDivider[$group]);
            $averageMedianTime = round($sumSolveTimeMedian[$group] / $sumDivider[$group]);
            $averageRuns = round($sumSolveRuns[$group] / $sumDivider[$group], 1);
            $averageMedianRuns = round($sumSolveRunsMedian[$group] / $sumDivider[$group], 1);
            $averageOccurrence = round($occurrenceSum[$group] / $sumDivider[$group], 1);
            echo '<th class="center">' . $averageTime . '</th>';
            echo '<th class="center">' . $averageMedianTime . '</th>';
            echo '<th class="center">' . $averageRuns . '</th>';
            echo '<th class="center">' . $averageMedianRuns . '</th>';
            echo '<th class="center">' . $averageOccurrence . '</th>';
            $latex .= ' & ' . date("i:s", $averageTime) . ' & ' . $averageRuns . ' & ';
        } else {
            echo '<th class="center" colspan="5"> - </th>';
        }

    }
    echo '</tr>';*/

    echo '<tr><th class="line-header">Total:</th>';
    foreach ($groups as $group) {
        $timeArrayTotal = array();
        $runArrayTotal = array();
        foreach ($mappings as $mapping) {
            $list = $solveTime[$group][$mapping["Name"]];
            if (count($list) > 0) {
                foreach ($list as $time) {
                    $timeArrayTotal[] = $time->getTime();
                    $runArrayTotal[] = $time->getRun();
                }
            }
        }
        echo '<th class="center">' . round(average($timeArrayTotal), 1) . ' (' . round(standardabweichung($timeArrayTotal), 1) . ')</th>';
        echo '<th class="center">' . round(median($timeArrayTotal), 1) . '</th>';
        echo '<th class="center">' . round(average($runArrayTotal), 1) . ' (' . round(standardabweichung($runArrayTotal), 3) . ')</th>';
        echo '<th class="center">' . round(median($runArrayTotal), 1) . '</th>';
        echo '<th class="center">' . round($occurrenceSum[$group] / $sumDivider[$group], 1) . '</th>';
    }
    echo '</tr>';



    echo '</table>';

    $latex .= '<br>\end{tabular}';



    echo '<br /><hr><br />';


    echo '<table>';

    foreach ($groups as $group) {
        echo '<tr>';
        echo '<th rowspan="2" class="center">'.$group.'</th>';

        echo '<th class="center">Solve Time</th>';
        foreach ($mappings as $mapping) {
            $list = $solveTime[$group][$mapping["Name"]];
            if (count($list) > 0) {
                foreach ($list as $time) {
                    echo '<td class="center">' . $time->getTime() . '</td>';
                }
            }
        }
        echo '</tr>';

        echo '<tr>';
        echo '<th class="center"># Runs</th>';
        foreach ($mappings as $mapping) {
            $list = $solveTime[$group][$mapping["Name"]];
            if (count($list) > 0) {
                foreach ($list as $time) {
                    echo '<td class="center">' . $time->getRun() . '</td>';
                }
            }
        }
        echo '</tr>';
    }

    echo '</table>';


    #$mapping = $mappings[0];
    #echo '<h1>' . $mapping["Name"] . '</h1>';
    foreach ($groups as $group) {
        echo '<table>';
        echo '<tr>';
        echo '<th class="center" colspan="2">' . $group . '</th>';
        echo '</tr>';
        foreach ($mappings as $mapping) {
            $list = $solveTime[$group][$mapping["Name"]];
            for($x = 0; $x < count($list); $x++) {
                echo '<tr>';
                echo '<td class="center">' . $list[$x]->getTime() . '</td>';
                echo '<td class="center">' . $list[$x]->getRun() . '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    }



    //echo '<pre>' . $latex . '</pre>';
    ?>
    </body>
    </html>
    <?php
}

function standardabweichung($arr) {
    $average = average($arr);

    $sum = 0;
    foreach ($arr as $value) {
        $diff = $value - $average;
        $sum = $diff * $diff;
    }
    $var = $sum / count($arr);
    return sqrt($var);
}

function average($arr){
    if($arr){
        return array_sum($arr)/count($arr);
    }
    return 0;
}

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
