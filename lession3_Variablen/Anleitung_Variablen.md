# Variablen

Um Werte zu speichern, verwenden wir Variablen (Schlüsselwort `var`).

Variablen können von verschieden Typen sein (welcher mit Doppelpunkt nach dem Namen angegeben wird, e.g. `x: Typ`):

- String (Zeichenkette: Zum Beispiel Wörter, Sätze, ...)
```kotlin
var x: String = "Hallo"
```

- Int (ganze Zahl)
```kotlin
var x: Int = 7
```

- Double (Kommazahl)
```kotlin
var x: Double = 3.14
```

Kotlin ist sehr intelligent und erkennt den Typ einer Variable automatisch, wenn du ihr einen Wert mit `=` zuweist:

```kotlin
var x = 3
println(x)
```

Wenn du Text zusammen mit Variablen verwenden willst, kannst du das mit einem `$` machen:
```kotlin
var wert = 1
var einheit = "m"
println("Ergebnis: $wert $einheit")
```

Mit Variablen kann man genauso wie mit Zahlen rechnen, z.B.:

```kotlin
var x = readInt("Bitte gib eine Zahl ein:")
var quadrat = x * x
println("Das Quadrat von $x ist $quadrat")
```

`readInt()` ist hierbei eine Hilfsfunktion, die dir von deiner Lehrperson bereitgestellt wird, um Eingaben zu erleichtern.
Der String `"Bitte gib eine Zahl ein:"` ist hierbei die Eingabe-Aufforderung, die im Browser geöffnet wird:

![](/images/alert.png)

## Aufgabe

Schreibe ein Programm, dass zwei Zahlen `a` und `b` zu `ergebnis` addiert und ausgibt `println(ergebnis)`.
Die Eingabe von `a` und `b` sind bereits vorgegeben.

**Tipp:** So manches kannst du dir vom letzten Beispiel abschauen.