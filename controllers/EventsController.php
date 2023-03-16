<?php
namespace Controllers;

use Model\Day;
use Model\Hour;
use MVC\Router;
use Model\Event;
use Model\Speaker;
use Model\Category;
use Classes\Pagination;

class EventsController {
  public static function index(Router $router) {
    $current_page = $_GET['page'];
    $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
    if(!$current_page || $current_page < 1) {
      header('Location: /admin/eventos?page=1');
    }
    $per_page = 10;
    $total = Event::total();
    $pagination = new Pagination($current_page, $per_page, $total);
    if($current_page > $pagination->total_pages()) {
      header('Location: /admin/eventos?page=1');
    }
    // Get events
    $events = Event::paginate($per_page, $pagination->offset());

    foreach ($events as $event) {
      $event->category = Category::find($event->category_id);
      $event->day = Day::find($event->day_id);
      $event->hour = Hour::find($event->hour_id);
      $event->speaker = Speaker::find($event->speaker_id);
    }

    $router->render('admin/events/index', [
      'title' => 'Crear Evento',
      'events' => $events,
      'pagination' => $pagination->pagination()
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
          header('Refresh: 1; url = /admin/eventos');
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

  public static function edit(Router $router) {
    $alerts = [];
    // Get id
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$id || $id < 1) {
      header('Location: /admin/eventos');
    }
    $categories = Category::all('ASC');
    $days = Day::all('ASC');
    $hours = Hour::all('ASC');

    // New Event
    $event = Event::find($id);
    if(!$event) {
      header('Location: /admin/eventos');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $event->sync($_POST);
      $alerts = $event->validate();
      if(empty($alerts)) {
        $result = $event->save();
        if($result) {
          Event::setAlert('success', 'Evento Registrado');
          header('Refresh: 2; url = /admin/eventos/editar?id=' . $id);
        }
      }
    }
    $alerts = Event::getAlerts();
    $router->render('admin/events/edit', [
      'title' => 'Editar Evento',
      'alerts' => $alerts,
      'categories' => $categories,
      'days' => $days,
      'hours' => $hours,
      'event' => $event
    ]);
  }
}
?>