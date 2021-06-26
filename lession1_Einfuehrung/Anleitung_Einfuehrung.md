# Willkommen in unserem Kotlin-Programmierkurs

In unserem Kurs lernen wir heute Kotlin zu programmieren.
Kotlin ist eine der modernsten Programmiersprachen und sehr einfach zu lernen.

Zuerst einmal, jedes Programm braucht einen Einstiegspunkt.
Bei der Programmiersprache Kotlin ist das die `main` Funktion.
Was Funktionen sind lernen wir später, nimm das bitte fürs erste mal als einen Programmteil hin.
Die `main` Funktion wird folgendermaßen geschrieben:

```kotlin
fun main() {
    
}
```

`fun` weil Kotlin Spaß macht ;)
Stimmt nur zum Teil, Kotlin macht natürlich Spaß, `fun` steht in dem Fall aber für Funktion.
Nach dem Namen `main` folgen dann zwei runde Klammern `()` und geschwungene Klammern `{}` wo unser Programmiercode reinkommt.
Genug des theoretischen jetzt wollen wir mal etwas ausgeben.
Die Funktion `print()` schreibt den Inhalt zwischen den runden Klammern auf den Bildschirm, z.B.: `print(1)` gibt die Zahl `1` aus.
Wenn man Text ausgeben will, muss man den Text unter Anführungszeichen setzen, also `print("Dies ist ein Text")`.

```kotlin
fun main() {
    print("Hello World")
}
```
```
Hello World
```

## Programm starten

Bei den Aufgaben ist immer rechts ein Play-Button, mit dem du das Program starten kannst:

![](/images/Execute.gif)

Wenn du auch einen Zeilenumbruch am Ende einer Ausgabe machen willst (damit die nächste Ausgabe in einer neuen Zeile ist), kannst du das mit `println` (`ln` als Abkürzung für `line`; kleines L und kleines N):

```kotlin
fun main() {
    println("Hello World")
    println("Hello Vienna")
}
```

ergibt:

```
Hello World
Hello Vienna
```

Jeder Befehl muss dabei in einer eigenen Zeile stehen.

## Aufgabe: Hallo + dein Name

Gib auf dem Bildschirm `Hallo + deinen Namen` aus, z.B.:

```
Hallo Thomas
```

Denke daran, wie den vorherigen Beispielen `print()` oder `println()` zu verwenden.
