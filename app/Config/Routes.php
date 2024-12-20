<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/create', 'Home::create');
$routes->post('/register-user', 'Home::register');

$routes->get('/lists', 'Home::lists');
$routes->get('/detail/(:num)', 'Home::detail/$1');

$routes->post('/store', 'Home::store');

service('auth')->routes($routes);
