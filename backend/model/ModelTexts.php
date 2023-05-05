<?php
require_once("../connect.php");

class ModelTexts {
  private $conn;

  public function __construct($connection) {
    $this->conn = $connection;
  }

  public function get_all() {
    $query = "SELECT * FROM texts";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function get_by_level($level) {
    $query = "SELECT * FROM texts WHERE level=:level ORDER BY idText ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':level', $level);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }
}
