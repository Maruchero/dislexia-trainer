<?php
require_once("../view/ViewAttempts.php");

if (!isset($_POST["mode"])) die("Missing parameter 'mode'");

switch ($_POST["mode"]) {

  case 'get_attempts':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    $username = $_POST["username"];
    echo ViewAttempts::get_attempts($username);
    break;
}
