<?php
include_once("database.php");
$db = new MyDatabase();

$mappings = $db->getMappings();

echo '<body style="background: black; color: white;">';

$topErrors = $db->getTopErrorMessages();
foreach ($topErrors as $error) {
    echo "<h1>".$error["Message"]." (".$error["Count"].")</h1>";
    $runs = $db->getRunsForMessage($error["Message"]);
    echo '<div style="overflow: auto;">';
    echo '<div style="display:grid; grid-auto-flow: row; grid-template-columns: repeat(1000, 600px);">';
    foreach ($runs as $run) {
        $lines = explode("\n", $run["Code"]);
        $code = $run["Code"];
        $codeExploded = explode("\n", $code);
        $i = 1;
        echo '<div>';
        echo '<div style="overflow: auto; margin: 10px;">';
        echo '<div>';
        foreach($codeExploded as $line) {
            echo '<div style="display: grid; grid-auto-flow: row; grid-template-columns: auto 1fr;"><div style="user-select: none; color: gray; font-family: monospace; position: sticky; left: 0;">'.str_replace(" ", "&nbsp;", str_pad($i, 2," ", STR_PAD_LEFT)).'&nbsp;</div><div style="white-space: nowrap;"><pre style="margin: 0;">'.$line.'</pre></div></div>';
            $i = $i + 1;
        }
        echo '</div>';
        echo '</div>';
        echo '<br>';
        $errorsForRun = $db->getErrorsForRun($run["RunId"]);
        echo '<div style="display: grid; grid-auto-flow: row; grid-template-columns: auto auto 1fr;">';
        foreach ($errorsForRun as $efr) {
            echo '<div>';
            $found = false;
            foreach ($mappings as $mapping) {
                if(preg_match("/".$mapping["Regex"]."/", $efr["Message"])) {
                    echo '<span style="color: green;">✓</span>';
                    $found = true;
                }
            }
            if(!$found) {
                echo '<span style="color: red;">✗</span>';
            }
            echo '</div>';
            echo '<div style="user-select: none; color: gray; font-family: monospace; position: sticky; left: 0; white-space: nowrap;">'
                .$efr["StartLine"]
                .':'
                .$efr["StartColumn"]
                .'-'
                .$efr["EndLine"]
                .':'
                .$efr["EndColumn"]
                .'&nbsp;</div><div style="">'.$efr["Severity"].' '.$efr["Message"].'</div>';
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
}

echo '</body>';
?>