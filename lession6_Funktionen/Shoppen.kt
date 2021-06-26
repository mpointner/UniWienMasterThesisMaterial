// Hier kommt deine Funktionsdefinition hin:


fun main() {
    var preis: Double = readDouble("Was kostet das Kleidungsstück?")
    var rabatt: Double = readDouble("Wie viel Prozent Rabatt ist auf das Kleidungsstück?")

    var aktionsPreis =  // <- hier fehlt noch dein Funktionsaufruf

    println("Das Kleidungsstück kostet an der Kasse ${aktionsPreis.formatiereDoubleAlsEuro()}")
}