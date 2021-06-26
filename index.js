const searchStart = "//replaceWithStart";
const searchEnd = "//replaceWithEnd";

var logEnabled = false;

function logExtern(task, code, errorsAndWarnings, output) {
    //console.log("logExtern", task, code, errorsAndWarnings, output);

    if(!logEnabled) {
        return;
    }

    var precodeLength = 0;

    if (code.includes(searchStart) && code.includes(searchEnd)) {
        const precode = code.substring(
            0,
            code.lastIndexOf(searchStart)
        );
        code = code.substring(
            code.lastIndexOf(searchStart) + searchStart.length + 1,
            code.lastIndexOf(searchEnd) - 1
        );
        precodeLength = precode.split(/\r\n|\r|\n/).length - 1;
    }


    $("#textarea-"+task).val(code);


    var http = new XMLHttpRequest();
    http.onload = () => {

        // print JSON response
        if (http.status >= 200 && http.status < 300) {
            // parse JSON
            //const response = JSON.parse(http.responseText);
            //console.log(http.responseText);
        }
    };
    var url = 'log.php';
    const json = {
        "task": task,
        "code": code,
        "errors": errorsAndWarnings,
        "output": output,
        "precodeLength": precodeLength
    };
    var params = JSON.stringify(json);
    http.open('POST', url, true);

//Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/json');
    http.send(params);
}
