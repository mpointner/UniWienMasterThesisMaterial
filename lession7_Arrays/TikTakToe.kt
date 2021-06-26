fun dreiInEinerReihe(array: Array&lt;Array&lt;String&gt;&gt;, zeichen: String): Boolean {
    // Hier fehlt noch dein Code:  Wenn 3 in einer Reihe (vertikal, horizontal oder diagonal sind, dann returniere true

    if(array[0][0] == zeichen && array[0][1] == zeichen && array[0][2] == zeichen) { // Beispielanfang erste Zeile
        return true
    }


    // Im Sonst-Fall wird false returniert
    return false
}

fun main() {
    var array = Array&lt;Array&lt;String&gt;&gt;(3) { Array&lt;String&gt;(3) {""} } // 3x3 Array mit "" als Werte

    while(freieFelder(array)) {
        readTikTakToeSpieler("Auf welches Feld möchtest du dein X setzen?", array)
        readTikTakToeComputer(array)

        if(dreiInEinerReihe(array, "X") == true) {
            println("Gewonnen!"+spielfeld(array))
            return // Beendet an dieser Stelle das Programm
        }

        // Hier fehlt der Verloren Fall (dreiInEinerReihe-Abfrage + Ausgabe)

    }
    // Hier fehlt die Unentschieden-Ausgabe

}