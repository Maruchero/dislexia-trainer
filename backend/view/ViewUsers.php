<?php
require_once("../model/ModelUsers.php");

class ViewUsers {
  static function create_user($username, $password, $name, $surname) {
    $data = ModelUsers::create_user($username, $password, $name, $surname);
    $json = json_encode($data);
    return $json;
  }

  static function get_user($username) {
    $data = ModelUsers::get_user($username);
    $json = json_encode($data);
    return $json;
  }

  static function update_user($username, $password, $name, $surname) {
    $data = ModelUsers::update_user($username, $password, $name, $surname);
    $json = json_encode($data);
    return $json;
  }

  static function delete_user($username) {
    $data = ModelUsers::delete_user($username);
    $json = json_encode($data);
    return $json;
  }
}
