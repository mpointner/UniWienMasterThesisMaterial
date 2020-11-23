

## Logische Operatoren

Man kann mehrere Vergleiche auch kombinieren:

```kotlin
if (temperatur >= 25 && temperatur <= 35) {
    println("Angenehme Temperatur zum Baden im Freien")
} else {
    println("Ich bleib lieber drinnen, mir ist es zu kalt/heiß")
}
```

Hier wurde der UND-Operator `&&` (doppeltes Kaufmanns-Und) verwendet.
Es gibt auch den ODER-Operation `||` (doppelter Strich `alt gr+<` / `Option+7`).
Bei einer Mischung von UND- und ODER-Operatoren ist die höhere Bindefähigkeit von UND zu beachten (ähnlich Punkt-vor-Strich-Regel in Mathematik).

<!--
## Tipps und Tricks

```kotlin
var a: Int = 3
var b: Int = 2
var max = 0
if (a > b) {
    max = a
} else {
    max = b
}
println(max)
```

Wenn in beiden Pfaden die gleiche Variable (in dem Fall `max`) zugewiesen wird, 
kann man dies auch und spart sich damit den Startwert:

```kotlin
var a: Int = 3
var b: Int = 2
var max = if (a > b) {
    a
} else {
    b
}
println(max)
```

Wenn in der geschwungenen Klammer nur ein Befehl/Variable steht, kann man die Klammern auch weglassen. 
Zeilenumbrüche sind auch optional:

```kotlin
var a: Int = 3
var b: Int = 2
var max = if (a > b) a else b
println(max)
```
-->

## Aufgabe: Schere-Stein-Papier

![](/images/SchereSteinPapier.jpg)

Vervollständige das Schere-Stein-Papier Beispiel.
Zur Erleichterung sind die Werte `Schere`,`Stein`,`Papier` bereits in Variablen abgespeichert, also kannst du z.B. `ich` und `schere` auf Gleichheit überprüfen.
Beachte bei der Eingabe die Großschreibung der ersten Buchstabens.
Die Variablen selbst sind aber aus Konvention kleingeschrieben.

**Beachte folgende Fälle:**

<!--
|*Ich* (Zeile), *Computer* (Spalte)|    *Schere*   |    *Stein*    |    *Papier*   |
|:------------------:|:-------------:|:-------------:|:-------------:|
|      *Schere*       | Unentschieden |    Verloren   |    Gewonnen   |
|       *Stein*      |    Gewonnen   | Unentschieden |    Verloren   |
|      *Papier*      |    Verloren   |    Gewonnen   | Unentschieden |
-->

Gewonnen, wenn:

|*Ich* |*Computer*|
|:----:|:--------:|
|Schere|Papier    |
|Stein |Schere    |
|Papier|Stein     |

Verloren, wenn:

|*Ich* |*Computer*|
|:----:|:--------:|
|Schere|Stein     |
|Stein |Papier    |
|Papier|Schere    |

Unentschieden, wenn:

|*Ich* |*Computer*|
|:----:|:--------:|
|Schere|Schere    |
|Stein |Stein     |
|Papier|Papier    |

**Tipps / mögliche Lösungswege**
* Verkette if-else um der Reihe nach alle Fälle abzufragen:
```kotlin
if (...) { // Bedingung 1
    // Block wird ausgeführt, falls Bedingung 1 zutrifft
} else if (...) { // Bedingung 2
    // Block wird ausgeführt, falls Bedingung 1 NICHT zutrifft, aber Bedingung 2
} else {
    // Block wird ausgeführt, falls weder Bedingung 1 noch Bedingung 2 zutrifft
}
```
* Verknüpfe die Eingaben-Kombinationen von dir und dem Computer mit einem logischen UND sowie die einzelnen Gewinn-/Verlustsituationen mit einem logischen ODER, z.B.:
```kotlin
ich == schere && computer == papier || ich == stein && computer == schere || ...
```
* Vergiss nicht auf die "Unentschieden"-Situation. Diese kannst du ganz einfach prüfen, indem du die beiden Variablen `ich` und `computer` auf Gleichheit prüfst. 
Dies ist der leichteste Fall, fang am besten damit an, dann kannst du den Gewonnen- oder Verloren-Fall als `else`-Pfad nehmen.


<!--
## Größte Person

![](/images/Personen.jpg)

Schreibe ein Programm, dass überprüft, wer von dir und deinen beiden besten Freunden / Sitznachbarn am Größten ist.
Ändere dazu die Variablennamen/Aufforderung in `GroesstePerson.kt` auf die Namen deiner Freunde/Sitznachbarn und 
überprüfe mit `if` `else` wer von euch am Größten ist.
Beachte, dass du `if` `else` auch verschachteln oder verketten kannst, z.B.:
```kotlin
if (...) { // Bedingung 1
    // Block wird ausgeführt, falls Bedingung 1 zutrifft
    if (...) { // Bedingung 2
        // Block wird ausgeführt, falls auch Bedingung 2 zutrifft
    } else {
        // Block wird ausgeführt, falls Bedingung 2 NICHT zutrifft
    }
} else {
    // Block wird ausgeführt, falls Bedingung 1 NICHT zutrifft
    if (...) { // Bedingung 3
        // Block wird ausgeführt, falls Bedingung 3 zutrifft
    } else {
        // Block wird ausgeführt, falls Bedingung 3 NICHT zutrifft
    }
}
```

oder:
```kotlin
if (...) { // Bedingung 1
    // Block wird ausgeführt, falls Bedingung 1 zutrifft
} else if (...) { // Bedingung 2
    // Block wird ausgeführt, falls Bedingung 1 NICHT zutrifft, aber Bedingung 2
} else {
    // Block wird ausgeführt, falls weder Bedingung 1 noch Bedingung 2 zutrifft
}
```
-->



