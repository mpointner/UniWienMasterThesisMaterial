<?php
function printStats($groups, $solveTime, $mappings, $namesUserId, $namesDistinct) {
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

            tr:nth-child(even){backgnumber_format-color: #f2f2f2;}

            tr:hover {backgnumber_format-color: #ddd;}

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
        $sumSolveTime[$group] = array();
        $sumSolveTimeMedian[$group] = array();
        $sumSolveRuns[$group] = array();
        $sumSolveRunsMedian[$group] = array();
        $sumDivider[$group] = array();
        $occurrenceSum[$group] = array();
        foreach ($solveTime[$group] as $user => $errors) {
            echo '<th colspan="5" class="center">' . $user . '/' . $group . '</th>';
            $sumSolveTime[$group][$user] = 0;
            $sumSolveTimeMedian[$group][$user] = 0;
            $sumSolveRuns[$group][$user] = 0;
            $sumSolveRunsMedian[$group][$user] = 0;
            $sumDivider[$group][$user] = 0;
            $occurrenceSum[$group][$user] = 0;
        }
    }
    echo '</tr>';

    echo '<tr>';
    echo '<th class="line-header">&nbsp;</th>';
    $sumSolveTime = array();
    $sumSolveRuns = array();
    $sumDivider = array();
    foreach($groups as $group) {
        foreach ($solveTime[$group] as $user => $errors) {
            echo '<th class="center">Average Solve Time</th>';
            echo '<th class="center">Median Solve Time</th>';
            echo '<th class="center">Average # Runs needed to solve</th>';
            echo '<th class="center">Median # Runs needed to solve</th>';
            echo '<th class="center">Occurrence for # students</th>';
        }
    }
    echo '</tr>';

    foreach ($mappings as $mapping) {
        echo '<tr>';
        echo '<td class="line-header">'.$mapping["Name"].'</td>';
        foreach($groups as $group) {
            foreach ($solveTime[$group] as $user => $errors) {
                $list = $solveTime[$group][$user][$mapping["Name"]];
                if ($list && count($list) > 0) {
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
                    $seconds = $sumTime / count($list);
                    $runs = $sumRuns / count($list);
                    $sumSolveTime[$group][$user] += $seconds;
                    $sumSolveTimeMedian[$group][$user] += median($timeArray);
                    $sumSolveRuns[$group][$user] += $runs;
                    $sumSolveRunsMedian[$group][$user] += median($runArray);
                    $sumDivider[$group][$user] += 1;
                    $occurrenceSum[$group][$user] += count($list);
                    echo '<td class="center" title="' . $concatTime . '">' . number_format($seconds, 1, ',', '') . '</td>';
                    echo '<td class="center" title="' . $concatTime . '">' . number_format(median($timeArray), 1, ',', '') . '</td>';
                    echo '<td class="center" title="' . $concatRuns . '">' . number_format($runs, 1, ',', '') . '</td>';
                    echo '<td class="center" title="' . $concatRuns . '">' . number_format(median($runArray), 1, ',', '') . '</td>';
                    echo '<td class="center">' . count($list) . '</td>';
                } else {
                    echo '<td class="center" colspan="5"> - </td>';
                }
            }
        }
        echo '</tr>';
    }

    echo '<tr><th class="line-header">Total:</th>';
    foreach ($groups as $group) {
        foreach ($solveTime[$group] as $user => $errors) {
            $timeArrayTotal = array();
            $runArrayTotal = array();
            foreach ($mappings as $mapping) {
                $list = $solveTime[$group][$user][$mapping["Name"]];
                if ($list && count($list) > 0) {
                    foreach ($list as $time) {
                        $timeArrayTotal[] = $time->getTime();
                        $runArrayTotal[] = $time->getRun();
                    }
                }
            }
            echo '<th class="center">' . number_format(average($timeArrayTotal), 1, ',', '') . ' (' . number_format(standardabweichung($timeArrayTotal), 1, ',', '') . ')</th>';
            echo '<th class="center">' . number_format(median($timeArrayTotal), 1, ',', '') . '</th>';
            echo '<th class="center">' . number_format(average($runArrayTotal), 1, ',', '') . ' (' . number_format(standardabweichung($runArrayTotal), 3, ',', '') . ')</th>';
            echo '<th class="center">' . number_format(median($runArrayTotal), 1, ',', '') . '</th>';
            echo '<th class="center">';
            if($sumDivider[$group][$user] > 0) {
                echo number_format($occurrenceSum[$group][$user] / $sumDivider[$group][$user], 1, ',', '');
            }
            echo '</th>';
        }
    }
    echo '</tr>';



    echo '</table>';

    //$groupByStudent = array();


    foreach ($groups as $group) {
        echo '<h2>' . $group . '</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th class="center">#</th>';
        echo '<th class="center">ID</th>';
        echo '<th class="center">Average Solve Time</th>';
        echo '<th class="center">Standard derivation</th>';
        echo '<th class="center">Median Solve Time</th>';
        echo '<th class="center">Average Runs</th>';
        echo '<th class="center">Standard derivation</th>';
        echo '<th class="center">Median Runs</th>';
        echo '<th class="center">Count</th>';
        echo '</tr>';
        $i = 1;
        foreach ($solveTime[$group] as $user => $errors) {
            $timeArrayTotal = array();
            $runArrayTotal = array();
            foreach ($mappings as $mapping) {
                $list = $solveTime[$group][$user][$mapping["Name"]];
                if ($list && count($list) > 0) {
                    foreach ($list as $time) {
                        $timeArrayTotal[] = $time->getTime();
                        $runArrayTotal[] = $time->getRun();
                    }
                }
            }

            /*if($groupByStudent[$user] == null) {
                $groupByStudent[$user] = array();
            }

            $record = array();
            $record['user'] = $user;
            $record['name'] = $names[$user];
            $record['timeAverage'] = number_format(average($timeArrayTotal), 1, ',', '');
            $record['timeSDD'] = number_format(standardabweichung($timeArrayTotal), 1, ',', '');
            $record['timeMedian'] = number_format(median($timeArrayTotal), 1, ',', '');
            $record['runAverage'] = number_format(average($runArrayTotal), 1, ',', '');
            $record['runSDD'] = number_format(standardabweichung($runArrayTotal), 3, ',', '');
            $record['runMedian'] = number_format(median($runArrayTotal), 1, ',', '');
            $record['count'] = number_format($occurrenceSum[$group][$user] / $sumDivider[$group][$user], 1, ',', '');

            $groupByStudent[$user][$group] = $record;*/

            if(count($timeArrayTotal) > 0) {
                echo '<tr>';
                echo '<td class="center">' . $i . '</td>';
                echo '<td class="center">' . $user . '</td>';
                echo '<td class="center">' . number_format(average($timeArrayTotal), 1, ',', '') . '</td>';
                echo '<td class="center">' . number_format(standardabweichung($timeArrayTotal), 1, ',', '') . '</td>';
                echo '<td class="center">' . number_format(median($timeArrayTotal), 1, ',', '') . '</td>';
                echo '<td class="center">' . number_format(average($runArrayTotal), 1, ',', '') . '</td>';
                echo '<td class="center">' . number_format(standardabweichung($runArrayTotal), 3, ',', '') . '</td>';
                echo '<td class="center">' . number_format(median($runArrayTotal), 1, ',', '') . '</td>';
                echo '<td class="center">' . number_format(count($timeArrayTotal), 1, ',', '') . '</td>';
                echo '</tr>';
                $i++;
            }
        }
        echo '</table>';
    }

        echo '<h2>Vergleich</h2>';
        echo '<table>';
        echo '<tr>';
    foreach ($groups as $group) {
        echo '<th class="center">#</th>';
        echo '<th class="center">ID ('.$group.')</th>';
        echo '<th class="center">Average Solve Time</th>';
        echo '<th class="center">Standard derivation</th>';
        echo '<th class="center">Median Solve Time</th>';
        echo '<th class="center">Average Runs</th>';
        echo '<th class="center">Standard derivation</th>';
        echo '<th class="center">Median Runs</th>';
        echo '<th class="center">Count</th>';
    }
        echo '</tr>';

    $i = 1;
    foreach ($namesDistinct as $name) {
        echo '<tr>';
        foreach ($groups as $group) {
            $errors = $solveTime[$group][$name];
            if($errors != null) {
                $timeArrayTotal = array();
                $runArrayTotal = array();
                foreach ($mappings as $mapping) {
                    $list = $solveTime[$group][$name][$mapping["Name"]];
                    if ($list && count($list) > 0) {
                        foreach ($list as $time) {
                            $timeArrayTotal[] = $time->getTime();
                            $runArrayTotal[] = $time->getRun();
                        }
                    }
                }

                /*if($groupByStudent[$user] == null) {
                    $groupByStudent[$user] = array();
                }

                $record = array();
                $record['user'] = $user;
                $record['name'] = $names[$user];
                $record['timeAverage'] = number_format(average($timeArrayTotal), 1, ',', '');
                $record['timeSDD'] = number_format(standardabweichung($timeArrayTotal), 1, ',', '');
                $record['timeMedian'] = number_format(median($timeArrayTotal), 1, ',', '');
                $record['runAverage'] = number_format(average($runArrayTotal), 1, ',', '');
                $record['runSDD'] = number_format(standardabweichung($runArrayTotal), 3, ',', '');
                $record['runMedian'] = number_format(median($runArrayTotal), 1, ',', '');
                $record['count'] = number_format($occurrenceSum[$group][$user] / $sumDivider[$group][$user], 1, ',', '');

                $groupByStudent[$user][$group] = $record;*/

                echo '<td class="center">' . $i . '</td>';
                echo '<td class="center">' . $name . '</td>';
                echo '<td class="center">' . number_format(average($timeArrayTotal), 1, '.', '') . '</td>';
                echo '<td class="center">' . number_format(standardabweichung($timeArrayTotal), 1, '.', '') . '</td>';
                echo '<td class="center">' . number_format(median($timeArrayTotal), 1, '.', '') . '</td>';
                echo '<td class="center">' . number_format(average($runArrayTotal), 1, '.', '') . '</td>';
                echo '<td class="center">' . number_format(standardabweichung($runArrayTotal), 3, '.', '') . '</td>';
                echo '<td class="center">' . number_format(median($runArrayTotal), 1, '.', '') . '</td>';
                echo '<td class="center">' . number_format(count($timeArrayTotal), 1, '.', '') . '</td>';
            } else {
                echo '<td class="center">' . $i . '</td>';
                echo '<td class="center">' . $name . '</td>';
                echo '<td colspan="7"> - </td>';
            }
        }
        echo '</tr>';
        $i++;
    }
    echo '</table>';

    ?>
    </body>
    </html>
    <?php
}

function standardabweichung($arr) {
    $average = average($arr);

    if($average > 0) {
        $sum = 0;
        foreach ($arr as $value) {
            $diff = $value - $average;
            $sum = $diff * $diff;
        }
        $var = $sum / count($arr);
        return sqrt($var);
    } else {
        return 0;
    }
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
