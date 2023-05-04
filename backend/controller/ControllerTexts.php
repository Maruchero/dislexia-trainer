<?php
require_once("../view/ViewTexts.php");

if (!isset($_POST["mode"])) die("Missing parameter 'mode'");

switch ($_POST["mode"]) {

  case 'get_by_level':
    if (!isset($_POST["level"])) die("Missing parameter 'level'");
    $level = $_POST["level"];
    echo ViewTexts::get_by_level($level);
    break;
}
