<?php 
require_once __DIR__ . '/../includes/app.php';

use Controllers\AuthController;
use MVC\Router;
$router = new Router();

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

// Logout
$router->get('/logout', [AuthController::class, 'logout']);

// Create account
$router->get('/registro', [AuthController::class, 'register']);
$router->post('/registro', [AuthController::class, 'register']);

// Forgot password
$router->get('/olvide', [AuthController::class, 'forgot']);
$router->post('/olvide', [AuthController::class, 'forgot']);

// New password
$router->get('/restablecer', [AuthController::class, 'recover']);
$router->post('/restablecer', [AuthController::class, 'recover']);

// Confirm account
$router->get('/mensaje', [AuthController::class, 'message']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirm']);

$router->checkRoutes();
?>