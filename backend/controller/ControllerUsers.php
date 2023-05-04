<?php
require_once("../view/ViewUsers.php");

if (!isset($_POST["mode"])) die("Missing parameter 'mode'");

switch ($_POST["mode"]) {

  case 'create_user':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    if (!isset($_POST["password"])) die("Missing parameter 'password'");
    if (!isset($_POST["name"])) die("Missing parameter 'name'");
    if (!isset($_POST["surname"])) die("Missing parameter 'surname'");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    echo ViewUsers::create_user($username, $password, $name, $surname);
    break;

  case 'get_user':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    $username = $_POST["username"];
    echo ViewUsers::get_user($username);
    break;

  case 'update_user':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    if (!isset($_POST["password"])) die("Missing parameter 'password'");
    if (!isset($_POST["name"])) die("Missing parameter 'name'");
    if (!isset($_POST["surname"])) die("Missing parameter 'surname'");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    echo ViewUsers::update_user($username, $password, $name, $surname);
    break;

  case 'delete_user':
    if (!isset($_POST["username"])) die("Missing parameter 'username'");
    $username = $_POST["username"];
    echo ViewUsers::delete_user($username);
    break;
}
