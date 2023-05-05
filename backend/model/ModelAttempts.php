<?php
require_once("../connect.php");

class ModelAttempts {
  private $conn;

  public function __construct($connection) {
    $this->conn = $connection;
  }

  public function get_attempts($username) {
    $query = "SELECT * FROM attempts WHERE username=:username ORDER BY dateAttempt ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function create_attempt($idAttempt, $username, $idText, $dateAttempt, $time_elapsed, $passed) {
    $query = "INSERT INTO attempts (idAttempt, username, idText, dateAttempt, time_elapsed, passed) 
              VALUES (:idAttempt, :username, :idText, :dateAttempt, :time_elapsed, :passed)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':idAttempt', $idAttempt);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':idText', $idText);
    $stmt->bindParam(':dateAttempt', $dateAttempt);
    $stmt->bindParam(':time_elapsed', $time_elapsed);
    $stmt->bindParam(':passed', $passed);
    $stmt->execute();
  }
}
