<?php

require_once 'libs\smarty-3.1.39\Router.php';
require_once 'Controller/ApiClientController.php';

// crea el router
$router = new Router();

$router->addRoute('datos/cliente/:ID', 'GET', 'ApiClientController', 'obtenerDatosUsuario');
$router->addRoute('datoss/cliente/:ID/', 'PUT','ApiClientController', 'actualizarDatosUsuario');
$router->addRoute('cards/tarjeta/', 'GET', 'ApiTarjetaController', 'obtenerTarjetas');
$router->addRoute('cardss/tarjeta/:ID/', 'GET', 'ApiTarjetaController', 'obtenerEstadoCuenta');
$router->addRoute('activity/actividad/', 'GET', 'ApiActividadController', 'obtenerActividadesIntervalo');
$router->addRoute('cardsss/:ID', 'DELETE', 'ApiTarjetaController', 'eliminarTarjeta');