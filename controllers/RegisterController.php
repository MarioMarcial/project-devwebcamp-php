<?php
namespace Controllers;
use MVC\Router;

class RegisterController {
  public static function create(Router $router) {
    $router->render('register/create', [
      'title' => 'Finalizar Registro'
    ]);
  }
}
?>