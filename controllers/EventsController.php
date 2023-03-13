<?php
namespace Controllers;

use Model\Day;
use MVC\Router;
use Model\Category;
use Model\Hour;

class EventsController {
  public static function index(Router $router) {
    $router->render('admin/events/index', [
      'title' => 'Crear Evento'
    ]);
  }

  public static function create(Router $router) {
    $alerts = [];
    $categories = Category::all('ASC');
    $days = Day::all('ASC');
    $hours = Hour::all('ASC');
  
    $router->render('admin/events/create', [
      'title' => 'Crear Evento',
      'alerts' => $alerts,
      'categories' => $categories,
      'days' => $days,
      'hours' => $hours
    ]);
  }
}