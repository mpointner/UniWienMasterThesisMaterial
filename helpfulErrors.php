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
    </style>
</head>
<body>
<?php
include_once("database.php");
$db = new MyDatabase();

$mappings = $db->getMappings();

//$groups = array("Probe", "Control", "Test");
$groups = array("Control", "Test");

$helpfulErrors = array();
echo 'Units: Minute:Seconds (Count)';
echo '<table>';
echo '<tr>';
echo '<th>HelpfulError</th>';
foreach($groups as $group) {
    echo '<th class="center">'.$group.'</th>';
    $helpfulErrors[$group] = $db->getHelpfulErrors($group);
}
echo '</tr>';

foreach ($mappings as $mapping) {
    echo '<tr>';
    echo '<td>'.$mapping["Name"].'</td>';
    foreach($groups as $group) {
        $list = $helpfulErrors[$group];

        $count = 0;
        foreach ($list as $error) {
            if(preg_match("/".$mapping["Regex"]."/", $error["HelpfulError"])) {
                $count++;
            }
        }
        if ($count > 0) {
            echo '<td class="center">'.$count.'</td>';
        } else {
            echo '<td class="center"> - </td>';
        }
    }
    echo '</tr>';
}

echo '</table>';

?>
</body>
</html>