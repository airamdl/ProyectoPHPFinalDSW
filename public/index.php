<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\ProductoController;
use Controllers\LoginController;
use Controllers\AdminLoginController;
use Controllers\PersonajeController;

$router = new Router();



$router->get('/admin', [PersonajeController::class,'index']);
$router->get('/operaciones/crear', [PersonajeController::class,'crear']);
$router->post('/operaciones/crear', [PersonajeController::class,'crear']);
$router->post('/operaciones/borrar', [PersonajeController::class,'eliminar']);
$router->get('/operaciones/actualizar', [PersonajeController::class,'actualizar']);
$router->post('/operaciones/actualizar', [PersonajeController::class,'actualizar']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/login_admin', [AdminLoginController::class, 'login']);
$router->post('/login_admin', [AdminLoginController::class, 'login']);
$router->get('/logout_admin', [AdminLoginController::class, 'logout']);