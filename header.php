<?php
include_once("database.php");
include_once("Utils.php");

session_start();
if(!isset($_SESSION['group'])) {
    $_SESSION['group'] = 'Michael';
}
if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = Utils::generateRandomString(32);
}
?>