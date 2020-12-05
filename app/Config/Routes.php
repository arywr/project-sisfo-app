<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('http://localhost/project-sisfo-manual/public/', 'Auth::index');
$routes->get('/', 'Home::index');
$routes->get('/Siswa/edit/(:segment)', 'Siswa::edit/$1');
$routes->delete('/Siswa/(:num)', 'Siswa::delete/$1');
$routes->get('/Siswa/(:any)', 'Siswa::detailSiswa/$1');

$routes->get('/Guru/aktivasi/(:segment)', 'Guru::aktivasi/$1');
$routes->delete('/Guru/(:num)', 'Guru::delete/$1');
$routes->get('/Guru/profile', 'Guru::profile');
$routes->get('/Guru/edit/(:segment)', 'Guru::edit/$1');
$routes->get('/Guru/(:any)', 'Guru::detailGuru/$1');
// $routes->get('/Guru/addGuru', 'Guru::addGuru');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
