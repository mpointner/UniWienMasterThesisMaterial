# Verzweigungen

![](/images/Verzweigung.jpg)

Mit `if` (und optional als zweiten Ast `else`) kann man Verzweigungen programmieren.
Das ist wie, wenn du bei einem Weg vor einer Kreuzung stehst und dich abhängig von dem Wegweiser für den rechten oder den linken Weg entscheiden musst.
Beim Kotlin funktioniert das wie folgt:

`if (`Bedingung`) {`Bedingung-Wahr-Pfad`} else {`Bedingung-Falsch-Pfad`}`

Nimm an du bis auf der Autobahn vor einer Ausfahrt und das Schild zeigt "Linz" an. Abhängig davon, ob dein Ziel Linz ist, würdest du jetzt abfahren, sonst gerade weiterfahren:

`if (ausfahrt == "Linz") { abfahren } else { weiterfahren }`

Beachte die runden Klammern `()` um die Bedingung, die geschwungenen Klammern `{}` um die Pfade und das doppelte Gleichheitszeichen `==` zum Vergleichen.

## Vergleichs-Operatoren

Für die Bedingung gibt es noch weitere Vergleichsoperatoren:

* `==` gleich, z.B.: `if (x == y) { ... }`
* `!=` ungleich, z.B.: `if (x != y) { ... }`
* `>` größer, z.B.: `if (x > y) { ... }`
* `>=` größer gleich, z.B.: `if (x >= y) { ... }`
* `<` kleiner, z.B.: `if (x < y) { ... }`
* `<=` kleiner gleich, z.B.: `if (x <= y) { ... }`

Hier ein Beispiel dazu:

```kotlin
var note = readInt("Gibt deinen Schularbeitsnote ein:")

if (note <= 4) {
    println("Bestanden")
} else {
    println("Nicht bestanden")
}
```

Wie du hier siehst, hat nur der `if`-Pfad eine Bedingung und der `else`-Pfad wird ausgeführt, wenn die Bedingung für den `if`-Pfad NICHT zutrifft.

## Aufgabe: Passwort

![](/images/Passwort.jpg)

Schreibe ein Programm, dass eine Passworteingabe überprüft. Als Hilfestellung ist `var passwort: String = readString("Passwort eingeben:")` bereits vorgegeben.
Überprüfe, ob das Passwort mit `"geheim"` übereinstimmt. Wenn ja, soll `"Eingeloggt"` ausgegeben werden, sonst `"Falsches Passwort"`.
Die geschwungenen Klammern `{}` kannst du mit `alt gr + 7` bzw. `alt gr + 0` machen.



