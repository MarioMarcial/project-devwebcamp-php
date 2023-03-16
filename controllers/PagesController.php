<?php
namespace Controllers;
use MVC\Router;

class PagesController {
  public static function index(Router $router) {
    $router->render('pages/index', [
      'title' => 'Inicio'
    ]);
  }
  public static function Event(Router $router) {
    $router->render('pages/devwebcamp', [
      'title' => 'Sobre DevWebCamp'
    ]);
  }
  public static function Packs(Router $router) {
    $router->render('pages/packs', [
      'title' => 'Paquetes DevWebCamp'
    ]);
  }
  public static function Conferences(Router $router) {
    $router->render('pages/conferences', [
      'title' => 'Workshops & Conferencias'
    ]);
  }
}
?>