<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->setAutoRoute(true);

$routes->get('/', 'pages::index');
// $routes->get('/komik', 'Komik::index');
$routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
$routes->add('/komik/(:any)', 'Komik::detail/$1');
$routes->get('/komik/create', 'Komik::create');
$routes->post('/komik/save', 'Komik::save');
$routes->post('/komik/update/(:num)', 'Komik::update/$1');
