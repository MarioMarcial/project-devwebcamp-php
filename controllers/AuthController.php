<?php
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class AuthController {
  public static function login(Router $router) {
    $alerts = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User($_POST);
      $alerts = $user->validateLogin();
      if(empty($alerts)) {
        // check if the user exists
        $user = User::where('email', $user->email);
        if(!$user || !$user->confirmed) {
          User::setAlert('error', 'El usuario no existe o no está confirmado');
        } else {
          // The user exist
          if(password_verify($_POST['password'], $user->password)) {
            // Start session
            session_start();
            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['lastname'] = $user->apellido;
            $_SESSION['email'] = $user->email;
            $_SESSION['admin'] = $user->admin ?? null;

          } else {
            User::setAlert('error', 'Password incorrecto');
          }
        }
      }
    }
    $alerts = User::getAlerts();
    // Render view
    $router->render("auth/login", [
      'title' => 'Iniciar Sesión',
      'alerts' => $alerts
    ]);
  }

  public static function logout() {
    startSession();
    $_SESSION = [];
    header('Location: /');
  }

  public static function register(Router $router) {
    $alerts = [];
    $user = New User();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user->sync($_POST);
      $alerts = $user->validateNewAccount();
      if(empty($alerts)) {
        $userExists = User::where('email', $user->email);
        if($userExists) {
          User::setAlert('error', 'El usuario ya está registrado');
        } else {
          // password hashing
          $user->hashPassword();
          // delete the $repassword
          unset($user->repassword);
          // Generate token
          $user->createToken();
          // Create a new user
          $result = $user->save();
          // Send Email
          $email = New Email($user->email, $user->name, $user->token);
          $email->sendConfirmation();
          if($result) {
            header('Location: /mensaje');
          }
        }
      }
    }
    // Get alerts
    $alerts = $user::getAlerts();
    // Render view
    $router->render("auth/register", [
      'title' => 'Crear tu cuenta en DEvWebCamp',
      'user' => $user,
      'alerts' => $alerts
    ]);
  }

  public static function forgot(Router $router) {
    $alerts = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User($_POST);
      $alerts = $user->validateEmail();
      if(empty($alerts)) {
        // Search user by email
        $user = User::where('email', $user->email);
        if($user && $user->confirmed === "1" ) {
          // The user exists and is confirmed
          // create a new token
          $user->createToken();
          // Delete $repassword
          unset($user->repassword);
          // update the user
          $user->save();

          // send email
          $email = new Email($user->email, $user->name, $user->token);
          $email->sendInstructions();

          // show alert
          User::setAlert('success', 'Hemos enviado las instrucciones a tu email');
      
        } else {
          // there is no user with this email
          User::setAlert('error', 'El usuario no existe o no está confirmado');
        }
      }
    }
    $alerts = User::getAlerts();
    // Render view
    $router->render("auth/forgot", [
      'title' => 'Olvide mi password',
      'alerts' => $alerts
    ]);
  }

  public static function recover(Router $router) {
    $token = $_GET['token'];
    if(!$token || !preg_match("/^[a-zA-Z0-9]+$/", $token)) header('Location: /');
    $alerts = [];
    $valid_token = true;
    // Search user by token
    $user = User::where('token', $token);
    if(empty($user)) {
      User::setAlert('error', 'Token no válido');
      $valid_token = false;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Add new password
      $password = new User($_POST);
      // Validate passwords
      $alerts = $password->validateNewPass();
      if(empty($alerts)) {
        // the new password can't be the old password
        if($user->checkPasswords($password->password)) {
          // new password and old password are the same
          User::setAlert('error', 'El nuevo password no puede ser el antiguo password');
        } else {
          // The new password is different from the old one, therefore,

          // delete old password
          $user->password = null;

          // Delete repassword
          unset($user->repassword);

          // replace the old password with the new one
          $user->password = $password->password;

          // Password hashing
          $user->hashPassword();
          // Delete token
          $user->token = "";

          // Save user in the db
          $result = $user->save();
          // Redirect
          if($result) {
            // succes alert
            User::setAlert('success', 'Password actualizado correctamente');
            // redirection
            header('Refresh: 3; url=/');
          }
        }
      }
    }
    $alerts = User::getAlerts();
    // Render view
    $router->render("auth/reset", [
      'title' => 'Restablecer password',
      'alerts' => $alerts,
      'show' => $valid_token
    ]);
  }

  public static function message(Router $router) {
    // Render view
    $router->render("auth/message", [
      'title' => 'Cuenta Creada Exitosamente'
    ]);
  }

  public static function confirm(Router $router) {
    $token = $_GET['token'];
    if(!$token || !preg_match("/^[a-zA-Z0-9]+$/", $token)) {
      header('Location: /');
    }
    // search user by token
    $user = User::where('token', $token);
    if(empty($user)) {
      // There is no user with this token
      User::setAlert('error', 'Token no válido, la cuenta no se confirmó');
    } else {
      // confirm account
      $user->confirmed = 1;
      $user->token = '';
      unset($user->repassword);
      $result = $user->save();
      if($result) {
        User::setAlert('success', 'Cuenta Confirmada Exitosamente');
      }
    }
    $alerts = User::getAlerts();
    // Render view
    $router->render("auth/confirm", [
      'title' => 'Confirmar tu cuenta DevWebCamp',
      'alerts' => $alerts
    ]);
  }
}

?>