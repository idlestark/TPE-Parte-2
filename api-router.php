<?php
require_once './libs/Router.php';
require_once './app/controllers/prints-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('prints', 'GET', 'PrintApiController', 'getPrints');
$router->addRoute('prints/:ID', 'GET', 'PrintApiController', 'getPrint');
$router->addRoute('prints/:ID', 'DELETE', 'PrintApiController', 'deletePrint');
$router->addRoute('prints', 'POST', 'PrintApiController', 'insertPrint'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
