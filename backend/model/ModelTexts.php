<?php
require_once("../connect.php");

class ModelTexts {

  static function get_by_level($level) {
    global $conn;
    $query = "SELECT * FROM texts WHERE level='$level' ORDER BY idText ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }
}
