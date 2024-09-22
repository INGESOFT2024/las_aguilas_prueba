<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\PuestoController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

$router->get('/producto', [PuestoController::class, 'index']);
$router->get('/API/producto/buscar', [PuestoController::class, 'buscarAPI']);
$router->post('/API/producto/guardar', [PuestoController::class, 'guardarAPI']);
$router->post('/API/producto/modificar', [PuestoController::class, 'modificarAPI']);
$router->post('/API/producto/eliminar', [PuestoController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
