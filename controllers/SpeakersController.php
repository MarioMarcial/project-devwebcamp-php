<?php
namespace Controllers;
use MVC\Router;

class SpeakersController {
  public static function index(Router $router) {
    
    $router->render('admin/speakers/index', [
      'title' => 'Ponentes / Conferencistas'
    ]);
  }

  public static function create(Router $router) {
    $alerts = [];
    $router->render('admin/speakers/create', [
      'title' => 'Registrar Ponente',
      'alerts' => $alerts
    ]);
  }
}