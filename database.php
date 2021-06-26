<?php
class MyDatabase
{
    var $conn;

    function __construct() {
        $this->open();
    }

    function __destruct() {
        $this->close();
    }

    function open()
    {
        $servername = "localhost";
        $username = "kotlin_michael";
        $password = "medion2510";
        $dbname = "kotlin_logs";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function insertRun($task, $code, $output) {
        $stmt = $this->conn->prepare("INSERT INTO Run (Gruppe, User, Task, Time, Code, Output) VALUES (?, ?, ?, ?, ?, ?)");
        if($stmt != false) {
            $stmt->bind_param('ssssss', $_SESSION['group'], $_SESSION['user'], $task, date('Y-m-d H:i:s'), $code, $output);
            $stmt->execute();
            $id = $stmt->insert_id;
            $stmt->close();
            return $id;
        } else {
            echo "Insert failed";
        }
    }

    function insertError($runId, $startLine, $startColumn, $endLine, $endColumn, $severity, $className, $message, $category) {
        $stmt = $this->conn->prepare("INSERT INTO Error (RunId, StartLine, StartColumn, EndLine, EndColumn, Severity, ClassName, Message, Category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if($stmt != false) {
            $stmt->bind_param('iiiiissss', $runId, $startLine, $startColumn, $endLine, $endColumn, $severity, $className, $message, $category);
            $stmt->execute();
            $id = $stmt->insert_id;
            $stmt->close();
            return $id;
        } else {
            echo "Insert failed";
        }
    }

    function loadLatestRunCode($task) {
        $stmt = $this->conn->prepare("SELECT Code FROM Run WHERE User = ? AND Task = ? ORDER BY Time DESC LIMIT 1");
        $stmt->bind_param('ss', $_SESSION['user'], $task);
        $stmt->execute();
        $stmt->bind_result($code);
        $result = $stmt->fetch();
        if($result) {
            $stmt->close();
            return $code;
        } else {
            $stmt->close();
            return null;
        }
    }

    function close() {
        if(isset($this->conn)) {
            $this->conn->close();
        }
    }

    function getTopErrorMessages() {
        $sql = "SELECT *, count(*) as Count FROM `Error` GROUP BY Message ORDER BY count(*) DESC";
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getRunsForMessage($message) {
        $sql = 'SELECT * FROM Error e LEFT JOIN Run r ON e.RunId = r.Id WHERE e.Message = "'.$message.'" LIMIT 10';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getErrorsForRun($runId) {
        $sql = 'SELECT * FROM Error e WHERE e.RunId = '.$runId;
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getMappings() {
        $sql = 'SELECT * FROM Mapping m';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getHelpfulErrors($group) {
        $sql = 'SELECT * FROM Questioner q WHERE Gruppe = "'.$group.'"';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function insertQuestioner($task, $date, $helpfulError) {
        $stmt = $this->conn->prepare("INSERT INTO Questioner (Gruppe, User, Task, Time, HelpfulError) VALUES (?, ?, ?, ?, ?)");
        if($stmt != false) {
            $stmt->bind_param('sssss', $_SESSION['group'], $_SESSION['user'], $task, $date, $helpfulError);
            $stmt->execute();
            $id = $stmt->insert_id;
            $stmt->close();
            return $id;
        } else {
            echo "Insert failed";
        }
    }

    function getSolveTimesForDate($date) {
        $sqlQuery = 'SELECT DISTINCT User FROM Run r WHERE DATE(r.Time) = "'.$date.'"';

        return $this->getSolveTimesForUserGroupInternal($sqlQuery);
    }

    function getSolveTimesForGruppe($gruppe) {
        $sqlQuery = 'SELECT DISTINCT User FROM Run r WHERE r.Gruppe = "'.$gruppe.'"';

        return $this->getSolveTimesForUserGroupInternal($sqlQuery);
    }

    function getStudentNamesUserIds() {
        $sql = 'SELECT UserId, Name FROM Student';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[$row['UserId']] = $row['Name'];
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getUserIdsStudentNames() {
        $sql = 'SELECT UserId, Name FROM Student WHERE Name != "Michael Pointner"';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[$row['Name']] = $row['UserId'];
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    function getStudentNamesDistinct() {
        $sql = 'SELECT DISTINCT Name FROM Student WHERE Name != "Michael Pointner"';
        $result = $this->conn->query($sql);

        $resultArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row['Name'];
            }
        } else {
            echo "0 results";
        }
        return $resultArray;
    }

    /**
     * @param array $mappings
     * @param $sqlQuery
     * @return array
     */
    public function getSolveTimesForUserGroupInternal($sqlQuery)
    {
        $mappings = $this->getMappings();

        $startTime = array();
        $solveTime = array();
        foreach ($mappings as $mapping) {
            $solveTime[$mapping["Name"]] = [];
        }
        $resultUsers = $this->conn->query($sqlQuery);
        if ($resultUsers->num_rows > 0) {
            // output data of each row
            while ($rowUsers = $resultUsers->fetch_assoc()) {
                $user = $rowUsers["User"];
                $runI = 0;
                //echo '<h4>'.$user.'</h4>';

                foreach ($mappings as $mapping) {
                    $startTime[$mapping["Name"]] = null;
                }

                $sqlQuery = 'SELECT * FROM Run r WHERE r.User = "' . $user . '" ORDER BY Time ASC';
                $resultRuns = $this->conn->query($sqlQuery);
                if ($resultRuns->num_rows > 0) {
                    // output data of each row
                    while ($rowRuns = $resultRuns->fetch_assoc()) {
                        $runId = $rowRuns["Id"];
                        $time = $rowRuns["Time"];

                        //echo '<p>'.$time.'</p>';

                        $errorFound = array();
                        foreach ($mappings as $mapping) {
                            $errorFound[$mapping["Name"]] = false;
                        }

                        $sqlErrors = 'SELECT * FROM Error e WHERE e.RunId = "' . $runId . '"';
                        $resultErrors = $this->conn->query($sqlErrors);
                        if ($resultErrors->num_rows > 0) {
                            while ($rowErrors = $resultErrors->fetch_assoc()) {
                                $message = $rowErrors["Message"];

                                foreach ($mappings as $mapping) {
                                    if (preg_match("/" . $mapping["Regex"] . "/", $message)) {
                                        $errorFound[$mapping["Name"]] = true;
                                    }
                                }
                            }
                        }

                        foreach ($mappings as $mapping) {
                            if ($startTime[$mapping["Name"]] == null && $errorFound[$mapping["Name"]] == true) {
                                $startTime[$mapping["Name"]] = new X($time, $runI);
                            } else if ($startTime[$mapping["Name"]] != null && $errorFound[$mapping["Name"]] == false) {
                                $start = $startTime[$mapping["Name"]];
                                $solve = strtotime($time) - strtotime($start->getTime());
                                $runs = $runI - $start->getRun();
                                //echo '<h3>'.$mapping["Name"].': '.$solve.' Seconds</h3>';
                                $solveTime[$mapping["Name"]][] = new X($solve, $runs);
                                $startTime[$mapping["Name"]] = null;
                            }
                        }

                        $runI++;
                    }
                }

            }
        } else {
            die("Cannot read users");
        }

        return $solveTime;
    }

    function getSolveTimesForUsersOfGroup($gruppe) {
        $sqlQuery = 'SELECT DISTINCT User FROM Run r WHERE r.Gruppe = "'.$gruppe.'"';

        return $this->getSolveTimesForUsersOfGroupInternal($sqlQuery);
    }

    public function getSolveTimesForUsersOfGroupInternal($sqlQuery)
    {
        $mappings = $this->getMappings();

        $userNames = $this->getStudentNamesUserIds();

        $startTime = array();
        $solveTime = array();
        $resultUsers = $this->conn->query($sqlQuery);
        if ($resultUsers->num_rows > 0) {
            // output data of each row
            while ($rowUsers = $resultUsers->fetch_assoc()) {
                $user = $rowUsers["User"];
                $userName = $userNames[$user];
                if ($userName == "Michael Pointner") {
                    continue;
                }
                if($userName == null) {
                    $userName = $user;
                }
                $runI = 0;
//                 $solveTime[$userName] = array();

                foreach ($mappings as $mapping) {
                    $startTime[$mapping["Name"]] = null;
                    //$solveTime[$user][$mapping["Name"]] = array();
                }

                $sqlQuery = 'SELECT * FROM Run r WHERE r.User = "' . $user . '" ORDER BY Time ASC';
                $resultRuns = $this->conn->query($sqlQuery);
                if ($resultRuns->num_rows > 0) {
                    // output data of each row
                    while ($rowRuns = $resultRuns->fetch_assoc()) {
                        $runId = $rowRuns["Id"];
                        $time = $rowRuns["Time"];

                        //echo '<p>'.$time.'</p>';

                        $errorFound = array();
                        foreach ($mappings as $mapping) {
                            $errorFound[$mapping["Name"]] = false;
                        }

                        $sqlErrors = 'SELECT * FROM Error e WHERE e.RunId = "' . $runId . '"';
                        $resultErrors = $this->conn->query($sqlErrors);
                        if ($resultErrors->num_rows > 0) {
                            while ($rowErrors = $resultErrors->fetch_assoc()) {
                                $message = $rowErrors["Message"];

                                foreach ($mappings as $mapping) {
                                    if (preg_match("/" . $mapping["Regex"] . "/", $message)) {
                                        $errorFound[$mapping["Name"]] = true;
                                    }
                                }
                            }
                        }

                        foreach ($mappings as $mapping) {
                            if ($startTime[$mapping["Name"]] == null && $errorFound[$mapping["Name"]] == true) {
                                $startTime[$mapping["Name"]] = new X($time, $runI);
                            } else if ($startTime[$mapping["Name"]] != null && $errorFound[$mapping["Name"]] == false) {
                                $start = $startTime[$mapping["Name"]];
                                $solve = strtotime($time) - strtotime($start->getTime());
                                $runs = $runI - $start->getRun();
                                //echo '<h3>'.$mapping["Name"].': '.$solve.' Seconds</h3>';
                                $solveTime[$userName][$mapping["Name"]][] = new X($solve, $runs);
                                $startTime[$mapping["Name"]] = null;
                            }
                        }

                        $runI++;
                    }
                }

            }
        } else {
            die("Cannot read users");
        }

        return $solveTime;
    }

}

class X {
    private $time;
    private $run;

    public function __construct($time, $run) {
        $this->time = $time;
        $this->run = $run;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getRun()
    {
        return $this->run;
    }
}

