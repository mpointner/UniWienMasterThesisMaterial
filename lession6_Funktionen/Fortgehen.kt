// Hier kommt deine Funktionsdefinition hin:


fun main() {
    var budget: Double = readDouble("Wie viel Euro hast du im Geldbörserl?")
    var eintritt: Double = readDouble("Wie viel Euro ist der Eintritt?")
    var getraenkPreis: Double = readDouble("Wie viel Euro kostet dein Lieblingsgetränk?")

    var getraenkAnzahl =  // <- hier fehlt noch dein Funktionsaufruf

    println("Juhu, du kannst dir ${getraenkAnzahl.aufGanzeAbrunden()}x dein Lieblingsgetränk leisten!")
}