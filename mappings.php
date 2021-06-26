<script type="text/javascript">
<?php
include_once("database.php");
$db = new MyDatabase();

$mappings = $db->getMappings();

echo 'var mappings = {
';
foreach ($mappings as $mapping) {
    echo preg_replace("/[^A-Za-z]/", '', $mapping["Name"]).': 
    {
    regex: "'.str_replace("\\", "\\\\", $mapping["Regex"]).'",
    problem: "'.str_replace('"', '\"', $mapping["Problem"]).'", 
    solutionHint: "'.str_replace("\r\n", "<br>", str_replace('"', '\"', $mapping["Hint"])).'",
    example: "'.str_replace("\r\n", "<br>", str_replace('"', '\"', $mapping["Example"])).'", 
    link: "'.$mapping["Link"].'"
    }, 
    ';
}
echo '}
';
?>

var improvementEnabled = true;

var errorsSaved = {};

function mapErrors(errorsAndWarnings, code, task) {

    let errorsNoDuplicates = errorNoDuplicates(errorsAndWarnings);

    if(!improvementEnabled) {
        saveErrorsOrTriggerModal(errorsNoDuplicates, task);

        return errorsNoDuplicates;
    }

    let codeSplit = code.split('\n');

    const replaced = errorsNoDuplicates
        .map(error => {
        errorLine = "";
        if(error.interval != null &&
            error.interval.start != null && error.interval.start.line != null && error.interval.start.ch != null &&
            error.interval.end != null && error.interval.end.line != null && error.interval.end.ch != null) {
            errorLine += 'Line ' + (error.interval.start.line+1) + ':' + (error.interval.start.ch) + '-' + (error.interval.end.ch) +
                ': <span class="preerrorlocation">' + codeSplit[error.interval.start.line].substr(0, error.interval.start.ch) + '</span>';
            if (error.interval.start.line == error.interval.end.line) {
                errorLine += '<span class="errorlocation cm__red_wavy_line">' + codeSplit[error.interval.start.line].substr(error.interval.start.ch, error.interval.end.ch - error.interval.start.ch) + '</span>';
                errorLine += '<span class="preerrorlocation">' + codeSplit[error.interval.end.line].substr(error.interval.end.ch) + '</span>';
            } else {
                errorLine += '<span class="errorlocation cm__red_wavy_line">' + codeSplit[error.interval.start.line].substr(error.interval.start.ch) + '</span><br>';
                for(let i = error.interval.start.line+1; i < error.interval.end.line; i++) {
                    errorLine += '<span class="errorlocation cm__red_wavy_line">' + codeSplit[i] + '</span><br>';
                }
                errorLine += '<span class="errorlocation cm__red_wavy_line">' + codeSplit[error.interval.end.line].substr(0, error.interval.end.ch) + '</span>';
                errorLine += '<span class="preerrorlocation">' + codeSplit[error.interval.end.line].substr(error.interval.end.ch) + '</span>';
            }
        }

        let alreadyReplaced = false;
        Object.values(mappings).forEach(mapping => {
            if(!alreadyReplaced) {
                const errorOrg = `${error.message}`;
                const regex = mapping.regex;
                if (error.message.match(new RegExp(regex, "mi"))) {
                    error.improved = {};
                    error.improvedMessage = "";

                    const problem = mapping.problem;
                    const problemReplaced = errorOrg.replace(new RegExp(regex), problem);
                    if (problem != null && problem != "" && problemReplaced != errorOrg) {
                        error.improved.problem = '<div><b>Problem: </b>' + problemReplaced + '</div>';
                        error.improvedMessage += error.improved.problem;
                    }
                    const solutionHint = mapping.solutionHint;
                    const solutionHintReplaced = errorOrg.replace(new RegExp(regex), solutionHint);
                    if (solutionHint != null && solutionHint != "" && solutionHintReplaced != errorOrg) {
                        error.improved.solutionHint = '<div><b>Solution hint: </b>' + solutionHintReplaced + '</div>';
                        error.improvedMessage += error.improved.solutionHint;
                    }

                    const example = errorOrg.replace(new RegExp(regex), mapping.example);
                    if (example != null && example != "") {
                        error.improved.example = '<div style="display: flex; flex-direction: row;"><div><b>Example: </b></div><div style="flex: 1;"><pre>' + example + '</pre></div></div>';
                        error.improvedMessage += error.improved.example;
                    }

                    const link = mapping.link;
                    if (link != null && link != "") {
                        error.improved.link = '<div><a href="' + link + '" target="_blank">More information</a></div>';
                        error.improvedMessage += error.improved.link;
                    }

                    alreadyReplaced = true;
                }
            }
        })

        if (errorLine != "" && alreadyReplaced) {
            error.improved.location = '<div><b>Location: </b>' + errorLine + '</div>';
            error.improvedMessage += error.improved.location;
        }
        /*if(!alreadyReplaced) {
            error.message += '<br>No matching Regex found for "' + error.message + '"';
        }*/

        return error;
    });

    //saveErrorsOrTriggerModal(replaced, task);

    return replaced;
}

