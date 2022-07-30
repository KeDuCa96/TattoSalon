<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\CitaController;
use Controllers\LoginController;
use MVC\Router;

$router = new Router();
        // PUBLICO
    //Login and logout
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
    //Recover password
$router->get('/olvide-password', [LoginController::class, 'olvidar']);
$router->post('/olvide-password', [LoginController::class, 'olvidar']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
    //Crete account
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);
    //Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);


        // PRIVADA
$router->get('/cita', [CitaController::class, 'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();