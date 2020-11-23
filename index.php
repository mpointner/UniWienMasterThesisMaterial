<?php
include_once("header.php");
$db = new MyDatabase();

include_once("Parsedown.php");
$Parsedown = new Parsedown();

function angabe($path) {
    global $Parsedown;
    $content = file_get_contents($path);
    $parsed =  $Parsedown->text($content);
    $codeReplaced = str_replace('<code class="language-kotlin">', '<code class="language-kotlin" data-highlight-only>', $parsed);
    echo $codeReplaced;
}

function code($task, $path) {
    global $db;
    $code = $db->loadLatestRunCode($task);
    echo '<code class="language-kotlin" task="'.$task.'" data-target-platform="js" folded-button="false" auto-indent="true" indent="4" lines="true" data-autocomplete="true">';
    if($code != null) {
include('util/Util.kt');
echo '//replaceWithStart
//sampleStart
'.$code.'
//sampleEnd
//replaceWithEnd';
    } else {
include('util/Util.kt');
echo '//replaceWithStart
//sampleStart
';
include($path);
echo '
//sampleEnd
//replaceWithEnd
';
    }
    echo '</code>';
}
?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="playground.js"
            data-selector=".language-kotlin"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="Shortcut Icon" href="https://kotlinlang.org/assets/images/favicon.ico" type="image/x-icon"/>
</head>
<body>

<div class="container">

    <?php angabe("README.md"); ?>


    <?php angabe("lession1_Einfuehrung/Anleitung_Einfuehrung.md"); ?>
    <?php code("HelloWorld", "lession1_Einfuehrung/HelloWorld.kt"); ?>


    <zero-md src="lession2_Rechnen/Anleitung_Rechnen.md"></zero-md>
    <?php angabe("lession2_Rechnen/Anleitung_Rechnen.md"); ?>
    <?php code("Rechnen", "lession2_Rechnen/Rechnen.kt"); ?>


    <?php angabe("lession3_Variablen/Anleitung_Variablen.md"); ?>
    <?php code("Variablen", "lession3_Variablen/Variablen.kt"); ?>


    <?php angabe("lession4_IfElse/Anleitung_IfElse.md"); ?>
    <?php code("Passwort", "lession4_IfElse/Passwort.kt"); ?>
    <?php angabe("lession4_IfElse/Anleitung_IfElse2.md"); ?>
    <?php code("SchereSteinPapier", "lession4_IfElse/SchereSteinPapier.kt"); ?>


    <?php angabe("lession5_For/Anleitung_For.md"); ?>
    <?php code("HappyNewYear", "lession5_For/HappyNewYear.kt"); ?>
    <?php angabe("lession5_For/Anleitung_For2.md"); ?>
    <?php code("EinMalEins", "lession5_For/EinMalEins.kt"); ?>


    <?php angabe("lession6_Funktionen/Anleitung_Funktionen.md"); ?>
    <?php code("Fortgehen", "lession6_Funktionen/Fortgehen.kt"); ?>


    <?php angabe("lession6_Funktionen/Finish.md"); ?>

</div>
</body>
</html>