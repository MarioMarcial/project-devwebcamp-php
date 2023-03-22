<?php
namespace Controllers;

use Model\Pack;
use Model\User;
use MVC\Router;
use Model\Register;

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

  public static function ticket(Router $router) {
    // Validate url
    $id = $_GET['id'];
    if(!$id || !preg_match("/^[a-zA-Z0-8]+$/", $id)) {
      header('Location: /');
    }

    // Search
    $register = Register::where('token', $id);
    if(!$register) {
      header('Location: /');
    }

    // Get reference info
    $register->user = User::find($register->user_id);
    $register->pack = Pack::find($register->pack_id);
    $router->render('register/ticket', [
      'title' => 'Asistencia a DevWebCamp',
      'registration' => $register
    ]);
  }
}
?>