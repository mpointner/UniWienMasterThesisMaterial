<?php
if(isset($_POST["name"]) && isset($_POST["class"])) {
    $ausgabe = "";
    $finished = true;
    foreach ($_POST as $key => $value) {
        $ausgabe .= $key . ":\n" . str_replace("\r\n", "\n", $value) . "\n\n";
        if(strlen($value) <= 1) {
            $finished = false;
        }
    }

    file_put_contents("abgabe/".$_POST["class"]."-".$_POST["name"]."-".($finished ? 'finished' : 'draft')."-".uniqid(rand(), true).".txt", $ausgabe);
    if($finished) {
    ?>
    <div style="text-align: center">
        <h1>Du bist fertig :)</h1>
        <h1>Vielen Dank für deine Teilnahme!</h1>
        <img src="images/Awesome.jpg" height="600">
        <p>Du kannst die Seite nun schließen.</p>
    </div>
    <?php
    } else {
    ?>
    <div style="text-align: center">
        <h1>Tolle Zwischenabgabe, weiter so nächste Stunde! :)</h1>
        <img src="images/Awesome.jpg" height="600">
        <p>Dein Abgabe ist fürs nächste Mal aufgehoben, du kannst die Seite nun schließen und nächstes Mal dort fortfahren, wo du aufgehört hast.</p>
    </div>
    <?php
    }
} else {
    echo 'Etwas ist schiefgelaufen, zurück <a href="/">Startseite</a>.';
}
?>