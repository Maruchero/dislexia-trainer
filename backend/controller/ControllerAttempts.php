<?php
require_once("../view/ViewAttempts.php");

if (!isset($_POST["mode"])) die("Missing parameter 'mode'");

switch ($_POST["mode"]) {

  case 'get_attempts':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    $username = $_POST["username"];
    echo ViewAttempts::get_attempts($username);
    break;

  case 'create_attempt':
    if (!isset($_POST["idAttempt"])) die("Missing parameter 'idAttempt'");
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    if (!isset($_POST["idText"])) die("Missing parameter 'idText'");
    if (!isset($_POST["dateAttempt"])) die("Missing parameter 'dateAttempt'");
    if (!isset($_POST["time_elapsed"])) die("Missing parameter 'time_elapsed'");
    if (!isset($_POST["passed"])) die("Missing parameter 'passed'");

    $idAttempt = $_POST["idAttempt"];
    $username = $_POST["username"];
    $idText = $_POST["idText"];
    $dateAttempt = $_POST["dateAttempt"];
    $time_elapsed = $_POST["time_elapsed"];
    $passed = $_POST["passed"];

    echo ViewAttempts::create_attempt($idAttempt, $username, $idText, $dateAttempt, $time_elapsed, $passed);
    break;
}
