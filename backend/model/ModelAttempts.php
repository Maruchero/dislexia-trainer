<?php
require_once("../connect.php");

class ModelAttempts {

  static function get_attempts($username) {
    global $conn;
    $query = "SELECT * FROM attempts WHERE username='$username' ORDER BY dateAttempt ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }

  static function create_attempt($idAttempt, $username, $idText, $dateAttempt, $time_elapsed, $passed) {
    global $conn;
    $query = "INSERT INTO attempts (idAttempt, username, idText, dateAttempt, time_elapsed, passed) 
              VALUES ('$idAttempt', '$username', '$idText', '$dateAttempt', '$time_elapsed', '$passed')";
    $data = mysqli_query($conn, $query);
    return $data;
  }
  
}
