<?php
require_once("../connect.php");

class ModelAttempts {

  static function get_attempts($username) {
    global $conn;
    $query = "SELECT * FROM attempts WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }
}
