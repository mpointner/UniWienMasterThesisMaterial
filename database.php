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

}