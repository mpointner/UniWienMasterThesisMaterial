### Listen

Für noch komplexere Abfolgen muss man eine Liste erstellen:
```kotlin
var list = listOf(1, 7, 4)
for (element in list) {
    print("$element ")
}
```
```
1 7 4 
```

oder mit den Werten rechnen:
```kotlin
for (i in 1..5) {
    var i_squared = i * i
    print("$i_squared ")
}
```
```
1 4 9 16 25
```


## Aufgabe: 1x1
Stelle dir vor du hättest in der Volksschule schon programmieren können, 
wie leicht wäre dann das Aufschreiben der 1x1 Tabelle gewesen.
Genau das sollst du jetzt machen: Schreibe ein Programm, dass die 1x1-Matrix ausgibt:
```
1 2 3 4 5 6 7 8 9 
2 4 6 8 10 12 14 16 18 
3 6 9 12 15 18 21 24 27 
4 8 12 16 20 24 28 32 36 
5 10 15 20 25 30 35 40 45 
6 12 18 24 30 36 42 48 54 
7 14 21 28 35 42 49 56 63 
8 16 24 32 40 48 56 64 72 
9 18 27 36 45 54 63 72 81 
```
Tipp: Verschachtle zwei Schleifen wie eine russische Babuschka (zweite `for`-Schleife innerhalb der geschwungenen Klammern `{}` der ersten `for`-Schleife) und 
rechne dir die Multiplikation aus beiden Variablen (Variablen unterschiedlich benennen, z.B.: `i`, `j`) in einer eigenen Variable `multiplikation` aus.
Einen Zeilenumbruch am Ende einer Zeile (nach dem Ende der inneren `for`-Schleife) kannst du mittels `println("")` machen.

![](/images/Babuschka.jpg)