<?php 
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIGifts;
use Controllers\APIEvents;
use Controllers\APISpeakers;
use Controllers\AuthController;
use Controllers\GiftsController;
use Controllers\PagesController;
use Controllers\EventsController;
use Controllers\RegisterController;
use Controllers\SpeakersController;
use Controllers\DashboardController;
use Controllers\RegisteredController;
$router = new Router();

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

// Logout
$router->post('/logout', [AuthController::class, 'logout']);

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

// Admin area
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->post('/admin/dashboard', [DashboardController::class, 'index']);

// Speakers
$router->get('/admin/ponentes', [SpeakersController::class, 'index']);
$router->get('/admin/ponentes/crear', [SpeakersController::class, 'create']);
$router->post('/admin/ponentes/crear', [SpeakersController::class, 'create']);
$router->get('/admin/ponentes/editar', [SpeakersController::class, 'edit']);
$router->post('/admin/ponentes/editar', [SpeakersController::class, 'edit']);
$router->post('/admin/ponentes/eliminar', [SpeakersController::class, 'delete']);

// Events
$router->get('/admin/eventos', [EventsController::class, 'index']);
$router->get('/admin/eventos/crear', [EventsController::class, 'create']);
$router->post('/admin/eventos/crear', [EventsController::class, 'create']);
$router->get('/admin/eventos/editar', [EventsController::class, 'edit']);
$router->post('/admin/eventos/editar', [EventsController::class, 'edit']);
$router->post('/admin/eventos/eliminar', [EventsController::class, 'delete']);

// API's
$router->get('/api/eventos-horario', [APIEvents::class, 'index']);
$router->get('/api/ponentes', [APISpeakers::class, 'index']);
$router->get('/api/ponente', [APISpeakers::class, 'speaker']);
$router->get('/api/regalos', [APIGifts::class, 'index']);

// Registered
$router->get('/admin/registrados', [RegisteredController::class, 'index']);

// Gifts
$router->get('/admin/regalos', [GiftsController::class, 'index']);

// User registration
$router->get('/finalizar-registro', [RegisterController::class, 'create']);
$router->post('/finalizar-registro/gratis', [RegisterController::class, 'free']);
$router->post('/finalizar-registro/pagar', [RegisterController::class, 'pay']);
$router->get('/finalizar-registro/conferencias', [RegisterController::class, 'conferences']);
$router->post('/finalizar-registro/conferencias', [RegisterController::class, 'conferences']);
// Virtual ticket
$router->get('/boleto', [RegisterController::class, 'ticket']);

// Public Area
$router->get('/', [PagesController::class, 'index']);
$router->get('/devwebcamp', [PagesController::class, 'event']);
$router->get('/paquetes', [PagesController::class, 'packs']);
$router->get('/workshops-conferencias', [PagesController::class, 'conferences']);
$router->get('/404', [PagesController::class, 'error']);
$router->checkRoutes();
?>