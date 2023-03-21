<?php
namespace Controllers;

use Model\Register;
use MVC\Router;

class RegisterController {
  public static function create(Router $router) {
    $router->render('register/create', [
      'title' => 'Finalizar Registro'
    ]);
  }

  public static function free() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_auth()) {
        header('Location: /login');
      }

      $token = substr(md5(uniqid(rand(), true)), 0, 8);

      // Create registration
      $data = array(
        'pack_id' => 3,
        'paymente_id' => '',
        'token' => $token,
        'user_id' => $_SESSION['id']
      );

      $register = new Register($data);

      $result = $register->save();
      if($result) {
        header('Location: /boleto?id=' . urlencode($register->token));
      }
    }
  }
}
?>