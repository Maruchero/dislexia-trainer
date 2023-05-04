<?php
require_once("../model/ModelAttempts.php");

class ViewAttempts {

  static function get_attempts($username) {
    $data = ModelAttempts::get_attempts($username);
    $json = json_encode($data);
    return $json;
  }

  static function create_attempt($idAttempt, $username, $idText, $dateAttempt, $time_elapsed, $passed) {
    $data = ModelAttempts::create_attempt($idAttempt, $username, $idText, $dateAttempt, $time_elapsed, $passed);
    $json = json_encode($data);
    return $json;
  }
}
