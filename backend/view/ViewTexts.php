<?php
require_once("../model/ModelTexts.php");

class ViewTexts {
  static function get_by_level($level) {
    $data = ModelTexts::get_by_level($level);
    $json = json_encode($data);
    return $json;
  }
}
