<?php
namespace Controllers;
use Model\Pack;
use Model\User;
use MVC\Router;
use Model\Register;

class DashboardController {
  public static function index(Router $router) {
    if(!is_admin()) {      
      header('Location: /login');
    }
    // Get the last registrations
    $registrations = Register::get(5);
    foreach ($registrations as $registration) {
      $registration->user = User::find($registration->user_id);
      $registration->pack = Pack::find($registration->pack_id);
    }

    $router->render('admin/dashboard/index', [
      'title' => 'Panel de Administración',
      'registrations' => $registrations
    ]);
  }
}