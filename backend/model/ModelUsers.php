<?php
require_once("../connect.php");

class ModelUsers {
  private $conn;

  public function __construct($connection) {
    $this->conn = $connection;
  }

  public function create_user($username, $password, $name, $surname) {
    $query = "INSERT INTO users (username, password, name, surname) 
              VALUES (:username, :password, :name, :surname)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->execute();
  }

  public function get_user($username) {
    $query = "SELECT * FROM users WHERE username=:username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function update_user($username, $password, $name, $surname) {
    $query = "UPDATE users 
              SET password=:password, name=:name, surname=:surname 
              WHERE username=:username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->execute();
  }

  public function delete_user($username) {
    $query = "DELETE FROM users WHERE username=:username";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
  }
}
