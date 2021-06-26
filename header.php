<?php
include_once("database.php");
include_once("Utils.php");

session_start();
if(!isset($_SESSION['group'])) {
    $_SESSION['group'] = 'Control';
}
if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = Utils::generateRandomString(32);
}
?>
