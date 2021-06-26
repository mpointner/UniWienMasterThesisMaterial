

# 2-dimensionale Arrays

Spielen wir wieder ein Spiel :)

Um TikTakToe spielen zu können brauchen wir eine Matrix als Spielfeld.
In Kotlin (und den meisten anderen Programmiersprachen) besteht eine Matrix aus einem 2-dimensionalen Array.

Die Syntax zur Erstellung eines zweidimensionalen Arrays mag ein bisschen schwer verständlich sein,
nimm das bitte einfach mal so hin, du musst es nicht verstehen, da es fürs Beispiel schon vorgegeben ist:

```kotlin
var array = Array<Array<DATENTYP>>(ANZAHLZEILEN) { Array<DATENTYP>(ANZAHLSPALTEN) {INITIALWERT} }
```

Auf einen Eintrag kannst du folgendermaßen zugreifen (Zeile und Spalte einsetzen):

```kotlin
array[zeile][spalte]
```

Zeile und Spalte beginnt hier genauso wie bei 1-dimensionen Arrays mit 0 zum Zählen.

Du kannst mit 2-dimensionalen Arrays genauso programmieren wie im BubbleSort Beispiel, hier ein Beispiel:

```kotlin
var array = Array<Array<String>>(3) { Array<String>(3) {""} } // Initialisierung einer 3x3 Matrix, gefüllt mit ""

array[0][1] = "X" // Zeile 0 Spalte 1 Wert "X" zuweisen

println(array[2][0]) // Zeile 2 Spalte 0 Wert ausgeben

if(array[0][0] == "X") {
    println("Feld (0|0) hat den Wert ${array[0][0]}")
}
```

## Boolean

Zum Kapitel Variablen müssen wir noch einen Datentyp nachholen, da wir ihn im TikTacToe-Beispiel brauchen werden.

Der Datentyp `Boolean` kann die Werte `true` (Wahr) oder `false` (Falsch) annehmen:

```kotlin
var x: Boolean = true
x = false

if(x == true) {
    println("Wahr")
}
if(x == false) {
    println("Falsch")
}
```

# Aufgabe: TikTakToe

Im folgenden TikTakToe-Beispiel fehlt ein wesentlicher Teil, die Gewinn-Abfrage.
Ergänze die fehlenden Stellen im Code:
