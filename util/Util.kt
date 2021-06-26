import kotlinx.browser.window
import kotlin.math.roundToInt
import kotlin.random.Random
import kotlin.js.Date

fun readString(aufforderung: String = ""): String {
    val response = window.prompt(aufforderung)
    response?.let {
        return it
    }
    return ""
}

fun readString(aufforderung: String = "", gueltigeEingaben: Collection&lt;String&gt;): String {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung)
        if(it == null) {
            return ""
        }
        if (gueltigeEingaben.contains(it)) {
            return it
        } else {
            error = "Deine Eingabe ist ungültig, du musst einen der folgenden Werte eingeben: " + gueltigeEingaben.joinToString(", ")
        }
    }
}

fun readFloat(aufforderung: String = ""): Float {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung)
        if(it == null) {
            return 0f
        }
        try {
            return it.toFloat()
        } catch (e: NumberFormatException) {
            error = "$it ist keine Float Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden und musst ein Punkt statt Komma verwenden!"
        }
    }
}

fun readDouble(aufforderung: String = ""): Double {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung)
        if(it == null) {
            return 0.0
        }
        try {
            return it.toDouble()
        } catch (e: NumberFormatException) {
            error = "$it ist keine Double Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden und musst ein Punkt statt Komma verwenden!"
        }
    }
}

fun readInt(aufforderung: String = ""): Int {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung)
        if(it == null) {
            return 0
        }
        try {
            return it.toInt()
        } catch (e: NumberFormatException) {
            error = "$it ist keine Int Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden!"
        }
    }
}

fun readLong(aufforderung: String = ""): Long {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung)
        if(it == null) {
            return 0L
        }
        try {
            return it.toLong()
        } catch (e: NumberFormatException) {
            error = "$it ist keine Long Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden!"
        }
    }
}

fun Double.formatiereDoubleAlsEuro(): String = ((this * 100).roundToInt() / 100.0).toString() + "€"

fun Double.aufGanzeAbrunden(): Int = this.toInt()

fun feuerwerk() {
    println("""
                                               .''.
           .''.      .        *''*    :_\/_:     .
          :_\/_:   _\(/_  .:.*_\/_*   : /\ :  .'.:.'.
      .''.: /\ :    /)\   ':'* /\ *  : '..'.  -=:o:=-
     :_\/_:'.:::.  | ' *''*    * '.\'/.'_\(/_'.':'.'
     : /\ : :::::  =  *_\/_*     -= o =- /)\    '  *
      '..'  ':::' === * /\ *     .'/.\'.  ' ._____
          *        |   *..*         :       |.   |' .---"|
            *      |     _           .--'|  ||   | _|    |
            *      |  .-'|       __  |   |  |    ||      |
         .-----.   |  |' |  ||  |  | |   |  |    ||      |
     ___'       ' /"\ |  '-."".    '-'   '-.'    '`      |____
    jgs~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      &                    ~-~-~-~-~-~-~-~-~-~   /|
     ejm97    )      ~-~-~-~-~-~-~-~  /|~       /_|\
            _-H-__  -~-~-~-~-~-~     /_|\    -~======-~
    ~-\XXXXXXXXXX/~     ~-~-~-~     /__|_\ ~-~-~-~
    ~-~-~-~-~-~    ~-~~-~-~-~-~    ========  ~-~-~-~
    """.trimIndent())
}

fun readTikTakToeSpieler(aufforderung: String = "", array: Array&lt;Array&lt;String&gt;&gt;) {
    var error = ""
    while (true) {
        val it = window.prompt(error + " " + aufforderung + spielfeld(array))
        if(it == null) {
            for(i in 0..8) {
                array[i/3][i%3] = "Z"
            }
            println("Eingabe abgebrochen!")
            return
        }
        val i = it.toUpperCase().first().toInt() - 65
        if (i &gt;= 0 && i &lt;= 8) {
            array[i/3][i%3] = "X";
            return
        } else {
            error = "Deine Eingabe ist ungültig, du musst einen der folgenden Werte eingeben: " +
                    (0..8).filter{array[it/3][it%3].trim()==""}.map{(it + 65).toChar()}.joinToString(", ") + "\n"
        }
    }
}

