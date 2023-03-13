<?php
namespace Controllers;

use Model\Day;
use MVC\Router;
use Model\Category;
use Model\Event;
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

    // New Event
    $event = New Event;
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $event->sync($_POST);
      $alerts = $event->validate();
      if(empty($alerts)) {
        $result = $event->save();
        if($result) {
          Event::setAlert('success', 'Evento Registrado');
          header('Refresh 2: /admin/eventos');
        }
      }
    }
    $alerts = Event::getAlerts();
    $router->render('admin/events/create', [
      'title' => 'Crear Evento',
      'alerts' => $alerts,
      'categories' => $categories,
      'days' => $days,
      'hours' => $hours,
      'event' => $event
    ]);
  }
}