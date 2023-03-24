<?php
namespace Controllers;

use Model\Pack;
use Model\User;
use MVC\Router;
use Model\Register;
use Classes\Pagination;

class RegisteredController {
  public static function index(Router $router) {
    if(!is_admin()) {
      header('Location: /');
    }
    // Pagination
    $current_page = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    if(!$current_page || $current_page < 1) {
      header('Location: /admin/registrados?page=1');
    }
    $records_per_page = 10;
    $total_records = Register::total();
    $pagination = new Pagination($current_page, $records_per_page, $total_records);
    if($current_page > $pagination->total_pages()) {
      header('Location: /admin/registrados?page=1');
    }
    // Get registrations
    $registrations = Register::paginate($records_per_page, $pagination->offset());
    foreach ($registrations as $registration) {
      $registration->user = User::find($registration->user_id);
      $registration->pack = Pack::find($registration->pack_id);
    }
    $router->render('admin/registered/index', [
      'title' => 'Usuarios Registrados',
      'registrations' => $registrations,
      'pagination' => $pagination->pagination()
    ]);
  }
}