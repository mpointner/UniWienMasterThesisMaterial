fun main() {
    val numbers = listOf("one", "two", "three", "four")

    val plusList = numbers.minus("five")
    val minusList = numbers - listOf("three", "four")
    println(plusList)
    println(minusList)
}