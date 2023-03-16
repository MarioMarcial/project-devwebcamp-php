<?php
namespace Controllers;

use Model\Speaker;

class APISpeakers { 
  public static function index() {
    $speakers = Speaker::all();
    echo json_encode($speakers);
  }

  public static function speaker() {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$id || $id < 1) {
      echo json_encode([]);
      return;
    }
    $speaker = Speaker::find($id);
    echo json_encode($speaker, JSON_UNESCAPED_SLASHES);
  }
}

?>