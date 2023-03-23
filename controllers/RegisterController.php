<?php
namespace Controllers;

use Model\Day;
use Model\Hour;
use Model\Pack;
use Model\User;
use MVC\Router;
use Model\Event;
use Model\Speaker;
use Model\Category;
use Model\Gift;
use Model\Register;

class RegisterController {
  public static function create(Router $router) {
    if(!is_auth()) {
      header('Location: /');
    }
    // Check if the user is already registered
    $register = Register::where('user_id', $_SESSION['id']);
    if(isset($register) && $register->pack_id === "3") {
      header('Location: /boleto?id=' . urlencode($register->token));
    }
    $router->render('register/create', [
      'title' => 'Finalizar Registro'
    ]);
  }

  public static function free() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_auth()) {
        header('Location: /login');
      }

      // Check if the user is already registered
      $register = Register::where('user_id', $_SESSION['id']);
      if(isset($register) && $register->pack_id === "3") {
        header('Location: /boleto?id=' . urlencode($register->token));
      }

      $token = substr(md5(uniqid(rand(), true)), 0, 8);

      // Create registration
      $data = array(
        'pack_id' => 3,
        'payment_id' => '',
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

  public static function pay() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_auth()) {
        header('Location: /login');
      }

      // Validate that POST is not empty
      if(empty($_POST)) {
        echo json_encode(['está vacío']);
        return;
      }

      // Create registration
      $data = $_POST;
      $data['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
      $data['user_id'] = $_SESSION['id'];
      try {
        $register = new Register($data);
        $result = $register->save();
        echo json_encode($result);
      } catch (\Throwable $th) {
        echo json_encode([
          'result' => 'error'
        ]);
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

  public static function conferences(Router $router) {
    if(!is_auth()){
      header('Location: /login');
    }

    // check that the user has paid for the ticket in person
    $user_id = $_SESSION['id'];
    $register = Register::where('user_id', $user_id);
    if($register->pack_id !== "1") {
      header('Location: /');
    }

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

    $gifts = Gift::all('ASC');

    $router->render('register/conferences', [
      'title' => 'Elige Workshops y Conferencias',
      'events' => $format_events,
      'gifts' => $gifts
    ]);
  }
}
?>