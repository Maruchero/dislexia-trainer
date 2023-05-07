<?php
require_once(__DIR__ . "\\..\\connect.php");

class ModelTexts {

  static function get_all() {
    global $conn;
    $query = "SELECT * FROM texts";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }

  static function get_by_level($level) {
    global $conn;
    $query = "SELECT * FROM texts WHERE level='$level' ORDER BY idText ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }
}