fun readTikTakToeComputer(array: Array&lt;Array&lt;String&gt;&gt;) {
    if(!freieFelder(array)) return

    // Gewinn-Fälle
    for(i in 0..2) {
        if(array[i][0] == "O" && array[i][1] == "O" && array[i][2] == "") { array[i][2] = "O"; return }
        if(array[i][0] == "O" && array[i][2] == "O" && array[i][1] == "") { array[i][1] = "O"; return }
        if(array[i][1] == "O" && array[i][2] == "O" && array[i][0] == "") { array[i][0] = "O"; return }
    }
    for(i in 0..2) {
        if(array[0][i] == "O" && array[1][i] == "O" && array[2][i] == "") { array[2][i] = "O"; return }
        if(array[0][i] == "O" && array[2][i] == "O" && array[1][i] == "") { array[1][i] = "O"; return }
        if(array[1][i] == "O" && array[2][i] == "O" && array[0][i] == "") { array[0][i] = "O"; return }
    }
    if(array[0][0] == "O" && array[1][1] == "O" && array[2][2] == "") { array[2][2] = "O"; return }
    if(array[0][0] == "O" && array[2][2] == "O" && array[1][1] == "") { array[1][1] = "O"; return }
    if(array[1][1] == "O" && array[2][2] == "O" && array[0][0] == "") { array[0][0] = "O"; return }

    if(array[0][2] == "O" && array[2][0] == "O" && array[1][1] == "") { array[1][1] = "O"; return }
    if(array[0][2] == "O" && array[1][1] == "O" && array[2][0] == "") { array[2][0] = "O"; return }
    if(array[2][0] == "O" && array[1][1] == "O" && array[0][2] == "") { array[0][2] = "O"; return }

    // Verteidigungs-Fälle
    for(i in 0..2) {
        if(array[i][0] == "X" && array[i][1] == "X" && array[i][2] == "") { array[i][2] = "O"; return }
        if(array[i][0] == "X" && array[i][2] == "X" && array[i][1] == "") { array[i][1] = "O"; return }
        if(array[i][1] == "X" && array[i][2] == "X" && array[i][0] == "") { array[i][0] = "O"; return }
    }
    for(i in 0..2) {
        if(array[0][i] == "X" && array[1][i] == "X" && array[2][i] == "") { array[2][i] = "O"; return }
        if(array[0][i] == "X" && array[2][i] == "X" && array[1][i] == "") { array[1][i] = "O"; return }
        if(array[1][i] == "X" && array[2][i] == "X" && array[0][i] == "") { array[0][i] = "O"; return }
    }
    if(array[0][0] == "X" && array[1][1] == "X" && array[2][2] == "") { array[2][2] = "O"; return }
    if(array[0][0] == "X" && array[2][2] == "X" && array[1][1] == "") { array[1][1] = "O"; return }
    if(array[1][1] == "X" && array[2][2] == "X" && array[0][0] == "") { array[0][0] = "O"; return }

    if(array[0][2] == "X" && array[2][0] == "X" && array[1][1] == "") { array[1][1] = "O"; return }
    if(array[0][2] == "X" && array[1][1] == "X" && array[2][0] == "") { array[2][0] = "O"; return }
    if(array[2][0] == "X" && array[1][1] == "X" && array[0][2] == "") { array[0][2] = "O"; return }

    // Random-Sonst
    var x = 0
    do {
        x = Random.nextInt(0, 9)
    } while(array[x/3][x%3] == "X" || array[x/3][x%3] == "O");
    array[x/3][x%3] = "O"
}

fun spielfeld(array: Array&lt;Array&lt;String&gt;&gt;): String {
    var output = StringBuilder()
    for(i in 0..2) {
        output.append("\n")
        for(j in 0..2) {
            if(array[i][j] == "X" || array[i][j] == "O") {
                output.append(array[i][j]+" ")
            } else {
                output.append((i*3+j+65).toChar()+" ")
            }
        }
    }
    return output.toString()
}

fun freieFelder(array: Array&lt;Array&lt;String&gt;&gt;): Boolean {
    var emptySpots = false
    for(i in 0..2) {
        for(j in 0..2) {
            if(array[i][j] != "X" && array[i][j] != "O" && array[i][j] != "Z") {
                emptySpots = true
            }
        }
    }
    return emptySpots
}
