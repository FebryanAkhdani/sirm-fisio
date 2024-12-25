<?php
// filepath: /D:/laragon/www/rekam-medis-ci4/app/Config/Routes.php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/detail/(:num)', 'Home::detail/$1');

$routes->get('/create', 'Home::create', ['filter' => 'role:admin']);
$routes->post('/register-user', 'Home::register', ['filter' => 'role:admin']);

$routes->get('/create-rm', 'Home::createRm', ['filter' => 'role:admin']);
$routes->post('/store', 'Home::store', ['filter' => 'role:admin']);

service('auth')->routes($routes);
