<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\PuestoController;
use Controllers\TurnoController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class, 'index']);


//puestos
$router->get('/puestos', [PuestoController::class, 'index']);
$router->get('/API/puesto/buscar', [PuestoController::class, 'buscarAPI']);
$router->post('/API/puesto/guardar', [PuestoController::class, 'guardarAPI']);
$router->post('/API/puesto/modificar', [PuestoController::class, 'modificarAPI']);
$router->post('/API/puesto/eliminar', [PuestoController::class, 'eliminarAPI']);

//turnos
$router->get('/turnos', [TurnoController::class, 'index']);
$router->get('/API/turno/buscar', [TurnoController::class, 'buscarAPI']);
$router->post('/API/turno/guardar', [TurnoController::class, 'guardarAPI']);
$router->post('/API/turno/modificar', [TurnoController::class, 'modificarAPI']);
$router->post('/API/turno/eliminar', [TurnoController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
