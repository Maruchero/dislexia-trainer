<?php
require_once("../connect.php");

class ModelUsers {

  static function create_user($username, $password, $name, $surname, $role) {
    global $conn;
    $query = "INSERT INTO users (username, password, name, surname, role) 
              VALUES ('$username', '$password', '$name', '$surname', '$role');";
    $data = mysqli_query($conn, $query);
    return $data;
  }

  static function get_user($username) {
    global $conn;
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
  }

  static function update_user($username, $password, $name, $surname) {
    global $conn;
    $query = "UPDATE users 
              SET password='$password', name='$name', surname='$surname'
              WHERE username='$username'";
    $data = mysqli_query($conn, $query);
    return $data;
  }

  static function delete_user($username) {
    global $conn;
    $query = "DELETE FROM users WHERE username='$username'";
    $data = mysqli_query($conn, $query);
    return $data;
  }
}