var modalShownForTask = "";

function saveErrorsOrTriggerModal(errorsAndWarningsNoDuplicates, task) {
    var errorsNoDuplicates = errorsAndWarningsNoDuplicates.filter(e => e.severity == "ERROR");
    if(errorsSaved[task] == undefined) {
        errorsSaved[task] = [];
    }
    console.log(errorsSaved);
    if(errorsNoDuplicates.length == 0 && errorsSaved[task].length > 0) {
        modalShownForTask = task;
        setTimeout(showModal, 1000);
    } else {
        errorsNoDuplicates.forEach(error => {
            console.log(error);
            errorsSaved[task].push(error);
        });
        console.log(errorsSaved)
    }
}

function showModal() {
    var iCheckbox = 0;
    var flags = {};
    $("#model-helpful-errors")[0].innerHTML = Object.values(errorsSaved[modalShownForTask])
        .filter(function(error) {
            if (flags[error.message]) {
                return false;
            }
            flags[error.message] = true;
            return true;
        })
        .map(error => {
            iCheckbox++;
            return '<div style="display: flex; align-items: center; margin-bottom: 10px;">' +
                '<input style="margin: 10px" id="Checkbox'+iCheckbox+'" name="helpfulErrors[]" value="'+error.message+'" type="checkbox" required><label for="Checkbox'+iCheckbox+'"><div class="test-fail orgMessage">'+error.message+'</div>' +
                ''+(error.improvedMessage != null ? error.improvedMessage : "")+'</label></div>';
    }).join("");


    $(document.body)[0].style.overflowY = 'hidden';
    $("#myModal")[0].style.display = "block";
}

function validateForm() {
    console.log("validateForm");
    let helpfulErrors = $('input[name="helpfulErrors[]"]').get();
    if (!helpfulErrors.some(e => e.checked)) {
        alert("Mindestens eine Checkbox muss angehackt werden");
    } else {
        let values = helpfulErrors.filter(e => e.checked).map(e => e.value);

        console.log(values);

        var http = new XMLHttpRequest();
        http.onload = () => {

            // print JSON response
            if (http.status >= 200 && http.status < 300) {
                // parse JSON
                //const response = JSON.parse(http.responseText);
                //console.log(http.responseText);
            }
        };
        var url = 'questioner.php';
        const json = {
            "task": modalShownForTask,
            "helpfulErrors": values
        };
        var params = JSON.stringify(json);
        http.open('POST', url, true);

//Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/json');
        http.send(params);

        errorsSaved[modalShownForTask] = [];

        $(document.body)[0].style.overflowY = '';
        $("#myModal")[0].style.display = "none";
    }
}

function errorNoDuplicates(errorsAndWarnings) {
    let errorsNoDuplicates = Object.values(errorsAndWarnings);
    let next = 0;
    for (let i = 0; i < errorsNoDuplicates.length - 1; i = next) {
        errorsNoDuplicates[i].ignore = false;
        next = i + 1;
        for (;
            next < errorsNoDuplicates.length &&
            errorsNoDuplicates[i].interval.start.line == errorsNoDuplicates[next].interval.start.line &&
            (
                errorsNoDuplicates[i].interval.end.ch == errorsNoDuplicates[next].interval.start.ch ||
                errorsNoDuplicates[i].interval.end.ch + 1 == errorsNoDuplicates[next].interval.start.ch
            ) &&
            errorsNoDuplicates[i].message == errorsNoDuplicates[next].message
            ; next++) {
            errorsNoDuplicates[i].interval.end.ch = errorsNoDuplicates[next].interval.end.ch;
            errorsNoDuplicates[next].ignore = true;
        }
    }
    errorsNoDuplicates = errorsNoDuplicates.filter(error => error.ignore != true);
    return errorsNoDuplicates;
}

</script>