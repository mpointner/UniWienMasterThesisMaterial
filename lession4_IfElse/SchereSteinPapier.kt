fun main() {
    var schere: String = "Schere"
    var stein: String = "Stein"
    var papier: String = "Papier"

    var gueltigeEingaben = listOf(schere, stein, papier)

    var computer = gueltigeEingaben[Random.nextInt(0, 3)] // Wählt zufällt Schere, Stein oder Papier aus (den Code musst du nicht verstehen)
    var ich = readString("Deine Wahl eingeben (Schere, Stein, Papier):", gueltigeEingaben)

    println("Du hast $ich gewählt, Computer hat $computer gewählt!")
    // Ab hier fehlt noch dein Code

}