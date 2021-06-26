<?php
include_once("header.php");
$db = new MyDatabase();

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = (array) json_decode($json);



$group = $_SESSION['group'];
$user = $_SESSION['user'];
$task = $data['task'];
$helpfulErrors = (array) $data['helpfulErrors'];

$date = date('Y-m-d H:i:s');

foreach($helpfulErrors as $helpfulError) {
    $db->insertQuestioner($task, $date, $helpfulError);
}

?>