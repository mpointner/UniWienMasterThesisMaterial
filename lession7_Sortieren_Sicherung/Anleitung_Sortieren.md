# Sortieren

Ähnlich zu den in der Lektion zu Schleifen kurz angeschnittenen Listen gibt auch Arrays.
Arrays kannst du dir wie ein Regal vorstellen, wo je Fach/Etage genau ein Gegegenstand reinpasst.

![](/images/Regal.jpg)

Array werden wie folgt definiert:

```kotlin
var array = IntArray(10) // 10 ist die Anzahl der Fächer im Regal
```

Array-Fächer werden mit Zahlen von 0 beginnend durchnummeriert.
Wenn ich also einen Gegenstand in das Fach 0 legen will, kann ich das mit:

```kotlin
array[0] = 3 // Die Zahl ins 0te Fach legen
```

Gegenstand aus einem Fach herausnehmen:

```kotlin
var temp = array[0]
```

(Info für Fortgeschrittene: Inhalte werden nicht verschoben, sondern kopiert)

## Swap - Technik

Wenn du also zwei Fächer (bezeichnen wir sie mit `i` und `j`) tauschen willst, musst du 

- zuerst eins der Fächer freimachen und irgendwo ablegen: `var temp = array[i]`
- dann den Inhalt von Fach `j` ins freigewordene Fach `i` geben: `array[i] = array[j]`
- und abschließen den zwischengespeicherten Inhalt ins Fach `j` legen: `array[j] = temp`

## Aufgabe: Bubble Sort

Nutz diese Tausch-Technik um Bubble-Sort zu programmieren.

**Tipps:**

- Beginn damit Position 0 und 1 zu vergleich und bei `array[0] > array[1]` die beiden Fächer zu vertauschen.
- Dann kommt 1 und 2, 2 und 3, ...
- Wenn du bei der höchsten Position angekommen bist (`Größe - 1`), also bei `IntArray(10)` ist dies `9`, beginnst du wieder von vorne.
- Nach spätestens `Größe` Durchläufen, ist das Array sortiert.

**Für Fortschrittene:** Eigentlich reichen `Größe - 1` Durchläufe und nach jedem Durchlauf kann man oben immer eine Position weglassen, da dort bereit die höchste Zahl ist.

![](/images/BubbleSort.png)
