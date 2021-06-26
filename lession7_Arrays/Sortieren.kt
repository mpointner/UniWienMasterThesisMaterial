fun ausgabe(array: IntArray) {
    for(i in 0 until array.size) {
        print("${array[i]} ")
    }
    println("")
}

fun main() {
    var array = IntArray(10)
    for(i in 0 until array.size) {
        array[i] = Random.nextInt(0, 100)
    }
    println("Startzustand:")
    ausgabe(array) // Verwende diese Funktion um dir die Zwischenstände anzusehen
    // Ab hier fehlt dein Code




}