fun main() {
    var budget: Double = readDouble("Wie viel Euro hast du im Geldbörserl?")
    var eintritt: Double = readDouble("Wie viel Euro ist der Eintritt?")
    var getraenkPreis: Double = readDouble("Wie viel Euro kostet dein Lieblingsgetränk?")

    var getraenkAnzahl = 0.0 // Ersetze 0.0 durch deinen Funktionsaufruf.

    println("Juhu, du kannst dir ${getraenkAnzahl.aufGanzeAbrunden()} Gläser/Dose/Flaschen von deinem Lieblingsgetränk leisten!")
}