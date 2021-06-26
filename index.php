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

$textareas = "";

function code($task, $path) {
    global $db, $textareas;
    $code = $db->loadLatestRunCode($task);
    echo '<a name="'.$task.'"></a>';
    echo '<code class="language-kotlin" task="'.$task.'" data-target-platform="js" folded-button="true" auto-indent="true" indent="4" lines="true" data-autocomplete="true">';

    /*if($code != null) {
include('util/Util.kt');
echo '//replaceWithStart
//sampleStart
'.$code.'
//sampleEnd
//replaceWithEnd';
    } else {*/
include('util/Util.kt');
echo '//replaceWithStart
//sampleStart
';
include($path);
echo '
//sampleEnd
//replaceWithEnd
';
//    }
    echo '</code>';
    $textareas .= '<a href="#'.$task.'">'.$task.'</a> (Dieses Feld wird automatisch befüllt. Wenn das Feld leer ist, hast du das Beispiel noch nicht gelöst/ausgeführt):<br><textarea id="textarea-'.$task.'" name="'.$task.'" class="form-control" style="width: 100%;">';
    if($code != null && strlen(trim($code)) > 0) { $textareas .= $code; }
    $textareas .= '</textarea><br>';
}
?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="playground.js"
            data-selector=".language-kotlin"></script>
    <script src="index.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="Shortcut Icon" href="https://kotlinlang.org/assets/images/favicon.ico" type="image/x-icon"/>
</head>
<body>

<?php
include_once("mappings.php");
?>

<div class="container">

    <p>Sollte das Einbetten nicht funktionieren, klicke auf folgenden Link: <br><a href="https://forms.office.com/Pages/ResponsePage.aspx?id=Fuo8hThoFkmBvJpdBAWMY0slE7BuXaNDsvYgwwQAx6ZUQVJXRkQyU08xUlMwNk5VRjA2NTA1WlhLSS4u" target="_blank">https://forms.office.com/Pages/ResponsePage.aspx?id=Fuo8hThoFkmBvJpdBAWMY0slE7BuXaNDsvYgwwQAx6ZUQVJXRkQyU08xUlMwNk5VRjA2NTA1WlhLSS4u</a></p>

    <iframe src="https://forms.office.com/Pages/ResponsePage.aspx?id=Fuo8hThoFkmBvJpdBAWMY0slE7BuXaNDsvYgwwQAx6ZUQVJXRkQyU08xUlMwNk5VRjA2NTA1WlhLSS4u" height="1400"></iframe>

    <form action="abgabe.php" method="POST">

    <?php angabe("Welcome.md"); ?>


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
    <?php code("Shoppen", "lession6_Funktionen/Shoppen.kt"); ?>
    <?php angabe("lession6_Funktionen/Anleitung_Funktionen2.md"); ?>
    <?php code("Fortgehen", "lession6_Funktionen/Fortgehen.kt"); ?>

    <?php /*
    <?php angabe("lession7_Sortieren/Anleitung_Sortieren.md"); ?>
    <?php code("Sortieren", "lession7_Sortieren/Sortieren.kt"); ?>
    */ ?>

    <?php angabe("lession7_Arrays/Anleitung_Sortieren.md"); ?>
    <?php code("Sortieren", "lession7_Arrays/Sortieren.kt"); ?>
    <?php angabe("lession7_Arrays/Anleitung_TikTakToe.md"); ?>
    <?php code("TikTakToe", "lession7_Arrays/TikTakToe.kt"); ?>




        <h1>Abgabe</h1>
        <p>Hier nochmal alle deine gelösten Beispiele zusammengefasst:</p>

        <?php echo $textareas; ?>

        <div class="submitBox">
            <span>Name: </span>
            <input type="text" name="name" required style="flex: 1;" class="form-control">
            <span>Klasse: </span>
            <input type="text" name="class" required style="flex: 1;" class="form-control">
            <input type="submit" value="Abgeben" class="btn btn-primary">
        </div>



    </form>

    <br/>
    <br/>
    <br/>


</div>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">

        <form>

            <h1>Du hast eine tolle Problemlösefähigkeit! :)</h1>

            <h5>Um besser zu verstehen, welche Fehlermeldungen dir bei der Lösung der Fehler geholfen haben, beantworte bitte einige Fragen zu den gerade erhaltenen Fehlermeldungen.</h5>

            <p>Welche der folgenden Fehlermeldungen hat Ihnen am meisten bei der Lösung des Problems geholfen (wähle mindestens 1 aus):</p>

            <div id="model-helpful-errors">

            </div>

            <input type="button" onclick="validateForm()" value="Absenden" style="width: 100%">

        </form>
    </div>

</div>

</body>
</html>