<?php
namespace Controllers;
use MVC\Router;

class EventsController {
  public static function index(Router $router) {
    $router->render('admin/events/index', [
      'title' => 'Crear Evento'
    ]);
  }

  public static function create(Router $router) {
    $alerts = [];
    $router->render('admin/events/create', [
      'title' => 'Crear Evento',
      'alerts' => $alerts
    ]);
  }
}