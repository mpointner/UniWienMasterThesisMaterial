# Wiederholungen

Oft ist es beim Programmieren notwendig etwas zu wiederholen.
Zum Beispiel ein Zähler von 1 bis 100 ist ohne Wiederholung sehr mühsam:

```kotlin
println(1)
println(2)
println(3)
...
println(99)
println(100)
```

Deswegen schau wir uns jetzt an wie man Code wiederholen kann.
In der Informatik sagt man zu einem Wiederholungsblock "Schleife".

## While: Wiederhole, solange Bedingung zutrifft

```kotlin
while (solange_dies_zutrifft) {
    // Wird wiederholt, solange Bedingung zutrifft
}
```

Als abstraktes Beispiel:
```kotlin
while (Batterie_ist_leer == false && Uhr_ist_eingeschalten == true) {
    Bewege_Sekundenzeiger_einen_Schritt_weiter
    Spiele_Tick_Ton_ab
    Warte_1_Sekunde
}
```
In diesem Beispiel würde der Inhalt der While-Wiederholung nur dann und 
solange die Bedingung zutrifft wiederholt ausgeführt werden.
<!--
Hierbei muss man aufpassen, dass die Bedingung auch irgendwann mal nicht mehr erfüllt wird, 
damit auch irgendwann Code nach der While-Schleife ausgeführt werden kann.
In dem vorherigen Beispiel muss die Bedingung erfüllt sein, damit der Inhalt der `while`-Schleife wiederholt ausgeführt wird.
Es gibt jedoch auch die `do while`-Schleife, wo die Bedingung am Ende ist und damit der Inhalt mindestens einmal ausgeführt wird:

```kotlin
do { // Zumindest ein Durchlauf
    
} while (solange_dies_zutrifft)
```
-->
## For: Für Abfolgen und Listen

Zurückkommend auf das Beispiel zu Beginn der Seite ... 
Für Abfolgen, wo man einen Zähler braucht, eignet sich noch besser als die `while`-Schleife die `for`-Schleife.
Die Syntax der Bedingung der `for`-Schleife besteht aus zwei Teilen getrennt durch ein `in`: 
* Variablenname (erhält immer den aktuellen Wert des Schleifendurchlaufes)
* Abfolge/Liste mit den durchlaufenen Werten, z.B. 1 bis 9 (geschrieben als `1..9`)

### ..-Abfolge

Für aufsteigende Abfolgen eignet sich die `..`-Abfolge mit folgender Syntax: `start..ende` (start und ende inklusive):
```kotlin
for (i in 1..9) { // inklusive 9
    print("$i ")
}
```
```
1 2 3 4 5 6 7 8 9 
```

### until-Abfolge

Wenn das Ende exkludiert werden soll, kann man entweder `start..(ende-1)` oder `start until ende` verwenden:
```kotlin
for (i in 1 until 10) { // ohne 10 (gleich wie 1..9)
    print("$i ")
}
```
```
1 2 3 4 5 6 7 8 9 
```

### downTo-Abfolge

Absteigende Folgen kann man mit `downTo` realisieren.
Mit `step` kann man die Schrittweite verändern (kann auch mit `..` oder `until` kombiniert werden), ohne ist sie standardmäßig `1`.
```kotlin
for (i in 9 downTo 1 step 2) { // von 9 nach 1 runter mit 2-Schrittweit: 
    print("$i ")
}
```
```
9 7 5 3 1 
```

## Aufgabe: Happy New Year Countdown
Schreibe einen Countdown für nächstes Silvester.
Der Countdown soll von `10` nach `1` runderzählen, verwende dazu die `downTo-Abfolge`.
Normalerweise würde ein Countdown nach jeder Zahl eine Sekunde warten, 
dies ist in dieser Online-Kotlin-Umgebung aber leider technisch nicht möglich.
Gib am Ende einen Neu-Jahrs-Spruch aus und schieß ein Feuerwerk in den Himmel über Wien.
Du kannst das machen, indem du den Befehl `feuerwerk()` verwendest.


