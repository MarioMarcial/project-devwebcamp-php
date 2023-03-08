<?php
namespace Controllers;

use Model\Speaker;
use MVC\Router;

class SpeakersController {
  public static function index(Router $router) {
    
    $router->render('admin/speakers/index', [
      'title' => 'Ponentes / Conferencistas'
    ]);
  }

  public static function create(Router $router) {
    $alerts = [];
    $speaker = new Speaker;
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $speaker->sync();

      // validate
      $alerts = $speaker->validate();
    }
    $router->render('admin/speakers/create', [
      'title' => 'Registrar Ponente',
      'alerts' => $alerts,
      'speaker' => $speaker
    ]);
  }
}