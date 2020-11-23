import kotlinx.browser.window
import kotlin.math.roundToInt
import kotlin.random.Random

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
        window.prompt(error + " " + aufforderung)?.let {
            if(gueltigeEingaben.contains(it)) {
                return it
            } else {
                error = "Deine Eingabe ist ungültig, du musst einen der folgenden Werte eingeben: " + gueltigeEingaben.joinToString(", ")
            }
        }
    }
}

fun readFloat(aufforderung: String = ""): Float {
    var error = ""
    while (true) {
        window.prompt(error + " " + aufforderung)?.let {
            try {
                return it.toFloat()
            } catch (e: NumberFormatException) {
                error = "$it ist keine Float Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden und musst ein Punkt statt Komma verwenden!"
            }
        }
    }
}

fun readDouble(aufforderung: String = ""): Double {
    var error = ""
    while (true) {
        window.prompt(error + " " + aufforderung)?.let {
            try {
                return it.toDouble()
            } catch (e: NumberFormatException) {
                error = "$it ist keine Double Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden und musst ein Punkt statt Komma verwenden!"
            }
        }
    }
}

fun readInt(aufforderung: String = ""): Int {
    var error = ""
    while (true) {
        window.prompt(error + " " + aufforderung)?.let {
            try {
                return it.toInt()
            } catch (e: NumberFormatException) {
                error = "$it ist keine Int Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden!"
            }
        }
    }
}

fun readLong(aufforderung: String = ""): Long {
    var error = ""
    while (true) {
        window.prompt(error + " " + aufforderung)?.let {
            try {
                return it.toLong()
            } catch (e: NumberFormatException) {
                error = "$it ist keine Long Zahl, bitte probier es noch einmal! Du darfst keine Buchstaben verwenden!"
            }
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

