
const searchStart = "//replaceWithStart";
const searchEnd = "//replaceWithEnd";

function logExtern(task, code, errorsAndWarnings, output) {
    console.log("logExtern", task, code, errorsAndWarnings, output);

    if(code.includes(searchStart) && code.includes(searchEnd))
    code = code.substring(
        code.lastIndexOf(searchStart) + searchStart.length + 1,
        code.lastIndexOf(searchEnd) - 1
    );

    var http = new XMLHttpRequest();
    http.onload = () => {

        // print JSON response
        if (http.status >= 200 && http.status < 300) {
            // parse JSON
            //const response = JSON.parse(http.responseText);
            console.log(http.responseText);
        }
    };
    var url = 'log.php';
    const json = {
        "task": task,
        "code": code,
        "errors": errorsAndWarnings,
        "output": output
    };
    var params = JSON.stringify(json);
    http.open('POST', url, true);

//Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/json');
    http.send(params);
}

function mapErrors(errorsAndWarnings) {
    console.log("mapErrors");
    console.log(errorsAndWarnings);
    return errorsAndWarnings;
}