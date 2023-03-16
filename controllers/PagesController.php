<?php
namespace Controllers;
use Model\Day;
use Model\Hour;
use MVC\Router;
use Model\Event;
use Model\Speaker;
use Model\Category;

class PagesController {
  public static function index(Router $router) {
    $router->render('pages/index', [
      'title' => 'Inicio'
    ]);
  }
  public static function event(Router $router) {
    $router->render('pages/devwebcamp', [
      'title' => 'Sobre DevWebCamp'
    ]);
  }
  public static function packs(Router $router) {
    $router->render('pages/packs', [
      'title' => 'Paquetes DevWebCamp'
    ]);
  }

  public static function conferences(Router $router) {
    $events = Event::order('hour_id', 'ASC');
    $format_events = [];
    foreach($events as $event) {
      $event->category = Category::find($event->category_id);
      $event->day = Day::find($event->day_id);
      $event->hour = Hour::find($event->hour_id);
      $event->speaker = Speaker::find($event->speaker_id);

      if($event->day_id === "1" && $event->category_id === "1") {
        $format_events['friday_conferences'][] = $event;
      }

      if($event->day_id === "2" && $event->category_id === "1") {
        $format_events['saturday_conferences'][] = $event;
      }

      if($event->day_id === "1" && $event->category_id === "2") {
        $format_events['friday_workshops'][] = $event;
      }

      if($event->day_id === "2" && $event->category_id === "2") {
        $format_events['saturday_workshops'][] = $event;
      }
    }
    $router->render('pages/conferences', [
      'title' => 'Workshops & Conferencias',
      'events' => $format_events
    ]);
  }
}
?>