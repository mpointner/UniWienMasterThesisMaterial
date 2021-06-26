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
$code = $data['code'];
$output = $data['output'];
$precodeLength = $data['precodeLength'];


$file_output = '<h3>'.$user.' '.$task.' '.date("Y-m-d H:i:s").'</h3>';
$file_output .= '<pre>'.$code.'</pre>';

$runId = $db->insertRun($task, $code, $output);

$errors = (array) $data['errors'];
foreach($errors as $errorRaw) {
    $error = (array) $errorRaw;
    $interval = (array) $error['interval'];
    $start = (array) $interval['start'];
    $startLine = $start['line'] - $precodeLength;
    $startColumn = $start['ch'];
    $end = (array) $interval['end'];
    $endLine = $end['line'] - $precodeLength;
    $endColumn = $end['ch'];
    $message = $error['message'];
    $severity = $error['severity'];
    $className = $error['className'];
    $imports = $error['imports'];

    $db->insertError($runId, $startLine, $startColumn, $endLine, $endColumn, $severity, $className, $message, null);

    $error_line = $startLine.':'.$startColumn.'-'.$endLine.':'.$endColumn.' '.$severity.' '.$className.' '.$message;
    $file_output .= '<pre>'.$error_line.'</pre>';
}

if($output != "") {
    $file_output .= '<pre>' . $output . '</pre>';
}




echo $file_output;


file_put_contents('errors.html', $file_output, FILE_APPEND);

?>